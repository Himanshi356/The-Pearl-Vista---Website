<?php
// Debug script to check admin verification codes
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Admin Verification Debug</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
    
    $username = 'admin';
    $email = 'admin@pearlvista.com';
    
    echo "<h3>Checking admins table:</h3>";
    $stmt = $pdo->prepare("SELECT admin_id, username, email, verification_code FROM admins WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "✅ Admin found in admins table<br>";
        echo "Admin ID: " . $admin['admin_id'] . "<br>";
        echo "Username: " . $admin['username'] . "<br>";
        echo "Email: " . $admin['email'] . "<br>";
        echo "Verification Code: " . ($admin['verification_code'] ?? 'NULL') . "<br><br>";
    } else {
        echo "❌ Admin not found in admins table<br><br>";
    }
    
    echo "<h3>Checking admin_users table:</h3>";
    $stmt = $pdo->prepare("SELECT admin_id, username, email, verification_code FROM admin_users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $admin_user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin_user) {
        echo "✅ Admin found in admin_users table<br>";
        echo "Admin ID: " . $admin_user['admin_id'] . "<br>";
        echo "Username: " . $admin_user['username'] . "<br>";
        echo "Email: " . $admin_user['email'] . "<br>";
        echo "Verification Code: " . ($admin_user['verification_code'] ?? 'NULL') . "<br><br>";
    } else {
        echo "❌ Admin not found in admin_users table<br><br>";
    }
    
    echo "<h3>Checking emails directory:</h3>";
    $emails_dir = 'emails';
    if (is_dir($emails_dir)) {
        $files = glob($emails_dir . '/admin_verification_*.html');
        if (count($files) > 0) {
            echo "✅ Found " . count($files) . " admin verification files:<br>";
            foreach ($files as $file) {
                echo "- " . basename($file) . "<br>";
                $content = file_get_contents($file);
                if (preg_match('/<div class="verification-code">(\d+)<\/div>/', $content, $matches)) {
                    echo "  Code in file: " . $matches[1] . "<br>";
                }
            }
        } else {
            echo "❌ No admin verification files found<br>";
        }
    } else {
        echo "❌ Emails directory not found<br>";
    }
    
    echo "<h3>Checking verification codes log:</h3>";
    $log_file = 'logs/verification_codes.log';
    if (file_exists($log_file)) {
        $lines = file($log_file, FILE_IGNORE_NEW_LINES);
        $admin_lines = array_filter($lines, function($line) use ($email) {
            return strpos($line, $email) !== false && strpos($line, 'Admin verification code') !== false;
        });
        
        if (count($admin_lines) > 0) {
            echo "✅ Found " . count($admin_lines) . " admin verification log entries:<br>";
            foreach (array_slice($admin_lines, -5) as $line) { // Show last 5 entries
                echo "- " . $line . "<br>";
            }
        } else {
            echo "❌ No admin verification log entries found<br>";
        }
    } else {
        echo "❌ Verification codes log file not found<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?> 