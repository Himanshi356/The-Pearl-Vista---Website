<?php
// Test file to verify services connection
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Check if service_bookings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'service_bookings'");
    if ($stmt->rowCount() == 0) {
        echo "Service bookings table does not exist. Creating it...\n";
        
        // Create the table if it doesn't exist
        $createTable = "
        CREATE TABLE IF NOT EXISTS service_bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id VARCHAR(50) UNIQUE NOT NULL,
            user_id VARCHAR(100),
            username VARCHAR(100),
            selected_services JSON NOT NULL,
            service_category VARCHAR(50),
            service_date DATE NOT NULL,
            service_time TIME NOT NULL,
            guest_count INT NOT NULL,
            special_requirements TEXT,
            phone_number VARCHAR(20) NOT NULL,
            email VARCHAR(100) NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            additional_services JSON,
            booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        $pdo->exec($createTable);
        echo "Service bookings table created successfully.\n";
    } else {
        echo "Service bookings table exists.\n";
    }
    
    // Check if there are any existing services
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM service_bookings");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "Current service bookings count: $count\n";
    
    // If no services exist, add some sample data
    if ($count == 0) {
        echo "Adding sample services...\n";
        
        $sampleServices = [
            [
                'booking_id' => 'SVC_' . time() . '_1',
                'user_id' => 'admin',
                'username' => 'Admin User',
                'selected_services' => json_encode(['Luxury Spa Treatment']),
                'service_category' => 'spa',
                'service_date' => date('Y-m-d'),
                'service_time' => '00:00:00',
                'guest_count' => 1,
                'special_requirements' => 'Relaxing full-body massage with premium oils and aromatherapy.',
                'phone_number' => '0000000000',
                'email' => 'admin@pearlvista.com',
                'total_amount' => 200.00,
                'additional_services' => json_encode(['duration' => '2 hours', 'description' => 'Premium spa treatment']),
                'status' => 'confirmed'
            ],
            [
                'booking_id' => 'SVC_' . time() . '_2',
                'user_id' => 'admin',
                'username' => 'Admin User',
                'selected_services' => json_encode(['Fine Dining Experience']),
                'service_category' => 'dining',
                'service_date' => date('Y-m-d'),
                'service_time' => '00:00:00',
                'guest_count' => 1,
                'special_requirements' => 'Gourmet dinner with wine pairing at our signature restaurant.',
                'phone_number' => '0000000000',
                'email' => 'admin@pearlvista.com',
                'total_amount' => 150.00,
                'additional_services' => json_encode(['duration' => '3 hours', 'description' => 'Fine dining experience']),
                'status' => 'confirmed'
            ],
            [
                'booking_id' => 'SVC_' . time() . '_3',
                'user_id' => 'admin',
                'username' => 'Admin User',
                'selected_services' => json_encode(['Airport Transfer']),
                'service_category' => 'transport',
                'service_date' => date('Y-m-d'),
                'service_time' => '00:00:00',
                'guest_count' => 1,
                'special_requirements' => 'Luxury vehicle transfer to and from the airport.',
                'phone_number' => '0000000000',
                'email' => 'admin@pearlvista.com',
                'total_amount' => 80.00,
                'additional_services' => json_encode(['duration' => '1 hour', 'description' => 'Airport transfer service']),
                'status' => 'pending'
            ]
        ];
        
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
        
        foreach ($sampleServices as $service) {
            $insertStmt->execute([
                $service['booking_id'],
                $service['user_id'],
                $service['username'],
                $service['selected_services'],
                $service['service_category'],
                $service['service_date'],
                $service['service_time'],
                $service['guest_count'],
                $service['special_requirements'],
                $service['phone_number'],
                $service['email'],
                $service['total_amount'],
                $service['additional_services'],
                $service['status']
            ]);
        }
        
        echo "Sample services added successfully.\n";
    }
    
    // Test the manage_services.php endpoint
    echo "\nTesting manage_services.php endpoint...\n";
    
    // Simulate a GET request to get services
    $url = 'http://localhost/Pearl-Vista---Website/Backend/manage_services.php?action=get_services';
    
    $context = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => 'Content-Type: application/json'
        ]
    ]);
    
    $response = file_get_contents($url, false, $context);
    
    if ($response !== false) {
        $data = json_decode($response, true);
        if ($data && isset($data['status'])) {
            echo "API Response Status: " . $data['status'] . "\n";
            if ($data['status'] === 'error') {
                echo "Error Message: " . $data['message'] . "\n";
            }
            if (isset($data['services'])) {
                echo "Number of services returned: " . count($data['services']) . "\n";
            }
            if (isset($data['statistics'])) {
                echo "Statistics loaded: " . json_encode($data['statistics']) . "\n";
            }
        } else {
            echo "Invalid response format: " . $response . "\n";
        }
    } else {
        echo "Failed to connect to the API endpoint.\n";
    }
    
    echo "\nTest completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 