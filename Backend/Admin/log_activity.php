<?php
require_once '../../Config/database.php';

function logAdminActivity($admin_id, $action, $table_name = null, $record_id = null, $old_values = null, $new_values = null) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("
            INSERT INTO admin_activity_log (admin_id, action, table_name, record_id, old_values, new_values, ip_address, user_agent) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $admin_id,
            $action,
            $table_name,
            $record_id,
            $old_values ? json_encode($old_values) : null,
            $new_values ? json_encode($new_values) : null,
            $_SERVER['REMOTE_ADDR'] ?? '',
            $_SERVER['HTTP_USER_AGENT'] ?? ''
        ]);
        
        return true;
    } catch (Exception $e) {
        error_log("Failed to log admin activity: " . $e->getMessage());
        return false;
    }
}

function getAdminId($admin_id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT admin_id FROM admins WHERE admin_id = ?");
        $stmt->execute([$admin_id]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        return $admin ? $admin['admin_id'] : null;
    } catch (Exception $e) {
        error_log("Failed to get admin ID: " . $e->getMessage());
        return null;
    }
}
?> 