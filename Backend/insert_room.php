<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$data = json_decode(file_get_contents("php://input"));

$stmt = $pdo->prepare("INSERT INTO rooms (room_number, type, description, price, status, image) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->execute([
  $data->room_number,
  $data->type,
  $data->description,
  $data->price,
  $data->status,
  $data->image
]);

echo json_encode(["status" => "success", "message" => "Room added"]);
