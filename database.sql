-- =====================================================
-- THE PEARL VISTA HOTEL MANAGEMENT SYSTEM
-- Database Schema
-- =====================================================

CREATE DATABASE IF NOT EXISTS the_pearl_vista;
USE the_pearl_vista;

-- =====================================================
-- CORE TABLES
-- =====================================================

-- USERS TABLE
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT NOT NULL UNIQUE,
  username VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) DEFAULT NULL,
  security_question VARCHAR(255) NOT NULL,
  security_answer VARCHAR(255) NOT NULL,
  verification_code VARCHAR(10),
  role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
  verified TINYINT(1) NOT NULL DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ADMINS TABLE
CREATE TABLE IF NOT EXISTS admins (
  admin_id INT AUTO_INCREMENT PRIMARY KEY,
  admin_code VARCHAR(50) NOT NULL UNIQUE,
  username VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  phone VARCHAR(20),
  department VARCHAR(100) NOT NULL,
  position VARCHAR(100) NOT NULL,
  role ENUM('admin', 'super_admin', 'manager') NOT NULL DEFAULT 'admin',
  permissions TEXT,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  last_login TIMESTAMP NULL,
  login_count INT DEFAULT 0,
  profile_image VARCHAR(255),
  address TEXT,
  emergency_contact VARCHAR(100),
  emergency_phone VARCHAR(20),
  hire_date DATE,
  notes TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ROOMS TABLE
CREATE TABLE rooms (
  room_id int(11) NOT NULL AUTO_INCREMENT,
  room_number varchar(50) NOT NULL,
  room_type varchar(100) NOT NULL,
  description text DEFAULT NULL,
  floor int(11) NOT NULL,
  total_rooms int(11) NOT NULL DEFAULT 1,
  available_rooms int(11) NOT NULL DEFAULT 1,
  price_per_night decimal(10,2) NOT NULL,
  status enum('available','reserved','maintenance') DEFAULT 'available',
  created_at timestamp NOT NULL DEFAULT current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (room_id),
  KEY idx_room_type (room_type),
  KEY idx_status (status),
  KEY idx_room_number (room_number)
);

-- =====================================================
-- BOOKING SYSTEM TABLES
-- =====================================================

-- BOOKINGS TABLE
CREATE TABLE bookings (
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

-- BOOKING SERVICES TABLE
CREATE TABLE IF NOT EXISTS service_bookings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            booking_id VARCHAR(50) UNIQUE NOT NULL,
            user_id VARCHAR(100),
            username VARCHAR(100),
            selected_services JSON NOT NULL,
            service_category VARCHAR(50),
            service_date DATE NOT NULL,
            service_time TIME NOT NULL,
            guest_count INT NOT NULL,
            special_requirements TEXT,
            phone_number VARCHAR(20) NOT NULL,
            email VARCHAR(100) NOT NULL,
            total_amount DECIMAL(10,2) NOT NULL,
            additional_services JSON,
            booking_date DATETIME DEFAULT CURRENT_TIMESTAMP,
            status ENUM('pending', 'confirmed', 'cancelled', 'completed') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- TOUR BOOKINGS TABLE
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


-- =====================================================
-- USER FEATURES TABLES
-- =====================================================

-- USER INFO TABLE
CREATE TABLE IF NOT EXISTS user_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT NOT NULL,
  full_name VARCHAR(150),
  dob DATE,
  gender ENUM('male', 'female', 'other'),
  address VARCHAR(255),
  city VARCHAR(100),
  state VARCHAR(100),
  country VARCHAR(100),
  postal_code VARCHAR(20),
  phone VARCHAR(20),
  profile_picture VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- REVIEWS TABLE
CREATE TABLE IF NOT EXISTS reviews (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT NOT NULL,
  room_id INT,
  rating INT NOT NULL CHECK (rating >= 1 AND rating <= 5),
  comment TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE SET NULL
);

-- WISHLIST TABLE
CREATE TABLE IF NOT EXISTS wishlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT NOT NULL,
  room_id INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (room_id) REFERENCES rooms(room_id) ON DELETE CASCADE
);

-- REWARDS TABLE
CREATE TABLE IF NOT EXISTS rewards (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id BIGINT NOT NULL,
  points INT NOT NULL DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS room_types (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    room_type VARCHAR(100) NOT NULL UNIQUE,
    description TEXT,
    base_price DECIMAL(10,2) NOT NULL,
    total_rooms INT(11) NOT NULL DEFAULT 10,
    floor_number INT(11) DEFAULT 1,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- =====================================================
-- ADMIN SYSTEM TABLES
-- =====================================================
-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    admin_code VARCHAR(50) UNIQUE,           -- from old
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100),                      -- from old
    password VARCHAR(255) NOT NULL,
    name VARCHAR(100),                       -- new: can be first_name + last_name
    first_name VARCHAR(50),                  -- from old
    last_name VARCHAR(50),                   -- from old
    phone VARCHAR(20),                       -- from old
    department VARCHAR(100),                 -- from old
    position VARCHAR(100),                   -- from old
    role ENUM('admin', 'super_admin', 'manager') NOT NULL DEFAULT 'admin',
    permissions TEXT,                        -- from old
    is_active TINYINT(1) NOT NULL DEFAULT 1, -- from old
    status ENUM('active', 'inactive') DEFAULT 'active', -- new
    last_login TIMESTAMP NULL,               -- from old
    login_count INT DEFAULT 0,               -- from old
    profile_image VARCHAR(255),              -- from old
    address TEXT,                            -- from old
    emergency_contact VARCHAR(100),          -- from old
    emergency_phone VARCHAR(20),             -- from old
    hire_date DATE,                          -- from old
    notes TEXT,                              -- from old
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Admin Activity Log Table
CREATE TABLE IF NOT EXISTS admin_activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action VARCHAR(255) NOT NULL,
    description TEXT,            -- from old
    details TEXT,                -- from new
    ip_address VARCHAR(45),      -- from old
    user_agent TEXT,             -- from old
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (admin_id) REFERENCES admin_users(admin_id)
);

-- ADMIN SETTINGS TABLE
CREATE TABLE IF NOT EXISTS admin_settings (
  setting_id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) NOT NULL UNIQUE,
  setting_value TEXT,
  setting_type ENUM('string', 'number', 'boolean', 'json') DEFAULT 'string',
  description TEXT,
  is_public TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS room_availability (
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
);

CREATE TABLE IF NOT EXISTS room_bookings (
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
);

CREATE TABLE IF NOT EXISTS chat_messages (
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

CREATE TABLE IF NOT EXISTS chat_sessions (
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

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =====================================================
-- DEFAULT DATA
-- =====================================================

-- Insert default admin user
INSERT INTO admin_users (
  admin_code, 
  username, 
  email, 
  password, 
  first_name, 
  last_name, 
  phone, 
  department, 
  position, 
  role, 
  is_active
) VALUES (
  'ADM001',
  'admin',
  'admin@pearlvista.com',
  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: Admin@123
  'System',
  'Administrator',
  '+1234567890',
  'IT',
  'System Administrator',
  'super_admin',
  1
);

-- Insert default admin settings
INSERT INTO admin_settings (setting_key, setting_value, setting_type, description, is_public) VALUES
('site_name', 'The Pearl Vista', 'string', 'Hotel name', 1),
('site_description', 'Luxury Hotel Management System', 'string', 'Site description', 1),
('max_rooms_per_booking', '5', 'number', 'Maximum rooms per booking', 0),
('booking_advance_days', '365', 'number', 'How many days in advance bookings can be made', 0),
('cancellation_hours', '24', 'number', 'Hours before check-in when cancellation is allowed', 0),
('email_notifications', '1', 'boolean', 'Enable email notifications', 0),
('maintenance_mode', '0', 'boolean', 'Enable maintenance mode', 0),
('default_currency', 'USD', 'string', 'Default currency for the system', 1),
('timezone', 'UTC', 'string', 'System timezone', 0);

