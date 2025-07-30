<?php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Check if user is logged in
    $user_id = $_SESSION['user'] ?? null;
    if (!$user_id) {
        throw new Exception("User not logged in. Please login first.");
    }

    // Get service bookings for the user
    $stmt = $pdo->prepare("
        SELECT 
            booking_service_id,
            service_category,
            service_name,
            service_price,
            booking_date,
            booking_time,
            number_of_people,
            special_instructions,
            total_amount,
            status,
            created_at
        FROM booking_services 
        WHERE user_id = ? 
        ORDER BY created_at DESC
    ");
    
    $stmt->execute([$user_id]);
    $service_bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'service_bookings' => $service_bookings
    ]);

} catch (Exception $e) {
    error_log("Get service bookings error: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
