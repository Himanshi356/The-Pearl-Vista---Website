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
    $name = $data['name'] ?? '';
    $phone = $data['phone'] ?? '';
    $booking_id = $data['booking_id'] ?? '';
    $status = $data['status'] ?? '';
    
    if (empty($email)) {
        throw new Exception("Email parameter is required");
    }
    
    if (empty($name)) {
        throw new Exception("Name is required");
    }
    
    if (empty($phone)) {
        throw new Exception("Phone number is required");
    }
    
    // First, check if the customer exists
    $check_sql = "SELECT COUNT(*) as count FROM home_bookings WHERE customer_email = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    $check_row = $check_result->fetch_assoc();
    
    if ($check_row['count'] == 0) {
        throw new Exception("Customer not found");
    }
    
    // Update customer information in all their bookings
    $update_sql = "UPDATE home_bookings 
                    SET customer_name = ?, customer_phone = ? 
                    WHERE customer_email = ?";
    
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sss", $name, $phone, $email);
    
    if (!$stmt->execute()) {
        throw new Exception("Error updating customer: " . $conn->error);
    }
    
    $affected_rows = $stmt->affected_rows;
    
    // If a specific booking is being updated
    if (!empty($booking_id)) {
        $booking_update_sql = "UPDATE home_bookings 
                              SET customer_name = ?, customer_phone = ?";
        
        $params = [$name, $phone];
        $types = "ss";
        
        if (!empty($status)) {
            $booking_update_sql .= ", status = ?";
            $params[] = $status;
            $types .= "s";
        }
        
        $booking_update_sql .= " WHERE booking_id = ?";
        $params[] = $booking_id;
        $types .= "s";
        
        $booking_stmt = $conn->prepare($booking_update_sql);
        $booking_stmt->bind_param($types, ...$params);
        
        if (!$booking_stmt->execute()) {
            throw new Exception("Error updating booking: " . $conn->error);
        }
        
        $booking_affected = $booking_stmt->affected_rows;
        $affected_rows += $booking_affected;
    }
    
    // If customer status is being updated (for all bookings)
    if (!empty($status) && empty($booking_id)) {
        // Since customer status is calculated dynamically, we'll add a customer_status field
        // First, check if the column exists, if not, we'll skip the status update for now
        $check_column_sql = "SHOW COLUMNS FROM home_bookings LIKE 'customer_status'";
        $column_result = $conn->query($check_column_sql);
        
        if ($column_result->num_rows > 0) {
            // Column exists, update it
            $status_update_sql = "UPDATE home_bookings 
                                 SET customer_name = ?, customer_phone = ?, customer_status = ? 
                                 WHERE customer_email = ?";
            
            $status_stmt = $conn->prepare($status_update_sql);
            $status_stmt->bind_param("ssss", $name, $phone, $status, $email);
            
            if (!$status_stmt->execute()) {
                throw new Exception("Error updating customer status: " . $conn->error);
            }
            
            $status_affected = $status_stmt->affected_rows;
            $affected_rows = $status_affected; // Override with status update count
        } else {
            // Column doesn't exist, just update name and phone
            $affected_rows = $stmt->affected_rows;
        }
    }
    
    $response = [
        'success' => true,
        'message' => "Customer updated successfully. Updated $affected_rows record(s).",
        'customer' => [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'status' => $status
        ]
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?> 