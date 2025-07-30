<?php
require_once '../../config/database.php';
require_once '../../admin/admin_only.php';

$stmt = $pdo->query("SELECT id, username, email, role FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["status" => "success", "users" => $users]);
