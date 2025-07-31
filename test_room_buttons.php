<?php
session_start();
require_once 'Config/database.php';

// Set admin session for testing
$_SESSION['user'] = 'admin';
$_SESSION['role'] = 'admin';
$_SESSION['user_id'] = 1;

try {
    $pdo = getDatabaseConnection();
    
    // Test getting room data
    $stmt = $pdo->query("
        SELECT 
            rt.room_type,
            rt.description,
            rt.base_price,
            rt.total_rooms,
            rt.floor_number,
            COUNT(r.room_id) as total_rooms_created,
            SUM(CASE WHEN r.status = 'available' THEN 1 ELSE 0 END) as available_rooms,
            SUM(CASE WHEN r.status = 'reserved' THEN 1 ELSE 0 END) as reserved_rooms,
            SUM(CASE WHEN r.status = 'maintenance' THEN 1 ELSE 0 END) as maintenance_rooms
        FROM room_types rt
        LEFT JOIN rooms r ON rt.room_type = r.room_type
        GROUP BY rt.room_type
        ORDER BY rt.base_price DESC
    ");
    
    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Current Room Types:</h2>";
    echo "<pre>";
    print_r($roomTypes);
    echo "</pre>";
    
    // Test admin activity log table
    $stmt = $pdo->query("SELECT * FROM admin_activity_log ORDER BY timestamp DESC LIMIT 5");
    $activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h2>Recent Admin Activities:</h2>";
    echo "<pre>";
    print_r($activities);
    echo "</pre>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 