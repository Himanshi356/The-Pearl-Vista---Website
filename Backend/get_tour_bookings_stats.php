<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get total tour bookings
    $stmt = $pdo->query("SELECT COUNT(*) as total_bookings FROM tour_bookings");
    $totalBookings = $stmt->fetchColumn();
    
    // Get tour revenue
    $stmt = $pdo->query("SELECT COALESCE(SUM(amount_paid), 0) as total_revenue FROM tour_bookings WHERE status = 'confirmed'");
    $totalRevenue = $stmt->fetchColumn();
    
    // Get active tours
    $stmt = $pdo->query("SELECT COUNT(*) as active_tours FROM tour_bookings WHERE status IN ('pending', 'confirmed')");
    $activeTours = $stmt->fetchColumn();
    
    // Calculate satisfaction (mock data for now)
    $satisfaction = 4.8;
    
    // Calculate changes (mock data for now)
    $bookingsChange = "+15%";
    $revenueChange = "+12%";
    $toursChange = "+8%";
    $satisfactionChange = "+3%";
    
    echo json_encode([
        'success' => true,
        'stats' => [
            'total_bookings' => number_format($totalBookings),
            'revenue' => '$' . number_format($totalRevenue, 2),
            'active_tours' => number_format($activeTours),
            'satisfaction' => number_format($satisfaction, 1),
            'bookings_change' => $bookingsChange,
            'revenue_change' => $revenueChange,
            'tours_change' => $toursChange,
            'satisfaction_change' => $satisfactionChange
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch tour bookings stats: ' . $e->getMessage()
    ]);
}
?> 