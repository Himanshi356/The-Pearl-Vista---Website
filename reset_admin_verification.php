<?php
// Reset admin verification system
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Reset Admin Verification System</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
    
    $username = 'admin';
    $email = 'admin@pearlvista.com';
    
    echo "<h3>1. Clearing existing verification codes:</h3>";
    
    // Clear verification codes from both tables
    $stmt1 = $pdo->prepare("UPDATE admins SET verification_code = NULL WHERE username = ? AND email = ?");
    $result1 = $stmt1->execute([$username, $email]);
    
    $stmt2 = $pdo->prepare("UPDATE admin_users SET verification_code = NULL WHERE username = ? AND email = ?");
    $result2 = $stmt2->execute([$username, $email]);
    
    echo "✅ Cleared verification codes from both tables<br>";
    
    echo "<h3>2. Cleaning up old email files:</h3>";
    $emails_dir = 'emails';
    if (is_dir($emails_dir)) {
        $files = glob($emails_dir . '/admin_verification_*.html');
        foreach ($files as $file) {
            unlink($file);
            echo "✅ Deleted: " . basename($file) . "<br>";
        }
    }
    
    echo "<h3>3. System Status:</h3>";
    
    // Check admins table
    $stmt = $pdo->prepare("SELECT verification_code FROM admins WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin) {
        echo "✅ Admin found in admins table<br>";
        echo "Verification Code: " . ($admin['verification_code'] ?? 'NULL') . "<br>";
    }
    
    // Check admin_users table
    $stmt = $pdo->prepare("SELECT verification_code FROM admin_users WHERE username = ? AND email = ?");
    $stmt->execute([$username, $email]);
    $admin_user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin_user) {
        echo "✅ Admin found in admin_users table<br>";
        echo "Verification Code: " . ($admin_user['verification_code'] ?? 'NULL') . "<br>";
    }
    
    echo "<h3>4. Test Instructions:</h3>";
    echo "<div style='background: #f0f8ff; padding: 20px; border-radius: 10px; margin: 20px 0;'>";
    echo "<h4>🎯 Fresh Test:</h4>";
    echo "<ol>";
    echo "<li>Go to <a href='admin-recovery.html' target='_blank'>admin-recovery.html</a></li>";
    echo "<li>Enter username: <strong>admin</strong></li>";
    echo "<li>Enter email: <strong>admin@pearlvista.com</strong></li>";
    echo "<li>Click <strong>'Send Recovery Email'</strong></li>";
    echo "<li>A new tab will open with the verification code</li>";
    echo "<li>Copy the code from the new tab</li>";
    echo "<li>Enter the code in the verification page</li>";
    echo "<li>The verification should now work correctly!</li>";
    echo "</ol>";
    echo "</div>";
    
    echo "<h3>5. What was fixed:</h3>";
    echo "<ul>";
    echo "<li>✅ Cleared all existing verification codes</li>";
    echo "<li>✅ Deleted old email files</li>";
    echo "<li>✅ Ensured same code is used for database and HTML file</li>";
    echo "<li>✅ System is now ready for fresh testing</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?> 