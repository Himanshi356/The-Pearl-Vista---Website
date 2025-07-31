<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== DUPLICATE BOOKINGS CHECK ===\n\n";
    
    // Check for duplicate bookings based on multiple criteria
    $queries = [
        "Exact duplicates (same booking_id)" => "
            SELECT booking_id, COUNT(*) as count 
            FROM home_bookings 
            GROUP BY booking_id 
            HAVING COUNT(*) > 1
        ",
        
        "Similar bookings (same name, phone, email, dates)" => "
            SELECT customer_name, customer_phone, customer_email, check_in_date, check_out_date, COUNT(*) as count 
            FROM home_bookings 
            GROUP BY customer_name, customer_phone, customer_email, check_in_date, check_out_date 
            HAVING COUNT(*) > 1
        ",
        
        "Recent bookings (last 24 hours)" => "
            SELECT * FROM home_bookings 
            WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
            ORDER BY created_at DESC
        ",
        
        "Total bookings count" => "
            SELECT COUNT(*) as total_bookings FROM home_bookings
        "
    ];
    
    foreach ($queries as $description => $query) {
        echo "--- $description ---\n";
        $stmt = $pdo->query($query);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if (empty($results)) {
            echo "No results found.\n";
        } else {
            foreach ($results as $row) {
                echo json_encode($row, JSON_PRETTY_PRINT) . "\n";
            }
        }
        echo "\n";
    }
    
    // Show all bookings for manual review
    echo "--- ALL BOOKINGS (for manual review) ---\n";
    $stmt = $pdo->query("SELECT * FROM home_bookings ORDER BY created_at DESC");
    $allBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($allBookings as $booking) {
        echo "ID: {$booking['id']} | Booking ID: {$booking['booking_id']} | Name: {$booking['customer_name']} | Created: {$booking['created_at']}\n";
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 