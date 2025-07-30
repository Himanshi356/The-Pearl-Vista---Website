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

$tour_name = trim($data['tour_name'] ?? '');
$tour_date = $data['tour_date'] ?? '';
$num_people = intval($data['num_people'] ?? 1);
$special_requests = trim($data['special_requests'] ?? '');

if (!$tour_name || !$tour_date || $num_people < 1) {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO tour_bookings (user_id, tour_name, tour_date, num_people, special_requests) VALUES (?, ?, ?, ?, ?)");
$result = $stmt->execute([$user_id, $tour_name, $tour_date, $num_people, $special_requests]);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Tour booked successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to book tour']);
}
?>
