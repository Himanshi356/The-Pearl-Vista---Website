<?php
session_start();
header('Content-Type: application/json');

require_once '../../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get current date for availability calculation
    $currentDate = date('Y-m-d');
    
    // Update room availability based on actual bookings
    $stmt = $pdo->prepare("
        UPDATE room_types rt
        SET available_rooms = (
            rt.total_rooms - COALESCE(
                (
                    SELECT COUNT(*)
                    FROM bookings b
                    WHERE b.room_type = rt.room_type 
                    AND b.status IN ('pending', 'confirmed')
                    AND (
                        (b.check_in_date <= ? AND b.check_out_date >= ?) -- Current bookings
                        OR (b.check_in_date > ?) -- Future bookings
                    )
                ), 0
            )
        )
    ");
    
    $stmt->execute([$currentDate, $currentDate, $currentDate]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Room availability updated automatically'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update room availability: ' . $e->getMessage()
    ]);
}
?> 