<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

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
    
    // Log the activity
    $adminId = $_SESSION['user_id'] ?? 1;
    $logStmt = $pdo->prepare("
        INSERT INTO admin_activity_log (admin_id, action, description, ip_address, user_agent)
        VALUES (?, ?, ?, ?, ?)
    ");
    
    $logStmt->execute([
        $adminId,
        'update_room_availability',
        'Updated room availability based on current bookings',
        $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
    ]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Room availability updated successfully'
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update room availability: ' . $e->getMessage()
    ]);
}
?> 