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
    
    // Get all customers with their booking history
    $stmt = $pdo->query("
        SELECT 
            u.user_id,
            u.username,
            u.email,
            u.role,
            u.verified,
            u.created_at as registration_date,
            ui.full_name,
            ui.phone,
            ui.city,
            ui.country,
            COUNT(DISTINCT b.id) as total_bookings,
            SUM(b.total_amount) as total_spent,
            MAX(b.created_at) as last_booking_date
        FROM users u
        LEFT JOIN user_info ui ON u.user_id = ui.user_id
        LEFT JOIN bookings b ON u.email = b.customer_email
        WHERE u.role = 'user'
        GROUP BY u.user_id
        ORDER BY total_spent DESC
    ");
    
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get customer statistics
    $stmt2 = $pdo->query("
        SELECT 
            COUNT(*) as total_customers,
            SUM(CASE WHEN verified = 1 THEN 1 ELSE 0 END) as verified_customers,
            SUM(CASE WHEN verified = 0 THEN 1 ELSE 0 END) as unverified_customers,
            COUNT(DISTINCT DATE(created_at)) as registration_days
        FROM users 
        WHERE role = 'user'
    ");
    
    $stats = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    // Get top customers by spending
    $stmt3 = $pdo->query("
        SELECT 
            u.email,
            ui.full_name,
            COUNT(b.id) as booking_count,
            SUM(b.total_amount) as total_spent
        FROM users u
        LEFT JOIN user_info ui ON u.user_id = ui.user_id
        LEFT JOIN bookings b ON u.email = b.customer_email
        WHERE u.role = 'user'
        GROUP BY u.user_id
        HAVING total_spent > 0
        ORDER BY total_spent DESC
        LIMIT 10
    ");
    
    $topCustomers = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'customers' => $customers,
        'statistics' => $stats,
        'top_customers' => $topCustomers
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch customer data: ' . $e->getMessage()
    ]);
}
?> 