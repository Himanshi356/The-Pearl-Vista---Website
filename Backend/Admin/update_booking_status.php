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

if (!isset($input['booking_id']) || !isset($input['status'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    
    $bookingId = $input['booking_id'];
    $status = $input['status'];
    
    // Validate status
    $validStatuses = ['pending', 'confirmed', 'cancelled'];
    if (!in_array($status, $validStatuses)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid status']);
        exit();
    }
    
    // Update booking status
    $stmt = $pdo->prepare("UPDATE bookings SET status = ?, updated_at = NOW() WHERE id = ?");
    $result = $stmt->execute([$status, $bookingId]);
    
    if ($result) {
        // Log the activity
        $adminId = $_SESSION['user'] ?? 1;
        $stmt2 = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, description) VALUES (?, ?, ?)");
        $stmt2->execute([$adminId, 'UPDATE_BOOKING_STATUS', "Updated booking #$bookingId status to $status"]);
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Booking status updated successfully'
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update booking status']);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update booking status: ' . $e->getMessage()
    ]);
}
?> 