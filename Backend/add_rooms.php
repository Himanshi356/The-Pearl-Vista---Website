<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

header('Content-Type: application/json');

try {
    // Read JSON input
    $data = json_decode(file_get_contents("php://input"), true);

    if (!$data) {
        throw new Exception("Invalid JSON input");
    }

    $room_number = trim($data['room_number'] ?? '');
    $type = trim($data['type'] ?? '');
    $price = trim($data['price'] ?? '');
    $description = trim($data['description'] ?? '');

    // Basic validation
    if (empty($room_number) || empty($type) || empty($price) || !is_numeric($price)) {
        throw new Exception("Missing or invalid room_number, type, or price");
    }

    // Insert room
    $stmt = $pdo->prepare("INSERT INTO rooms (room_number, type, price, description, status) VALUES (?, ?, ?, ?, 'available')");
    $stmt->execute([$room_number, $type, $price, $description]);

    echo json_encode(["status" => "success", "message" => "Room added successfully"]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}
