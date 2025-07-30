<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;

$stmt = $pdo->prepare("DELETE FROM rooms WHERE id = ?");
$stmt->execute([$id]);

echo json_encode(["message" => "Room deleted"]);
