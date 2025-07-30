<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get popular destinations from tour bookings
    $stmt = $pdo->query("
        SELECT 
            places_to_visit,
            COUNT(*) as bookings_count,
            SUM(amount_paid) as total_revenue
        FROM tour_bookings
        WHERE status IN ('confirmed', 'pending')
        GROUP BY places_to_visit
        ORDER BY bookings_count DESC, total_revenue DESC
        LIMIT 5
    ");
    $destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the data for frontend
    $formattedDestinations = [];
    foreach ($destinations as $destination) {
        $formattedDestinations[] = [
            'name' => $destination['places_to_visit'],
            'bookings' => $destination['bookings_count'],
            'revenue' => '$' . number_format($destination['total_revenue'], 2)
        ];
    }
    
    echo json_encode([
        'success' => true,
        'destinations' => $formattedDestinations
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch popular destinations: ' . $e->getMessage()
    ]);
}
?> 