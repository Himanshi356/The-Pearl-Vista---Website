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
    
    // Check if the unique constraint already exists
    $check_constraint_sql = "
        SELECT CONSTRAINT_NAME
        FROM information_schema.TABLE_CONSTRAINTS
        WHERE TABLE_SCHEMA = 'the_pearl_vista'
        AND TABLE_NAME = 'home_bookings'
        AND CONSTRAINT_TYPE = 'UNIQUE'
        AND CONSTRAINT_NAME = 'unique_booking_fields'
    ";
    
    $constraint_exists = $pdo->query($check_constraint_sql)->fetch();
    
    if ($constraint_exists) {
        echo json_encode([
            'success' => true,
            'message' => 'Unique constraint already exists on home_bookings table',
            'constraint_name' => $constraint_exists['CONSTRAINT_NAME']
        ]);
    } else {
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
        
        echo json_encode([
            'success' => true,
            'message' => 'Unique constraint added successfully to prevent future duplicates'
        ]);
    }
    
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Error with unique constraint: ' . $e->getMessage()
    ]);
}
?> 