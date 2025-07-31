<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    $booking_id = $_GET['id'] ?? null;
    
    if (!$booking_id) {
        echo json_encode(['success' => false, 'message' => 'Booking ID is required']);
        exit();
    }
    
    // Get booking details from home_bookings table
    $stmt = $pdo->prepare("
        SELECT 
            id,
            COALESCE(booking_id, CONCAT('PV', LPAD(id, 4, '0'))) as booking_id,
            customer_name,
            customer_email,
            customer_phone,
            room_type,
            check_in_date,
            check_out_date,
            num_guests,
            num_rooms,
            total_amount,
            status,
            special_instructions,
            created_at,
            DATEDIFF(check_out_date, check_in_date) as duration_days
        FROM home_bookings
        WHERE id = ?
    ");
    
    $stmt->execute([$booking_id]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
        echo json_encode(['success' => false, 'message' => 'Booking not found']);
        exit();
    }
    
    // Update booking_id if it doesn't exist
    if (empty($booking['booking_id']) || strpos($booking['booking_id'], 'PV') !== 0) {
        $booking_id_generated = 'PV' . str_pad($booking['id'], 4, '0', STR_PAD_LEFT);
        $update_stmt = $pdo->prepare("UPDATE home_bookings SET booking_id = ? WHERE id = ?");
        $update_stmt->execute([$booking_id_generated, $booking['id']]);
        $booking['booking_id'] = $booking_id_generated;
    }
    
    echo json_encode([
        'success' => true,
        'booking' => $booking
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch booking details: ' . $e->getMessage()
    ]);
}
?> 