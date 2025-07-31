<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit();
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['room_number']) || !isset($input['room_type']) || !isset($input['price_per_night'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    
    $roomNumber = $input['room_number'];
    $roomType = $input['room_type'];
    $pricePerNight = $input['price_per_night'];
    $description = $input['description'] ?? '';
    $floor = $input['floor'] ?? 1;
    $status = $input['status'] ?? 'available';
    
    // Check if room number already exists
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM rooms WHERE room_number = ?");
    $stmt->execute([$roomNumber]);
    if ($stmt->fetchColumn() > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Room number already exists']);
        exit();
    }
    
    // Insert new room
    $stmt = $pdo->prepare("
        INSERT INTO rooms (room_number, room_type, description, floor, price_per_night, status, total_rooms, available_rooms) 
        VALUES (?, ?, ?, ?, ?, ?, 1, 1)
    ");
    $result = $stmt->execute([$roomNumber, $roomType, $description, $floor, $pricePerNight, $status]);
    
    if ($result) {
        // Log the activity
        $adminId = $_SESSION['user_id'] ?? 1;
        $stmt2 = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, description) VALUES (?, ?, ?)");
        $stmt2->execute([$adminId, 'ADD_ROOM', "Added new room: $roomNumber ($roomType)"]);
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Room added successfully'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to add room']);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to add room: ' . $e->getMessage()
    ]);
}
?> 