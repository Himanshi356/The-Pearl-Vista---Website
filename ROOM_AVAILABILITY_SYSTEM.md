# Room Availability & Booking System

## Overview
The Room Availability & Booking System provides real-time room availability checking and booking functionality for Pearl Vista Hotel. It includes a comprehensive backend with database integration and a user-friendly frontend interface.

## Features

### ✅ **Real-Time Availability Checking**
- Check room availability for specific dates
- Dynamic pricing calculation based on room type and duration
- Guest surcharge for additional guests
- Real-time database integration

### ✅ **Comprehensive Booking System**
- Complete booking form with validation
- Database storage of all booking details
- Automatic availability updates
- Booking confirmation with detailed information

### ✅ **Professional User Interface**
- Modern modal-based interface
- Loading states and user feedback
- Detailed availability results
- Seamless booking flow

## Database Structure

### **room_availability Table**
```sql
CREATE TABLE room_availability (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(100) NOT NULL,
    total_rooms INT(11) NOT NULL DEFAULT 10,
    available_rooms INT(11) NOT NULL DEFAULT 10,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_room_type (room_type),
    INDEX idx_dates (check_in_date, check_out_date)
)
```

### **room_bookings Table**
```sql
CREATE TABLE room_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(255) NOT NULL,
    customer_email VARCHAR(255) NOT NULL,
    customer_phone VARCHAR(50) NOT NULL,
    room_type VARCHAR(100) NOT NULL,
    check_in_date DATE NOT NULL,
    check_out_date DATE NOT NULL,
    num_guests INT(11) NOT NULL,
    num_rooms INT(11) NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
```

## File Structure

### **Backend Files**
- `php/check_availability.php` - Handles availability checking
- `php/room_booking_process.php` - Processes room bookings
- `php/setup_database.php` - Database setup and table creation

### **Frontend Integration**
- `home.html` - Contains the availability modal
- `main.js` - JavaScript functionality for the system

## How It Works

### **1. Availability Check Flow**
1. User clicks "Check Availability" button
2. Availability form modal opens
3. User fills in check-in/out dates, guests, room type, number of rooms
4. Form submits to `php/check_availability.php`
5. Backend validates data and checks database
6. Returns detailed availability information with pricing
7. Shows detailed result modal with booking option

### **2. Booking Process Flow**
1. User clicks "Book Now" from availability result
2. Booking data is stored in localStorage
3. User is redirected to rooms page for final booking
4. Booking form submits to `php/room_booking_process.php`
5. Backend validates and saves booking
6. Updates room availability in database
7. Returns booking confirmation

## Pricing Algorithm

### **Base Room Prices**
- Pearl Signature Room: $500/night
- Deluxe Room: $400/night
- Premium Room: $350/night
- Executive Room: $450/night
- Luxury Suite: $800/night
- Family Suite: $600/night

### **Price Calculation**
```
Total Amount = (Base Price × Duration × Number of Rooms) + Guest Surcharge
```

### **Guest Surcharge**
- Applied when guests > (rooms × 2)
- $50 per extra guest per night
- Example: 3 guests in 1 room = $50 surcharge per night

## API Endpoints

### **Check Availability**
- **URL**: `php/check_availability.php`
- **Method**: POST
- **Parameters**:
  - `checkinDate` (YYYY-MM-DD)
  - `checkoutDate` (YYYY-MM-DD)
  - `guests` (number)
  - `roomType` (string)
  - `numRooms` (number)

**Response**:
```json
{
  "success": true,
  "available": true,
  "available_rooms": 8,
  "requested_rooms": 2,
  "room_type": "Deluxe Room",
  "check_in_date": "2024-01-15",
  "check_out_date": "2024-01-17",
  "duration": 2,
  "guests": 4,
  "base_price_per_night": 400,
  "total_amount": 800,
  "guest_surcharge": 100,
  "message": "Great! 2 Deluxe Room(s) are available for your selected dates."
}
```

### **Process Room Booking**
- **URL**: `php/room_booking_process.php`
- **Method**: POST
- **Parameters**:
  - `customer_name` (string)
  - `customer_email` (email)
  - `customer_phone` (string)
  - `room_type` (string)
  - `check_in_date` (YYYY-MM-DD)
  - `check_out_date` (YYYY-MM-DD)
  - `num_guests` (number)
  - `num_rooms` (number)
  - `total_amount` (decimal)

**Response**:
```json
{
  "success": true,
  "message": "Room booking submitted successfully!",
  "booking_id": 123,
  "details": {
    "customer_name": "John Doe",
    "room_type": "Deluxe Room",
    "check_in_date": "2024-01-15",
    "check_out_date": "2024-01-17",
    "num_guests": 4,
    "num_rooms": 2,
    "total_amount": 800
  }
}
```

## Security Features

### **Input Validation**
- Email format validation
- Date format and logic validation
- Required field validation
- Numeric value validation

### **SQL Injection Prevention**
- Prepared statements for all database queries
- Parameterized queries
- Input sanitization

### **Error Handling**
- Comprehensive error messages
- HTTP status codes
- Graceful error recovery

## Setup Instructions

### **1. Database Setup**
```bash
# Run the database setup script
php php/setup_database.php
```

### **2. File Permissions**
Ensure PHP files have proper read permissions.

### **3. XAMPP Configuration**
- Start Apache and MySQL services
- Ensure PHP is properly configured

## User Experience Features

### **Loading States**
- Button text changes to "Checking..." during availability check
- Disabled state prevents multiple submissions
- Visual feedback for all operations

### **Notifications**
- Success messages for successful operations
- Error messages for failed operations
- Network error handling

### **Modal System**
- Smooth animations for modal transitions
- Click outside to close functionality
- Responsive design for mobile devices

## Future Enhancements

### **Planned Features**
- Admin interface for managing room availability
- Email confirmation system
- Payment gateway integration
- Room inventory management
- Booking modification system
- Cancellation handling

### **Advanced Features**
- Real-time availability updates
- Waitlist functionality
- Dynamic pricing based on demand
- Integration with external booking systems

## Troubleshooting

### **Common Issues**

1. **Database Connection Error**
   - Check XAMPP services are running
   - Verify database credentials in PHP files

2. **Availability Not Showing**
   - Check if room_availability table exists
   - Verify date format (YYYY-MM-DD)

3. **Booking Not Saving**
   - Check room_bookings table exists
   - Verify all required fields are provided

### **Debug Mode**
Enable debug mode by setting:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

## Support

For technical support or questions about the Room Availability & Booking System, please refer to the main documentation or contact the development team.

---

**Last Updated**: January 2024
**Version**: 1.0
**Status**: Production Ready 