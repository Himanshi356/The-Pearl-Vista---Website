<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();

// Ensure clean output
while (ob_get_level()) {
    ob_end_clean();
}

header('Content-Type: application/json');

try {
    require_once '../Config/database.php';
    $pdo = getDatabaseConnection();

    $input = json_decode(file_get_contents('php://input'), true);

    $username = $input['username'] ?? '';
    $email = $input['email'] ?? '';
    $security_question = $input['security_question'] ?? '';
    $security_answer = $input['security_answer'] ?? '';

    if (empty($username) || empty($email) || empty($security_question) || empty($security_answer)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Check if user exists with the provided username and email
    $stmt = $pdo->prepare("SELECT user_id, username, email, security_question, security_answer FROM users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'No user found with the provided username and email.']);
        exit;
    }

    // Check if security question and answer match
    if ($user['security_question'] !== $security_question || 
        strtolower(trim($user['security_answer'])) !== strtolower(trim($security_answer))) {
        echo json_encode(['status' => 'error', 'message' => 'Security question or answer is incorrect.']);
        exit;
    }

    // If all validations pass, redirect to password reset page
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