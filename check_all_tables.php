<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "=== ALL TABLES IN DATABASE ===\n\n";
    
    // Get all tables
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "--- Table: $table ---\n";
        
        // Get row count
        $count_stmt = $pdo->query("SELECT COUNT(*) FROM `$table`");
        $count = $count_stmt->fetchColumn();
        echo "Row count: $count\n";
        
        // Get table structure
        $structure_stmt = $pdo->query("DESCRIBE `$table`");
        $columns = $structure_stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "Columns:\n";
        foreach ($columns as $column) {
            echo "  - {$column['Field']} ({$column['Type']})\n";
        }
        
        // If it's a booking-related table, show sample data
        if (strpos(strtolower($table), 'booking') !== false || strpos(strtolower($table), 'reservation') !== false) {
            echo "Sample data:\n";
            $sample_stmt = $pdo->query("SELECT * FROM `$table` LIMIT 3");
            $samples = $sample_stmt->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($samples as $sample) {
                echo "  " . json_encode($sample, JSON_PRETTY_PRINT) . "\n";
            }
        }
        
        echo "\n";
    }
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?> 