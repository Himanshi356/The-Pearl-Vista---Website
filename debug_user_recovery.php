<?php
// Debug script for user "Riya@5" account recovery issue
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Debug User Recovery - Riya@5</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Check if user "Riya@5" exists
echo "<h3>1. Check User 'Riya@5' in Database</h3>";
try {
    $stmt = $pdo->prepare("SELECT user_id, username, email, security_question, security_answer FROM users WHERE username = ?");
    $stmt->execute(['Riya@5']);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        echo "✅ User 'Riya@5' found in database<br>";
        echo "User ID: " . $user['user_id'] . "<br>";
        echo "Username: " . $user['username'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Security Question: '" . $user['security_question'] . "'<br>";
        echo "Security Answer: '" . $user['security_answer'] . "'<br>";
        echo "Security Answer Length: " . strlen($user['security_answer']) . "<br>";
        echo "Security Answer (trimmed): '" . trim($user['security_answer']) . "'<br>";
        echo "Security Answer (lowercase): '" . strtolower(trim($user['security_answer'])) . "'<br>";
    } else {
        echo "❌ User 'Riya@5' not found in database<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking user: " . $e->getMessage() . "<br>";
}

// Test the forgot_password.php logic for Riya@5
echo "<h3>2. Test forgot_password.php for Riya@5</h3>";
if (isset($_POST['test_riya'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];
    
    echo "Testing with:<br>";
    echo "Username: '$username'<br>";
    echo "Email: '$email'<br>";
    echo "Security Question: '$security_question'<br>";
    echo "Security Answer: '$security_answer'<br><br>";
    
    // Simulate the exact logic from forgot_password.php
    try {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT user_id, username, email, security_question, security_answer FROM users WHERE username = ? AND email = ?");
        $stmt->execute([$username, $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$user) {
            echo "❌ No user found with username '$username' and email '$email'<br>";
        } else {
            echo "✅ User found in database<br>";
            echo "Stored Security Question: '" . $user['security_question'] . "'<br>";
            echo "Stored Security Answer: '" . $user['security_answer'] . "'<br>";
            
            // Check security question and answer
            $stored_question = $user['security_question'];
            $stored_answer = strtolower(trim($user['security_answer']));
            $provided_answer = strtolower(trim($security_answer));
            
            echo "Comparison:<br>";
            echo "- Stored Q: '$stored_question'<br>";
            echo "- Provided Q: '$security_question'<br>";
            echo "- Stored A: '$stored_answer'<br>";
            echo "- Provided A: '$provided_answer'<br>";
            echo "- Question Match: " . ($stored_question === $security_question ? 'YES' : 'NO') . "<br>";
            echo "- Answer Match: " . ($stored_answer === $provided_answer ? 'YES' : 'NO') . "<br>";
            
            if ($stored_question !== $security_question) {
                echo "❌ Security question mismatch<br>";
            } else {
                echo "✅ Security question matches<br>";
            }
            
            if ($stored_answer !== $provided_answer) {
                echo "❌ Security answer mismatch<br>";
            } else {
                echo "✅ Security answer matches<br>";
            }
        }
    } catch (Exception $e) {
        echo "❌ Error during test: " . $e->getMessage() . "<br>";
    }
}

// Check all users for comparison
echo "<h3>3. Check All Users</h3>";
try {
    $stmt = $pdo->query("SELECT username, email, security_question, security_answer FROM users LIMIT 10");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h4>All Users:</h4>";
    foreach ($users as $user) {
        echo "Username: " . $user['username'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Security Q: '" . $user['security_question'] . "'<br>";
        echo "Security A: '" . $user['security_answer'] . "'<br>";
        echo "---<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking all users: " . $e->getMessage() . "<br>";
}
?>

<form method="POST">
    <h3>Test Riya@5 Recovery</h3>
    <p>Username: <input type="text" name="username" value="Riya@5" required></p>
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
    <input type="submit" name="test_riya" value="Test Riya@5 Recovery">
</form> 