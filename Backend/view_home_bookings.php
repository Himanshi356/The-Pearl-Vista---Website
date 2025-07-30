<?php
// Admin page to view home bookings
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pearlvista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle status updates
if (isset($_POST['update_status'])) {
    $booking_id = $_POST['booking_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $conn->prepare("UPDATE home_bookings SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $booking_id);
    
    if ($stmt->execute()) {
        $message = "Status updated successfully!";
    } else {
        $error = "Error updating status: " . $stmt->error;
    }
    $stmt->close();
}

// Get all bookings
$sql = "SELECT * FROM home_bookings ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Bookings - Admin Panel</title>
    <style>
        body {
            font-family: 'Lato', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: #1a1a1a;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2rem;
            font-weight: 700;
        }
        .content {
            padding: 20px;
        }
        .message {
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            font-weight: 600;
        }
        .success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #f8f9fa;
            font-weight: 700;
            color: #1a1a1a;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .status-pending {
            color: #856404;
            background: #fff3cd;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .status-confirmed {
            color: #155724;
            background: #d4edda;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .status-cancelled {
            color: #721c24;
            background: #f8d7da;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .action-btn {
            background: #d4af37;
            color: #222;
            border: none;
            padding: 6px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin: 2px;
        }
        .action-btn:hover {
            background: #bfa13a;
            color: white;
        }
        .details-btn {
            background: #007bff;
            color: white;
        }
        .details-btn:hover {
            background: #0056b3;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 20px;
            border-radius: 12px;
            width: 80%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }
        .close:hover {
            color: #000;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: 700;
            color: #1a1a1a;
            min-width: 150px;
        }
        .detail-value {
            color: #666;
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Home Bookings - Admin Panel</h1>
        </div>
        
        <div class="content">
            <?php if (isset($message)): ?>
                <div class="message success"><?php echo $message; ?></div>
            <?php endif; ?>
            
            <?php if (isset($error)): ?>
                <div class="message error"><?php echo $error; ?></div>
            <?php endif; ?>
            
            <h2>All Bookings (<?php echo $result->num_rows; ?> total)</h2>
            
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Room Type</th>
                            <th>Check-in</th>
                            <th>Check-out</th>
                            <th>Guests</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><strong><?php echo htmlspecialchars($row['booking_id']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['customer_email']); ?></td>
                                <td><?php echo htmlspecialchars($row['customer_phone']); ?></td>
                                <td><?php echo htmlspecialchars($row['room_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['check_in_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['check_out_date']); ?></td>
                                <td><?php echo htmlspecialchars($row['num_guests']); ?></td>
                                <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
                                <td>
                                    <span class="status-<?php echo $row['status']; ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M j, Y', strtotime($row['created_at'])); ?></td>
                                <td>
                                    <button class="action-btn details-btn" onclick="showDetails(<?php echo htmlspecialchars(json_encode($row)); ?>)">
                                        Details
                                    </button>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="booking_id" value="<?php echo $row['id']; ?>">
                                        <select name="new_status" style="padding: 4px; margin: 2px;">
                                            <option value="pending" <?php echo $row['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                                            <option value="confirmed" <?php echo $row['status'] == 'confirmed' ? 'selected' : ''; ?>>Confirmed</option>
                                            <option value="cancelled" <?php echo $row['status'] == 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                                        </select>
                                        <button type="submit" name="update_status" class="action-btn">Update</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No bookings found.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Booking Details</h2>
            <div id="bookingDetails"></div>
        </div>
    </div>
    
    <script>
        function showDetails(booking) {
            const modal = document.getElementById('detailsModal');
            const detailsDiv = document.getElementById('bookingDetails');
            
            detailsDiv.innerHTML = `
                <div class="detail-row">
                    <span class="detail-label">Booking ID:</span>
                    <span class="detail-value">${booking.booking_id}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Customer Name:</span>
                    <span class="detail-value">${booking.customer_name}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email:</span>
                    <span class="detail-value">${booking.customer_email}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone:</span>
                    <span class="detail-value">${booking.customer_phone}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">ID Type:</span>
                    <span class="detail-value">${booking.id_type || 'Not provided'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Room Type:</span>
                    <span class="detail-value">${booking.room_type}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-in Date:</span>
                    <span class="detail-value">${booking.check_in_date}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Check-out Date:</span>
                    <span class="detail-value">${booking.check_out_date}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Rooms:</span>
                    <span class="detail-value">${booking.num_rooms}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Number of Guests:</span>
                    <span class="detail-value">${booking.num_guests}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Guest Ages:</span>
                    <span class="detail-value">${booking.guest_ages || 'Not specified'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Total Amount:</span>
                    <span class="detail-value">$${parseFloat(booking.total_amount).toFixed(2)}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Special Instructions:</span>
                    <span class="detail-value">${booking.special_instructions || 'None'}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Status:</span>
                    <span class="detail-value">${booking.status}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Created:</span>
                    <span class="detail-value">${new Date(booking.created_at).toLocaleString()}</span>
                </div>
            `;
            
            modal.style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('detailsModal').style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('detailsModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
