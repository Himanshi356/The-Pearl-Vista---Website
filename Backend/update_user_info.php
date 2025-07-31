<?php
// Add CORS headers
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once '../Config/database.php';

try {
    $pdo = getDatabaseConnection();
    
    // Get data from request
    $input = json_decode(file_get_contents('php://input'), true);
    
    $email = $input['email'] ?? null;
    $full_name = $input['full_name'] ?? null;
    $phone = $input['phone'] ?? null;
    $address = $input['address'] ?? null;
    $emergency_contact = $input['emergency_contact'] ?? null;
    $date_of_birth = $input['date_of_birth'] ?? null;
    $gender = $input['gender'] ?? null;
    $nationality = $input['nationality'] ?? null;
    $preferences = $input['preferences'] ?? null;
    
    if (!$email) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email is required'
        ]);
        exit();
    }
    
    // Get user_id first
    error_log("Looking for user with email: " . $email);
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    error_log("User found: " . ($user ? "YES" : "NO"));
    
    if (!$user) {
        echo json_encode([
            'status' => 'error',
            'message' => 'User not found with email: ' . $email
        ]);
        exit();
    }
    
    $user_id = $user['id'];
    
    // Check if user_details record exists
    $stmt = $pdo->prepare("SELECT id FROM user_details WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $user_detail = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Only update personal info if any personal info fields are provided
    $has_personal_info = $full_name || $phone || $address || $emergency_contact || $date_of_birth || $gender || $nationality;
    
    // Log what we're updating for debugging
    error_log("Update request - Personal info: " . ($has_personal_info ? "YES" : "NO") . ", Preferences: " . (($preferences && is_array($preferences)) ? "YES" : "NO"));
    error_log("Personal info fields: full_name=" . ($full_name ?: "NULL") . ", phone=" . ($phone ?: "NULL") . ", address=" . ($address ?: "NULL"));
    
    if ($has_personal_info) {
        if ($user_detail) {
            // Update existing user_details record - only update provided fields
            $update_fields = [];
            $update_values = [];
            
            if ($full_name !== null) {
                $update_fields[] = "full_name = ?";
                $update_values[] = $full_name;
            }
            if ($phone !== null) {
                $update_fields[] = "phone = ?";
                $update_values[] = $phone;
            }
            if ($address !== null) {
                $update_fields[] = "address = ?";
                $update_values[] = $address;
            }
            if ($emergency_contact !== null) {
                $update_fields[] = "emergency_contact = ?";
                $update_values[] = $emergency_contact;
            }
            if ($date_of_birth !== null) {
                $update_fields[] = "date_of_birth = ?";
                $update_values[] = $date_of_birth;
            }
            if ($gender !== null) {
                $update_fields[] = "gender = ?";
                $update_values[] = $gender;
            }
            if ($nationality !== null) {
                $update_fields[] = "nationality = ?";
                $update_values[] = $nationality;
            }
            
            if (!empty($update_fields)) {
                $update_fields[] = "updated_at = CURRENT_TIMESTAMP";
                $update_values[] = $user_id;
                
                $sql = "UPDATE user_details SET " . implode(", ", $update_fields) . " WHERE user_id = ?";
                $stmt = $pdo->prepare($sql);
                $result = $stmt->execute($update_values);
            } else {
                $result = true; // No personal info to update
            }
        } else {
            // Insert new user_details record
            $stmt = $pdo->prepare("INSERT INTO user_details (
                user_id, full_name, phone, address, emergency_contact, 
                date_of_birth, gender, nationality
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $result = $stmt->execute([
                $user_id, $full_name, $phone, $address, $emergency_contact,
                $date_of_birth, $gender, $nationality
            ]);
        }
    } else {
        $result = true; // No personal info to update
    }
    
    // Handle preferences separately if provided
    if ($preferences && is_array($preferences)) {
        error_log("Updating preferences: " . json_encode($preferences));
        if ($user_detail) {
            // Update only preferences, preserving existing personal info
            $stmt = $pdo->prepare("UPDATE user_details SET 
                room_type_preference = ?, floor_preference = ?, special_requests = ?, dietary_restrictions = ?,
                updated_at = CURRENT_TIMESTAMP
                WHERE user_id = ?");
            $result = $stmt->execute([
                $preferences['room_type'] ?? null, $preferences['floor_preference'] ?? null,
                $preferences['special_requests'] ?? null, $preferences['dietary_restrictions'] ?? null,
                $user_id
            ]);
        } else {
            // Create new record with only preferences
            $stmt = $pdo->prepare("INSERT INTO user_details (
                user_id, room_type_preference, floor_preference, special_requests, dietary_restrictions
            ) VALUES (?, ?, ?, ?, ?)");
            $result = $stmt->execute([
                $user_id, $preferences['room_type'] ?? null, $preferences['floor_preference'] ?? null,
                $preferences['special_requests'] ?? null, $preferences['dietary_restrictions'] ?? null
            ]);
        }
    }
    
    if ($result) {
        // Fetch the updated data to return
        $stmt = $pdo->prepare("SELECT ud.full_name, ud.phone, ud.address, ud.emergency_contact, 
                              ud.date_of_birth, ud.gender, ud.nationality,
                              ud.room_type_preference, ud.floor_preference, ud.special_requests, ud.dietary_restrictions
                              FROM user_details ud WHERE ud.user_id = ?");
        $stmt->execute([$user_id]);
        $updated_data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Only include non-empty values in response
        $response_data = ['email' => $email];
        if ($updated_data['full_name']) $response_data['full_name'] = $updated_data['full_name'];
        if ($updated_data['phone']) $response_data['phone'] = $updated_data['phone'];
        if ($updated_data['address']) $response_data['address'] = $updated_data['address'];
        if ($updated_data['emergency_contact']) $response_data['emergency_contact'] = $updated_data['emergency_contact'];
        if ($updated_data['date_of_birth']) $response_data['date_of_birth'] = $updated_data['date_of_birth'];
        if ($updated_data['gender']) $response_data['gender'] = $updated_data['gender'];
        if ($updated_data['nationality']) $response_data['nationality'] = $updated_data['nationality'];
        
        $response_data['preferences'] = [
            'room_type' => $updated_data['room_type_preference'] ?: '-',
            'floor_preference' => $updated_data['floor_preference'] ?: '-',
            'special_requests' => $updated_data['special_requests'] ?: '-',
            'dietary_restrictions' => $updated_data['dietary_restrictions'] ?: '-'
        ];
        
        echo json_encode([
            'status' => 'success',
            'message' => 'User information updated successfully',
            'data' => $response_data
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to update user information'
        ]);
    }
    
} catch (Exception $e) {
    error_log("Error updating user info: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to update user information'
    ]);
}
?>
