<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

try {
    $stmt = $pdo->query("SELECT * FROM rooms WHERE status = 'available' ORDER BY room_id");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'rooms' => $rooms
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch available rooms: ' . $e->getMessage()
    ]);
}
