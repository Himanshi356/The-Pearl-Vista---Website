<?php
// add_admin.php
require_once '../../Config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $name = $_POST['name'] ?? '';
    $role = $_POST['role'] ?? 'admin';

    if (!$username || !$password || !$name) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare('INSERT INTO admin_users (username, password, name, role) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $username, $hash, $name, $role);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Admin user added']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
} 