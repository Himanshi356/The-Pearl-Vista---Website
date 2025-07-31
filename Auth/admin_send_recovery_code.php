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

    $email = $input['email'] ?? '';
    $username = $input['username'] ?? '';

    if (empty($email) || empty($username)) {
        echo json_encode(['status' => 'error', 'message' => 'Email and username are required.']);
        exit;
    }

    // First check admins table
    $stmt = $pdo->prepare("SELECT admin_id, username, email FROM admins WHERE username = ? AND email = ? AND is_active = 1");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        // Generate verification code
        $verification_code = rand(100000, 999999);

        // Update the admin's verification code in the database
        $stmt = $pdo->prepare("UPDATE admins SET verification_code = ? WHERE admin_id = ?");
        $result = $stmt->execute([$verification_code, $admin['admin_id']]);

        if ($result) {
            // Send email (simple mail example — needs real SMTP setup)
            $subject = "Admin Password Recovery - Verification Code";
            $message = "Your verification code for admin password recovery is: $verification_code\n\n";
            $message .= "If you didn't request this code, please ignore this email.";
            
            mail($email, $subject, $message);
            
            echo json_encode([
                'status' => 'success', 
                'message' => 'Verification code sent to your admin email.',
                'email' => $email
            ]);
            exit;
        }
    }

    // If not found in admins table, check admin_users table
    $stmt = $pdo->prepare("SELECT admin_id, username, email FROM admin_users WHERE username = ? AND email = ? AND is_active = 1 AND status = 'active'");
    $stmt->execute([$username, $email]);
    $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($adminUser) {
        // Generate verification code
        $verification_code = rand(100000, 999999);

        // Update the admin's verification code in the database
        $stmt = $pdo->prepare("UPDATE admin_users SET verification_code = ? WHERE admin_id = ?");
        $result = $stmt->execute([$verification_code, $adminUser['admin_id']]);

        if ($result) {
            // Send email (simple mail example — needs real SMTP setup)
            $subject = "Admin Password Recovery - Verification Code";
            $message = "Your verification code for admin password recovery is: $verification_code\n\n";
            $message .= "If you didn't request this code, please ignore this email.";
            
            mail($email, $subject, $message);
            
            echo json_encode([
                'status' => 'success', 
                'message' => 'Verification code sent to your admin email.',
                'email' => $email
            ]);
            exit;
        }
    }

    // If no admin found
    echo json_encode(['status' => 'error', 'message' => 'No active admin found with the provided username and email.']);

} catch (Exception $e) {
    error_log("Admin send recovery code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Failed to send verification code: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal admin send recovery code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred while sending verification code.']);
}
?> 