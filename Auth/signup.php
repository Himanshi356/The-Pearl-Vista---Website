<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();

// Add CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Ensure clean output
ob_clean();

try {
    require_once '../Config/database.php';
    require_once 'email_helper.php';
    require_once 'email_template.php';
    $pdo = getDatabaseConnection();

    $input = json_decode(file_get_contents('php://input'), true);
    
    // Log the received data
    error_log("Received signup data: " . json_encode($input));
    
    $user_id = trim($input['user_id'] ?? '');
    $username = trim($input['username'] ?? '');
    $email = trim($input['email'] ?? '');
    $security_question = $input['security_question'] ?? '';
    $security_answer = trim($input['security_answer'] ?? '');
    
    if (empty($user_id) || empty($username) || empty($email) || empty($security_question) || empty($security_answer)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }
    
    // Validate user_id is numeric and 6 digits
    if (!is_numeric($user_id) || strlen($user_id) !== 6) {
        echo json_encode(['status' => 'error', 'message' => 'User ID must be a 6-digit number (e.g., 123456).']);
        exit;
    }
    
    // Convert user_id to integer
    $user_id = (int)$user_id;
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
        exit;
    }
    
    // Check if user_id or username already exists
    error_log('Checking for existing user: ' . $user_id . ', ' . $username);
    $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ? OR username = ?");
    $stmt->execute([$user_id, $username]);
    error_log('Row count: ' . $stmt->rowCount());
    
    if ($stmt->rowCount() > 0) {
        echo json_encode(['status' => 'error', 'message' => 'User ID or username already registered.']);
        exit;
    }
    
    // Generate verification code
    $verification_code = rand(100000, 999999);

    // Insert into DB
    $stmt = $pdo->prepare("INSERT INTO users (user_id, username, email, security_question, security_answer, verification_code, role) VALUES (?, ?, ?, ?, ?, ?, 'user')");
    $result = $stmt->execute([$user_id, $username, $email, $security_question, $security_answer, $verification_code]);
    
    if ($result && $stmt->rowCount() > 0) {
        // Save verification email as HTML file
        $email_file = saveVerificationEmail($email, $verification_code, $username);
        
        // Also log the verification code for debugging
        sendVerificationEmail($email, $verification_code);
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Verification code sent to email.', 
            'debug_code' => $verification_code,
            'email_file' => basename($email_file)
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Registration failed. Database error.']);
    }
    
} catch (Exception $e) {
    error_log("Signup error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Registration failed: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal signup error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred during registration.']);
}
