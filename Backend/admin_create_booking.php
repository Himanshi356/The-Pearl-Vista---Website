<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

try {
    require_once '../Config/database.php';
    $pdo = getDatabaseConnection();

    // Get form data
    $customer_name = trim($_POST['customer_name'] ?? '');
    $customer_phone = trim($_POST['customer_phone'] ?? '');
    $customer_email = trim($_POST['customer_email'] ?? '');
    $check_in_date = $_POST['check_in_date'] ?? '';
    $check_out_date = $_POST['check_out_date'] ?? '';
    $num_guests = intval($_POST['num_guests'] ?? 1);
    $num_rooms = intval($_POST['num_rooms'] ?? 1);
    $room_type = trim($_POST['room_type'] ?? '');
    $special_instructions = trim($_POST['special_instructions'] ?? '');
    $status = 'confirmed'; // Default to confirmed for admin bookings

    // Validate required fields
    if (empty($customer_name) || empty($customer_phone) || empty($customer_email) || 
        empty($check_in_date) || empty($check_out_date) || empty($room_type)) {
        echo json_encode(['status' => 'error', 'message' => 'All required fields must be filled']);
        exit();
    }

    // Validate email format
    if (!filter_var($customer_email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid email format']);
        exit();
    }

    // Validate dates
    $check_in = new DateTime($check_in_date);
    $check_out = new DateTime($check_out_date);
    $today = new DateTime();

    if ($check_in < $today) {
        echo json_encode(['status' => 'error', 'message' => 'Check-in date cannot be in the past']);
        exit();
    }

    if ($check_out <= $check_in) {
        echo json_encode(['status' => 'error', 'message' => 'Check-out date must be after check-in date']);
        exit();
    }

    // Calculate number of nights
    $nights = $check_in->diff($check_out)->days;

    // Get room price based on room type
    $room_prices = [
        'Pearl Signature Room' => 20695,
        'Deluxe Room' => 3240,
        'Premium Room' => 5580,
        'Executive Room' => 8790,
        'Luxury Suite' => 11920,
        'Family Suite' => 14855
    ];

    $price_per_night = $room_prices[$room_type] ?? 0;
    if ($price_per_night === 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid room type selected']);
        exit();
    }

    // Calculate total amount
    $total_amount = $price_per_night * $nights * $num_rooms;

    // Generate unique booking ID
    $booking_id = 'PV' . date('Ymd') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

    // Insert booking into database
    $stmt = $pdo->prepare("
        INSERT INTO home_bookings (
            booking_id, customer_name, customer_phone, customer_email,
            check_in_date, check_out_date, num_guests, num_rooms,
            room_type, total_amount, special_instructions, status,
            created_at, updated_at
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
    ");

    $result = $stmt->execute([
        $booking_id,
        $customer_name,
        $customer_phone,
        $customer_email,
        $check_in_date,
        $check_out_date,
        $num_guests,
        $num_rooms,
        $room_type,
        $total_amount,
        $special_instructions,
        $status
    ]);

    if ($result) {
        // Log admin activity
        $admin_id = $_SESSION['user'];
        $log_stmt = $pdo->prepare("
            INSERT INTO admin_activity_log (admin_id, action, description, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $log_stmt->execute([
            $admin_id,
            'CREATE_BOOKING',
            "Created booking $booking_id for $customer_name",
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);

        echo json_encode([
            'status' => 'success',
            'message' => 'Booking created successfully',
            'booking_id' => $booking_id,
            'total_amount' => $total_amount,
            'nights' => $nights
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to create booking']);
    }

} catch (Exception $e) {
    error_log("Admin booking creation error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
} catch (Error $e) {
    error_log("Fatal admin booking creation error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred']);
}
?> 