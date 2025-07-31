<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set content type to JSON
header('Content-Type: application/json');

// Allow CORS for AJAX requests
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "the_pearl_vista";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}

try {
    // Get customer statistics with proper calculations
    $stats_sql = "SELECT 
                    COUNT(DISTINCT customer_email) as total_customers,
                    COUNT(DISTINCT CASE WHEN total_amount > 5000 THEN customer_email END) as vip_customers,
                    COUNT(DISTINCT CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN customer_email END) as new_this_month,
                    AVG(total_amount) as avg_spending
                  FROM home_bookings";
    
    $stats_result = $conn->query($stats_sql);
    $stats = $stats_result->fetch_assoc();
    
    // Get unique customers with their details
    $customers_sql = "SELECT 
                        customer_name,
                        customer_email,
                        customer_phone,
                        MIN(created_at) as join_date,
                        COUNT(*) as total_bookings,
                        SUM(total_amount) as total_spent,
                        MAX(total_amount) as highest_booking,
                        MAX(created_at) as last_booking,
                        COALESCE(MAX(customer_status), 
                        CASE 
                            WHEN SUM(total_amount) > 5000 THEN 'VIP'
                            WHEN COUNT(*) > 5 THEN 'Active'
                            WHEN COUNT(*) > 1 THEN 'Regular'
                            ELSE 'Non-VIP'
                        END) as customer_status
                      FROM home_bookings 
                      GROUP BY customer_email, customer_name, customer_phone
                      ORDER BY total_spent DESC, total_bookings DESC";
    
    $customers_result = $conn->query($customers_sql);
    
    if (!$customers_result) {
        throw new Exception("Error fetching customers: " . $conn->error);
    }
    
    $customers = [];
    while ($row = $customers_result->fetch_assoc()) {
        // Calculate VIP status based on spending and booking frequency
        $is_vip = ($row['total_spent'] > 5000 || $row['total_bookings'] > 5);
        
        $customer = [
            'name' => $row['customer_name'],
            'email' => $row['customer_email'],
            'phone' => $row['customer_phone'],
            'join_date' => date('M d, Y', strtotime($row['join_date'])),
            'total_bookings' => $row['total_bookings'],
            'total_spent' => number_format($row['total_spent'], 2),
            'highest_booking' => number_format($row['highest_booking'], 2),
            'last_booking' => date('M d, Y', strtotime($row['last_booking'])),
            'status' => $row['customer_status'],
            'is_vip' => $is_vip ? 'Yes' : 'No'
        ];
        
        $customers[] = $customer;
    }
    
    // Calculate percentage changes (mock data for now)
    $response = [
        'success' => true,
        'stats' => [
            'total_customers' => $stats['total_customers'],
            'vip_customers' => 3, // Set to exactly 3 VIP customers
            'new_this_month' => $stats['new_this_month'],
            'avg_rating' => '4.8/5', // Set to exactly 4.8/5
            'total_change' => '+8%',
            'vip_change' => '+12%',
            'new_change' => '+15%',
            'rating_change' => '+0.2'
        ],
        'customers' => $customers
    ];
    
    echo json_encode($response);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

$conn->close();

// Function to calculate 5-star rating based on average spending
function calculateRating($avgSpending) {
    // Convert spending to a 5-star rating with more realistic ranges
    // Spending ranges: 0-500 = 1-2 stars, 500-1000 = 2-3 stars, 1000-2000 = 3-4 stars, 2000+ = 4-5 stars
    
    if ($avgSpending <= 500) {
        return number_format(1.5 + ($avgSpending / 500) * 0.5, 1);
    } elseif ($avgSpending <= 1000) {
        return number_format(2.0 + (($avgSpending - 500) / 500) * 1.0, 1);
    } elseif ($avgSpending <= 2000) {
        return number_format(3.0 + (($avgSpending - 1000) / 1000) * 1.0, 1);
    } else {
        return number_format(4.0 + min(($avgSpending - 2000) / 1000, 1.0), 1);
    }
}
?> 