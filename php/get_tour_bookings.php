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
$dbname = "pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

// Get all tour bookings ordered by creation date (newest first)
$sql = "SELECT * FROM tour_bookings ORDER BY created_at DESC";
$result = $conn->query($sql);

if (!$result) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Error retrieving bookings: ' . $conn->error]);
    exit();
}

$bookings = [];
while ($row = $result->fetch_assoc()) {
    $bookings[] = [
        'id' => $row['id'],
        'full_name' => $row['full_name'],
        'email' => $row['email'],
        'phone' => $row['phone'],
        'tour_date' => $row['tour_date'],
        'tour_time' => $row['tour_time'],
        'places_to_visit' => $row['places_to_visit'],
        'number_of_travellers' => $row['number_of_travellers'],
        'vehicle_type' => $row['vehicle_type'],
        'amount_paid' => $row['amount_paid'],
        'status' => $row['status'],
        'created_at' => $row['created_at'],
        'updated_at' => $row['updated_at']
    ];
}

echo json_encode([
    'success' => true,
    'bookings' => $bookings,
    'count' => count($bookings)
]);

$conn->close();
?> 