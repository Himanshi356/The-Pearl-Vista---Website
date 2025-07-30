<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    $stmt = $pdo->query("SELECT * FROM rooms ORDER BY room_id");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'rooms' => $rooms
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch rooms: ' . $e->getMessage()
    ]);
}
