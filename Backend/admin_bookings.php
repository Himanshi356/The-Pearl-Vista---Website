<?php
require_once '../config/database.php';
require_once '../utils/admin_only.php';

$stmt = $pdo->query("
  SELECT b.*, u.username, r.room_number
  FROM bookings b
  JOIN users u ON b.user_id = u.id
  JOIN rooms r ON b.room_id = r.id
  ORDER BY b.created_at DESC
");

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
