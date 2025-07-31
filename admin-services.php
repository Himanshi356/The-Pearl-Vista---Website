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
  <title>Admin Services | The Pearl Vista</title>
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

    /* Services specific styles */
    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .service-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-color: #d4af37;
    }

    .service-image {
      width: 100%;
      height: 200px;
      background: linear-gradient(135deg, #d4af37, #b8941f);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: 3rem;
    }

    .service-info {
      padding: 1.5rem;
    }

    .service-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .service-price {
      font-size: 1.5rem;
      font-weight: 700;
      color: #d4af37;
      margin-bottom: 1rem;
    }

    .service-description {
      color: #666;
      margin-bottom: 1rem;
      line-height: 1.5;
    }

    .service-status {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1rem;
    }

    .status-badge {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .status-available {
      background: #d4edda;
      color: #155724;
    }

    .status-unavailable {
      background: #f8d7da;
      color: #721c24;
    }

    .action-buttons {
      display: flex;
      gap: 0.5rem;
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

    .btn-edit {
      background: #d4af37;
      color: #000;
    }

    .btn-edit:hover {
      background: #b8941f;
    }

    .btn-delete {
      background: #dc3545;
      color: #fff;
    }

    .btn-delete:hover {
      background: #c82333;
    }

    .add-service-section {
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      margin-bottom: 2rem;
    }

    .add-service-form {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-group label {
      font-weight: 500;
      color: #333;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
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

    .btn-primary {
      background: #d4af37;
      color: #000;
      padding: 1rem 2rem;
      border: none;
      border-radius: 8px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
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
                <a href="admin-services.php" class="active">
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
          <i class="fas fa-concierge-bell"></i>
          Service Management
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
          <h3>Total Services</h3>
          <div class="change"></div>
        </div>
        <div class="stat-card">
          <div class="number">0</div>
          <h3>Active Services</h3>
          <div class="change"></div>
        </div>
        <div class="stat-card">
          <div class="number">$0</div>
          <h3>Service Revenue</h3>
          <div class="change"></div>
        </div>
        <div class="stat-card">
          <div class="number">0.0</div>
          <h3>Avg. Rating</h3>
          <div class="change"></div>
        </div>
      </div>

      <div class="add-service-section">
        <h3 style="margin-bottom: 1.5rem; color: #333;">
          <i class="fas fa-plus" style="color: #d4af37;"></i>
          Add New Service
        </h3>
        <form class="add-service-form">
          <div class="form-group">
            <label>Service Name</label>
            <input type="text" name="service_name" placeholder="e.g., Spa Treatment" required>
          </div>
          <div class="form-group">
            <label>Category</label>
            <select name="category" required>
              <option value="">Select Category</option>
              <option value="spa">Spa & Wellness</option>
              <option value="dining">Dining</option>
              <option value="transport">Transportation</option>
              <option value="leisure">Leisure & Activities</option>
              <option value="events">Events & Meetings</option>
              <option value="concierge">Concierge Services</option>
              <option value="kids">Kids & Family</option>
              <option value="packages">Packages & Experiences</option>
              <option value="pet-services">Pet Services</option>
              <option value="wellness">Wellness Programs</option>
            </select>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="number" name="price" placeholder="e.g., 150" required>
          </div>
          <div class="form-group">
            <label>Duration</label>
            <input type="text" name="duration" placeholder="e.g., 2 hours">
          </div>
          <div class="form-group">
            <label>Status</label>
            <select name="status" required>
              <option value="confirmed">Available</option>
              <option value="pending">Unavailable</option>
            </select>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea name="description" placeholder="Service description..." rows="3"></textarea>
          </div>
          <div class="form-group" style="grid-column: 1 / -1;">
            <button type="submit" class="btn-primary">
              <i class="fas fa-plus"></i>
              Add Service
            </button>
          </div>
        </form>
      </div>

      <div class="services-grid">
        <!-- Services will be loaded dynamically from the database -->
        <div class="loading-services" style="text-align: center; padding: 2rem; color: #666;">
          <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #d4af37;"></i>
          <p style="margin-top: 1rem;">Loading services...</p>
        </div>
      </div>

      <!-- Service Bookings Section -->
      <div class="service-bookings-section" style="margin-top: 3rem;">
        <h3 style="margin-bottom: 1.5rem; color: #333; display: flex; align-items: center; gap: 0.5rem;">
          <i class="fas fa-calendar-check" style="color: #d4af37;"></i>
          Customer Service Bookings
        </h3>
        
        <div class="bookings-filters" style="margin-bottom: 1.5rem; display: flex; gap: 1rem; flex-wrap: wrap;">
          <select id="statusFilter" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="">All Status</option>
            <option value="pending">Pending</option>
            <option value="confirmed">Confirmed</option>
            <option value="cancelled">Cancelled</option>
            <option value="completed">Completed</option>
          </select>
          <select id="categoryFilter" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
            <option value="">All Categories</option>
            <option value="spa">Spa & Wellness</option>
            <option value="dining">Dining</option>
            <option value="transport">Transportation</option>
            <option value="leisure">Leisure</option>
            <option value="events">Events</option>
            <option value="concierge">Concierge</option>
            <option value="kids">Kids & Family</option>
            <option value="packages">Packages</option>
            <option value="pet-services">Pet Services</option>
          </select>
          <input type="date" id="dateFilter" style="padding: 0.5rem; border: 1px solid #ddd; border-radius: 5px;">
          <button onclick="loadServiceBookings()" style="padding: 0.5rem 1rem; background: #d4af37; color: white; border: none; border-radius: 5px; cursor: pointer;">
            <i class="fas fa-search"></i> Filter
          </button>
        </div>

        <div class="bookings-table-container" style="background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); overflow: hidden;">
          <div class="bookings-table-header" style="background: #f8f9fa; padding: 1rem; border-bottom: 1px solid #dee2e6; display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr; gap: 1rem; font-weight: 600; color: #333;">
            <div>Customer</div>
            <div>Service</div>
            <div>Category</div>
            <div>Date & Time</div>
            <div>Amount</div>
            <div>Status</div>
            <div>Actions</div>
          </div>
          <div id="bookingsTableBody" style="max-height: 400px; overflow-y: auto;">
            <div style="text-align: center; padding: 2rem; color: #666;">
              <i class="fas fa-spinner fa-spin" style="font-size: 1.5rem; color: #d4af37;"></i>
              <p style="margin-top: 0.5rem;">Loading bookings...</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script src="admin-data-loader.js"></script>
  <script src="admin-services.js"></script>
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