<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get current month tour revenue
    $stmt = $pdo->query("
        SELECT COALESCE(SUM(amount_paid), 0) as current_amount
        FROM tour_bookings
        WHERE status = 'confirmed'
        AND MONTH(created_at) = MONTH(CURRENT_DATE())
        AND YEAR(created_at) = YEAR(CURRENT_DATE())
    ");
    $currentAmount = $stmt->fetchColumn();
    
    // Set target amount for tours (you can make this configurable)
    $targetAmount = 25000;
    
    // Calculate progress percentage
    $progress = min(100, ($currentAmount / $targetAmount) * 100);
    
    echo json_encode([
        'success' => true,
        'current_amount' => $currentAmount,
        'target_amount' => $targetAmount,
        'progress' => round($progress, 1)
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch tour revenue progress: ' . $e->getMessage()
    ]);
}
?> 