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

require_once '../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get data from request
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = $input['email'] ?? null;
    $username = $input['username'] ?? null;
    $admin_type = $input['admin_type'] ?? null;
    $new_password = $input['new_password'] ?? null;
    
    if (!$email || !$username || !$admin_type || !$new_password) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email, username, admin type, and new password are required'
        ]);
        exit();
    }
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update password based on admin type
    if ($admin_type === 'admins') {
        // Update password in admins table
        $stmt = $pdo->prepare("UPDATE admins SET password = ? WHERE email = ? AND username = ? AND is_active = 1");
        $result = $stmt->execute([$hashed_password, $email, $username]);
        
        if ($result && $stmt->rowCount() > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Admin password updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No active admin found with the provided credentials'
            ]);
        }
    } elseif ($admin_type === 'admin_users') {
        // Update password in admin_users table
        $stmt = $pdo->prepare("UPDATE admin_users SET password = ? WHERE email = ? AND username = ? AND is_active = 1 AND status = 'active'");
        $result = $stmt->execute([$hashed_password, $email, $username]);
        
        if ($result && $stmt->rowCount() > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Admin password updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'No active admin found with the provided credentials'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid admin type'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Error updating admin password: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update admin password: ' . $e->getMessage()
    ]);
}
?> 