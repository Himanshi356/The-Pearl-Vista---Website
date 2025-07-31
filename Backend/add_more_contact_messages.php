<?php
// Script to add more sample contact messages
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Sample contact messages data to add
    $contactMessages = [
        [
            'name' => 'John Doe',
            'email' => 'john.doe@email.com',
            'phone' => '+1 (555) 123-4567',
            'subject' => 'Room Booking Inquiry',
            'message' => 'Hi, I have a question about my booking. I need to change my check-in date from Dec 20 to Dec 22. Is that possible?'
        ],
        [
            'name' => 'Sarah Smith',
            'email' => 'sarah.smith@email.com',
            'phone' => '+1 (555) 234-5678',
            'subject' => 'Spa Services',
            'message' => 'I would like to book a spa treatment for my upcoming stay. What packages do you offer?'
        ],
        [
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@email.com',
            'phone' => '+1 (555) 345-6789',
            'subject' => 'Restaurant Reservation',
            'message' => 'Can I make a dinner reservation for 4 people on December 25th at 7 PM?'
        ],
        [
            'name' => 'Emma Wilson',
            'email' => 'emma.wilson@email.com',
            'phone' => '+1 (555) 456-7890',
            'subject' => 'Tour Booking',
            'message' => 'I\'m interested in booking a city tour. What are the available options and prices?'
        ],
        [
            'name' => 'David Brown',
            'email' => 'david.brown@email.com',
            'phone' => '+1 (555) 567-8901',
            'subject' => 'Event Planning',
            'message' => 'I want to plan a corporate event for 50 people. Do you have meeting facilities available?'
        ],
        [
            'name' => 'Lisa Garcia',
            'email' => 'lisa.garcia@email.com',
            'phone' => '+1 (555) 678-9012',
            'subject' => 'Special Requests',
            'message' => 'I have dietary restrictions. Can you accommodate gluten-free meals in your restaurant?'
        ],
        [
            'name' => 'Robert Chen',
            'email' => 'robert.chen@email.com',
            'phone' => '+1 (555) 789-0123',
            'subject' => 'Transportation',
            'message' => 'Do you provide airport shuttle service? What are the schedules and rates?'
        ],
        [
            'name' => 'Jennifer Lee',
            'email' => 'jennifer.lee@email.com',
            'phone' => '+1 (555) 890-1234',
            'subject' => 'Room Upgrade',
            'message' => 'I booked a standard room but would like to upgrade to a suite. Is this possible?'
        ],
        [
            'name' => 'Michael Davis',
            'email' => 'michael.davis@email.com',
            'phone' => '+1 (555) 901-2345',
            'subject' => 'Gym Access',
            'message' => 'I\'m a fitness enthusiast. What are your gym facilities like and are they available 24/7?'
        ],
        [
            'name' => 'Amanda Taylor',
            'email' => 'amanda.taylor@email.com',
            'phone' => '+1 (555) 012-3456',
            'subject' => 'Pet Policy',
            'message' => 'I have a small dog. What is your pet policy and are there any additional fees?'
        ],
        [
            'name' => 'Admin',
            'email' => 'john.doe@email.com',
            'phone' => '+1 (555) 123-4567',
            'subject' => 'Admin Reply',
            'message' => 'Hello John! I\'d be happy to help you with your booking. What\'s your question?'
        ],
        [
            'name' => 'Admin',
            'email' => 'john.doe@email.com',
            'phone' => '+1 (555) 123-4567',
            'subject' => 'Admin Reply',
            'message' => 'Of course! Let me check the availability for you. Please give me a moment to verify the room availability for the new dates.'
        ],
        [
            'name' => 'Admin',
            'email' => 'sarah.smith@email.com',
            'phone' => '+1 (555) 234-5678',
            'subject' => 'Admin Reply',
            'message' => 'Hello Sarah! We offer several spa packages including Swedish massage, deep tissue, and hot stone therapy. Would you like me to send you our complete spa menu?'
        ],
        [
            'name' => 'Admin',
            'email' => 'mike.johnson@email.com',
            'phone' => '+1 (555) 345-6789',
            'subject' => 'Admin Reply',
            'message' => 'Hi Mike! Yes, we can definitely accommodate your dinner reservation. I\'ll book a table for 4 people on December 25th at 7 PM. Do you have any dietary preferences?'
        ],
        [
            'name' => 'Admin',
            'email' => 'emma.wilson@email.com',
            'phone' => '+1 (555) 456-7890',
            'subject' => 'Admin Reply',
            'message' => 'Hello Emma! We offer several city tour options including half-day, full-day, and evening tours. Prices range from $50 to $150 per person. Which type of tour interests you most?'
        ]
    ];
    
    // Insert contact messages
    $insertStmt = $pdo->prepare("
        INSERT INTO contact_messages (
            name, email, phone, subject, message
        ) VALUES (
            ?, ?, ?, ?, ?
        )
    ");
    
    $addedCount = 0;
    
    foreach ($contactMessages as $message) {
        $insertStmt->execute([
            $message['name'],
            $message['email'],
            $message['phone'],
            $message['subject'],
            $message['message']
        ]);
        
        $addedCount++;
        echo "Added: {$message['name']} - {$message['subject']}\n";
    }
    
    echo "\nSuccessfully added $addedCount contact messages to the database!\n";
    
    // Show updated statistics
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_messages");
    $totalCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total contact messages in database: $totalCount\n";
    
    $stmt = $pdo->query("SELECT COUNT(DISTINCT email) as unique_users FROM contact_messages WHERE name != 'Admin'");
    $uniqueUsers = $stmt->fetch(PDO::FETCH_ASSOC)['unique_users'];
    echo "Unique users: $uniqueUsers\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as admin_messages FROM contact_messages WHERE name = 'Admin'");
    $adminMessages = $stmt->fetch(PDO::FETCH_ASSOC)['admin_messages'];
    echo "Admin messages: $adminMessages\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 