<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

require_once '../Config/database.php';

// Check if it's a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    
    $data = json_decode(file_get_contents("php://input"));
    
    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON data']);
        exit();
    }
    
    $booking_id = $data->booking_id ?? null;
    $status = $data->status ?? null;
    $table = $data->table ?? 'home_bookings'; // Default to home_bookings
    
    if (!$booking_id || !$status) {
        echo json_encode(['success' => false, 'message' => 'Missing booking_id or status']);
        exit();
    }
    
    // Validate status
    $valid_statuses = ['pending', 'confirmed', 'cancelled', 'completed', 'checked-in'];
    if (!in_array(strtolower($status), $valid_statuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status. Must be one of: ' . implode(', ', $valid_statuses)]);
        exit();
    }
    
    // Update the booking status
    $stmt = $pdo->prepare("UPDATE $table SET status = ? WHERE id = ?");
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $pdo->errorInfo()[2]]);
        exit();
    }
    
    $result = $stmt->execute([$status, $booking_id]);
    
    if ($result) {
        $affected_rows = $stmt->rowCount();
        if ($affected_rows > 0) {
            echo json_encode([
                'success' => true, 
                'message' => 'Booking status updated successfully',
                'booking_id' => $booking_id,
                'new_status' => $status,
                'affected_rows' => $affected_rows
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No booking found with ID: ' . $booking_id]);
        }
    } else {
        $error_info = $stmt->errorInfo();
        echo json_encode(['success' => false, 'message' => 'Failed to update booking status: ' . $error_info[2]]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>
