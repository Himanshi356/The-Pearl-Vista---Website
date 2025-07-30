<?php
// Get Service Bookings - Admin Panel
// This file retrieves service bookings for the admin dashboard

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set headers for JSON response
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow GET requests
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Database configuration
$host = 'localhost';
$dbname = 'the_pearl_vista';
$username = 'root';
$password = '';

try {
    // Create database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get query parameters
    $status = $_GET['status'] ?? '';
    $limit = intval($_GET['limit'] ?? 50);
    $offset = intval($_GET['offset'] ?? 0);
    $search = $_GET['search'] ?? '';
    
    // Build the SQL query
    $sql = "SELECT * FROM service_bookings WHERE 1=1";
    $params = [];
    
    // Add status filter if provided
    if (!empty($status)) {
        $sql .= " AND status = :status";
        $params[':status'] = $status;
    }
    
    // Add search filter if provided
    if (!empty($search)) {
        $sql .= " AND (booking_id LIKE :search OR username LIKE :search OR email LIKE :search OR phone_number LIKE :search)";
        $params[':search'] = "%$search%";
    }
    
    // Add ordering and pagination
    $sql .= " ORDER BY created_at DESC LIMIT :limit OFFSET :offset";
    $params[':limit'] = $limit;
    $params[':offset'] = $offset;
    
    $stmt = $pdo->prepare($sql);
    
    // Bind parameters
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }
    
    $stmt->execute();
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get total count for pagination
    $countSql = "SELECT COUNT(*) as total FROM service_bookings WHERE 1=1";
    if (!empty($status)) {
        $countSql .= " AND status = :status";
    }
    if (!empty($search)) {
        $countSql .= " AND (booking_id LIKE :search OR username LIKE :search OR email LIKE :search OR phone_number LIKE :search)";
    }
    
    $countStmt = $pdo->prepare($countSql);
    foreach ($params as $key => $value) {
        if ($key !== ':limit' && $key !== ':offset') {
            $countStmt->bindValue($key, $value);
        }
    }
    $countStmt->execute();
    $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    // Process bookings to decode JSON fields
    foreach ($bookings as &$booking) {
        if (isset($booking['selected_services'])) {
            $booking['selected_services'] = json_decode($booking['selected_services'], true);
        }
        if (isset($booking['additional_services'])) {
            $booking['additional_services'] = json_decode($booking['additional_services'], true);
        }
    }
    
    // Prepare response data
    $responseData = [
        'success' => true,
        'bookings' => $bookings,
        'pagination' => [
            'total' => intval($totalCount),
            'limit' => $limit,
            'offset' => $offset,
            'has_more' => ($offset + $limit) < $totalCount
        ]
    ];
    
    // Return success response
    echo json_encode($responseData);
    
} catch (PDOException $e) {
    // Log the error
    error_log("Database error in get_service_bookings.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Database error occurred',
        'error' => $e->getMessage()
    ]);
    
} catch (Exception $e) {
    // Log the error
    error_log("General error in get_service_bookings.php: " . $e->getMessage());
    
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An error occurred while retrieving bookings',
        'error' => $e->getMessage()
    ]);
}
?> 