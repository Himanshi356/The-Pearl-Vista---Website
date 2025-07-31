<?php
// Script to check tour bookings data
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Check total count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tour_bookings");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total tour bookings: $count\n\n";
    
    if ($count > 0) {
        // Show sample data
        $stmt = $pdo->query("SELECT * FROM tour_bookings ORDER BY id LIMIT 5");
        $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Sample bookings:\n";
        foreach ($bookings as $booking) {
            echo "- ID: {$booking['id']}, Name: {$booking['full_name']}, Vehicle: {$booking['vehicle_type']}, Status: {$booking['status']}, Amount: \${$booking['amount_paid']}\n";
        }
        
        // Show statistics
        $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM tour_bookings GROUP BY status");
        $statusStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\nStatus breakdown:\n";
        foreach ($statusStats as $stat) {
            echo "- {$stat['status']}: {$stat['count']}\n";
        }
        
        // Show total revenue
        $stmt = $pdo->query("SELECT SUM(amount_paid) as total_revenue FROM tour_bookings WHERE status = 'confirmed'");
        $revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
        echo "\nTotal confirmed revenue: $" . number_format($revenue, 2) . "\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 