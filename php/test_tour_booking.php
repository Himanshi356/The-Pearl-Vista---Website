<?php
// Test file for tour booking functionality
echo "<h2>Tour Booking Test</h2>";

// Test database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Connection failed: " . $conn->connect_error . "</p>";
    exit();
}

echo "<p style='color: green;'>✅ Database connection successful</p>";

// Check if tour_bookings table exists
$result = $conn->query("SHOW TABLES LIKE 'tour_bookings'");
if ($result->num_rows > 0) {
    echo "<p style='color: green;'>✅ Tour bookings table exists</p>";
    
    // Show table structure
    $result = $conn->query("DESCRIBE tour_bookings");
    echo "<h3>Tour Bookings Table Structure:</h3>";
    echo "<table border='1' style='border-collapse: collapse;'>";
    echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: red;'>❌ Tour bookings table does not exist</p>";
}

$conn->close();
?> 