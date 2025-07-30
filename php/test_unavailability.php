<?php
// Test script to demonstrate when rooms show as unavailable
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>🚫 Testing Room Unavailability Scenarios</h2>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<p style='color: red;'>❌ Database connection failed</p>";
    exit();
}

// Test scenarios
$test_scenarios = [
    [
        'name' => 'Scenario 1: Request More Rooms Than Available',
        'data' => [
            'checkinDate' => '2024-02-15',
            'checkoutDate' => '2024-02-17',
            'guests' => '4',
            'roomType' => 'Deluxe Room',
            'numRooms' => '15' // More than default 10
        ]
    ],
    [
        'name' => 'Scenario 2: Request Rooms When Database Shows Limited Availability',
        'data' => [
            'checkinDate' => '2024-02-20',
            'checkoutDate' => '2024-02-22',
            'guests' => '2',
            'roomType' => 'Luxury Suite',
            'numRooms' => '3'
        ]
    ],
    [
        'name' => 'Scenario 3: Past Date (Should Show Error)',
        'data' => [
            'checkinDate' => '2023-01-15',
            'checkoutDate' => '2023-01-17',
            'guests' => '2',
            'roomType' => 'Deluxe Room',
            'numRooms' => '1'
        ]
    ]
];

foreach ($test_scenarios as $index => $scenario) {
    echo "<h3>Test " . ($index + 1) . ": " . $scenario['name'] . "</h3>";
    
    // Simulate POST data
    $_POST = $scenario['data'];
    
    // Include the availability check file
    ob_start();
    include 'check_availability.php';
    $output = ob_get_clean();
    
    // Parse JSON response
    $response = json_decode($output, true);
    
    if ($response && isset($response['success'])) {
        if ($response['success']) {
            if (!$response['available']) {
                echo "<p style='color: orange;'>⚠️ Room NOT Available</p>";
                echo "<p style='color: blue;'>📊 Message: " . $response['message'] . "</p>";
                echo "<p style='color: blue;'>📊 Available: " . $response['available_rooms'] . " rooms</p>";
                echo "<p style='color: blue;'>📊 Requested: " . $response['requested_rooms'] . " rooms</p>";
            } else {
                echo "<p style='color: green;'>✅ Room Available</p>";
                echo "<p style='color: blue;'>📊 Message: " . $response['message'] . "</p>";
            }
        } else {
            echo "<p style='color: red;'>❌ Error: " . $response['message'] . "</p>";
        }
    } else {
        echo "<p style='color: red;'>❌ Invalid response format</p>";
    }
    echo "<hr>";
}

// Create a scenario where rooms are actually booked and unavailable
echo "<h3>Creating Real Unavailability Scenario</h3>";

// First, let's create a booking that reduces availability
$booking_data = [
    'customer_name' => 'Test Booking',
    'customer_email' => 'test@example.com',
    'customer_phone' => '1234567890',
    'room_type' => 'Deluxe Room',
    'check_in_date' => '2024-03-01',
    'check_out_date' => '2024-03-03',
    'num_guests' => '2',
    'num_rooms' => '8', // Book 8 out of 10 rooms
    'total_amount' => '1600.00'
];

$_POST = $booking_data;

// Process the booking to reduce availability
ob_start();
include 'room_booking_process.php';
$booking_output = ob_get_clean();
$booking_response = json_decode($booking_output, true);

if ($booking_response && $booking_response['success']) {
    echo "<p style='color: green;'>✅ Created booking that reduces availability</p>";
    
    // Now test availability for the same dates
    $test_data = [
        'checkinDate' => '2024-03-01',
        'checkoutDate' => '2024-03-03',
        'guests' => '4',
        'roomType' => 'Deluxe Room',
        'numRooms' => '3' // Try to book 3 rooms when only 2 are left
    ];
    
    $_POST = $test_data;
    
    ob_start();
    include 'check_availability.php';
    $test_output = ob_get_clean();
    $test_response = json_decode($test_output, true);
    
    if ($test_response && $test_response['success']) {
        if (!$test_response['available']) {
            echo "<p style='color: orange;'>⚠️ SUCCESS: System correctly shows rooms as unavailable</p>";
            echo "<p style='color: blue;'>📊 Message: " . $test_response['message'] . "</p>";
            echo "<p style='color: blue;'>📊 Available: " . $test_response['available_rooms'] . " rooms</p>";
            echo "<p style='color: blue;'>📊 Requested: " . $test_response['requested_rooms'] . " rooms</p>";
        } else {
            echo "<p style='color: red;'>❌ ERROR: System should show rooms as unavailable</p>";
        }
    }
} else {
    echo "<p style='color: red;'>❌ Failed to create test booking</p>";
}

echo "<h3>📋 Summary of When Rooms Show as Unavailable</h3>";
echo "<ul>";
echo "<li><strong>Requested rooms > Available rooms</strong> - User asks for more rooms than exist</li>";
echo "<li><strong>Past dates</strong> - Check-in date is in the past</li>";
echo "<li><strong>Invalid dates</strong> - Check-out date is before check-in date</li>";
echo "<li><strong>After bookings are made</strong> - Availability decreases as rooms are booked</li>";
echo "<li><strong>Maximum capacity exceeded</strong> - More than 10 rooms requested (default limit)</li>";
echo "</ul>";

echo "<h3>🎯 Frontend Behavior</h3>";
echo "<p>When rooms are unavailable, the frontend will:</p>";
echo "<ul>";
echo "<li>Show an error notification instead of the detailed result modal</li>";
echo "<li>Display the message: 'Sorry, only X Room Type(s) are available for your selected dates.'</li>";
echo "<li>Not show the 'Book Now' button</li>";
echo "<li>Allow user to try different dates or room types</li>";
echo "</ul>";

$conn->close();
?> 