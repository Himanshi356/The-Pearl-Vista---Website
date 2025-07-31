<?php
// Direct Database Test - No Session Required
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful!\n\n";
    
    // Test 1: Total Rooms from room_types table
    $stmt = $pdo->query("SELECT SUM(total_rooms) as total_rooms FROM room_types");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "🏨 Total Rooms (from room_types): " . $result['total_rooms'] . "\n";
    
    // Test 2: Total Rooms from rooms table
    $stmt = $pdo->query("SELECT COUNT(*) as total_rooms FROM rooms");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "🏨 Total Rooms (from rooms table): " . $result['total_rooms'] . "\n";
    
    // Test 3: Active Bookings
    $stmt = $pdo->query("SELECT COUNT(*) as active_bookings FROM bookings WHERE status = 'confirmed'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📅 Active Bookings (confirmed): " . $result['active_bookings'] . "\n";
    
    // Test 4: All Bookings by Status
    $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM bookings GROUP BY status");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "📊 All Bookings by Status:\n";
    foreach ($results as $row) {
        echo "   - " . $row['status'] . ": " . $row['count'] . "\n";
    }
    
    // Test 5: Room Types Summary
    $stmt = $pdo->query("SELECT room_type, total_rooms, base_price FROM room_types ORDER BY base_price DESC");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "\n🏨 Room Types Summary:\n";
    foreach ($results as $row) {
        echo "   - " . $row['room_type'] . ": " . $row['total_rooms'] . " rooms ($" . number_format($row['base_price']) . "/night)\n";
    }
    
    // Test 6: Admin Users
    $stmt = $pdo->query("SELECT COUNT(*) as total_admins FROM admin_users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "\n👥 Total Admins: " . $result['total_admins'] . "\n";
    
    // Test 7: Activity Log
    $stmt = $pdo->query("SELECT COUNT(*) as total_activity FROM admin_activity_log");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📊 Total Activity: " . $result['total_activity'] . "\n";
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}
?> 