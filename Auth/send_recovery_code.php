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

    $email = $input['email'] ?? '';

    if (empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
        exit;
    }

    // Check if user exists with this email
    $stmt = $pdo->prepare("SELECT user_id, username, email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['status' => 'error', 'message' => 'No user found with this email address.']);
        exit;
    }

    // Generate verification code
    $verification_code = rand(100000, 999999);

    // Update the user's verification code in the database
    $stmt = $pdo->prepare("UPDATE users SET verification_code = ? WHERE email = ?");
    $result = $stmt->execute([$verification_code, $email]);

    if ($result) {
        // Send email (simple mail example — needs real SMTP setup)
        $subject = "Account Recovery - Verification Code";
        $message = "Your verification code for account recovery is: $verification_code\n\n";
        $message .= "If you didn't request this code, please ignore this email.";
        
        mail($email, $subject, $message);
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Verification code sent to your email.',
            'email' => $email
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to send verification code.']);
    }

} catch (Exception $e) {
    error_log("Send recovery code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to send verification code: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal send recovery code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred while sending verification code.']);
}
?> 