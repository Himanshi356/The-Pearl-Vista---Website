<?php
// Create a test user with email user@example.com for profile testing
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Create Test User for Profile Testing</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

// Check if user already exists
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute(['user@example.com']);

if ($stmt->rowCount() > 0) {
    echo "✅ User with email 'user@example.com' already exists!<br>";
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "User ID: " . $user['user_id'] . "<br>";
    echo "Username: " . $user['username'] . "<br>";
    echo "Email: " . $user['email'] . "<br>";
} else {
    try {
        // Create test user
        $user_id = 123456;
        $username = 'user';
        $email = 'user@example.com';
        $security_question = 'What is your favorite color?';
        $security_answer = 'blue';
        $verification_code = rand(100000, 999999);
        
        $stmt = $pdo->prepare("INSERT INTO users (user_id, username, email, security_question, security_answer, verification_code, role) VALUES (?, ?, ?, ?, ?, ?, 'user')");
        $result = $stmt->execute([$user_id, $username, $email, $security_question, $security_answer, $verification_code]);
        
        if ($result) {
            echo "✅ Test user created successfully!<br>";
            echo "User ID: " . $user_id . "<br>";
            echo "Username: " . $username . "<br>";
            echo "Email: " . $email . "<br>";
            echo "<br><strong>You can now test the profile functionality!</strong><br>";
        } else {
            echo "❌ Failed to create test user<br>";
        }
    } catch (Exception $e) {
        echo "❌ Error creating test user: " . $e->getMessage() . "<br>";
    }
}

echo "<br><a href='user-info.html'>Go to User Profile Page</a>";
?> 