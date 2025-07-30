<?php
require_once '../../Config/database.php';
require_once '../Admin/admin_only.php';

header('Content-Type: application/json');

try {
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['settings'])) {
        throw new Exception('Invalid input data');
    }
    
    $user_id = $_SESSION['user'];
    
    // Get admin data for logging
    $stmt = $pdo->prepare("SELECT admin_id FROM admins WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$admin) {
        throw new Exception('Admin not found');
    }
    
    $admin_id = $admin['admin_id'];
    $updated_settings = [];
    
    foreach ($input['settings'] as $setting_key => $setting_value) {
        // Update setting
        $stmt = $pdo->prepare("UPDATE admin_settings SET setting_value = ?, updated_at = CURRENT_TIMESTAMP WHERE setting_key = ?");
        $result = $stmt->execute([$setting_value, $setting_key]);
        
        if ($result) {
            $updated_settings[] = $setting_key;
            
            // Log the activity
            $stmt = $pdo->prepare("
                INSERT INTO admin_activity_log (admin_id, action, table_name, record_id, new_values, ip_address, user_agent) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $admin_id,
                'UPDATE_SETTING',
                'admin_settings',
                null,
                json_encode(['setting_key' => $setting_key, 'setting_value' => $setting_value]),
                $_SERVER['REMOTE_ADDR'] ?? '',
                $_SERVER['HTTP_USER_AGENT'] ?? ''
            ]);
        }
    }
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Settings updated successfully',
        'updated_settings' => $updated_settings
    ]);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?> 