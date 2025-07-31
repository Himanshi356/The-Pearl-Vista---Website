<?php
// Test new user signup to check what data gets stored
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Test New User Signup Process</h2>";

try {
    require_once 'Config/database.php';
    $pdo = getDatabaseConnection();
    echo "✅ Database connection successful<br><br>";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "<br>";
    exit;
}

if (isset($_POST['test_signup'])) {
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
                
                // Check if user_details record was created
                $stmt = $pdo->prepare("SELECT * FROM user_details WHERE user_id = ?");
                $stmt->execute([$user_id]);
                $user_detail = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user_detail) {
                    echo "<br><strong style='color: red;'>⚠️ User details record was created automatically!</strong><br>";
                    echo "This might be causing the pre-filled data issue.<br>";
                    echo "User details data: " . json_encode($user_detail) . "<br>";
                } else {
                    echo "<br><strong style='color: green;'>✅ No user_details record created (correct behavior)</strong><br>";
                }
                
                // Test the profile data retrieval
                echo "<br><h3>Testing Profile Data Retrieval:</h3>";
                $stmt = $pdo->prepare("SELECT u.id, u.username, u.email, u.role, u.verified, u.created_at, 
                                      ud.full_name, ud.phone, ud.address, ud.emergency_contact, ud.date_of_birth, ud.gender, ud.nationality
                                      FROM users u 
                                      LEFT JOIN user_details ud ON u.id = ud.user_id 
                                      WHERE u.email = ?");
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($user) {
                    echo "Profile data for new user:<br>";
                    echo "- Full Name: " . ($user['full_name'] ?: 'NULL') . "<br>";
                    echo "- Phone: " . ($user['phone'] ?: 'NULL') . "<br>";
                    echo "- Address: " . ($user['address'] ?: 'NULL') . "<br>";
                    echo "- Emergency Contact: " . ($user['emergency_contact'] ?: 'NULL') . "<br>";
                    echo "- Date of Birth: " . ($user['date_of_birth'] ?: 'NULL') . "<br>";
                    echo "- Gender: " . ($user['gender'] ?: 'NULL') . "<br>";
                    echo "- Nationality: " . ($user['nationality'] ?: 'NULL') . "<br>";
                }
                
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
    <h3>Test New User Signup</h3>
    <p>User ID (6 digits): <input type="number" name="user_id" value="999999" required></p>
    <p>Username: <input type="text" name="username" value="testuser999" required></p>
    <p>Email: <input type="email" name="email" value="test999@example.com" required></p>
    <p>Security Question: 
        <select name="security_question" required>
            <option value="In what city were you born?">In what city were you born?</option>
            <option value="What is the name of your first pet?">What is the name of your first pet?</option>
            <option value="What is the name of your elementary school?">What is the name of your elementary school?</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What was your first car?">What was your first car?</option>
        </select>
    </p>
    <p>Security Answer: <input type="text" name="security_answer" value="testcity" required></p>
    <input type="submit" name="test_signup" value="Test Signup">
</form>

<hr>
<h3>Check Existing Users:</h3>
<?php
try {
    $stmt = $pdo->query("SELECT u.username, u.email, u.security_question, ud.full_name, ud.phone, ud.address 
                         FROM users u 
                         LEFT JOIN user_details ud ON u.id = ud.user_id 
                         ORDER BY u.created_at DESC 
                         LIMIT 5");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($users as $user) {
        echo "<strong>" . htmlspecialchars($user['username']) . "</strong> (" . htmlspecialchars($user['email']) . ")<br>";
        echo "- Security Q: '" . htmlspecialchars($user['security_question']) . "'<br>";
        echo "- Full Name: " . ($user['full_name'] ?: 'NULL') . "<br>";
        echo "- Phone: " . ($user['phone'] ?: 'NULL') . "<br>";
        echo "- Address: " . ($user['address'] ?: 'NULL') . "<br><br>";
    }
} catch (Exception $e) {
    echo "❌ Error checking users: " . $e->getMessage() . "<br>";
}
?>

<p><a href="signup.html">Go to Signup Page</a> | <a href="user-info.html">Go to Profile Page</a></p> 