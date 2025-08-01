<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in and is admin
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
    exit();
}

try {
    require_once dirname(__FILE__) . '/../../Config/database.php';
    $pdo = getDatabaseConnection();
    
    // Get POST data
    $data = json_decode(file_get_contents('php://input'), true);
    
    if (!$data) {
        echo json_encode(['status' => 'error', 'message' => 'No data received']);
        exit();
    }
    
    // Validate and sanitize data
    $allowedFields = [
        'hotel_name', 'hotel_address', 'hotel_phone', 'hotel_email', 'hotel_website',
        'email_notifications', 'sms_notifications', 'booking_confirmations', 'reminder_notifications',
        'session_timeout', 'password_policy', 'two_factor_auth', 'login_notifications',
        'timezone', 'date_format', 'currency', 'maintenance_mode',
        'backup_frequency', 'data_retention_days', 'auto_backup', 'log_analytics'
    ];
    
    $updateData = [];
    $updateValues = [];
    
    foreach ($allowedFields as $field) {
        if (isset($data[$field])) {
            $updateData[] = "$field = ?";
            
            // Convert boolean values to integers for database
            if (in_array($field, ['email_notifications', 'sms_notifications', 'booking_confirmations', 
                                 'reminder_notifications', 'two_factor_auth', 'login_notifications', 
                                 'maintenance_mode', 'auto_backup', 'log_analytics'])) {
                $updateValues[] = $data[$field] ? 1 : 0;
            } else {
                $updateValues[] = $data[$field];
            }
        }
    }
    
    if (empty($updateData)) {
        echo json_encode(['status' => 'error', 'message' => 'No valid fields to update']);
        exit();
    }
    
    // Check if settings exist
    $checkStmt = $pdo->query("SELECT COUNT(*) FROM admin_settings WHERE id = 1");
    $exists = $checkStmt->fetchColumn() > 0;
    
    if ($exists) {
        // Update existing settings
        $sql = "UPDATE admin_settings SET " . implode(', ', $updateData) . " WHERE id = 1";
    } else {
        // Insert new settings
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $sql = "INSERT INTO admin_settings ($columns) VALUES ($placeholders)";
        $updateValues = array_values($data);
    }
    
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute($updateValues);
    
    if ($result) {
        // Log the settings update
        $admin_id = $_SESSION['user'];
        $log_stmt = $pdo->prepare("
            INSERT INTO admin_activity_log (admin_id, action, description, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?)
        ");
        $log_stmt->execute([
            $admin_id, 
            'UPDATE_SETTINGS', 
            "Updated system settings", 
            $_SERVER['REMOTE_ADDR'] ?? 'unknown', 
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        echo json_encode(['status' => 'success', 'message' => 'Settings updated successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to update settings']);
    }
    
} catch (Exception $e) {
    error_log("Error updating settings: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
}
?> 