<?php
// Fix existing users with short security questions
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Fix Existing Security Questions</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Mapping of short questions to full questions
$questionMapping = [
    'city' => 'In what city were you born?',
    'pet' => 'What is the name of your first pet?',
    'school' => 'What is the name of your elementary school?',
    'mother' => 'What is your mother\'s maiden name?',
    'car' => 'What was your first car?'
];

if (isset($_POST['fix_questions'])) {
    try {
        // Get all users with short security questions
        $stmt = $pdo->prepare("SELECT user_id, username, security_question FROM users WHERE security_question IN (?, ?, ?, ?, ?)");
        $stmt->execute(array_keys($questionMapping));
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $fixedCount = 0;
        
        foreach ($users as $user) {
            $shortQuestion = $user['security_question'];
            $fullQuestion = $questionMapping[$shortQuestion];
            
            if ($fullQuestion) {
                // Update the user's security question
                $updateStmt = $pdo->prepare("UPDATE users SET security_question = ? WHERE user_id = ?");
                $result = $updateStmt->execute([$fullQuestion, $user['user_id']]);
                
                if ($result) {
                    echo "✅ Fixed user <strong>" . htmlspecialchars($user['username']) . "</strong>: ";
                    echo "'" . htmlspecialchars($shortQuestion) . "' → '" . htmlspecialchars($fullQuestion) . "'<br>";
                    $fixedCount++;
                }
            }
        }
        
        echo "<br><strong>✅ Fixed $fixedCount users with short security questions!</strong><br>";
        
    } catch (Exception $e) {
        echo "❌ Error fixing security questions: " . $e->getMessage() . "<br>";
    }
}

// Show current status
echo "<h3>Current Security Questions Status:</h3>";
try {
    $stmt = $pdo->query("SELECT username, security_question FROM users ORDER BY username");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        $question = $user['security_question'];
        $isShort = in_array($question, array_keys($questionMapping));
        $status = $isShort ? "❌ SHORT" : "✅ FULL";
        
        echo "<strong>" . htmlspecialchars($user['username']) . "</strong>: ";
        echo "'" . htmlspecialchars($question) . "' <span style='color: " . ($isShort ? 'red' : 'green') . ";'>$status</span><br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking current status: " . $e->getMessage() . "<br>";
}
?>

<form method="POST">
    <h3>Fix Security Questions</h3>
    <p>This will update users with short security questions (like "city") to full questions (like "In what city were you born?").</p>
    <input type="submit" name="fix_questions" value="Fix Security Questions" onclick="return confirm('Are you sure you want to update all short security questions?')">
</form>

<hr>
<h3>What this fixes:</h3>
<ul>
    <li><strong>city</strong> → <strong>In what city were you born?</strong></li>
    <li><strong>pet</strong> → <strong>What is the name of your first pet?</strong></li>
    <li><strong>school</strong> → <strong>What is the name of your elementary school?</strong></li>
    <li><strong>mother</strong> → <strong>What is your mother's maiden name?</strong></li>
    <li><strong>car</strong> → <strong>What was your first car?</strong></li>
</ul>

<p><a href="signup.html">Go to Signup Page</a> | <a href="unified-login.html">Go to Login Page</a></p> 