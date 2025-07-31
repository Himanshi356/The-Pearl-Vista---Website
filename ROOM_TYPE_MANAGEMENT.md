# Room Type Management Guide

## Overview
This document explains how to properly add new room types to The Pearl Vista hotel management system.

## Current Issue Fixed
The "Suite King" room type was added to the `rooms` table but was missing from the `room_types` table, causing it not to appear on the admin-rooms.php page. Additionally, new room types like "Vista Love" and "Deluxe Room" were added directly to the `rooms` table but weren't showing up on the admin page.

## Proper Way to Add New Room Types

### Method 1: Through Admin Interface (Recommended)
1. Go to `admin-rooms.php`
2. Use the "Add New Room" form
3. Select "Others" from the room type dropdown
4. Enter the new room type name
5. Fill in all required details
6. Submit the form

### Method 2: Direct Database Entry
If adding directly to the database, ensure both tables are updated:

#### Step 1: Add to `room_types` table
```sql
INSERT INTO room_types (
    room_type, 
    description, 
    base_price, 
    total_rooms, 
    available_rooms, 
    floor_number, 
    status
) VALUES (
    'New Room Type Name',
    'Description of the room type',
    15000.00,  -- base price
    10,        -- total rooms
    10,        -- available rooms
    3,         -- floor number
    'active'   -- status
);
```

#### Step 2: Add corresponding entries to `rooms` table
```sql
INSERT INTO rooms (
    room_number,
    room_type,
    description,
    floor,
    total_rooms,
    available_rooms,
    price_per_night,
    status
) VALUES (
    '301',  -- room number
    'New Room Type Name',
    'Description of the room type',
    3,      -- floor
    1,      -- total rooms (per individual room)
    1,      -- available rooms (per individual room)
    15000.00, -- price per night
    'available' -- status
);
```

## System Architecture

### Database Tables
1. **`room_types`** - Defines room type categories
   - `room_type` (VARCHAR) - Unique room type name
   - `description` (TEXT) - Room type description
   - `base_price` (DECIMAL) - Standard price per night
   - `total_rooms` (INT) - Total number of rooms of this type
   - `available_rooms` (INT) - Currently available rooms
   - `floor_number` (INT) - Floor where this room type is located
   - `status` (ENUM) - 'active' or 'inactive'

2. **`rooms`** - Individual room instances
   - `room_id` (AUTO_INCREMENT) - Unique room identifier
   - `room_number` (VARCHAR) - Physical room number
   - `room_type` (VARCHAR) - References room_types.room_type
   - `description` (TEXT) - Individual room description
   - `floor` (INT) - Floor number
   - `price_per_night` (DECIMAL) - Price for this specific room
   - `status` (ENUM) - 'available', 'reserved', 'maintenance'

### Frontend Integration
1. **Dynamic Loading**: Room types are loaded dynamically from the database using a UNION query that combines both `room_types` and `rooms` tables
2. **Dropdown Population**: Both add and edit forms populate room type dropdowns from the database
3. **Image Mapping**: New room types get appropriate images based on the switch statement in `admin-data-loader.js`
4. **Automatic Discovery**: Any room type added to either `room_types` or `rooms` table will automatically appear on the admin page

## Files Modified for Dynamic Room Type Loading

### Backend Files
- `Backend/Admin/get_room_types.php` - New API endpoint for fetching room types
- `Backend/Admin/get_rooms_data.php` - Updated to handle missing room entries properly

### Frontend Files
- `admin-data-loader.js` - Added dynamic room type loading and dropdown population
- `admin-rooms.php` - Updated to work with dynamic room types

## Troubleshooting

### Issue: Room Type Not Appearing on Admin Page
**Symptoms**: Room type exists in database but doesn't show on admin-rooms.php

**Possible Causes**:
1. Room type missing from both `room_types` and `rooms` tables
2. Room type status is 'inactive' (in `room_types` table)
3. Database connection issues

**Solutions**:
1. **NEW**: Room types can now be added to either `room_types` OR `rooms` table - both will appear automatically
2. Ensure status is 'active' (if in `room_types` table)
3. Check database connection and query execution
4. Verify the room type has at least one entry in the `rooms` table

### Issue: Room Type Missing from Dropdowns
**Symptoms**: Room type exists in database but not in form dropdowns

**Solutions**:
1. Check if room type is 'active' in `room_types` table
2. Verify the `get_room_types.php` API is working
3. Check browser console for JavaScript errors

## Best Practices

1. **Always use the admin interface** when possible
2. **Keep room types active** unless they're permanently discontinued
3. **Maintain consistency** between `room_types` and `rooms` tables
4. **Use descriptive names** for room types
5. **Set appropriate pricing** based on room features and location
6. **Update images** for new room types in the frontend code

## Future Enhancements

1. **Image Upload**: Allow admins to upload custom images for new room types
2. **Bulk Import**: Create a CSV import feature for multiple room types
3. **Room Type Templates**: Predefined templates for common room types
4. **Validation**: Enhanced validation for room type names and pricing 