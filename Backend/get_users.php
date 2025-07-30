<?php
session_start();
header('Content-Type: application/json');
require_once '../../Config/database.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->query("SELECT user_id, username, email, verified FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['users' => $users]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

