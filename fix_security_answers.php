<?php
// Script to fix security answers with whitespace issues
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Fix Security Answers - Remove Whitespace Issues</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Check for users with whitespace issues
echo "<h3>1. Check for Users with Whitespace Issues</h3>";
try {
    $stmt = $pdo->query("SELECT user_id, username, email, security_question, security_answer FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $usersWithIssues = [];
    foreach ($users as $user) {
        $original = $user['security_answer'];
        $trimmed = trim($original);
        
        if ($original !== $trimmed) {
            $usersWithIssues[] = $user;
            echo "⚠️ User '{$user['username']}' has whitespace issues:<br>";
            echo "  Original: '" . $original . "'<br>";
            echo "  Trimmed: '" . $trimmed . "'<br>";
            echo "  Length difference: " . (strlen($original) - strlen($trimmed)) . "<br><br>";
        }
    }
    
    if (empty($usersWithIssues)) {
        echo "✅ No users found with whitespace issues<br>";
    } else {
        echo "Found " . count($usersWithIssues) . " users with whitespace issues<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking users: " . $e->getMessage() . "<br>";
}

// Fix users with whitespace issues
echo "<h3>2. Fix Users with Whitespace Issues</h3>";
if (isset($_POST['fix_users'])) {
    try {
        $stmt = $pdo->query("SELECT user_id, username, email, security_question, security_answer FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $fixedCount = 0;
        foreach ($users as $user) {
            $original = $user['security_answer'];
            $trimmed = trim($original);
            
            if ($original !== $trimmed) {
                // Update the user's security answer
                $updateStmt = $pdo->prepare("UPDATE users SET security_answer = ? WHERE user_id = ?");
                $result = $updateStmt->execute([$trimmed, $user['user_id']]);
                
                if ($result) {
                    echo "✅ Fixed user '{$user['username']}': '" . $original . "' → '" . $trimmed . "'<br>";
                    $fixedCount++;
                } else {
                    echo "❌ Failed to fix user '{$user['username']}'<br>";
                }
            }
        }
        
        echo "<br>✅ Fixed $fixedCount users with whitespace issues<br>";
    } catch (Exception $e) {
        echo "❌ Error fixing users: " . $e->getMessage() . "<br>";
    }
}

// Show all users for verification
echo "<h3>3. All Users (After Fix)</h3>";
try {
    $stmt = $pdo->query("SELECT username, email, security_question, security_answer FROM users LIMIT 20");
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
    <h3>Fix Security Answers</h3>
    <p>This will trim whitespace from all security answers in the database.</p>
    <input type="submit" name="fix_users" value="Fix Security Answers" onclick="return confirm('Are you sure you want to fix all security answers?')">
</form> 