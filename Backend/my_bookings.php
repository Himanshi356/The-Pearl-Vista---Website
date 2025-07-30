<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$user_id = $_SESSION['user'];

try {
$stmt = $pdo->prepare("
        SELECT b.*, r.room_number, r.type, r.price, r.image
  FROM bookings b
        JOIN rooms r ON b.room_id = r.room_id
  WHERE b.user_id = ?
        ORDER BY b.created_at DESC
");
$stmt->execute([$user_id]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'bookings' => $bookings
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch bookings: ' . $e->getMessage()
    ]);
}
