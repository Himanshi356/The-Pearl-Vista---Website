-- Update Room Data for The Pearl Vista
-- This script updates the room_types table with new room data

USE the_pearl_vista;

-- Clear existing room_types data
DELETE FROM room_types;

-- Insert new room types with specified data
INSERT INTO room_types (room_type, description, base_price, total_rooms, floor_number, status) VALUES
('Pearl Signature Room', 'Luxurious signature rooms with premium amenities and stunning views', 20695.00, 25, 1, 'active'),
('Deluxe Room', 'Comfortable deluxe rooms with modern amenities and city views', 3240.00, 140, 1, 'active'),
('Premium Room', 'Premium rooms with enhanced features and superior comfort', 5580.00, 130, 2, 'active'),
('Executive Room', 'Executive rooms designed for business travelers with work amenities', 8790.00, 120, 3, 'active'),
('Luxury Suite', 'Spacious luxury suites with separate living areas and premium services', 11920.00, 110, 4, 'active'),
('Family Suite', 'Large family suites perfect for groups with multiple bedrooms', 14855.00, 100, 5, 'active');

-- Clear existing rooms data
DELETE FROM rooms;

-- Insert sample rooms for each room type
-- Pearl Signature Room (25 rooms)
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('PS001', 'Pearl Signature Room', 'Luxurious signature room with premium amenities', 1, 25, 25, 20695.00, 'available'),
('PS002', 'Pearl Signature Room', 'Luxurious signature room with premium amenities', 1, 25, 25, 20695.00, 'available'),
('PS003', 'Pearl Signature Room', 'Luxurious signature room with premium amenities', 1, 25, 25, 20695.00, 'available'),
('PS004', 'Pearl Signature Room', 'Luxurious signature room with premium amenities', 1, 25, 25, 20695.00, 'available'),
('PS005', 'Pearl Signature Room', 'Luxurious signature room with premium amenities', 1, 25, 25, 20695.00, 'available');

-- Deluxe Room (140 rooms) - Sample entries
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('DL001', 'Deluxe Room', 'Comfortable deluxe room with modern amenities', 1, 140, 140, 3240.00, 'available'),
('DL002', 'Deluxe Room', 'Comfortable deluxe room with modern amenities', 1, 140, 140, 3240.00, 'available'),
('DL003', 'Deluxe Room', 'Comfortable deluxe room with modern amenities', 1, 140, 140, 3240.00, 'available'),
('DL004', 'Deluxe Room', 'Comfortable deluxe room with modern amenities', 1, 140, 140, 3240.00, 'available'),
('DL005', 'Deluxe Room', 'Comfortable deluxe room with modern amenities', 1, 140, 140, 3240.00, 'available');

-- Premium Room (130 rooms) - Sample entries
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('PR001', 'Premium Room', 'Premium room with enhanced features', 2, 130, 130, 5580.00, 'available'),
('PR002', 'Premium Room', 'Premium room with enhanced features', 2, 130, 130, 5580.00, 'available'),
('PR003', 'Premium Room', 'Premium room with enhanced features', 2, 130, 130, 5580.00, 'available'),
('PR004', 'Premium Room', 'Premium room with enhanced features', 2, 130, 130, 5580.00, 'available'),
('PR005', 'Premium Room', 'Premium room with enhanced features', 2, 130, 130, 5580.00, 'available');

-- Executive Room (120 rooms) - Sample entries
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('EX001', 'Executive Room', 'Executive room designed for business travelers', 3, 120, 120, 8790.00, 'available'),
('EX002', 'Executive Room', 'Executive room designed for business travelers', 3, 120, 120, 8790.00, 'available'),
('EX003', 'Executive Room', 'Executive room designed for business travelers', 3, 120, 120, 8790.00, 'available'),
('EX004', 'Executive Room', 'Executive room designed for business travelers', 3, 120, 120, 8790.00, 'available'),
('EX005', 'Executive Room', 'Executive room designed for business travelers', 3, 120, 120, 8790.00, 'available');

-- Luxury Suite (110 rooms) - Sample entries
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('LS001', 'Luxury Suite', 'Spacious luxury suite with separate living area', 4, 110, 110, 11920.00, 'available'),
('LS002', 'Luxury Suite', 'Spacious luxury suite with separate living area', 4, 110, 110, 11920.00, 'available'),
('LS003', 'Luxury Suite', 'Spacious luxury suite with separate living area', 4, 110, 110, 11920.00, 'available'),
('LS004', 'Luxury Suite', 'Spacious luxury suite with separate living area', 4, 110, 110, 11920.00, 'available'),
('LS005', 'Luxury Suite', 'Spacious luxury suite with separate living area', 4, 110, 110, 11920.00, 'available');

-- Family Suite (100 rooms) - Sample entries
INSERT INTO rooms (room_number, room_type, description, floor, total_rooms, available_rooms, price_per_night, status) VALUES
('FS001', 'Family Suite', 'Large family suite perfect for groups', 5, 100, 100, 14855.00, 'available'),
('FS002', 'Family Suite', 'Large family suite perfect for groups', 5, 100, 100, 14855.00, 'available'),
('FS003', 'Family Suite', 'Large family suite perfect for groups', 5, 100, 100, 14855.00, 'available'),
('FS004', 'Family Suite', 'Large family suite perfect for groups', 5, 100, 100, 14855.00, 'available'),
('FS005', 'Family Suite', 'Large family suite perfect for groups', 5, 100, 100, 14855.00, 'available');

-- Update room_availability table with new data
DELETE FROM room_availability;

INSERT INTO room_availability (room_type, total_rooms, available_rooms, check_in_date, check_out_date) VALUES
('Pearl Signature Room', 25, 25, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('Deluxe Room', 140, 140, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('Premium Room', 130, 130, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('Executive Room', 120, 120, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('Luxury Suite', 110, 110, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('Family Suite', 100, 100, CURDATE(), DATE_ADD(CURDATE(), INTERVAL 30 DAY));

-- Display the updated data
SELECT 'Room Types Updated Successfully!' as message;
SELECT room_type, description, base_price, total_rooms, floor_number FROM room_types ORDER BY base_price DESC; 