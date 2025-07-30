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
$dbname = "the_pearl_vista";

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

// Create room_availability table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS room_availability (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(100) NOT NULL,
    total_rooms INT(11) NOT NULL DEFAULT 10,
    available_rooms INT(11) NOT NULL DEFAULT 10,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_room_type (room_type),
    INDEX idx_dates (check_in_date, check_out_date)
)";

if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating room_availability table']);
    exit();
}

// Get form data
$checkin_date = isset($_POST['checkinDate']) ? trim($_POST['checkinDate']) : '';
$checkout_date = isset($_POST['checkoutDate']) ? trim($_POST['checkoutDate']) : '';
$guests = isset($_POST['guests']) ? intval($_POST['guests']) : 0;
$room_type = isset($_POST['roomType']) ? trim($_POST['roomType']) : '';
$num_rooms = isset($_POST['numRooms']) ? intval($_POST['numRooms']) : 0;

// Validate required fields
if (empty($checkin_date) || empty($checkout_date) || $guests <= 0 || empty($room_type) || $num_rooms <= 0) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'All fields are required']);
    exit();
}

// Validate date format
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $checkin_date) || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $checkout_date)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid date format']);
    exit();
}

// Validate dates
$checkin = new DateTime($checkin_date);
$checkout = new DateTime($checkout_date);
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

// Check if availability record exists for this room type and date range
$stmt = $conn->prepare("SELECT * FROM room_availability WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
$stmt->bind_param("sss", $room_type, $checkin_date, $checkout_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Record exists, check availability
    $availability = $result->fetch_assoc();
    $available_rooms = $availability['available_rooms'];
} else {
    // No record exists, create default availability (10 rooms available)
    $stmt = $conn->prepare("INSERT INTO room_availability (room_type, total_rooms, available_rooms, check_in_date, check_out_date) VALUES (?, 10, 10, ?, ?)");
    $stmt->bind_param("sss", $room_type, $checkin_date, $checkout_date);
    $stmt->execute();
    $available_rooms = 10;
}

// Check if requested rooms are available
$is_available = $available_rooms >= $num_rooms;

// Calculate pricing based on room type and duration
$duration = $checkin->diff($checkout)->days;
$base_prices = [
    'Pearl Signature Room' => 500,
    'Deluxe Room' => 400,
    'Premium Room' => 350,
    'Executive Room' => 450,
    'Luxury Suite' => 800,
    'Family Suite' => 600
];

$base_price = isset($base_prices[$room_type]) ? $base_prices[$room_type] : 400;
$total_amount = $base_price * $duration * $num_rooms;

// Add guest surcharge if more than 2 guests per room
$guest_surcharge = 0;
if ($guests > ($num_rooms * 2)) {
    $extra_guests = $guests - ($num_rooms * 2);
    $guest_surcharge = $extra_guests * 50 * $duration;
    $total_amount += $guest_surcharge;
}

$response = [
    'success' => true,
    'available' => $is_available,
    'available_rooms' => $available_rooms,
    'requested_rooms' => $num_rooms,
    'room_type' => $room_type,
    'check_in_date' => $checkin_date,
    'check_out_date' => $checkout_date,
    'duration' => $duration,
    'guests' => $guests,
    'base_price_per_night' => $base_price,
    'total_amount' => $total_amount,
    'guest_surcharge' => $guest_surcharge,
    'message' => $is_available 
        ? "Great! {$num_rooms} {$room_type}(s) are available for your selected dates."
        : "Sorry, only {$available_rooms} {$room_type}(s) are available for your selected dates."
];

echo json_encode($response);

$stmt->close();
$conn->close();
?> 