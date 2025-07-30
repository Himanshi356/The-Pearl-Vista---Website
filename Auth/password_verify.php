<?php
session_start();
header('Content-Type: application/json');
require_once '../Config/database.php';

$input = json_decode(file_get_contents('php://input'), true);
$username = trim($input['username'] ?? '');
$password = $input['password'] ?? '';

if (empty($username) || empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Username and password are required.']);
    exit;
}

// Fetch the hashed password from the database
$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Password is correct
    $_SESSION['user'] = $user['user_id'];
    echo json_encode(['status' => 'success', 'message' => 'Login successful!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
}