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
  <title>Admin Chat | The Pearl Vista</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
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
      color: #333;
    }

    .admin-dashboard {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      background: #1a1a1a;
      color: #fff;
      width: 280px;
      padding: 2rem 1.5rem 1rem 1.5rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
      min-height: 100vh;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.1);
      border-right: 1px solid #e0e0e0;
    }

    .sidebar .logo {
      font-size: 1.5rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 2rem;
      color: #d4af37;
      text-align: center;
      padding: 1rem;
      background: #222;
      border-radius: 12px;
      border: 1px solid #333;
    }

    .sidebar nav {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .sidebar nav a {
      color: #fff;
      text-decoration: none;
      padding: 1rem 1.2rem;
      border-radius: 12px;
      font-weight: 500;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 0.95rem;
      border: 1px solid transparent;
    }

    .sidebar nav a i {
      width: 20px;
      text-align: center;
      font-size: 1.1rem;
      color: #d4af37;
    }

    .sidebar nav a.active, 
    .sidebar nav a:hover {
      background: #d4af37;
      color: #000;
      border-color: #d4af37;
      transform: translateX(5px);
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .sidebar nav a.active i,
    .sidebar nav a:hover i {
      color: #000;
    }

    .main-content {
      flex: 1;
      padding: 2rem 3rem;
      display: flex;
      flex-direction: column;
      gap: 2rem;
      background: #fff;
      min-height: 100vh;
    }

    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 2rem;
      padding: 1.5rem;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
    }

    .page-title {
      font-size: 2rem;
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .page-title i {
      color: #d4af37;
    }

    .admin-profile {
      display: flex;
      align-items: center;
      gap: 1rem;
      cursor: pointer;
      position: relative;
      color: #333;
      padding: 0.8rem 1.2rem;
      border-radius: 12px;
      transition: all 0.3s ease;
      border: 1px solid #e0e0e0;
    }

    .admin-profile:hover {
      background: #f8f9fa;
      border-color: #d4af37;
    }

    .admin-profile .avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      background: #d4af37;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #000;
      font-size: 1.2rem;
      box-shadow: 0 3px 10px rgba(212, 175, 55, 0.3);
    }

    .admin-info {
      display: flex;
      flex-direction: column;
    }

    .admin-name {
      font-weight: 600;
      color: #333;
      font-size: 0.95rem;
    }

    .admin-role {
      font-size: 0.8rem;
      color: #d4af37;
      font-weight: 500;
    }

    #adminDropdown {
      display: none;
      position: absolute;
      top: 60px;
      right: 0;
      background: #fff;
      color: #333;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
      min-width: 200px;
      padding: 1rem;
      font-size: 0.9rem;
      z-index: 1000;
      border: 1px solid #e0e0e0;
    }

    .dropdown-item {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 10px;
      border: 1px solid transparent;
    }

    .dropdown-item:hover {
      background: #f8f9fa;
      color: #d4af37;
      border-color: #d4af37;
    }

    .dropdown-item i {
      width: 16px;
      text-align: center;
      color: #d4af37;
    }

    /* Chat specific styles */
    .chat-container {
      display: flex;
      gap: 2rem;
      height: calc(100vh - 200px);
    }

    .chat-sidebar {
      width: 300px;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      overflow: hidden;
    }

    .chat-header {
      background: #f8f9fa;
      padding: 1.5rem;
      border-bottom: 1px solid #e0e0e0;
    }

    .chat-header h3 {
      font-size: 1.2rem;
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .chat-header h3 i {
      color: #d4af37;
    }

    .chat-users {
      padding: 1rem;
      max-height: calc(100vh - 300px);
      overflow-y: auto;
    }

    .chat-user {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 1px solid transparent;
    }

    .chat-user:hover {
      background: #f8f9fa;
      border-color: #d4af37;
    }

    .chat-user.active {
      background: #d4af37;
      color: #000;
    }

    .chat-user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #d4af37;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #000;
      font-size: 1rem;
    }

    .chat-user-info {
      flex: 1;
    }

    .chat-user-name {
      font-weight: 600;
      font-size: 0.9rem;
    }

    .chat-user-status {
      font-size: 0.8rem;
      color: #666;
    }

    .chat-user-status.online {
      color: #28a745;
    }

    .chat-user-status.offline {
      color: #dc3545;
    }

    .chat-main {
      flex: 1;
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      display: flex;
      flex-direction: column;
    }

    .chat-main-header {
      background: #f8f9fa;
      padding: 1.5rem;
      border-bottom: 1px solid #e0e0e0;
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .chat-main-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #d4af37;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #000;
      font-size: 1rem;
    }

    .chat-main-info h4 {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.2rem;
    }

    .chat-main-info p {
      font-size: 0.8rem;
      color: #666;
    }

    .chat-messages {
      flex: 1;
      padding: 1.5rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .message {
      display: flex;
      gap: 1rem;
      align-items: flex-start;
    }

    .message.sent {
      flex-direction: row-reverse;
    }

    .message-avatar {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      background: #d4af37;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #000;
      font-size: 0.9rem;
    }

    .message-content {
      max-width: 70%;
      padding: 1rem;
      border-radius: 12px;
      position: relative;
    }

    .message.received .message-content {
      background: #f8f9fa;
      color: #333;
    }

    .message.sent .message-content {
      background: #d4af37;
      color: #000;
    }

    .message-time {
      font-size: 0.7rem;
      color: #666;
      margin-top: 0.5rem;
    }

    .message.sent .message-time {
      text-align: right;
    }

    .chat-input {
      padding: 1.5rem;
      border-top: 1px solid #e0e0e0;
      display: flex;
      gap: 1rem;
      align-items: center;
    }

    .chat-input input {
      flex: 1;
      padding: 1rem;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .chat-input input:focus {
      outline: none;
      border-color: #d4af37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .chat-input button {
      padding: 1rem 1.5rem;
      background: #d4af37;
      color: #000;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .chat-input button:hover {
      background: #b8941f;
      transform: translateY(-2px);
    }

    .stats-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .stat-card {
      background: #fff;
      padding: 1.5rem;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.3s ease;
      border: 1px solid #e0e0e0;
      border-left: 4px solid #d4af37;
    }

    .stat-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-color: #d4af37;
    }

    .stat-card h3 {
      color: #333;
      font-size: 1.1rem;
      font-weight: 600;
      margin-bottom: 0.5rem;
    }

    .stat-card .number {
      font-size: 2.5rem;
      font-weight: 700;
      color: #d4af37;
      margin-bottom: 0.5rem;
    }

    .stat-card .change {
      font-size: 0.9rem;
      color: #28a745;
      font-weight: 500;
    }

    .stat-card .change.negative {
      color: #dc3545;
    }
  </style>
</head>
<body>
  <div class="admin-dashboard">
        <div class="sidebar">
            <div class="logo">The Pearl Vista</div>
            <nav>
                <a href="admin-dashboard.php">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
                <a href="admin-rooms.php">
                    <i class="fas fa-bed"></i>
                    Rooms
                </a>
                <a href="admin-bookings.php">
                    <i class="fas fa-calendar-check"></i>
                    Bookings
                </a>
                <a href="admin-customers.php">
                    <i class="fas fa-users"></i>
                    Customers
                </a>
                <a href="admin-services.php">
                    <i class="fas fa-concierge-bell"></i>
                    Services
                </a>
                <a href="admin-tour-bookings.php">
                    <i class="fas fa-map-marked-alt"></i>
                    Tour Bookings
                </a>
                <a href="admin-chat.php" class="active">
                    <i class="fas fa-comments"></i>
                    Chat Support
                </a>
               
                <a href="admin-settings.php">
                    <i class="fas fa-cog"></i>
                    Settings
                </a>
                <a href="admin-profile.php">
                    <i class="fas fa-user"></i>
                    Profile
                </a>
                <a href="admin-add-user.php">
                    <i class="fas fa-user-plus"></i>
                    Add User
                </a>
            </nav>
        </div>

    <div class="main-content">
      <div class="topbar">
        <div class="page-title">
          <i class="fas fa-comments"></i>
          Chat Support
        </div>
        <div class="admin-profile" onclick="toggleDropdown()">
          <div class="avatar">A</div>
          <div class="admin-info">
            <div class="admin-name">Admin User</div>
            <div class="admin-role">Administrator</div>
          </div>
          <div id="adminDropdown">
            <div class="dropdown-item" onclick="window.location.href='admin-profile.php'">
              <i class="fas fa-user"></i>
              Profile
            </div>
            <div class="dropdown-item" onclick="window.location.href='admin-settings.php'">
              <i class="fas fa-cog"></i>
              Settings
            </div>
            <div class="dropdown-item" onclick="window.location.href='admin-add-user.php'">
              <i class="fas fa-user-plus"></i>
              Add User
            </div>
            <div class="dropdown-item" onclick="window.location.href='Backend/Admin/admin_logout.php'">
              <i class="fas fa-sign-out-alt"></i>
              Logout
            </div>
          </div>
        </div>
      </div>

      <div class="stats-cards">
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Active Chats</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Total Messages</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Avg. Response Time</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">0%</div>
          <h3>Satisfaction Rate</h3>
          <div class="change">Loading...</div>
        </div>
      </div>

      <div class="chat-container">
        <div class="chat-sidebar">
          <div class="chat-header">
            <h3><i class="fas fa-users"></i> Active Users</h3>
          </div>
          <div class="chat-users" id="chatUsersContainer">
            <div style="text-align: center; padding: 2rem; color: #666;">
              <i class="fas fa-spinner fa-spin" style="font-size: 1.5rem; color: #d4af37;"></i>
              <p style="margin-top: 0.5rem;">Loading active users...</p>
            </div>
          </div>
        </div>

        <div class="chat-main">
          <div class="chat-main-header">
            <div class="chat-main-avatar">J</div>
            <div class="chat-main-info">
              <h4>John Doe</h4>
              <p>Online</p>
            </div>
          </div>
          <div class="chat-messages" id="chatMessagesContainer">
            <div style="text-align: center; padding: 2rem; color: #666;">
              <i class="fas fa-comments" style="font-size: 1.5rem; color: #d4af37;"></i>
              <p style="margin-top: 0.5rem;">Select a user to start chatting</p>
            </div>
          </div>
          <div class="chat-input">
            <input type="text" placeholder="Type your message...">
            <button><i class="fas fa-paper-plane"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script src="admin-chat.js"></script>
  <script>
    function toggleDropdown() {
      const dropdown = document.getElementById('adminDropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
      const profile = document.querySelector('.admin-profile');
      const dropdown = document.getElementById('adminDropdown');
      if (!profile.contains(event.target)) {
        dropdown.style.display = 'none';
      }
    });
  </script>
</body>
</html> 