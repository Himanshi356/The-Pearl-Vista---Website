<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->id;
$status = $data->status;

$pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?")->execute([$status, $id]);

echo json_encode(["message" => "Status updated to $status"]);
