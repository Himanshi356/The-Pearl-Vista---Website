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
    
    // Handle filter parameters
    $filters = [];
    $params = [];
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        
        if ($input) {
            if (!empty($input['status']) && $input['status'] !== 'All Status') {
                $filters[] = "status = ?";
                $params[] = $input['status'];
            }
            
            if (!empty($input['date'])) {
                $filters[] = "DATE(check_in_date) = ?";
                $params[] = $input['date'];
            }
            
            if (!empty($input['name'])) {
                $filters[] = "customer_name LIKE ?";
                $params[] = '%' . $input['name'] . '%';
            }
            
            if (!empty($input['room_type']) && $input['room_type'] !== 'All Types') {
                $filters[] = "room_type = ?";
                $params[] = $input['room_type'];
            }
        }
    }
    
    // Build the WHERE clause
    $whereClause = '';
    if (!empty($filters)) {
        $whereClause = 'WHERE ' . implode(' AND ', $filters);
    }
    
    // Get all bookings from home_bookings table with customer details
    $sql = "
        SELECT 
            id,
            COALESCE(booking_id, CONCAT('PV', LPAD(id, 4, '0'))) as booking_id,
            customer_name,
            customer_email,
            customer_phone,
            room_type,
            check_in_date,
            check_out_date,
            num_guests,
            num_rooms,
            total_amount,
            status,
            special_instructions,
            created_at,
            DATEDIFF(check_out_date, check_in_date) as duration_days
        FROM home_bookings
        $whereClause
        ORDER BY created_at DESC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Update booking_id for records that don't have one
    foreach ($bookings as $booking) {
        if (empty($booking['booking_id']) || strpos($booking['booking_id'], 'PV') !== 0) {
            $booking_id = 'PV' . str_pad($booking['id'], 4, '0', STR_PAD_LEFT);
            $update_stmt = $pdo->prepare("UPDATE home_bookings SET booking_id = ? WHERE id = ?");
            $update_stmt->execute([$booking_id, $booking['id']]);
            $booking['booking_id'] = $booking_id;
        }
    }
    
    // Get booking statistics from home_bookings table (with filters applied)
    $statsSql = "
        SELECT 
            COUNT(*) as total_bookings,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_bookings,
            SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as confirmed_bookings,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_bookings,
            SUM(CASE WHEN status = 'checked-in' THEN 1 ELSE 0 END) as checked_in_bookings,
            SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_bookings,
            SUM(total_amount) as total_revenue,
            AVG(total_amount) as avg_booking_value
        FROM home_bookings
        $whereClause
    ";
    
    $stmt2 = $pdo->prepare($statsSql);
    $stmt2->execute($params);
    $stats = $stmt2->fetch(PDO::FETCH_ASSOC);
    
    // Get bookings by room type from home_bookings table (with filters applied)
    $typeSql = "
        SELECT 
            room_type,
            COUNT(*) as booking_count,
            SUM(total_amount) as revenue
        FROM home_bookings
        $whereClause
        GROUP BY room_type
        ORDER BY revenue DESC
    ";
    
    $stmt3 = $pdo->prepare($typeSql);
    $stmt3->execute($params);
    $bookingsByType = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'bookings' => $bookings,
        'statistics' => $stats,
        'bookings_by_type' => $bookingsByType
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch booking data: ' . $e->getMessage()
    ]);
}
?> 