<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$stmt = $pdo->query("
  SELECT b.*, u.username, u.email, r.room_number, r.type
  FROM bookings b
  JOIN users u ON b.user_id = u.id
  JOIN rooms r ON b.room_id = r.id
  ORDER BY b.created_at DESC
");

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode(["bookings" => $bookings]);
