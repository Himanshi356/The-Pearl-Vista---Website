<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

if (!isset($input['room_type']) || !isset($input['base_price']) || !isset($input['total_rooms']) || !isset($input['available_rooms']) || !isset($input['floor_number']) || !isset($input['status'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    
    // Validate the room type exists
    $stmt = $pdo->prepare("SELECT room_type FROM room_types WHERE room_type = ?");
    $stmt->execute([$input['room_type']]);
    
    if (!$stmt->fetch()) {
        echo json_encode(['status' => 'error', 'message' => 'Room type not found']);
        exit();
    }
    
    // Update room type
    $stmt = $pdo->prepare("
        UPDATE room_types 
        SET base_price = ?, total_rooms = ?, floor_number = ?, description = ?
        WHERE room_type = ?
    ");
    
    $stmt->execute([
        $input['base_price'],
        $input['total_rooms'],
        $input['floor_number'],
        $input['description'] ?? '',
        $input['room_type']
    ]);
    
    // Update individual rooms of this type
    $stmt = $pdo->prepare("
        UPDATE rooms 
        SET price_per_night = ?, floor = ?, status = ?
        WHERE room_type = ?
    ");
    
    // Convert status to database format
    $dbStatus = 'available';
    if ($input['status'] === 'Fully Booked') {
        $dbStatus = 'reserved';
    } elseif ($input['status'] === 'Maintenance') {
        $dbStatus = 'maintenance';
    }
    
    $stmt->execute([
        $input['base_price'],
        $input['floor_number'],
        $dbStatus,
        $input['room_type']
    ]);
    
    // Log the activity
    $admin_id = $_SESSION['user_id'] ?? 1;
    $activity_stmt = $pdo->prepare("
        INSERT INTO admin_activity_log (admin_id, action, description) 
        VALUES (?, 'edit_room', ?)
    ");
    $activity_stmt->execute([
        $admin_id,
        "Edited room type: " . $input['room_type'] . " - Price: $" . $input['base_price'] . ", Total Rooms: " . $input['total_rooms'] . ", Status: " . $input['status']
    ]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Room type updated successfully'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update room type: ' . $e->getMessage()
    ]);
}
?> 