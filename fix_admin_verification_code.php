<?php
// Fix admin verification code mismatch
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Fix Admin Verification Code Mismatch</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
    
    $username = 'admin';
    $email = 'admin@pearlvista.com';
    $correct_code = '695922'; // The code from the HTML file
    
    echo "<h3>Updating admin_users table:</h3>";
    
    // Update the verification code in admin_users table
    $stmt = $pdo->prepare("UPDATE admin_users SET verification_code = ? WHERE username = ? AND email = ?");
    $result = $stmt->execute([$correct_code, $username, $email]);
    
    if ($result) {
        echo "✅ Successfully updated verification code to: $correct_code<br>";
        
        // Verify the update
        $check_stmt = $pdo->prepare("SELECT verification_code FROM admin_users WHERE username = ? AND email = ?");
        $check_stmt->execute([$username, $email]);
        $admin = $check_stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin) {
            echo "✅ Verified: Database now has code: " . $admin['verification_code'] . "<br>";
        }
    } else {
        echo "❌ Failed to update verification code<br>";
    }
    
    echo "<br><h3>Test the verification:</h3>";
    echo "Now you can test the admin recovery flow:<br>";
    echo "1. Go to <a href='admin-recovery.html' target='_blank'>admin-recovery.html</a><br>";
    echo "2. Enter username: admin, email: admin@pearlvista.com<br>";
    echo "3. Click 'Send Recovery Email'<br>";
    echo "4. Use the code from the new tab: $correct_code<br>";
    echo "5. Enter the code in the verification page<br>";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "<br>";
}
?> 