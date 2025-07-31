// Admin Tour Bookings Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the page
    loadTourBookings();
    loadTourStatistics();
    setupEventListeners();
});

// Dynamic CSS for tour bookings table
const style = document.createElement('style');
style.innerHTML = `
    .tour-booking-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        gap: 1rem;
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        align-items: center;
    }
    
    .tour-booking-row:hover {
        background-color: #f8f9fa;
    }
    
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
    }
    
    .status-pending { background-color: #fff3cd; color: #856404; }
    .status-confirmed { background-color: #d4edda; color: #155724; }
    .status-cancelled { background-color: #f8d7da; color: #721c24; }
    
    .action-btn {
        padding: 0.25rem 0.5rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        margin: 0.1rem;
    }
    
    .btn-view { background-color: #17a2b8; color: white; }
    .btn-edit { background-color: #ffc107; color: #212529; }
    .btn-approve { background-color: #28a745; color: white; }
    .btn-reject { background-color: #dc3545; color: white; }
    .btn-delete { background-color: #6c757d; color: white; }
    
    .tour-locations {
        font-size: 0.8rem;
        color: #666;
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
`;
document.head.appendChild(style);

// Tour Bookings Functions
function loadTourBookings() {
    const statusFilter = document.getElementById('statusFilter')?.value || '';
    const tourTypeFilter = document.getElementById('tourTypeFilter')?.value || '';
    const dateFilter = document.getElementById('dateFilter')?.value || '';
    const guestNameFilter = document.getElementById('guestNameFilter')?.value || '';
    
    let url = 'Backend/manage_tour_bookings.php?action=get_tour_bookings';
    const params = [];
    
    if (statusFilter) params.push(`status=${statusFilter}`);
    if (tourTypeFilter) params.push(`tour_type=${tourTypeFilter}`);
    if (dateFilter) params.push(`date=${dateFilter}`);
    if (guestNameFilter) params.push(`guest_name=${guestNameFilter}`);
    
    if (params.length > 0) {
        url += '&' + params.join('&');
    }
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayTourBookings(data.bookings);
            } else {
                if (data.redirect) {
                    window.location.href = 'unified-login.html';
                    return;
                }
                showNotification('Failed to load tour bookings: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error loading tour bookings:', error);
            showNotification('Failed to load tour bookings', 'error');
        });
}

function displayTourBookings(bookings) {
    const tableBody = document.getElementById('tourBookingsTableBody');
    
    if (bookings.length === 0) {
        tableBody.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #666;">
                <i class="fas fa-inbox" style="font-size: 1.5rem; color: #d4af37;"></i>
                <p style="margin-top: 0.5rem;">No tour bookings found</p>
            </div>
        `;
        return;
    }
    
    tableBody.innerHTML = '';
    
    bookings.forEach(booking => {
        const tourDate = new Date(booking.tour_date).toLocaleDateString();
        const tourTime = booking.tour_time;
        const status = booking.status;
        const places = booking.places_to_visit;
        const vehicleType = booking.vehicle_type;
        
        const row = document.createElement('div');
        row.className = 'tour-booking-row';
        row.innerHTML = `
            <div>
                <div style="font-weight: 600;">${booking.full_name}</div>
                <div style="font-size: 0.8rem; color: #666;">${booking.email}</div>
            </div>
            <div>
                <div style="font-weight: 600;">${vehicleType}</div>
                <div class="tour-locations" title="${places}">${places}</div>
            </div>
            <div>
                <div>${tourDate}</div>
                <div style="font-size: 0.8rem; color: #666;">${tourTime}</div>
            </div>
            <div>
                <div style="font-weight: 600;">${booking.number_of_travellers} travelers</div>
                <div style="font-size: 0.8rem; color: #666;">${booking.phone}</div>
            </div>
            <div style="font-weight: 600; color: #d4af37;">$${parseFloat(booking.amount_paid).toFixed(2)}</div>
            <div>
                <span class="status-badge status-${status}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>
            </div>
            <div>
                ${getActionButtons(booking.id, status)}
            </div>
        `;
        
        tableBody.appendChild(row);
    });
}

function getActionButtons(bookingId, status) {
    let buttons = `
        <button class="action-btn btn-view" onclick="viewBookingDetails(${bookingId})" title="View Details">
            <i class="fas fa-eye"></i>
        </button>
    `;
    
    if (status === 'pending') {
        buttons += `
            <button class="action-btn btn-approve" onclick="approveBooking(${bookingId})" title="Approve">
                <i class="fas fa-check"></i>
            </button>
            <button class="action-btn btn-reject" onclick="rejectBooking(${bookingId})" title="Reject">
                <i class="fas fa-times"></i>
            </button>
        `;
    } else {
        buttons += `
            <button class="action-btn btn-edit" onclick="editBookingStatus(${bookingId})" title="Edit Status">
                <i class="fas fa-edit"></i>
            </button>
        `;
    }
    
    buttons += `
        <button class="action-btn btn-delete" onclick="deleteBooking(${bookingId})" title="Delete">
            <i class="fas fa-trash"></i>
        </button>
    `;
    
    return buttons;
}

function loadTourStatistics() {
    fetch('Backend/manage_tour_bookings.php?action=get_tour_statistics')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateStatisticsCards(data.statistics);
            } else {
                if (data.redirect) {
                    window.location.href = 'unified-login.html';
                    return;
                }
                console.error('Failed to load statistics:', data.message);
            }
        })
        .catch(error => {
            console.error('Error loading statistics:', error);
        });
}

function updateStatisticsCards(stats) {
    // Update total bookings
    const totalElement = document.querySelector('.stat-card:nth-child(1) .number');
    if (totalElement) {
        totalElement.textContent = stats.total_bookings;
    }
    
    // Update confirmed bookings
    const confirmedElement = document.querySelector('.stat-card:nth-child(2) .number');
    if (confirmedElement) {
        confirmedElement.textContent = stats.confirmed_bookings;
    }
    
    // Update pending bookings
    const pendingElement = document.querySelector('.stat-card:nth-child(3) .number');
    if (pendingElement) {
        pendingElement.textContent = stats.pending_bookings;
    }
    
    // Update revenue
    const revenueElement = document.querySelector('.stat-card:nth-child(4) .number');
    if (revenueElement) {
        revenueElement.textContent = '$' + parseFloat(stats.total_revenue).toLocaleString();
    }
    
    // Update change percentages
    const bookingChangeElement = document.querySelector('.stat-card:nth-child(1) .change');
    if (bookingChangeElement) {
        const changeText = stats.booking_change >= 0 ? `+${stats.booking_change}%` : `${stats.booking_change}%`;
        bookingChangeElement.textContent = `${changeText} vs last month`;
        bookingChangeElement.className = `change ${stats.booking_change < 0 ? 'negative' : ''}`;
    }
    
    const confirmedChangeElement = document.querySelector('.stat-card:nth-child(2) .change');
    if (confirmedChangeElement) {
        const changeText = stats.booking_change >= 0 ? `+${stats.booking_change}%` : `${stats.booking_change}%`;
        confirmedChangeElement.textContent = `${changeText} vs last month`;
        confirmedChangeElement.className = `change ${stats.booking_change < 0 ? 'negative' : ''}`;
    }
    
    const pendingChangeElement = document.querySelector('.stat-card:nth-child(3) .change');
    if (pendingChangeElement) {
        const changeText = stats.booking_change >= 0 ? `+${stats.booking_change}%` : `${stats.booking_change}%`;
        pendingChangeElement.textContent = `${changeText} vs last month`;
        pendingChangeElement.className = `change ${stats.booking_change < 0 ? 'negative' : ''}`;
    }
    
    const revenueChangeElement = document.querySelector('.stat-card:nth-child(4) .change');
    if (revenueChangeElement) {
        const changeText = stats.revenue_change >= 0 ? `+${stats.revenue_change}%` : `${stats.revenue_change}%`;
        revenueChangeElement.textContent = `${changeText} vs last month`;
        revenueChangeElement.className = `change ${stats.revenue_change < 0 ? 'negative' : ''}`;
    }
}

function approveBooking(bookingId) {
    updateBookingStatus(bookingId, 'confirmed');
}

function rejectBooking(bookingId) {
    updateBookingStatus(bookingId, 'cancelled');
}

function updateBookingStatus(bookingId, status) {
    fetch('Backend/manage_tour_bookings.php?action=update_booking_status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            booking_id: bookingId, 
            status: status 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification(`Booking ${status} successfully!`, 'success');
            loadTourBookings();
            loadTourStatistics();
        } else {
            showNotification('Failed to update booking: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error updating booking:', error);
        showNotification('Failed to update booking', 'error');
    });
}

function deleteBooking(bookingId) {
    if (!confirm('Are you sure you want to delete this booking?')) {
        return;
    }
    
    fetch('Backend/manage_tour_bookings.php?action=delete_booking', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            booking_id: bookingId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Booking deleted successfully!', 'success');
            loadTourBookings();
            loadTourStatistics();
        } else {
            showNotification('Failed to delete booking: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error deleting booking:', error);
        showNotification('Failed to delete booking', 'error');
    });
}

function viewBookingDetails(bookingId) {
    // This would open a modal with detailed booking information
    showNotification('View booking details - ID: ' + bookingId, 'info');
}

function editBookingStatus(bookingId) {
    // This would open a modal to edit booking status
    showNotification('Edit booking status - ID: ' + bookingId, 'info');
}

function setupEventListeners() {
    // Add event listeners for filters
    const statusFilter = document.getElementById('statusFilter');
    const tourTypeFilter = document.getElementById('tourTypeFilter');
    const dateFilter = document.getElementById('dateFilter');
    const guestNameFilter = document.getElementById('guestNameFilter');
    
    if (statusFilter) {
        statusFilter.addEventListener('change', loadTourBookings);
    }
    
    if (tourTypeFilter) {
        tourTypeFilter.addEventListener('change', loadTourBookings);
    }
    
    if (dateFilter) {
        dateFilter.addEventListener('change', loadTourBookings);
    }
    
    if (guestNameFilter) {
        guestNameFilter.addEventListener('input', debounce(loadTourBookings, 500));
    }
}

function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Helper function to show notifications
function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        max-width: 300px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    `;
    
    // Set background color based on type
    switch (type) {
        case 'success':
            notification.style.backgroundColor = '#28a745';
            break;
        case 'error':
            notification.style.backgroundColor = '#dc3545';
            break;
        case 'warning':
            notification.style.backgroundColor = '#ffc107';
            notification.style.color = '#212529';
            break;
        default:
            notification.style.backgroundColor = '#17a2b8';
    }
    
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        if (notification.parentNode) {
            notification.parentNode.removeChild(notification);
        }
    }, 3000);
} 