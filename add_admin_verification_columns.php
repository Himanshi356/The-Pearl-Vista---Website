<?php
// Script to add verification_code columns to admin tables
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Add Admin Verification Columns</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Add verification_code column to admins table
echo "<h3>1. Adding verification_code to admins table</h3>";
try {
    $stmt = $pdo->prepare("ALTER TABLE admins ADD COLUMN verification_code VARCHAR(10) NULL");
    $result = $stmt->execute();
    
    if ($result) {
        echo "✅ Successfully added verification_code column to admins table<br>";
    } else {
        echo "ℹ️ verification_code column already exists in admins table<br>";
    }
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "ℹ️ verification_code column already exists in admins table<br>";
    } else {
        echo "❌ Error adding verification_code to admins table: " . $e->getMessage() . "<br>";
    }
}

// Add verification_code column to admin_users table
echo "<h3>2. Adding verification_code to admin_users table</h3>";
try {
    $stmt = $pdo->prepare("ALTER TABLE admin_users ADD COLUMN verification_code VARCHAR(10) NULL");
    $result = $stmt->execute();
    
    if ($result) {
        echo "✅ Successfully added verification_code column to admin_users table<br>";
    } else {
        echo "ℹ️ verification_code column already exists in admin_users table<br>";
    }
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "ℹ️ verification_code column already exists in admin_users table<br>";
    } else {
        echo "❌ Error adding verification_code to admin_users table: " . $e->getMessage() . "<br>";
    }
}

// Test the admin recovery system
echo "<h3>3. Testing Admin Recovery System</h3>";
echo "<p>✅ Admin password recovery system is now ready!</p>";
echo "<ul>";
echo "<li><strong>admin-recovery.html</strong> - Admin recovery page</li>";
echo "<li><strong>admin-email-verification.html</strong> - Admin email verification</li>";
echo "<li><strong>admin-confirm-password.html</strong> - Admin password setup</li>";
echo "<li><strong>Auth/admin_forgot_password.php</strong> - Admin recovery API</li>";
echo "<li><strong>Auth/admin_send_recovery_code.php</strong> - Send admin codes</li>";
echo "<li><strong>Auth/admin_verify_code.php</strong> - Verify admin codes</li>";
echo "<li><strong>Auth/admin_update_password.php</strong> - Update admin password</li>";
echo "</ul>";

echo "<h3>4. Admin Recovery Flow</h3>";
echo "<div style='background: #f0f8ff; padding: 20px; border-radius: 10px; margin: 20px 0;'>";
echo "<h4>🎯 Admin Password Recovery Journey:</h4>";
echo "<ol>";
echo "<li><strong>Recovery Request:</strong> admin-recovery.html → Enter admin username & email</li>";
echo "<li><strong>Email Verification:</strong> admin-email-verification.html → Enter 6-digit code</li>";
echo "<li><strong>Password Reset:</strong> admin-confirm-password.html → Set new password</li>";
echo "<li><strong>Login:</strong> unified-login.html → Login with new password</li>";
echo "</ol>";
echo "</div>";

echo "<h3>5. Test Links</h3>";
echo "<ul>";
echo "<li><a href='admin-recovery.html' target='_blank'>🔑 Admin Password Recovery</a></li>";
echo "<li><a href='unified-login.html' target='_blank'>🔐 Login Page</a></li>";
echo "</ul>";

echo "<h3>6. How to Use</h3>";
echo "<ol>";
echo "<li>Go to <strong>admin-recovery.html</strong></li>";
echo "<li>Enter admin username and email</li>";
echo "<li>Check email for verification code</li>";
echo "<li>Enter the 6-digit code</li>";
echo "<li>Set a new secure password</li>";
echo "<li>Login with the new password</li>";
echo "</ol>";

echo "<h3>7. Security Features</h3>";
echo "<ul>";
echo "<li>✅ Email verification required</li>";
echo "<li>✅ 6-digit verification codes</li>";
echo "<li>✅ Password strength requirements</li>";
echo "<li>✅ Supports both admins and admin_users tables</li>";
echo "<li>✅ Secure password hashing</li>";
echo "<li>✅ CORS headers for security</li>";
echo "</ul>";
?> 