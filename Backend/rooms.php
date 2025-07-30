<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

$stmt = $pdo->query("SELECT * FROM rooms");
$rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(["rooms" => $rooms]);
