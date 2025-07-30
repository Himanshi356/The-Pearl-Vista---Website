<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session to check user authentication
session_start();

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

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Authentication required. Please login to book services.']);
    exit();
}

// Verify user exists in database
require_once '../Config/database.php';
try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("SELECT user_id, username, email FROM users WHERE user_id = ?");
    $stmt->execute([$_SESSION['user']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        http_response_code(401);
        echo json_encode(['status' => 'error', 'message' => 'Invalid user session. Please login again.']);
        exit();
    }
    
    // Store user info for booking
    $logged_in_user_id = $user['user_id'];
    $logged_in_username = $user['username'];
    $logged_in_email = $user['email'];
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error while verifying user.']);
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
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]);
    exit();
}

// Create booking_services table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS booking_services (
    booking_service_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    room_id INT DEFAULT NULL,
    booking_id INT DEFAULT NULL,
    service_category VARCHAR(100) NOT NULL,
    service_name VARCHAR(255) NOT NULL,
    service_price DECIMAL(10,2) NOT NULL,
    booking_date DATE,
    booking_time TIME,
    number_of_people INT DEFAULT 1,
    special_instructions TEXT,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('booked', 'confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'booked',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
)";

if (!$conn->query($sql)) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Error creating table: ' . $conn->error]);
    exit();
}

// Handle POST request for service booking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $service_category = trim($_POST['service_category'] ?? '');
    $service_name = trim($_POST['service_name'] ?? '');
    $service_price = floatval($_POST['service_price'] ?? 0);
    $booking_date = $_POST['booking_date'] ?? '';
    $booking_time = $_POST['booking_time'] ?? '';
    $number_of_people = intval($_POST['number_of_people'] ?? 1);
    $special_instructions = trim($_POST['special_instructions'] ?? '');
    $total_amount = floatval($_POST['total_amount'] ?? 0);
    
    // Validation
    if (empty($service_category) || empty($service_name) || empty($booking_date) || empty($booking_time)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Required fields: Service Category, Service Name, Booking Date, and Booking Time are required.']);
        exit();
    }
    
    // Validate date (must be today or future)
    $today = date('Y-m-d');
    if ($booking_date < $today) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Booking date cannot be in the past.']);
        exit();
    }
    
    // Validate time format
    if (!preg_match('/^([01]?[0-9]|2[0-3]):[0-5][0-9]$/', $booking_time)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid time format. Use HH:MM format.']);
        exit();
    }
    
    // Validate number of people
    if ($number_of_people < 1 || $number_of_people > 50) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Number of people must be between 1 and 50.']);
        exit();
    }
    
    // Validate price
    if ($service_price < 0) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Service price cannot be negative.']);
        exit();
    }
    
    // Calculate total amount if not provided
    if ($total_amount <= 0) {
        $total_amount = $service_price * $number_of_people;
    }
    
    // Generate unique booking service ID
    $booking_service_id = 'BS' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
    
    // Check if booking service ID already exists
    $stmt = $conn->prepare("SELECT booking_service_id FROM booking_services WHERE booking_service_id = ?");
    $stmt->bind_param("s", $booking_service_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // If booking service ID exists, generate a new one
    while ($result->num_rows > 0) {
        $booking_service_id = 'BS' . date('Y') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $stmt->bind_param("s", $booking_service_id);
        $stmt->execute();
        $result = $stmt->get_result();
    }
    $stmt->close();
    
    // Insert service booking into database
    $stmt = $conn->prepare("INSERT INTO booking_services (user_id, service_category, service_name, service_price, booking_date, booking_time, number_of_people, special_instructions, total_amount, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'booked')");
    
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error preparing statement: ' . $conn->error]);
        exit();
    }
    
    $stmt->bind_param("issdssids", $logged_in_user_id, $service_category, $service_name, $service_price, $booking_date, $booking_time, $number_of_people, $special_instructions, $total_amount);
    
    if ($stmt->execute()) {
        $inserted_id = $conn->insert_id;
        
        // Log the booking activity
        error_log("Service booking created by user: $logged_in_username (ID: $logged_in_user_id) - Service: $service_name ($service_category) - Date: $booking_date $booking_time - Total: $total_amount");
        
        // Success response
        echo json_encode([
            'status' => 'success',
            'message' => 'Service booked successfully!',
            'booking_service_id' => $booking_service_id,
            'data' => [
                'user_id' => $logged_in_user_id,
                'username' => $logged_in_username,
                'service_category' => $service_category,
                'service_name' => $service_name,
                'service_price' => number_format($service_price, 2),
                'booking_date' => $booking_date,
                'booking_time' => $booking_time,
                'number_of_people' => $number_of_people,
                'special_instructions' => $special_instructions,
                'total_amount' => number_format($total_amount, 2),
                'status' => 'booked'
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error saving service booking: ' . $stmt->error]);
    }
    
    $stmt->close();
} else {
    // Handle GET request to retrieve service bookings
    if (isset($_GET['user_id'])) {
        $user_id = intval($_GET['user_id']);
        
        // Verify the user is requesting their own bookings or is admin
        if ($user_id != $logged_in_user_id) {
            // Check if user is admin
            $stmt = $pdo->prepare("SELECT role FROM users WHERE user_id = ?");
            $stmt->execute([$logged_in_user_id]);
            $user_role = $stmt->fetchColumn();
            
            if ($user_role !== 'admin') {
                http_response_code(403);
                echo json_encode(['status' => 'error', 'message' => 'Access denied.']);
                exit();
            }
        }
        
        $stmt = $conn->prepare("SELECT * FROM booking_services WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $bookings = [];
        while ($row = $result->fetch_assoc()) {
            $bookings[] = $row;
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Service bookings retrieved successfully',
            'data' => $bookings
        ]);
        
        $stmt->close();
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'User ID parameter required for GET requests.']);
    }
}

$conn->close();
?>
