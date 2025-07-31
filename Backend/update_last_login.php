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
    
    // Get user email from request
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? null;
    
    if (!$email) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email is required'
        ]);
        exit();
    }
    
    // Get user_id
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found'
        ]);
        exit();
    }
    
    $user_id = $user['id'];
    
    // Update last_login in user_details table
    $stmt = $pdo->prepare("UPDATE user_details SET last_login = CURRENT_TIMESTAMP WHERE user_id = ?");
    $result = $stmt->execute([$user_id]);
    
    if (!$result) {
        // If user_details doesn't exist, create it
        $stmt = $pdo->prepare("INSERT INTO user_details (user_id, last_login) VALUES (?, CURRENT_TIMESTAMP)");
        $result = $stmt->execute([$user_id]);
    }
    
    if ($result) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Last login updated successfully'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update last login'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Error updating last login: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update last login'
    ]);
}
?> 