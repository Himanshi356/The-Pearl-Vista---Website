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
  <title>Admin Rooms | The Pearl Vista</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Completely hide scrollbar while keeping functionality */
    #editRoomModal > div {
      scrollbar-width: none; /* Firefox */
      -ms-overflow-style: none; /* IE and Edge */
      overflow-y: auto;
      max-height: 90vh;
    }

    #editRoomModal > div::-webkit-scrollbar {
      width: 0px; /* Chrome, Safari, Opera */
      background: transparent;
    }

    #editRoomModal > div::-webkit-scrollbar-track {
      background: transparent;
    }

    #editRoomModal > div::-webkit-scrollbar-thumb {
      background: transparent;
    }

    #editRoomModal > div::-webkit-scrollbar-thumb:hover {
      background: transparent;
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

    .topbar-actions {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .refresh-availability:hover {
      background: #b8941f !important;
      transform: translateY(-1px);
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

    /* Rooms specific styles */
    .rooms-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.5rem;
      margin-bottom: 2rem;
    }

    .room-card {
      background: #fff;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .room-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
      border-color: #d4af37;
    }

    .room-image {
      width: 100%;
      height: 200px;
      background: linear-gradient(135deg, #d4af37, #b8941f);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #000;
      font-size: 3rem;
      overflow: hidden;
      border-radius: 8px 8px 0 0;
    }

    .room-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }

    .room-image:hover img {
      transform: scale(1.05);
    }

    .room-info {
      padding: 1.5rem;
    }

    .room-title {
      font-size: 1.3rem;
      font-weight: 600;
      color: #333;
      margin-bottom: 0.5rem;
    }

    .room-price {
      font-size: 1.5rem;
      font-weight: 700;
      color: #d4af37;
      margin-bottom: 1rem;
    }

    .room-features {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
      margin-bottom: 1rem;
    }

    .feature-tag {
      background: #f8f9fa;
      color: #666;
      padding: 0.3rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      border: 1px solid #e0e0e0;
    }

    .room-status {
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

    .status-occupied {
      background: #f8d7da;
      color: #721c24;
    }

    .status-maintenance {
      background: #fff3cd;
      color: #856404;
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

    .add-room-section {
      background: #fff;
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
      border: 1px solid #e0e0e0;
      margin-bottom: 2rem;
    }

    .add-room-form {
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

    .loading {
      text-align: center;
      padding: 2rem;
      color: #666;
      font-size: 1.1rem;
    }

    .no-data {
      text-align: center;
      padding: 2rem;
      color: #666;
      font-size: 1.1rem;
      background: #f8f9fa;
      border-radius: 8px;
      border: 1px solid #e0e0e0;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 1rem;
    }

    table th,
    table td {
      padding: 0.75rem;
      text-align: left;
      border-bottom: 1px solid #e0e0e0;
    }

    table th {
      background: #f8f9fa;
      font-weight: 600;
      color: #333;
    }

    .status-pending { color: #856404; background: #fff3cd; padding: 0.25rem 0.5rem; border-radius: 4px; }
    .status-confirmed { color: #155724; background: #d4edda; padding: 0.25rem 0.5rem; border-radius: 4px; }
    .status-cancelled { color: #721c24; background: #f8d7da; padding: 0.25rem 0.5rem; border-radius: 4px; }
    .status-verified { color: #155724; background: #d4edda; padding: 0.25rem 0.5rem; border-radius: 4px; }
    .status-unverified { color: #856404; background: #fff3cd; padding: 0.25rem 0.5rem; border-radius: 4px; }
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
                <a href="admin-rooms.php" class="active">
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
          <i class="fas fa-bed"></i>
          Room Management
        </div>
        <div class="topbar-actions">
          <button class="refresh-availability" onclick="refreshRoomAvailability()" style="
            background: #d4af37;
            color: #000;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
          ">
            <i class="fas fa-sync-alt"></i>
            Refresh Availability
          </button>
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

      <div class="add-room-section">
        <h3 style="margin-bottom: 1.5rem; color: #333;">
          <i class="fas fa-plus" style="color: #d4af37;"></i>
          Add New Room
        </h3>
        <form class="add-room-form">
          <div class="form-group">
            <label>Room Number</label>
            <input type="text" placeholder="e.g., 101" required>
          </div>
          <div class="form-group">
            <label>Room Type</label>
            <select id="roomTypeSelect" required onchange="handleRoomTypeChange()">
              <option value="">Select Type</option>
              <option value="Pearl Signature Room">Pearl Signature Room</option>
              <option value="Suite King">Suite King</option>
              <option value="Deluxe Room">Deluxe Room</option>
              <option value="Premium Room">Premium Room</option>
              <option value="Executive Room">Executive Room</option>
              <option value="Luxury Suite">Luxury Suite</option>
              <option value="Family Suite">Family Suite</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div class="form-group" id="customRoomTypeDiv" style="display: none;">
            <label>Custom Room Type Name</label>
            <input type="text" id="customRoomType" placeholder="Enter new room type name..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
          </div>
          <div class="form-group">
            <label>Price per Night</label>
            <input type="number" placeholder="e.g., 150" required>
          </div>
          <div class="form-group">
            <label>Capacity</label>
            <input type="number" placeholder="e.g., 2" required>
          </div>
          <div class="form-group">
            <label>Status</label>
            <select required>
              <option value="available">Available</option>
              <option value="occupied">Occupied</option>
              <option value="maintenance">Maintenance</option>
            </select>
          </div>
          <div class="form-group">
            <label>Description</label>
            <textarea placeholder="Room description..." rows="3"></textarea>
          </div>
          <div class="form-group" style="grid-column: 1 / -1;">
            <button type="submit" class="btn-primary">
              <i class="fas fa-plus"></i>
              Add Room
            </button>
          </div>
        </form>
      </div>

      <div class="rooms-grid" id="roomsGrid">
        <div class="loading">Loading room data...</div>
      </div>
    </div>
  </div>

  <script src="admin-navigation.js"></script>
  <script src="fix-admin-navigation.js"></script>
  <script src="admin-data-loader.js"></script>
  
  <!-- Edit Room Modal -->
  <div id="editRoomModal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); overflow-y: auto;">
    <div style="background-color: #fff; margin: 5% auto; padding: 20px; border-radius: 10px; width: 80%; max-width: 500px; max-height: 90vh; overflow-y: auto; scrollbar-width: thin; scrollbar-color: #d4af37 #f0f0f0;">
      <h2 style="color: #333; margin-bottom: 20px;">Edit Room Details</h2>
      <form id="editRoomForm">
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Room Type:</label>
          <input type="text" id="editRoomType" readonly style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; background-color: #f9f9f9;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Price per Night ($):</label>
          <input type="number" id="editPrice" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Total Rooms:</label>
          <input type="number" id="editTotalRooms" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Available Rooms:</label>
          <input type="number" id="editAvailableRooms" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Floor Number:</label>
          <input type="number" id="editFloor" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
                  <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Status:</label>
            <select id="editStatus" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
              <option value="Available">Available</option>
              <option value="Fully Booked">Fully Booked</option>
              <option value="Maintenance">Maintenance</option>
            </select>
          </div>
          <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Room Type:</label>
            <select id="editRoomTypeSelect" required style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" onchange="handleEditRoomTypeChange()">
              <option value="Pearl Signature Room">Pearl Signature Room</option>
              <option value="Suite King">Suite King</option>
              <option value="Deluxe Room">Deluxe Room</option>
              <option value="Premium Room">Premium Room</option>
              <option value="Executive Room">Executive Room</option>
              <option value="Luxury Suite">Luxury Suite</option>
              <option value="Family Suite">Family Suite</option>
              <option value="Others">Others</option>
            </select>
          </div>
          <div style="margin-bottom: 15px;" id="editCustomRoomTypeDiv" style="display: none;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Custom Room Type Name:</label>
            <input type="text" id="editCustomRoomType" placeholder="Enter new room type name..." style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
          </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Description:</label>
          <textarea id="editDescription" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;"></textarea>
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Additional Notes:</label>
          <textarea id="editNotes" rows="2" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Any additional notes about this room type..."></textarea>
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Amenities:</label>
          <textarea id="editAmenities" rows="2" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="List of amenities included..."></textarea>
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Special Features:</label>
          <textarea id="editFeatures" rows="2" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Special features or highlights..."></textarea>
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 5px; font-weight: bold;">Maintenance Notes:</label>
          <textarea id="editMaintenance" rows="2" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;" placeholder="Any maintenance notes or requirements..."></textarea>
        </div>
        <div style="text-align: right; position: sticky; bottom: 0; background: #fff; padding-top: 10px; border-top: 1px solid #eee;">
          <button type="button" onclick="closeEditModal()" style="padding: 8px 16px; margin-right: 10px; border: 1px solid #ddd; background: #f8f9fa; border-radius: 4px; cursor: pointer;">Cancel</button>
          <button type="submit" style="padding: 8px 16px; background: #d4af37; color: #000; border: none; border-radius: 4px; cursor: pointer;">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
  
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

    // Modal functions
    function openEditModal(roomType) {
      const modal = document.getElementById('editRoomModal');
      const roomCard = document.querySelector(`[data-room-type="${roomType}"]`);
      
      if (!roomCard) {
        alert('Room data not found');
        return;
      }
      
      // Extract current values
      const priceElement = roomCard.querySelector('.room-price');
      const featuresElement = roomCard.querySelector('.room-features');
      const statusElement = roomCard.querySelector('.status-badge');
      
      const currentPrice = parseFloat(priceElement.textContent.replace('$', '').replace('/night', '').replace(',', ''));
      const floorElement = featuresElement.querySelector('.feature-tag');
      const totalRoomsElement = featuresElement.querySelectorAll('.feature-tag')[1];
      const availableRoomsElement = featuresElement.querySelectorAll('.feature-tag')[2];
      
      const currentFloor = parseInt(floorElement.textContent.replace('Floor ', ''));
      const currentTotalRooms = parseInt(totalRoomsElement.textContent.replace(' Rooms', ''));
      const currentAvailableRooms = parseInt(availableRoomsElement.textContent.replace(' Available', ''));
      const currentStatus = statusElement.textContent;
      
      // Populate form fields
      document.getElementById('editRoomType').value = roomType;
      document.getElementById('editPrice').value = currentPrice;
      document.getElementById('editTotalRooms').value = currentTotalRooms;
      document.getElementById('editAvailableRooms').value = currentAvailableRooms;
      document.getElementById('editFloor').value = currentFloor;
      document.getElementById('editStatus').value = currentStatus;
      document.getElementById('editRoomTypeSelect').value = roomType;
      document.getElementById('editDescription').value = '';
      document.getElementById('editNotes').value = '';
      document.getElementById('editAmenities').value = '';
      document.getElementById('editFeatures').value = '';
      document.getElementById('editMaintenance').value = '';
      document.getElementById('editCustomRoomTypeDiv').style.display = 'none';
      document.getElementById('editCustomRoomType').value = '';
      
      modal.style.display = 'block';
    }

    function closeEditModal() {
      document.getElementById('editRoomModal').style.display = 'none';
    }

    // Handle form submission
    document.getElementById('editRoomForm').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const editRoomTypeSelect = document.getElementById('editRoomTypeSelect');
      const editCustomRoomTypeInput = document.getElementById('editCustomRoomType');
      
      let roomType = editRoomTypeSelect.value;
      
      // If "Others" is selected, use the custom room type name
      if (roomType === 'Others') {
        roomType = editCustomRoomTypeInput.value.trim();
        if (!roomType) {
          alert('Please enter a custom room type name.');
          editCustomRoomTypeInput.focus();
          return;
        }
      }
      
      const price = parseFloat(document.getElementById('editPrice').value);
      const totalRooms = parseInt(document.getElementById('editTotalRooms').value);
      const availableRooms = parseInt(document.getElementById('editAvailableRooms').value);
      const floor = parseInt(document.getElementById('editFloor').value);
      const status = document.getElementById('editStatus').value;
      const description = document.getElementById('editDescription').value;
      const notes = document.getElementById('editNotes').value;
      const amenities = document.getElementById('editAmenities').value;
      const features = document.getElementById('editFeatures').value;
      const maintenance = document.getElementById('editMaintenance').value;
      
      try {
        const response = await fetch('Backend/Admin/edit_room.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            room_type: roomType,
            base_price: price,
            total_rooms: totalRooms,
            available_rooms: availableRooms,
            floor_number: floor,
            status: status,
            description: description,
            notes: notes,
            amenities: amenities,
            features: features,
            maintenance: maintenance
          })
        });
        
        const result = await response.json();
        
        if (result.status === 'success') {
          alert('Room updated successfully!');
          closeEditModal();
          // Reload room data instead of full page reload
          const dataLoader = new AdminDataLoader();
          dataLoader.loadRoomsData();
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error updating room:', error);
        alert('Failed to update room. Please try again.');
      }
    });

    // Close modal when clicking outside
    window.onclick = function(event) {
      const modal = document.getElementById('editRoomModal');
      if (event.target === modal) {
        closeEditModal();
      }
    }

    // Handle room type selection change
    function handleRoomTypeChange() {
      const roomTypeSelect = document.getElementById('roomTypeSelect');
      const customRoomTypeDiv = document.getElementById('customRoomTypeDiv');
      const customRoomTypeInput = document.getElementById('customRoomType');
      
      if (roomTypeSelect.value === 'Others') {
        customRoomTypeDiv.style.display = 'block';
        customRoomTypeInput.required = true;
        customRoomTypeInput.focus();
      } else {
        customRoomTypeDiv.style.display = 'none';
        customRoomTypeInput.required = false;
        customRoomTypeInput.value = '';
      }
    }

    // Handle edit modal room type selection change
    function handleEditRoomTypeChange() {
      const editRoomTypeSelect = document.getElementById('editRoomTypeSelect');
      const editCustomRoomTypeDiv = document.getElementById('editCustomRoomTypeDiv');
      const editCustomRoomTypeInput = document.getElementById('editCustomRoomType');
      
      if (editRoomTypeSelect.value === 'Others') {
        editCustomRoomTypeDiv.style.display = 'block';
        editCustomRoomTypeInput.required = true;
        editCustomRoomTypeInput.focus();
      } else {
        editCustomRoomTypeDiv.style.display = 'none';
        editCustomRoomTypeInput.required = false;
        editCustomRoomTypeInput.value = '';
      }
    }

    // Handle form submission for adding new room
    document.querySelector('.add-room-form').addEventListener('submit', async function(e) {
      e.preventDefault();
      
      const roomTypeSelect = document.getElementById('roomTypeSelect');
      const customRoomTypeInput = document.getElementById('customRoomType');
      
      let roomType = roomTypeSelect.value;
      
      // If "Others" is selected, use the custom room type name
      if (roomType === 'Others') {
        roomType = customRoomTypeInput.value.trim();
        if (!roomType) {
          alert('Please enter a custom room type name.');
          customRoomTypeInput.focus();
          return;
        }
      }
      
      if (!roomType) {
        alert('Please select a room type.');
        return;
      }
      
      // Get other form data
      const formData = new FormData(e.target);
      const roomData = {
        room_type: roomType,
        room_number: formData.get('room_number') || document.querySelector('input[placeholder="e.g., 101"]').value,
        price_per_night: parseFloat(formData.get('price_per_night') || document.querySelector('input[placeholder="e.g., 150"]').value),
        description: formData.get('description') || document.querySelector('textarea').value,
        floor: parseInt(formData.get('floor') || '1'),
        status: formData.get('status') || 'available'
      };
      
      try {
        const response = await fetch('Backend/Admin/add_room.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(roomData)
        });
        
        const result = await response.json();
        
        if (result.status === 'success') {
          alert('Room added successfully!');
          e.target.reset();
          document.getElementById('customRoomTypeDiv').style.display = 'none';
          // Reload room data
          location.reload();
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error adding room:', error);
        alert('Failed to add room. Please try again.');
      }
    });

    // Global function for refreshing room availability
    async function refreshRoomAvailability() {
      try {
        // Update room availability in database
        const response = await fetch('Backend/Admin/update_room_availability.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          }
        });
        
        const result = await response.json();
        
        if (result.status === 'success') {
          // Reload room data to show updated availability
          const dataLoader = new AdminDataLoader();
          await dataLoader.loadRoomsData();
          console.log('Room availability refreshed successfully');
          alert('Room availability updated successfully!');
        } else {
          console.error('Failed to refresh room availability:', result.message);
          alert('Failed to refresh room availability: ' + result.message);
        }
      } catch (error) {
        console.error('Error refreshing room availability:', error);
        alert('Error refreshing room availability. Please try again.');
      }
    }
  </script>
</body>
</html> 