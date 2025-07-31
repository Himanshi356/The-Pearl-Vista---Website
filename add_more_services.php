<?php
// Script to add more services from services.html to the database
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Array of services from services.html
    $services = [
        // Dining Services
        [
            'name' => 'Main Restaurant',
            'category' => 'dining',
            'price' => 150.00,
            'duration' => '2-3 hours',
            'description' => 'International cuisine with a modern twist, featuring seasonal menus and local specialties.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Restaurant and Lounge Bar',
            'category' => 'dining',
            'price' => 200.00,
            'duration' => '3-4 hours',
            'description' => 'Enjoy gourmet cuisine in our elegant restaurant and unwind with premium cocktails, wines, and light refreshments.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Private Dining',
            'category' => 'dining',
            'price' => 500.00,
            'duration' => '4-5 hours',
            'description' => 'Exclusive private dining rooms for intimate gatherings and special occasions.',
            'status' => 'confirmed'
        ],
        
        // Spa & Wellness Services
        [
            'name' => 'Luxury Spa Treatment',
            'category' => 'spa',
            'price' => 250.00,
            'duration' => '2 hours',
            'description' => 'Comprehensive spa treatments including massages, facials, and body therapies.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Fitness Center Access',
            'category' => 'wellness',
            'price' => 50.00,
            'duration' => 'Daily access',
            'description' => 'State-of-the-art equipment with personal training and group fitness classes.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Wellness Programs',
            'category' => 'wellness',
            'price' => 180.00,
            'duration' => '1 month',
            'description' => 'Customized wellness programs including yoga, meditation, and nutrition guidance.',
            'status' => 'confirmed'
        ],
        
        // Leisure & Activities
        [
            'name' => 'Swimming Pool Access',
            'category' => 'leisure',
            'price' => 30.00,
            'duration' => 'Daily access',
            'description' => 'Infinity pool with stunning city views and poolside service.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Recreation Center',
            'category' => 'leisure',
            'price' => 40.00,
            'duration' => 'Daily access',
            'description' => 'Indoor games, billiards, and entertainment facilities for all ages.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Outdoor Activities',
            'category' => 'leisure',
            'price' => 120.00,
            'duration' => 'Half day',
            'description' => 'Guided tours, outdoor sports, and adventure activities in the city.',
            'status' => 'confirmed'
        ],
        
        // Events & Meetings
        [
            'name' => 'Conference Room Rental',
            'category' => 'events',
            'price' => 800.00,
            'duration' => 'Half day',
            'description' => 'State-of-the-art meeting rooms with modern technology and equipment.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Wedding Venue',
            'category' => 'events',
            'price' => 5000.00,
            'duration' => 'Full day',
            'description' => 'Elegant wedding venues with professional event planning services.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Social Events',
            'category' => 'events',
            'price' => 1500.00,
            'duration' => '4-6 hours',
            'description' => 'Birthday parties, anniversaries, and special celebrations with catering.',
            'status' => 'confirmed'
        ],
        
        // Concierge Services
        [
            'name' => 'Airport Transfer',
            'category' => 'transport',
            'price' => 80.00,
            'duration' => '1 hour',
            'description' => 'Luxury vehicle transfer to and from the airport.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'City Tours',
            'category' => 'concierge',
            'price' => 150.00,
            'duration' => '4 hours',
            'description' => 'Guided city tours with professional tour guides.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Personal Shopping',
            'category' => 'concierge',
            'price' => 100.00,
            'duration' => '3 hours',
            'description' => 'Personal shopping assistance and delivery services.',
            'status' => 'confirmed'
        ],
        
        // Kids & Family
        [
            'name' => 'Kids Club',
            'category' => 'kids',
            'price' => 60.00,
            'duration' => 'Daily access',
            'description' => 'Supervised activities and entertainment for children of all ages.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Family Activities',
            'category' => 'kids',
            'price' => 80.00,
            'duration' => '2 hours',
            'description' => 'Family-friendly activities and bonding experiences for all ages.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Babysitting Service',
            'category' => 'kids',
            'price' => 25.00,
            'duration' => 'Per hour',
            'description' => 'Professional babysitting services with certified caregivers.',
            'status' => 'confirmed'
        ],
        
        // Packages & Experiences
        [
            'name' => 'Romantic Escape Package',
            'category' => 'packages',
            'price' => 800.00,
            'duration' => 'Weekend',
            'description' => 'A special getaway for couples with exclusive amenities.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Family Adventure Package',
            'category' => 'packages',
            'price' => 600.00,
            'duration' => 'Weekend',
            'description' => 'Fun-filled activities and perks for the whole family.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Seasonal Special Package',
            'category' => 'packages',
            'price' => 1000.00,
            'duration' => 'Weekend',
            'description' => 'Limited-time packages with unique experiences.',
            'status' => 'confirmed'
        ],
        
        // Pet Services
        [
            'name' => 'Pet-Friendly Room',
            'category' => 'pet-services',
            'price' => 50.00,
            'duration' => 'Per night',
            'description' => 'Comfortable rooms with pet beds and feeding stations.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Pet Sitting',
            'category' => 'pet-services',
            'price' => 30.00,
            'duration' => 'Per hour',
            'description' => 'Certified caregivers for your pets, 24/7.',
            'status' => 'confirmed'
        ],
        [
            'name' => 'Pet Grooming',
            'category' => 'pet-services',
            'price' => 75.00,
            'duration' => '2 hours',
            'description' => 'Professional grooming and special treatments.',
            'status' => 'confirmed'
        ]
    ];
    
    // Check if services already exist
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM service_bookings");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($count > 0) {
        echo "Services already exist in database. Adding new services only...\n";
        
        // Get existing service names to avoid duplicates
        $stmt = $pdo->query("SELECT selected_services FROM service_bookings");
        $existingServices = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $existingNames = [];
        
        foreach ($existingServices as $service) {
            $selectedServices = json_decode($service['selected_services'], true);
            if (is_array($selectedServices)) {
                $existingNames[] = $selectedServices[0];
            }
        }
        
        // Filter out existing services
        $newServices = array_filter($services, function($service) use ($existingNames) {
            return !in_array($service['name'], $existingNames);
        });
        
        $services = array_values($newServices);
    }
    
    if (empty($services)) {
        echo "All services already exist in database.\n";
        exit();
    }
    
    // Insert new services
    $insertStmt = $pdo->prepare("
        INSERT INTO service_bookings (
            booking_id, user_id, username, selected_services, 
            service_category, service_date, service_time, guest_count,
            special_requirements, phone_number, email, total_amount,
            additional_services, status
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
        )
    ");
    
    $addedCount = 0;
    
    foreach ($services as $index => $service) {
        $bookingId = 'SVC_' . time() . '_' . ($index + 1) . '_' . rand(1000, 9999);
        $selectedServices = json_encode([$service['name']]);
        $additionalServices = json_encode([
            'duration' => $service['duration'],
            'description' => $service['description'],
            'original_price' => $service['price']
        ]);
        
        $insertStmt->execute([
            $bookingId,
            'admin',
            'Admin User',
            $selectedServices,
            $service['category'],
            date('Y-m-d'),
            '00:00:00',
            1,
            $service['description'],
            '0000000000',
            'admin@pearlvista.com',
            $service['price'],
            $additionalServices,
            $service['status']
        ]);
        
        $addedCount++;
        echo "Added: {$service['name']} - \${$service['price']}\n";
    }
    
    echo "\nSuccessfully added $addedCount new services to the database!\n";
    
    // Show total count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM service_bookings");
    $totalCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total services in database: $totalCount\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 