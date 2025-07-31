// Admin Navigation System
// Include this script in all admin pages for consistent navigation

document.addEventListener('DOMContentLoaded', function() {
    // Set active nav item based on current page
    setActiveNavItem();
    
    // Initialize dropdown functionality
    initAdminDropdown();
    
    // Add navigation click handlers
    addNavClickHandlers();
});

function setActiveNavItem() {
    const currentPage = window.location.pathname.split('/').pop();
    const navLinks = document.querySelectorAll('.sidebar nav a');
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    });
}

function initAdminDropdown() {
    const profile = document.querySelector('.admin-profile');
    const dropdown = document.getElementById('adminDropdown');
    
    if (profile && dropdown) {
        profile.addEventListener('click', function(e) {
            e.stopPropagation();
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!profile.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    }
}

function addNavClickHandlers() {
    const navLinks = document.querySelectorAll('.sidebar nav a');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            // Add active class to clicked link
            this.classList.add('active');
        });
    });
}

// Admin navigation links
const adminNavLinks = {
    dashboard: 'admin-dashboard.php',
    rooms: 'admin-rooms.php',
    bookings: 'admin-bookings.php',
    customers: 'admin-customers.php',
    services: 'admin-services.php',
    tourBookings: 'admin-tour-bookings.php',
    chat: 'admin-chat.php',
    reports: 'admin-reports.php',
    settings: 'admin-settings.php',
    profile: 'admin-profile.php',
    addUser: 'admin-add-user.php',
    logout: 'logout.php'
};

// Function to navigate to admin pages
function navigateToAdmin(page) {
    if (adminNavLinks[page]) {
        window.location.href = adminNavLinks[page];
    }
}

// Function to get current admin user info
async function getCurrentAdmin() {
    try {
        const response = await fetch('Auth/get_current_user.php');
        const data = await response.json();
        
        if (data && !data.error) {
            return data;
        } else {
            // Don't redirect, just return null for now
            console.log('getCurrentAdmin error:', data);
            return null;
        }
    } catch (error) {
        console.error('Error getting admin info:', error);
        return null;
    }
}

// Update admin profile display
async function updateAdminProfile() {
    const adminInfo = document.querySelector('.admin-info');
    const adminName = document.querySelector('.admin-name');
    const adminRole = document.querySelector('.admin-role');
    
    if (adminInfo && adminName && adminRole) {
        try {
            const admin = await getCurrentAdmin();
            if (admin) {
                adminName.textContent = admin.full_name || admin.username || 'Admin User';
                adminRole.textContent = admin.role || 'Administrator';
            }
        } catch (error) {
            console.error('Error updating admin profile:', error);
        }
    }
}

// Initialize admin profile on page load
document.addEventListener('DOMContentLoaded', function() {
    updateAdminProfile();
}); 