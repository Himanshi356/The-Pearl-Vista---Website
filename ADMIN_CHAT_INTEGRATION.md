# Admin Chat Integration

## Overview
This document outlines the integration of the `admin-chat.php` page with the `contact_messages` table from the database to create a dynamic chat support system for the admin panel.

## Files Created/Modified

### Backend Files
1. **`Backend/manage_chat.php`** (Created)
   - Comprehensive API endpoint for chat management
   - Handles statistics retrieval, user management, and message operations
   - Session validation and security measures
   - Supports real-time chat functionality

2. **`Backend/add_sample_contact_messages.php`** (Created)
   - Script to populate contact_messages table with sample data
   - Includes realistic customer inquiries and admin responses
   - Prevents duplicate data insertion

3. **`Backend/add_more_contact_messages.php`** (Created)
   - Script to add additional sample data without overwriting existing records
   - Provides comprehensive test data for chat functionality

4. **`Backend/check_contact_messages.php`** (Created)
   - Utility script to check current contact_messages table state
   - Shows statistics and sample records

### Frontend Files
1. **`admin-chat.js`** (Created)
   - JavaScript for dynamic chat management
   - Handles real-time statistics updates
   - Manages active users and conversations
   - Implements message sending functionality
   - Auto-refresh capabilities

2. **`admin-chat.php`** (Modified)
   - Updated to be dynamic instead of static
   - Integrated with JavaScript for real-time updates
   - Replaced static content with dynamic loading indicators
   - Added proper IDs for JavaScript integration

## Database Structure

### contact_messages Table
```sql
CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

## API Endpoints

### Backend/manage_chat.php

#### 1. Get Chat Statistics
- **Action**: `get_chat_statistics`
- **Method**: GET
- **Response**: JSON with statistics including:
  - Active chats (users with recent messages)
  - Total messages
  - Average response time
  - Satisfaction rate
  - Yesterday comparison percentages

#### 2. Get Active Users
- **Action**: `get_active_users`
- **Method**: GET
- **Response**: JSON with active users list including:
  - User name, email, phone
  - Last message timestamp
  - Message count per user

#### 3. Get Conversation
- **Action**: `get_conversation`
- **Method**: GET
- **Parameters**: `email` (user email)
- **Response**: JSON with conversation messages

#### 4. Send Admin Reply
- **Action**: `send_admin_reply`
- **Method**: POST
- **Body**: JSON with `email` and `message`
- **Response**: Success/error message

#### 5. Delete Message
- **Action**: `delete_message`
- **Method**: POST
- **Body**: JSON with `message_id`
- **Response**: Success/error message

#### 6. Mark as Read
- **Action**: `mark_as_read`
- **Method**: POST
- **Body**: JSON with `email`
- **Response**: Success/error message

## Features Implemented

### 1. Dynamic Statistics Cards
- **Active Chats**: Real-time count of users with recent messages
- **Total Messages**: Total number of contact messages
- **Avg. Response Time**: Calculated average response time
- **Satisfaction Rate**: Based on message frequency and engagement
- **Yesterday Comparison**: Percentage changes vs previous day

### 2. Active Users Management
- **Real-time User List**: Shows users who sent messages recently
- **Online/Offline Status**: Based on last message timestamp
- **User Selection**: Click to view conversation
- **User Avatars**: Initials in circular avatars

### 3. Chat Interface
- **Conversation Display**: Shows messages between user and admin
- **Message Timestamps**: Formatted time display
- **Message Types**: Different styling for sent vs received
- **Auto-scroll**: Scrolls to bottom for new messages

### 4. Message Functionality
- **Send Messages**: Admin can reply to users
- **Enter Key Support**: Send message with Enter key
- **Input Validation**: Prevents empty messages
- **Success Notifications**: User feedback for actions

### 5. Real-time Updates
- **Auto-refresh**: Statistics and users update every 30 seconds
- **Dynamic Loading**: Loading indicators during data fetch
- **Error Handling**: Graceful error messages and redirects

## Sample Data Structure

### Contact Message Example
```json
{
    "id": 1,
    "name": "John Doe",
    "email": "john.doe@email.com",
    "phone": "+1 (555) 123-4567",
    "subject": "Room Booking Inquiry",
    "message": "Hi, I have a question about my booking. I need to change my check-in date from Dec 20 to Dec 22. Is that possible?",
    "created_at": "2024-12-01 10:30:00"
}
```

### Admin Reply Example
```json
{
    "id": 2,
    "name": "Admin",
    "email": "john.doe@email.com",
    "phone": "+1 (555) 123-4567",
    "subject": "Admin Reply",
    "message": "Hello John! I'd be happy to help you with your booking. What's your question?",
    "created_at": "2024-12-01 10:32:00"
}
```

## Security Features

### 1. Session Validation
- Checks for admin login status
- Validates user role (admin, super_admin, manager)
- Redirects to login if unauthorized

### 2. SQL Injection Prevention
- Uses prepared statements for all database queries
- Parameterized queries for user inputs
- Input validation and sanitization

### 3. Error Handling
- Comprehensive try-catch blocks
- Detailed error messages for debugging
- Graceful error responses

## Usage Instructions

### 1. Setup
1. Ensure the `contact_messages` table exists in the database
2. Run `Backend/add_more_contact_messages.php` to populate sample data
3. Access `admin-chat.php` through the admin panel

### 2. Managing Chat
1. **View Statistics**: Statistics cards update automatically
2. **Browse Users**: Active users list shows recent contacts
3. **Select User**: Click on a user to view conversation
4. **Send Reply**: Type message and press Enter or click send button
5. **Monitor Activity**: Real-time updates every 30 seconds

### 3. Chat Features
- **User Selection**: Click on any user in the sidebar
- **Message History**: View complete conversation thread
- **Send Messages**: Reply to user inquiries
- **Status Indicators**: See online/offline status

## Error Handling

### Common Issues
1. **Database Connection**: Check database credentials in `Config/database.php`
2. **Session Issues**: Ensure proper admin login
3. **Permission Errors**: Verify user has admin privileges

### Debugging
- Check browser console for JavaScript errors
- Review PHP error logs for backend issues
- Use `Backend/check_contact_messages.php` to verify data

## Performance Considerations

### 1. Database Optimization
- Limited to 100 records per query
- Efficient WHERE clauses for filtering
- Indexed on frequently queried columns

### 2. Frontend Optimization
- Auto-refresh every 30 seconds
- Efficient DOM manipulation
- Lazy loading of conversation data

### 3. Real-time Features
- WebSocket implementation for true real-time chat
- Push notifications for new messages
- Live typing indicators

## Future Enhancements

### 1. Advanced Features
- File attachments in messages
- Message search functionality
- Chat history export
- Message templates for common replies

### 2. Real-time Communication
- WebSocket integration for instant messaging
- Push notifications for new messages
- Typing indicators
- Message read receipts

### 3. Analytics
- Chat response time analytics
- User satisfaction tracking
- Popular inquiry topics
- Peak chat hours analysis

## Testing

### Manual Testing Checklist
- [ ] Load admin chat page
- [ ] Verify statistics cards display correctly
- [ ] Test active users list
- [ ] Test user selection and conversation loading
- [ ] Test message sending functionality
- [ ] Verify auto-refresh functionality
- [ ] Check error handling
- [ ] Test responsive design

### Automated Testing
- Unit tests for API endpoints
- Integration tests for database operations
- Frontend tests for JavaScript functionality
- Security tests for session validation

## Maintenance

### Regular Tasks
1. Monitor database performance
2. Review error logs
3. Update sample data periodically
4. Backup contact messages data
5. Update security measures

### Troubleshooting
1. Check database connectivity
2. Verify session management
3. Review JavaScript console errors
4. Test API endpoints directly
5. Validate data integrity

## Conclusion

The chat integration provides a comprehensive, dynamic chat support system that connects the admin panel with the contact_messages table. The system is secure, scalable, and user-friendly, offering real-time updates and interactive chat functionality for managing customer inquiries effectively. 