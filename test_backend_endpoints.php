<?php
// Test Backend Endpoints
echo "🧪 Testing Backend Endpoints\n";
echo "=============================\n\n";

// Test 1: Admin Data
echo "1. Testing Admin Data Endpoint:\n";
$adminData = file_get_contents('http://localhost/Pearl-Vista---Website/Backend/Admin/get_admin_data.php');
if ($adminData) {
    $data = json_decode($adminData, true);
    if ($data && isset($data['statistics'])) {
        echo "✅ Admin data loaded successfully\n";
        echo "   - Total Admins: " . ($data['statistics']['total_admins'] ?? 'N/A') . "\n";
        echo "   - Total Rooms: " . ($data['statistics']['total_rooms'] ?? 'N/A') . "\n";
        echo "   - Active Bookings: " . ($data['statistics']['active_bookings'] ?? 'N/A') . "\n";
        echo "   - Total Activity: " . ($data['statistics']['total_activity'] ?? 'N/A') . "\n";
    } else {
        echo "❌ Admin data failed to load\n";
    }
} else {
    echo "❌ Could not access admin data endpoint\n";
}

echo "\n";

// Test 2: Rooms Data
echo "2. Testing Rooms Data Endpoint:\n";
$roomsData = file_get_contents('http://localhost/Pearl-Vista---Website/Backend/Admin/get_rooms_data.php');
if ($roomsData) {
    $data = json_decode($roomsData, true);
    if ($data && isset($data['room_types'])) {
        echo "✅ Rooms data loaded successfully\n";
        echo "   - Room Types: " . count($data['room_types']) . "\n";
        $totalRooms = array_sum(array_column($data['room_types'], 'total_rooms'));
        echo "   - Total Rooms: " . $totalRooms . "\n";
    } else {
        echo "❌ Rooms data failed to load\n";
    }
} else {
    echo "❌ Could not access rooms data endpoint\n";
}

echo "\n";

// Test 3: Bookings Data
echo "3. Testing Bookings Data Endpoint:\n";
$bookingsData = file_get_contents('http://localhost/Pearl-Vista---Website/Backend/Admin/get_bookings_data.php');
if ($bookingsData) {
    $data = json_decode($bookingsData, true);
    if ($data && isset($data['statistics'])) {
        echo "✅ Bookings data loaded successfully\n";
        echo "   - Total Bookings: " . ($data['statistics']['total_bookings'] ?? 'N/A') . "\n";
        echo "   - Confirmed Bookings: " . ($data['statistics']['confirmed_bookings'] ?? 'N/A') . "\n";
        echo "   - Pending Bookings: " . ($data['statistics']['pending_bookings'] ?? 'N/A') . "\n";
    } else {
        echo "❌ Bookings data failed to load\n";
    }
} else {
    echo "❌ Could not access bookings data endpoint\n";
}

echo "\n";
echo "🎯 Test Complete!\n";
?> 