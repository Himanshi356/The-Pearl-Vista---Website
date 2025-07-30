<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// Get request method and action
$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

// Function to generate session ID
function generateSessionId() {
    return uniqid('chat_', true);
}

// Function to get bot response
function getBotResponse($userMessage, $userName = 'Guest') {
    $message = strtolower(trim($userMessage));
    
    // Enhanced bot responses
    $responses = [
        'booking' => "I can help you with bookings! You can make a reservation through our website or call us at +59741122566 for immediate assistance. What type of room are you interested in?",
        'reservation' => "Great! I can assist with reservations. We have various room types available. Would you like to know about our rates or check availability for specific dates?",
        'price' => "Our room rates vary by season and room type. Standard rooms start from $150/night, Deluxe rooms from $250/night, and Suites from $400/night. Would you like to check availability?",
        'cost' => "Our room rates vary by season and room type. Standard rooms start from $150/night, Deluxe rooms from $250/night, and Suites from $400/night. Would you like to check availability?",
        'rate' => "Our room rates vary by season and room type. Standard rooms start from $150/night, Deluxe rooms from $250/night, and Suites from $400/night. Would you like to check availability?",
        'check in' => "Check-in time is 3:00 PM and check-out time is 11:00 AM. Early check-in and late check-out can be arranged based on availability. Do you need special arrangements?",
        'checkout' => "Check-in time is 3:00 PM and check-out time is 11:00 AM. Early check-in and late check-out can be arranged based on availability. Do you need special arrangements?",
        'amenity' => "We offer free WiFi, spa services, restaurant, swimming pool, fitness center, and 24/7 room service. All rooms include complimentary breakfast. What interests you most?",
        'facility' => "We offer free WiFi, spa services, restaurant, swimming pool, fitness center, and 24/7 room service. All rooms include complimentary breakfast. What interests you most?",
        'service' => "We offer free WiFi, spa services, restaurant, swimming pool, fitness center, and 24/7 room service. All rooms include complimentary breakfast. What interests you most?",
        'wifi' => "Yes, we provide complimentary high-speed WiFi throughout the hotel. The password is provided at check-in.",
        'spa' => "Our spa offers various treatments including massages, facials, and wellness therapies. Appointments can be made at the front desk or through our website.",
        'restaurant' => "We have an on-site restaurant serving breakfast, lunch, and dinner. We also offer room service 24/7. Our cuisine features both local and international dishes.",
        'pool' => "We have a beautiful outdoor swimming pool open from 6 AM to 10 PM. Towels are provided poolside.",
        'location' => "We're located in Trees Valley, New York, with easy access to major attractions. We're 15 minutes from downtown and 20 minutes from the airport. Would you like directions?",
        'address' => "We're located in Trees Valley, New York, with easy access to major attractions. We're 15 minutes from downtown and 20 minutes from the airport. Would you like directions?",
        'where' => "We're located in Trees Valley, New York, with easy access to major attractions. We're 15 minutes from downtown and 20 minutes from the airport. Would you like directions?",
        'hello' => "Hello $userName! How can I assist you with your stay at Pearl Vista today?",
        'hi' => "Hi $userName! How can I assist you with your stay at Pearl Vista today?",
        'hey' => "Hey $userName! How can I assist you with your stay at Pearl Vista today?",
        'help' => "I'm here to help! I can assist with bookings, room information, amenities, location, and general inquiries. What would you like to know?",
        'contact' => "You can reach us at +59741122566 or email us at info@thepearlvista.co. We're available 24/7 for your convenience.",
        'phone' => "You can reach us at +59741122566. We're available 24/7 for your convenience.",
        'email' => "You can email us at info@thepearlvista.co. We typically respond within 2 hours.",
        'hours' => "Our front desk is open 24/7. Check-in time is 3:00 PM and check-out time is 11:00 AM. Restaurant hours are 6:30 AM to 10:00 PM.",
        'time' => "Our front desk is open 24/7. Check-in time is 3:00 PM and check-out time is 11:00 AM. Restaurant hours are 6:30 AM to 10:00 PM.",
        'parking' => "We offer complimentary parking for all guests. Valet parking is also available for an additional fee.",
        'transport' => "We can arrange airport transfers and local transportation. Please contact the front desk at least 24 hours in advance.",
        'shuttle' => "We offer airport shuttle service. Please contact the front desk at least 24 hours in advance to arrange pickup.",
        'cancellation' => "Cancellation policies vary by rate type. Most bookings can be cancelled up to 24 hours before arrival without penalty. Please check your booking confirmation for specific terms.",
        'refund' => "Refund policies depend on your booking type and cancellation timing. Please contact our reservations team for specific information about your booking.",
        'payment' => "We accept all major credit cards, debit cards, and cash. Payment is typically required at check-in.",
        'credit card' => "We accept all major credit cards including Visa, MasterCard, American Express, and Discover. Payment is typically required at check-in.",
        'breakfast' => "Complimentary breakfast is included with all room bookings. It's served from 6:30 AM to 10:30 AM in our restaurant.",
        'food' => "We have an on-site restaurant serving breakfast, lunch, and dinner. We also offer room service 24/7. Our cuisine features both local and international dishes.",
        'dining' => "We have an on-site restaurant serving breakfast, lunch, and dinner. We also offer room service 24/7. Our cuisine features both local and international dishes.",
        'room service' => "Room service is available 24/7. You can order through the phone in your room or through our mobile app.",
        'wifi password' => "WiFi passwords are provided at check-in. If you need the password, please contact the front desk.",
        'internet' => "We provide complimentary high-speed WiFi throughout the hotel. The password is provided at check-in.",
        'gym' => "We have a fully equipped fitness center open 24/7. It includes cardio machines, free weights, and yoga equipment.",
        'fitness' => "We have a fully equipped fitness center open 24/7. It includes cardio machines, free weights, and yoga equipment.",
        'workout' => "We have a fully equipped fitness center open 24/7. It includes cardio machines, free weights, and yoga equipment.",
        'business' => "We have meeting rooms and business facilities available. Please contact our events team for availability and pricing.",
        'meeting' => "We have meeting rooms and business facilities available. Please contact our events team for availability and pricing.",
        'conference' => "We have meeting rooms and business facilities available. Please contact our events team for availability and pricing.",
        'event' => "We have meeting rooms and business facilities available. Please contact our events team for availability and pricing.",
        'wedding' => "We offer wedding and event services. Please contact our events team for packages and availability.",
        'party' => "We offer event services for various occasions. Please contact our events team for packages and availability.",
        'pet' => "We are pet-friendly! There's a $50 pet fee per stay. Please let us know in advance if you're bringing a pet.",
        'dog' => "We are pet-friendly! There's a $50 pet fee per stay. Please let us know in advance if you're bringing a pet.",
        'cat' => "We are pet-friendly! There's a $50 pet fee per stay. Please let us know in advance if you're bringing a pet.",
        'accessibility' => "We have accessible rooms and facilities available. Please let us know your specific needs when booking.",
        'wheelchair' => "We have accessible rooms and facilities available. Please let us know your specific needs when booking.",
        'disabled' => "We have accessible rooms and facilities available. Please let us know your specific needs when booking.",
        'smoking' => "We are a non-smoking hotel. Smoking is not permitted in any rooms or indoor areas. Designated smoking areas are available outside.",
        'smoke' => "We are a non-smoking hotel. Smoking is not permitted in any rooms or indoor areas. Designated smoking areas are available outside.",
        'thank' => "You're welcome! Is there anything else I can help you with?",
        'thanks' => "You're welcome! Is there anything else I can help you with?",
        'goodbye' => "Thank you for chatting with us! Have a wonderful day and we hope to see you at Pearl Vista soon!",
        'bye' => "Thank you for chatting with us! Have a wonderful day and we hope to see you at Pearl Vista soon!"
    ];
    
    // Check for specific keywords
    foreach ($responses as $keyword => $response) {
        if (strpos($message, $keyword) !== false) {
            return $response;
        }
    }
    
    // Default response for unrecognized messages
    return "Thank you for your message! For detailed assistance, please use our contact form or call us at +59741122566. Our team will be happy to help!";
}

// Handle different actions
switch ($action) {
    case 'send_message':
        if ($method === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            
            $sessionId = isset($input['session_id']) ? $input['session_id'] : '';
            $userName = isset($input['user_name']) ? $input['user_name'] : 'Guest';
            $message = isset($input['message']) ? trim($input['message']) : '';
            
            if (empty($sessionId) || empty($message)) {
                http_response_code(400);
                echo json_encode(['error' => 'Session ID and message are required']);
                exit();
            }
            
            // Insert user message
            $stmt = $conn->prepare("INSERT INTO chat_messages (session_id, user_name, message, message_type) VALUES (?, ?, ?, 'user')");
            $stmt->bind_param("sss", $sessionId, $userName, $message);
            
            if (!$stmt->execute()) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to save user message']);
                exit();
            }
            
            // Get bot response
            $botResponse = getBotResponse($message, $userName);
            
            // Insert bot response
            $stmt = $conn->prepare("INSERT INTO chat_messages (session_id, user_name, message, message_type) VALUES (?, 'Pearl Vista', ?, 'bot')");
            $stmt->bind_param("ss", $sessionId, $botResponse);
            
            if (!$stmt->execute()) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to save bot response']);
                exit();
            }
            
            echo json_encode([
                'success' => true,
                'user_message' => $message,
                'bot_response' => $botResponse
            ]);
        }
        break;
        
    case 'get_messages':
        if ($method === 'GET') {
            $sessionId = isset($_GET['session_id']) ? $_GET['session_id'] : '';
            
            if (empty($sessionId)) {
                http_response_code(400);
                echo json_encode(['error' => 'Session ID is required']);
                exit();
            }
            
            $stmt = $conn->prepare("SELECT * FROM chat_messages WHERE session_id = ? ORDER BY created_at ASC");
            $stmt->bind_param("s", $sessionId);
            $stmt->execute();
            $result = $stmt->get_result();
            
            $messages = [];
            while ($row = $result->fetch_assoc()) {
                $messages[] = [
                    'id' => $row['id'],
                    'message' => $row['message'],
                    'message_type' => $row['message_type'],
                    'user_name' => $row['user_name'],
                    'created_at' => $row['created_at']
                ];
            }
            
            echo json_encode(['messages' => $messages]);
        }
        break;
        
    case 'create_session':
        if ($method === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            
            $sessionId = generateSessionId();
            $userName = isset($input['user_name']) ? $input['user_name'] : 'Guest';
            $userEmail = isset($input['user_email']) ? $input['user_email'] : '';
            
            // Check if user already has an active session
            $stmt = $conn->prepare("SELECT session_id FROM chat_sessions WHERE user_name = ? AND status = 'active' ORDER BY created_at DESC LIMIT 1");
            $stmt->bind_param("s", $userName);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Return existing session
                $existingSession = $result->fetch_assoc();
                $sessionId = $existingSession['session_id'];
                
                echo json_encode([
                    'success' => true,
                    'session_id' => $sessionId,
                    'existing_session' => true
                ]);
                exit();
            }
            
            // Insert new session
            $stmt = $conn->prepare("INSERT INTO chat_sessions (session_id, user_name, user_email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $sessionId, $userName, $userEmail);
            
            if (!$stmt->execute()) {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to create chat session']);
                exit();
            }
            
            // Add welcome message only for new sessions
            $welcomeMessage = "Hello! Welcome to Pearl Vista. How can I assist you today?";
            $stmt = $conn->prepare("INSERT INTO chat_messages (session_id, user_name, message, message_type) VALUES (?, 'Pearl Vista', ?, 'bot')");
            $stmt->bind_param("ss", $sessionId, $welcomeMessage);
            $stmt->execute();
            
            echo json_encode([
                'success' => true,
                'session_id' => $sessionId,
                'welcome_message' => $welcomeMessage
            ]);
        }
        break;
        
    case 'close_session':
        if ($method === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            $sessionId = isset($input['session_id']) ? $input['session_id'] : '';
            
            if (empty($sessionId)) {
                http_response_code(400);
                echo json_encode(['error' => 'Session ID is required']);
                exit();
            }
            
            $stmt = $conn->prepare("UPDATE chat_sessions SET status = 'closed' WHERE session_id = ?");
            $stmt->bind_param("s", $sessionId);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to close session']);
            }
        }
        break;
        
    case 'get_sessions':
        if ($method === 'GET') {
            $stmt = $conn->prepare("SELECT * FROM chat_sessions ORDER BY created_at DESC");
            $stmt->execute();
            $result = $stmt->get_result();
            
            $sessions = [];
            while ($row = $result->fetch_assoc()) {
                $sessions[] = [
                    'session_id' => $row['session_id'],
                    'user_name' => $row['user_name'],
                    'user_email' => $row['user_email'],
                    'status' => $row['status'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at']
                ];
            }
            
            echo json_encode(['sessions' => $sessions]);
        }
        break;
        
    case 'get_stats':
        if ($method === 'GET') {
            // Get total sessions
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM chat_sessions");
            $stmt->execute();
            $totalSessions = $stmt->get_result()->fetch_assoc()['total'];
            
            // Get active sessions
            $stmt = $conn->prepare("SELECT COUNT(*) as active FROM chat_sessions WHERE status = 'active'");
            $stmt->execute();
            $activeSessions = $stmt->get_result()->fetch_assoc()['active'];
            
            // Get total messages
            $stmt = $conn->prepare("SELECT COUNT(*) as total FROM chat_messages");
            $stmt->execute();
            $totalMessages = $stmt->get_result()->fetch_assoc()['total'];
            
            echo json_encode([
                'stats' => [
                    'total_sessions' => $totalSessions,
                    'active_sessions' => $activeSessions,
                    'total_messages' => $totalMessages
                ]
            ]);
        }
        break;
        
    case 'send_admin_message':
        if ($method === 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);
            
            $sessionId = isset($input['session_id']) ? $input['session_id'] : '';
            $message = isset($input['message']) ? trim($input['message']) : '';
            
            if (empty($sessionId) || empty($message)) {
                http_response_code(400);
                echo json_encode(['error' => 'Session ID and message are required']);
                exit();
            }
            
            // Insert admin message
            $stmt = $conn->prepare("INSERT INTO chat_messages (session_id, user_name, message, message_type) VALUES (?, 'Admin', ?, 'bot')");
            $stmt->bind_param("ss", $sessionId, $message);
            
            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Failed to send admin message']);
            }
        }
        break;
        
    default:
        http_response_code(400);
        echo json_encode(['error' => 'Invalid action']);
        break;
}

$conn->close();
?> 