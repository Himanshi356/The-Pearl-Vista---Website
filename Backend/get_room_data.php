<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');
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
$dbname = "the_pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Get room pricing from database
$roomPrices = [];
$sql = "SELECT room_type, base_price FROM room_types WHERE status = 'active'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $roomPrices[$row['room_type']] = floatval($row['base_price']);
    }
}

// Get request type
$requestType = $_GET['type'] ?? 'pricing';

if ($requestType === 'pricing') {
    // Return room pricing data
    echo json_encode([
        'success' => true,
        'pricing' => $roomPrices
    ]);
} elseif ($requestType === 'availability') {
    // Get availability parameters
    $roomType = $_GET['room_type'] ?? '';
    $checkInDate = $_GET['check_in_date'] ?? '';
    $checkOutDate = $_GET['check_out_date'] ?? '';
    
    if (empty($roomType) || empty($checkInDate) || empty($checkOutDate)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        exit();
    }
    
    // Check availability in database
    $stmt = $conn->prepare("SELECT available_rooms FROM room_availability WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
    $stmt->bind_param("sss", $roomType, $checkInDate, $checkOutDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $availability = $result->fetch_assoc();
        $availableRooms = $availability['available_rooms'];
    } else {
        // Default availability if no record exists
        $availableRooms = 10;
    }
    
    echo json_encode([
        'success' => true,
        'room_type' => $roomType,
        'check_in_date' => $checkInDate,
        'check_out_date' => $checkOutDate,
        'available_rooms' => $availableRooms,
        'price_per_night' => $roomPrices[$roomType] ?? 0
    ]);
} elseif ($requestType === 'calculate') {
    // Calculate total amount
    $roomType = $_GET['room_type'] ?? '';
    $numRooms = intval($_GET['num_rooms'] ?? 1);
    $checkInDate = $_GET['check_in_date'] ?? '';
    $checkOutDate = $_GET['check_out_date'] ?? '';
    $numGuests = intval($_GET['num_guests'] ?? 1);
    $guestAges = json_decode($_GET['guest_ages'] ?? '[]', true);
    
    if (empty($roomType) || empty($checkInDate) || empty($checkOutDate)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        exit();
    }
    
    // Calculate number of nights
    $checkin = new DateTime($checkInDate);
    $checkout = new DateTime($checkOutDate);
    $nights = $checkout->diff($checkin)->days;
    
    if ($nights <= 0) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid date range']);
        exit();
    }
    
    // Calculate base amount
    $basePrice = $roomPrices[$roomType] ?? 0;
    $baseAmount = $basePrice * $numRooms * $nights;
    
    // Calculate extra guest charges
    $extraGuestCharge = 0;
    if (!empty($guestAges)) {
        $numAdults = 0;
        foreach ($guestAges as $age) {
            if (intval($age) > 16) {
                $numAdults++;
            }
        }
        
        $standardCapacity = $numRooms * 2;
        $extraAdults = max(0, $numAdults - $standardCapacity);
        $extraGuestCharge = $extraAdults * 2500 * $nights;
    }
    
    $totalAmount = $baseAmount + $extraGuestCharge;
    
    echo json_encode([
        'success' => true,
        'calculation' => [
            'room_type' => $roomType,
            'num_rooms' => $numRooms,
            'nights' => $nights,
            'base_price_per_night' => $basePrice,
            'base_amount' => $baseAmount,
            'extra_guest_charge' => $extraGuestCharge,
            'total_amount' => $totalAmount
        ]
    ]);
} else {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Invalid request type']);
}

$conn->close();
?> 