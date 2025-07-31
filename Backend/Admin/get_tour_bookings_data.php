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
    
    // Get all tour bookings
    $stmt = $pdo->query("
        SELECT 
            id,
            full_name,
            email,
            phone,
            tour_date,
            tour_time,
            places_to_visit,
            number_of_travellers,
            vehicle_type,
            amount_paid,
            status,
            created_at,
            DATEDIFF(tour_date, CURDATE()) as days_until_tour
        FROM tour_bookings
        ORDER BY created_at DESC
    ");
    
    $tourBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get tour booking statistics
    $stmt2 = $pdo->query("
        SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_bookings,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_bookings,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_bookings,
            SUM(amount_paid) as total_revenue,
            AVG(amount_paid) as avg_booking_value,
            SUM(number_of_travellers) as total_travellers
        FROM tour_bookings
    ");
    
    $stats = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    // Get bookings by vehicle type
    $stmt3 = $pdo->query("
        SELECT 
            vehicle_type,
            COUNT(*) as booking_count,
            SUM(amount_paid) as revenue,
            AVG(amount_paid) as avg_amount,
            SUM(number_of_travellers) as total_travellers
        FROM tour_bookings
        GROUP BY vehicle_type
        ORDER BY revenue DESC
    ");
    
    $bookingsByVehicle = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    // Get popular destinations
    $stmt4 = $pdo->query("
        SELECT 
            places_to_visit,
            COUNT(*) as visit_count,
            SUM(amount_paid) as revenue
        FROM tour_bookings
        GROUP BY places_to_visit
        ORDER BY visit_count DESC
        LIMIT 10
    ");
    
    $popularDestinations = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    
    // Get upcoming tours
    $stmt5 = $pdo->query("
        SELECT 
            id,
            full_name,
            tour_date,
            tour_time,
            places_to_visit,
            number_of_travellers,
            vehicle_type,
            amount_paid,
            status
        FROM tour_bookings
        WHERE tour_date >= CURDATE()
        ORDER BY tour_date ASC
        LIMIT 10
    ");
    
    $upcomingTours = $stmt5->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'tour_bookings' => $tourBookings,
        'statistics' => $stats,
        'bookings_by_vehicle' => $bookingsByVehicle,
        'popular_destinations' => $popularDestinations,
        'upcoming_tours' => $upcomingTours
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch tour booking data: ' . $e->getMessage()
    ]);
}
?> 