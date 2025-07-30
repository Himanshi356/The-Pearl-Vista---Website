<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';
$pdo = getDatabaseConnection();

try {
    $email = trim($_GET['email'] ?? '');

    if (empty($email)) {
        echo json_encode(['status' => 'error', 'message' => 'Email is required.']);
        exit;
    }

    $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode(['status' => 'success', 'user_id' => $user['user_id']]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'User not found.']);
    }
} catch (Exception $e) {
    error_log("Get user ID error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Failed to get user ID.']);
}

