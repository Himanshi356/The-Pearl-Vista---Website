<?php
// Test file to simulate admin login and test services API
session_start();

// Simulate admin login
$_SESSION['user'] = 'admin_user';
$_SESSION['role'] = 'admin';

echo "Session created:\n";
echo "User: " . $_SESSION['user'] . "\n";
echo "Role: " . $_SESSION['role'] . "\n\n";

// Test the services API
echo "Testing services API with admin session...\n";

$url = 'http://localhost/Pearl-Vista---Website/Backend/manage_services.php?action=get_services';

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'header' => 'Content-Type: application/json'
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response !== false) {
    $data = json_decode($response, true);
    if ($data && isset($data['status'])) {
        echo "API Response Status: " . $data['status'] . "\n";
        if ($data['status'] === 'error') {
            echo "Error Message: " . $data['message'] . "\n";
        } else {
            echo "Success! Services loaded.\n";
            if (isset($data['services'])) {
                echo "Number of services: " . count($data['services']) . "\n";
            }
            if (isset($data['statistics'])) {
                echo "Statistics: " . json_encode($data['statistics']) . "\n";
            }
        }
    } else {
        echo "Invalid response format: " . $response . "\n";
    }
} else {
    echo "Failed to connect to the API endpoint.\n";
}

echo "\nTest completed!\n";
?> 