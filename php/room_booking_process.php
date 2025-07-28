<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

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

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating database']);
    exit();
}

// Select the database
$conn->select_db($dbname);

// Create room_bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS room_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    room_type VARCHAR(100) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_guests INT(11) NOT NULL,
    num_rooms INT(11) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating room_bookings table']);
    exit();
}

// Get form data
$customer_name = isset($_POST['customer_name']) ? trim($_POST['customer_name']) : '';
$customer_email = isset($_POST['customer_email']) ? trim($_POST['customer_email']) : '';
$customer_phone = isset($_POST['customer_phone']) ? trim($_POST['customer_phone']) : '';
$room_type = isset($_POST['room_type']) ? trim($_POST['room_type']) : '';
$check_in_date = isset($_POST['check_in_date']) ? trim($_POST['check_in_date']) : '';
$check_out_date = isset($_POST['check_out_date']) ? trim($_POST['check_out_date']) : '';
$num_guests = isset($_POST['num_guests']) ? intval($_POST['num_guests']) : 0;
$num_rooms = isset($_POST['num_rooms']) ? intval($_POST['num_rooms']) : 0;
$total_amount = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;

// Validate required fields
if (empty($customer_name) || empty($customer_email) || empty($customer_phone) || 
    empty($room_type) || empty($check_in_date) || empty($check_out_date) || 
    $num_guests <= 0 || $num_rooms <= 0 || $total_amount <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Validate email format
if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit();
}

// Validate date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $check_in_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $check_out_date)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid date format']);
    exit();
}

// Validate dates
$checkin = new DateTime($check_in_date);
$checkout = new DateTime($check_out_date);
$today = new DateTime();

if ($checkin < $today) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Check-in date cannot be in the past']);
    exit();
}

if ($checkout <= $checkin) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Check-out date must be after check-in date']);
    exit();
}

// Check room availability
$stmt = $conn->prepare("SELECT available_rooms FROM room_availability WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
$stmt->bind_param("sss", $room_type, $check_in_date, $check_out_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $availability = $result->fetch_assoc();
    $available_rooms = $availability['available_rooms'];
    
    if ($available_rooms < $num_rooms) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Sorry, only {$available_rooms} {$room_type}(s) are available for your selected dates."]);
        exit();
    }
} else {
    // No availability record exists, assume rooms are available
    $available_rooms = 10;
    if ($num_rooms > $available_rooms) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => "Sorry, only {$available_rooms} {$room_type}(s) are available for your selected dates."]);
        exit();
    }
}

// Insert booking into database
$stmt = $conn->prepare("INSERT INTO room_bookings (customer_name, customer_email, customer_phone, room_type, check_in_date, check_out_date, num_guests, num_rooms, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    exit();
}

$stmt->bind_param("sssssiids", $customer_name, $customer_email, $customer_phone, $room_type, $check_in_date, $check_out_date, $num_guests, $num_rooms, $total_amount);

if ($stmt->execute()) {
    $booking_id = $conn->insert_id;
    
    // Update room availability
    $new_available = $available_rooms - $num_rooms;
    $update_stmt = $conn->prepare("UPDATE room_availability SET available_rooms = ? WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
    $update_stmt->bind_param("isss", $new_available, $room_type, $check_in_date, $check_out_date);
    $update_stmt->execute();
    
    // Success response
    echo json_encode([
        'success' => true,
        'message' => 'Room booking submitted successfully!',
        'booking_id' => $booking_id,
        'details' => [
            'customer_name' => $customer_name,
            'room_type' => $room_type,
            'check_in_date' => $check_in_date,
            'check_out_date' => $check_out_date,
            'num_guests' => $num_guests,
            'num_rooms' => $num_rooms,
            'total_amount' => $total_amount
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error saving booking: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?> 