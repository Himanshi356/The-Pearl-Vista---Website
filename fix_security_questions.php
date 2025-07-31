<?php
// Script to fix security questions to match the form options
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Fix Security Questions - Update to Full Question Text</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Define the mapping from short to full questions
$questionMapping = [
    'city' => 'In what city were you born?',
    'color' => 'What is your favorite color?',
    'pet' => 'What is the name of your first pet?',
    'school' => 'What is the name of your elementary school?',
    'maiden' => 'What is your mother\'s maiden name?',
    'car' => 'What was your first car?'
];

// Check current security questions
echo "<h3>1. Current Security Questions in Database</h3>";
try {
    $stmt = $pdo->query("SELECT username, security_question FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h4>Current Questions:</h4>";
    foreach ($users as $user) {
        echo "User: " . $user['username'] . " - Question: '" . $user['security_question'] . "'<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking users: " . $e->getMessage() . "<br>";
}

// Fix security questions
echo "<h3>2. Fix Security Questions</h3>";
if (isset($_POST['fix_questions'])) {
    try {
        $stmt = $pdo->query("SELECT user_id, username, security_question FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        $fixedCount = 0;
        foreach ($users as $user) {
            $currentQuestion = $user['security_question'];
            $newQuestion = null;
            
            // Check if we need to update this question
            foreach ($questionMapping as $short => $full) {
                if ($currentQuestion === $short) {
                    $newQuestion = $full;
                    break;
                }
            }
            
            if ($newQuestion) {
                // Update the user's security question
                $updateStmt = $pdo->prepare("UPDATE users SET security_question = ? WHERE user_id = ?");
                $result = $updateStmt->execute([$newQuestion, $user['user_id']]);
                
                if ($result) {
                    echo "✅ Fixed user '{$user['username']}': '$currentQuestion' → '$newQuestion'<br>";
                    $fixedCount++;
                } else {
                    echo "❌ Failed to fix user '{$user['username']}'<br>";
                }
            } else {
                echo "ℹ️ User '{$user['username']}' already has full question: '$currentQuestion'<br>";
            }
        }
        
        echo "<br>✅ Fixed $fixedCount users with short security questions<br>";
    } catch (Exception $e) {
        echo "❌ Error fixing users: " . $e->getMessage() . "<br>";
    }
}

// Show updated users
echo "<h3>3. Updated Users</h3>";
try {
    $stmt = $pdo->query("SELECT username, security_question FROM users LIMIT 20");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h4>Updated Questions:</h4>";
    foreach ($users as $user) {
        echo "User: " . $user['username'] . " - Question: '" . $user['security_question'] . "'<br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking updated users: " . $e->getMessage() . "<br>";
}
?>

<form method="POST">
    <h3>Fix Security Questions</h3>
    <p>This will update short security questions (like "city") to full questions (like "In what city were you born?").</p>
    <input type="submit" name="fix_questions" value="Fix Security Questions" onclick="return confirm('Are you sure you want to update all security questions?')">
</form> 