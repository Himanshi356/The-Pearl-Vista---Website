<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== BOOKING CLEANUP SCRIPT ===\n\n";
    
    // 1. Check for any records without booking_id and generate them
    echo "1. Checking for records without booking_id...\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM home_bookings WHERE booking_id IS NULL OR booking_id = ''");
    $null_booking_ids = $stmt->fetchColumn();
    echo "Records without booking_id: $null_booking_ids\n";
    
    if ($null_booking_ids > 0) {
        echo "Generating booking_ids for records without them...\n";
        $stmt = $pdo->query("SELECT id FROM home_bookings WHERE booking_id IS NULL OR booking_id = ''");
        $records = $stmt->fetchAll(PDO::FETCH_COLUMN);
        
        foreach ($records as $id) {
            $booking_id = 'PV' . str_pad($id, 9, '0', STR_PAD_LEFT);
            $update_stmt = $pdo->prepare("UPDATE home_bookings SET booking_id = ? WHERE id = ?");
            $update_stmt->execute([$booking_id, $id]);
            echo "Generated booking_id $booking_id for record $id\n";
        }
    }
    
    // 2. Check for potential duplicates based on multiple criteria
    echo "\n2. Checking for potential duplicates...\n";
    
    // Check for exact duplicates (same booking_id)
    $stmt = $pdo->query("
        SELECT booking_id, COUNT(*) as count 
        FROM home_bookings 
        WHERE booking_id IS NOT NULL 
        GROUP BY booking_id 
        HAVING COUNT(*) > 1
    ");
    $exact_duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($exact_duplicates)) {
        echo "No exact duplicates found.\n";
    } else {
        echo "Found exact duplicates:\n";
        foreach ($exact_duplicates as $duplicate) {
            echo "Booking ID: {$duplicate['booking_id']} - Count: {$duplicate['count']}\n";
        }
    }
    
    // Check for similar bookings (same customer details and dates)
    $stmt = $pdo->query("
        SELECT customer_name, customer_phone, customer_email, check_in_date, check_out_date, COUNT(*) as count 
        FROM home_bookings 
        GROUP BY customer_name, customer_phone, customer_email, check_in_date, check_out_date 
        HAVING COUNT(*) > 1
    ");
    $similar_duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($similar_duplicates)) {
        echo "No similar duplicates found.\n";
    } else {
        echo "Found similar duplicates:\n";
        foreach ($similar_duplicates as $duplicate) {
            echo "Customer: {$duplicate['customer_name']} - Phone: {$duplicate['customer_phone']} - Count: {$duplicate['count']}\n";
        }
    }
    
    // 3. Show current booking count
    echo "\n3. Current booking statistics:\n";
    $stmt = $pdo->query("SELECT COUNT(*) FROM home_bookings");
    $total_bookings = $stmt->fetchColumn();
    echo "Total bookings: $total_bookings\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM home_bookings WHERE status = 'pending'");
    $pending_bookings = $stmt->fetchColumn();
    echo "Pending bookings: $pending_bookings\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM home_bookings WHERE status = 'confirmed'");
    $confirmed_bookings = $stmt->fetchColumn();
    echo "Confirmed bookings: $confirmed_bookings\n";
    
    // 4. Show recent bookings (last 24 hours)
    echo "\n4. Recent bookings (last 24 hours):\n";
    $stmt = $pdo->query("
        SELECT id, booking_id, customer_name, created_at 
        FROM home_bookings 
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
        ORDER BY created_at DESC
    ");
    $recent_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($recent_bookings as $booking) {
        echo "ID: {$booking['id']} | Booking ID: {$booking['booking_id']} | Name: {$booking['customer_name']} | Created: {$booking['created_at']}\n";
    }
    
    echo "\n=== CLEANUP COMPLETE ===\n";
    echo "The duplicate submission prevention has been implemented in home.html.\n";
    echo "Future bookings should not create duplicates.\n";
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 