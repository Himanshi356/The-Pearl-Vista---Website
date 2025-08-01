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
  <title>Admin Profile | The Pearl Vista</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
      font-family: 'Lato', Arial, sans-serif;
      margin: 0;
      color: #101a2b;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }
    
    .profile-container {
      max-width: 480px;
      width: 100%;
      background: #fff;
      color: #101a2b;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.1);
      padding: 3rem 2.5rem 2.5rem 2.5rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      overflow: hidden;
    }
    
    .profile-container::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #FFD700, #FFA500);
    }
    
    .avatar {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: linear-gradient(135deg, #FFD700, #FFA500);
      color: #101a2b;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2.5rem;
      font-weight: 900;
      margin-bottom: 2rem;
      box-shadow: 0 8px 25px rgba(255, 215, 0, 0.3);
      position: relative;
    }
    
    .avatar::after {
      content: '';
      position: absolute;
      top: -2px;
      left: -2px;
      right: -2px;
      bottom: -2px;
      border-radius: 50%;
      background: linear-gradient(135deg, #FFD700, #FFA500);
      z-index: -1;
      opacity: 0.3;
    }
    
    .profile-header {
      text-align: center;
      margin-bottom: 2.5rem;
    }
    
    .profile-name {
      font-size: 1.8rem;
      font-weight: 700;
      color: #101a2b;
      margin-bottom: 0.5rem;
    }
    
    .profile-role {
      font-size: 1rem;
      color: #666;
      font-weight: 500;
    }
    
    .profile-info {
      width: 100%;
      margin-bottom: 2.5rem;
    }
    
    .info-item {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      border-bottom: 1px solid #e2e8f0;
    }
    
    .info-item:last-child {
      border-bottom: none;
    }
    
    .info-label {
      font-weight: 600;
      color: #4a5568;
    }
    
    .info-value {
      color: #2d3748;
      font-weight: 500;
    }
    
    .action-buttons {
      display: flex;
      gap: 1rem;
      width: 100%;
    }
    
    .btn {
      flex: 1;
      padding: 0.75rem 1.5rem;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 0.9rem;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
      text-align: center;
    }
    
    .btn-primary {
      background: linear-gradient(135deg, #FFD700, #FFA500);
      color: #101a2b;
    }
    
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
    }
    
    .btn-secondary {
      background: #f7fafc;
      color: #4a5568;
      border: 2px solid #e2e8f0;
    }
    
    .btn-secondary:hover {
      background: #edf2f7;
      border-color: #cbd5e0;
    }
    
    .back-link {
      position: absolute;
      top: 2rem;
      left: 2rem;
      color: #4a5568;
      text-decoration: none;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      transition: color 0.3s ease;
    }
    
    .back-link:hover {
      color: #2d3748;
    }
  </style>
</head>
<body>

  
  <div class="profile-container">
    <div class="avatar">
      <i class="fas fa-user"></i>
    </div>
    
    <div class="profile-header">
      <div class="profile-name">System Administrator</div>
    </div>
    
    <div class="profile-info">
      <div class="info-item">
        <span class="info-label">Admin ID:</span>
        <span class="info-value">ADM001</span>
      </div>
      <div class="info-item">
        <span class="info-label">Email:</span>
        <span class="info-value">admin@pearlvista.com</span>
      </div>
      <div class="info-item">
        <span class="info-label">Role:</span>
        <span class="info-value">System Administrator</span>
      </div>
      <div class="info-item">
        <span class="info-label">Department:</span>
        <span class="info-value">Management</span>
      </div>
      <div class="info-item">
        <span class="info-label">Last Login:</span>
        <span class="info-value">2025-07-31 06:33:21</span>
      </div>
    </div>
    
    <div class="action-buttons">
      <a href="admin-settings.php" class="btn btn-primary">
        <i class="fas fa-cog"></i>
        Settings
      </a>
      <a href="admin-dashboard.php" class="btn btn-secondary">
        <i class="fas fa-tachometer-alt"></i>
        Dashboard
      </a>
    </div>
  </div>
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</body>
</html> 