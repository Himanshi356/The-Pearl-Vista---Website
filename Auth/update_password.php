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
    $new_password = $input['new_password'] ?? null;
    
    if (!$email || !$new_password) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email and new password are required'
        ]);
        exit();
    }
    
    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Update password in users table
    $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE email = ?");
    $result = $stmt->execute([$hashed_password, $email]);
    
    if ($result && $stmt->rowCount() > 0) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Password updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No user found with this email address'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Error updating password: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update password: ' . $e->getMessage()
    ]);
}
?> 