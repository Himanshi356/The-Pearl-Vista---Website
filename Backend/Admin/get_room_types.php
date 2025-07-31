<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get all active room types
    $stmt = $pdo->query("
        SELECT room_type, description, base_price, total_rooms, available_rooms, floor_number, status
        FROM room_types 
        WHERE status = 'active'
        ORDER BY base_price DESC
    ");
    
    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'room_types' => $roomTypes
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch room types: ' . $e->getMessage()
    ]);
}
?> 