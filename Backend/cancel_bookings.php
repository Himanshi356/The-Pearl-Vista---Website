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

    echo json_encode(['status' => 'success', 'message' => 'Booking cancelled successfully']);

} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to cancel booking: ' . $e->getMessage()]);
}
