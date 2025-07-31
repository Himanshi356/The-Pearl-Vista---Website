<?php
// Script to add sample tour bookings to the database
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Check if tour_bookings table has data
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tour_bookings");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($count > 0) {
        echo "Tour bookings table already has $count records. Skipping population.\n";
        exit();
    }
    
    // Sample tour bookings data based on locations.html
    $tourBookings = [
        [
            'full_name' => 'Sarah Johnson',
            'email' => 'sarah.johnson@email.com',
            'phone' => '+1 (555) 123-4567',
            'tour_date' => '2024-12-20',
            'tour_time' => '09:00:00',
            'places_to_visit' => 'Broadway Theaters, Rockefeller Center, Empire State Building',
            'number_of_travellers' => 2,
            'vehicle_type' => 'Luxury Sedan',
            'amount_paid' => 450.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Michael Chen',
            'email' => 'michael.chen@email.com',
            'phone' => '+1 (555) 234-5678',
            'tour_date' => '2024-12-25',
            'tour_time' => '10:30:00',
            'places_to_visit' => 'Grand Central Terminal, Times Square, Central Park',
            'number_of_travellers' => 4,
            'vehicle_type' => 'SUV',
            'amount_paid' => 680.00,
            'status' => 'pending'
        ],
        [
            'full_name' => 'Emily Rodriguez',
            'email' => 'emily.rodriguez@email.com',
            'phone' => '+1 (555) 345-6789',
            'tour_date' => '2024-12-15',
            'tour_time' => '14:00:00',
            'places_to_visit' => 'Statue of Liberty, Brooklyn Bridge, Manhattan',
            'number_of_travellers' => 3,
            'vehicle_type' => 'Minivan',
            'amount_paid' => 520.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'David Thompson',
            'email' => 'david.thompson@email.com',
            'phone' => '+1 (555) 456-7890',
            'tour_date' => '2024-12-28',
            'tour_time' => '11:00:00',
            'places_to_visit' => 'Empire State Building, Rockefeller Center, Broadway Theaters',
            'number_of_travellers' => 2,
            'vehicle_type' => 'Limousine',
            'amount_paid' => 850.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Lisa Wang',
            'email' => 'lisa.wang@email.com',
            'phone' => '+1 (555) 567-8901',
            'tour_date' => '2024-12-22',
            'tour_time' => '08:30:00',
            'places_to_visit' => 'Central Park, Times Square, Grand Central Terminal',
            'number_of_travellers' => 6,
            'vehicle_type' => 'Coach Bus',
            'amount_paid' => 1200.00,
            'status' => 'pending'
        ],
        [
            'full_name' => 'James Wilson',
            'email' => 'james.wilson@email.com',
            'phone' => '+1 (555) 678-9012',
            'tour_date' => '2024-12-18',
            'tour_time' => '15:30:00',
            'places_to_visit' => 'Brooklyn Bridge, Statue of Liberty, Manhattan',
            'number_of_travellers' => 2,
            'vehicle_type' => 'Luxury Sedan',
            'amount_paid' => 380.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Maria Garcia',
            'email' => 'maria.garcia@email.com',
            'phone' => '+1 (555) 789-0123',
            'tour_date' => '2024-12-30',
            'tour_time' => '12:00:00',
            'places_to_visit' => 'Rockefeller Center, Empire State Building, Broadway Theaters',
            'number_of_travellers' => 3,
            'vehicle_type' => 'SUV',
            'amount_paid' => 520.00,
            'status' => 'cancelled'
        ],
        [
            'full_name' => 'Robert Kim',
            'email' => 'robert.kim@email.com',
            'phone' => '+1 (555) 890-1234',
            'tour_date' => '2024-12-24',
            'tour_time' => '09:30:00',
            'places_to_visit' => 'Times Square, Central Park, Grand Central Terminal',
            'number_of_travellers' => 4,
            'vehicle_type' => 'Minivan',
            'amount_paid' => 680.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Jennifer Lee',
            'email' => 'jennifer.lee@email.com',
            'phone' => '+1 (555) 901-2345',
            'tour_date' => '2024-12-26',
            'tour_time' => '13:00:00',
            'places_to_visit' => 'Statue of Liberty, Brooklyn Bridge, Manhattan',
            'number_of_travellers' => 2,
            'vehicle_type' => 'Luxury Sedan',
            'amount_paid' => 450.00,
            'status' => 'pending'
        ],
        [
            'full_name' => 'Christopher Brown',
            'email' => 'christopher.brown@email.com',
            'phone' => '+1 (555) 012-3456',
            'tour_date' => '2024-12-19',
            'tour_time' => '10:00:00',
            'places_to_visit' => 'Empire State Building, Rockefeller Center, Broadway Theaters',
            'number_of_travellers' => 5,
            'vehicle_type' => 'Coach Bus',
            'amount_paid' => 950.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Amanda Davis',
            'email' => 'amanda.davis@email.com',
            'phone' => '+1 (555) 123-4567',
            'tour_date' => '2024-12-27',
            'tour_time' => '16:00:00',
            'places_to_visit' => 'Central Park, Times Square, Grand Central Terminal',
            'number_of_travellers' => 3,
            'vehicle_type' => 'SUV',
            'amount_paid' => 520.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Daniel Martinez',
            'email' => 'daniel.martinez@email.com',
            'phone' => '+1 (555) 234-5678',
            'tour_date' => '2024-12-21',
            'tour_time' => '11:30:00',
            'places_to_visit' => 'Brooklyn Bridge, Statue of Liberty, Manhattan',
            'number_of_travellers' => 2,
            'vehicle_type' => 'Limousine',
            'amount_paid' => 750.00,
            'status' => 'pending'
        ],
        [
            'full_name' => 'Rachel Green',
            'email' => 'rachel.green@email.com',
            'phone' => '+1 (555) 345-6789',
            'tour_date' => '2024-12-23',
            'tour_time' => '14:30:00',
            'places_to_visit' => 'Rockefeller Center, Empire State Building, Broadway Theaters',
            'number_of_travellers' => 4,
            'vehicle_type' => 'Minivan',
            'amount_paid' => 680.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Kevin Taylor',
            'email' => 'kevin.taylor@email.com',
            'phone' => '+1 (555) 456-7890',
            'tour_date' => '2024-12-29',
            'tour_time' => '08:00:00',
            'places_to_visit' => 'Times Square, Central Park, Grand Central Terminal',
            'number_of_travellers' => 6,
            'vehicle_type' => 'Coach Bus',
            'amount_paid' => 1200.00,
            'status' => 'confirmed'
        ],
        [
            'full_name' => 'Nicole Anderson',
            'email' => 'nicole.anderson@email.com',
            'phone' => '+1 (555) 567-8901',
            'tour_date' => '2024-12-31',
            'tour_time' => '12:30:00',
            'places_to_visit' => 'Statue of Liberty, Brooklyn Bridge, Manhattan',
            'number_of_travellers' => 3,
            'vehicle_type' => 'Luxury Sedan',
            'amount_paid' => 450.00,
            'status' => 'pending'
        ]
    ];
    
    // Insert tour bookings
    $insertStmt = $pdo->prepare("
        INSERT INTO tour_bookings (
            full_name, email, phone, tour_date, tour_time, 
            places_to_visit, number_of_travellers, vehicle_type, 
            amount_paid, status
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ");
    
    $addedCount = 0;
    
    foreach ($tourBookings as $booking) {
        $insertStmt->execute([
            $booking['full_name'],
            $booking['email'],
            $booking['phone'],
            $booking['tour_date'],
            $booking['tour_time'],
            $booking['places_to_visit'],
            $booking['number_of_travellers'],
            $booking['vehicle_type'],
            $booking['amount_paid'],
            $booking['status']
        ]);
        
        $addedCount++;
        echo "Added: {$booking['full_name']} - {$booking['vehicle_type']} - \${$booking['amount_paid']}\n";
    }
    
    echo "\nSuccessfully added $addedCount tour bookings to the database!\n";
    
    // Show total count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM tour_bookings");
    $totalCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total tour bookings in database: $totalCount\n";
    
    // Show statistics
    $stmt = $pdo->query("SELECT status, COUNT(*) as count FROM tour_bookings GROUP BY status");
    $statusStats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nStatus breakdown:\n";
    foreach ($statusStats as $stat) {
        echo "- {$stat['status']}: {$stat['count']}\n";
    }
    
    // Show total revenue
    $stmt = $pdo->query("SELECT SUM(amount_paid) as total_revenue FROM tour_bookings WHERE status = 'confirmed'");
    $revenue = $stmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
    echo "\nTotal confirmed revenue: $" . number_format($revenue, 2) . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 