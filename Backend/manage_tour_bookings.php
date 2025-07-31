<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Not logged in or insufficient privileges',
        'redirect' => true
    ]);
    exit();
}

require_once '../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    $action = $_GET['action'] ?? '';
    
    switch ($action) {
        case 'get_tour_bookings':
            // Get tour bookings with filters
            $statusFilter = $_GET['status'] ?? '';
            $tourTypeFilter = $_GET['tour_type'] ?? '';
            $dateFilter = $_GET['date'] ?? '';
            $guestNameFilter = $_GET['guest_name'] ?? '';
            
            $whereConditions = [];
            $params = [];
            
            if (!empty($statusFilter)) {
                $whereConditions[] = "status = ?";
                $params[] = $statusFilter;
            }
            
            if (!empty($tourTypeFilter)) {
                $whereConditions[] = "vehicle_type = ?";
                $params[] = $tourTypeFilter;
            }
            
            if (!empty($dateFilter)) {
                $whereConditions[] = "DATE(tour_date) = ?";
                $params[] = $dateFilter;
            }
            
            if (!empty($guestNameFilter)) {
                $whereConditions[] = "full_name LIKE ?";
                $params[] = "%$guestNameFilter%";
            }
            
            $whereClause = '';
            if (!empty($whereConditions)) {
                $whereClause = 'WHERE ' . implode(' AND ', $whereConditions);
            }
            
            $sql = "
                SELECT 
                    id,
                    full_name,
                    email,
                    phone,
                    tour_date,
                    tour_time,
                    places_to_visit,
                    number_of_travellers,
                    vehicle_type,
                    amount_paid,
                    status,
                    created_at,
                    updated_at
                FROM tour_bookings
                $whereClause
                ORDER BY created_at DESC
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
            
        case 'get_tour_statistics':
            // Get tour booking statistics
            $stats = [];
            
            // Total bookings
            $stmt = $pdo->query("SELECT COUNT(*) as total FROM tour_bookings");
            $stats['total_bookings'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Confirmed bookings
            $stmt = $pdo->query("SELECT COUNT(*) as confirmed FROM tour_bookings WHERE status = 'confirmed'");
            $stats['confirmed_bookings'] = $stmt->fetch(PDO::FETCH_ASSOC)['confirmed'];
            
            // Pending bookings
            $stmt = $pdo->query("SELECT COUNT(*) as pending FROM tour_bookings WHERE status = 'pending'");
            $stats['pending_bookings'] = $stmt->fetch(PDO::FETCH_ASSOC)['pending'];
            
            // Total revenue
            $stmt = $pdo->query("SELECT SUM(amount_paid) as total_revenue FROM tour_bookings WHERE status = 'confirmed'");
            $stats['total_revenue'] = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'] ?? 0;
            
            // Monthly comparison (simplified)
            $stmt = $pdo->query("
                SELECT 
                    COUNT(*) as current_month_bookings,
                    SUM(amount_paid) as current_month_revenue
                FROM tour_bookings 
                WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) 
                AND YEAR(created_at) = YEAR(CURRENT_DATE())
            ");
            $currentMonth = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt = $pdo->query("
                SELECT 
                    COUNT(*) as last_month_bookings,
                    SUM(amount_paid) as last_month_revenue
                FROM tour_bookings 
                WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) 
                AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)
            ");
            $lastMonth = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Calculate percentage changes
            $stats['booking_change'] = $lastMonth['last_month_bookings'] > 0 
                ? round((($currentMonth['current_month_bookings'] - $lastMonth['last_month_bookings']) / $lastMonth['last_month_bookings']) * 100, 1)
                : 0;
            
            $stats['revenue_change'] = $lastMonth['last_month_revenue'] > 0 
                ? round((($currentMonth['current_month_revenue'] - $lastMonth['last_month_revenue']) / $lastMonth['last_month_revenue']) * 100, 1)
                : 0;
            
            echo json_encode([
                'status' => 'success',
                'statistics' => $stats
            ]);
            break;
            
        case 'update_booking_status':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $bookingId = $data['booking_id'] ?? '';
            $status = $data['status'] ?? '';
            
            if (empty($bookingId) || empty($status)) {
                throw new Exception('Booking ID and status are required');
            }
            
            $allowedStatuses = ['pending', 'confirmed', 'cancelled'];
            if (!in_array($status, $allowedStatuses)) {
                throw new Exception('Invalid status');
            }
            
            $stmt = $pdo->prepare("
                UPDATE tour_bookings 
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
            
        case 'delete_booking':
            $data = json_decode(file_get_contents('php://input'), true);
            
            $bookingId = $data['booking_id'] ?? '';
            
            if (empty($bookingId)) {
                throw new Exception('Booking ID is required');
            }
            
            $stmt = $pdo->prepare("DELETE FROM tour_bookings WHERE id = ?");
            $stmt->execute([$bookingId]);
            
            if ($stmt->rowCount() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Booking deleted successfully'
                ]);
            } else {
                throw new Exception('Booking not found');
            }
            break;
            
        case 'get_tour_locations':
            // Get available tour locations from locations.html
            $locations = [
                'Broadway Theaters' => 'Cultural',
                'Rockefeller Center' => 'Landmark',
                'Empire State Building' => 'Landmark',
                'Grand Central Terminal' => 'Transportation',
                'Times Square' => 'Entertainment',
                'Central Park' => 'Nature',
                'Statue of Liberty' => 'Landmark',
                'Brooklyn Bridge' => 'Landmark'
            ];
            
            echo json_encode([
                'status' => 'success',
                'locations' => $locations
            ]);
            break;
            
        case 'get_vehicle_types':
            // Get available vehicle types
            $vehicleTypes = [
                'Luxury Sedan' => 'Premium',
                'SUV' => 'Standard',
                'Minivan' => 'Group',
                'Limousine' => 'Premium',
                'Coach Bus' => 'Large Group'
            ];
            
            echo json_encode([
                'status' => 'success',
                'vehicle_types' => $vehicleTypes
            ]);
            break;
            
        default:
            throw new Exception('Invalid action specified');
    }
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?> 