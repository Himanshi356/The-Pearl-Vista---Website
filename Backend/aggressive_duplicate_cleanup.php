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
    
    // Step 1: Find all duplicate bookings
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
            COUNT(*) as duplicate_count,
            GROUP_CONCAT(id ORDER BY id) as booking_ids,
            GROUP_CONCAT(booking_id ORDER BY id) as booking_id_list,
            GROUP_CONCAT(created_at ORDER BY id) as created_at_list
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
            special_instructions
        HAVING COUNT(*) > 1
        ORDER BY created_at DESC
    ";
    
    $duplicate_stmt = $pdo->query($duplicate_sql);
    $duplicates = $duplicate_stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $cleaned_count = 0;
    $deleted_count = 0;
    $kept_records = [];
    
    foreach ($duplicates as $duplicate) {
        $booking_ids = explode(',', $duplicate['booking_ids']);
        $booking_id_list = explode(',', $duplicate['booking_id_list']);
        $created_at_list = explode(',', $duplicate['created_at_list']);
        
        // Keep the first booking (lowest ID) and delete the rest
        $keep_id = array_shift($booking_ids);
        $keep_booking_id = array_shift($booking_id_list);
        $keep_created_at = array_shift($created_at_list);
        $delete_ids = $booking_ids;
        
        if (!empty($delete_ids)) {
            $delete_sql = "DELETE FROM home_bookings WHERE id IN (" . implode(',', $delete_ids) . ")";
            $delete_stmt = $pdo->prepare($delete_sql);
            $delete_stmt->execute();
            
            $deleted_count += count($delete_ids);
            $cleaned_count++;
            
            $kept_records[] = [
                'id' => $keep_id,
                'booking_id' => $keep_booking_id,
                'customer_name' => $duplicate['customer_name'],
                'customer_email' => $duplicate['customer_email'],
                'created_at' => $keep_created_at
            ];
        }
    }
    
    // Step 2: Add unique constraint if it doesn't exist
    $check_constraint_sql = "
        SELECT CONSTRAINT_NAME
        FROM information_schema.TABLE_CONSTRAINTS
        WHERE TABLE_SCHEMA = 'the_pearl_vista'
        AND TABLE_NAME = 'home_bookings'
        AND CONSTRAINT_TYPE = 'UNIQUE'
        AND CONSTRAINT_NAME = 'unique_booking_fields'
    ";
    
    $constraint_exists = $pdo->query($check_constraint_sql)->fetch();
    
    if (!$constraint_exists) {
        // Add unique constraint to prevent future duplicates
        $add_constraint_sql = "
            ALTER TABLE home_bookings
            ADD CONSTRAINT unique_booking_fields
            UNIQUE (
                customer_email,
                customer_name,
                room_type,
                check_in_date,
                check_out_date,
                num_guests,
                num_rooms,
                total_amount
            )
        ";
        
        $pdo->exec($add_constraint_sql);
        $constraint_added = true;
    } else {
        $constraint_added = false;
    }
    
    // Step 3: Update booking_id for remaining records to ensure uniqueness
    $update_sql = "
        UPDATE home_bookings
        SET booking_id = CONCAT('PV', LPAD(id, 4, '0'))
        WHERE booking_id IS NULL OR booking_id = ''
    ";
    $update_stmt = $pdo->prepare($update_sql);
    $update_stmt->execute();
    
    // Get final count
    $final_count = $pdo->query("SELECT COUNT(*) FROM home_bookings")->fetchColumn();
    
    echo json_encode([
        'success' => true,
        'message' => "Aggressive duplicate cleanup completed successfully!",
        'duplicates_found' => count($duplicates),
        'duplicate_groups_cleaned' => $cleaned_count,
        'duplicate_records_deleted' => $deleted_count,
        'kept_records' => $kept_records,
        'constraint_added' => $constraint_added,
        'remaining_records' => $final_count,
        'summary' => "Removed $deleted_count duplicate records from $cleaned_count duplicate groups. Kept the oldest record from each group."
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error during aggressive cleanup: ' . $e->getMessage()
    ]);
}
?> 