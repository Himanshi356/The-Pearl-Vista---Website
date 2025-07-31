<?php
// login.php
ini_set('display_errors', 0);
ini_set('log_errors', 1);
error_reporting(E_ALL);

// Clean any output before starting
ob_clean();
session_start();
header('Content-Type: application/json');

try {
    require_once '../Config/database.php';
    $pdo = getDatabaseConnection();

    // Read raw JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    $username = trim($input['username'] ?? '');
    $password = $input['password'] ?? '';

    // Log the login attempt
    error_log("Login attempt for username: $username");

    if (empty($username) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Username and password are required.']);
        exit;
    }

    // First, check if it's an admin login in admins table
    $stmt = $pdo->prepare("SELECT admin_id, admin_code, username, email, password, first_name, last_name, department, position, role, is_active FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin && $admin['is_active'] && password_verify($password, $admin['password'])) {
        // Admin login successful from admins table
        $_SESSION['user'] = $admin['admin_id'];
        $_SESSION['role'] = 'admin';
        $_SESSION['admin_code'] = $admin['admin_code'];
        $_SESSION['admin_name'] = $admin['first_name'] . ' ' . $admin['last_name'];
        
        // Update admin login stats
        $updateStmt = $pdo->prepare("UPDATE admins SET last_login = NOW(), login_count = login_count + 1 WHERE admin_id = ?");
        $updateStmt->execute([$admin['admin_id']]);
        
        // Log admin activity
        $logStmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $logStmt->execute([
            $admin['admin_id'],
            'LOGIN',
            'Admin login successful',
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        error_log("Admin login successful for: $username");
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Admin login successful.', 
            'user' => [
                'id' => $admin['admin_id'],
                'admin_code' => $admin['admin_code'],
                'username' => $admin['username'],
                'email' => $admin['email'],
                'first_name' => $admin['first_name'],
                'last_name' => $admin['last_name'],
                'full_name' => $admin['first_name'] . ' ' . $admin['last_name'],
                'department' => $admin['department'],
                'position' => $admin['position'],
                'role' => $admin['role']
            ]
        ]);
        exit;
    }
    
    // If not found in admins table, check admin_users table
    $stmt = $pdo->prepare("SELECT admin_id, admin_code, username, email, password, first_name, last_name, department, position, role, is_active, status FROM admin_users WHERE username = ?");
    $stmt->execute([$username]);
    $adminUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($adminUser && $adminUser['is_active'] && $adminUser['status'] === 'active' && password_verify($password, $adminUser['password'])) {
        // Admin login successful from admin_users table
        $_SESSION['user'] = $adminUser['admin_id'];
        $_SESSION['role'] = 'admin';
        $_SESSION['admin_code'] = $adminUser['admin_code'];
        $_SESSION['admin_name'] = $adminUser['first_name'] . ' ' . $adminUser['last_name'];
        
        // Update admin login stats
        $updateStmt = $pdo->prepare("UPDATE admin_users SET last_login = NOW(), login_count = login_count + 1 WHERE admin_id = ?");
        $updateStmt->execute([$adminUser['admin_id']]);
        
        // Log admin activity
        $logStmt = $pdo->prepare("INSERT INTO admin_activity_log (admin_id, action, description, ip_address, user_agent) VALUES (?, ?, ?, ?, ?)");
        $logStmt->execute([
            $adminUser['admin_id'],
            'LOGIN',
            'Admin login successful',
            $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ]);
        
        error_log("Admin login successful for: $username");
        
        echo json_encode([
            'status' => 'success', 
            'message' => 'Admin login successful.', 
            'user' => [
                'id' => $adminUser['admin_id'],
                'admin_code' => $adminUser['admin_code'],
                'username' => $adminUser['username'],
                'email' => $adminUser['email'],
                'first_name' => $adminUser['first_name'],
                'last_name' => $adminUser['last_name'],
                'full_name' => $adminUser['first_name'] . ' ' . $adminUser['last_name'],
                'department' => $adminUser['department'],
                'position' => $adminUser['position'],
                'role' => $adminUser['role']
            ]
        ]);
        exit;
    }
    
    // If not admin, check if it's a regular user
    $stmt = $pdo->prepare("SELECT id, user_id, username, email, password, role, verified FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($user) {
        // Check if user has set a password
        if ($user['password'] === null) {
            // User exists but hasn't set password yet
            echo json_encode(['status' => 'error', 'message' => 'Please set your password first. Complete your account setup by setting a password.']);
            exit;
        }
        
        // Verify password
        if (password_verify($password, $user['password'])) {
            // User login successful
            $_SESSION['user'] = $user['user_id'];
            $_SESSION['role'] = $user['role'] ?? 'user';
            
            error_log("User login successful for: $username");
            
            echo json_encode([
                'status' => 'success', 
                'message' => 'Login successful.', 
                'user' => [
                    'id' => $user['id'],
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'] ?? 'user'
                ]
            ]);
        } else {
            error_log("Login failed for username: $username - Invalid password");
            echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
        }
    } else {
        error_log("Login failed for username: $username - User not found");
        echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
    }
    
} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Login failed: ' . $e->getMessage()]);
} catch (Error $e) {
    error_log("Fatal login error: " . $e->getMessage());
    echo json_encode(['status' => 'error', 'message' => 'Fatal error occurred during login.']);
}
?>