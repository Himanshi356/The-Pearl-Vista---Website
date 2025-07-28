# Pearl Vista Hotel - Real-Time Chat System Documentation

## Overview

The Pearl Vista Hotel website now features a comprehensive real-time chat system that allows visitors to interact with an intelligent chatbot for instant customer support. The system includes both frontend user interface and backend admin panel for managing chat sessions.

## 🚀 Features Implemented

### ✅ **Real-Time Chat Functionality**
- **Live Chat Widget**: Floating chat button on all pages
- **Intelligent Bot Responses**: Context-aware responses based on user queries
- **Session Management**: Persistent chat sessions with database storage
- **User Authentication**: Integration with existing user system
- **Fallback System**: Works even when API is unavailable

### ✅ **Admin Panel**
- **Chat Session Management**: View all active and closed chat sessions
- **Real-Time Monitoring**: Live updates of chat activities
- **Admin Responses**: Ability to send messages as admin
- **Session Statistics**: Dashboard with chat metrics
- **Session Control**: Close sessions and manage user interactions

### ✅ **Database Integration**
- **Message Storage**: All chat messages stored in database
- **Session Tracking**: Complete chat session history
- **User Analytics**: Track user interactions and patterns
- **Data Persistence**: Messages and sessions persist across sessions

## 🗄️ Database Structure

### `chat_messages` Table
```sql
CREATE TABLE chat_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) NOT NULL,
    user_name VARCHAR(255) DEFAULT 'Guest',
    message TEXT NOT NULL,
    message_type ENUM('user', 'bot') DEFAULT 'user',
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_session_id (session_id),
    INDEX idx_created_at (created_at)
);
```

### `chat_sessions` Table
```sql
CREATE TABLE chat_sessions (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    session_id VARCHAR(255) UNIQUE NOT NULL,
    user_name VARCHAR(255) DEFAULT 'Guest',
    user_email VARCHAR(255),
    status ENUM('active', 'closed') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_session_id (session_id),
    INDEX idx_status (status)
);
```

## 🔧 Technical Implementation

### Frontend Components

#### 1. **Chat Widget** (`contact_us.html`)
```javascript
// Key Features:
- Floating chat button
- Expandable chat interface
- Real-time message display
- Session management
- User authentication integration
```

#### 2. **Admin Panel** (`admin-chat.html`)
```javascript
// Key Features:
- Session list with real-time updates
- Message history viewer
- Admin response capability
- Statistics dashboard
- Session control tools
```

### Backend API (`php/chat_api.php`)

#### Available Endpoints:
- `GET /chat_api.php?action=get_messages&session_id={id}` - Retrieve chat messages
- `POST /chat_api.php?action=send_message` - Send user message
- `POST /chat_api.php?action=create_session` - Create new chat session
- `POST /chat_api.php?action=close_session` - Close chat session
- `GET /chat_api.php?action=get_sessions` - Get all sessions (admin)
- `GET /chat_api.php?action=get_stats` - Get chat statistics (admin)
- `POST /chat_api.php?action=send_admin_message` - Send admin message

## 🤖 Bot Intelligence

### Smart Response System
The chatbot can handle various types of inquiries:

#### **Booking & Reservations**
- Room availability
- Pricing information
- Reservation process
- Check-in/check-out times

#### **Hotel Services**
- Amenities and facilities
- Restaurant information
- Spa services
- Room service

#### **Location & Transportation**
- Hotel location
- Directions
- Airport transfers
- Local transportation

#### **General Support**
- Contact information
- Operating hours
- Payment methods
- Cancellation policies

### Response Categories:
```php
$responses = [
    'booking' => "I can help you with bookings!...",
    'reservation' => "Great! I can assist with reservations...",
    'price' => "Our room rates vary by season...",
    'amenity' => "We offer free WiFi, spa services...",
    'location' => "We're located in Trees Valley...",
    'hello' => "Hello $userName! How can I assist you...",
    // ... 40+ more responses
];
```

## 📊 Admin Features

### **Session Management**
- View all chat sessions (active/closed)
- Real-time session updates
- Session statistics
- User information tracking

### **Message Monitoring**
- Live message viewing
- Message history per session
- User interaction patterns
- Response time tracking

### **Admin Actions**
- Send responses as admin
- Close chat sessions
- View session analytics
- Export chat data

## 🔄 Real-Time Communication

### **Polling System**
- Frontend polls for new messages every 5 seconds
- Admin panel updates every 30 seconds
- Efficient database queries with indexing
- Minimal server load

### **Session Persistence**
- Chat sessions persist across page refreshes
- User authentication integration
- Session recovery for returning users
- Cross-device session support

## 🛠️ Setup Instructions

### 1. **Database Setup**
```bash
# Run the database setup script
http://localhost/Pearl-Vista---Website/php/setup_database.php
```

### 2. **Test Database Connection**
```bash
# Test the database connection
http://localhost/Pearl-Vista---Website/php/test_connection.php
```

### 3. **Verify Chat API**
```bash
# Test the chat API endpoints
http://localhost/Pearl-Vista---Website/php/chat_api.php?action=get_stats
```

## 🎯 Usage Examples

### **For Users:**
1. Click the "Chat with us" button on any page
2. Type your question (e.g., "I want to book a room")
3. Receive instant intelligent response
4. Continue conversation naturally
5. Chat session persists across page navigation

### **For Admins:**
1. Access admin panel: `admin-chat.html`
2. View active chat sessions
3. Click on any session to view messages
4. Send admin responses using "Reply" button
5. Monitor chat statistics and user interactions

## 🔒 Security Features

### **Input Validation**
- All user inputs are sanitized
- SQL injection prevention with prepared statements
- XSS protection through proper encoding
- Session validation and authentication

### **Data Protection**
- Secure database connections
- User privacy protection
- Session timeout handling
- Secure admin access controls

## 📈 Performance Optimizations

### **Database Optimization**
- Indexed queries for fast retrieval
- Efficient message storage
- Session cleanup for old data
- Optimized polling intervals

### **Frontend Optimization**
- Minimal API calls
- Efficient DOM updates
- Responsive design
- Cross-browser compatibility

## 🚀 Advanced Features (Optional)

### **WebSocket Server** (`php/websocket_server.php`)
For true real-time communication:
```bash
# Start WebSocket server
php php/websocket_server.php
```

### **Enhanced Features**
- True real-time messaging
- Typing indicators
- File sharing capability
- Voice message support
- Multi-language support

## 🐛 Troubleshooting

### **Common Issues:**

1. **Chat not loading**
   - Check XAMPP services (Apache, MySQL)
   - Verify database connection
   - Check browser console for errors

2. **Messages not sending**
   - Verify PHP error logs
   - Check database permissions
   - Ensure API endpoints are accessible

3. **Admin panel not working**
   - Verify admin authentication
   - Check API permissions
   - Ensure database tables exist

### **Debug Tools:**
- Browser Developer Tools
- PHP error logs
- Database connection test
- API endpoint testing

## 📞 Support

For technical support or feature requests:
- Check the troubleshooting section
- Review error logs
- Test database connections
- Verify API endpoints

## 🔄 Future Enhancements

### **Planned Features:**
- Human agent handoff
- Advanced analytics dashboard
- Multi-language support
- Voice chat integration
- Mobile app integration
- AI-powered sentiment analysis

### **Scalability:**
- Load balancing support
- Redis caching integration
- Microservices architecture
- Cloud deployment ready

---

**Last Updated:** January 2025  
**Version:** 1.0  
**Compatibility:** PHP 7.4+, MySQL 5.7+, Modern Browsers 