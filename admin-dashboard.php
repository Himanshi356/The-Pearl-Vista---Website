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
    <title>Admin Dashboard | The Pearl Vista</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .dashboard-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
        }

        .admin-profile {
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 1px solid #e0e0e0;
        }

        .admin-profile:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background: #d4af37;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-weight: 700;
        }

        .admin-info {
            display: flex;
            flex-direction: column;
        }

        .admin-name {
            font-weight: 600;
            color: #1a1a1a;
        }

        .admin-role {
            font-size: 0.85rem;
            color: #666;
        }

        .admin-dropdown {
            position: absolute;
            top: calc(100% + 10px);
            right: 0;
            background: #1a1a1a;
            border: 2px solid #d4af37;
            border-radius: 8px;
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.3), 0 0 20px rgba(212, 175, 55, 0.2), 0 4px 10px rgba(0, 0, 0, 0.3);
            padding: 0.75rem 0;
            display: none;
            min-width: 220px;
            z-index: 9999;
            backdrop-filter: blur(10px);
        }

        .admin-dropdown a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0.875rem 1.25rem;
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }

        .admin-dropdown a:hover {
            background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
            color: #000;
            border-left: 3px solid #000;
            transform: translateX(3px);
        }

        .admin-dropdown a i {
            width: 16px;
            text-align: center;
            font-size: 1rem;
            color: #d4af37;
            transition: all 0.2s ease;
        }

        .admin-dropdown a:hover i {
            color: #000;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: #fff;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }

        .stat-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: #d4af37;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #000;
            font-size: 1.5rem;
        }

        .stat-title {
            font-weight: 600;
            color: #1a1a1a;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: #d4af37;
        }

        .stat-description {
            color: #666;
            font-size: 0.9rem;
            margin-top: 0.5rem;
        }

        .dashboard-content {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .recent-activity {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .activity-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .activity-header h3 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d4af37;
        }

        .activity-content h4 {
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.25rem;
        }

        .activity-content p {
            color: #666;
            font-size: 0.9rem;
        }

        .quick-actions {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .quick-actions h3 {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
        }

        .action-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .action-btn:hover {
            background: #d4af37;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
        }

        .chart-container {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
            margin-top: 2rem;
        }

        .chart-container h3 {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 1.5rem;
        }

        .chart-placeholder {
            height: 300px;
            background: #f8f9fa;
            border: 2px dashed #e0e0e0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 1.2rem;
        }

        .chart-controls {
            display: flex;
            gap: 10px;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .chart-btn {
            padding: 0.8rem 1.2rem;
            background: #f0f0f0;
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #333;
            font-size: 0.9rem;
        }

        .chart-btn:hover {
            background: #d4af37;
            color: #000;
            border-color: #d4af37;
        }

        .chart-btn.active {
            background: #d4af37;
            color: #000;
            border-color: #d4af37;
        }

        .chart-wrapper {
            height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }

        .revenue-summary {
            display: flex;
            justify-content: space-around;
            margin-top: 2rem;
            padding: 1.5rem;
            background: #f8f9fa;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .summary-item {
            text-align: center;
        }

        .summary-item .label {
            font-size: 0.8rem;
            color: #666;
            margin-bottom: 0.3rem;
        }

        .summary-item .value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #d4af37;
        }

        .summary-item .value.negative {
            color: #dc3545;
        }

        .error {
            color: #dc3545;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 1rem;
            border-radius: 8px;
            margin: 1rem 0;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 2em;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f8f8f8;
        }
        h2 {
            margin-top: 2em;
        }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <div class="sidebar">
            <div class="logo">The Pearl Vista</div>
            <nav>
                <a href="admin-dashboard.php" class="active">
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
            <div class="dashboard-header">
                <h1 class="dashboard-title">Admin Dashboard</h1>
                <div class="admin-profile" onclick="toggleDropdown()">
                    <div class="admin-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="admin-info">
                        <div class="admin-name" id="adminName">Admin User</div>
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
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="stat-title">Total Admins</div>
                            <div class="stat-value" id="totalAdmins">-</div>
                        </div>
                    </div>
                    <div class="stat-description">Active administrators in the system</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <div>
                            <div class="stat-title">Total Rooms</div>
                            <div class="stat-value" id="totalRooms">-</div>
                        </div>
                    </div>
                    <div class="stat-description">Available rooms for booking</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div>
                            <div class="stat-title">Active Bookings</div>
                            <div class="stat-value" id="activeBookings">-</div>
                        </div>
                    </div>
                    <div class="stat-description">Current confirmed bookings</div>
                </div>
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div>
                            <div class="stat-title">Total Activity</div>
                            <div class="stat-value" id="totalActivity">-</div>
                        </div>
                    </div>
                    <div class="stat-description">System activities logged</div>
                </div>
            </div>

            <div class="dashboard-content">
                <div class="recent-activity">
                    <div class="activity-header">
                        <i class="fas fa-clock"></i>
                        <h3>Recent Activity</h3>
                    </div>
                    <div id="activityLog">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                            <div class="activity-content">
                                <h4>Loading...</h4>
                                <p>Please wait while we load recent activities</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="quick-actions">
                    <h3>
                        <i class="fas fa-bolt"></i>
                        Quick Actions
                    </h3>
                    <div class="action-buttons">
                        <a href="admin-add-user.php" class="action-btn">
                            <i class="fas fa-user-plus"></i>
                            Add Admin User
                        </a>
                        <a href="admin-rooms.php" class="action-btn">
                            <i class="fas fa-bed"></i>
                            Manage Rooms
                        </a>
                        <a href="admin-bookings.php" class="action-btn">
                            <i class="fas fa-calendar-plus"></i>
                            Manage Bookings
                        </a>
                        <button onclick="openCreateBookingModal()" class="action-btn">
                            <i class="fas fa-plus-circle"></i>
                            Create New Booking
                        </button>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <h3>
                    <i class="fas fa-chart-area"></i>
                    Revenue Overview
                </h3>
                <div class="chart-controls">
                    <button class="chart-btn active" onclick="switchChart('line')">Line Chart</button>
                    <button class="chart-btn" onclick="switchChart('bar')">Bar Chart</button>
                    <button class="chart-btn" onclick="switchChart('doughnut')">Breakdown</button>
                </div>
                <div class="chart-wrapper">
                    <canvas id="revenueChart" width="400" height="200"></canvas>
                </div>
                <div class="revenue-summary">
                    <div class="summary-item">
                        <span class="label">Current Month:</span>
                        <span class="value" id="currentMonthRevenue">$0</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Change:</span>
                        <span class="value" id="revenueChange">0%</span>
                    </div>
                    <div class="summary-item">
                        <span class="label">Top Source:</span>
                        <span class="value" id="topSource">-</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Revenue Chart Variables
        let revenueChart = null;
        let currentChartType = 'line';
        let revenueData = null;

        // Define toggleDropdown function
        function toggleDropdown() {
            const dropdown = document.getElementById('adminDropdown');
            if (!dropdown) {
                console.error('Dropdown element not found');
                return;
            }
            
            const currentDisplay = dropdown.style.display;
            if (currentDisplay === 'block') {
                dropdown.style.display = 'none';
            } else {
                dropdown.style.display = 'block';
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const profile = document.querySelector('.admin-profile');
            const dropdown = document.getElementById('adminDropdown');
            if (profile && dropdown && !profile.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });

        // Load revenue data and create chart
        document.addEventListener('DOMContentLoaded', function() {
            loadRevenueData();
        });

        function loadRevenueData() {
            fetch('Backend/get_revenue_data.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        revenueData = data.data;
                        createRevenueChart('line');
                        updateRevenueSummary();
                    } else {
                        console.error('Failed to load revenue data:', data.message);
                        createSampleChart();
                    }
                })
                .catch(error => {
                    console.error('Error loading revenue data:', error);
                    createSampleChart();
                });
        }

        function createRevenueChart(type) {
            const ctx = document.getElementById('revenueChart').getContext('2d');
            
            // Destroy existing chart if it exists
            if (revenueChart) {
                revenueChart.destroy();
            }
            
            currentChartType = type;
            
            if (type === 'doughnut') {
                createDoughnutChart(ctx);
            } else {
                createLineBarChart(ctx, type);
            }
        }

        function createLineBarChart(ctx, type) {
            const chartData = {
                labels: revenueData.months,
                datasets: [
                    {
                        label: 'Room Revenue',
                        data: revenueData.roomRevenue,
                        borderColor: '#d4af37',
                        backgroundColor: 'rgba(212, 175, 55, 0.1)',
                        tension: 0.4,
                        fill: type === 'line'
                    },
                    {
                        label: 'Service Revenue',
                        data: revenueData.serviceRevenue,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4,
                        fill: type === 'line'
                    },
                    {
                        label: 'Tour Revenue',
                        data: revenueData.tourRevenue,
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.4,
                        fill: type === 'line'
                    },
                    {
                        label: 'Total Revenue',
                        data: revenueData.totalRevenue,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        tension: 0.4,
                        fill: type === 'line',
                        borderWidth: 3
                    }
                ]
            };

            revenueChart = new Chart(ctx, {
                type: type,
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            callbacks: {
                                label: function(context) {
                                    return context.dataset.label + ': $' + context.parsed.y.toLocaleString();
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 11
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return '$' + value.toLocaleString();
                                },
                                font: {
                                    size: 11
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    }
                }
            });
        }

        function createDoughnutChart(ctx) {
            const currentMonth = revenueData.currentMonth;
            const chartData = {
                labels: ['Room Revenue', 'Service Revenue', 'Tour Revenue'],
                datasets: [{
                    data: [currentMonth.room, currentMonth.service, currentMonth.tour],
                    backgroundColor: [
                        'rgba(212, 175, 55, 0.8)',
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderColor: [
                        '#d4af37',
                        '#28a745',
                        '#dc3545'
                    ],
                    borderWidth: 2
                }]
            };

            revenueChart = new Chart(ctx, {
                type: 'doughnut',
                data: chartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((context.parsed / total) * 100).toFixed(1);
                                    return context.label + ': $' + context.parsed.toLocaleString() + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        }

        function updateRevenueSummary() {
            const currentMonth = revenueData.currentMonth;
            const percentageChange = revenueData.percentageChange;
            const topSource = revenueData.topSources[0];

            document.getElementById('currentMonthRevenue').textContent = '$' + currentMonth.total.toLocaleString();
            
            const changeElement = document.getElementById('revenueChange');
            changeElement.textContent = (percentageChange >= 0 ? '+' : '') + percentageChange + '%';
            changeElement.className = 'value ' + (percentageChange < 0 ? 'negative' : '');
            
            document.getElementById('topSource').textContent = topSource.source;
        }

        function createSampleChart() {
            // Create sample data for demonstration
            const sampleData = {
                months: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                roomRevenue: [12000, 15000, 18000, 16000, 20000, 22000, 25000, 23000, 28000, 30000, 32000, 35000],
                serviceRevenue: [5000, 6000, 7000, 6500, 8000, 8500, 9000, 8800, 9500, 10000, 11000, 12000],
                tourRevenue: [3000, 3500, 4000, 3800, 4500, 5000, 5500, 5200, 6000, 6500, 7000, 7500],
                totalRevenue: [20000, 24500, 29000, 26300, 32500, 35500, 39500, 37000, 43500, 46500, 49000, 54500],
                currentMonth: {
                    room: 35000,
                    service: 12000,
                    tour: 7500,
                    total: 54500
                },
                percentageChange: 12.5,
                topSources: [{ source: 'Room Bookings', revenue: 35000 }]
            };

            revenueData = sampleData;
            createRevenueChart('line');
            updateRevenueSummary();
        }

        function switchChart(type) {
            // Update button states
            document.querySelectorAll('.chart-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            
            // Create new chart
            createRevenueChart(type);
        }


        // Admin profile, stats, and activity log
    fetch('Backend/Admin/get_admin_data.php')
        .then(res => res.json())
        .then(data => {
            if (data.status !== 'success') {
                    document.body.innerHTML = '<div class="error">Unauthorized or error: ' + (data.message || data.error) + '</div>';
                return;
            }
            const admin = data.admin_data;
                
                // Update admin profile
                document.getElementById('adminName').textContent = admin.name || (admin.first_name + ' ' + admin.last_name) || admin.username || 'Admin User';
                document.getElementById('adminRole').textContent = admin.role || 'Administrator';
                
                // Update stats
                document.getElementById('totalAdmins').textContent = data.statistics.total_admins || 0;
                document.getElementById('totalActivity').textContent = data.statistics.total_activity || 0;
                
                // Update activity log
                if (data.recent_activity && data.recent_activity.length > 0) {
                    let activityHtml = '';
                    data.recent_activity.forEach(log => {
                        activityHtml += `
                            <div class="activity-item">
                                <div class="activity-icon">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="activity-content">
                                    <h4>${log.action}</h4>
                                    <p>${log.description || 'Activity logged'} - ${log.created_at}</p>
                                </div>
                            </div>
                        `;
                    });
                    document.getElementById('activityLog').innerHTML = activityHtml;
                } else {
                    document.getElementById('activityLog').innerHTML = `
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="activity-content">
                                <h4>No Recent Activity</h4>
                                <p>No recent activities to display</p>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(error => {
                console.error('Error loading admin data:', error);
                document.getElementById('activityLog').innerHTML = `
                    <div class="error">Error loading admin data. Please try refreshing the page.</div>
                `;
            });

        // Load additional stats using the new backend files
        fetch('Backend/Admin/get_rooms_data.php')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.room_types) {
                    const totalRooms = data.room_types.reduce((sum, room) => sum + (room.total_rooms || 0), 0);
                    document.getElementById('totalRooms').textContent = totalRooms;
                }
            })
            .catch(() => {
                document.getElementById('totalRooms').textContent = '0';
            });

        fetch('Backend/Admin/get_bookings_data.php')
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success' && data.statistics) {
                    document.getElementById('activeBookings').textContent = data.statistics.confirmed_bookings || 0;
                }
            })
            .catch(() => {
                document.getElementById('activeBookings').textContent = '0';
            });


    </script>

    <!-- Create New Booking Modal -->
    <div id="createBookingModal" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); z-index:10000; align-items:center; justify-content:center;">
        <div style="background:#fff; border-radius:20px; max-width:600px; width:95%; max-height:90vh; overflow-y:auto; padding:2rem; position:relative;">
            <button onclick="closeCreateBookingModal()" style="position:absolute; top:1rem; right:1rem; background:none; border:none; font-size:1.5rem; cursor:pointer; color:#666;">&times;</button>
            
            <h2 style="color:#333; margin-bottom:1.5rem; text-align:center;">
                <i class="fas fa-plus-circle" style="color:#d4af37; margin-right:0.5rem;"></i>
                Create New Booking
            </h2>
            
            <form id="createBookingForm" style="display:flex; flex-direction:column; gap:1rem;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Customer Name *</label>
                        <input type="text" id="customerName" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Customer Phone *</label>
                        <input type="tel" id="customerPhone" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                </div>
                
                <div>
                    <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Customer Email *</label>
                    <input type="email" id="customerEmail" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                </div>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Check-in Date *</label>
                        <input type="date" id="checkinDate" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Check-out Date *</label>
                        <input type="date" id="checkoutDate" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                </div>
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Number of Guests *</label>
                        <input type="number" id="numGuests" min="1" max="10" value="1" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                    <div>
                        <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Number of Rooms *</label>
                        <input type="number" id="numRooms" min="1" max="10" value="1" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                    </div>
                </div>
                
                <div>
                    <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Room Type *</label>
                    <select id="roomType" required style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem;">
                        <option value="">Select Room Type</option>
                        <option value="Pearl Signature Room">Pearl Signature Room - $20,695/night</option>
                        <option value="Deluxe Room">Deluxe Room - $3,240/night</option>
                        <option value="Premium Room">Premium Room - $5,580/night</option>
                        <option value="Executive Room">Executive Room - $8,790/night</option>
                        <option value="Luxury Suite">Luxury Suite - $11,920/night</option>
                        <option value="Family Suite">Family Suite - $14,855/night</option>
                    </select>
                </div>
                
                <div>
                    <label style="display:block; margin-bottom:0.5rem; font-weight:600; color:#333;">Special Instructions</label>
                    <textarea id="specialInstructions" rows="3" style="width:100%; padding:0.75rem; border:1px solid #ddd; border-radius:8px; font-size:1rem; resize:vertical;"></textarea>
                </div>
                
                <div style="display:flex; gap:1rem; margin-top:1rem;">
                    <button type="button" onclick="closeCreateBookingModal()" style="flex:1; padding:0.75rem; background:#f8f9fa; color:#333; border:1px solid #ddd; border-radius:8px; font-size:1rem; cursor:pointer;">Cancel</button>
                    <button type="submit" style="flex:1; padding:0.75rem; background:#d4af37; color:#333; border:none; border-radius:8px; font-size:1rem; font-weight:600; cursor:pointer;">Create Booking</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Create Booking Modal Functions
        function openCreateBookingModal() {
            document.getElementById('createBookingModal').style.display = 'flex';
            // Set minimum dates
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('checkinDate').min = today;
            document.getElementById('checkoutDate').min = today;
        }

        function closeCreateBookingModal() {
            document.getElementById('createBookingModal').style.display = 'none';
            document.getElementById('createBookingForm').reset();
        }

        // Handle form submission
        document.getElementById('createBookingForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData();
            formData.append('customer_name', document.getElementById('customerName').value);
            formData.append('customer_phone', document.getElementById('customerPhone').value);
            formData.append('customer_email', document.getElementById('customerEmail').value);
            formData.append('check_in_date', document.getElementById('checkinDate').value);
            formData.append('check_out_date', document.getElementById('checkoutDate').value);
            formData.append('num_guests', document.getElementById('numGuests').value);
            formData.append('num_rooms', document.getElementById('numRooms').value);
            formData.append('room_type', document.getElementById('roomType').value);
            formData.append('special_instructions', document.getElementById('specialInstructions').value);
            formData.append('status', 'confirmed'); // Default to confirmed for admin bookings
            
            // Show loading state
            const submitBtn = e.target.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.textContent = 'Creating...';
            submitBtn.disabled = true;
            
            fetch('Backend/admin_create_booking.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Booking created successfully! Booking ID: ' + data.booking_id);
                    closeCreateBookingModal();
                    // Optionally refresh the page or update stats
                    location.reload();
                } else {
                    alert('Error creating booking: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Network error. Please try again.');
            })
            .finally(() => {
                submitBtn.textContent = originalText;
                submitBtn.disabled = false;
            });
        });

        // Close modal when clicking outside
        document.getElementById('createBookingModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateBookingModal();
            }
        });
    </script>
</body>
</html> 