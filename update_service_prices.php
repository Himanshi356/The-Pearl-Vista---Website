<?php
// Script to update service prices to match services.html prices
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Updated service prices based on services.html
    $servicePrices = [
        // Dining Services
        'Main Restaurant' => 1350.00,
        'Restaurant and Lounge Bar' => 1450.00,
        'Private Dining' => 1650.00,
        
        // Spa & Wellness Services
        'Luxury Spa Treatment' => 1250.00,
        'Fitness Center Access' => 1850.00,
        'Wellness Programs' => 2250.00,
        
        // Leisure & Activities
        'Swimming Pool Access' => 1150.00,
        'Recreation Center' => 1750.00,
        'Outdoor Activities' => 2850.00,
        
        // Events & Meetings
        'Conference Room Rental' => 2850.00,
        'Wedding Venue' => 4850.00,
        'Social Events' => 3250.00,
        
        // Concierge Services
        'Airport Transfer' => 500.00,
        'City Tours' => 750.00,
        'Personal Shopping' => 1000.00,
        
        // Kids & Family
        'Kids Club' => 600.00,
        'Family Activities' => 1150.00,
        'Babysitting Service' => 1250.00,
        
        // Packages & Experiences
        'Romantic Escape Package' => 1350.00,
        'Family Adventure Package' => 3850.00,
        'Seasonal Special Package' => 5250.00,
        
        // Pet Services
        'Pet-Friendly Room' => 2850.00,
        'Pet Sitting' => 1150.00,
        'Pet Grooming' => 1250.00,
        
        // Additional services from services.html
        'Wagyu Beef Tenderloin' => 1250.00,
        'Lobster Thermidor' => 1450.00,
        'Truffle Risotto' => 1350.00,
        'Foie Gras Torchon' => 1650.00,
        'Truffle Arancini' => 1250.00,
        'Lobster Bisque' => 1850.00,
        'Wagyu Carpaccio' => 2250.00,
        'Burrata Caprese' => 1150.00,
        'Oysters Rockefeller' => 1750.00,
        'Caviar Service' => 2850.00,
        'Filet Mignon' => 2850.00,
        'Truffle Pasta' => 1850.00,
        'Pan-Seared Sea Bass' => 2450.00,
        'Duck Confit' => 2850.00,
        'Rack of Lamb' => 3250.00,
        'Lobster Mac & Cheese' => 2150.00,
        'Pearl Vista Martini' => 1250.00,
        'Champagne Selection' => 2500.00,
        'Wine Flight' => 3250.00,
        'Old Fashioned' => 1150.00,
        'Negroni' => 1250.00,
        'Whiskey Flight' => 2850.00,
        'Chocolate Soufflé' => 1150.00,
        'Crème Brûlée' => 1050.00,
        'Tiramisu' => 2850.00,
        'Cheesecake' => 1250.00,
        'Apple Pie' => 1350.00,
        'Ice Cream Selection' => 1850.00
    ];
    
    // Get all service bookings
    $stmt = $pdo->query("SELECT id, selected_services FROM service_bookings ORDER BY id");
    $bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Updating service prices to match services.html...\n";
    
    $updateStmt = $pdo->prepare("
        UPDATE service_bookings 
        SET total_amount = ?
        WHERE id = ?
    ");
    
    $updatedCount = 0;
    
    foreach ($bookings as $booking) {
        $selectedServices = json_decode($booking['selected_services'], true);
        $serviceName = $selectedServices[0] ?? 'Unknown Service';
        
        // Find matching price
        $newPrice = null;
        foreach ($servicePrices as $service => $price) {
            if (stripos($serviceName, $service) !== false || stripos($service, $serviceName) !== false) {
                $newPrice = $price;
                break;
            }
        }
        
        // If no exact match, use a default price based on category
        if ($newPrice === null) {
            // Default prices based on service type
            if (stripos($serviceName, 'spa') !== false || stripos($serviceName, 'wellness') !== false) {
                $newPrice = 1250.00;
            } elseif (stripos($serviceName, 'dining') !== false || stripos($serviceName, 'restaurant') !== false) {
                $newPrice = 1450.00;
            } elseif (stripos($serviceName, 'transport') !== false || stripos($serviceName, 'transfer') !== false) {
                $newPrice = 500.00;
            } elseif (stripos($serviceName, 'leisure') !== false || stripos($serviceName, 'pool') !== false) {
                $newPrice = 1150.00;
            } elseif (stripos($serviceName, 'events') !== false || stripos($serviceName, 'conference') !== false) {
                $newPrice = 2850.00;
            } elseif (stripos($serviceName, 'concierge') !== false || stripos($serviceName, 'tours') !== false) {
                $newPrice = 750.00;
            } elseif (stripos($serviceName, 'kids') !== false || stripos($serviceName, 'babysitting') !== false) {
                $newPrice = 600.00;
            } elseif (stripos($serviceName, 'packages') !== false || stripos($serviceName, 'escape') !== false) {
                $newPrice = 1350.00;
            } elseif (stripos($serviceName, 'pet') !== false) {
                $newPrice = 1150.00;
            } else {
                $newPrice = 1000.00; // Default price
            }
        }
        
        $updateStmt->execute([$newPrice, $booking['id']]);
        
        $updatedCount++;
        echo "Updated: {$serviceName} - \${$newPrice}\n";
    }
    
    echo "\nSuccessfully updated $updatedCount service prices!\n";
    
    // Show total revenue
    $revenueStmt = $pdo->query("SELECT SUM(total_amount) as total_revenue FROM service_bookings");
    $revenue = $revenueStmt->fetch(PDO::FETCH_ASSOC)['total_revenue'];
    
    echo "Total service revenue: $" . number_format($revenue, 2) . "\n";
    
    // Show sample updated prices
    $sampleStmt = $pdo->query("
        SELECT selected_services, total_amount 
        FROM service_bookings 
        ORDER BY id 
        LIMIT 10
    ");
    
    $samples = $sampleStmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\nSample updated prices:\n";
    foreach ($samples as $sample) {
        $services = json_decode($sample['selected_services'], true);
        $serviceName = $services[0] ?? 'Unknown Service';
        echo "- {$serviceName}: \${$sample['total_amount']}\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 