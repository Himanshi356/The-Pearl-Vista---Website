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
    
    // Get all service bookings
    $stmt = $pdo->query("
        SELECT 
            id,
            booking_id,
            user_id,
            username,
            selected_services,
            service_category,
            service_date,
            service_time,
            guest_count,
            special_requirements,
            phone_number,
            email,
            total_amount,
            additional_services,
            status,
            booking_date,
            created_at
        FROM service_bookings
        ORDER BY created_at DESC
    ");
    
    $serviceBookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get service booking statistics
    $stmt2 = $pdo->query("
        SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_bookings,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_bookings,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_bookings,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_bookings,
            SUM(total_amount) as total_revenue,
            AVG(total_amount) as avg_booking_value
        FROM service_bookings
    ");
    
    $stats = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    // Get bookings by service category
    $stmt3 = $pdo->query("
        SELECT 
            service_category,
            COUNT(*) as booking_count,
            SUM(total_amount) as revenue,
            AVG(total_amount) as avg_amount
        FROM service_bookings
        GROUP BY service_category
        ORDER BY revenue DESC
    ");
    
    $bookingsByCategory = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    // Get popular services
    $stmt4 = $pdo->query("
        SELECT 
            JSON_UNQUOTE(JSON_EXTRACT(selected_services, '$[*]')) as services,
            COUNT(*) as usage_count
        FROM service_bookings
        GROUP BY selected_services
        ORDER BY usage_count DESC
        LIMIT 10
    ");
    
    $popularServices = $stmt4->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'service_bookings' => $serviceBookings,
        'statistics' => $stats,
        'bookings_by_category' => $bookingsByCategory,
        'popular_services' => $popularServices
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch service data: ' . $e->getMessage()
    ]);
}
?> 