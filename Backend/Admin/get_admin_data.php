<?php
require_once '../../Config/database.php';
require_once '../Admin/admin_only.php';

header('Content-Type: application/json');

try {
    $admin_id = $_SESSION['admin_id'];
    
    // Get admin data from unified admin_users table
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE id = ? LIMIT 1");
    $stmt->bind_param('i', $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin_data = $result->fetch_assoc();

    // Get recent admin activity from unified admin_activity_log
    $stmt = $conn->prepare("SELECT * FROM admin_activity_log WHERE admin_id = ? ORDER BY created_at DESC LIMIT 10");
    $stmt->bind_param('i', $admin_id);
    $stmt->execute();
    $activity_result = $stmt->get_result();
    $recent_activity = [];
    while ($row = $activity_result->fetch_assoc()) {
        $recent_activity[] = $row;
    }

    // Get admin statistics
    $total_admins = $conn->query("SELECT COUNT(*) FROM admin_users")->fetch_row()[0];
    $active_admins = $conn->query("SELECT COUNT(*) FROM admin_users WHERE is_active = 1")->fetch_row()[0];
    $total_activity = $conn->query("SELECT COUNT(*) FROM admin_activity_log")->fetch_row()[0];

    echo json_encode([
        'status' => 'success',
        'admin_data' => $admin_data,
        'recent_activity' => $recent_activity,
        'statistics' => [
            'total_admins' => $total_admins,
            'active_admins' => $active_admins,
            'total_activity' => $total_activity
        ]
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?> 