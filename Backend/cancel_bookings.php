<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

if (!isset($_SESSION['user'])) {
    echo json_encode(['status' => 'error', 'message' => 'Not logged in']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$booking_id = $input['booking_id'] ?? null;

if (!$booking_id) {
    echo json_encode(['status' => 'error', 'message' => 'Booking ID is required']);
    exit;
}

try {
    // Get booking details
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_id = ? AND user_id = ?");
    $stmt->execute([$booking_id, $_SESSION['user']]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        echo json_encode(['status' => 'error', 'message' => 'Booking not found']);
        exit;
    }

    // Check if booking can be cancelled
    if ($booking['status'] === 'cancelled') {
        echo json_encode(['status' => 'error', 'message' => 'Booking is already cancelled']);
        exit;
    }

    if ($booking['status'] === 'checked_out') {
        echo json_encode(['status' => 'error', 'message' => 'Cannot cancel completed booking']);
    exit;
}

// Cancel booking
    $stmt = $pdo->prepare("UPDATE bookings SET status = 'cancelled' WHERE booking_id = ?");
    $stmt->execute([$booking_id]);

// Free the room
    $stmt = $pdo->prepare("UPDATE rooms SET status = 'available' WHERE room_id = ?");
    $stmt->execute([$booking['room_id']]);

    // Auto-update room availability after cancellation
    try {
        $currentDate = date('Y-m-d');
        $update_stmt = $pdo->prepare("
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
        $update_stmt->execute([$currentDate, $currentDate, $currentDate]);
    } catch (Exception $e) {
        // Log error but don't fail the cancellation
        error_log("Error updating room availability after cancellation: " . $e->getMessage());
    }

    echo json_encode(['status' => 'success', 'message' => 'Booking cancelled successfully']);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to cancel booking: ' . $e->getMessage()]);
}
