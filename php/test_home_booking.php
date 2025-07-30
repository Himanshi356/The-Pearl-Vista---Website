<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Pearl Vista Home Booking System Test</h2>";

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Database connection failed: " . $conn->connect_error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ MySQL connection successful</p>";

// Check if home_bookings table exists
$result = $conn->query("SHOW TABLES LIKE 'home_bookings'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ home_bookings table exists</p>";
    
    // Check table structure
    $result = $conn->query("DESCRIBE home_bookings");
    echo "<p style='color: blue;'>ℹ️ Table structure:</p>";
    echo "<ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<li><strong>" . $row['Field'] . "</strong>: " . $row['Type'] . " (" . $row['Null'] . ")</li>";
    }
    echo "</ul>";
} else {
    echo "<p style='color: red;'>❌ home_bookings table does not exist</p>";
}

// Check uploads directory
$upload_dir = dirname(__DIR__) . '/uploads/';
if (is_dir($upload_dir)) {
    echo "<p style='color: green;'>✅ Uploads directory exists</p>";
    if (is_writable($upload_dir)) {
        echo "<p style='color: green;'>✅ Uploads directory is writable</p>";
    } else {
        echo "<p style='color: red;'>❌ Uploads directory is not writable</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Uploads directory does not exist</p>";
}

// Test a simple insert to verify the table works
$test_booking_id = 'TEST' . time();
$stmt = $conn->prepare("INSERT INTO home_bookings (customer_name, customer_phone, customer_email, room_type, check_in_date, check_out_date, num_guests, num_rooms, total_amount, booking_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if ($stmt) {
    $test_name = "Test User";
    $test_phone = "1234567890";
    $test_email = "test@example.com";
    $test_room_type = "Test Room";
    $test_checkin = "2025-01-01";
    $test_checkout = "2025-01-02";
    $test_guests = 2;
    $test_rooms = 1;
    $test_amount = 1000.00;
    
    $stmt->bind_param("ssssssiids", $test_name, $test_phone, $test_email, $test_room_type, $test_checkin, $test_checkout, $test_guests, $test_rooms, $test_amount, $test_booking_id);
    
    if ($stmt->execute()) {
        echo "<p style='color: green;'>✅ Test record inserted successfully</p>";
        
        // Clean up test record
        $conn->query("DELETE FROM home_bookings WHERE booking_id = '$test_booking_id'");
        echo "<p style='color: blue;'>ℹ️ Test record cleaned up</p>";
    } else {
        echo "<p style='color: red;'>❌ Error inserting test record: " . $stmt->error . "</p>";
    }
    $stmt->close();
} else {
    echo "<p style='color: red;'>❌ Error preparing test statement: " . $conn->error . "</p>";
}

$conn->close();

echo "<p style='color: green; font-weight: bold;'>🎉 All tests completed!</p>";
?> 