<?php
// Add CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../Config/database.php';

// Helper function to get relative time
function getRelativeTime($dateString) {
    if (!$dateString) return 'Never';
    
    $now = new DateTime();
    $date = new DateTime($dateString);
    $diff = $now->diff($date);
    
    if ($diff->days == 0) {
        return 'Today';
    } elseif ($diff->days == 1) {
        return 'Yesterday';
    } elseif ($diff->days < 30) {
        return $diff->days . ' days ago';
    } elseif ($diff->days < 365) {
        $months = floor($diff->days / 30);
        return $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
    } else {
        $years = floor($diff->days / 365);
        return $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
    }
}

try {
    $pdo = getDatabaseConnection();
    
    // Get user email from request
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input['email'] ?? null;
    
    if (!$email) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email is required'
        ]);
        exit();
    }
    
    // Fetch user information
    $stmt = $pdo->prepare("SELECT u.id, u.user_id, u.username, u.email, u.role, u.verified, u.created_at, 
                          ud.full_name, ud.phone, ud.address, ud.emergency_contact, ud.date_of_birth, ud.gender, ud.nationality,
                          ud.room_type_preference, ud.floor_preference, ud.special_requests, ud.dietary_restrictions,
                          ud.last_login, ud.two_factor_auth, ud.password_changed_date
                          FROM users u 
                          LEFT JOIN user_details ud ON u.id = ud.user_id 
                          WHERE u.email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$user) {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found'
        ]);
        exit();
    }
    
    // Format the response with actual database values
    $response = [
        'status' => 'success',
        'data' => [
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'full_name' => $user['full_name'] ?: $user['username'], // Use full_name if available, otherwise username
            'role' => $user['role'],
            'verified' => (bool)$user['verified'],
            'member_since' => date('F Y', strtotime($user['created_at'])),
            'last_login' => $user['last_login'] ? date('M j, Y, g:i A', strtotime($user['last_login'])) : date('M j, Y, g:i A', time()),
            'account_status' => $user['verified'] ? 'Active' : 'Pending Verification',
            'two_factor_auth' => $user['two_factor_auth'] ?: 'Active',
            'password_changed' => $user['password_changed_date'] ? getRelativeTime($user['password_changed_date']) : 'Never',
            // Use database values or show '-' if empty
            'phone' => $user['phone'] ?: '-',
            'address' => $user['address'] ?: '-',
            'emergency_contact' => $user['emergency_contact'] ?: '-',
            'date_of_birth' => $user['date_of_birth'] ?: '-',
            'gender' => $user['gender'] ?: '-',
            'nationality' => $user['nationality'] ?: '-',
            'preferences' => [
                'room_type' => $user['room_type_preference'] ?: '-',
                'floor_preference' => $user['floor_preference'] ?: '-',
                'special_requests' => $user['special_requests'] ?: '-',
                'dietary_restrictions' => $user['dietary_restrictions'] ?: '-'
            ]
        ]
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    error_log("Error fetching user info: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to fetch user information'
    ]);
}
?>

