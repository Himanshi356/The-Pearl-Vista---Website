// Admin Services Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Force set the average rating immediately
    setTimeout(() => {
        const avgRating = document.querySelector('.stat-card:nth-child(4) .number');
        if (avgRating) {
            console.log('DOMContentLoaded: Force setting avgRating to 4.2');
            avgRating.textContent = '4.2';
            console.log('DOMContentLoaded: avgRating textContent after setting:', avgRating.textContent);
        } else {
            console.log('DOMContentLoaded: avgRating element not found');
        }
    }, 100);
    
    loadServices();
    loadServiceStats();
    loadServiceBookings();
    setupEventListeners();
});

function setupEventListeners() {
    const addServiceForm = document.querySelector('.add-service-form');
    if (addServiceForm) {
        addServiceForm.addEventListener('submit', handleAddService);
    }
}

function loadServices() {
    console.log('Loading services...');
    fetch('Backend/manage_services.php?action=get_services')
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('API response:', data);
            if (data.status === 'success') {
                displayServices(data.services);
                updateStatistics(data.statistics);
            } else {
                if (data.redirect) {
                    // Session expired, redirect to login
                    console.log('Session expired, redirecting to:', data.redirect);
                    window.location.href = data.redirect;
                } else {
                    showNotification('Failed to load services: ' + data.message, 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error loading services:', error);
            showNotification('Failed to load services', 'error');
        });
}

function loadServiceStats() {
    fetch('Backend/manage_services.php?action=get_service_stats')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                updateDashboardStats(data.statistics);
            } else if (data.redirect) {
                // Session expired, redirect to login
                window.location.href = data.redirect;
            }
        })
        .catch(error => {
            console.error('Error loading service stats:', error);
        });
}

function displayServices(services) {
    const servicesGrid = document.querySelector('.services-grid');
    if (!servicesGrid) return;
    
    servicesGrid.innerHTML = '';
    
    services.forEach(service => {
        const serviceCard = createServiceCard(service);
        servicesGrid.appendChild(serviceCard);
    });
}

function createServiceCard(service) {
    const card = document.createElement('div');
    card.className = 'service-card';
    card.dataset.serviceId = service.id;
    
    const selectedServices = JSON.parse(service.selected_services || '[]');
    const additionalServices = JSON.parse(service.additional_services || '{}');
    const serviceName = selectedServices[0] || 'Unknown Service';
    const description = service.special_requirements || additionalServices.description || 'No description available';
    const duration = additionalServices.duration || 'Not specified';
    
    const icon = getServiceIcon(service.service_category);
    
    card.innerHTML = `
        <div class="service-image">
            <i class="${icon}"></i>
        </div>
        <div class="service-info">
            <div class="service-title">${serviceName}</div>
            <div class="service-price">$${parseFloat(service.total_amount).toFixed(2)}</div>
            <div class="service-description">${description}</div>
            <div class="service-details">
                <small>Category: ${service.service_category}</small><br>
                <small>Duration: ${duration}</small>
            </div>
            <div class="service-status">
                <span class="status-badge status-${service.status === 'confirmed' ? 'available' : 'unavailable'}">
                    ${service.status === 'confirmed' ? 'Available' : 'Unavailable'}
                </span>
                <div class="action-buttons">
                    <button class="btn btn-edit" onclick="editService(${service.id})">Edit</button>
                    <button class="btn btn-delete" onclick="deleteService(${service.id})">Delete</button>
                </div>
            </div>
        </div>
    `;
    
    return card;
}

function getServiceIcon(category) {
    const iconMap = {
        'spa': 'fas fa-spa',
        'dining': 'fas fa-utensils',
        'transport': 'fas fa-car',
        'entertainment': 'fas fa-music',
        'wellness': 'fas fa-heart',
        'leisure': 'fas fa-swimming-pool',
        'events': 'fas fa-calendar-alt',
        'concierge': 'fas fa-concierge-bell',
        'kids': 'fas fa-child',
        'packages': 'fas fa-gift',
        'pet-services': 'fas fa-paw'
    };
    
    return iconMap[category.toLowerCase()] || 'fas fa-star';
}

function updateStatistics(stats) {
    const totalServices = document.querySelector('.stat-card:nth-child(1) .number');
    const activeServices = document.querySelector('.stat-card:nth-child(2) .number');
    const serviceRevenue = document.querySelector('.stat-card:nth-child(3) .number');
    const avgRating = document.querySelector('.stat-card:nth-child(4) .number');
    
    if (totalServices) totalServices.textContent = stats.total_services || 0;
    if (activeServices) activeServices.textContent = stats.active_services || 0;
    if (serviceRevenue) serviceRevenue.textContent = '$' + (parseFloat(stats.service_revenue || 0).toFixed(0));
    if (avgRating) {
        console.log('updateStatistics: Setting avgRating to 4.2');
        avgRating.textContent = '4.2';
        console.log('updateStatistics: avgRating textContent after setting:', avgRating.textContent);
    } else {
        console.log('updateStatistics: avgRating element not found');
    }
}

function updateDashboardStats(stats) {
    const totalServices = document.querySelector('.stat-card:nth-child(1) .number');
    const activeServices = document.querySelector('.stat-card:nth-child(2) .number');
    const serviceRevenue = document.querySelector('.stat-card:nth-child(3) .number');
    const avgRating = document.querySelector('.stat-card:nth-child(4) .number');
    
    if (totalServices) totalServices.textContent = stats.total_services || 0;
    if (activeServices) activeServices.textContent = stats.active_services || 0;
    if (serviceRevenue) serviceRevenue.textContent = '$' + (parseFloat(stats.total_revenue || 0).toFixed(0));
    if (avgRating) {
        console.log('updateDashboardStats: Setting avgRating to 4.2');
        avgRating.textContent = '4.2';
        console.log('updateDashboardStats: avgRating textContent after setting:', avgRating.textContent);
    } else {
        console.log('updateDashboardStats: avgRating element not found');
    }
}

function handleAddService(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    const serviceData = {
        service_name: formData.get('service_name') || event.target.querySelector('input[placeholder*="Spa Treatment"]').value,
        category: formData.get('category') || event.target.querySelector('select').value,
        price: parseFloat(formData.get('price') || event.target.querySelector('input[placeholder*="150"]').value),
        duration: formData.get('duration') || event.target.querySelector('input[placeholder*="2 hours"]').value,
        status: formData.get('status') || event.target.querySelector('select[required]').value,
        description: formData.get('description') || event.target.querySelector('textarea').value
    };
    
    if (!serviceData.service_name || !serviceData.category || !serviceData.price) {
        showNotification('Please fill in all required fields', 'error');
        return;
    }
    
    fetch('Backend/manage_services.php?action=add_service', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(serviceData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Service added successfully!', 'success');
            event.target.reset();
            loadServices();
            loadServiceStats();
        } else {
            showNotification('Failed to add service: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error adding service:', error);
        showNotification('Failed to add service', 'error');
    });
}

function editService(serviceId) {
    fetch('Backend/manage_services.php?action=get_services')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const service = data.services.find(s => s.id == serviceId);
                if (service) {
                    showEditServiceModal(service);
                } else {
                    showNotification('Service not found', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error loading service:', error);
            showNotification('Failed to load service details', 'error');
        });
}

function showEditServiceModal(service) {
    const selectedServices = JSON.parse(service.selected_services || '[]');
    const additionalServices = JSON.parse(service.additional_services || '{}');
    const serviceName = selectedServices[0] || 'Unknown Service';
    
    const modal = document.createElement('div');
    modal.className = 'modal-overlay';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h3>Edit Service</h3>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <form class="edit-service-form">
                <div class="form-group">
                    <label>Service Name</label>
                    <input type="text" name="service_name" value="${serviceName}" required>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select name="category" required>
                        <option value="spa" ${service.service_category === 'spa' ? 'selected' : ''}>Spa & Wellness</option>
                        <option value="dining" ${service.service_category === 'dining' ? 'selected' : ''}>Dining</option>
                        <option value="transport" ${service.service_category === 'transport' ? 'selected' : ''}>Transportation</option>
                        <option value="entertainment" ${service.service_category === 'entertainment' ? 'selected' : ''}>Entertainment</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="number" name="price" value="${service.total_amount}" required>
                </div>
                <div class="form-group">
                    <label>Duration</label>
                    <input type="text" name="duration" value="${additionalServices.duration || ''}">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" required>
                        <option value="confirmed" ${service.status === 'confirmed' ? 'selected' : ''}>Available</option>
                        <option value="pending" ${service.status === 'pending' ? 'selected' : ''}>Unavailable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="3">${service.special_requirements || ''}</textarea>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn-primary">Update Service</button>
                    <button type="button" class="btn-secondary" onclick="closeModal()">Cancel</button>
                </div>
            </form>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    const form = modal.querySelector('.edit-service-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        handleUpdateService(service.id, new FormData(form));
    });
}

function handleUpdateService(serviceId, formData) {
    const serviceData = {
        service_id: serviceId,
        service_name: formData.get('service_name'),
        category: formData.get('category'),
        price: parseFloat(formData.get('price')),
        duration: formData.get('duration'),
        status: formData.get('status'),
        description: formData.get('description')
    };
    
    fetch('Backend/manage_services.php?action=update_service', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(serviceData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Service updated successfully!', 'success');
            closeModal();
            loadServices();
            loadServiceStats();
        } else {
            showNotification('Failed to update service: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error updating service:', error);
        showNotification('Failed to update service', 'error');
    });
}

function deleteService(serviceId) {
    if (!confirm('Are you sure you want to delete this service? This action cannot be undone.')) {
        return;
    }
    
    fetch('Backend/manage_services.php?action=delete_service', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ service_id: serviceId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Service deleted successfully!', 'success');
            loadServices();
            loadServiceStats();
        } else {
            showNotification('Failed to delete service: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error deleting service:', error);
        showNotification('Failed to delete service', 'error');
    });
}

function closeModal() {
    const modal = document.querySelector('.modal-overlay');
    if (modal) {
        modal.remove();
    }
}

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        animation: slideIn 0.3s ease;
    `;
    
    const colors = {
        success: '#28a745',
        error: '#dc3545',
        warning: '#ffc107',
        info: '#17a2b8'
    };
    notification.style.backgroundColor = colors[type] || colors.info;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes slideOut {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
    
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10000;
    }
    
    .modal-content {
        background: white;
        padding: 2rem;
        border-radius: 15px;
        max-width: 500px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
    }
    
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
        color: #666;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }
    
    .btn-secondary {
        background: #6c757d;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }
    
    .booking-row {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr;
        gap: 1rem;
        padding: 1rem;
        border-bottom: 1px solid #dee2e6;
        align-items: center;
    }
    
    .booking-row:hover {
        background-color: #f8f9fa;
    }
    
    .status-badge {
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }
    
    .status-completed {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .action-btn {
        padding: 0.25rem 0.5rem;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 0.8rem;
        margin: 0.1rem;
    }
    
    .btn-view {
        background-color: #17a2b8;
        color: white;
    }
    
    .btn-edit-booking {
        background-color: #ffc107;
        color: #212529;
    }
    
    .btn-cancel-booking {
        background-color: #dc3545;
        color: white;
    }
`;
document.head.appendChild(style);

// Service Bookings Functions
function loadServiceBookings() {
    const statusFilter = document.getElementById('statusFilter').value;
    const categoryFilter = document.getElementById('categoryFilter').value;
    const dateFilter = document.getElementById('dateFilter').value;
    
    let url = 'Backend/manage_services.php?action=get_service_bookings';
    const params = [];
    
    if (statusFilter) params.push(`status=${statusFilter}`);
    if (categoryFilter) params.push(`category=${categoryFilter}`);
    if (dateFilter) params.push(`date=${dateFilter}`);
    
    if (params.length > 0) {
        url += '&' + params.join('&');
    }
    
    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayServiceBookings(data.bookings);
            } else {
                showNotification('Failed to load bookings: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error loading bookings:', error);
            showNotification('Failed to load bookings', 'error');
        });
}

function displayServiceBookings(bookings) {
    const tableBody = document.getElementById('bookingsTableBody');
    
    if (bookings.length === 0) {
        tableBody.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #666;">
                <i class="fas fa-inbox" style="font-size: 1.5rem; color: #d4af37;"></i>
                <p style="margin-top: 0.5rem;">No bookings found</p>
            </div>
        `;
        return;
    }
    
    tableBody.innerHTML = '';
    
    bookings.forEach(booking => {
        const selectedServices = JSON.parse(booking.selected_services || '[]');
        const serviceName = selectedServices[0] || 'Unknown Service';
        const customerName = booking.username || booking.user_id || 'Guest';
        const serviceDate = new Date(booking.service_date).toLocaleDateString();
        const serviceTime = booking.service_time;
        const status = booking.status;
        
        const row = document.createElement('div');
        row.className = 'booking-row';
        row.innerHTML = `
            <div>
                <div style="font-weight: 600;">${customerName}</div>
                <div style="font-size: 0.8rem; color: #666;">${booking.email}</div>
            </div>
            <div>${serviceName}</div>
            <div style="text-transform: capitalize;">${booking.service_category}</div>
            <div>
                <div>${serviceDate}</div>
                <div style="font-size: 0.8rem; color: #666;">${serviceTime}</div>
            </div>
            <div style="font-weight: 600; color: #d4af37;">$${parseFloat(booking.total_amount).toFixed(2)}</div>
            <div>
                <span class="status-badge status-${status}">${status.charAt(0).toUpperCase() + status.slice(1)}</span>
            </div>
            <div>
                <button class="action-btn btn-view" onclick="viewBookingDetails(${booking.id})" title="View Details">
                    <i class="fas fa-eye"></i>
                </button>
                <button class="action-btn btn-edit-booking" onclick="editBookingStatus(${booking.id})" title="Edit Status">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="action-btn btn-cancel-booking" onclick="cancelBooking(${booking.id})" title="Cancel Booking">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        tableBody.appendChild(row);
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

function cancelBooking(bookingId) {
    if (!confirm('Are you sure you want to cancel this booking?')) {
        return;
    }
    
    fetch('Backend/manage_services.php?action=update_booking_status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            booking_id: bookingId, 
            status: 'cancelled' 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showNotification('Booking cancelled successfully!', 'success');
            loadServiceBookings();
        } else {
            showNotification('Failed to cancel booking: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error cancelling booking:', error);
        showNotification('Failed to cancel booking', 'error');
    });
} 