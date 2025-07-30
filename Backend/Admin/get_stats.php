<?php
require_once '../../config/database.php';
require_once '../../admin/admin_only.php';

$stats = [
  'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
  'rooms' => $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn(),
  'bookings' => $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn(),
  'active_bookings' => $pdo->query("SELECT COUNT(*) FROM bookings WHERE status = 'booked'")->fetchColumn()
];

echo json_encode(["status" => "success", "stats" => $stats]);
