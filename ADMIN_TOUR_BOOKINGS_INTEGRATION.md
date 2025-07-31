# Admin Tour Bookings Integration

## Overview
This document outlines the integration of the `admin-tour-bookings.php` page with the `tour_bookings` table from the database and the `locations.html` page to create a dynamic tour booking management system.

## Files Created/Modified

### Backend Files
1. **`Backend/manage_tour_bookings.php`** (Created)
   - Comprehensive API endpoint for tour booking management
   - Handles CRUD operations and statistics retrieval
   - Session validation and security measures
   - Supports filtering by status, tour type, date, and guest name

2. **`Backend/add_sample_tour_bookings.php`** (Created)
   - Script to populate tour_bookings table with sample data
   - Based on locations from locations.html
   - Includes realistic customer data and tour information

3. **`Backend/reset_tour_bookings.php`** (Created)
   - Script to reset and repopulate tour bookings data
   - Ensures clean data for testing

4. **`Backend/check_tour_bookings.php`** (Created)
   - Utility script to check current tour bookings data
   - Shows statistics and sample records

### Frontend Files
1. **`admin-tour-bookings.js`** (Created)
   - JavaScript for dynamic tour booking management
   - Handles data loading, filtering, and actions
   - Real-time statistics updates
   - Interactive booking management (approve, reject, delete)

2. **`admin-tour-bookings.php`** (Modified)
   - Updated to be dynamic instead of static
   - Added proper form IDs for filtering
   - Integrated with JavaScript for real-time updates
   - Removed static content in favor of dynamic loading

## Database Structure

### tour_bookings Table
```sql
CREATE TABLE IF NOT EXISTS tour_bookings (
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
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'confirmed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## API Endpoints

### Backend/manage_tour_bookings.php

#### 1. Get Tour Bookings
- **Action**: `get_tour_bookings`
- **Method**: GET
- **Parameters**: 
  - `status` (optional): Filter by booking status
  - `tour_type` (optional): Filter by vehicle type
  - `date` (optional): Filter by tour date
  - `guest_name` (optional): Search by guest name
- **Response**: JSON with bookings array

#### 2. Get Tour Statistics
- **Action**: `get_tour_statistics`
- **Method**: GET
- **Response**: JSON with statistics including:
  - Total bookings
  - Confirmed bookings
  - Pending bookings
  - Total revenue
  - Monthly comparison percentages

#### 3. Update Booking Status
- **Action**: `update_booking_status`
- **Method**: POST
- **Body**: JSON with `booking_id` and `status`
- **Response**: Success/error message

#### 4. Delete Booking
- **Action**: `delete_booking`
- **Method**: POST
- **Body**: JSON with `booking_id`
- **Response**: Success/error message

#### 5. Get Tour Locations
- **Action**: `get_tour_locations`
- **Method**: GET
- **Response**: JSON with available tour locations

#### 6. Get Vehicle Types
- **Action**: `get_vehicle_types`
- **Method**: GET
- **Response**: JSON with available vehicle types

## Features Implemented

### 1. Dynamic Statistics Cards
- Total Tour Bookings (real-time count)
- Confirmed Bookings (real-time count)
- Pending Bookings (real-time count)
- Tour Revenue (real-time calculation)
- Monthly comparison percentages

### 2. Advanced Filtering System
- **Status Filter**: All, Confirmed, Pending, Cancelled
- **Tour Type Filter**: Luxury Sedan, SUV, Minivan, Limousine, Coach Bus
- **Date Filter**: Filter by specific tour date
- **Guest Name Filter**: Search by guest name (real-time)

### 3. Interactive Booking Management
- **View Details**: View complete booking information
- **Approve/Reject**: For pending bookings
- **Edit Status**: For confirmed/cancelled bookings
- **Delete**: Remove bookings with confirmation

### 4. Real-time Data Updates
- Automatic refresh of statistics when actions are performed
- Real-time filtering without page reload
- Dynamic booking list updates

### 5. Responsive Design
- Grid-based layout for booking cards
- Mobile-friendly interface
- Consistent styling with other admin pages

## Tour Locations from locations.html

### Available Locations
- Broadway Theaters (Cultural)
- Rockefeller Center (Landmark)
- Empire State Building (Landmark)
- Grand Central Terminal (Transportation)
- Times Square (Entertainment)
- Central Park (Nature)
- Statue of Liberty (Landmark)
- Brooklyn Bridge (Landmark)

### Vehicle Types
- **Luxury Sedan**: Premium service
- **SUV**: Standard service
- **Minivan**: Group service
- **Limousine**: Premium service
- **Coach Bus**: Large group service

## Sample Data Structure

### Tour Booking Example
```json
{
    "id": 1,
    "full_name": "Sarah Johnson",
    "email": "sarah.johnson@email.com",
    "phone": "+1 (555) 123-4567",
    "tour_date": "2024-12-20",
    "tour_time": "09:00:00",
    "places_to_visit": "Broadway Theaters, Rockefeller Center, Empire State Building",
    "number_of_travellers": 2,
    "vehicle_type": "Luxury Sedan",
    "amount_paid": 450.00,
    "status": "confirmed",
    "created_at": "2024-12-01 10:30:00",
    "updated_at": "2024-12-01 10:30:00"
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
1. Ensure the `tour_bookings` table exists in the database
2. Run `Backend/reset_tour_bookings.php` to populate sample data
3. Access `admin-tour-bookings.php` through the admin panel

### 2. Managing Bookings
1. **View All Bookings**: The page loads all bookings automatically
2. **Filter Bookings**: Use the filter options to narrow down results
3. **Update Status**: Click action buttons to approve, reject, or edit bookings
4. **Delete Bookings**: Use the delete button with confirmation

### 3. Monitoring Statistics
- Statistics cards update automatically
- Monthly comparisons show growth/decline
- Revenue calculations are real-time

## Error Handling

### Common Issues
1. **Database Connection**: Check database credentials in `Config/database.php`
2. **Session Issues**: Ensure proper admin login
3. **Permission Errors**: Verify user has admin privileges

### Debugging
- Check browser console for JavaScript errors
- Review PHP error logs for backend issues
- Use `Backend/check_tour_bookings.php` to verify data

## Performance Considerations

### 1. Database Optimization
- Limited to 100 records per query
- Indexed on frequently queried columns
- Efficient WHERE clauses

### 2. Frontend Optimization
- Debounced search input (500ms delay)
- Lazy loading of booking details
- Efficient DOM manipulation

### 3. Caching
- Consider implementing Redis for session storage
- Database query caching for statistics
- Static asset caching

## Future Enhancements

### 1. Advanced Features
- Booking calendar view
- Export functionality (PDF, Excel)
- Email notifications
- SMS confirmations

### 2. Analytics
- Booking trends analysis
- Revenue forecasting
- Popular tour routes
- Customer demographics

### 3. Integration
- Payment gateway integration
- Third-party tour providers
- Weather API integration
- Traffic data integration

## Testing

### Manual Testing Checklist
- [ ] Load admin tour bookings page
- [ ] Verify statistics cards display correctly
- [ ] Test all filter options
- [ ] Test booking status updates
- [ ] Test booking deletion
- [ ] Verify responsive design
- [ ] Check error handling

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
4. Backup tour bookings data
5. Update security measures

### Troubleshooting
1. Check database connectivity
2. Verify session management
3. Review JavaScript console errors
4. Test API endpoints directly
5. Validate data integrity

## Conclusion

The tour bookings integration provides a comprehensive, dynamic management system that connects the admin panel with the database and the locations page. The system is secure, scalable, and user-friendly, offering real-time updates and advanced filtering capabilities. 