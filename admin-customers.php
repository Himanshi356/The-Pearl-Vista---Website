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
  <title>Admin Customers | The Pearl Vista</title>
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

    /* Customers specific styles */
    .customers-filters {
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

    .clear-filters-btn {
      background: #f8f9fa;
      border: 1px solid #e0e0e0;
      color: #666;
      padding: 0.8rem 1.2rem;
      border-radius: 8px;
      font-size: 0.9rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.3s ease;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-top: 1.5rem;
    }

    .clear-filters-btn:hover {
      background: #e9ecef;
      border-color: #d4af37;
      color: #d4af37;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .clear-filters-btn i {
      font-size: 0.8rem;
    }

    .customers-table {
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

    .customers-grid {
      display: grid;
      gap: 1rem;
      padding: 1.5rem;
    }

    .customer-card {
      background: #fff;
      border: 1px solid #e0e0e0;
      border-radius: 12px;
      padding: 1.5rem;
      transition: all 0.3s ease;
    }

    .customer-card:hover {
      border-color: #d4af37;
      box-shadow: 0 5px 15px rgba(212, 175, 55, 0.1);
    }

    .customer-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      padding-bottom: 1rem;
      border-bottom: 1px solid #f1f3f4;
    }

    .customer-name {
      font-weight: 600;
      color: #333;
      font-size: 1.1rem;
    }

    .customer-status {
      padding: 0.5rem 1rem;
      border-radius: 20px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .status-active {
      background: #d4edda;
      color: #155724;
    }

    .status-inactive {
      background: #f8d7da;
      color: #721c24;
    }

    .status-vip {
      background: #fff3cd;
      color: #856404;
    }

    .status-regular {
      background: #e2e3e5;
      color: #383d41;
    }

    .status-blocked {
      background: #f8d7da;
      color: #721c24;
    }

    .status-non-vip {
      background: #d1ecf1;
      color: #0c5460;
    }

    .customer-details {
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

    .customer-actions {
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

    .btn-delete {
      background: #dc3545;
      color: #fff;
    }

    .btn-delete:hover {
      background: #c82333;
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
      transition: all 0.3s ease;
    }

    .stat-card .change {
      font-size: 0.9rem;
      color: #28a745;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .stat-card .change.negative {
      color: #dc3545;
    }

    /* Modal Styles */
    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
      background-color: #fff;
      margin: 5% auto;
      padding: 0;
      border-radius: 15px;
      width: 80%;
      max-width: 800px;
      max-height: 80vh;
      overflow-y: auto;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .modal-header {
      background: #f8f9fa;
      padding: 1.5rem;
      border-bottom: 1px solid #e0e0e0;
      border-radius: 15px 15px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .modal-header h2 {
      margin: 0;
      color: #333;
      font-size: 1.5rem;
    }

    .close {
      color: #aaa;
      font-size: 2rem;
      font-weight: bold;
      cursor: pointer;
      transition: color 0.3s ease;
    }

    .close:hover {
      color: #d4af37;
    }

    .modal-body {
      padding: 2rem;
    }

    .customer-info h3 {
      color: #333;
      margin-bottom: 1rem;
      font-size: 1.3rem;
    }

    .customer-info p {
      margin: 0.5rem 0;
      color: #666;
    }

    .customer-info strong {
      color: #333;
    }

    .status-badge {
      padding: 0.3rem 0.8rem;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .status-badge.vip {
      background: #fff3cd;
      color: #856404;
    }

    .status-badge.active {
      background: #d4edda;
      color: #155724;
    }

    .status-badge.regular {
      background: #e2e3e5;
      color: #383d41;
    }

    .status-badge.blocked {
      background: #f8d7da;
      color: #721c24;
    }

    .status-badge.non-vip {
      background: #d1ecf1;
      color: #0c5460;
    }

    .bookings-section {
      margin-top: 2rem;
    }

    .bookings-section h3 {
      color: #333;
      margin-bottom: 1rem;
      font-size: 1.2rem;
    }

    .bookings-list {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .booking-item {
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 1rem;
      background: #f8f9fa;
    }

    .booking-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1rem;
      padding-bottom: 0.5rem;
      border-bottom: 1px solid #e0e0e0;
    }

    .booking-status {
      padding: 0.3rem 0.8rem;
      border-radius: 15px;
      font-size: 0.8rem;
      font-weight: 500;
    }

    .booking-status.pending {
      background: #fff3cd;
      color: #856404;
    }

    .booking-status.confirmed {
      background: #d4edda;
      color: #155724;
    }

    .booking-status.cancelled {
      background: #f8d7da;
      color: #721c24;
    }

    .booking-details p {
      margin: 0.3rem 0;
      font-size: 0.9rem;
      color: #666;
    }

    .booking-details strong {
      color: #333;
    }

    /* Edit Modal Styles */
    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-group label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      color: #333;
    }

    .form-group input {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: border-color 0.3s ease;
    }

    .form-group input:focus {
      outline: none;
      border-color: #d4af37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-group input[readonly] {
      background-color: #f8f9fa;
      color: #666;
    }

    .form-group select {
      width: 100%;
      padding: 0.8rem;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 0.9rem;
      transition: border-color 0.3s ease;
      background-color: #fff;
    }

    .form-group select:focus {
      outline: none;
      border-color: #d4af37;
      box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    }

    .form-actions {
      display: flex;
      gap: 1rem;
      justify-content: flex-end;
      margin-top: 2rem;
    }

    .btn-secondary {
      background: #6c757d;
      color: #fff;
    }

    .btn-secondary:hover {
      background: #5a6268;
    }

    .btn-primary {
      background: #d4af37;
      color: #000;
    }

    .btn-primary:hover {
      background: #b8941f;
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
                <a href="admin-customers.php" class="active">
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
          <i class="fas fa-users"></i>
          Customer Management
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

      <div class="stats-cards" id="statsCards">
        <div class="stat-card">
          <div class="number" id="totalCustomers">-</div>
          <h3>Total Customers</h3>
          <div class="change" id="totalChange">-</div>
        </div>
        <div class="stat-card">
          <div class="number" id="vipCustomers">-</div>
          <h3>VIP Customers</h3>
          <div class="change" id="vipChange">-</div>
        </div>
        <div class="stat-card">
          <div class="number" id="newCustomers">-</div>
          <h3>New This Month</h3>
          <div class="change" id="newChange">-</div>
        </div>
        <div class="stat-card">
          <div class="number" id="avgRating">-</div>
          <h3>Avg. Rating</h3>
          <div class="change" id="ratingChange">-</div>
        </div>
      </div>

      <div class="customers-filters">
        <h3 style="margin-bottom: 1rem; color: #333;">
          <i class="fas fa-filter" style="color: #d4af37;"></i>
          Filter Customers
        </h3>
        <div class="filters-grid">
          <div class="filter-group">
            <label>Status</label>
            <select id="statusFilter" onchange="filterCustomers()">
              <option value="">All Status</option>
              <option value="VIP">VIP</option>
              <option value="Active">Active</option>
              <option value="Regular">Regular</option>
            </select>
          </div>
          <div class="filter-group">
            <label>Search</label>
            <input type="text" id="searchFilter" placeholder="Search by name or email" onkeyup="filterCustomers()">
          </div>
          <div class="filter-group">
            <label>VIP Status</label>
            <select id="vipFilter" onchange="filterCustomers()">
              <option value="">All VIP Status</option>
              <option value="Yes">VIP Members</option>
              <option value="No">Non-VIP</option>
            </select>
          </div>
          <div class="filter-group">
            <label>Sort By</label>
            <select id="sortFilter" onchange="filterCustomers()">
              <option value="total_spent">Total Spent</option>
              <option value="total_bookings">Total Bookings</option>
              <option value="join_date">Join Date</option>
              <option value="name">Name</option>
            </select>
          </div>
          <div class="filter-group">
            <button id="clearFilters" onclick="clearFilters()" class="clear-filters-btn">
              <i class="fas fa-times"></i>
              Clear Filters
            </button>
          </div>
        </div>
      </div>

      <div class="customers-table">
        <div class="table-header">
          <div class="table-title">
            <i class="fas fa-list"></i>
            Customer List
          </div>
        </div>
        <div class="customers-grid" id="customersGrid">
          <!-- Customer cards will be dynamically loaded here -->
        </div>
      </div>
    </div>
  </div>

  <!-- Customer View Modal -->
  <div id="customerModal" class="modal">
    <div class="modal-content">
      <div id="customerModalContent"></div>
    </div>
  </div>

  <!-- Edit Customer Modal -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <div id="editModalContent"></div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script src="admin-data-loader.js"></script>
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

    // Load customer data from database
    async function loadCustomerData() {
      const customersGrid = document.getElementById('customersGrid');
      
      try {
        // Show loading state
        customersGrid.innerHTML = `
          <div class="loading-message" style="text-align: center; padding: 2rem; color: #666;">
            <i class="fas fa-spinner fa-spin" style="font-size: 2rem; color: #d4af37; margin-bottom: 1rem;"></i>
            <p>Loading customer data...</p>
          </div>
        `;
        
        const response = await fetch('Backend/get_customers_data.php');
        const data = await response.json();
        
        if (data.success) {
          // Update statistics with animation
          updateStatCard('totalCustomers', data.stats.total_customers);
          updateStatCard('vipCustomers', data.stats.vip_customers);
          updateStatCard('newCustomers', data.stats.new_this_month);
          updateStatCard('avgRating', data.stats.avg_rating);
          
          updateStatChange('totalChange', data.stats.total_change + ' vs last month');
          updateStatChange('vipChange', data.stats.vip_change + ' vs last month');
          updateStatChange('newChange', data.stats.new_change + ' vs last month');
          updateStatChange('ratingChange', data.stats.rating_change + ' vs last month');
          
          // Store customers globally and display them
          allCustomers = data.customers;
          displayCustomers(allCustomers);
        } else {
          customersGrid.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #dc3545;">
              <i class="fas fa-exclamation-triangle" style="font-size: 2rem; color: #dc3545; margin-bottom: 1rem;"></i>
              <p>Failed to load customer data: ${data.message}</p>
              <button class="btn btn-view" onclick="loadCustomerData()" style="margin-top: 1rem;">Retry</button>
            </div>
          `;
        }
      } catch (error) {
        console.error('Error loading customer data:', error);
        customersGrid.innerHTML = `
          <div style="text-align: center; padding: 2rem; color: #dc3545;">
            <i class="fas fa-exclamation-triangle" style="font-size: 2rem; color: #dc3545; margin-bottom: 1rem;"></i>
            <p>Error loading customer data. Please try again.</p>
            <button class="btn btn-view" onclick="loadCustomerData()" style="margin-top: 1rem;">Retry</button>
          </div>
        `;
      }
    }

    // Customer action functions
    async function viewCustomer(email) {
      try {
        const response = await fetch(`Backend/get_customer_details.php?email=${encodeURIComponent(email)}`);
        const data = await response.json();
        
        if (data.success) {
          showCustomerModal(data.customer, data.bookings);
        } else {
          alert('Error loading customer details: ' + data.message);
        }
      } catch (error) {
        console.error('Error viewing customer:', error);
        alert('Error loading customer details. Please try again.');
      }
    }

    async function editCustomer(email) {
      try {
        const response = await fetch(`Backend/get_customer_details.php?email=${encodeURIComponent(email)}`);
        const data = await response.json();
        
        if (data.success) {
          showEditModal(data.customer);
        } else {
          alert('Error loading customer details: ' + data.message);
        }
      } catch (error) {
        console.error('Error editing customer:', error);
        alert('Error loading customer details. Please try again.');
      }
    }

    async function deleteCustomer(email) {
      if (confirm('Are you sure you want to delete this customer? This will remove all their booking records permanently.')) {
        try {
          const response = await fetch('Backend/delete_customer.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
            },
            body: JSON.stringify({ email: email })
          });
          
          const data = await response.json();
          
          if (data.success) {
            alert('Customer deleted successfully!');
            loadCustomerData(); // Refresh the customer list
          } else {
            alert('Error deleting customer: ' + data.message);
          }
        } catch (error) {
          console.error('Error deleting customer:', error);
          alert('Error deleting customer. Please try again.');
        }
      }
    }

    // Global variable to store all customers
    let allCustomers = [];
    
    // Global variable for auto-refresh interval
    let statsRefreshInterval;
    
    // Update stat card with animation
    function updateStatCard(elementId, newValue) {
      const element = document.getElementById(elementId);
      const oldValue = element.textContent;
      
      if (oldValue !== newValue.toString()) {
        // Add highlight animation
        element.style.transition = 'all 0.3s ease';
        element.style.transform = 'scale(1.1)';
        element.style.color = '#d4af37';
        
        setTimeout(() => {
          element.textContent = newValue;
          element.style.transform = 'scale(1)';
          element.style.color = '#d4af37';
        }, 150);
        
        setTimeout(() => {
          element.style.color = '#d4af37';
        }, 450);
      } else {
        element.textContent = newValue;
      }
    }
    
    // Update stat change with animation
    function updateStatChange(elementId, newValue) {
      const element = document.getElementById(elementId);
      const oldValue = element.textContent;
      
      if (oldValue !== newValue) {
        // Add highlight animation
        element.style.transition = 'all 0.3s ease';
        element.style.transform = 'scale(1.05)';
        element.style.color = '#28a745';
        
        setTimeout(() => {
          element.textContent = newValue;
          element.style.transform = 'scale(1)';
          element.style.color = '#28a745';
        }, 150);
        
        setTimeout(() => {
          element.style.color = '#28a745';
        }, 450);
      } else {
        element.textContent = newValue;
      }
    }
    
    // Start auto-refresh for statistics
    function startStatsAutoRefresh() {
      // Clear any existing interval
      if (statsRefreshInterval) {
        clearInterval(statsRefreshInterval);
      }
      
      // Set up auto-refresh every 10 seconds
      statsRefreshInterval = setInterval(async () => {
        try {
          const response = await fetch('Backend/get_customers_data.php');
          const data = await response.json();
          
          if (data.success) {
            // Update only statistics, not customer list
            updateStatCard('totalCustomers', data.stats.total_customers);
            updateStatCard('vipCustomers', data.stats.vip_customers);
            updateStatCard('newCustomers', data.stats.new_this_month);
            updateStatCard('avgRating', data.stats.avg_rating);
            
            updateStatChange('totalChange', data.stats.total_change + ' vs last month');
            updateStatChange('vipChange', data.stats.vip_change + ' vs last month');
            updateStatChange('newChange', data.stats.new_change + ' vs last month');
            updateStatChange('ratingChange', data.stats.rating_change + ' vs last month');
          }
        } catch (error) {
          console.error('Error updating statistics:', error);
        }
      }, 10000); // 10 seconds
    }
    
    // Stop auto-refresh
    function stopStatsAutoRefresh() {
      if (statsRefreshInterval) {
        clearInterval(statsRefreshInterval);
        statsRefreshInterval = null;
      }
    }
    
    // Filter customers based on selected criteria
    function filterCustomers() {
      const statusFilter = document.getElementById('statusFilter').value;
      const searchFilter = document.getElementById('searchFilter').value.toLowerCase();
      const vipFilter = document.getElementById('vipFilter').value;
      const sortFilter = document.getElementById('sortFilter').value;
      
      let filteredCustomers = allCustomers.filter(customer => {
        // Status filter
        if (statusFilter && customer.status !== statusFilter) return false;
        
        // Search filter
        if (searchFilter && !customer.name.toLowerCase().includes(searchFilter) && 
            !customer.email.toLowerCase().includes(searchFilter)) return false;
        
        // VIP filter
        if (vipFilter && customer.is_vip !== vipFilter) return false;
        
        return true;
      });
      
      // Sort customers
      filteredCustomers.sort((a, b) => {
        switch (sortFilter) {
          case 'total_spent':
            return parseFloat(b.total_spent.replace(/,/g, '')) - parseFloat(a.total_spent.replace(/,/g, ''));
          case 'total_bookings':
            return parseInt(b.total_bookings) - parseInt(a.total_bookings);
          case 'join_date':
            return new Date(b.join_date) - new Date(a.join_date);
          case 'name':
            return a.name.localeCompare(b.name);
          default:
            return 0;
        }
      });
      
      displayCustomers(filteredCustomers);
    }

    // Clear all filters and reset to default state
    function clearFilters() {
      // Reset all filter inputs to default values
      document.getElementById('statusFilter').value = '';
      document.getElementById('searchFilter').value = '';
      document.getElementById('vipFilter').value = '';
      document.getElementById('sortFilter').value = 'total_spent';
      
      // Display all customers without filtering
      displayCustomers(allCustomers);
    }
    
    // Display customers in the grid
    function displayCustomers(customers) {
      const customersGrid = document.getElementById('customersGrid');
      customersGrid.innerHTML = '';
      
      if (customers.length === 0) {
        customersGrid.innerHTML = `
          <div style="text-align: center; padding: 2rem; color: #666;">
            <i class="fas fa-search" style="font-size: 2rem; color: #d4af37; margin-bottom: 1rem;"></i>
            <p>No customers match your filters</p>
          </div>
        `;
        return;
      }
      
      customers.forEach(customer => {
        let statusClass = 'status-regular';
        if (customer.status === 'VIP') statusClass = 'status-vip';
        else if (customer.status === 'Active') statusClass = 'status-active';
        else if (customer.status === 'Blocked') statusClass = 'status-blocked';
        else if (customer.status === 'Non-VIP') statusClass = 'status-non-vip';
        
        const customerCard = `
          <div class="customer-card">
            <div class="customer-header">
              <div class="customer-name">${customer.name}</div>
              <span class="customer-status ${statusClass}">${customer.status}</span>
            </div>
            <div class="customer-details">
              <div class="detail-group">
                <div class="detail-label">Email</div>
                <div class="detail-value">${customer.email}</div>
              </div>
              <div class="detail-group">
                <div class="detail-label">Phone</div>
                <div class="detail-value">${customer.phone}</div>
              </div>
              <div class="detail-group">
                <div class="detail-label">Join Date</div>
                <div class="detail-value">${customer.join_date}</div>
              </div>
              <div class="detail-group">
                <div class="detail-label">Total Bookings</div>
                <div class="detail-value">${customer.total_bookings}</div>
              </div>
              <div class="detail-group">
                <div class="detail-label">VIP Member</div>
                <div class="detail-value">${customer.is_vip}</div>
              </div>
            </div>
            <div class="customer-actions">
              <button class="btn btn-view" onclick="viewCustomer('${customer.email}')">View</button>
              <button class="btn btn-edit" onclick="editCustomer('${customer.email}')">Edit</button>
              <button class="btn btn-delete" onclick="deleteCustomer('${customer.email}')">Delete</button>
            </div>
          </div>
        `;
        
        customersGrid.innerHTML += customerCard;
      });
    }
    
    // Modal functions
    function showCustomerModal(customer, bookings) {
      const modal = document.getElementById('customerModal');
      const modalContent = document.getElementById('customerModalContent');
      
      modalContent.innerHTML = `
        <div class="modal-header">
          <h2>Customer Details</h2>
          <span class="close" onclick="closeModal('customerModal')">&times;</span>
        </div>
        <div class="modal-body">
          <div class="customer-info">
            <h3>${customer.name}</h3>
            <p><strong>Email:</strong> ${customer.email}</p>
            <p><strong>Phone:</strong> ${customer.phone}</p>
            <p><strong>Join Date:</strong> ${customer.join_date}</p>
            <p><strong>Status:</strong> <span class="status-badge status-${customer.status.toLowerCase().replace('-', '')}">${customer.status}</span></p>
            <p><strong>VIP Member:</strong> ${customer.is_vip}</p>
            <p><strong>Total Bookings:</strong> ${customer.total_bookings}</p>
            <p><strong>Total Spent:</strong> $${customer.total_spent}</p>
            <p><strong>Highest Booking:</strong> $${customer.highest_booking}</p>
            <p><strong>Last Booking:</strong> ${customer.last_booking}</p>
          </div>
          
          <div class="bookings-section">
            <h3>Booking History</h3>
            <div class="bookings-list">
              ${bookings.map(booking => `
                <div class="booking-item">
                  <div class="booking-header">
                    <strong>Booking ID:</strong> ${booking.booking_id}
                    <span class="booking-status ${booking.status.toLowerCase()}">${booking.status}</span>
                  </div>
                  <div class="booking-details">
                    <p><strong>Room Type:</strong> ${booking.room_type}</p>
                    <p><strong>Check-in:</strong> ${booking.check_in_date}</p>
                    <p><strong>Check-out:</strong> ${booking.check_out_date}</p>
                    <p><strong>Guests:</strong> ${booking.num_guests}</p>
                    <p><strong>Rooms:</strong> ${booking.num_rooms}</p>
                    <p><strong>Amount:</strong> $${booking.total_amount}</p>
                    <p><strong>Special Instructions:</strong> ${booking.special_instructions}</p>
                    <p><strong>Booked on:</strong> ${booking.created_at}</p>
                  </div>
                </div>
              `).join('')}
            </div>
          </div>
        </div>
      `;
      
      modal.style.display = 'block';
    }

    function showEditModal(customer) {
      const modal = document.getElementById('editModal');
      const modalContent = document.getElementById('editModalContent');
      
      // First, get the customer's bookings to populate the booking dropdown
      fetch(`Backend/get_customer_details.php?email=${encodeURIComponent(customer.email)}`)
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            const bookings = data.bookings;
            const bookingOptions = bookings.map(booking => 
              `<option value="${booking.booking_id}">${booking.booking_id} - ${booking.room_type} (${booking.status})</option>`
            ).join('');
            
            modalContent.innerHTML = `
              <div class="modal-header">
                <h2>Edit Customer</h2>
                <span class="close" onclick="closeModal('editModal')">&times;</span>
              </div>
              <div class="modal-body">
                <form id="editCustomerForm">
                  <div class="form-group">
                    <label for="editName">Name:</label>
                    <input type="text" id="editName" value="${customer.name}" required>
                  </div>
                  <div class="form-group">
                    <label for="editEmail">Email:</label>
                    <input type="email" id="editEmail" value="${customer.email}" readonly>
                  </div>
                  <div class="form-group">
                    <label for="editPhone">Phone:</label>
                    <input type="tel" id="editPhone" value="${customer.phone}" required>
                  </div>
                  <div class="form-group">
                    <label for="editBooking">Select Booking to Update:</label>
                    <select id="editBooking">
                      <option value="">All Bookings</option>
                      ${bookingOptions}
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="editStatus">Customer Status:</label>
                    <select id="editStatus">
                      <option value="">Keep Current Status</option>
                      <option value="VIP">VIP</option>
                      <option value="Active">Active</option>
                      <option value="Regular">Regular</option>
                      <option value="Blocked">Blocked</option>
                      <option value="Non-VIP">Non-VIP</option>
                    </select>
                  </div>
                  <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editModal')">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
            `;
            
            // Add form submit handler
            document.getElementById('editCustomerForm').addEventListener('submit', async function(e) {
              e.preventDefault();
              
              const formData = {
                email: document.getElementById('editEmail').value,
                name: document.getElementById('editName').value,
                phone: document.getElementById('editPhone').value,
                booking_id: document.getElementById('editBooking').value,
                status: document.getElementById('editStatus').value
              };
              
              try {
                const response = await fetch('Backend/update_customer.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json',
                  },
                  body: JSON.stringify(formData)
                });
                
                const data = await response.json();
                
                if (data.success) {
                  alert('Customer updated successfully!');
                  closeModal('editModal');
                  loadCustomerData(); // Refresh the customer list
                } else {
                  alert('Error updating customer: ' + data.message);
                }
              } catch (error) {
                console.error('Error updating customer:', error);
                alert('Error updating customer. Please try again.');
              }
            });
            
            modal.style.display = 'block';
          } else {
            alert('Error loading customer details: ' + data.message);
          }
        })
        .catch(error => {
          console.error('Error loading customer details:', error);
          alert('Error loading customer details. Please try again.');
        });
    }

    function closeModal(modalId) {
      document.getElementById(modalId).style.display = 'none';
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
      const customerModal = document.getElementById('customerModal');
      const editModal = document.getElementById('editModal');
      
      if (event.target === customerModal) {
        customerModal.style.display = 'none';
      }
      if (event.target === editModal) {
        editModal.style.display = 'none';
      }
    }

    // Load data when page loads
    document.addEventListener('DOMContentLoaded', function() {
      loadCustomerData();
      
      // Start auto-refresh for statistics
      startStatsAutoRefresh();
      
      // Refresh customer list every 30 seconds
      setInterval(loadCustomerData, 30000);
    });
  </script>
</body>
</html> 