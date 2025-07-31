<?php
// Comprehensive test for account recovery flow
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Complete Account Recovery Flow Test</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Test 1: Check if users table exists and has data
echo "<h3>1. Database Check</h3>";
try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM users");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✅ Users table exists. Total users: " . $result['count'] . "<br>";
    
    if ($result['count'] > 0) {
        $stmt = $pdo->query("SELECT user_id, username, email, security_question, security_answer FROM users LIMIT 3");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<h4>Sample Users:</h4>";
        foreach ($users as $user) {
            echo "Username: " . $user['username'] . ", Email: " . $user['email'] . "<br>";
        }
    } else {
        echo "⚠️ No users found in database<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking users table: " . $e->getMessage() . "<br>";
}

// Test 2: Test forgot_password.php endpoint
echo "<h3>2. Test forgot_password.php Endpoint</h3>";
if (isset($_POST['test_forgot_password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    
    echo "Testing forgot_password.php with:<br>";
    echo "Username: $username<br>";
    echo "Email: $email<br>";
    echo "Security Question: $security_question<br>";
    echo "Security Answer: $security_answer<br><br>";
    
    // Simulate the POST request to forgot_password.php
    $postData = json_encode([
        'username' => $username,
        'email' => $email,
        'security_question' => $security_question,
        'security_answer' => $security_answer
    ]);
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $postData
        ]
    ]);
    
    $url = 'http://localhost/Pearl-Vista---Website/Auth/forgot_password.php';
    $response = file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "❌ Failed to connect to forgot_password.php<br>";
    } else {
        echo "✅ Response from forgot_password.php:<br>";
        echo "<pre>" . htmlspecialchars($response) . "</pre><br>";
        
        $data = json_decode($response, true);
        if ($data && $data['status'] === 'success') {
            echo "✅ forgot_password.php returned success!<br>";
        } else {
            echo "❌ forgot_password.php returned error: " . ($data['message'] ?? 'Unknown error') . "<br>";
        }
    }
}

// Test 3: Test send_recovery_code.php endpoint
echo "<h3>3. Test send_recovery_code.php Endpoint</h3>";
if (isset($_POST['test_send_code'])) {
    $email = $_POST['test_email'];
    
    echo "Testing send_recovery_code.php with email: $email<br><br>";
    
    $postData = json_encode(['email' => $email]);
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $postData
        ]
    ]);
    
    $url = 'http://localhost/Pearl-Vista---Website/Auth/send_recovery_code.php';
    $response = file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "❌ Failed to connect to send_recovery_code.php<br>";
    } else {
        echo "✅ Response from send_recovery_code.php:<br>";
        echo "<pre>" . htmlspecialchars($response) . "</pre><br>";
        
        $data = json_decode($response, true);
        if ($data && $data['status'] === 'success') {
            echo "✅ send_recovery_code.php returned success!<br>";
        } else {
            echo "❌ send_recovery_code.php returned error: " . ($data['message'] ?? 'Unknown error') . "<br>";
        }
    }
}

// Test 4: Test verify_code.php endpoint
echo "<h3>4. Test verify_code.php Endpoint</h3>";
if (isset($_POST['test_verify_code'])) {
    $email = $_POST['verify_email'];
    $code = $_POST['verify_code'];
    
    echo "Testing verify_code.php with email: $email, code: $code<br><br>";
    
    $postData = json_encode(['email' => $email, 'code' => $code]);
    
    $context = stream_context_create([
        'http' => [
            'method' => 'POST',
            'header' => 'Content-Type: application/json',
            'content' => $postData
        ]
    ]);
    
    $url = 'http://localhost/Pearl-Vista---Website/Auth/verify_code.php';
    $response = file_get_contents($url, false, $context);
    
    if ($response === false) {
        echo "❌ Failed to connect to verify_code.php<br>";
    } else {
        echo "✅ Response from verify_code.php:<br>";
        echo "<pre>" . htmlspecialchars($response) . "</pre><br>";
        
        $data = json_decode($response, true);
        if ($data && $data['status'] === 'success') {
            echo "✅ verify_code.php returned success!<br>";
        } else {
            echo "❌ verify_code.php returned error: " . ($data['message'] ?? 'Unknown error') . "<br>";
        }
    }
}
?>

<form method="POST">
    <h3>Test forgot_password.php</h3>
    <p>Username: <input type="text" name="username" required></p>
    <p>Email: <input type="email" name="email" required></p>
    <p>Security Question: 
        <select name="security_question" required>
            <option value="">Select question</option>
            <option value="What is your favorite color?">What is your favorite color?</option>
            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
            <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
            <option value="In what city were you born?">In what city were you born?</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What was your first car?">What was your first car?</option>
        </select>
    </p>
    <p>Security Answer: <input type="text" name="security_answer" required></p>
    <input type="submit" name="test_forgot_password" value="Test forgot_password.php">
</form>

<hr>

<form method="POST">
    <h3>Test send_recovery_code.php</h3>
    <p>Email: <input type="email" name="test_email" required></p>
    <input type="submit" name="test_send_code" value="Test send_recovery_code.php">
</form>

<hr>

<form method="POST">
    <h3>Test verify_code.php</h3>
    <p>Email: <input type="email" name="verify_email" required></p>
    <p>Code: <input type="text" name="verify_code" required></p>
    <input type="submit" name="test_verify_code" value="Test verify_code.php">
</form>

<hr>
<h3>Manual Testing</h3>
<p>You can also test the complete flow manually:</p>
<ol>
    <li><a href="account-recovery.html" target="_blank">Go to account-recovery.html</a></li>
    <li>Fill in the form with valid credentials</li>
    <li>Check the browser console for any errors</li>
    <li>Check the server error logs for any PHP errors</li>
</ol> 