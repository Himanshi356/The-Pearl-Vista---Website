<?php
// Check user status - whether they have set a password
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Check User Status</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

if (isset($_POST['check_user'])) {
    $username = $_POST['username'];
    
    try {
        $stmt = $pdo->prepare("SELECT username, email, password, verified FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            echo "<h3>User Status for: " . htmlspecialchars($username) . "</h3>";
            echo "<strong>Email:</strong> " . htmlspecialchars($user['email']) . "<br>";
            echo "<strong>Verified:</strong> " . ($user['verified'] ? 'Yes' : 'No') . "<br>";
            echo "<strong>Password Set:</strong> " . ($user['password'] ? 'Yes' : 'No') . "<br>";
            
            if (!$user['password']) {
                echo "<br><strong style='color: red;'>⚠️ This user needs to set a password!</strong><br>";
                echo "They should go to: <a href='confirm-password.html?email=" . urlencode($user['email']) . "'>confirm-password.html</a><br>";
            } else {
                echo "<br><strong style='color: green;'>✅ This user can log in normally!</strong><br>";
            }
        } else {
            echo "<strong style='color: red;'>❌ User not found!</strong><br>";
        }
    } catch (Exception $e) {
        echo "❌ Error checking user: " . $e->getMessage() . "<br>";
    }
}
?>

<form method="POST">
    <h3>Check User Status</h3>
    <p>Username: <input type="text" name="username" placeholder="Enter username" required></p>
    <input type="submit" name="check_user" value="Check Status">
</form>

<hr>
<h3>Common Test Users:</h3>
<ul>
    <li><strong>Riya@5</strong> - riyachandna2005@gmail.com</li>
    <li><strong>testuser1</strong> - test@example.com</li>
</ul>

<p><a href="unified-login.html">Go to Login Page</a></p> 