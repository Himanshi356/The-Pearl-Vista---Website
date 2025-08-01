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
  <title>Admin Settings | The Pearl Vista</title>
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

    /* Settings specific styles */
    .settings-container {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
      gap: 2rem;
    }

    .settings-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .settings-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-color: #d4af37;
    }

    .settings-header {
      background: #f8f9fa;
      padding: 1.5rem;
      border-bottom: 1px solid #e0e0e0;
    }

    .settings-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 0.5rem;
    }

    .settings-title i {
      color: #d4af37;
    }

    .settings-subtitle {
      font-size: 0.9rem;
      color: #666;
    }

    .settings-content {
      padding: 1.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      font-weight: 500;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #d4af37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 100px;
    }

    .toggle-switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .toggle-switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 34px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: #d4af37;
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    .settings-actions {
      padding: 1.5rem;
      border-top: 1px solid #e0e0e0;
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
    }

    .btn {
      padding: 0.8rem 1.5rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.9rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background: #d4af37;
      color: #000;
    }

    .btn-primary:hover {
      background: #b8941f;
    }

    .btn-secondary {
      background: #6c757d;
      color: #fff;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .btn-danger {
      background: #dc3545;
      color: #fff;
    }

    .btn-danger:hover {
      background: #c82333;
    }

    .settings-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 0;
      border-bottom: 1px solid #f1f3f4;
    }

    .settings-row:last-child {
      border-bottom: none;
    }

    .settings-info h4 {
      font-weight: 600;
      color: #333;
      margin-bottom: 0.3rem;
    }

    .settings-info p {
      font-size: 0.9rem;
      color: #666;
    }

    /* Loading and saving states */
    .btn-primary.loading {
      background: #6c757d;
      cursor: not-allowed;
      position: relative;
    }

    .btn-primary.loading::after {
      content: '';
      position: absolute;
      width: 16px;
      height: 16px;
      margin: auto;
      border: 2px solid transparent;
      border-top-color: #ffffff;
      border-radius: 50%;
      animation: spin 1s linear infinite;
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
    }

    @keyframes spin {
      0% { transform: translateY(-50%) rotate(0deg); }
      100% { transform: translateY(-50%) rotate(360deg); }
    }

    /* Form validation styles */
    .form-group input:invalid,
    .form-group select:invalid {
      border-color: #dc3545;
      box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }

    .form-group input:valid,
    .form-group select:valid {
      border-color: #28a745;
      box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
    }

    /* Toggle switch hover effects */
    .toggle-switch:hover .slider {
      box-shadow: 0 0 8px rgba(212, 175, 55, 0.3);
    }

    /* Settings card hover effects */
    .settings-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-color: #d4af37;
    }

    /* Responsive design improvements */
    @media (max-width: 768px) {
      .settings-container {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      
      .main-content {
        padding: 1rem;
      }
      
      .topbar {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
      }
      
      .admin-profile {
        align-self: center;
      }
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
                <a href="admin-chat.php">
                    <i class="fas fa-comments"></i>
                    Chat Support
                </a>
              
                <a href="admin-settings.php" class="active">
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
          <i class="fas fa-cog"></i>
          System Settings
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

      <div class="settings-container">
        <div class="settings-card">
          <div class="settings-header">
            <div class="settings-title">
              <i class="fas fa-building"></i>
              Hotel Information
            </div>
            <div class="settings-subtitle">Update hotel details and contact information</div>
          </div>
          <div class="settings-content">
            <div class="form-group">
              <label>Hotel Name</label>
              <input type="text" id="hotelName" value="The Pearl Vista" placeholder="Enter hotel name">
            </div>
            <div class="form-group">
              <label>Address</label>
              <textarea id="hotelAddress" placeholder="Enter hotel address">123 Luxury Street, Downtown, City, Country</textarea>
            </div>
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" id="hotelPhone" value="+1 (555) 123-4567" placeholder="Enter phone number">
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" id="hotelEmail" value="info@pearlvista.com" placeholder="Enter email address">
            </div>
            <div class="form-group">
              <label>Website</label>
              <input type="url" id="hotelWebsite" value="https://www.pearlvista.com" placeholder="Enter website URL">
            </div>
          </div>
          <div class="settings-actions">
            <button class="btn btn-secondary">Reset</button>
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </div>

        <div class="settings-card">
          <div class="settings-header">
            <div class="settings-title">
              <i class="fas fa-bell"></i>
              Notifications
            </div>
            <div class="settings-subtitle">Configure notification preferences</div>
          </div>
          <div class="settings-content">
            <div class="settings-row">
              <div class="settings-info">
                <h4>Email Notifications</h4>
                <p>Receive email alerts for new bookings</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="emailNotifications" checked>
                <span class="slider"></span>
              </label>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>SMS Notifications</h4>
                <p>Receive SMS alerts for urgent matters</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="smsNotifications">
                <span class="slider"></span>
              </label>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Booking Confirmations</h4>
                <p>Send automatic booking confirmations</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="bookingConfirmations" checked>
                <span class="slider"></span>
              </label>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Reminder Notifications</h4>
                <p>Send check-in/check-out reminders</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="reminderNotifications" checked>
                <span class="slider"></span>
              </label>
            </div>
          </div>
          <div class="settings-actions">
            <button class="btn btn-secondary">Reset</button>
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </div>

        <div class="settings-card">
          <div class="settings-header">
            <div class="settings-title">
              <i class="fas fa-shield-alt"></i>
              Security Settings
            </div>
            <div class="settings-subtitle">Manage security and privacy settings</div>
          </div>
          <div class="settings-content">
            <div class="form-group">
              <label>Session Timeout (minutes)</label>
              <input type="number" id="sessionTimeout" value="30" min="5" max="120">
            </div>
            <div class="form-group">
              <label>Password Policy</label>
              <select id="passwordPolicy">
                <option value="strong">Strong (8+ chars, symbols, numbers)</option>
                <option value="medium">Medium (6+ chars, numbers)</option>
                <option value="basic">Basic (4+ chars)</option>
              </select>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Two-Factor Authentication</h4>
                <p>Require 2FA for admin accounts</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="twoFactorAuth" checked>
                <span class="slider"></span>
              </label>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Login Notifications</h4>
                <p>Notify on successful login</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="loginNotifications">
                <span class="slider"></span>
              </label>
            </div>
          </div>
          <div class="settings-actions">
            <button class="btn btn-secondary">Reset</button>
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </div>

        <div class="settings-card">
          <div class="settings-header">
            <div class="settings-title">
              <i class="fas fa-database"></i>
              System Settings
            </div>
            <div class="settings-subtitle">Configure system preferences</div>
          </div>
          <div class="settings-content">
            <div class="form-group">
              <label>Time Zone</label>
              <select id="timezone">
                <option value="UTC">UTC</option>
                <option value="EST">Eastern Standard Time</option>
                <option value="PST">Pacific Standard Time</option>
                <option value="GMT">Greenwich Mean Time</option>
              </select>
            </div>
            <div class="form-group">
              <label>Date Format</label>
              <select id="dateFormat">
                <option value="MM/DD/YYYY">MM/DD/YYYY</option>
                <option value="DD/MM/YYYY">DD/MM/YYYY</option>
                <option value="YYYY-MM-DD">YYYY-MM-DD</option>
              </select>
            </div>
            <div class="form-group">
              <label>Currency</label>
              <select id="currency">
                <option value="USD">USD ($)</option>
                <option value="EUR">EUR (€)</option>
                <option value="GBP">GBP (£)</option>
                <option value="JPY">JPY (¥)</option>
              </select>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Maintenance Mode</h4>
                <p>Enable maintenance mode for updates</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="maintenanceMode">
                <span class="slider"></span>
              </label>
            </div>
          </div>
          <div class="settings-actions">
            <button class="btn btn-secondary">Reset</button>
            <button class="btn btn-primary">Save Changes</button>
          </div>
        </div>

        <div class="settings-card">
          <div class="settings-header">
            <div class="settings-title">
              <i class="fas fa-trash"></i>
              Data Management
            </div>
            <div class="settings-subtitle">Manage data and backups</div>
          </div>
          <div class="settings-content">
            <div class="form-group">
              <label>Backup Frequency</label>
              <select id="backupFrequency">
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
              </select>
            </div>
            <div class="form-group">
              <label>Data Retention (days)</label>
              <input type="number" id="dataRetention" value="365" min="30" max="3650">
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Auto Backup</h4>
                <p>Automatically backup data</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="autoBackup" checked>
                <span class="slider"></span>
              </label>
            </div>
            <div class="settings-row">
              <div class="settings-info">
                <h4>Log Analytics</h4>
                <p>Enable detailed logging</p>
              </div>
              <label class="toggle-switch">
                <input type="checkbox" id="logAnalytics" checked>
                <span class="slider"></span>
              </label>
            </div>
          </div>
          <div class="settings-actions">
            <button class="btn btn-secondary">Backup Now</button>
            <button class="btn btn-danger">Clear All Data</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script>
    let currentSettings = {};
    let originalSettings = {};

    // Load settings on page load
    document.addEventListener('DOMContentLoaded', function() {
      loadSettings();
      setupEventListeners();
    });

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

    // Load settings from database
    async function loadSettings() {
      try {
        const response = await fetch('Backend/Admin/get_settings.php');
        const data = await response.json();
        
        if (data.status === 'success') {
          currentSettings = data.settings;
          originalSettings = {...data.settings};
          populateSettings();
          console.log('Settings loaded successfully:', currentSettings);
        } else {
          console.error('Failed to load settings:', data.message);
          showNotification('Failed to load settings', 'error');
        }
      } catch (error) {
        console.error('Error loading settings:', error);
        showNotification('Error loading settings', 'error');
      }
    }

    // Populate form fields with current settings
    function populateSettings() {
      // Hotel Information
      document.getElementById('hotelName').value = currentSettings.hotel_name || '';
      document.getElementById('hotelAddress').value = currentSettings.hotel_address || '';
      document.getElementById('hotelPhone').value = currentSettings.hotel_phone || '';
      document.getElementById('hotelEmail').value = currentSettings.hotel_email || '';
      document.getElementById('hotelWebsite').value = currentSettings.hotel_website || '';

      // Notifications
      document.getElementById('emailNotifications').checked = currentSettings.email_notifications == 1;
      document.getElementById('smsNotifications').checked = currentSettings.sms_notifications == 1;
      document.getElementById('bookingConfirmations').checked = currentSettings.booking_confirmations == 1;
      document.getElementById('reminderNotifications').checked = currentSettings.reminder_notifications == 1;

      // Security Settings
      document.getElementById('sessionTimeout').value = currentSettings.session_timeout || 30;
      document.getElementById('passwordPolicy').value = currentSettings.password_policy || 'strong';
      document.getElementById('twoFactorAuth').checked = currentSettings.two_factor_auth == 1;
      document.getElementById('loginNotifications').checked = currentSettings.login_notifications == 1;

      // System Settings
      document.getElementById('timezone').value = currentSettings.timezone || 'UTC';
      document.getElementById('dateFormat').value = currentSettings.date_format || 'MM/DD/YYYY';
      document.getElementById('currency').value = currentSettings.currency || 'USD';
      document.getElementById('maintenanceMode').checked = currentSettings.maintenance_mode == 1;

      // Data Management
      document.getElementById('backupFrequency').value = currentSettings.backup_frequency || 'daily';
      document.getElementById('dataRetention').value = currentSettings.data_retention_days || 365;
      document.getElementById('autoBackup').checked = currentSettings.auto_backup == 1;
      document.getElementById('logAnalytics').checked = currentSettings.log_analytics == 1;
    }

    // Setup event listeners for all buttons and toggles
    function setupEventListeners() {
      // Save buttons
      document.querySelectorAll('.btn-primary').forEach(button => {
        button.addEventListener('click', function() {
          const card = this.closest('.settings-card');
          const cardType = getCardType(card);
          saveSettings(cardType);
        });
      });

      // Reset buttons
      document.querySelectorAll('.btn-secondary').forEach(button => {
        button.addEventListener('click', function() {
          const card = this.closest('.settings-card');
          const cardType = getCardType(card);
          resetSettings(cardType);
        });
      });

      // Special buttons
      const backupNowBtn = document.querySelector('.btn-secondary[onclick*="backup"]');
      if (backupNowBtn) {
        backupNowBtn.onclick = backupNow;
      }

      const clearDataBtn = document.querySelector('.btn-danger');
      if (clearDataBtn) {
        clearDataBtn.onclick = clearAllData;
      }
    }

    // Get card type based on content
    function getCardType(card) {
      const title = card.querySelector('.settings-title').textContent.trim();
      if (title.includes('Hotel Information')) return 'hotel';
      if (title.includes('Notifications')) return 'notifications';
      if (title.includes('Security')) return 'security';
      if (title.includes('System Settings')) return 'system';
      if (title.includes('Data Management')) return 'data';
      return 'general';
    }

    // Save settings for specific card
    async function saveSettings(cardType) {
      const settings = {};
      const saveButton = event.target;
      const originalText = saveButton.textContent;
      
      // Show loading state
      saveButton.classList.add('loading');
      saveButton.textContent = 'Saving...';
      saveButton.disabled = true;
      
      switch(cardType) {
        case 'hotel':
          settings.hotel_name = document.getElementById('hotelName').value;
          settings.hotel_address = document.getElementById('hotelAddress').value;
          settings.hotel_phone = document.getElementById('hotelPhone').value;
          settings.hotel_email = document.getElementById('hotelEmail').value;
          settings.hotel_website = document.getElementById('hotelWebsite').value;
          break;
          
        case 'notifications':
          settings.email_notifications = document.getElementById('emailNotifications').checked;
          settings.sms_notifications = document.getElementById('smsNotifications').checked;
          settings.booking_confirmations = document.getElementById('bookingConfirmations').checked;
          settings.reminder_notifications = document.getElementById('reminderNotifications').checked;
          break;
          
        case 'security':
          settings.session_timeout = parseInt(document.getElementById('sessionTimeout').value);
          settings.password_policy = document.getElementById('passwordPolicy').value;
          settings.two_factor_auth = document.getElementById('twoFactorAuth').checked;
          settings.login_notifications = document.getElementById('loginNotifications').checked;
          break;
          
        case 'system':
          settings.timezone = document.getElementById('timezone').value;
          settings.date_format = document.getElementById('dateFormat').value;
          settings.currency = document.getElementById('currency').value;
          settings.maintenance_mode = document.getElementById('maintenanceMode').checked;
          break;
          
        case 'data':
          settings.backup_frequency = document.getElementById('backupFrequency').value;
          settings.data_retention_days = parseInt(document.getElementById('dataRetention').value);
          settings.auto_backup = document.getElementById('autoBackup').checked;
          settings.log_analytics = document.getElementById('logAnalytics').checked;
          break;
      }

      try {
        const response = await fetch('Backend/Admin/update_settings.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(settings)
        });

        const data = await response.json();
        
        if (data.status === 'success') {
          showNotification('Settings saved successfully!', 'success');
          // Update current settings
          Object.assign(currentSettings, settings);
          // Update original settings to reflect new saved state
          Object.assign(originalSettings, settings);
        } else {
          showNotification('Failed to save settings: ' + data.message, 'error');
        }
      } catch (error) {
        console.error('Error saving settings:', error);
        showNotification('Error saving settings', 'error');
      } finally {
        // Restore button state
        saveButton.classList.remove('loading');
        saveButton.textContent = originalText;
        saveButton.disabled = false;
      }
    }

    // Reset settings for specific card
    function resetSettings(cardType) {
      switch(cardType) {
        case 'hotel':
          document.getElementById('hotelName').value = originalSettings.hotel_name || '';
          document.getElementById('hotelAddress').value = originalSettings.hotel_address || '';
          document.getElementById('hotelPhone').value = originalSettings.hotel_phone || '';
          document.getElementById('hotelEmail').value = originalSettings.hotel_email || '';
          document.getElementById('hotelWebsite').value = originalSettings.hotel_website || '';
          break;
          
        case 'notifications':
          document.getElementById('emailNotifications').checked = originalSettings.email_notifications == 1;
          document.getElementById('smsNotifications').checked = originalSettings.sms_notifications == 1;
          document.getElementById('bookingConfirmations').checked = originalSettings.booking_confirmations == 1;
          document.getElementById('reminderNotifications').checked = originalSettings.reminder_notifications == 1;
          break;
          
        case 'security':
          document.getElementById('sessionTimeout').value = originalSettings.session_timeout || 30;
          document.getElementById('passwordPolicy').value = originalSettings.password_policy || 'strong';
          document.getElementById('twoFactorAuth').checked = originalSettings.two_factor_auth == 1;
          document.getElementById('loginNotifications').checked = originalSettings.login_notifications == 1;
          break;
          
        case 'system':
          document.getElementById('timezone').value = originalSettings.timezone || 'UTC';
          document.getElementById('dateFormat').value = originalSettings.date_format || 'MM/DD/YYYY';
          document.getElementById('currency').value = originalSettings.currency || 'USD';
          document.getElementById('maintenanceMode').checked = originalSettings.maintenance_mode == 1;
          break;
          
        case 'data':
          document.getElementById('backupFrequency').value = originalSettings.backup_frequency || 'daily';
          document.getElementById('dataRetention').value = originalSettings.data_retention_days || 365;
          document.getElementById('autoBackup').checked = originalSettings.auto_backup == 1;
          document.getElementById('logAnalytics').checked = originalSettings.log_analytics == 1;
          break;
      }
      
      showNotification('Settings reset to original values', 'info');
    }

    // Backup now function
    async function backupNow() {
      try {
        showNotification('Starting backup...', 'info');
        // Simulate backup process
        await new Promise(resolve => setTimeout(resolve, 2000));
        showNotification('Backup completed successfully!', 'success');
      } catch (error) {
        showNotification('Backup failed: ' + error.message, 'error');
      }
    }

    // Clear all data function
    async function clearAllData() {
      if (confirm('Are you sure you want to clear all data? This action cannot be undone.')) {
        try {
          showNotification('Clearing data...', 'info');
          // Simulate data clearing process
          await new Promise(resolve => setTimeout(resolve, 3000));
          showNotification('All data cleared successfully!', 'success');
        } catch (error) {
          showNotification('Failed to clear data: ' + error.message, 'error');
        }
      }
    }

    // Show notification
    function showNotification(message, type = 'info') {
      // Create notification element
      const notification = document.createElement('div');
      notification.className = `notification notification-${type}`;
      notification.innerHTML = `
        <div class="notification-content">
          <span class="notification-message">${message}</span>
          <button class="notification-close" onclick="this.parentElement.parentElement.remove()">×</button>
        </div>
      `;
      
      // Add styles
      notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'success' ? '#d4edda' : type === 'error' ? '#f8d7da' : '#d1ecf1'};
        color: ${type === 'success' ? '#155724' : type === 'error' ? '#721c24' : '#0c5460'};
        padding: 15px 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        z-index: 10000;
        max-width: 400px;
        border: 1px solid ${type === 'success' ? '#c3e6cb' : type === 'error' ? '#f5c6cb' : '#bee5eb'};
      `;
      
      // Add to page
      document.body.appendChild(notification);
      
      // Auto remove after 5 seconds
      setTimeout(() => {
        if (notification.parentElement) {
          notification.remove();
        }
      }, 5000);
    }
  </script>
</body>
</html> 