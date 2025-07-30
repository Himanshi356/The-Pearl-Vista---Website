<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get total bookings
    $stmt = $pdo->query("SELECT COUNT(*) as total_bookings FROM home_bookings");
    $totalBookings = $stmt->fetchColumn();
    
    // Get total revenue
    $stmt = $pdo->query("SELECT COALESCE(SUM(total_amount), 0) as total_revenue FROM home_bookings WHERE status = 'confirmed'");
    $totalRevenue = $stmt->fetchColumn();
    
    // Get active bookings
    $stmt = $pdo->query("SELECT COUNT(*) as active_bookings FROM home_bookings WHERE status IN ('pending', 'confirmed')");
    $activeBookings = $stmt->fetchColumn();
    
    // Get average rating
    $stmt = $pdo->query("SELECT COALESCE(AVG(rating), 0) as avg_rating FROM reviews");
    $avgRating = $stmt->fetchColumn();
    
    // Calculate changes (mock data for now)
    $bookingsChange = "+12%";
    $revenueChange = "+8%";
    $activeChange = "+5%";
    $ratingChange = "+2%";
    
    echo json_encode([
        'success' => true,
        'stats' => [
            'total_bookings' => number_format($totalBookings),
            'total_revenue' => '$' . number_format($totalRevenue, 2),
            'active_bookings' => number_format($activeBookings),
            'avg_rating' => number_format($avgRating, 1),
            'bookings_change' => $bookingsChange,
            'revenue_change' => $revenueChange,
            'active_change' => $activeChange,
            'rating_change' => $ratingChange
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch reports stats: ' . $e->getMessage()
    ]);
}
?> 