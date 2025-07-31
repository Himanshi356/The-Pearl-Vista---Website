<?php
// Test Admin Dashboard Statistics
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful!\n\n";
    
    // Test total rooms count
    $stmt = $pdo->query("SELECT COUNT(*) as total_rooms FROM rooms");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "🏨 Total Rooms: " . $result['total_rooms'] . "\n";
    
    // Test active bookings count
    $stmt = $pdo->query("SELECT COUNT(*) as active_bookings FROM bookings WHERE status = 'confirmed'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📅 Active Bookings: " . $result['active_bookings'] . "\n";
    
    // Test total admins count
    $stmt = $pdo->query("SELECT COUNT(*) as total_admins FROM admin_users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "👥 Total Admins: " . $result['total_admins'] . "\n";
    
    // Test total activity count
    $stmt = $pdo->query("SELECT COUNT(*) as total_activity FROM admin_activity_log");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📊 Total Activity: " . $result['total_activity'] . "\n";
    
    // Show sample room data
    $stmt = $pdo->query("SELECT room_type, COUNT(*) as count FROM rooms GROUP BY room_type ORDER BY count DESC LIMIT 3");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n🏨 Room Distribution:\n";
    foreach ($rooms as $room) {
        echo "- " . $room['room_type'] . ": " . $room['count'] . " rooms\n";
    }
    
    // Show sample booking data
    $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM bookings GROUP BY status ORDER BY count DESC LIMIT 5");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n📅 Booking Status Distribution:\n";
    foreach ($bookings as $booking) {
        echo "- " . $booking['status'] . ": " . $booking['count'] . " bookings\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}
?> 