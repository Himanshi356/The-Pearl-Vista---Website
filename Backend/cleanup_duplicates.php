<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit();
}

require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Find duplicate bookings based on key fields
    $duplicate_sql = "
        SELECT 
            customer_email,
            customer_name,
            room_type,
            check_in_date,
            check_out_date,
            num_guests,
            num_rooms,
            total_amount,
            special_instructions,
            created_at,
            COUNT(*) as duplicate_count,
            GROUP_CONCAT(id ORDER BY id) as booking_ids
        FROM home_bookings 
        GROUP BY 
            customer_email,
            customer_name,
            room_type,
            check_in_date,
            check_out_date,
            num_guests,
            num_rooms,
            total_amount,
            special_instructions,
            created_at
        HAVING COUNT(*) > 1
        ORDER BY created_at DESC
    ";
    
    $duplicate_stmt = $pdo->query($duplicate_sql);
    $duplicates = $duplicate_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $cleaned_count = 0;
    $deleted_count = 0;
    
    foreach ($duplicates as $duplicate) {
        $booking_ids = explode(',', $duplicate['booking_ids']);
        
        // Keep the first booking (lowest ID) and delete the rest
        $keep_id = array_shift($booking_ids);
        $delete_ids = $booking_ids;
        
        if (!empty($delete_ids)) {
            $delete_sql = "DELETE FROM home_bookings WHERE id IN (" . implode(',', $delete_ids) . ")";
            $delete_stmt = $pdo->prepare($delete_sql);
            $delete_stmt->execute();
            
            $deleted_count += count($delete_ids);
            $cleaned_count++;
        }
    }
    
    // Update booking_id for remaining records to ensure uniqueness
    $update_sql = "
        UPDATE home_bookings 
        SET booking_id = CONCAT('PV', LPAD(id, 4, '0'))
        WHERE booking_id IS NULL OR booking_id = ''
    ";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute();
    
    echo json_encode([
        'success' => true,
        'message' => "Duplicate cleanup completed successfully!",
        'duplicates_found' => count($duplicates),
        'duplicate_groups_cleaned' => $cleaned_count,
        'duplicate_records_deleted' => $deleted_count,
        'remaining_records' => $pdo->query("SELECT COUNT(*) FROM home_bookings")->fetchColumn()
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error cleaning duplicates: ' . $e->getMessage()
    ]);
}
?> 