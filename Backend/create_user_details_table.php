<?php
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Create user_details table for personal information
    $sql = "CREATE TABLE IF NOT EXISTS user_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        full_name VARCHAR(255) NULL,
        phone VARCHAR(20) NULL,
        address TEXT NULL,
        emergency_contact VARCHAR(255) NULL,
        date_of_birth DATE NULL,
        gender ENUM('Male', 'Female', 'Other') NULL,
        nationality VARCHAR(100) NULL,
        room_type_preference VARCHAR(100) NULL,
        floor_preference VARCHAR(100) NULL,
        special_requests TEXT NULL,
        dietary_restrictions TEXT NULL,
        last_login TIMESTAMP NULL,
        two_factor_auth ENUM('Active', 'Inactive') DEFAULT 'Active',
        password_changed_date TIMESTAMP NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
    echo "User details table created successfully\n";
    
} catch (PDOException $e) {
    echo "Database setup failed: " . $e->getMessage() . "\n";
}
?> 