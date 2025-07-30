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
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pear_lvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

try {
    $booking_id = isset($_GET['booking_id']) ? trim($_GET['booking_id']) : '';
    
    if (empty($booking_id)) {
        throw new Exception('Booking ID is required');
    }
    
    // Determine which table to query based on booking ID
    if (strpos($booking_id, 'TOUR') === 0) {
        // Get tour booking details
        $table = 'tour_bookings';
        $id_column = 'id';
        $actual_id = str_replace('TOUR', '', $booking_id);
        
        $sql = "SELECT 
                    id,
                    full_name as customer_name,
                    email as customer_email,
                    phone as customer_phone,
                    tour_date as check_in_date,
                    DATE_ADD(tour_date, INTERVAL 1 DAY) as check_out_date,
                    number_of_travellers as num_guests,
                    1 as num_rooms,
                    amount_paid as total_amount,
                    status,
                    places_to_visit as special_instructions,
                    vehicle_type,
                    created_at,
                    'tour' as booking_type
                FROM tour_bookings 
                WHERE id = ?";
    } else {
        // Get home booking details
        $table = 'home_bookings';
        $id_column = 'id';
        $actual_id = str_replace('PV', '', $booking_id);
        
        $sql = "SELECT 
                    id,
                    customer_name,
                    customer_email,
                    customer_phone,
                    check_in_date,
                    check_out_date,
                    num_guests,
                    num_rooms,
                    total_amount,
                    status,
                    special_instructions,
                    room_type,
                    id_type,
                    id_upload_path,
                    guest_ages,
                    created_at,
                    'home' as booking_type
                FROM home_bookings 
                WHERE id = ?";
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $actual_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows === 0) {
        throw new Exception("No booking found with ID: $booking_id");
    }
    
    $booking = $result->fetch_assoc();
    
    // Format the response
    $response = [
        'success' => true,
        'booking' => [
            'id' => $booking['id'],
            'booking_id' => $booking_id,
            'customer_name' => $booking['customer_name'],
            'customer_email' => $booking['customer_email'],
            'customer_phone' => $booking['customer_phone'],
            'check_in_date' => $booking['check_in_date'],
            'check_out_date' => $booking['check_out_date'],
            'num_guests' => $booking['num_guests'],
            'num_rooms' => $booking['num_rooms'],
            'total_amount' => number_format($booking['total_amount'], 0),
            'status' => ucfirst($booking['status']),
            'payment_status' => getPaymentStatus($booking['status']),
            'special_instructions' => $booking['special_instructions'] ?: '-',
            'booking_type' => $booking['booking_type'],
            'created_at' => $booking['created_at']
        ]
    ];
    
    // Add type-specific fields
    if ($booking['booking_type'] === 'tour') {
        $response['booking']['vehicle_type'] = $booking['vehicle_type'];
        $response['booking']['room_type'] = 'Tour Package';
        $response['booking']['room_number'] = 'N/A';
    } else {
        $response['booking']['room_type'] = $booking['room_type'];
        $response['booking']['room_number'] = generateRoomNumber($booking['room_type']);
        $response['booking']['id_type'] = $booking['id_type'] ?: '-';
        $response['booking']['guest_ages'] = $booking['guest_ages'] ?: '-';
        $response['booking']['id_upload_path'] = $booking['id_upload_path'] ?: '-';
    }
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();

// Helper function to determine payment status based on booking status
function getPaymentStatus($status) {
    $status = strtolower($status);
    
    switch ($status) {
        case 'confirmed':
        case 'checked-in':
        case 'checked-out':
            return 'Paid';
        case 'pending':
            return 'Pending';
        case 'cancelled':
            return 'Failed';
        default:
            return 'Pending';
    }
}

// Helper function to generate room number based on room type
function generateRoomNumber($roomType) {
    $roomNumbers = [
        'Pearl Signature Room' => rand(750, 799),
        'Deluxe Room' => rand(100, 199),
        'Premium Room' => rand(250, 299),
        'Executive Room' => rand(400, 499),
        'Luxury Suite' => rand(500, 599),
        'Family Suite' => rand(650, 699)
    ];
    
    return $roomNumbers[$roomType] ?? rand(100, 999);
}
