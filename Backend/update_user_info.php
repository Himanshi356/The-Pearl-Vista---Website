<?php
session_start();
header('Content-Type: application/json');
require_once '../Config/database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user'];
$data = json_decode(file_get_contents('php://input'), true);

// Example fields (add more as needed)
$full_name = trim($data['full_name'] ?? '');
$dob = $data['dob'] ?? null;
$gender = $data['gender'] ?? null;
$address = trim($data['address'] ?? '');
$city = trim($data['city'] ?? '');
$state = trim($data['state'] ?? '');
$country = trim($data['country'] ?? '');
$postal_code = trim($data['postal_code'] ?? '');
$phone = trim($data['phone'] ?? '');

$stmt = $pdo->prepare("SELECT id FROM user_info WHERE user_id = ?");
$stmt->execute([$user_id]);
$exists = $stmt->fetchColumn();

if ($exists) {
    // Update
    $stmt = $pdo->prepare("UPDATE user_info SET full_name=?, dob=?, gender=?, address=?, city=?, state=?, country=?, postal_code=?, phone=?, updated_at=NOW() WHERE user_id=?");
    $result = $stmt->execute([$full_name, $dob, $gender, $address, $city, $state, $country, $postal_code, $phone, $user_id]);
} else {
    // Insert
    $stmt = $pdo->prepare("INSERT INTO user_info (user_id, full_name, dob, gender, address, city, state, country, postal_code, phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $result = $stmt->execute([$user_id, $full_name, $dob, $gender, $address, $city, $state, $country, $postal_code, $phone]);
}

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'User info updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update user info']);
}
?>
