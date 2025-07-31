<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

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
    $data = json_decode(file_get_contents('php://input'), true);
    
    $email = $data['email'] ?? '';
    
    if (empty($email)) {
        throw new Exception("Email parameter is required");
    }
    
    // First, get the count of bookings to be deleted
    $count_sql = "SELECT COUNT(*) as booking_count FROM home_bookings WHERE customer_email = ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("s", $email);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $count_row = $count_result->fetch_assoc();
    $booking_count = $count_row['booking_count'];
    
    if ($booking_count === 0) {
        throw new Exception("Customer not found");
    }
    
    // Delete all bookings for this customer
    $delete_sql = "DELETE FROM home_bookings WHERE customer_email = ?";
    $stmt = $conn->prepare($delete_sql);
    $stmt->bind_param("s", $email);
    
    if (!$stmt->execute()) {
        throw new Exception("Error deleting customer: " . $conn->error);
    }
    
    $affected_rows = $stmt->affected_rows;
    
    $response = [
        'success' => true,
        'message' => "Customer deleted successfully. Removed $affected_rows booking(s).",
        'deleted_bookings' => $affected_rows
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?> 