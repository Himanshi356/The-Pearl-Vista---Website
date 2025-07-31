<?php
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Check if users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    $usersTableExists = $stmt->rowCount() > 0;
    echo "Users table exists: " . ($usersTableExists ? "Yes" : "No") . "\n";
    
    if ($usersTableExists) {
        // Show users table structure
        $stmt = $pdo->query("DESCRIBE users");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Users table structure:\n";
        foreach ($columns as $column) {
            echo "- " . $column['Field'] . " (" . $column['Type'] . ")\n";
        }
    }
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?> 