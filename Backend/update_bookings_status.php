<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$data = json_decode(file_get_contents("php://input"));
$id = $data->booking_id;
$status = $data->status; // e.g., 'completed', 'cancelled'

$stmt = $pdo->prepare("UPDATE bookings SET status = ? WHERE id = ?");
$stmt->execute([$status, $id]);

echo json_encode(["message" => "Booking status updated"]);
