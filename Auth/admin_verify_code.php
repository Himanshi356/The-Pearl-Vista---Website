<?php
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
    $username = trim($input['username'] ?? '');

    if (empty($email) || empty($code) || empty($username)) {
        echo json_encode(['status' => 'error', 'message' => 'Email, code, and username are required.']);
        exit;
    }

    // Check the latest admin verification HTML file for the correct code
    $emails_dir = '../emails';
    $files = glob($emails_dir . '/admin_verification_*.html');
    
    if (empty($files)) {
        echo json_encode(['status' => 'error', 'message' => 'No verification email found. Please request a new code.']);
        exit;
    }
    
    // Get the latest file
    $latest_file = end($files);
    $file_content = file_get_contents($latest_file);
    
    // Extract the verification code from the HTML file
    if (preg_match('/<div class="verification-code">(\d+)<\/div>/', $file_content, $matches)) {
        $correct_code = $matches[1];
        
        // Check if the provided code matches the one in the HTML file
        if ($code === $correct_code) {
            // Find which table the admin is in
            $admin_type = null;
            
            // Check admins table
            $stmt = $pdo->prepare("SELECT admin_id FROM admins WHERE email = ? AND username = ? AND is_active = 1");
            $stmt->execute([$email, $username]);
            
            if ($stmt->rowCount() > 0) {
                $admin_type = 'admins';
                // Clear verification code from database
                $update = $pdo->prepare("UPDATE admins SET verification_code = NULL WHERE email = ? AND username = ?");
                $update->execute([$email, $username]);
            } else {
                // Check admin_users table
                $stmt = $pdo->prepare("SELECT admin_id FROM admin_users WHERE email = ? AND username = ? AND is_active = 1 AND status = 'active'");
                $stmt->execute([$email, $username]);
                
                if ($stmt->rowCount() > 0) {
                    $admin_type = 'admin_users';
                    // Clear verification code from database
                    $update = $pdo->prepare("UPDATE admin_users SET verification_code = NULL WHERE email = ? AND username = ?");
                    $update->execute([$email, $username]);
                }
            }
            
            if ($admin_type) {
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Admin email verified successfully!',
                    'admin_type' => $admin_type
                ]);
                exit;
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Admin not found.']);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid verification code.']);
            exit;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Could not find verification code in email file.']);
        exit;
    }

} catch (Exception $e) {
    error_log("Admin verify code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Verification failed: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal admin verify code error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred during verification.']);
}
?> 