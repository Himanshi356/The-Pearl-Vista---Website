<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

try {
    // Get POST data
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        $input = $_POST;
    }
    
    $booking_id = isset($input['booking_id']) ? trim($input['booking_id']) : '';
    $new_status = isset($input['new_status']) ? trim($input['new_status']) : '';
    $booking_type = isset($input['booking_type']) ? trim($input['booking_type']) : 'home'; // home or tour
    
    // Validate required fields
    if (empty($booking_id) || empty($new_status)) {
        throw new Exception('Booking ID and new status are required');
    }
    
    // Validate status
    $valid_statuses = ['pending', 'confirmed', 'cancelled', 'checked-in', 'checked-out'];
    if (!in_array(strtolower($new_status), $valid_statuses)) {
        throw new Exception('Invalid status provided');
    }
    
    // Determine which table to update based on booking type
    if ($booking_type === 'tour' || strpos($booking_id, 'TOUR') === 0) {
        // Update tour booking
        $table = 'tour_bookings';
        $id_column = 'id';
        $actual_id = str_replace('TOUR', '', $booking_id);
    } else {
        // Update home booking
        $table = 'home_bookings';
        $id_column = 'id';
        $actual_id = str_replace('PV', '', $booking_id);
    }
    
    // Update the booking status
    $sql = "UPDATE $table SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE $id_column = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $new_status, $actual_id);
    
    if (!$stmt->execute()) {
        throw new Exception("Error updating booking status: " . $stmt->error);
    }
    
    if ($stmt->affected_rows === 0) {
        throw new Exception("No booking found with ID: $booking_id");
    }
    
    $stmt->close();
    
    echo json_encode([
        'success' => true,
        'message' => 'Booking status updated successfully',
        'booking_id' => $booking_id,
        'new_status' => $new_status
    ]);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();
?> 