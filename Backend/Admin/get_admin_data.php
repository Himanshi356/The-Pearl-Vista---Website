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
    
    // Get admin user data
    $adminId = $_SESSION['user_id'] ?? 1;
    $stmt = $pdo->prepare("
        SELECT 
            admin_id,
            username,
            email,
            first_name,
            last_name,
            role,
            created_at
        FROM admin_users 
        WHERE admin_id = ?
    ");
    $stmt->execute([$adminId]);
    $adminData = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Get overall statistics
    $stmt2 = $pdo->query("
        SELECT 
            (SELECT COUNT(*) FROM admin_users) as total_admins,
            (SELECT COUNT(*) FROM rooms) as total_rooms,
            (SELECT COUNT(*) FROM bookings WHERE status = 'confirmed') as active_bookings,
            (SELECT COUNT(*) FROM admin_activity_log) as total_activity
    ");
    $statistics = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    // Get recent activity
    $stmt3 = $pdo->query("
        SELECT 
            action,
            description,
            created_at
        FROM admin_activity_log 
        ORDER BY created_at DESC 
        LIMIT 10
    ");
    $recentActivity = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'admin_data' => $adminData,
        'statistics' => $statistics,
        'recent_activity' => $recentActivity
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch admin data: ' . $e->getMessage()
    ]);
}
?> 