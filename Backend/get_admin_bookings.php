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
    // Get all bookings from home_bookings table
    $sql = "SELECT 
                id,
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
                booking_id,
                special_instructions,
                created_at
            FROM home_bookings 
            ORDER BY created_at DESC";
    
    $result = $conn->query($sql);
    
    if (!$result) {
        throw new Exception("Error fetching bookings: " . $conn->error);
    }
    
    $bookings = [];
    while ($row = $result->fetch_assoc()) {
        // Generate booking ID if not exists
        if (empty($row['booking_id'])) {
            $booking_id = 'PV' . str_pad($row['id'], 4, '0', STR_PAD_LEFT);
            $update_sql = "UPDATE home_bookings SET booking_id = ? WHERE id = ?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("si", $booking_id, $row['id']);
            $stmt->execute();
            $stmt->close();
            $row['booking_id'] = $booking_id;
        }
        
        // Format the booking data for admin dashboard
        $booking = [
            'id' => $row['id'],
            'booking_id' => $row['booking_id'],
            'customer_name' => $row['customer_name'],
            'customer_email' => $row['customer_email'],
            'customer_phone' => $row['customer_phone'],
            'room_type' => $row['room_type'],
            'room_number' => generateRoomNumber($row['room_type']), // Generate room number
            'check_in_date' => $row['check_in_date'],
            'check_out_date' => $row['check_out_date'],
            'num_guests' => $row['num_guests'],
            'num_rooms' => $row['num_rooms'],
            'total_amount' => number_format($row['total_amount'], 0),
            'status' => ucfirst($row['status']),
            'payment_status' => getPaymentStatus($row['status']),
            'special_instructions' => $row['special_instructions'] ?: '-',
            'created_at' => $row['created_at']
        ];
        
        $bookings[] = $booking;
    }
    
    // Get tour bookings as well
    $tour_sql = "SELECT 
                    id,
                    full_name as customer_name,
                    email as customer_email,
                    phone as customer_phone,
                    'Tour Package' as room_type,
                    tour_date as check_in_date,
                    DATE_ADD(tour_date, INTERVAL 1 DAY) as check_out_date,
                    number_of_travellers as num_guests,
                    1 as num_rooms,
                    amount_paid as total_amount,
                    status,
                    CONCAT('TOUR', LPAD(id, 4, '0')) as booking_id,
                    places_to_visit as special_instructions,
                    created_at
                FROM tour_bookings 
                ORDER BY created_at DESC";
    
    $tour_result = $conn->query($tour_sql);
    
    if ($tour_result) {
        while ($row = $tour_result->fetch_assoc()) {
            $booking = [
                'id' => 'T' . $row['id'],
                'booking_id' => $row['booking_id'],
                'customer_name' => $row['customer_name'],
                'customer_email' => $row['customer_email'],
                'customer_phone' => $row['customer_phone'],
                'room_type' => $row['room_type'],
                'room_number' => 'N/A',
                'check_in_date' => $row['check_in_date'],
                'check_out_date' => $row['check_out_date'],
                'num_guests' => $row['num_guests'],
                'num_rooms' => $row['num_rooms'],
                'total_amount' => number_format($row['total_amount'], 0),
                'status' => ucfirst($row['status']),
                'payment_status' => getPaymentStatus($row['status']),
                'special_instructions' => $row['special_instructions'] ?: '-',
                'created_at' => $row['created_at']
            ];
            
            $bookings[] = $booking;
        }
    }
    
    // Sort all bookings by creation date (newest first)
    usort($bookings, function($a, $b) {
        return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
    
    echo json_encode([
        'success' => true,
        'bookings' => $bookings,
        'total_count' => count($bookings)
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

$conn->close();

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
