<?php
// Create a test user for account recovery debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Create Test User for Account Recovery</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

if (isset($_POST['create_user'])) {
    $user_id = $_POST['user_id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    
    try {
        // Check if user already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE user_id = ? OR username = ?");
        $stmt->execute([$user_id, $username]);
        
        if ($stmt->rowCount() > 0) {
            echo "❌ User already exists with this User ID or username<br>";
        } else {
            // Create test user
            $verification_code = rand(100000, 999999);
            $stmt = $pdo->prepare("INSERT INTO users (user_id, username, email, security_question, security_answer, verification_code, role) VALUES (?, ?, ?, ?, ?, ?, 'user')");
            $result = $stmt->execute([$user_id, $username, $email, $security_question, $security_answer, $verification_code]);
            
            if ($result) {
                echo "✅ Test user created successfully!<br>";
                echo "User ID: " . $user_id . "<br>";
                echo "Username: " . $username . "<br>";
                echo "Email: " . $email . "<br>";
                echo "Security Question: " . $security_question . "<br>";
                echo "Security Answer: " . $security_answer . "<br>";
                echo "<br><strong>You can now test account recovery with these credentials!</strong><br>";
            } else {
                echo "❌ Failed to create test user<br>";
            }
        }
    } catch (Exception $e) {
        echo "❌ Error creating test user: " . $e->getMessage() . "<br>";
    }
}
?>

<form method="POST">
    <h3>Create Test User</h3>
    <p>User ID (6 digits): <input type="number" name="user_id" value="123456" required></p>
    <p>Username: <input type="text" name="username" value="testuser" required></p>
    <p>Email: <input type="email" name="email" value="test@example.com" required></p>
    <p>Security Question: 
        <select name="security_question" required>
            <option value="What is your favorite color?">What is your favorite color?</option>
            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
            <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
            <option value="In what city were you born?">In what city were you born?</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What was your first car?">What was your first car?</option>
        </select>
    </p>
    <p>Security Answer: <input type="text" name="security_answer" value="blue" required></p>
    <input type="submit" name="create_user" value="Create Test User">
</form>

<hr>
<h3>Test Account Recovery</h3>
<p>After creating a test user, you can test the account recovery at: <a href="account-recovery.html" target="_blank">account-recovery.html</a></p>
<p>Or use the debug test at: <a href="test_account_recovery.php" target="_blank">test_account_recovery.php</a></p> 