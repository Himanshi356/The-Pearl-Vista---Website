<?php
session_start();
header('Content-Type: application/json');

// Allow testing when no session is present (for development)
$isTestMode = !isset($_SESSION['user']) && !isset($_SESSION['role']);
$hasValidSession = isset($_SESSION['user']) && isset($_SESSION['role']) && in_array($_SESSION['role'], ['admin', 'super_admin', 'manager']);

if (!$isTestMode && !$hasValidSession) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Not logged in or insufficient privileges',
        'redirect' => true
    ]);
    exit();
}

require_once '../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get revenue data for the last 12 months
    $months = [];
    $roomRevenue = [];
    $serviceRevenue = [];
    $tourRevenue = [];
    $totalRevenue = [];
    
    for ($i = 11; $i >= 0; $i--) {
        $month = date('Y-m', strtotime("-$i months"));
        $months[] = date('M Y', strtotime("-$i months"));
        
        // Room bookings revenue
        $stmt = $pdo->prepare("
            SELECT COALESCE(SUM(total_amount), 0) as revenue 
            FROM home_bookings 
            WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
        ");
        $stmt->execute([$month]);
        $roomRev = $stmt->fetchColumn();
        $roomRevenue[] = (float)$roomRev;
        
        // Service bookings revenue
        $stmt = $pdo->prepare("
            SELECT COALESCE(SUM(total_amount), 0) as revenue 
            FROM service_bookings 
            WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
        ");
        $stmt->execute([$month]);
        $serviceRev = $stmt->fetchColumn();
        $serviceRevenue[] = (float)$serviceRev;
        
        // Tour bookings revenue
        $stmt = $pdo->prepare("
            SELECT COALESCE(SUM(amount_paid), 0) as revenue 
            FROM tour_bookings 
            WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
        ");
        $stmt->execute([$month]);
        $tourRev = $stmt->fetchColumn();
        $tourRevenue[] = (float)$tourRev;
        
        // Total revenue for the month
        $totalRevenue[] = (float)$roomRev + (float)$serviceRev + (float)$tourRev;
    }
    
    // Get current month totals
    $currentMonth = date('Y-m');
    
    // Current month room revenue
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(total_amount), 0) as revenue 
        FROM home_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$currentMonth]);
    $currentRoomRevenue = $stmt->fetchColumn();
    
    // Current month service revenue
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(total_amount), 0) as revenue 
        FROM service_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$currentMonth]);
    $currentServiceRevenue = $stmt->fetchColumn();
    
    // Current month tour revenue
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(amount_paid), 0) as revenue 
        FROM tour_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$currentMonth]);
    $currentTourRevenue = $stmt->fetchColumn();
    
    // Calculate total current revenue
    $currentTotalRevenue = $currentRoomRevenue + $currentServiceRevenue + $currentTourRevenue;
    
    // Get last month for comparison
    $lastMonth = date('Y-m', strtotime('-1 month'));
    
    // Last month totals
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(total_amount), 0) as revenue 
        FROM home_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$lastMonth]);
    $lastRoomRevenue = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(total_amount), 0) as revenue 
        FROM service_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$lastMonth]);
    $lastServiceRevenue = $stmt->fetchColumn();
    
    $stmt = $pdo->prepare("
        SELECT COALESCE(SUM(amount_paid), 0) as revenue 
        FROM tour_bookings 
        WHERE DATE_FORMAT(created_at, '%Y-%m') = ? AND status = 'confirmed'
    ");
    $stmt->execute([$lastMonth]);
    $lastTourRevenue = $stmt->fetchColumn();
    
    $lastTotalRevenue = $lastRoomRevenue + $lastServiceRevenue + $lastTourRevenue;
    
    // Calculate percentage change
    $percentageChange = $lastTotalRevenue > 0 
        ? round((($currentTotalRevenue - $lastTotalRevenue) / $lastTotalRevenue) * 100, 1)
        : 0;
    
    // Get top revenue sources
    $stmt = $pdo->query("
        SELECT 'Room Bookings' as source, COALESCE(SUM(total_amount), 0) as revenue
        FROM home_bookings 
        WHERE status = 'confirmed'
        UNION ALL
        SELECT 'Service Bookings' as source, COALESCE(SUM(total_amount), 0) as revenue
        FROM service_bookings 
        WHERE status = 'confirmed'
        UNION ALL
        SELECT 'Tour Bookings' as source, COALESCE(SUM(amount_paid), 0) as revenue
        FROM tour_bookings 
        WHERE status = 'confirmed'
        ORDER BY revenue DESC
    ");
    $topSources = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'data' => [
            'months' => $months,
            'roomRevenue' => $roomRevenue,
            'serviceRevenue' => $serviceRevenue,
            'tourRevenue' => $tourRevenue,
            'totalRevenue' => $totalRevenue,
            'currentMonth' => [
                'room' => (float)$currentRoomRevenue,
                'service' => (float)$currentServiceRevenue,
                'tour' => (float)$currentTourRevenue,
                'total' => (float)$currentTotalRevenue
            ],
            'percentageChange' => $percentageChange,
            'topSources' => $topSources
        ]
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch revenue data: ' . $e->getMessage()
    ]);
}
?> 