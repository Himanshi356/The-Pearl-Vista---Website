<?php
require_once '../../Config/database.php';
require_once 'admin_only.php';

$stmt = $pdo->query("
    SELECT t.*, u.username
    FROM tour_bookings t
    JOIN users u ON t.user_id = u.user_id
    ORDER BY t.created_at DESC
");
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['status' => 'success', 'tours' => $tours]);
?>
