<?php
// Service Booking Process - Backend Handler
// This file handles service booking form submissions from services.html

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 0); // Disable display_errors to prevent output before JSON

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

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

// Database configuration
$host = 'localhost';
$dbname = 'pearlvista';
$username = 'root';
$password = '';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if service_bookings table exists, if not create it
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS service_bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id VARCHAR(50) UNIQUE NOT NULL,
            user_id VARCHAR(100),
            username VARCHAR(100),
            selected_services JSON NOT NULL,
            service_category VARCHAR(50),
            service_date DATE NOT NULL,
            service_time TIME NOT NULL,
            guest_count INT NOT NULL,
            special_requirements TEXT,
            phone_number VARCHAR(20) NOT NULL,
            email VARCHAR(100) NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            additional_services JSON,
            booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ");
    
    // Extract and validate form data
    $bookingId = $input['bookingId'] ?? 'SPV-' . time() . '-' . substr(md5(uniqid()), 0, 9);
    $selectedServices = $input['selectedServices'] ?? [];
    $serviceCategory = $input['serviceCategory'] ?? '';
    $serviceDate = $input['serviceDate'] ?? '';
    $serviceTime = $input['serviceTime'] ?? '';
    $guestCount = intval($input['guestCount'] ?? 1);
    $specialRequirements = $input['specialRequirements'] ?? '';
    $phoneNumber = $input['phoneNumber'] ?? '';
    $email = $input['email'] ?? '';
    $totalAmount = floatval($input['totalAmount'] ?? 0);
    $additionalServices = $input['additionalServices'] ?? [];
    
    // Get user information from session or input
    $userId = $input['userId'] ?? '';
    $username = $input['username'] ?? 'Guest';
    
    // Validate required fields
    $errors = [];
    
    if (empty($selectedServices)) {
        $errors[] = 'At least one service must be selected';
    }
    
    if (empty($serviceDate)) {
        $errors[] = 'Service date is required';
    }
    
    if (empty($serviceTime)) {
        $errors[] = 'Service time is required';
    }
    
    if (empty($phoneNumber)) {
        $errors[] = 'Phone number is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if ($guestCount < 1 || $guestCount > 50) {
        $errors[] = 'Guest count must be between 1 and 50';
    }
    
    // Validate date is not in the past
    $selectedDate = new DateTime($serviceDate);
    $today = new DateTime();
    $today->setTime(0, 0, 0);
    
    if ($selectedDate < $today) {
        $errors[] = 'Service date cannot be in the past';
    }
    
    // If there are validation errors, return them
    if (!empty($errors)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $errors
        ]);
        exit;
    }
    
    // Prepare SQL statement
    $sql = "INSERT INTO service_bookings (
        booking_id, user_id, username, selected_services, service_category, 
        service_date, service_time, guest_count, special_requirements, 
        phone_number, email, total_amount, additional_services
    ) VALUES (
        :booking_id, :user_id, :username, :selected_services, :service_category,
        :service_date, :service_time, :guest_count, :special_requirements,
        :phone_number, :email, :total_amount, :additional_services
    )";
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    $stmt->bindParam(':booking_id', $bookingId);
    $stmt->bindParam(':user_id', $userId);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':selected_services', json_encode($selectedServices));
    $stmt->bindParam(':service_category', $serviceCategory);
    $stmt->bindParam(':service_date', $serviceDate);
    $stmt->bindParam(':service_time', $serviceTime);
    $stmt->bindParam(':guest_count', $guestCount);
    $stmt->bindParam(':special_requirements', $specialRequirements);
    $stmt->bindParam(':phone_number', $phoneNumber);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':total_amount', $totalAmount);
    $stmt->bindParam(':additional_services', json_encode($additionalServices));
    
    // Execute the statement
    $stmt->execute();
    
    // Get the inserted ID
    $insertedId = $pdo->lastInsertId();
    
    // Prepare response data
    $responseData = [
        'success' => true,
        'message' => 'Service booking submitted successfully',
        'booking_id' => $bookingId,
        'booking_data' => [
            'id' => $insertedId,
            'booking_id' => $bookingId,
            'selected_services' => $selectedServices,
            'service_category' => $serviceCategory,
            'service_date' => $serviceDate,
            'service_time' => $serviceTime,
            'guest_count' => $guestCount,
            'total_amount' => $totalAmount,
            'additional_services' => $additionalServices,
            'status' => 'pending'
        ]
    ];
    
    // Log the booking for debugging
    error_log("Service booking created: " . json_encode($responseData));
    
    // Return success response
    echo json_encode($responseData);
    
} catch (PDOException $e) {
    // Log the error
    error_log("Database error in service_booking_process.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred',
        'error' => $e->getMessage()
    ]);
    
} catch (Exception $e) {
    // Log the error
    error_log("General error in service_booking_process.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while processing your booking',
        'error' => $e->getMessage()
    ]);
}

// Ensure no output after JSON response
exit;
?> 