<?php
session_start();
header('Content-Type: application/json');
require_once '../Config/database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user'];

$stmt = $pdo->prepare("SELECT u.user_id, u.username, u.email, u.role, i.full_name, i.dob, i.gender, i.address, i.city, i.state, i.country, i.postal_code, i.phone, i.profile_picture
    FROM users u
    LEFT JOIN user_info i ON u.user_id = i.user_id
    WHERE u.user_id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    echo json_encode(['status' => 'success', 'user' => $user]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'User not found']);
}

