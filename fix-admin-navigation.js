// Fix for Admin Navigation Issues
console.log('🔧 Admin Navigation Fix loaded');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing admin navigation...');
    
    // Fix 1: Ensure all navigation links work
    const navLinks = document.querySelectorAll('.sidebar nav a');
    console.log('Found navigation links:', navLinks.length);
    
    navLinks.forEach((link, index) => {
        console.log(`Link ${index + 1}:`, link.href);
        
        // Add click event listener to ensure navigation works
        link.addEventListener('click', function(e) {
            console.log('Navigation link clicked:', this.href);
            
            // Remove active class from all links
            navLinks.forEach(l => l.classList.remove('active'));
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Allow normal navigation
            // Don't prevent default - let the link work normally
        });
    });
    
    // Fix 2: Ensure dropdown works
    const profile = document.querySelector('.admin-profile');
    const dropdown = document.getElementById('adminDropdown');
    
    if (profile && dropdown) {
        console.log('Admin profile dropdown found');
        
        profile.addEventListener('click', function(e) {
            e.stopPropagation();
            const isVisible = dropdown.style.display === 'block';
            dropdown.style.display = isVisible ? 'none' : 'block';
            console.log('Dropdown toggled:', !isVisible);
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!profile.contains(event.target)) {
                dropdown.style.display = 'none';
            }
        });
    } else {
        console.log('Admin profile dropdown not found');
    }
    
    // Fix 3: Ensure quick action buttons work
    const actionButtons = document.querySelectorAll('.action-btn');
    console.log('Found action buttons:', actionButtons.length);
    
    actionButtons.forEach((button, index) => {
        console.log(`Action button ${index + 1}:`, button.href);
        
        button.addEventListener('click', function(e) {
            console.log('Action button clicked:', this.href);
            // Allow normal navigation
        });
    });
    
    // Fix 4: Set active nav item based on current page
    const currentPage = window.location.pathname.split('/').pop();
    console.log('Current page:', currentPage);
    
    navLinks.forEach(link => {
        const href = link.getAttribute('href');
        if (href === currentPage) {
            link.classList.add('active');
            console.log('Set active link:', href);
        }
    });
    
    console.log('✅ Admin navigation fix completed');
});

// Additional utility functions
function navigateToAdmin(page) {
    const adminNavLinks = {
        dashboard: 'admin-dashboard.php',
        rooms: 'admin-rooms.html',
        bookings: 'admin-bookings.html',
        customers: 'admin-customers.html',
        services: 'admin-services.html',
        tourBookings: 'admin-tour-bookings.html',
        chat: 'admin-chat.html',
        reports: 'admin-reports.html',
        settings: 'admin-settings.html',
        profile: 'admin-profile.html',
        addUser: 'admin-add-user.html'
    };
    
    if (adminNavLinks[page]) {
        console.log('Navigating to:', adminNavLinks[page]);
        window.location.href = adminNavLinks[page];
    } else {
        console.error('Page not found:', page);
    }
}

// Test function
function testNavigation() {
    console.log('Testing navigation...');
    const links = document.querySelectorAll('a[href*="admin-"]');
    console.log('Admin links found:', links.length);
    
    links.forEach((link, index) => {
        console.log(`Link ${index + 1}: ${link.href} - ${link.textContent.trim()}`);
    });
}

// Run test on page load
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(testNavigation, 1000);
}); 