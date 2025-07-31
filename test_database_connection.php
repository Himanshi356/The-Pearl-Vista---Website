<?php
// Test Database Connection
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful!\n";
    
    // Test room types query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM room_types");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "📊 Room types in database: " . $result['count'] . "\n";
    
    // Test rooms query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM rooms");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "🏨 Rooms in database: " . $result['count'] . "\n";
    
    // Test admin users query
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "👥 Admin users in database: " . $result['count'] . "\n";
    
    // Show sample room types
    $stmt = $pdo->query("SELECT room_type, base_price, total_rooms FROM room_types ORDER BY base_price DESC LIMIT 3");
    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n🏨 Sample Room Types:\n";
    foreach ($roomTypes as $room) {
        echo "- " . $room['room_type'] . " ($" . number_format($room['base_price']) . "/night, " . $room['total_rooms'] . " rooms)\n";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}
?> 