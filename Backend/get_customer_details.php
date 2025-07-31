<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

try {
    $email = $_GET['email'] ?? '';
    
    if (empty($email)) {
        throw new Exception("Email parameter is required");
    }
    
    // Get customer details and all their bookings
    $customer_sql = "SELECT 
                        customer_name,
                        customer_email,
                        customer_phone,
                        MIN(created_at) as join_date,
                        COUNT(*) as total_bookings,
                        SUM(total_amount) as total_spent,
                        MAX(total_amount) as highest_booking,
                        MAX(created_at) as last_booking,
                        COALESCE(MAX(customer_status), 
                        CASE 
                            WHEN SUM(total_amount) > 5000 THEN 'VIP'
                            WHEN COUNT(*) > 5 THEN 'Active'
                            WHEN COUNT(*) > 1 THEN 'Regular'
                            ELSE 'Non-VIP'
                        END) as customer_status
                      FROM home_bookings 
                      WHERE customer_email = ?
                      GROUP BY customer_email, customer_name, customer_phone";
    
    $stmt = $conn->prepare($customer_sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("Customer not found");
    }
    
    $customer = $result->fetch_assoc();
    
    // Get all bookings for this customer
    $bookings_sql = "SELECT 
                        id,
                        booking_id,
                        room_type,
                        check_in_date,
                        check_out_date,
                        num_guests,
                        num_rooms,
                        total_amount,
                        status,
                        special_instructions,
                        created_at
                      FROM home_bookings 
                      WHERE customer_email = ?
                      ORDER BY created_at DESC";
    
    $bookings_stmt = $conn->prepare($bookings_sql);
    $bookings_stmt->bind_param("s", $email);
    $bookings_stmt->execute();
    $bookings_result = $bookings_stmt->get_result();
    
    $bookings = [];
    while ($booking = $bookings_result->fetch_assoc()) {
        $bookings[] = [
            'id' => $booking['id'],
            'booking_id' => $booking['booking_id'],
            'room_type' => $booking['room_type'],
            'check_in_date' => $booking['check_in_date'],
            'check_out_date' => $booking['check_out_date'],
            'num_guests' => $booking['num_guests'],
            'num_rooms' => $booking['num_rooms'],
            'total_amount' => number_format($booking['total_amount'], 2),
            'status' => ucfirst($booking['status']),
            'special_instructions' => $booking['special_instructions'] ?: 'None',
            'created_at' => date('M d, Y', strtotime($booking['created_at']))
        ];
    }
    
    $response = [
        'success' => true,
        'customer' => [
            'name' => $customer['customer_name'],
            'email' => $customer['customer_email'],
            'phone' => $customer['customer_phone'],
            'join_date' => date('M d, Y', strtotime($customer['join_date'])),
            'total_bookings' => $customer['total_bookings'],
            'total_spent' => number_format($customer['total_spent'], 2),
            'highest_booking' => number_format($customer['highest_booking'], 2),
            'last_booking' => date('M d, Y', strtotime($customer['last_booking'])),
            'status' => $customer['customer_status'],
            'is_vip' => ($customer['total_spent'] > 5000 || $customer['total_bookings'] > 5) ? 'Yes' : 'No'
        ],
        'bookings' => $bookings
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();
?> 