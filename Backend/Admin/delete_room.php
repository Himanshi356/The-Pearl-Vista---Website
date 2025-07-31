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

if (!isset($input['room_type'])) {
    echo json_encode(['status' => 'error', 'message' => 'Room type is required']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    
    // Check if there are any active bookings for this room type in all booking tables
    $totalBookingCount = 0;
    
    // Check bookings table
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as booking_count 
        FROM bookings b 
        WHERE b.room_type = ? AND b.status IN ('confirmed', 'pending')
    ");
    $stmt->execute([$input['room_type']]);
    $bookingCount = $stmt->fetch(PDO::FETCH_ASSOC)['booking_count'];
    $totalBookingCount += $bookingCount;
    
    // Check home_bookings table
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as booking_count 
        FROM home_bookings b 
        WHERE b.room_type = ? AND b.status IN ('confirmed', 'pending')
    ");
    $stmt->execute([$input['room_type']]);
    $homeBookingCount = $stmt->fetch(PDO::FETCH_ASSOC)['booking_count'];
    $totalBookingCount += $homeBookingCount;
    
    // Check room_bookings table
    $stmt = $pdo->prepare("
        SELECT COUNT(*) as booking_count 
        FROM room_bookings b 
        WHERE b.room_type = ? AND b.status IN ('confirmed', 'pending')
    ");
    $stmt->execute([$input['room_type']]);
    $roomBookingCount = $stmt->fetch(PDO::FETCH_ASSOC)['booking_count'];
    $totalBookingCount += $roomBookingCount;
    
    if ($totalBookingCount > 0) {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Cannot delete room type with active bookings. Please cancel all bookings first.'
        ]);
        exit();
    }
    
    // Check if the room type exists
    $stmt = $pdo->prepare("SELECT room_type, total_rooms FROM room_types WHERE room_type = ?");
    $stmt->execute([$input['room_type']]);
    $roomTypeData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$roomTypeData) {
        echo json_encode(['status' => 'error', 'message' => 'Room type not found']);
        exit();
    }
    
    // Additional safety check: Don't allow deletion of room types with many rooms
    if ($roomTypeData['total_rooms'] > 50) {
        echo json_encode([
            'status' => 'error', 
            'message' => 'Cannot delete room type with more than 50 rooms. Please contact system administrator.'
        ]);
        exit();
    }
    
    // Start transaction
    $pdo->beginTransaction();
    
    // Delete all rooms of this type
    $stmt = $pdo->prepare("DELETE FROM rooms WHERE room_type = ?");
    $stmt->execute([$input['room_type']]);
    
    // Delete the room type
    $stmt = $pdo->prepare("DELETE FROM room_types WHERE room_type = ?");
    $stmt->execute([$input['room_type']]);
    
    // Log the activity
    $admin_id = $_SESSION['user_id'] ?? 1;
    $activity_stmt = $pdo->prepare("
        INSERT INTO admin_activity_log (admin_id, action, description) 
        VALUES (?, 'delete_room', ?)
    ");
    $activity_stmt->execute([
        $admin_id,
        "Deleted room type: " . $input['room_type'] . " (Total rooms: " . $roomTypeData['total_rooms'] . ")"
    ]);
    
    // Commit transaction
    $pdo->commit();
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Room type deleted successfully'
    ]);
    
} catch (Exception $e) {
    // Rollback transaction on error
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to delete room type: ' . $e->getMessage()
    ]);
}
?> 