<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root"; // default for XAMPP
$password = "";     // default for XAMPP
$dbname = "pearlvista";

echo "<h2>Pearl Vista Database Setup</h2>";

// Create connection without specifying database first
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Connected to MySQL server successfully</p>";

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating database: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Database '$dbname' is ready</p>";

// Select the database
$conn->select_db($dbname);

// Create contact_messages table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating contact_messages table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Contact messages table is ready</p>";

// Create chat_messages table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS chat_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    user_name VARCHAR(255) DEFAULT 'Guest',
    message TEXT NOT NULL,
    message_type ENUM('user', 'bot') DEFAULT 'user',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_session_id (session_id),
    INDEX idx_created_at (created_at)
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating chat_messages table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Chat messages table is ready</p>";

// Create chat_sessions table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS chat_sessions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) UNIQUE NOT NULL,
    user_name VARCHAR(255) DEFAULT 'Guest',
    user_email VARCHAR(255),
    status ENUM('active', 'closed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_session_id (session_id),
    INDEX idx_status (status)
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating chat_sessions table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Chat sessions table is ready</p>";

// Create users table if it doesn't exist (for future use)
$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating users table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Users table is ready</p>";

// Create bookings table if it doesn't exist (for future use)
$sql = "CREATE TABLE IF NOT EXISTS bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    room_type VARCHAR(100) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    guests INT(11) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating bookings table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Bookings table is ready</p>";

// Create tour_bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS tour_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    tour_date DATE NOT NULL,
    tour_time TIME NOT NULL,
    places_to_visit TEXT NOT NULL,
    number_of_travellers INT(11) NOT NULL,
    vehicle_type VARCHAR(50) NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating tour_bookings table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Tour bookings table is ready</p>";

// Create room_availability table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS room_availability (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(100) NOT NULL,
    total_rooms INT(11) NOT NULL DEFAULT 10,
    available_rooms INT(11) NOT NULL DEFAULT 10,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_room_type (room_type),
    INDEX idx_dates (check_in_date, check_out_date)
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating room_availability table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Room availability table is ready</p>";

// Create room_bookings table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS room_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    room_type VARCHAR(100) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_guests INT(11) NOT NULL,
    num_rooms INT(11) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === FALSE) {
    echo "<p style='color: red;'>❌ Error creating room_bookings table: " . $conn->error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Room bookings table is ready</p>";

// Show table structure
echo "<h3>Database Tables:</h3>";
$result = $conn->query("SHOW TABLES");
if ($result->num_rows > 0) {
    echo "<ul>";
    while($row = $result->fetch_array()) {
        echo "<li>" . $row[0] . "</li>";
    }
    echo "</ul>";
}

$conn->close();

echo "<p style='color: green; font-weight: bold;'>🎉 Database setup completed successfully!</p>";
echo "<p>You can now use the contact form and real-time chat on your website.</p>";
?> 