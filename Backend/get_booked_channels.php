<?php
session_start();
header('Content-Type: application/json');

require_once '../Config/database.php';

try {
    // Mock data for booking channels (since we don't have a channels table)
    $channels = [
        ['name' => 'Direct Website', 'bookings' => 45, 'percentage' => 60],
        ['name' => 'Phone', 'bookings' => 20, 'percentage' => 27],
        ['name' => 'Email', 'bookings' => 8, 'percentage' => 11],
        ['name' => 'Travel Agents', 'bookings' => 2, 'percentage' => 2]
    ];
    
    echo json_encode([
        'success' => true,
        'channels' => $channels
    ]);
} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to fetch booked channels: ' . $e->getMessage()
    ]);
}
?> 