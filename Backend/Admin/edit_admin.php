<?php
// edit_admin.php
require_once '../../Config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $name = $_POST['name'] ?? '';
    $role = $_POST['role'] ?? 'admin';
    $status = $_POST['status'] ?? 'active';
    $password = $_POST['password'] ?? '';

    if (!$id || !$username || !$name) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }

    if ($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('UPDATE admin_users SET username=?, name=?, role=?, status=?, password=? WHERE id=?');
        $stmt->bind_param('sssssi', $username, $name, $role, $status, $hash, $id);
    } else {
        $stmt = $conn->prepare('UPDATE admin_users SET username=?, name=?, role=?, status=? WHERE id=?');
        $stmt->bind_param('ssssi', $username, $name, $role, $status, $id);
    }
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Admin user updated']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
} 