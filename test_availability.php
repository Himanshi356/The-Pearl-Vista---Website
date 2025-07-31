<?php
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    echo "<h2>Current Room Types and Availability</h2>";
    
    // Get current room types
    $stmt = $pdo->query("SELECT * FROM room_types ORDER BY base_price DESC");
    $roomTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Room Type</th><th>Total Rooms</th><th>Current Available</th><th>Base Price</th></tr>";
    
    foreach ($roomTypes as $roomType) {
        echo "<tr>";
        echo "<td>{$roomType['room_type']}</td>";
        echo "<td>{$roomType['total_rooms']}</td>";
        echo "<td>{$roomType['available_rooms']}</td>";
        echo "<td>\${$roomType['base_price']}</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h2>Current Bookings</h2>";
    
    // Get current bookings
    $stmt = $pdo->query("
        SELECT 
            room_type,
            status,
            check_in_date,
            check_out_date,
            num_rooms,
            COUNT(*) as booking_count
        FROM bookings 
        WHERE status IN ('pending', 'confirmed')
        GROUP BY room_type, status, check_in_date, check_out_date
        ORDER BY room_type, check_in_date
    ");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (empty($bookings)) {
        echo "<p>No active bookings found.</p>";
    } else {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Room Type</th><th>Status</th><th>Check In</th><th>Check Out</th><th>Rooms Booked</th><th>Booking Count</th></tr>";
        
        foreach ($bookings as $booking) {
            echo "<tr>";
            echo "<td>{$booking['room_type']}</td>";
            echo "<td>{$booking['status']}</td>";
            echo "<td>{$booking['check_in_date']}</td>";
            echo "<td>{$booking['check_out_date']}</td>";
            echo "<td>{$booking['num_rooms']}</td>";
            echo "<td>{$booking['booking_count']}</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
    echo "<h2>Calculated Availability</h2>";
    
    // Calculate what availability should be
    $currentDate = date('Y-m-d');
    $stmt = $pdo->prepare("
        SELECT 
            rt.room_type,
            rt.total_rooms,
            rt.available_rooms as current_available,
            COALESCE(
                (
                    SELECT COUNT(*)
                    FROM bookings b
                    WHERE b.room_type = rt.room_type 
                    AND b.status IN ('pending', 'confirmed')
                    AND (
                        (b.check_in_date <= ? AND b.check_out_date >= ?) -- Current bookings
                        OR (b.check_in_date > ?) -- Future bookings
                    )
                ), 0
            ) as booked_rooms,
            (
                rt.total_rooms - COALESCE(
                    (
                        SELECT COUNT(*)
                        FROM bookings b
                        WHERE b.room_type = rt.room_type 
                        AND b.status IN ('pending', 'confirmed')
                        AND (
                            (b.check_in_date <= ? AND b.check_out_date >= ?) -- Current bookings
                            OR (b.check_in_date > ?) -- Future bookings
                        )
                    ), 0
                )
            ) as calculated_available
        FROM room_types rt
        ORDER BY rt.base_price DESC
    ");
    
    $stmt->execute([$currentDate, $currentDate, $currentDate, $currentDate, $currentDate, $currentDate]);
    $calculatedAvailability = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Room Type</th><th>Total Rooms</th><th>Current Available</th><th>Booked Rooms</th><th>Calculated Available</th><th>Should Update?</th></tr>";
    
    foreach ($calculatedAvailability as $availability) {
        $shouldUpdate = $availability['current_available'] != $availability['calculated_available'];
        $updateClass = $shouldUpdate ? 'background-color: #ffebee;' : '';
        
        echo "<tr style='{$updateClass}'>";
        echo "<td>{$availability['room_type']}</td>";
        echo "<td>{$availability['total_rooms']}</td>";
        echo "<td>{$availability['current_available']}</td>";
        echo "<td>{$availability['booked_rooms']}</td>";
        echo "<td>{$availability['calculated_available']}</td>";
        echo "<td>" . ($shouldUpdate ? 'YES' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?> 