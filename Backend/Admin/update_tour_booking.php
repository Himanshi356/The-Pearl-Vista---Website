<?php
require_once '../../Config/database.php';
require_once 'admin_only.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id'] ?? 0);
$status = $data['status'] ?? '';

if (!$id || !in_array($status, ['booked', 'completed', 'cancelled'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

$stmt = $pdo->prepare("UPDATE tour_bookings SET status = ? WHERE id = ?");
$result = $stmt->execute([$status, $id]);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Tour booking updated']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Update failed']);
}
?>
