# Pearl Vista Hotel Website - Database Setup

## Prerequisites

1. **XAMPP Installation**: Make sure XAMPP is installed and running
2. **MySQL Service**: Ensure MySQL service is started in XAMPP Control Panel
3. **Apache Service**: Ensure Apache service is started in XAMPP Control Panel

## Database Setup Instructions

### Step 1: Start XAMPP Services
1. Open XAMPP Control Panel
2. Start Apache and MySQL services
3. Verify both services are running (green status)

### Step 2: Setup Database
1. Open your web browser
2. Navigate to: `http://localhost/Pearl-Vista---Website/php/setup_database.php`
3. You should see a success message indicating the database and tables have been created

### Step 3: Test Database Connection
1. Navigate to: `http://localhost/Pearl-Vista---Website/php/test_connection.php`
2. You should see all green checkmarks indicating successful connection

## Contact Form Database Structure

The contact form uses the following database structure:

### Database: `pearlvista`
### Table: `contact_messages`

| Column | Type | Description |
|--------|------|-------------|
| id | INT(11) | Primary key, auto-increment |
| name | VARCHAR(255) | Full name of the person |
| email | VARCHAR(255) | Email address |
| phone | VARCHAR(50) | Phone number |
| subject | VARCHAR(255) | Subject of the message |
| message | TEXT | The actual message content |
| created_at | TIMESTAMP | When the message was submitted |

## Troubleshooting

### Common Issues:

1. **"Connection failed" Error**
   - Solution: Make sure MySQL service is running in XAMPP
   - Check if port 3306 is not being used by another application

2. **"Access denied" Error**
   - Solution: Default XAMPP MySQL credentials are:
     - Username: `root`
     - Password: `` (empty)

3. **Contact form shows error modal**
   - Solution: Check that the database and table exist
   - Run the setup script again if needed

4. **PHP not found error**
   - Solution: Make sure you're accessing via web server (http://localhost) not command line

## File Structure

```
php/
├── contact_process.php      # Handles contact form submissions
├── setup_database.php       # Creates database and tables
├── test_connection.php      # Tests database connection
├── db_test.php             # Basic connection test
└── test.php                # PHP test file
```

## Testing the Contact Form

1. Navigate to the contact page: `http://localhost/Pearl-Vista---Website/contact_us.html`
2. Fill out the contact form
3. Submit the form
4. You should see a success message
5. Check the database to verify the message was stored

## Database Management

To view submitted contact messages:
1. Open phpMyAdmin: `http://localhost/phpmyadmin`
2. Select the `pearlvista` database
3. Click on the `contact_messages` table
4. View the submitted messages

## Security Notes

- The current setup uses default XAMPP credentials
- For production, change the database credentials
- Consider adding input validation and sanitization
- Implement CSRF protection for production use

## Support

If you encounter any issues:
1. Check XAMPP error logs
2. Verify all services are running
3. Test database connection using the provided test scripts
4. Ensure proper file permissions 