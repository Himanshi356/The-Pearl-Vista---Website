<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Database configuration
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default for XAMPP
$dbname = "the_pearl_vista";

// Create connection
$conn = new mysqli($servername, $username, $password);

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

// Create tour_bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS tour_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    tour_date DATE NOT NULL,
    tour_time TIME NOT NULL,
    places_to_visit TEXT NOT NULL,
    number_of_travellers INT(11) NOT NULL,
    vehicle_type VARCHAR(50) NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating tour_bookings table']);
    exit();
}

// Get form data safely
$full_name = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$tour_date = isset($_POST['tour_date']) ? trim($_POST['tour_date']) : '';
$tour_time = isset($_POST['tour_time']) ? trim($_POST['tour_time']) : '';
$places_to_visit = isset($_POST['places_to_visit']) ? trim($_POST['places_to_visit']) : '';
$number_of_travellers = isset($_POST['number_of_travellers']) ? intval($_POST['number_of_travellers']) : 0;
$vehicle_type = isset($_POST['vehicle_type']) ? trim($_POST['vehicle_type']) : '';
$amount_paid = isset($_POST['amount_paid']) ? trim($_POST['amount_paid']) : '';

// Remove '$' from amount if present
$amount_paid = str_replace('$', '', $amount_paid);

// Validate required fields
if (empty($full_name) || empty($email) || empty($phone) || empty($tour_date) || 
    empty($tour_time) || empty($places_to_visit) || $number_of_travellers <= 0 || 
    empty($vehicle_type) || empty($amount_paid)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid email format']);
    exit();
}

// Validate date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tour_date)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid date format']);
    exit();
}

// Validate time format
if (!preg_match('/^\d{2}:\d{2}$/', $tour_time)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid time format']);
    exit();
}

// Validate amount is numeric
if (!is_numeric($amount_paid)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid amount format']);
    exit();
}

// Validate number of travellers
if ($number_of_travellers < 1 || $number_of_travellers > 50) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Number of travellers must be between 1 and 50']);
    exit();
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO tour_bookings (full_name, email, phone, tour_date, tour_time, places_to_visit, number_of_travellers, vehicle_type, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    exit();
}

$stmt->bind_param("ssssssids", $full_name, $email, $phone, $tour_date, $tour_time, $places_to_visit, $number_of_travellers, $vehicle_type, $amount_paid);

if ($stmt->execute()) {
    // Success response
    echo json_encode([
        'success' => true, 
        'message' => 'Tour booking submitted successfully!',
        'booking_id' => $conn->insert_id
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error saving booking: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?> 