<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Get loyal customers by booking count and total spent
    $stmt = $pdo->query("
        SELECT 
            customer_name, 
            COUNT(*) as bookings_count, 
            SUM(total_amount) as total_spent,
            MAX(created_at) as last_booking
        FROM home_bookings
        WHERE status IN ('confirmed', 'pending')
        GROUP BY customer_name
        HAVING bookings_count >= 1
        ORDER BY bookings_count DESC, total_spent DESC
        LIMIT 5
    ");
    $customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Format the data for frontend
    $formattedCustomers = [];
    foreach ($customers as $customer) {
        $formattedCustomers[] = [
            'name' => $customer['customer_name'],
            'bookings' => $customer['bookings_count'],
            'total_spent' => '$' . number_format($customer['total_spent'], 2),
            'last_booking' => date('M Y', strtotime($customer['last_booking']))
        ];
    }
    
    echo json_encode([
        'success' => true,
        'customers' => $formattedCustomers
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch loyal customers: ' . $e->getMessage()
    ]);
}
?>
