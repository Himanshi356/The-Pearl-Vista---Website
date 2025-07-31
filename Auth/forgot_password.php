<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();

// Add CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Ensure clean output
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json');

try {
    require_once '../Config/database.php';
    $pdo = getDatabaseConnection();

    $input = json_decode(file_get_contents('php://input'), true);

    // Log the received data for debugging
    error_log("Forgot password request received: " . json_encode($input));

    $username = trim($input['username'] ?? '');
    $email = trim($input['email'] ?? '');
    $security_question = $input['security_question'] ?? '';
    $security_answer = trim($input['security_answer'] ?? '');

    if (empty($username) || empty($email) || empty($security_question) || empty($security_answer)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Check if user exists with the provided username and email
    $stmt = $pdo->prepare("SELECT user_id, username, email, security_question, security_answer FROM users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        error_log("No user found for username: $username, email: $email");
        echo json_encode(['status' => 'error', 'message' => 'No user found with the provided username and email.']);
        exit;
    }

    error_log("User found: " . json_encode($user));

    // Check if security question and answer match
    $stored_question = $user['security_question'];
    $stored_answer = strtolower(trim($user['security_answer']));
    $provided_answer = strtolower(trim($security_answer));
    
    error_log("Security check - Stored Q: '$stored_question', Provided Q: '$security_question'");
    error_log("Security check - Stored A: '$stored_answer', Provided A: '$provided_answer'");

    if ($stored_question !== $security_question) {
        error_log("Security question mismatch");
        echo json_encode(['status' => 'error', 'message' => 'Security question or answer is incorrect.']);
        exit;
    }

    // More robust answer comparison - handle various edge cases
    $stored_clean = preg_replace('/\s+/', ' ', strtolower(trim($stored_answer)));
    $provided_clean = preg_replace('/\s+/', ' ', strtolower(trim($provided_answer)));
    
    if ($stored_clean !== $provided_clean) {
        error_log("Security answer mismatch - Stored: '$stored_clean', Provided: '$provided_clean'");
        echo json_encode(['status' => 'error', 'message' => 'Security question or answer is incorrect.']);
        exit;
    }

    // If all validations pass, redirect to password reset page
    error_log("Account recovery successful for user: $username");
    echo json_encode([
        'status' => 'success', 
        'message' => 'Account verification successful. You can now reset your password.',
        'email' => $user['email']
    ]);

} catch (Exception $e) {
    error_log("Forgot password error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Account recovery failed: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal forgot password error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred during account recovery.']);
}
?> 