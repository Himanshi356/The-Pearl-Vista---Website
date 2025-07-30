<?php
require_once '../config/database.php';
require_once '../admin/admin_only.php';

// Total Rooms
$total_rooms = $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn();

// Available Rooms
$available_rooms = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'available'")->fetchColumn();

// Booked Rooms
$booked_rooms = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'booked'")->fetchColumn();

// Total Bookings
$total_bookings = $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn();

// Recent Bookings
$recent_stmt = $pdo->query("
    SELECT b.*, u.username, r.room_number
    FROM bookings b
    JOIN users u ON b.user_id = u.id
    JOIN rooms r ON b.room_id = r.id
    ORDER BY b.created_at DESC
    LIMIT 10
");
$recent_bookings = $recent_stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    "total_rooms" => $total_rooms,
    "available_rooms" => $available_rooms,
    "booked_rooms" => $booked_rooms,
    "total_bookings" => $total_bookings,
    "recent_bookings" => $recent_bookings
]);
