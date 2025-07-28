<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Pearl Vista Database Connection Test</h2>";

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pearlvista";

try {
    // Test basic MySQL connection
    $conn = new mysqli($servername, $username, $password);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    
    echo "<p style='color: green;'>✅ MySQL connection successful</p>";
    
    // Test database creation/selection
    $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    if ($conn->query($sql) === FALSE) {
        throw new Exception("Error creating database: " . $conn->error);
    }
    
    echo "<p style='color: green;'>✅ Database '$dbname' is ready</p>";
    
    // Select the database
    $conn->select_db($dbname);
    
    // Test table creation
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
        throw new Exception("Error creating table: " . $conn->error);
    }
    
    echo "<p style='color: green;'>✅ Contact messages table is ready</p>";
    
    // Test inserting a sample record
    $testName = "Test User";
    $testEmail = "test@example.com";
    $testPhone = "1234567890";
    $testSubject = "Test Subject";
    $testMessage = "This is a test message";
    
    $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        throw new Exception("Error preparing statement: " . $conn->error);
    }
    
    $stmt->bind_param("sssss", $testName, $testEmail, $testPhone, $testSubject, $testMessage);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Test record inserted successfully</p>";
        
        // Clean up test record
        $testId = $conn->insert_id;
        $conn->query("DELETE FROM contact_messages WHERE id = $testId");
        echo "<p style='color: blue;'>ℹ️ Test record cleaned up</p>";
    } else {
        throw new Exception("Error inserting test record: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
    
    echo "<p style='color: green; font-weight: bold;'>🎉 All tests passed! Database is ready for use.</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p style='color: orange;'>💡 Make sure XAMPP is running and MySQL service is started.</p>";
}
?> 