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
    <title>Dropdown Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .admin-profile {
            position: relative;
            display: inline-block;
            cursor: pointer;
            padding: 10px;
            background: #f0f0f0;
            border-radius: 5px;
        }
        .admin-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 1rem;
            display: none;
            min-width: 200px;
            z-index: 1000;
        }
        .admin-dropdown a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.75rem 1rem;
            color: #333;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        .admin-dropdown a:hover {
            background: #f8f9fa;
            color: #d4af37;
        }
        .test-info {
            background: #e8f4fd;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="test-info">
        <h3>Dropdown Test</h3>
        <p>Click on the "System Administrator" text below to test the dropdown functionality.</p>
        <p>If the dropdown appears, the functionality is working. If not, there's an issue.</p>
    </div>

    <div class="admin-profile" onclick="toggleDropdown()">
        <div class="admin-info">
            <div class="admin-name" id="adminName">System Administrator</div>
            <div class="admin-role" id="adminRole">Administrator</div>
        </div>
        <i class="fas fa-chevron-down"></i>
    </div>
    <div class="admin-dropdown" id="adminDropdown">
        <a href="admin-profile.php">
            <i class="fas fa-user"></i>
            Profile
        </a>
        <a href="admin-settings.php">
            <i class="fas fa-cog"></i>
            Settings
        </a>
        <a href="Backend/Admin/admin_logout.php">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
    </div>

    <script>
        function toggleDropdown() {
            console.log('toggleDropdown() called');
            const dropdown = document.getElementById('adminDropdown');
            const currentDisplay = dropdown.style.display;
            console.log('Current display:', currentDisplay);
            
            if (currentDisplay === 'block') {
                dropdown.style.display = 'none';
                console.log('Dropdown hidden');
            } else {
                dropdown.style.display = 'block';
                console.log('Dropdown shown');
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const profile = document.querySelector('.admin-profile');
            const dropdown = document.getElementById('adminDropdown');
            if (!profile.contains(event.target)) {
                dropdown.style.display = 'none';
                console.log('Dropdown closed (clicked outside)');
            }
        });

        console.log('Test page loaded');
        console.log('toggleDropdown function available:', typeof toggleDropdown);
    </script>
</body>
</html> 