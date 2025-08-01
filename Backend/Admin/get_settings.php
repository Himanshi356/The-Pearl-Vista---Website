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
    
    // Get all settings from the database
    $stmt = $pdo->query("SELECT * FROM admin_settings WHERE id = 1");
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$settings) {
        // Create default settings if none exist
        $defaultSettings = [
            'hotel_name' => 'The Pearl Vista',
            'hotel_address' => '123 Luxury Street, Downtown, City, Country',
            'hotel_phone' => '+1 (555) 123-4567',
            'hotel_email' => 'info@pearlvista.com',
            'hotel_website' => 'https://www.pearlvista.com',
            'email_notifications' => 1,
            'sms_notifications' => 0,
            'booking_confirmations' => 1,
            'reminder_notifications' => 1,
            'session_timeout' => 30,
            'password_policy' => 'strong',
            'two_factor_auth' => 1,
            'login_notifications' => 0,
            'timezone' => 'UTC',
            'date_format' => 'MM/DD/YYYY',
            'currency' => 'USD',
            'maintenance_mode' => 0,
            'backup_frequency' => 'daily',
            'data_retention_days' => 365,
            'auto_backup' => 1,
            'log_analytics' => 1
        ];
        
        $columns = implode(', ', array_keys($defaultSettings));
        $values = implode(', ', array_fill(0, count($defaultSettings), '?'));
        
        $stmt = $pdo->prepare("INSERT INTO admin_settings ($columns) VALUES ($values)");
        $stmt->execute(array_values($defaultSettings));
        
        $settings = $defaultSettings;
    }
    
    echo json_encode(['status' => 'success', 'settings' => $settings]);
    
} catch (Exception $e) {
    error_log("Error getting settings: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Failed to load settings']);
}
?> 