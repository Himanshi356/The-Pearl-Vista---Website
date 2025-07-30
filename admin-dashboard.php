<?php
session_start();
if (!isset($_SESSION['admin_id']) || !isset($_SESSION['admin_role']) || !in_array($_SESSION['admin_role'], ['admin', 'super_admin', 'manager'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-bottom: 2em; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f8f8f8; }
        h2 { margin-top: 2em; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div id="adminProfile"></div>
    <div id="dashboardStats"></div>
    <div id="activityLog"></div>
    <div id="roomsTable"></div>
    <div id="bookingsTable"></div>
    <div id="tourBookingsTable"></div>
    <div id="usersTable"></div>
    <div id="servicesTable"></div>
    <script>
    // Admin profile, stats, and activity log (already live)
    fetch('Backend/Admin/get_admin_data.php')
        .then(res => res.json())
        .then(data => {
            if (data.status !== 'success') {
                document.body.innerHTML = '<h2>Unauthorized or error: ' + (data.message || data.error) + '</h2>';
                return;
            }
            const admin = data.admin_data;
            document.getElementById('adminProfile').innerHTML =
                `<h2>Profile</h2>
                <p>Username: ${admin.username}</p>
                <p>Name: ${admin.name || (admin.first_name + ' ' + admin.last_name)}</p>
                <p>Email: ${admin.email || ''}</p>
                <p>Department: ${admin.department || ''}</p>
                <p>Last Login: ${admin.last_login || ''}</p>
                <p>Login Count: ${admin.login_count || ''}</p>`;
            document.getElementById('dashboardStats').innerHTML =
                `<h2>Stats</h2>
                <ul>
                    <li>Total Admins: ${data.statistics.total_admins}</li>
                    <li>Active Admins: ${data.statistics.active_admins}</li>
                    <li>Total Activity: ${data.statistics.total_activity}</li>
                </ul>`;
            let logs = data.recent_activity.map(log =>
                `<tr><td>${log.action}</td><td>${log.created_at}</td></tr>`
            ).join('');
            document.getElementById('activityLog').innerHTML =
                `<h2>Recent Activity</h2><table><tr><th>Action</th><th>Time</th></tr>${logs}</table>`;
        });

    // Rooms Table
    fetch('Backend/get_rooms.php')
        .then(res => res.json())
        .then(data => {
            if (!data.rooms || !data.rooms.length) {
                document.getElementById('roomsTable').innerHTML = '<h2>Rooms</h2><p>No rooms found.</p>';
                return;
            }
            let rows = data.rooms.map(room =>
                `<tr><td>${room.room_id}</td><td>${room.room_number}</td><td>${room.type}</td><td>${room.status}</td><td>${room.price}</td></tr>`
            ).join('');
            document.getElementById('roomsTable').innerHTML =
                `<h2>Rooms</h2><table><tr><th>ID</th><th>Number</th><th>Type</th><th>Status</th><th>Price</th></tr>${rows}</table>`;
        })
        .catch(() => {
            document.getElementById('roomsTable').innerHTML = '<h2>Rooms</h2><p class="error">Could not load rooms data.</p>';
        });

    // Bookings Table
    fetch('Backend/get_bookings.php')
        .then(res => res.json())
        .then(data => {
            if (!data.bookings || !data.bookings.length) {
                document.getElementById('bookingsTable').innerHTML = '<h2>Bookings</h2><p>No bookings found.</p>';
                return;
            }
            let rows = data.bookings.map(b =>
                `<tr><td>${b.id || b.booking_id}</td><td>${b.customer_name || b.user_id}</td><td>${b.room_id || b.room_number || ''}</td><td>${b.status}</td><td>${b.check_in_date || b.booking_date || ''}</td></tr>`
            ).join('');
            document.getElementById('bookingsTable').innerHTML =
                `<h2>Bookings</h2><table><tr><th>ID</th><th>Customer/User</th><th>Room</th><th>Status</th><th>Date</th></tr>${rows}</table>`;
        })
        .catch(() => {
            document.getElementById('bookingsTable').innerHTML = '<h2>Bookings</h2><p class="error">Could not load bookings data.</p>';
        });

    // Tour Bookings Table
    fetch('Backend/get_tour_bookings.php')
        .then(res => res.json())
        .then(data => {
            if (!data.tour_bookings || !data.tour_bookings.length) {
                document.getElementById('tourBookingsTable').innerHTML = '<h2>Tour Bookings</h2><p>No tour bookings found.</p>';
                return;
            }
            let rows = data.tour_bookings.map(t =>
                `<tr><td>${t.id}</td><td>${t.user_id}</td><td>${t.tour_name}</td><td>${t.tour_date}</td><td>${t.status}</td></tr>`
            ).join('');
            document.getElementById('tourBookingsTable').innerHTML =
                `<h2>Tour Bookings</h2><table><tr><th>ID</th><th>User</th><th>Tour</th><th>Date</th><th>Status</th></tr>${rows}</table>`;
        })
        .catch(() => {
            document.getElementById('tourBookingsTable').innerHTML = '<h2>Tour Bookings</h2><p class="error">Could not load tour bookings data.</p>';
        });

    // Users Table
    fetch('Backend/get_users.php')
        .then(res => res.json())
        .then(data => {
            if (!data.users || !data.users.length) {
                document.getElementById('usersTable').innerHTML = '<h2>Users</h2><p>No users found.</p>';
                return;
            }
            let rows = data.users.map(u =>
                `<tr><td>${u.id || u.user_id}</td><td>${u.username}</td><td>${u.email}</td><td>${u.role}</td><td>${u.created_at}</td></tr>`
            ).join('');
            document.getElementById('usersTable').innerHTML =
                `<h2>Users</h2><table><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th></tr>${rows}</table>`;
        })
        .catch(() => {
            document.getElementById('usersTable').innerHTML = '<h2>Users</h2><p class="error">Could not load users data.</p>';
        });

    // Services Table
    fetch('Backend/get_services.php')
        .then(res => res.json())
        .then(data => {
            if (!data.services || !data.services.length) {
                document.getElementById('servicesTable').innerHTML = '<h2>Services</h2><p>No services found.</p>';
                return;
            }
            let rows = data.services.map(s =>
                `<tr><td>${s.id || s.service_id}</td><td>${s.service_name}</td><td>${s.service_category}</td><td>${s.service_price}</td><td>${s.status || ''}</td></tr>`
            ).join('');
            document.getElementById('servicesTable').innerHTML =
                `<h2>Services</h2><table><tr><th>ID</th><th>Name</th><th>Category</th><th>Price</th><th>Status</th></tr>${rows}</table>`;
        })
        .catch(() => {
            document.getElementById('servicesTable').innerHTML = '<h2>Services</h2><p class="error">Could not load services data.</p>';
        });
    </script>
</body>
</html> 