<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
ob_clean();
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

try {
    $pdo = getDatabaseConnection();
    
    // Check if it's an admin session
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        // Admin user - query admins table
        $stmt = $pdo->prepare("SELECT admin_id, admin_code, username, email, first_name, last_name, department, position, role FROM admins WHERE admin_id = ?");
        $stmt->execute([$_SESSION['user']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Format full name for admin
            if (!empty($user['first_name']) && !empty($user['last_name'])) {
                $user['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
            } else {
                $user['full_name'] = $user['username'];
            }
            
            // Add user_id for consistency with regular users
            $user['user_id'] = $user['admin_id'];
            
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'Admin not found']);
        }
    } else {
        // Regular user - query users table
        $stmt = $pdo->prepare("SELECT id, user_id, username, email, phone, first_name, last_name, role FROM users WHERE user_id = ?");
        $stmt->execute([$_SESSION['user']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            // Format full name if first_name and last_name are available
            if (!empty($user['first_name']) && !empty($user['last_name'])) {
                $user['full_name'] = $user['first_name'] . ' ' . $user['last_name'];
            } else {
                $user['full_name'] = $user['username'];
            }
            
            echo json_encode($user);
        } else {
            echo json_encode(['error' => 'User not found']);
        }
    }
} catch (Exception $e) {
    error_log("get_current_user.php error: " . $e->getMessage());
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?> 