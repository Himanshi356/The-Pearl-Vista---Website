<?php
header('Content-Type: application/json');

require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Test basic connection
    echo "Database connection successful\n";
    
    // Check if home_bookings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'home_bookings'");
    if ($stmt->rowCount() > 0) {
        echo "home_bookings table exists\n";
        
        // Get table structure
        $stmt = $pdo->query("DESCRIBE home_bookings");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Table structure:\n";
        foreach ($columns as $column) {
            echo "- {$column['Field']}: {$column['Type']}\n";
        }
        
        // Check for existing bookings
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM home_bookings");
        $count = $stmt->fetch(PDO::FETCH_ASSOC);
        echo "Total bookings: {$count['count']}\n";
        
        // Get a sample booking
        $stmt = $pdo->query("SELECT * FROM home_bookings LIMIT 1");
        $sample = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($sample) {
            echo "Sample booking ID: {$sample['id']}\n";
            echo "Sample booking_id: {$sample['booking_id']}\n";
        }
        
    } else {
        echo "home_bookings table does not exist\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 