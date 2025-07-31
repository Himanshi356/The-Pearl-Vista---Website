<?php
session_start();
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        echo json_encode(['success' => false, 'message' => 'No data received']);
        exit();
    }
    
    // Extract booking data with proper trimming and validation
    $customer_name = trim($data['customer_name'] ?? '');
    $customer_email = trim($data['customer_email'] ?? '');
    $customer_phone = trim($data['customer_phone'] ?? '');
    $room_type = trim($data['room_type'] ?? '');
    $check_in_date = trim($data['check_in_date'] ?? '');
    $check_out_date = trim($data['check_out_date'] ?? '');
    $num_guests = intval($data['num_guests'] ?? 1);
    $num_rooms = intval($data['num_rooms'] ?? 1);
    $total_amount = floatval($data['total_amount'] ?? 0);
    $special_instructions = trim($data['special_instructions'] ?? '');
    $guest_ages = $data['guest_ages'] ?? [];
    $id_type = trim($data['id_type'] ?? '');
    $id_upload_path = trim($data['id_upload_path'] ?? '');
    
    // Validate required fields
    if (empty($customer_name) || empty($customer_email) || empty($room_type) || 
        empty($check_in_date) || empty($check_out_date)) {
        echo json_encode(['success' => false, 'message' => 'Missing required fields']);
        exit();
    }
    
    // Start transaction with SERIALIZABLE isolation level for maximum consistency
    $pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
    $pdo->beginTransaction();
    
    try {
        // Use a more comprehensive duplicate check with exact matching
        $duplicate_check_sql = "
            SELECT id, booking_id, created_at 
            FROM home_bookings 
            WHERE customer_email = ? 
            AND customer_name = ? 
            AND room_type = ? 
            AND check_in_date = ? 
            AND check_out_date = ? 
            AND num_guests = ? 
            AND num_rooms = ? 
            AND total_amount = ?
            AND special_instructions = ?
            LIMIT 1
        ";
        
        $duplicate_stmt = $pdo->prepare($duplicate_check_sql);
        $duplicate_stmt->execute([
            $customer_email,
            $customer_name,
            $room_type,
            $check_in_date,
            $check_out_date,
            $num_guests,
            $num_rooms,
            $total_amount,
            $special_instructions
        ]);
        
        $existing_booking = $duplicate_stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existing_booking) {
            $pdo->rollBack();
            echo json_encode([
                'success' => false, 
                'message' => 'A booking with these exact details already exists. Please check your email for confirmation.',
                'duplicate' => true,
                'booking_id' => $existing_booking['id'],
                'existing_booking_id' => $existing_booking['booking_id'],
                'created_at' => $existing_booking['created_at']
            ]);
            exit();
        }
    
        // Generate unique booking ID with timestamp to ensure uniqueness
        $timestamp = microtime(true);
        $booking_id = 'PV' . date('Ymd') . sprintf('%06d', ($timestamp - floor($timestamp)) * 1000000);
        
        // Double-check booking_id uniqueness
        $id_check_stmt = $pdo->prepare("SELECT id FROM home_bookings WHERE booking_id = ?");
        $id_check_stmt->execute([$booking_id]);
        
        if ($id_check_stmt->fetch()) {
            // If somehow duplicate, generate a new one
            $booking_id = 'PV' . date('Ymd') . sprintf('%06d', ($timestamp - floor($timestamp)) * 1000000) . rand(100, 999);
        }
        
        // Insert the booking
        $insert_sql = "
            INSERT INTO home_bookings (
                booking_id, customer_name, customer_email, customer_phone,
                room_type, check_in_date, check_out_date, num_guests,
                num_rooms, total_amount, special_instructions, guest_ages,
                id_type, id_upload_path, status, created_at, updated_at
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', NOW(), NOW()
            )
        ";
        
        $stmt = $pdo->prepare($insert_sql);
        $result = $stmt->execute([
            $booking_id,
            $customer_name,
            $customer_email,
            $customer_phone,
            $room_type,
            $check_in_date,
            $check_out_date,
            $num_guests,
            $num_rooms,
            $total_amount,
            $special_instructions,
            json_encode($guest_ages),
            $id_type,
            $id_upload_path
        ]);
        
        if ($result) {
            $new_booking_id = $pdo->lastInsertId();
            $pdo->commit();
            
            echo json_encode([
                'success' => true,
                'message' => 'Booking created successfully!',
                'booking_id' => $new_booking_id,
                'unique_id' => $booking_id
            ]);
        } else {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => 'Failed to create booking']);
        }
        
    } catch (Exception $e) {
        $pdo->rollBack();
        
        // Check if this is a duplicate key error
        if (strpos($e->getMessage(), 'Duplicate entry') !== false || 
            strpos($e->getMessage(), 'unique_booking_fields') !== false ||
            strpos($e->getMessage(), 'Duplicate key') !== false) {
            
            // Find the existing booking
            $existing_check_sql = "
                SELECT id, booking_id, created_at FROM home_bookings 
                WHERE customer_email = ? 
                AND customer_name = ? 
                AND room_type = ? 
                AND check_in_date = ? 
                AND check_out_date = ? 
                AND num_guests = ? 
                AND num_rooms = ? 
                AND total_amount = ?
                AND special_instructions = ?
                LIMIT 1
            ";
            
            $existing_stmt = $pdo->prepare($existing_check_sql);
            $existing_stmt->execute([
                $customer_email,
                $customer_name,
                $room_type,
                $check_in_date,
                $check_out_date,
                $num_guests,
                $num_rooms,
                $total_amount,
                $special_instructions
            ]);
            
            $existing = $existing_stmt->fetch(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'success' => false,
                'message' => 'A booking with these exact details already exists. Please check your email for confirmation.',
                'duplicate' => true,
                'booking_id' => $existing['id'] ?? null,
                'existing_booking_id' => $existing['booking_id'] ?? null,
                'created_at' => $existing['created_at'] ?? null
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'System error: ' . $e->getMessage()]);
}
?>