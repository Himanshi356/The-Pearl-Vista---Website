<?php
// log_admin_activity.php
require_once '../../Config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin_id = $_POST['admin_id'] ?? '';
    $action = $_POST['action'] ?? '';
    $details = $_POST['details'] ?? '';
    if (!$admin_id || !$action) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit;
    }
    $stmt = $conn->prepare('INSERT INTO admin_activity_log (admin_id, action, details) VALUES (?, ?, ?)');
    $stmt->bind_param('iss', $admin_id, $action, $details);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Activity logged']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
} 