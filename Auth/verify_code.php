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
while (ob_get_level()) {
    ob_end_clean();
}

require_once '../Config/database.php';
$pdo = getDatabaseConnection();

try {
    $input = json_decode(file_get_contents('php://input'), true);
    $email = trim($input['email'] ?? '');
    $code = trim($input['code'] ?? '');

    if (empty($email) || empty($code)) {
        echo json_encode(['status' => 'error', 'message' => 'Email and code are required.']);
        exit;
    }

    // Check if the code matches for the given email
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND verification_code = ?");
    $stmt->execute([$email, $code]);

    if ($stmt->rowCount() > 0) {
        // Mark user as verified and remove verification code
        $update = $pdo->prepare("UPDATE users SET verification_code = NULL, verified = 1 WHERE email = ?");
        $update->execute([$email]);

        echo json_encode(['status' => 'success', 'message' => 'Email verified successfully!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid verification code.']);
    }
} catch (Exception $e) {
    error_log("Verify code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Verification failed: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal verify code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred during verification.']);
}
