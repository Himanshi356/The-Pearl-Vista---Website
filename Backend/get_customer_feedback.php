<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get customer feedback from reviews table
    $stmt = $pdo->query("
        SELECT r.rating, r.comment, r.created_at, u.username
        FROM reviews r
        LEFT JOIN users u ON r.user_id = u.user_id
        ORDER BY r.created_at DESC
        LIMIT 10
    ");
    $feedback = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'success' => true,
        'feedback' => $feedback
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch customer feedback: ' . $e->getMessage()
    ]);
}
?> 