<?php
require_once 'Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        user_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        security_question VARCHAR(255),
        security_answer VARCHAR(255),
        verification_code VARCHAR(6),
        role ENUM('user', 'admin') DEFAULT 'user',
        verified BOOLEAN DEFAULT FALSE,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Users table created successfully\n";
    
    // Create user_details table for personal information
    $sql = "CREATE TABLE IF NOT EXISTS user_details (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        full_name VARCHAR(255),
        phone VARCHAR(20),
        address TEXT,
        emergency_contact VARCHAR(255),
        date_of_birth DATE,
        gender ENUM('Male', 'Female', 'Other'),
        nationality VARCHAR(100),
        room_type_preference VARCHAR(100),
        floor_preference VARCHAR(100),
        special_requests TEXT,
        dietary_restrictions TEXT,
        last_login TIMESTAMP,
        two_factor_auth ENUM('Active', 'Inactive') DEFAULT 'Active',
        password_changed_date TIMESTAMP NULL,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
    )";
    
    $pdo->exec($sql);
    echo "User details table created successfully\n";
    
    // Create rooms table
    $sql = "CREATE TABLE IF NOT EXISTS rooms (
        room_id INT AUTO_INCREMENT PRIMARY KEY,
        room_number VARCHAR(10) UNIQUE NOT NULL,
        room_type VARCHAR(50) NOT NULL,
        capacity INT NOT NULL,
        price_per_night DECIMAL(10,2) NOT NULL,
        description TEXT,
        amenities TEXT,
        status ENUM('available', 'occupied', 'maintenance') DEFAULT 'available',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    $pdo->exec($sql);
    echo "Rooms table created successfully\n";
    
    // Create bookings table
    $sql = "CREATE TABLE IF NOT EXISTS bookings (
        booking_id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        room_id INT NOT NULL,
        check_in_date DATE NOT NULL,
        check_out_date DATE NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
                        status ENUM('pending', 'confirmed', 'cancelled', 'completed', 'checked-in') DEFAULT 'pending',
        booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(user_id),
        FOREIGN KEY (room_id) REFERENCES rooms(room_id)
    )";
    
    $pdo->exec($sql);
    echo "Bookings table created successfully\n";
    
    echo "Database setup completed successfully!\n";
    
} catch (PDOException $e) {
    echo "Database setup failed: " . $e->getMessage() . "\n";
}
?> 