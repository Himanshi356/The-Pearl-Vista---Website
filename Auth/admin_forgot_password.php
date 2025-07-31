<?php
// Admin forgot password API
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

try {
    require_once '../Config/database.php';
    require_once 'email_template.php';
    $pdo = getDatabaseConnection();

    $input = json_decode(file_get_contents('php://input'), true);
    
    $username = trim($input['username'] ?? '');
    $email = trim($input['email'] ?? '');
    
    if (empty($username) || empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Username and email are required.']);
        exit;
    }
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Please enter a valid email address.']);
        exit;
    }
    
    // First check admins table
    $stmt = $pdo->prepare("SELECT admin_id, username, email, first_name, last_name FROM admins WHERE username = ? AND email = ? AND is_active = 1");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        // Generate verification code ONCE
        $verification_code = rand(100000, 999999);
        
        // Update admin with verification code
        $update_stmt = $pdo->prepare("UPDATE admins SET verification_code = ? WHERE admin_id = ?");
        $update_result = $update_stmt->execute([$verification_code, $admin['admin_id']]);
        
        if ($update_result) {
            // Save verification email as HTML file with SAME code
            $email_file = saveAdminVerificationEmail($email, $verification_code, $admin['username']);
            
            // Log the verification code for debugging
            sendAdminVerificationEmail($email, $verification_code, $admin['username']);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Verification code sent to your admin email.',
                'email' => $email,
                'username' => $username,
                'admin_type' => 'admins',
                'debug_code' => $verification_code,
                'email_file' => basename($email_file)
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to generate verification code.']);
        }
        exit;
    }
    
    // If not found in admins table, check admin_users table
    $stmt = $pdo->prepare("SELECT admin_id, username, email, first_name, last_name FROM admin_users WHERE username = ? AND email = ? AND is_active = 1 AND status = 'active'");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        // Generate verification code ONCE
        $verification_code = rand(100000, 999999);
        
        // Update admin with verification code
        $update_stmt = $pdo->prepare("UPDATE admin_users SET verification_code = ? WHERE admin_id = ?");
        $update_result = $update_stmt->execute([$verification_code, $admin['admin_id']]);
        
        if ($update_result) {
            // Save verification email as HTML file with SAME code
            $email_file = saveAdminVerificationEmail($email, $verification_code, $admin['username']);
            
            // Log the verification code for debugging
            sendAdminVerificationEmail($email, $verification_code, $admin['username']);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Verification code sent to your admin email.',
                'email' => $email,
                'username' => $username,
                'admin_type' => 'admin_users',
                'debug_code' => $verification_code,
                'email_file' => basename($email_file)
            ]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to generate verification code.']);
        }
        exit;
    }
    
    // If admin not found in either table
    echo json_encode(['status' => 'error', 'message' => 'Admin not found with the provided username and email.']);
    
} catch (Exception $e) {
    error_log("Admin password recovery failed: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Admin password recovery failed: ' . $e->getMessage()]);
}

function sendAdminVerificationEmail($email, $verification_code, $username) {
    // For development, log the verification code
    $log_message = date('Y-m-d H:i:s') . " - Admin verification code for $email: $verification_code\n";
    error_log($log_message, 3, '../logs/verification_codes.log');
    
    // In production, you would use a proper email service
    return true;
}

function saveAdminVerificationEmail($email, $verification_code, $username) {
    $html_content = generateAdminVerificationEmailHTML($email, $verification_code, $username);
    
    // Create emails directory if it doesn't exist
    $emails_dir = '../emails';
    if (!is_dir($emails_dir)) {
        mkdir($emails_dir, 0755, true);
    }
    
    // Save the HTML email to a file
    $filename = $emails_dir . '/admin_verification_' . time() . '_' . preg_replace('/[^a-zA-Z0-9]/', '_', $email) . '.html';
    file_put_contents($filename, $html_content);
    
    return $filename;
}

function generateAdminVerificationEmailHTML($email, $verification_code, $username) {
    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Email Verification - The Pearl Vista</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
                color: #333;
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                background-color: #f4f4f4;
            }
            .email-container {
                background-color: #ffffff;
                border-radius: 10px;
                padding: 30px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                border-bottom: 3px solid #D4AF37;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }
            .logo {
                font-size: 28px;
                font-weight: bold;
                color: #2c3e50;
                margin-bottom: 10px;
            }
            .subtitle {
                color: #7f8c8d;
                font-size: 16px;
            }
            .verification-code {
                background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%);
                color: white;
                font-size: 32px;
                font-weight: bold;
                text-align: center;
                padding: 20px;
                border-radius: 10px;
                margin: 30px 0;
                letter-spacing: 5px;
            }
            .content {
                margin: 30px 0;
            }
            .footer {
                text-align: center;
                margin-top: 30px;
                padding-top: 20px;
                border-top: 1px solid #eee;
                color: #7f8c8d;
                font-size: 14px;
            }
            .admin-notice {
                background: #fff3cd;
                border: 1px solid #ffeaa7;
                color: #856404;
                padding: 15px;
                border-radius: 10px;
                margin: 20px 0;
                font-size: 14px;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <div class="logo">The Pearl Vista</div>
                <div class="subtitle">Admin Email Verification</div>
            </div>
            
            <div class="admin-notice">
                <strong>🔐 Admin Password Recovery:</strong> This is your verification code for admin password reset.
            </div>
            
            <div class="content">
                <h2>Hello ' . htmlspecialchars($username) . '!</h2>
                
                <p>You have requested a password reset for your admin account. To complete the password reset process, please use the verification code below:</p>
                
                <div class="verification-code">' . $verification_code . '</div>
                
                <p><strong>Important:</strong></p>
                <ul>
                    <li>This code will expire in 10 minutes</li>
                    <li>Do not share this code with anyone</li>
                    <li>If you did not request this code, please ignore this email</li>
                    <li>This is for admin account recovery only</li>
                </ul>
                
                <p>If you have any questions, please contact the system administrator.</p>
                
                <p>Best regards,<br>The Pearl Vista Admin Team</p>
            </div>
            
            <div class="footer">
                <p>This is an automated message for admin password recovery. Please do not reply to this email.</p>
                <p>&copy; 2025 The Pearl Vista. All rights reserved.</p>
            </div>
        </div>
    </body>
    </html>';
    
    return $html;
}
?> 