<?php
// Script to check current contact_messages table state
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Check total count
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM contact_messages");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "Total contact messages: $count\n\n";
    
    if ($count > 0) {
        // Show sample records
        $stmt = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 10");
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Recent messages:\n";
        foreach ($messages as $message) {
            echo "- ID: {$message['id']}, Name: {$message['name']}, Email: {$message['email']}, Subject: {$message['subject']}\n";
        }
        
        // Show unique users
        $stmt = $pdo->query("SELECT COUNT(DISTINCT email) as unique_users FROM contact_messages WHERE name != 'Admin'");
        $uniqueUsers = $stmt->fetch(PDO::FETCH_ASSOC)['unique_users'];
        echo "\nUnique users: $uniqueUsers\n";
        
        // Show admin messages count
        $stmt = $pdo->query("SELECT COUNT(*) as admin_messages FROM contact_messages WHERE name = 'Admin'");
        $adminMessages = $stmt->fetch(PDO::FETCH_ASSOC)['admin_messages'];
        echo "Admin messages: $adminMessages\n";
        
        // Show user messages count
        $stmt = $pdo->query("SELECT COUNT(*) as user_messages FROM contact_messages WHERE name != 'Admin'");
        $userMessages = $stmt->fetch(PDO::FETCH_ASSOC)['user_messages'];
        echo "User messages: $userMessages\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 