<?php
session_start();
header('Content-Type: application/json');

// Check admin session
if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

require_once '../../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get all room types (from both room_types table and rooms table)
    $stmt = $pdo->query("
        SELECT 
            room_type,
            description,
            base_price,
            total_rooms,
            floor_number,
            total_rooms_created,
            available_rooms_count,
            reserved_rooms,
            maintenance_rooms,
            available_rooms
        FROM (
            -- Get room types from room_types table
            SELECT 
                rt.room_type,
                rt.description,
                rt.base_price,
                rt.total_rooms,
                rt.floor_number,
                COALESCE(COUNT(r.room_id), 0) as total_rooms_created,
                COALESCE(SUM(CASE WHEN r.status = 'available' THEN 1 ELSE 0 END), 0) as available_rooms_count,
                COALESCE(SUM(CASE WHEN r.status = 'reserved' THEN 1 ELSE 0 END), 0) as reserved_rooms,
                COALESCE(SUM(CASE WHEN r.status = 'maintenance' THEN 1 ELSE 0 END), 0) as maintenance_rooms,
                (
                    rt.total_rooms - COALESCE(
                        (
                            SELECT COUNT(*)
                            FROM home_bookings b
                            WHERE b.room_type = rt.room_type 
                            AND b.status IN ('pending', 'confirmed')
                            AND (
                                (b.check_in_date <= CURDATE() AND b.check_out_date >= CURDATE())
                                OR (b.check_in_date > CURDATE())
                            )
                        ), 0
                    )
                ) as available_rooms
            FROM room_types rt
            LEFT JOIN rooms r ON rt.room_type = r.room_type
            GROUP BY rt.room_type, rt.description, rt.base_price, rt.total_rooms, rt.floor_number
            
            UNION
            
            -- Get room types from rooms table that don't exist in room_types
            SELECT 
                r.room_type,
                r.description,
                r.price_per_night as base_price,
                COUNT(r.room_id) as total_rooms,
                r.floor as floor_number,
                COUNT(r.room_id) as total_rooms_created,
                SUM(CASE WHEN r.status = 'available' THEN 1 ELSE 0 END) as available_rooms_count,
                SUM(CASE WHEN r.status = 'reserved' THEN 1 ELSE 0 END) as reserved_rooms,
                SUM(CASE WHEN r.status = 'maintenance' THEN 1 ELSE 0 END) as maintenance_rooms,
                (
                    COUNT(r.room_id) - COALESCE(
                        (
                            SELECT COUNT(*)
                            FROM home_bookings b
                            WHERE b.room_type = r.room_type 
                            AND b.status IN ('pending', 'confirmed')
                            AND (
                                (b.check_in_date <= CURDATE() AND b.check_out_date >= CURDATE())
                                OR (b.check_in_date > CURDATE())
                            )
                        ), 0
                    )
                ) as available_rooms
            FROM rooms r
            LEFT JOIN room_types rt ON r.room_type = rt.room_type
            WHERE rt.room_type IS NULL
            GROUP BY r.room_type, r.description, r.price_per_night, r.floor
        ) combined_rooms
        ORDER BY base_price DESC
    ");
    
    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get individual rooms for detailed view
    $stmt2 = $pdo->query("
        SELECT 
            room_id,
            room_number,
            room_type,
            description,
            floor,
            price_per_night,
            status,
            created_at
        FROM rooms 
        ORDER BY room_type, room_number
    ");
    
    $rooms = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'status' => 'success',
        'room_types' => $roomTypes,
        'rooms' => $rooms
    ]);
    
} catch (Exception $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch room data: ' . $e->getMessage()
    ]);
}
?> 