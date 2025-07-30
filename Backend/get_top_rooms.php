<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get top rooms by bookings
    $stmt = $pdo->query("
        SELECT r.room_number, r.type, COUNT(b.id) as bookings_count
        FROM rooms r
        LEFT JOIN home_bookings b ON r.room_number = b.room_type
        GROUP BY r.room_number, r.type
        ORDER BY bookings_count DESC
        LIMIT 5
    ");
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'rooms' => $rooms
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch top rooms: ' . $e->getMessage()
    ]);
}
?> 