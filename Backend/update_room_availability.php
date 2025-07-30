<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

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

// Get request method
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Get room availability data
    $roomType = $_GET['room_type'] ?? '';
    
    if (empty($roomType)) {
        // Get all room availability
        $sql = "SELECT * FROM room_availability ORDER BY room_type, check_in_date";
        $result = $conn->query($sql);
        
        $availability = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $availability[] = $row;
            }
        }
        
        echo json_encode([
            'success' => true,
            'availability' => $availability
        ]);
    } else {
        // Get specific room type availability
        $stmt = $conn->prepare("SELECT * FROM room_availability WHERE room_type = ? ORDER BY check_in_date");
        $stmt->bind_param("s", $roomType);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $availability = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $availability[] = $row;
            }
        }
        
        echo json_encode([
            'success' => true,
            'room_type' => $roomType,
            'availability' => $availability
        ]);
    }
} elseif ($method === 'POST') {
    // Update room availability
    $roomType = $_POST['room_type'] ?? '';
    $checkInDate = $_POST['check_in_date'] ?? '';
    $checkOutDate = $_POST['check_out_date'] ?? '';
    $totalRooms = intval($_POST['total_rooms'] ?? 10);
    $availableRooms = intval($_POST['available_rooms'] ?? 10);
    
    if (empty($roomType) || empty($checkInDate) || empty($checkOutDate)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        exit();
    }
    
    // Check if record exists
    $stmt = $conn->prepare("SELECT id FROM room_availability WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
    $stmt->bind_param("sss", $roomType, $checkInDate, $checkOutDate);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Update existing record
        $stmt = $conn->prepare("UPDATE room_availability SET total_rooms = ?, available_rooms = ?, updated_at = CURRENT_TIMESTAMP WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
        $stmt->bind_param("iisss", $totalRooms, $availableRooms, $roomType, $checkInDate, $checkOutDate);
    } else {
        // Insert new record
        $stmt = $conn->prepare("INSERT INTO room_availability (room_type, total_rooms, available_rooms, check_in_date, check_out_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("siiss", $roomType, $totalRooms, $availableRooms, $checkInDate, $checkOutDate);
    }
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Room availability updated successfully',
            'data' => [
                'room_type' => $roomType,
                'check_in_date' => $checkInDate,
                'check_out_date' => $checkOutDate,
                'total_rooms' => $totalRooms,
                'available_rooms' => $availableRooms
            ]
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error updating room availability: ' . $stmt->error]);
    }
} elseif ($method === 'DELETE') {
    // Delete room availability record
    $roomType = $_GET['room_type'] ?? '';
    $checkInDate = $_GET['check_in_date'] ?? '';
    $checkOutDate = $_GET['check_out_date'] ?? '';
    
    if (empty($roomType) || empty($checkInDate) || empty($checkOutDate)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Missing required parameters']);
        exit();
    }
    
    $stmt = $conn->prepare("DELETE FROM room_availability WHERE room_type = ? AND check_in_date = ? AND check_out_date = ?");
    $stmt->bind_param("sss", $roomType, $checkInDate, $checkOutDate);
    
    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => 'Room availability record deleted successfully'
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Error deleting room availability: ' . $stmt->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
}

$conn->close();
?> 