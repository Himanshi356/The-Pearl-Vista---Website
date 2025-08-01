<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

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
    
    // Validate required fields
    $required_fields = ['id', 'customer_name', 'customer_email', 'room_type', 'check_in_date', 'check_out_date', 'num_guests', 'num_rooms', 'total_amount', 'status'];
    
    foreach ($required_fields as $field) {
        if (!isset($data->$field) || empty($data->$field)) {
            echo json_encode(['success' => false, 'message' => "Missing required field: $field"]);
            exit();
        }
    }
    
    // Validate dates
    $check_in = new DateTime($data->check_in_date);
    $check_out = new DateTime($data->check_out_date);
    
    if ($check_in >= $check_out) {
        echo json_encode(['success' => false, 'message' => 'Check-out date must be after check-in date']);
        exit();
    }
    
    // Validate status
    $valid_statuses = ['pending', 'confirmed', 'cancelled', 'completed', 'checked-in'];
    if (!in_array(strtolower($data->status), $valid_statuses)) {
        echo json_encode(['success' => false, 'message' => 'Invalid status. Must be one of: ' . implode(', ', $valid_statuses)]);
        exit();
    }
    
    // Update the booking
    $stmt = $pdo->prepare("
        UPDATE home_bookings 
        SET 
            customer_name = ?,
            customer_email = ?,
            customer_phone = ?,
            room_type = ?,
            check_in_date = ?,
            check_out_date = ?,
            num_guests = ?,
            num_rooms = ?,
            total_amount = ?,
            status = ?,
            special_instructions = ?
        WHERE id = ?
    ");
    
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $pdo->errorInfo()[2]]);
        exit();
    }
    
    $result = $stmt->execute([
        $data->customer_name,
        $data->customer_email,
        $data->customer_phone ?? '',
        $data->room_type,
        $data->check_in_date,
        $data->check_out_date,
        $data->num_guests,
        $data->num_rooms,
        $data->total_amount,
        $data->status,
        $data->special_instructions ?? '',
        $data->id
    ]);
    
    if ($result) {
        $affected_rows = $stmt->rowCount();
        if ($affected_rows > 0) {
            echo json_encode([
                'success' => true,
                'message' => 'Booking updated successfully',
                'booking_id' => $data->id,
                'affected_rows' => $affected_rows
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No booking found with ID: ' . $data->id]);
        }
    } else {
        $error_info = $stmt->errorInfo();
        echo json_encode(['success' => false, 'message' => 'Failed to update booking: ' . $error_info[2]]);
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?> 