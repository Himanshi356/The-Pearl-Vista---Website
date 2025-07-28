<?php
// Script to update the default status for tour_bookings table
echo "<h2>Updating Tour Bookings Default Status</h2>";

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Connected to database successfully</p>";

// Update existing pending bookings to confirmed
$sql = "UPDATE tour_bookings SET status = 'confirmed' WHERE status = 'pending'";
if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Updated " . $conn->affected_rows . " pending bookings to confirmed</p>";
} else {
    echo "<p style='color: red;'>❌ Error updating bookings: " . $conn->error . "</p>";
}

// Modify the table to change default status
$sql = "ALTER TABLE tour_bookings MODIFY COLUMN status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'confirmed'";
if ($conn->query($sql) === TRUE) {
    echo "<p style='color: green;'>✅ Changed default status to 'confirmed'</p>";
} else {
    echo "<p style='color: red;'>❌ Error modifying table: " . $conn->error . "</p>";
}

$conn->close();
echo "<p style='color: green; font-weight: bold;'>🎉 Status update completed!</p>";
echo "<p>New bookings will now default to 'confirmed' status.</p>";
?> 