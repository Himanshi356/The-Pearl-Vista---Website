<?php
session_start();
header('Content-Type: application/json');
require_once '../Config/database.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);
if (!$data || !isset($data['room_id']) || !isset($data['room_type']) || !isset($data['price']) || !isset($data['status'])) {
    echo json_encode(['error' => 'Invalid input']);
    exit();
}

try {
    $pdo = getDatabaseConnection();
    $stmt = $pdo->prepare("UPDATE rooms SET room_type = ?, price = ?, status = ? WHERE room_id = ?");
    $stmt->execute([
        $data['room_type'],
        $data['price'],
        $data['status'],
        $data['room_id']
    ]);
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
