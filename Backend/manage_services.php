<?php
session_start();
header('Content-Type: application/json');

// Check admin session with proper error handling
$isAuthorized = false;
$errorMessage = '';

if (isset($_SESSION['user']) && isset($_SESSION['role'])) {
    $allowedRoles = ['admin', 'super_admin', 'manager'];
    if (in_array($_SESSION['role'], $allowedRoles)) {
        $isAuthorized = true;
    } else {
        $errorMessage = 'Insufficient privileges';
    }
} else {
    $errorMessage = 'Not logged in';
}

if (!$isAuthorized) {
    echo json_encode([
        'status' => 'error', 
        'message' => $errorMessage,
        'redirect' => 'unified-login.html'
    ]);
    exit();
}

require_once '../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    $action = $_POST['action'] ?? $_GET['action'] ?? '';
    
    switch ($action) {
        case 'get_services':
            // Get all services from service_bookings table with statistics
            $stmt = $pdo->query("
                SELECT 
                    id,
                    booking_id,
                    user_id,
                    username,
                    selected_services,
                    service_category,
                    service_date,
                    service_time,
                    guest_count,
                    special_requirements,
                    phone_number,
                    email,
                    total_amount,
                    additional_services,
                    status,
                    booking_date,
                    created_at
                FROM service_bookings
                ORDER BY created_at DESC
            ");
            
            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Get service statistics
            $statsStmt = $pdo->query("
                SELECT 
                    COUNT(*) as total_services,
                    SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as active_services,
                    SUM(total_amount) as service_revenue,
                    AVG(total_amount) as avg_rating
                FROM service_bookings
            ");
            
            $stats = $statsStmt->fetch(PDO::FETCH_ASSOC);
            
            // Get service categories
            $categoryStmt = $pdo->query("
                SELECT 
                    service_category,
                    COUNT(*) as count,
                    SUM(total_amount) as revenue
                FROM service_bookings
                GROUP BY service_category
                ORDER BY count DESC
            ");
            
            $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'status' => 'success',
                'services' => $services,
                'statistics' => $stats,
                'categories' => $categories
            ]);
            break;
            
        case 'add_service':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $serviceName = $data['service_name'] ?? '';
            $category = $data['category'] ?? '';
            $price = $data['price'] ?? 0;
            $duration = $data['duration'] ?? '';
            $status = $data['status'] ?? 'available';
            $description = $data['description'] ?? '';
            
            if (empty($serviceName) || empty($category) || empty($price)) {
                throw new Exception('Service name, category, and price are required');
            }
            
            // Create a new service booking entry (this represents a service offering)
            $stmt = $pdo->prepare("
                INSERT INTO service_bookings (
                    booking_id, user_id, username, selected_services, 
                    service_category, service_date, service_time, guest_count,
                    special_requirements, phone_number, email, total_amount,
                    additional_services, status, booking_date
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
                )
            ");
            
            $bookingId = 'SVC_' . time() . '_' . rand(1000, 9999);
            $selectedServices = json_encode([$serviceName]);
            $additionalServices = json_encode([
                'duration' => $duration,
                'description' => $description,
                'original_price' => $price
            ]);
            
            $stmt->execute([
                $bookingId,
                'admin',
                'Admin User',
                $selectedServices,
                $category,
                date('Y-m-d'),
                '00:00:00',
                1,
                $description,
                '0000000000',
                'admin@pearlvista.com',
                $price,
                $additionalServices,
                $status
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Service added successfully',
                'service_id' => $pdo->lastInsertId()
            ]);
            break;
            
        case 'update_service':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $serviceId = $data['service_id'] ?? '';
            $serviceName = $data['service_name'] ?? '';
            $category = $data['category'] ?? '';
            $price = $data['price'] ?? 0;
            $duration = $data['duration'] ?? '';
            $status = $data['status'] ?? 'available';
            $description = $data['description'] ?? '';
            
            if (empty($serviceId) || empty($serviceName) || empty($category) || empty($price)) {
                throw new Exception('Service ID, name, category, and price are required');
            }
            
            $stmt = $pdo->prepare("
                UPDATE service_bookings 
                SET selected_services = ?, 
                    service_category = ?, 
                    total_amount = ?, 
                    additional_services = ?, 
                    special_requirements = ?, 
                    status = ?,
                    updated_at = CURRENT_TIMESTAMP
                WHERE id = ?
            ");
            
            $selectedServices = json_encode([$serviceName]);
            $additionalServices = json_encode([
                'duration' => $duration,
                'description' => $description,
                'original_price' => $price
            ]);
            
            $stmt->execute([
                $selectedServices,
                $category,
                $price,
                $additionalServices,
                $description,
                $status,
                $serviceId
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Service updated successfully'
            ]);
            break;
            
        case 'delete_service':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $serviceId = $data['service_id'] ?? '';
            
            if (empty($serviceId)) {
                throw new Exception('Service ID is required');
            }
            
            $stmt = $pdo->prepare("DELETE FROM service_bookings WHERE id = ?");
            $stmt->execute([$serviceId]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Service deleted successfully'
            ]);
            break;
            
        case 'get_service_stats':
            // Get comprehensive service statistics
            $stmt = $pdo->query("
                SELECT 
                    COUNT(*) as total_services,
                    SUM(CASE WHEN status = 'confirmed' THEN 1 ELSE 0 END) as active_services,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending_services,
                    SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled_services,
                    SUM(total_amount) as total_revenue,
                    AVG(total_amount) as avg_booking_value,
                    COUNT(DISTINCT service_category) as total_categories
                FROM service_bookings
            ");
            
            $stats = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Get monthly trends
            $monthlyStmt = $pdo->query("
                SELECT 
                    DATE_FORMAT(booking_date, '%Y-%m') as month,
                    COUNT(*) as bookings,
                    SUM(total_amount) as revenue
                FROM service_bookings
                WHERE booking_date >= DATE_SUB(NOW(), INTERVAL 6 MONTH)
                GROUP BY DATE_FORMAT(booking_date, '%Y-%m')
                ORDER BY month DESC
            ");
            
            $monthlyTrends = $monthlyStmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'status' => 'success',
                'statistics' => $stats,
                'monthly_trends' => $monthlyTrends
            ]);
            break;
            
        case 'get_service_bookings':
            // Get customer service bookings with filters
            $statusFilter = $_GET['status'] ?? '';
            $categoryFilter = $_GET['category'] ?? '';
            $dateFilter = $_GET['date'] ?? '';
            
            $whereConditions = [];
            $params = [];
            
            if (!empty($statusFilter)) {
                $whereConditions[] = "status = ?";
                $params[] = $statusFilter;
            }
            
            if (!empty($categoryFilter)) {
                $whereConditions[] = "service_category = ?";
                $params[] = $categoryFilter;
            }
            
            if (!empty($dateFilter)) {
                $whereConditions[] = "DATE(service_date) = ?";
                $params[] = $dateFilter;
            }
            
            $whereClause = '';
            if (!empty($whereConditions)) {
                $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
            }
            
            $sql = "
                SELECT 
                    id,
                    booking_id,
                    user_id,
                    username,
                    selected_services,
                    service_category,
                    service_date,
                    service_time,
                    guest_count,
                    special_requirements,
                    phone_number,
                    email,
                    total_amount,
                    additional_services,
                    status,
                    booking_date,
                    created_at
                FROM service_bookings
                $whereClause
                ORDER BY booking_date DESC
                LIMIT 100
            ";
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            echo json_encode([
                'status' => 'success',
                'bookings' => $bookings
            ]);
            break;
            
        case 'update_booking_status':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $bookingId = $data['booking_id'] ?? '';
            $status = $data['status'] ?? '';
            
            if (empty($bookingId) || empty($status)) {
                throw new Exception('Booking ID and status are required');
            }
            
            $allowedStatuses = ['pending', 'confirmed', 'cancelled', 'completed'];
            if (!in_array($status, $allowedStatuses)) {
                throw new Exception('Invalid status');
            }
            
            $stmt = $pdo->prepare("
                UPDATE service_bookings 
                SET status = ?, updated_at = CURRENT_TIMESTAMP
                WHERE id = ?
            ");
            
            $stmt->execute([$status, $bookingId]);
            
            if ($stmt->rowCount() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Booking status updated successfully'
                ]);
            } else {
                throw new Exception('Booking not found');
            }
            break;
            
        default:
            throw new Exception('Invalid action specified');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to process request: ' . $e->getMessage()
    ]);
}
?> 