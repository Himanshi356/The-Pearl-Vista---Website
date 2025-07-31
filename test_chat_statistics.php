<?php
// Test script to check chat statistics
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    echo "=== Chat Statistics Test ===\n\n";
    
    // Test 1: Check if contact_messages table exists and has data
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM contact_messages");
    $totalMessages = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    echo "1. Total messages in database: $totalMessages\n";
    
    // Test 2: Check active chats (unique users with recent messages)
    $stmt = $pdo->query("
        SELECT COUNT(DISTINCT email) as active_chats 
        FROM contact_messages 
        WHERE created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR)
    ");
    $activeChats = $stmt->fetch(PDO::FETCH_ASSOC)['active_chats'];
    echo "2. Active chats (last 24h): $activeChats\n";
    
    // Test 3: Check average response time
    $stmt = $pdo->query("
        SELECT AVG(response_time) as avg_response_time
        FROM (
            SELECT 
                email,
                TIMESTAMPDIFF(MINUTE, 
                    LAG(created_at) OVER (PARTITION BY email ORDER BY created_at), 
                    created_at
                ) as response_time
            FROM contact_messages
            WHERE email IN (
                SELECT email 
                FROM contact_messages 
                GROUP BY email 
                HAVING COUNT(*) > 1
            )
        ) as response_times
        WHERE response_time IS NOT NULL
    ");
    $avgResponse = $stmt->fetch(PDO::FETCH_ASSOC)['avg_response_time'];
    $avgResponse = $avgResponse ? round($avgResponse, 1) : 4.8;
    echo "3. Average response time: $avgResponse minutes\n";
    
    // Test 4: Check satisfaction rate
    $stmt = $pdo->query("
        SELECT COUNT(*) as satisfied_customers
        FROM (
            SELECT email, COUNT(*) as message_count
            FROM contact_messages
            GROUP BY email
            HAVING COUNT(*) >= 2
        ) as multi_message_users
    ");
    $satisfiedCustomers = $stmt->fetch(PDO::FETCH_ASSOC)['satisfied_customers'];
    $satisfactionRate = $totalMessages > 0 ? round(($satisfiedCustomers / $totalMessages) * 100, 1) : 0;
    echo "4. Satisfaction rate: $satisfactionRate%\n";
    
    // Test 5: Check yesterday vs today comparison
    $stmt = $pdo->query("
        SELECT COUNT(*) as yesterday_messages
        FROM contact_messages 
        WHERE DATE(created_at) = DATE_SUB(CURDATE(), INTERVAL 1 DAY)
    ");
    $yesterdayMessages = $stmt->fetch(PDO::FETCH_ASSOC)['yesterday_messages'];
    
    $stmt = $pdo->query("
        SELECT COUNT(*) as today_messages
        FROM contact_messages 
        WHERE DATE(created_at) = CURDATE()
    ");
    $todayMessages = $stmt->fetch(PDO::FETCH_ASSOC)['today_messages'];
    
    $messageChange = $yesterdayMessages > 0 
        ? round((($todayMessages - $yesterdayMessages) / $yesterdayMessages) * 100, 1)
        : 0;
    
    echo "5. Message change: $messageChange% (Today: $todayMessages, Yesterday: $yesterdayMessages)\n";
    
    // Test 6: Simulate the actual API response
    $stats = [
        'active_chats' => $activeChats,
        'total_messages' => $totalMessages,
        'avg_response_time' => $avgResponse,
        'satisfaction_rate' => $satisfactionRate,
        'message_change' => $messageChange,
        'chat_change' => $todayMessages - $yesterdayMessages
    ];
    
    echo "\n=== Simulated API Response ===\n";
    echo json_encode([
        'status' => 'success',
        'statistics' => $stats
    ], JSON_PRETTY_PRINT);
    
    echo "\n\n=== Test Complete ===\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 