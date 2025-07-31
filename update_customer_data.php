<?php
// Script to update service bookings with sample customer data
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Sample customer data
    $customers = [
        [
            'name' => 'Sarah Johnson',
            'email' => 'sarah.johnson@email.com',
            'phone' => '+1 (555) 123-4567'
        ],
        [
            'name' => 'Michael Chen',
            'email' => 'michael.chen@email.com',
            'phone' => '+1 (555) 234-5678'
        ],
        [
            'name' => 'Emily Rodriguez',
            'email' => 'emily.rodriguez@email.com',
            'phone' => '+1 (555) 345-6789'
        ],
        [
            'name' => 'David Thompson',
            'email' => 'david.thompson@email.com',
            'phone' => '+1 (555) 456-7890'
        ],
        [
            'name' => 'Lisa Wang',
            'email' => 'lisa.wang@email.com',
            'phone' => '+1 (555) 567-8901'
        ],
        [
            'name' => 'James Wilson',
            'email' => 'james.wilson@email.com',
            'phone' => '+1 (555) 678-9012'
        ],
        [
            'name' => 'Maria Garcia',
            'email' => 'maria.garcia@email.com',
            'phone' => '+1 (555) 789-0123'
        ],
        [
            'name' => 'Robert Kim',
            'email' => 'robert.kim@email.com',
            'phone' => '+1 (555) 890-1234'
        ],
        [
            'name' => 'Jennifer Lee',
            'email' => 'jennifer.lee@email.com',
            'phone' => '+1 (555) 901-2345'
        ],
        [
            'name' => 'Christopher Brown',
            'email' => 'christopher.brown@email.com',
            'phone' => '+1 (555) 012-3456'
        ],
        [
            'name' => 'Amanda Davis',
            'email' => 'amanda.davis@email.com',
            'phone' => '+1 (555) 123-4567'
        ],
        [
            'name' => 'Daniel Martinez',
            'email' => 'daniel.martinez@email.com',
            'phone' => '+1 (555) 234-5678'
        ],
        [
            'name' => 'Rachel Green',
            'email' => 'rachel.green@email.com',
            'phone' => '+1 (555) 345-6789'
        ],
        [
            'name' => 'Kevin Taylor',
            'email' => 'kevin.taylor@email.com',
            'phone' => '+1 (555) 456-7890'
        ],
        [
            'name' => 'Nicole Anderson',
            'email' => 'nicole.anderson@email.com',
            'phone' => '+1 (555) 567-8901'
        ],
        [
            'name' => 'Steven White',
            'email' => 'steven.white@email.com',
            'phone' => '+1 (555) 678-9012'
        ],
        [
            'name' => 'Jessica Clark',
            'email' => 'jessica.clark@email.com',
            'phone' => '+1 (555) 789-0123'
        ],
        [
            'name' => 'Andrew Lewis',
            'email' => 'andrew.lewis@email.com',
            'phone' => '+1 (555) 890-1234'
        ],
        [
            'name' => 'Melissa Hall',
            'email' => 'melissa.hall@email.com',
            'phone' => '+1 (555) 901-2345'
        ],
        [
            'name' => 'Ryan Scott',
            'email' => 'ryan.scott@email.com',
            'phone' => '+1 (555) 012-3456'
        ],
        [
            'name' => 'Lauren Young',
            'email' => 'lauren.young@email.com',
            'phone' => '+1 (555) 123-4567'
        ],
        [
            'name' => 'Brandon King',
            'email' => 'brandon.king@email.com',
            'phone' => '+1 (555) 234-5678'
        ],
        [
            'name' => 'Stephanie Wright',
            'email' => 'stephanie.wright@email.com',
            'phone' => '+1 (555) 345-6789'
        ],
        [
            'name' => 'Jonathan Lopez',
            'email' => 'jonathan.lopez@email.com',
            'phone' => '+1 (555) 456-7890'
        ],
        [
            'name' => 'Ashley Hill',
            'email' => 'ashley.hill@email.com',
            'phone' => '+1 (555) 567-8901'
        ]
    ];
    
    // Get all service bookings
    $stmt = $pdo->query("SELECT id FROM service_bookings ORDER BY id");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Updating " . count($bookings) . " service bookings with sample customer data...\n";
    
    $updateStmt = $pdo->prepare("
        UPDATE service_bookings 
        SET username = ?, 
            email = ?, 
            phone_number = ?
        WHERE id = ?
    ");
    
    $updatedCount = 0;
    
    foreach ($bookings as $index => $booking) {
        $customer = $customers[$index % count($customers)]; // Cycle through customers
        
        $updateStmt->execute([
            $customer['name'],
            $customer['email'],
            $customer['phone'],
            $booking['id']
        ]);
        
        $updatedCount++;
        echo "Updated booking ID {$booking['id']} with customer: {$customer['name']}\n";
    }
    
    echo "\nSuccessfully updated $updatedCount service bookings with sample customer data!\n";
    
    // Show a few examples
    $sampleStmt = $pdo->query("
        SELECT username, email, phone_number, selected_services, total_amount 
        FROM service_bookings 
        ORDER BY id 
        LIMIT 5
    ");
    
    $samples = $sampleStmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nSample updated bookings:\n";
    foreach ($samples as $sample) {
        $services = json_decode($sample['selected_services'], true);
        $serviceName = $services[0] ?? 'Unknown Service';
        echo "- {$sample['username']} ({$sample['email']}) - {$serviceName} - \${$sample['total_amount']}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 