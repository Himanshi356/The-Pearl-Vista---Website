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
  <title>Admin Tour Bookings | The Pearl Vista</title>
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

    /* Tour Bookings specific styles */
    .tour-bookings-filters {
      background: #fff;
      padding: 1.5rem;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      margin-bottom: 2rem;
    }

    .filters-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
    }

    .filter-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .filter-group label {
      font-weight: 500;
      color: #333;
      font-size: 0.9rem;
    }

    .filter-group select,
    .filter-group input {
      padding: 0.8rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: all 0.3s ease;
    }

    .filter-group select:focus,
    .filter-group input:focus {
      outline: none;
      border-color: #d4af37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .tour-bookings-table {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      overflow: hidden;
    }

    .table-header {
      background: #f8f9fa;
      padding: 1.5rem;
      border-bottom: 1px solid #e0e0e0;
    }

    .table-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .table-title i {
      color: #d4af37;
    }

    .tour-bookings-grid {
      display: grid;
      gap: 1rem;
      padding: 1.5rem;
    }

    .tour-booking-card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 1.5rem;
      transition: all 0.3s ease;
    }

    .tour-booking-card:hover {
      border-color: #d4af37;
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.1);
    }

    .tour-booking-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #f1f3f4;
    }

    .tour-booking-id {
      font-weight: 600;
      color: #333;
      font-size: 1.1rem;
    }

    .tour-booking-status {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .status-confirmed {
      background: #d4edda;
      color: #155724;
    }

    .status-pending {
      background: #fff3cd;
      color: #856404;
    }

    .status-cancelled {
      background: #f8d7da;
      color: #721c24;
    }

    .status-completed {
      background: #d1ecf1;
      color: #0c5460;
    }

    .tour-booking-details {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-bottom: 1rem;
    }

    .detail-group {
      display: flex;
      flex-direction: column;
      gap: 0.3rem;
    }

    .detail-label {
      font-size: 0.8rem;
      color: #666;
      font-weight: 500;
    }

    .detail-value {
      font-weight: 600;
      color: #333;
    }

    .tour-booking-actions {
      display: flex;
      gap: 0.5rem;
      justify-content: flex-end;
    }

    .btn {
      padding: 0.5rem 1rem;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      font-size: 0.8rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .btn-approve {
      background: #28a745;
      color: #fff;
    }

    .btn-approve:hover {
      background: #218838;
    }

    .btn-reject {
      background: #dc3545;
      color: #fff;
    }

    .btn-reject:hover {
      background: #c82333;
    }

    .btn-view {
      background: #d4af37;
      color: #000;
    }

    .btn-view:hover {
      background: #b8941f;
    }

    .btn-edit {
      background: #17a2b8;
      color: #fff;
    }

    .btn-edit:hover {
      background: #138496;
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
                <a href="admin-tour-bookings.php" class="active">
                    <i class="fas fa-map-marked-alt"></i>
                    Tour Bookings
                </a>
                <a href="admin-chat.php">
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
          <i class="fas fa-map-marked-alt"></i>
          Tour Booking Management
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
          <h3>Total Tour Bookings</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Confirmed</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Pending</h3>
          <div class="change">Loading...</div>
        </div>
        <div class="stat-card">
          <div class="number">$0</div>
          <h3>Tour Revenue</h3>
          <div class="change">Loading...</div>
        </div>
      </div>

      <div class="tour-bookings-filters">
        <h3 style="margin-bottom: 1rem; color: #333;">
          <i class="fas fa-filter" style="color: #d4af37;"></i>
          Filter Tour Bookings
        </h3>
        <div class="filters-grid">
          <div class="filter-group">
            <label>Status</label>
            <select id="statusFilter">
              <option value="">All Status</option>
              <option value="confirmed">Confirmed</option>
              <option value="pending">Pending</option>
              <option value="cancelled">Cancelled</option>
            </select>
          </div>
          <div class="filter-group">
            <label>Tour Type</label>
            <select id="tourTypeFilter">
              <option value="">All Types</option>
              <option value="Luxury Sedan">Luxury Sedan</option>
              <option value="SUV">SUV</option>
              <option value="Minivan">Minivan</option>
              <option value="Limousine">Limousine</option>
              <option value="Coach Bus">Coach Bus</option>
            </select>
          </div>
          <div class="filter-group">
            <label>Date Range</label>
            <input type="date" id="dateFilter">
          </div>
          <div class="filter-group">
            <label>Guest Name</label>
            <input type="text" id="guestNameFilter" placeholder="Search by name">
          </div>
        </div>
      </div>

      <div class="tour-bookings-table">
        <div class="table-header">
          <div class="table-title">
            <i class="fas fa-list"></i>
            Recent Tour Bookings
          </div>
        </div>
        <div class="tour-bookings-grid" id="tourBookingsTableBody">
          <div style="text-align: center; padding: 2rem; color: #666;">
            <i class="fas fa-spinner fa-spin" style="font-size: 1.5rem; color: #d4af37;"></i>
            <p style="margin-top: 0.5rem;">Loading tour bookings...</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script src="admin-data-loader.js"></script>
  <script src="admin-tour-bookings.js"></script>
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