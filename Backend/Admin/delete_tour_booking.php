<?php
require_once '../../Config/database.php';
require_once 'admin_only.php';

$data = json_decode(file_get_contents('php://input'), true);
$id = intval($data['id'] ?? 0);

if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid ID']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM tour_bookings WHERE id = ?");
$result = $stmt->execute([$id]);

if ($result) {
    echo json_encode(['status' => 'success', 'message' => 'Tour booking deleted']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Delete failed']);
}
?>
