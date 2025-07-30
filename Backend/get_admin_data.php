<?php
session_start();
header('Content-Type: application/json');
require_once '../../Config/database.php';

if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['error' => 'Unauthorized']);
    exit();
}

try {
    $admin_id = $_SESSION['user'];
    $pdo = getDatabaseConnection();

    // Fetch admin profile
    $stmt = $pdo->prepare("SELECT admin_id, username, role, department, last_login, login_count, is_active FROM admins WHERE admin_id = ?");
    $stmt->execute([$admin_id]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch stats
    $stats = [
        'users' => $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn(),
        'rooms' => $pdo->query("SELECT COUNT(*) FROM rooms")->fetchColumn(),
        'bookings' => $pdo->query("SELECT COUNT(*) FROM bookings")->fetchColumn(),
        'services' => $pdo->query("SELECT COUNT(*) FROM booking_services")->fetchColumn(),
    ];

    // Fetch recent admin activity
    $activity = $pdo->prepare("SELECT * FROM admin_activity_log WHERE admin_id = ? ORDER BY timestamp DESC LIMIT 10");
    $activity->execute([$admin_id]);
    $logs = $activity->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'admin' => $admin,
        'stats' => $stats,
        'activity' => $logs
    ]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
