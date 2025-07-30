<?php
// Update Service Booking Status - Admin Panel
// This file updates the status of service bookings

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

// Validate input
if (!$input) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid JSON input']);
    exit;
}

// Validate required fields
if (!isset($input['bookingId']) || !isset($input['status'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Booking ID and status are required']);
    exit;
}

// Validate status
$allowedStatuses = ['pending', 'confirmed', 'cancelled', 'completed'];
if (!in_array($input['status'], $allowedStatuses)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid status. Allowed values: ' . implode(', ', $allowedStatuses)]);
    exit;
}

// Database configuration
$host = 'localhost';
$dbname = 'pearlvista';
$username = 'root';
$password = '';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if booking exists
    $checkSql = "SELECT id, status FROM service_bookings WHERE booking_id = :booking_id";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':booking_id', $input['bookingId']);
    $checkStmt->execute();
    
    $booking = $checkStmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'Booking not found']);
        exit;
    }
    
    // Update the booking status
    $updateSql = "UPDATE service_bookings SET status = :status, updated_at = CURRENT_TIMESTAMP WHERE booking_id = :booking_id";
    $updateStmt = $pdo->prepare($updateSql);
    $updateStmt->bindParam(':status', $input['status']);
    $updateStmt->bindParam(':booking_id', $input['bookingId']);
    $updateStmt->execute();
    
    // Check if update was successful
    if ($updateStmt->rowCount() > 0) {
        // Get updated booking data
        $getBookingSql = "SELECT * FROM service_bookings WHERE booking_id = :booking_id";
        $getBookingStmt = $pdo->prepare($getBookingSql);
        $getBookingStmt->bindParam(':booking_id', $input['bookingId']);
        $getBookingStmt->execute();
        
        $updatedBooking = $getBookingStmt->fetch(PDO::FETCH_ASSOC);
        
        // Decode JSON fields
        if (isset($updatedBooking['selected_services'])) {
            $updatedBooking['selected_services'] = json_decode($updatedBooking['selected_services'], true);
        }
        if (isset($updatedBooking['additional_services'])) {
            $updatedBooking['additional_services'] = json_decode($updatedBooking['additional_services'], true);
        }
        
        // Prepare response data
        $responseData = [
            'success' => true,
            'message' => 'Booking status updated successfully',
            'booking' => $updatedBooking,
            'previous_status' => $booking['status'],
            'new_status' => $input['status']
        ];
        
        // Log the status update
        error_log("Service booking status updated: {$input['bookingId']} from {$booking['status']} to {$input['status']}");
        
        // Return success response
        echo json_encode($responseData);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to update booking status']);
    }
    
} catch (PDOException $e) {
    // Log the error
    error_log("Database error in update_service_booking_status.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred',
        'error' => $e->getMessage()
    ]);
    
} catch (Exception $e) {
    // Log the error
    error_log("General error in update_service_booking_status.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while updating the booking status',
        'error' => $e->getMessage()
    ]);
}
?> 