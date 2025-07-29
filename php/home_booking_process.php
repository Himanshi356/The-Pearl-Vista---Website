<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
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

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating database']);
    exit();
}

// Select the database
$conn->select_db($dbname);

// Create home_bookings table if it doesn't exist (extended version for home page form)
$sql = "CREATE TABLE IF NOT EXISTS home_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    id_type VARCHAR(100),
    id_upload_path VARCHAR(500),
    num_rooms INT(11) NOT NULL DEFAULT 1,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_guests INT(11) NOT NULL DEFAULT 1,
    guest_ages TEXT,
    room_type VARCHAR(100) NOT NULL,
    total_amount DECIMAL(10,2) DEFAULT 0.00,
    special_instructions TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    booking_id VARCHAR(20) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating home_bookings table']);
    exit();
}



// Get form data from POST request
$customer_name = isset($_POST['name']) ? trim($_POST['name']) : '';
$customer_phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$customer_email = isset($_POST['email']) ? trim($_POST['email']) : '';
$id_type = isset($_POST['idType']) ? trim($_POST['idType']) : '';
$num_rooms = isset($_POST['rooms']) ? intval($_POST['rooms']) : 1;
$check_in_date = isset($_POST['checkin']) ? trim($_POST['checkin']) : '';
$check_out_date = isset($_POST['checkout']) ? trim($_POST['checkout']) : '';
$num_guests = isset($_POST['guests']) ? intval($_POST['guests']) : 1;
$guest_ages = isset($_POST['guestAges']) ? $_POST['guestAges'] : '';
$room_type = isset($_POST['roomType']) ? trim($_POST['roomType']) : '';



$total_amount = isset($_POST['totalAmount']) ? floatval(str_replace(['$', ','], '', $_POST['totalAmount'])) : 0.00;
$special_instructions = isset($_POST['specialInstructions']) ? trim($_POST['specialInstructions']) : '';

// Validate required fields
if (empty($customer_name) || empty($customer_phone) || empty($customer_email) || 
    empty($check_in_date) || empty($check_out_date) || empty($room_type)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields']);
    exit();
}

// Validate email format
if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address']);
    exit();
}

// Validate phone number (basic validation)
if (!preg_match('/^[0-9\-\+\s\(\)]{7,20}$/', $customer_phone)) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Please enter a valid phone number']);
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
$today->setTime(0, 0, 0); // Set to start of day for comparison

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

// Validate number of guests and rooms
if ($num_guests < 1 || $num_guests > 10) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Number of guests must be between 1 and 10']);
    exit();
}

if ($num_rooms < 1 || $num_rooms > 10) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Number of rooms must be between 1 and 10']);
    exit();
}

// Handle file upload if ID type is selected
$id_upload_path = '';
if (!empty($id_type) && isset($_FILES['idUpload']) && $_FILES['idUpload']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = dirname(__DIR__) . '/uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    $file_info = pathinfo($_FILES['idUpload']['name']);
    $file_extension = strtolower($file_info['extension']);
    
    // Validate file type
    $allowed_types = ['pdf', 'jpg', 'jpeg', 'png'];
    if (!in_array($file_extension, $allowed_types)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Only PDF and image files are allowed for ID upload']);
        exit();
    }
    
    // Validate file size (max 5MB)
    if ($_FILES['idUpload']['size'] > 5 * 1024 * 1024) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'File size must be less than 5MB']);
        exit();
    }
    
    // Generate unique filename
    $filename = 'id_' . time() . '_' . uniqid() . '.' . $file_extension;
    $upload_path = $upload_dir . $filename;
    
    if (move_uploaded_file($_FILES['idUpload']['tmp_name'], $upload_path)) {
        $id_upload_path = $upload_path;
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error uploading file']);
        exit();
    }
}

// Generate unique booking ID
$booking_id = 'PV' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);

// Check if booking ID already exists
$stmt = $conn->prepare("SELECT id FROM home_bookings WHERE booking_id = ?");
$stmt->bind_param("s", $booking_id);
$stmt->execute();
$result = $stmt->get_result();

// If booking ID exists, generate a new one
while ($result->num_rows > 0) {
    $booking_id = 'PV' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    $stmt->bind_param("s", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
}
$stmt->close();

// Insert booking into database
$stmt = $conn->prepare("INSERT INTO home_bookings (customer_name, customer_phone, customer_email, id_type, id_upload_path, num_rooms, check_in_date, check_out_date, num_guests, guest_ages, room_type, total_amount, special_instructions, booking_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error preparing statement: ' . $conn->error]);
    exit();
}

// Fix: Only total_amount should be 'd', all others 's'
$stmt->bind_param("sssssssssssdss", $customer_name, $customer_phone, $customer_email, $id_type, $id_upload_path, $num_rooms, $check_in_date, $check_out_date, $num_guests, $guest_ages, $room_type, $total_amount, $special_instructions, $booking_id);



if ($stmt->execute()) {
    $inserted_id = $conn->insert_id;
    
    // Calculate advance payment amount
    $advance_amount = $total_amount > 0 ? ($total_amount * 0.45) : 0;
    
    // Success response
    echo json_encode([
        'success' => true,
        'message' => 'Booking submitted successfully!',
        'booking_id' => $booking_id,
        'advance_amount' => number_format($advance_amount, 2),
        'details' => [
            'customer_name' => $customer_name,
            'customer_email' => $customer_email,
            'customer_phone' => $customer_phone,
            'room_type' => $room_type,
            'check_in_date' => $check_in_date,
            'check_out_date' => $check_out_date,
            'num_guests' => $num_guests,
            'num_rooms' => $num_rooms,
            'total_amount' => number_format($total_amount, 2),
            'special_instructions' => $special_instructions
        ]
    ]);
} else {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error saving booking: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?> 