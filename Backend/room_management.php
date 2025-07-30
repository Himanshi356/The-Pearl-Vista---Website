<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
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

// Create room_types table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS room_types (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    base_price DECIMAL(10,2) NOT NULL,
    total_rooms INT(11) NOT NULL DEFAULT 10,
    floor_number INT(11) DEFAULT 1,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error creating room_types table']);
    exit();
}

// Insert default room types if table is empty
$result = $conn->query("SELECT COUNT(*) as count FROM room_types");
$row = $result->fetch_assoc();
if ($row['count'] == 0) {
    $defaultRooms = [
        ['Pearl Signature Room', 'King bed, skyline balcony, butler service, jacuzzi, and 24/7 dining', 20695, 25, 6],
        ['Deluxe Room', 'King bed, modern ensuite, WiFi, tea/coffee set, and daily housekeeping', 3240, 140, 1],
        ['Premium Room', 'King bed, city view lounge, minibar, smart TV, and welcome amenities', 5580, 130, 2],
        ['Executive Room', 'Executive king bed, workspace, lounge access, Nespresso, and concierge', 8790, 120, 3],
        ['Luxury Suite', 'King bed, private lounge, butler service, marble bath, and VIP perks', 11920, 110, 4],
        ['Family Suite', 'Two bedrooms (king + twin), living area, kid-friendly amenities, and late check-out', 14855, 100, 5]
    ];
    
    $stmt = $conn->prepare("INSERT INTO room_types (room_type, description, base_price, total_rooms, floor_number) VALUES (?, ?, ?, ?, ?)");
    
    foreach ($defaultRooms as $room) {
        $stmt->bind_param("ssdii", $room[0], $room[1], $room[2], $room[3], $room[4]);
        $stmt->execute();
    }
    
    $stmt->close();
}

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

switch ($method) {
    case 'GET':
        if ($action === 'list') {
            // Get all room types
            $sql = "SELECT * FROM room_types WHERE status = 'active' ORDER BY base_price ASC";
            $result = $conn->query($sql);
            
            $rooms = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $rooms[] = $row;
                }
            }
            
            echo json_encode([
                'success' => true,
                'rooms' => $rooms
            ]);
        } elseif ($action === 'pricing') {
            // Get room pricing
            $sql = "SELECT room_type, base_price FROM room_types WHERE status = 'active'";
            $result = $conn->query($sql);
            
            $pricing = [];
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $pricing[$row['room_type']] = floatval($row['base_price']);
                }
            }
            
            echo json_encode([
                'success' => true,
                'pricing' => $pricing
            ]);
        } elseif ($action === 'get') {
            // Get specific room type
            $id = intval($_GET['id'] ?? 0);
            
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid room ID']);
                exit();
            }
            
            $stmt = $conn->prepare("SELECT * FROM room_types WHERE id = ? AND status = 'active'");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Room type not found']);
                exit();
            }
            
            $room = $result->fetch_assoc();
            echo json_encode([
                'success' => true,
                'room' => $room
            ]);
            
            $stmt->close();
        } elseif ($action === 'calculate') {
            // Calculate booking total
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
            
            // Get room price
            $stmt = $conn->prepare("SELECT base_price FROM room_types WHERE room_type = ? AND status = 'active'");
            $stmt->bind_param("s", $roomType);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows === 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Room type not found']);
                exit();
            }
            
            $room = $result->fetch_assoc();
            $basePrice = floatval($room['base_price']);
            
            // Calculate number of nights
            $checkIn = new DateTime($checkInDate);
            $checkOut = new DateTime($checkOutDate);
            $nights = $checkIn->diff($checkOut)->days;
            
            if ($nights <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid date range']);
                exit();
            }
            
            // Calculate base amount
            $baseAmount = $basePrice * $numRooms * $nights;
            
            // Calculate extra guest charges (2 adults per room standard, $2500 per extra adult)
            $numAdults = 0;
            if (is_array($guestAges)) {
                $numAdults = count(array_filter($guestAges, function($age) {
                    return intval($age) > 16;
                }));
            }
            
            $standardCapacity = $numRooms * 2;
            $extraAdults = max(0, $numAdults - $standardCapacity);
            $extraGuestCharge = $extraAdults * 2500 * $nights;
            
            $totalAmount = $baseAmount + $extraGuestCharge;
            
            echo json_encode([
                'success' => true,
                'calculation' => [
                    'base_price' => $basePrice,
                    'num_rooms' => $numRooms,
                    'nights' => $nights,
                    'base_amount' => $baseAmount,
                    'num_adults' => $numAdults,
                    'standard_capacity' => $standardCapacity,
                    'extra_adults' => $extraAdults,
                    'extra_guest_charge' => $extraGuestCharge,
                    'total_amount' => $totalAmount
                ]
            ]);
            
            $stmt->close();
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
        break;
        
    case 'POST':
        if ($action === 'add') {
            // Add new room type
            $data = json_decode(file_get_contents('php://input'), true);
            
            $roomType = $data['room_type'] ?? '';
            $description = $data['description'] ?? '';
            $basePrice = floatval($data['base_price'] ?? 0);
            $totalRooms = intval($data['total_rooms'] ?? 10);
            $floorNumber = intval($data['floor_number'] ?? 1);
            
            if (empty($roomType) || $basePrice <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid room data']);
                exit();
            }
            
            $stmt = $conn->prepare("INSERT INTO room_types (room_type, description, base_price, total_rooms, floor_number) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("ssdii", $roomType, $description, $basePrice, $totalRooms, $floorNumber);
            
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Room type added successfully',
                    'id' => $conn->insert_id
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error adding room type']);
            }
            
            $stmt->close();
        } elseif ($action === 'update') {
            // Update room type
            $data = json_decode(file_get_contents('php://input'), true);
            
            $id = intval($data['id'] ?? 0);
            $roomType = $data['room_type'] ?? '';
            $description = $data['description'] ?? '';
            $basePrice = floatval($data['base_price'] ?? 0);
            $totalRooms = intval($data['total_rooms'] ?? 10);
            $floorNumber = intval($data['floor_number'] ?? 1);
            
            if ($id <= 0 || empty($roomType) || $basePrice <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid room data']);
                exit();
            }
            
            $stmt = $conn->prepare("UPDATE room_types SET room_type = ?, description = ?, base_price = ?, total_rooms = ?, floor_number = ? WHERE id = ?");
            $stmt->bind_param("ssdiii", $roomType, $description, $basePrice, $totalRooms, $floorNumber, $id);
            
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Room type updated successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error updating room type']);
            }
            
            $stmt->close();
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
        break;
        
    case 'DELETE':
        if ($action === 'delete') {
            // Delete room type (soft delete by setting status to inactive)
            $id = intval($_GET['id'] ?? 0);
            
            if ($id <= 0) {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid room ID']);
                exit();
            }
            
            $stmt = $conn->prepare("UPDATE room_types SET status = 'inactive' WHERE id = ?");
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Room type deleted successfully'
                ]);
            } else {
                http_response_code(500);
                echo json_encode(['success' => false, 'message' => 'Error deleting room type']);
            }
            
            $stmt->close();
        } else {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
        }
        break;
        
    default:
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        break;
}

$conn->close();
?> 