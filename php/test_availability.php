<?php
// Test script for room availability system
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🧪 Room Availability System Test</h2>";

// Test 1: Check if tables exist
echo "<h3>Test 1: Database Tables</h3>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pearlvista";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Database connection failed</p>";
    exit();
}

// Check if tables exist
$tables = ['room_availability', 'room_bookings'];
foreach ($tables as $table) {
    $result = $conn->query("SHOW TABLES LIKE '$table'");
    if ($result->num_rows > 0) {
        echo "<p style='color: green;'>✅ Table '$table' exists</p>";
    } else {
        echo "<p style='color: red;'>❌ Table '$table' does not exist</p>";
    }
}

// Test 2: Test availability checking
echo "<h3>Test 2: Availability Check</h3>";

// Simulate POST data
$_POST['checkinDate'] = '2024-02-15';
$_POST['checkoutDate'] = '2024-02-17';
$_POST['guests'] = '2';
$_POST['roomType'] = 'Deluxe Room';
$_POST['numRooms'] = '1';

// Include the availability check file
ob_start();
include 'check_availability.php';
$output = ob_get_clean();

// Parse JSON response
$response = json_decode($output, true);

if ($response && isset($response['success'])) {
    if ($response['success']) {
        echo "<p style='color: green;'>✅ Availability check successful</p>";
        echo "<p style='color: blue;'>📊 Response: " . htmlspecialchars($output) . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Availability check failed: " . $response['message'] . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Invalid response format</p>";
    echo "<p style='color: blue;'>📊 Raw output: " . htmlspecialchars($output) . "</p>";
}

// Test 3: Test booking process
echo "<h3>Test 3: Booking Process</h3>";

// Simulate booking data
$_POST['customer_name'] = 'Test User';
$_POST['customer_email'] = 'test@example.com';
$_POST['customer_phone'] = '1234567890';
$_POST['room_type'] = 'Deluxe Room';
$_POST['check_in_date'] = '2024-02-15';
$_POST['check_out_date'] = '2024-02-17';
$_POST['num_guests'] = '2';
$_POST['num_rooms'] = '1';
$_POST['total_amount'] = '800.00';

// Include the booking process file
ob_start();
include 'room_booking_process.php';
$booking_output = ob_get_clean();

// Parse JSON response
$booking_response = json_decode($booking_output, true);

if ($booking_response && isset($booking_response['success'])) {
    if ($booking_response['success']) {
        echo "<p style='color: green;'>✅ Booking process successful</p>";
        echo "<p style='color: blue;'>📊 Booking ID: " . $booking_response['booking_id'] . "</p>";
    } else {
        echo "<p style='color: red;'>❌ Booking process failed: " . $booking_response['message'] . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ Invalid booking response format</p>";
    echo "<p style='color: blue;'>📊 Raw output: " . htmlspecialchars($booking_output) . "</p>";
}

// Test 4: Check database records
echo "<h3>Test 4: Database Records</h3>";

// Check room_availability table
$result = $conn->query("SELECT COUNT(*) as count FROM room_availability");
if ($result) {
    $row = $result->fetch_assoc();
    echo "<p style='color: green;'>✅ Room availability records: " . $row['count'] . "</p>";
} else {
    echo "<p style='color: red;'>❌ Error checking room_availability table</p>";
}

// Check room_bookings table
$result = $conn->query("SELECT COUNT(*) as count FROM room_bookings");
if ($result) {
    $row = $result->fetch_assoc();
    echo "<p style='color: green;'>✅ Room booking records: " . $row['count'] . "</p>";
} else {
    echo "<p style='color: red;'>❌ Error checking room_bookings table</p>";
}

$conn->close();

echo "<h3>🎯 Manual Testing Steps</h3>";
echo "<ol>";
echo "<li><strong>Open your browser</strong> and go to: <code>http://localhost/Pearl-Vista---Website/home.html</code></li>";
echo "<li><strong>Look for the welcome modal</strong> that appears when you first visit the page</li>";
echo "<li><strong>Click 'Check Availability'</strong> button in the modal</li>";
echo "<li><strong>Fill out the availability form:</strong>";
echo "<ul>";
echo "<li>Check-in Date: Select a future date</li>";
echo "<li>Check-out Date: Select a date after check-in</li>";
echo "<li>Number of Guests: Enter 1-10</li>";
echo "<li>Type of Room: Select any room type</li>";
echo "<li>Number of Rooms: Enter 1-5</li>";
echo "</ul></li>";
echo "<li><strong>Click 'Check'</strong> button</li>";
echo "<li><strong>Verify the result modal</strong> shows availability and pricing</li>";
echo "<li><strong>Click 'Book Now'</strong> to test the booking flow</li>";
echo "</ol>";

echo "<h3>🔍 Expected Results</h3>";
echo "<ul>";
echo "<li>✅ Availability form should open when clicking 'Check Availability'</li>";
echo "<li>✅ Form should submit and show loading state</li>";
echo "<li>✅ Result modal should show room availability and pricing</li>";
echo "<li>✅ 'Book Now' button should redirect to rooms page</li>";
echo "<li>✅ Database should contain the test records</li>";
echo "</ul>";

echo "<h3>🐛 Troubleshooting</h3>";
echo "<ul>";
echo "<li><strong>If modal doesn't appear:</strong> Check browser console for JavaScript errors</li>";
echo "<li><strong>If form doesn't submit:</strong> Verify PHP files are accessible</li>";
echo "<li><strong>If database errors:</strong> Check XAMPP MySQL service is running</li>";
echo "<li><strong>If 404 errors:</strong> Verify file paths are correct</li>";
echo "</ul>";

echo "<p style='color: green; font-weight: bold;'>🎉 Testing complete! The system should be ready for use.</p>";
?> 