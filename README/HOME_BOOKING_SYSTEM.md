# Home Booking System - Implementation Documentation

## Overview
The home booking system has been successfully connected to the backend, allowing users to submit room bookings through the home page form. The system maintains the current styling and logic while adding robust backend functionality.

## Files Created/Modified

### Backend Files
1. **`php/home_booking_process.php`** - Main backend handler for form submissions
2. **`php/test_home_booking.php`** - Test file to verify backend functionality
3. **`php/view_home_bookings.php`** - Admin panel to view and manage bookings

### Frontend Files
1. **`home.html`** - Updated with AJAX form submission and enhanced validation
2. **`uploads/`** - Directory for file uploads (ID documents)

## Database Schema

### `home_bookings` Table
```sql
CREATE TABLE home_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    id_type VARCHAR(100),
    id_upload_path VARCHAR(500),
    num_rooms INT(11) NOT NULL DEFAULT 1,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_guests INT(11) NOT NULL DEFAULT 1,
    guest_ages TEXT,
    room_type VARCHAR(100) NOT NULL,
    total_amount DECIMAL(10,2) DEFAULT 0.00,
    special_instructions TEXT,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    booking_id VARCHAR(20) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Features Implemented

### 1. Form Validation
- **Required Fields**: Name, phone, email, check-in/out dates, room type
- **Email Validation**: Proper email format verification
- **Phone Validation**: Basic phone number format checking
- **Date Validation**: Ensures check-out is after check-in and dates are not in the past
- **Guest/Room Limits**: Maximum 10 guests/rooms, minimum 1

### 2. File Upload Support
- **ID Document Upload**: Supports PDF and image files (JPG, PNG)
- **File Size Limit**: Maximum 5MB
- **Secure Storage**: Files stored in `uploads/` directory with unique names
- **File Type Validation**: Only allowed file types accepted

### 3. Dynamic Form Features
- **Guest Ages**: Dynamic input fields based on number of guests
- **Date Constraints**: Minimum dates set to prevent past bookings
- **ID Upload**: Conditional file upload based on ID type selection

### 4. Backend Processing
- **Unique Booking IDs**: Generated automatically (format: PV + year + 5-digit number)
- **Database Storage**: All booking data stored securely
- **Error Handling**: Comprehensive error messages for validation failures
- **Success Response**: Detailed booking confirmation with advance payment calculation

### 5. User Experience Enhancements
- **Loading States**: Submit button shows spinner during processing
- **Form Reset**: Form clears after successful submission
- **Confirmation Modal**: Detailed booking confirmation with payment instructions
- **Error Messages**: Clear feedback for validation errors

### 6. Admin Features
- **Booking Management**: View all bookings in admin panel
- **Status Updates**: Change booking status (pending/confirmed/cancelled)
- **Detailed View**: Modal with complete booking information
- **Responsive Design**: Mobile-friendly admin interface

## API Endpoints

### POST `/php/home_booking_process.php`
**Purpose**: Process home page booking form submissions

**Request Parameters**:
- `name` (required): Customer name
- `phone` (required): Customer phone number
- `email` (required): Customer email address
- `idType` (optional): Type of ID document
- `rooms` (required): Number of rooms (1-10)
- `checkin` (required): Check-in date (YYYY-MM-DD)
- `checkout` (required): Check-out date (YYYY-MM-DD)
- `guests` (required): Number of guests (1-10)
- `roomType` (required): Type of room
- `totalAmount` (optional): Total booking amount
- `specialInstructions` (optional): Special requests
- `guestAges` (optional): JSON array of guest ages
- `idUpload` (optional): File upload for ID document

**Response Format**:
```json
{
    "success": true/false,
    "message": "Success/error message",
    "booking_id": "PV202500001",
    "advance_amount": "450.00",
    "details": {
        "customer_name": "John Doe",
        "customer_email": "john@example.com",
        "customer_phone": "+1234567890",
        "room_type": "Executive Room",
        "check_in_date": "2025-01-15",
        "check_out_date": "2025-01-17",
        "num_guests": 2,
        "num_rooms": 1,
        "total_amount": "1000.00",
        "special_instructions": "Late check-in"
    }
}
```

## Testing

### 1. Backend Testing
Run the test file to verify backend setup:
```bash
php php/test_home_booking.php
```

### 2. Admin Panel
Access the admin panel to view bookings:
```
http://localhost/Pearl-Vista---Website/php/view_home_bookings.php
```

### 3. Form Testing
1. Open `home.html` in a web browser
2. Click "Book Now" button
3. Fill out the booking form
4. Submit and verify confirmation

## Security Features

1. **Input Validation**: All user inputs are validated and sanitized
2. **File Upload Security**: File type and size restrictions
3. **SQL Injection Prevention**: Prepared statements used throughout
4. **XSS Prevention**: Output escaping in admin panel
5. **CORS Headers**: Proper CORS configuration for AJAX requests

## Error Handling

The system provides comprehensive error handling for:
- Database connection failures
- File upload errors
- Validation failures
- Duplicate booking IDs
- Invalid date ranges
- File size/type violations

## Payment Integration

The system calculates advance payment amounts (45% of total) and provides clear payment instructions to users. Payment processing can be integrated in future updates.

## Future Enhancements

1. **Email Notifications**: Send confirmation emails to customers
2. **SMS Notifications**: Text message confirmations
3. **Payment Gateway**: Online payment processing
4. **Room Availability**: Real-time availability checking
5. **Booking Modifications**: Allow customers to modify bookings
6. **Cancellation Policy**: Automated cancellation handling

## Maintenance

### Database Backup
Regular backups of the `home_bookings` table are recommended.

### File Cleanup
Periodically clean up old uploaded files in the `uploads/` directory.

### Log Monitoring
Monitor error logs for any issues with form submissions or file uploads.

## Support

For technical support or questions about the booking system, refer to the backend files and test scripts provided in the `php/` directory. 