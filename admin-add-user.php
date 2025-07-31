<?php
session_start();
if (!isset($_SESSION['user']) || !isset($_SESSION['role']) || !in_array($_SESSION['role'], ['admin', 'super_admin', 'manager'])) {
    header('Location: unified-login.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin User | The Pearl Vista</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #333;
        }

        .container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 800px;
            position: relative;
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: #d4af37;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #333;
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 300;
        }

        .header p {
            color: #666;
            font-size: 1.1em;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 500;
            font-size: 0.95em;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: #333;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #d4af37;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #999;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .btn {
            background: #d4af37;
            color: #fff;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background: #c19b2e;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.3);
        }

        .btn-secondary {
            background: #6c757d;
            margin-right: 15px;
        }

        .btn-secondary:hover {
            background: #5a6268;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }

        .back-link {
            position: absolute;
            top: 20px;
            left: 20px;
            color: #666;
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.3s ease;
        }

        .back-link:hover {
            color: #333;
        }

        .required {
            color: #dc3545;
        }

        .form-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e9ecef;
        }

        .form-section h3 {
            color: #333;
            margin-bottom: 20px;
            font-size: 1.3em;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
            
            .container {
                padding: 20px;
                margin: 10px;
            }
        }
    </style>
</head>
<body>
    <a href="admin-dashboard.php" class="back-link">
        <i class="fas fa-arrow-left"></i>
        Back to Dashboard
    </a>

    <div class="container">
        <div class="header">
            <h1><i class="fas fa-user-plus"></i> Add Admin User</h1>
            <p>Create a new administrator account for The Pearl Vista</p>
        </div>

        <form id="addAdminForm">
            <div class="form-section">
                <h3><i class="fas fa-user"></i> Basic Information</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name <span class="required">*</span></label>
                        <input type="text" id="firstName" name="firstName" required placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name <span class="required">*</span></label>
                        <input type="text" id="lastName" name="lastName" required placeholder="Enter last name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="Enter email address">
                    </div>
                    <div class="form-group">
                        <label for="username">Username <span class="required">*</span></label>
                        <input type="text" id="username" name="username" required placeholder="Enter username">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3><i class="fas fa-lock"></i> Security</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <input type="password" id="password" name="password" required placeholder="Enter password">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password <span class="required">*</span></label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm password">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3><i class="fas fa-briefcase"></i> Role & Department</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="role">Role <span class="required">*</span></label>
                        <select id="role" name="role" required>
                            <option value="">Select role</option>
                            <option value="admin">Administrator</option>
                            <option value="manager">Manager</option>
                            <option value="super_admin">Super Administrator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="department">Department <span class="required">*</span></label>
                        <select id="department" name="department" required>
                            <option value="">Select department</option>
                            <option value="Management">Management</option>
                            <option value="Operations">Operations</option>
                            <option value="Customer Service">Customer Service</option>
                            <option value="IT">IT</option>
                            <option value="Finance">Finance</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="position">Position</label>
                    <input type="text" id="position" name="position" placeholder="Enter position title">
                </div>
            </div>

            <div class="form-section">
                <h3><i class="fas fa-cog"></i> Additional Settings</h3>
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea id="notes" name="notes" rows="4" placeholder="Any additional notes about this admin user"></textarea>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="window.location.href='admin-dashboard.php'">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn">
                    <i class="fas fa-save"></i> Create Admin User
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('addAdminForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Basic validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            
            if (password !== confirmPassword) {
                alert('Passwords do not match!');
                return;
            }
            
            if (password.length < 6) {
                alert('Password must be at least 6 characters long!');
                return;
            }
            
            // Here you would typically send the form data to your backend
            alert('Admin user creation functionality will be implemented here.');
        });
    </script>
</body>
</html> 