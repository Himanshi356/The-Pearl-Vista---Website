<?php
// get_admins.php
require_once '../../Config/database.php';

$sql = "SELECT id, username, name, role, status, created_at FROM admin_users ORDER BY id DESC";
$result = $conn->query($sql);
$admins = [];
while ($row = $result->fetch_assoc()) {
    $admins[] = $row;
}
echo json_encode(['success' => true, 'admins' => $admins]); 