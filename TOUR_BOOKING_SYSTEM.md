# Tour Booking System - Pearl Vista

## Overview
The tour booking system allows customers to book guided tours to various NYC attractions through the Pearl Vista hotel. The system includes both frontend and backend components with database storage and admin management.

## Features

### Customer Features
- **Interactive Booking Form**: Located on the locations page (`locations.html`)
- **Dynamic Pricing**: Automatically calculates tour costs based on:
  - Number of travellers
  - Vehicle type (Car, Van, Bus, Limousine)
  - Selected attractions
- **Real-time Validation**: Form validation with immediate feedback
- **Booking Confirmation**: Success modal with booking details
- **Itinerary Integration**: Bookings automatically appear in "My Itinerary" page

### Admin Features
- **Booking Management**: View all tour bookings (`admin-tour-bookings.html`)
- **Status Updates**: Confirm or cancel pending bookings
- **Detailed View**: Complete booking information display
- **Real-time Updates**: Refresh functionality to see new bookings

## Database Structure

### tour_bookings Table
```sql
CREATE TABLE tour_bookings (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    tour_date DATE NOT NULL,
    tour_time TIME NOT NULL,
    places_to_visit TEXT NOT NULL,
    number_of_travellers INT(11) NOT NULL,
    vehicle_type VARCHAR(50) NOT NULL,
    amount_paid DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## File Structure

### Frontend Files
- `locations.html` - Main booking form page
- `admin-tour-bookings.html` - Admin management interface

### Backend Files
- `php/tour_booking_process.php` - Handles form submission
- `php/get_tour_bookings.php` - Retrieves bookings for admin
- `php/update_booking_status.php` - Updates booking status
- `php/setup_database.php` - Database setup (includes tour_bookings table)

## How It Works

### 1. Customer Booking Process
1. Customer visits locations page
2. Fills out the booking form with:
   - Personal details (name, email, phone)
   - Tour preferences (date, time, places to visit)
   - Travel details (number of travellers, vehicle type)
3. System automatically calculates pricing
4. Customer submits form via AJAX
5. Backend validates and stores booking in database
6. Success confirmation shown to customer
7. Booking appears in customer's itinerary

### 2. Admin Management Process
1. Admin accesses `admin-tour-bookings.html`
2. System loads all bookings from database
3. Admin can view booking details
4. Admin can confirm or cancel pending bookings
5. Status updates are saved to database

## Pricing Algorithm

The system calculates tour costs using the following formula:
- **Base Cost**: $5,000 per attraction (or $4,500 for "Others")
- **Additional Travellers**: +$3,000 per additional person
- **Vehicle Multipliers**:
  - Car: 5x
  - Van: 8.5x
  - Bus: 10x
  - Limousine: 20x

**Formula**: `(Base Cost + (Additional Travellers × $3,000)) × Vehicle Multiplier`

## API Endpoints

### POST /php/tour_booking_process.php
Handles tour booking form submissions.

**Input Parameters:**
- `full_name` (string) - Customer's full name
- `email` (string) - Customer's email address
- `phone` (string) - Customer's phone number
- `tour_date` (date) - Tour date (YYYY-MM-DD)
- `tour_time` (time) - Tour time (HH:MM)
- `places_to_visit` (string) - Comma-separated list of attractions
- `number_of_travellers` (integer) - Number of people
- `vehicle_type` (string) - Vehicle type
- `amount_paid` (decimal) - Calculated amount

**Response:**
```json
{
    "success": true,
    "message": "Tour booking submitted successfully!",
    "booking_id": 123
}
```

### GET /php/get_tour_bookings.php
Retrieves all tour bookings for admin display.

**Response:**
```json
{
    "success": true,
    "bookings": [
        {
            "id": 123,
            "full_name": "John Doe",
            "email": "john@example.com",
            "phone": "+1234567890",
            "tour_date": "2025-01-15",
            "tour_time": "09:00:00",
            "places_to_visit": "Broadway Theaters, Empire State Building",
            "number_of_travellers": 4,
            "vehicle_type": "Van",
            "amount_paid": "42500.00",
            "status": "pending",
            "created_at": "2025-01-10 14:30:00",
            "updated_at": "2025-01-10 14:30:00"
        }
    ],
    "count": 1
}
```

### POST /php/update_booking_status.php
Updates booking status (confirm/cancel).

**Input Parameters:**
```json
{
    "booking_id": 123,
    "status": "confirmed"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Booking status updated successfully"
}
```

## Setup Instructions

1. **Database Setup**:
   ```bash
   # Run the database setup script
   php php/setup_database.php
   ```

2. **File Permissions**:
   - Ensure PHP files are readable by web server
   - Ensure database connection credentials are correct

3. **Testing**:
   - Visit `locations.html` to test booking form
   - Visit `admin-tour-bookings.html` to test admin interface
   - Check database for stored bookings

## Security Features

- **Input Validation**: All form inputs are validated server-side
- **SQL Injection Protection**: Prepared statements used for all database queries
- **Email Validation**: Proper email format validation
- **Data Sanitization**: All input data is trimmed and sanitized
- **Error Handling**: Comprehensive error handling with user-friendly messages

## Future Enhancements

- Email notifications for bookings
- Payment integration
- Tour guide assignment
- Customer reviews and ratings
- Advanced filtering and search in admin panel
- Export functionality for booking data
- Mobile app integration 