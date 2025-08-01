// Admin Data Loader - Handles data loading for all admin dashboard pages
class AdminDataLoader {
    constructor() {
        this.currentPage = this.getCurrentPage();
        this.init();
    }

    getCurrentPage() {
        const path = window.location.pathname;
        if (path.includes('admin-dashboard')) return 'dashboard';
        if (path.includes('admin-rooms')) return 'rooms';
        if (path.includes('admin-bookings')) return 'bookings';
        if (path.includes('admin-customers')) return 'customers';
        if (path.includes('admin-services')) return 'services';
        if (path.includes('admin-tour-bookings')) return 'tour-bookings';
        if (path.includes('admin-reports')) return 'reports';
        return 'dashboard';
    }

    init() {
        this.loadPageData();
        this.setupEventListeners();
    }

    async loadPageData() {
        try {
            switch (this.currentPage) {
                case 'dashboard':
                    await this.loadDashboardData();
                    break;
                case 'rooms':
                    await this.loadRoomsData();
                    break;
                case 'bookings':
                    await this.loadBookingsData();
                    break;
                case 'customers':
                    await this.loadCustomersData();
                    break;
                case 'services':
                    await this.loadServicesData();
                    break;
                case 'tour-bookings':
                    await this.loadTourBookingsData();
                    break;
                case 'reports':
                    await this.loadReportsData();
                    break;
            }
        } catch (error) {
            console.error('Error loading page data:', error);
            this.showError('Failed to load data. Please refresh the page.');
        }
    }

    async loadDashboardData() {
        const response = await fetch('Backend/Admin/get_admin_data.php', {
            credentials: 'include'
        });
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateDashboardStats(data);
        }
    }

    async loadRoomsData() {
        const response = await fetch('Backend/Admin/get_rooms_data.php', {
            credentials: 'include'
        });
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateRoomsDisplay(data);
        }
    }

    async loadBookingsData() {
        const response = await fetch('Backend/Admin/get_bookings_data.php', {
            credentials: 'include'
        });
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateBookingsDisplay(data);
            this.updateBookingsStats(data.statistics);
        }

        // Load room types for filter dropdowns
        await this.loadRoomTypesForDropdowns();
        
        // Setup booking filters
        this.setupBookingFilters();
    }

    updateBookingsStats(stats) {
        if (!stats) return;
        
        // Update statistics cards
        const totalBookingsElement = document.querySelector('.stat-card .number');
        const confirmedElement = document.querySelectorAll('.stat-card .number')[1];
        const pendingElement = document.querySelectorAll('.stat-card .number')[2];
        const cancelledElement = document.querySelectorAll('.stat-card .number')[3];
        const checkedInElement = document.querySelectorAll('.stat-card .number')[4];
        const completedElement = document.querySelectorAll('.stat-card .number')[5];
        const revenueElement = document.querySelectorAll('.stat-card .number')[6];
        
        if (totalBookingsElement) {
            totalBookingsElement.textContent = stats.total_bookings || 0;
        }
        if (confirmedElement) {
            confirmedElement.textContent = stats.confirmed_bookings || 0;
        }
        if (pendingElement) {
            pendingElement.textContent = stats.pending_bookings || 0;
        }
        if (cancelledElement) {
            cancelledElement.textContent = stats.cancelled_bookings || 0;
        }
        if (checkedInElement) {
            checkedInElement.textContent = stats.checked_in_bookings || 0;
        }
        if (completedElement) {
            completedElement.textContent = stats.completed_bookings || 0;
        }
        if (revenueElement) {
            revenueElement.textContent = '$' + (stats.total_revenue || 0).toLocaleString();
        }
    }

    async loadCustomersData() {
        const response = await fetch('Backend/Admin/get_customers_data.php');
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateCustomersDisplay(data);
        }
    }

    async loadServicesData() {
        const response = await fetch('Backend/Admin/get_services_data.php');
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateServicesDisplay(data);
        }
    }

    async loadTourBookingsData() {
        const response = await fetch('Backend/Admin/get_tour_bookings_data.php');
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateTourBookingsDisplay(data);
        }
    }

    async loadReportsData() {
        const response = await fetch('Backend/Admin/get_reports_data.php');
        const data = await response.json();
        
        if (data.status === 'success') {
            this.updateReportsDisplay(data);
        }
    }

    updateDashboardStats(data) {
        // Update admin profile
        if (data.admin_data) {
            const admin = data.admin_data;
            const nameElement = document.getElementById('adminName');
            const roleElement = document.getElementById('adminRole');
            
            if (nameElement) {
                nameElement.textContent = admin.name || (admin.first_name + ' ' + admin.last_name) || admin.username || 'Admin User';
            }
            if (roleElement) {
                roleElement.textContent = admin.role || 'Administrator';
            }
        }

        // Update statistics
        if (data.statistics) {
            const stats = data.statistics;
            this.updateElement('totalAdmins', stats.total_admins || 0);
            this.updateElement('totalRooms', stats.total_rooms || 0);
            this.updateElement('activeBookings', stats.active_bookings || 0);
            this.updateElement('totalActivity', stats.total_activity || 0);
        }

        // Update activity log
        if (data.recent_activity) {
            this.updateActivityLog(data.recent_activity);
        }
    }

    updateRoomsDisplay(data) {
        const roomsContainer = document.getElementById('roomsGrid');
        if (!roomsContainer) return;

        let html = '';
        
        if (data.room_types && data.room_types.length > 0) {
            data.room_types.forEach(roomType => {
                html += this.createRoomCard(roomType);
            });
        } else {
            html = '<div class="no-data">No room types found</div>';
        }

        roomsContainer.innerHTML = html;
    }

    createRoomCard(roomType) {
        // Use available_rooms from database
        const availableRooms = roomType.available_rooms || 0;
        const statusClass = availableRooms > 0 ? 'status-available' : 'status-occupied';
        const statusText = availableRooms > 0 ? 'Available' : 'Fully Booked';
        
        // Get the appropriate image for each room type
        let imagePath = '';
        switch(roomType.room_type) {
            case 'Pearl Signature Room':
                imagePath = 'images/sophistication-room.png';
                break;
            case 'Suite King':
                imagePath = 'images/luxury_suite.jpg'; // Using luxury suite image as fallback
                break;
            case 'Vista Love':
                imagePath = 'images/sophistication-room.png'; // Using premium image for luxury room
                break;
            case 'Deluxe Room':
                imagePath = 'Gallery/deluxe_room1.jpg';
                break;
            case 'Premium Room':
                imagePath = 'images/Premium_room1.png';
                break;
            case 'Executive Room':
                imagePath = 'Gallery/Executive_room2.jpg';
                break;
            case 'Luxury Suite':
                imagePath = 'images/luxury_suite.jpg';
                break;
            case 'Family Suite':
                imagePath = 'images/Family_suite.jpg';
                break;
            default:
                imagePath = 'images/luxury_suite.jpg'; // Default to luxury suite image for new room types
        }
        
        return `
            <div class="room-card" data-room-type="${roomType.room_type}">
                <div class="room-image">
                    ${imagePath ? `<img src="${imagePath}" alt="${roomType.room_type}" style="width: 100%; height: 100%; object-fit: cover;">` : '<i class="fas fa-bed"></i>'}
                </div>
                <div class="room-info">
                    <div class="room-title">${roomType.room_type}</div>
                    <div class="room-price">$${roomType.base_price.toLocaleString()}/night</div>
                    <div class="room-features">
                        <span class="feature-tag">Floor ${roomType.floor_number}</span>
                        <span class="feature-tag">${roomType.total_rooms} Rooms</span>
                        <span class="feature-tag">${availableRooms} Available</span>
                    </div>
                    <div class="room-status">
                        <span class="status-badge ${statusClass}">${statusText}</span>
                        <div class="action-buttons">
                            <button class="btn btn-edit" onclick="openEditModal('${roomType.room_type}')">Edit</button>
                            <button class="btn btn-delete" onclick="deleteRoom('${roomType.room_type}')">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    updateBookingsDisplay(data) {
        const bookingsContainer = document.getElementById('bookingsTable');
        if (!bookingsContainer) return;

        let html = '';
        
        if (data.bookings && data.bookings.length > 0) {
            data.bookings.forEach(booking => {
                const statusClass = `status-${booking.status.toLowerCase()}`;
                const statusText = booking.status.charAt(0).toUpperCase() + booking.status.slice(1);
                
                html += `
                    <div class="booking-card">
                        <div class="booking-header">
                            <div class="booking-id">${booking.booking_id || 'N/A'}</div>
                            <div class="booking-status ${statusClass}">${statusText}</div>
                        </div>
                        <div class="booking-details">
                            <div class="detail-group">
                                <div class="detail-label">Customer Name</div>
                                <div class="detail-value">${booking.customer_name}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">${booking.customer_email}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Phone</div>
                                <div class="detail-value">${booking.customer_phone || 'N/A'}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Room Type</div>
                                <div class="detail-value">${booking.room_type}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Check In</div>
                                <div class="detail-value">${booking.check_in_date}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Check Out</div>
                                <div class="detail-value">${booking.check_out_date}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Guests</div>
                                <div class="detail-value">${booking.num_guests}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Rooms</div>
                                <div class="detail-value">${booking.num_rooms}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Total Amount</div>
                                <div class="detail-value">$${parseFloat(booking.total_amount).toLocaleString()}</div>
                            </div>
                            <div class="detail-group">
                                <div class="detail-label">Special Instructions</div>
                                <div class="detail-value">${booking.special_instructions || 'None'}</div>
                            </div>
                        </div>
                        <div class="booking-actions">
                            <button class="btn btn-view" onclick="viewBooking(${booking.id})">View Details</button>
                            <button class="btn btn-edit" onclick="editBooking(${booking.id})">Edit</button>
                            <button class="btn btn-approve" onclick="updateBookingStatus(${booking.id}, 'confirmed')">Approve</button>
                            <button class="btn btn-reject" onclick="updateBookingStatus(${booking.id}, 'cancelled')">Reject</button>
                        </div>
                    </div>
                `;
            });
        } else {
            html = '<div style="text-align: center; padding: 2rem; color: #666;">No bookings found</div>';
        }

        bookingsContainer.innerHTML = html;
    }

    updateCustomersDisplay(data) {
        const customersContainer = document.getElementById('customersTable');
        if (!customersContainer) return;

        let html = '';
        
        if (data.customers && data.customers.length > 0) {
            html = '<table><thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Bookings</th><th>Total Spent</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
            
            data.customers.forEach(customer => {
                const statusClass = customer.verified ? 'verified' : 'unverified';
                const statusText = customer.verified ? 'Verified' : 'Unverified';
                
                html += `
                    <tr>
                        <td>${customer.full_name || customer.username}</td>
                        <td>${customer.email}</td>
                        <td>${customer.phone || 'N/A'}</td>
                        <td>${customer.total_bookings || 0}</td>
                        <td>$${customer.total_spent || 0}</td>
                        <td><span class="status-${statusClass}">${statusText}</span></td>
                        <td>
                            <button onclick="viewCustomer(${customer.user_id})">View</button>
                            <button onclick="editCustomer(${customer.user_id})">Edit</button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
        } else {
            html = '<div class="no-data">No customers found</div>';
        }

        customersContainer.innerHTML = html;
    }

    updateServicesDisplay(data) {
        const servicesContainer = document.getElementById('servicesTable');
        if (!servicesContainer) return;

        let html = '';
        
        if (data.service_bookings && data.service_bookings.length > 0) {
            html = '<table><thead><tr><th>Booking ID</th><th>Customer</th><th>Service</th><th>Date</th><th>Amount</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
            
            data.service_bookings.forEach(booking => {
                html += `
                    <tr>
                        <td>${booking.booking_id}</td>
                        <td>${booking.username}</td>
                        <td>${booking.service_category}</td>
                        <td>${booking.service_date}</td>
                        <td>$${booking.total_amount}</td>
                        <td><span class="status-${booking.status}">${booking.status}</span></td>
                        <td>
                            <button onclick="viewServiceBooking(${booking.id})">View</button>
                            <button onclick="updateServiceStatus(${booking.id})">Update</button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
        } else {
            html = '<div class="no-data">No service bookings found</div>';
        }

        servicesContainer.innerHTML = html;
    }

    updateTourBookingsDisplay(data) {
        const toursContainer = document.getElementById('toursTable');
        if (!toursContainer) return;

        let html = '';
        
        if (data.tour_bookings && data.tour_bookings.length > 0) {
            html = '<table><thead><tr><th>Customer</th><th>Destination</th><th>Date</th><th>Travelers</th><th>Vehicle</th><th>Amount</th><th>Status</th><th>Actions</th></tr></thead><tbody>';
            
            data.tour_bookings.forEach(booking => {
                html += `
                    <tr>
                        <td>${booking.full_name}</td>
                        <td>${booking.places_to_visit}</td>
                        <td>${booking.tour_date}</td>
                        <td>${booking.number_of_travellers}</td>
                        <td>${booking.vehicle_type}</td>
                        <td>$${booking.amount_paid}</td>
                        <td><span class="status-${booking.status}">${booking.status}</span></td>
                        <td>
                            <button onclick="viewTourBooking(${booking.id})">View</button>
                            <button onclick="updateTourStatus(${booking.id})">Update</button>
                        </td>
                    </tr>
                `;
            });
            
            html += '</tbody></table>';
        } else {
            html = '<div class="no-data">No tour bookings found</div>';
        }

        toursContainer.innerHTML = html;
    }

    updateReportsDisplay(data) {
        // Update overall statistics
        if (data.overall_stats) {
            this.updateElement('totalCustomers', data.overall_stats.total_customers || 0);
            this.updateElement('totalRoomBookings', data.overall_stats.total_room_bookings || 0);
            this.updateElement('totalServiceBookings', data.overall_stats.total_service_bookings || 0);
            this.updateElement('totalTourBookings', data.overall_stats.total_tour_bookings || 0);
            this.updateElement('totalRevenue', '$' + (data.overall_stats.total_room_revenue + data.overall_stats.total_service_revenue + data.overall_stats.total_tour_revenue || 0).toLocaleString());
        }

        // Update charts and other report elements
        if (data.monthly_revenue) {
            this.updateRevenueChart(data.monthly_revenue);
        }

        if (data.occupancy_rates) {
            this.updateOccupancyChart(data.occupancy_rates);
        }
    }

    updateElement(elementId, value) {
        const element = document.getElementById(elementId);
        if (element) {
            element.textContent = value;
        }
    }

    updateActivityLog(activities) {
        const activityContainer = document.getElementById('activityLog');
        if (!activityContainer) return;

        let html = '';
        
        if (activities && activities.length > 0) {
            activities.forEach(activity => {
                html += `
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="activity-content">
                            <h4>${activity.action}</h4>
                            <p>${activity.description || 'Activity logged'} - ${activity.created_at}</p>
                        </div>
                    </div>
                `;
            });
        } else {
            html = `
                <div class="activity-item">
                    <div class="activity-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div class="activity-content">
                        <h4>No Recent Activity</h4>
                        <p>No recent activities to display</p>
                    </div>
                </div>
            `;
        }

        activityContainer.innerHTML = html;
    }

    updateRevenueChart(data) {
        // Implementation for revenue chart
        console.log('Revenue chart data:', data);
    }

    updateOccupancyChart(data) {
        // Implementation for occupancy chart
        console.log('Occupancy chart data:', data);
    }

    setupEventListeners() {
        // Add event listeners for interactive elements
        document.addEventListener('DOMContentLoaded', () => {
            // Setup form submissions
            const addRoomForm = document.querySelector('.add-room-form');
            if (addRoomForm) {
                addRoomForm.addEventListener('submit', this.handleAddRoom.bind(this));
            }

            // Setup search and filter functionality
            const searchInputs = document.querySelectorAll('.search-input');
            searchInputs.forEach(input => {
                input.addEventListener('input', this.handleSearch.bind(this));
            });
            
            // Setup refresh availability button
            const refreshButton = document.querySelector('.refresh-availability');
            if (refreshButton) {
                refreshButton.addEventListener('click', this.refreshRoomAvailability.bind(this));
            }

            // Setup booking filters
            this.setupBookingFilters();

            // Load room types for dropdowns
            this.loadRoomTypesForDropdowns();
        });
    }

    setupBookingFilters() {
        const filterForm = document.querySelector('.filters-grid');
        if (!filterForm) return;

        // Add event listeners to filter inputs
        const statusSelect = filterForm.querySelector('select');
        const dateInput = filterForm.querySelector('input[type="date"]');
        const nameInput = filterForm.querySelector('input[placeholder="Search by name"]');
        const roomTypeSelect = filterForm.querySelectorAll('select')[1];

        if (statusSelect) {
            statusSelect.addEventListener('change', () => this.applyFilters());
        }
        if (dateInput) {
            dateInput.addEventListener('change', () => this.applyFilters());
        }
        if (nameInput) {
            // Add debounce to prevent too many requests when typing
            let debounceTimer;
            nameInput.addEventListener('input', () => {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => this.applyFilters(), 500);
            });
        }
        if (roomTypeSelect) {
            roomTypeSelect.addEventListener('change', () => this.applyFilters());
        }

        // Add clear filters button
        this.addClearFiltersButton();
    }

    async applyFilters() {
        const filterForm = document.querySelector('.filters-grid');
        if (!filterForm) return;

        const status = filterForm.querySelector('select').value;
        const date = filterForm.querySelector('input[type="date"]').value;
        const name = filterForm.querySelector('input[placeholder="Search by name"]').value;
        const roomType = filterForm.querySelectorAll('select')[1].value;

        // Show loading state
        const bookingsTable = document.getElementById('bookingsTable');
        if (bookingsTable) {
            bookingsTable.innerHTML = '<div class="loading">Applying filters...</div>';
        }

        try {
            const response = await fetch('Backend/Admin/get_bookings_data.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include',
                body: JSON.stringify({
                    status: status,
                    date: date,
                    name: name,
                    room_type: roomType
                })
            });
            
            const data = await response.json();
            
            if (data.status === 'success') {
                this.updateBookingsDisplay(data);
            } else {
                console.error('Filter error:', data.message);
                if (bookingsTable) {
                    bookingsTable.innerHTML = '<div class="error">Error applying filters. Please try again.</div>';
                }
            }
        } catch (error) {
            console.error('Error applying filters:', error);
            if (bookingsTable) {
                bookingsTable.innerHTML = '<div class="error">Error applying filters. Please try again.</div>';
            }
        }
    }

    async loadRoomTypesForDropdowns() {
        try {
            const response = await fetch('Backend/Admin/get_room_types.php', {
                credentials: 'include'
            });
            const data = await response.json();
            
            if (data.status === 'success') {
                this.populateRoomTypeDropdowns(data.room_types);
                this.populateFilterDropdowns(data.room_types);
            }
        } catch (error) {
            console.error('Error loading room types:', error);
        }
    }

    populateRoomTypeDropdowns(roomTypes) {
        // Populate add room form dropdown
        const addRoomTypeSelect = document.getElementById('roomTypeSelect');
        if (addRoomTypeSelect) {
            addRoomTypeSelect.innerHTML = '<option value="">Select Type</option>';
            roomTypes.forEach(roomType => {
                const option = document.createElement('option');
                option.value = roomType.room_type;
                option.textContent = roomType.room_type;
                addRoomTypeSelect.appendChild(option);
            });
            // Add "Others" option
            const othersOption = document.createElement('option');
            othersOption.value = 'Others';
            othersOption.textContent = 'Others';
            addRoomTypeSelect.appendChild(othersOption);
        }

        // Populate edit room form dropdown
        const editRoomTypeSelect = document.getElementById('editRoomTypeSelect');
        if (editRoomTypeSelect) {
            editRoomTypeSelect.innerHTML = '';
            roomTypes.forEach(roomType => {
                const option = document.createElement('option');
                option.value = roomType.room_type;
                option.textContent = roomType.room_type;
                editRoomTypeSelect.appendChild(option);
            });
            // Add "Others" option
            const othersOption = document.createElement('option');
            othersOption.value = 'Others';
            othersOption.textContent = 'Others';
            editRoomTypeSelect.appendChild(othersOption);
        }
    }

    populateFilterDropdowns(roomTypes) {
        // Populate the filter dropdown for room types
        const filterForm = document.querySelector('.filters-grid');
        if (!filterForm) return;

        const roomTypeSelect = filterForm.querySelectorAll('select')[1]; // Second select is room type
        if (roomTypeSelect) {
            // Keep the "All Types" option
            roomTypeSelect.innerHTML = '<option value="">All Types</option>';
            
            // Add room types from database
            roomTypes.forEach(roomType => {
                const option = document.createElement('option');
                option.value = roomType.room_type;
                option.textContent = roomType.room_type;
                roomTypeSelect.appendChild(option);
            });
        }
    }

    addClearFiltersButton() {
        const filterForm = document.querySelector('.filters-grid');
        if (!filterForm) return;

        // Check if clear button already exists
        if (filterForm.querySelector('.clear-filters-btn')) return;

        // Create clear filters button
        const clearButton = document.createElement('button');
        clearButton.className = 'clear-filters-btn';
        clearButton.innerHTML = '<i class="fas fa-times"></i> Clear Filters';
        clearButton.style.cssText = `
            background: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            margin-top: 10px;
            display: flex;
            align-items: center;
            gap: 5px;
        `;

        clearButton.addEventListener('click', () => this.clearFilters());
        filterForm.appendChild(clearButton);
    }

    clearFilters() {
        const filterForm = document.querySelector('.filters-grid');
        if (!filterForm) return;

        // Reset all filter inputs
        const statusSelect = filterForm.querySelector('select');
        const dateInput = filterForm.querySelector('input[type="date"]');
        const nameInput = filterForm.querySelector('input[placeholder="Search by name"]');
        const roomTypeSelect = filterForm.querySelectorAll('select')[1];

        if (statusSelect) statusSelect.value = '';
        if (dateInput) dateInput.value = '';
        if (nameInput) nameInput.value = '';
        if (roomTypeSelect) roomTypeSelect.value = '';

        // Reload all bookings
        this.loadBookingsData();
    }

    async refreshRoomAvailability() {
        try {
            // Update room availability in database
            const response = await fetch('Backend/Admin/update_room_availability.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                credentials: 'include'
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                // Reload room data to show updated availability
                await this.loadRoomsData();
                console.log('Room availability refreshed successfully');
            } else {
                console.error('Failed to refresh room availability:', result.message);
            }
        } catch (error) {
            console.error('Error refreshing room availability:', error);
        }
    }

    async handleAddRoom(event) {
        event.preventDefault();
        
        const formData = new FormData(event.target);
        const roomData = {
            room_number: formData.get('room_number'),
            room_type: formData.get('room_type'),
            price_per_night: parseFloat(formData.get('price_per_night')),
            description: formData.get('description'),
            floor: parseInt(formData.get('floor')),
            status: formData.get('status')
        };
        
        try {
            const response = await fetch('Backend/Admin/add_room.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(roomData)
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                alert('Room added successfully!');
                event.target.reset();
                // Reload room data
                await this.loadRoomsData();
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error adding room:', error);
            alert('Failed to add room. Please try again.');
        }
    }

    handleSearch(event) {
        // Implementation for search functionality
        console.log('Searching...', event.target.value);
    }

    showError(message) {
        // Show error message to user
        console.error(message);
        // You can implement a toast notification system here
    }
}

// Initialize the data loader when the page loads
document.addEventListener('DOMContentLoaded', () => {
    new AdminDataLoader();
});

// Global functions for admin actions
async function editRoom(roomType) {
    // Get current room data from the displayed cards
    const roomCard = document.querySelector(`[data-room-type="${roomType}"]`);
    if (!roomCard) {
        alert('Room data not found');
        return;
    }
    
    // Extract current values from the card
    const priceElement = roomCard.querySelector('.room-price');
    const featuresElement = roomCard.querySelector('.room-features');
    const statusElement = roomCard.querySelector('.status-badge');
    
    const currentPrice = parseFloat(priceElement.textContent.replace('$', '').replace('/night', '').replace(',', ''));
    const floorElement = featuresElement.querySelector('.feature-tag');
    const totalRoomsElement = featuresElement.querySelectorAll('.feature-tag')[1];
    const availableRoomsElement = featuresElement.querySelectorAll('.feature-tag')[2];
    
    const currentFloor = parseInt(floorElement.textContent.replace('Floor ', ''));
    const currentTotalRooms = parseInt(totalRoomsElement.textContent.replace(' Rooms', ''));
    const currentAvailableRooms = parseInt(availableRoomsElement.textContent.replace(' Available', ''));
    const currentStatus = statusElement.textContent;
    
    // Create a comprehensive form for editing all values
    const newPrice = prompt(`Enter new price for ${roomType} (current: $${currentPrice.toLocaleString()}):`, currentPrice);
    if (newPrice === null) return;
    
    const newTotalRooms = prompt(`Enter new total rooms for ${roomType} (current: ${currentTotalRooms}):`, currentTotalRooms);
    if (newTotalRooms === null) return;
    
    const newAvailableRooms = prompt(`Enter new available rooms for ${roomType} (current: ${currentAvailableRooms}):`, currentAvailableRooms);
    if (newAvailableRooms === null) return;
    
    const newFloor = prompt(`Enter new floor number for ${roomType} (current: ${currentFloor}):`, currentFloor);
    if (newFloor === null) return;
    
    const statusOptions = ['Available', 'Fully Booked', 'Maintenance'];
    const currentStatusIndex = statusOptions.indexOf(currentStatus);
    const newStatus = prompt(`Enter new status for ${roomType} (0=Available, 1=Fully Booked, 2=Maintenance) (current: ${currentStatusIndex}):`, currentStatusIndex);
    if (newStatus === null) return;
    
    const newDescription = prompt(`Enter new description for ${roomType} (optional):`, '');
    
    try {
        const response = await fetch('Backend/Admin/edit_room.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                room_type: roomType,
                base_price: parseFloat(newPrice),
                total_rooms: parseInt(newTotalRooms),
                available_rooms: parseInt(newAvailableRooms),
                floor_number: parseInt(newFloor),
                status: statusOptions[parseInt(newStatus)],
                description: newDescription
            })
        });
        
        const result = await response.json();
        
        if (result.status === 'success') {
            alert('Room updated successfully!');
            // Reload the page to refresh data
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error updating room:', error);
        alert('Failed to update room. Please try again.');
    }
}

async function deleteRoom(roomType) {
    if (confirm(`Are you sure you want to delete the room type "${roomType}"? This action cannot be undone.`)) {
        try {
            const response = await fetch('Backend/Admin/delete_room.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    room_type: roomType
                })
            });
            
            const result = await response.json();
            
            if (result.status === 'success') {
                alert('Room type deleted successfully!');
                // Reload the page to refresh data
                location.reload();
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error deleting room:', error);
            alert('Failed to delete room. Please try again.');
        }
    }
}

// Booking management functions
async function viewBooking(bookingId) {
    console.log('Viewing booking:', bookingId);
    
    try {
        const response = await fetch(`Backend/Admin/get_booking_details.php?id=${bookingId}`);
        console.log('Response status:', response.status);
        const data = await response.json();
        console.log('Response data:', data);
        
        if (data.success) {
            showBookingDetailsModal(data.booking);
        } else {
            alert('Error loading booking details: ' + data.message);
        }
    } catch (error) {
        console.error('Error viewing booking:', error);
        alert('Failed to load booking details. Please try again.');
    }
}

async function editBooking(bookingId) {
    try {
        const response = await fetch(`Backend/Admin/get_booking_details.php?id=${bookingId}`);
        const data = await response.json();
        
        if (data.success) {
            showEditBookingModal(data.booking);
        } else {
            alert('Error loading booking details: ' + data.message);
        }
    } catch (error) {
        console.error('Error editing booking:', error);
        alert('Failed to load booking details. Please try again.');
    }
}

async function updateBookingStatus(bookingId, newStatus = null) {
    if (!newStatus) {
        newStatus = prompt('Enter new status (pending/confirmed/cancelled):');
        if (!newStatus) return;
    }
    
    console.log('Updating booking status:', { bookingId, newStatus });
    
    try {
        const response = await fetch('Backend/update_bookings_status.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            credentials: 'include',
            body: JSON.stringify({
                booking_id: bookingId,
                status: newStatus,
                table: 'home_bookings'
            })
        });
        
        console.log('Response status:', response.status);
        const result = await response.json();
        console.log('Response data:', result);
        
        if (result.success) {
            alert('Booking status updated successfully!');
            // Reload the page to refresh data
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error updating booking status:', error);
        alert('Failed to update booking status. Please try again.');
    }
}

// Modal functions
function showBookingDetailsModal(booking) {
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>Booking Details - ${booking.booking_id}</h2>
                <span class="close" onclick="closeModal(this)">&times;</span>
            </div>
            <div class="modal-body">
                <div class="booking-details-grid">
                    <div class="detail-section">
                        <h3>Customer Information</h3>
                        <p><strong>Name:</strong> ${booking.customer_name}</p>
                        <p><strong>Email:</strong> ${booking.customer_email}</p>
                        <p><strong>Phone:</strong> ${booking.customer_phone || 'N/A'}</p>
                    </div>
                    <div class="detail-section">
                        <h3>Booking Information</h3>
                        <p><strong>Room Type:</strong> ${booking.room_type}</p>
                        <p><strong>Check In:</strong> ${booking.check_in_date}</p>
                        <p><strong>Check Out:</strong> ${booking.check_out_date}</p>
                        <p><strong>Duration:</strong> ${booking.duration_days || 0} days</p>
                    </div>
                    <div class="detail-section">
                        <h3>Guest Information</h3>
                        <p><strong>Number of Guests:</strong> ${booking.num_guests}</p>
                        <p><strong>Number of Rooms:</strong> ${booking.num_rooms}</p>
                    </div>
                    <div class="detail-section">
                        <h3>Financial Information</h3>
                        <p><strong>Total Amount:</strong> $${parseFloat(booking.total_amount).toLocaleString()}</p>
                        <p><strong>Status:</strong> <span class="status-${booking.status.toLowerCase()}">${booking.status}</span></p>
                    </div>
                    <div class="detail-section full-width">
                        <h3>Special Instructions</h3>
                        <p>${booking.special_instructions || 'None provided'}</p>
                    </div>
                    <div class="detail-section">
                        <h3>Booking Timeline</h3>
                        <p><strong>Created:</strong> ${new Date(booking.created_at).toLocaleString()}</p>
                        <p><strong>Last Updated:</strong> ${new Date(booking.created_at).toLocaleString()}</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-edit" onclick="editBooking(${booking.id})">Edit Booking</button>
                <button class="btn btn-approve" onclick="updateBookingStatus(${booking.id}, 'confirmed')">Approve</button>
                <button class="btn btn-reject" onclick="updateBookingStatus(${booking.id}, 'cancelled')">Reject</button>
                <button class="btn btn-view" onclick="closeModal(this)">Close</button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    addModalStyles();
}

function showEditBookingModal(booking) {
    const modal = document.createElement('div');
    modal.className = 'modal';
    modal.innerHTML = `
        <div class="modal-content">
            <div class="modal-header">
                <h2>Edit Booking - ${booking.booking_id}</h2>
                <span class="close" onclick="closeModal(this)">&times;</span>
            </div>
            <div class="modal-body">
                <form id="editBookingForm" onsubmit="saveBookingChanges(event, ${booking.id})">
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" name="customer_name" value="${booking.customer_name}" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="customer_email" value="${booking.customer_email}" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" name="customer_phone" value="${booking.customer_phone || ''}">
                        </div>
                        <div class="form-group">
                            <label>Room Type</label>
                            <select name="room_type" required>
                                <option value="Pearl Signature Room" ${booking.room_type === 'Pearl Signature Room' ? 'selected' : ''}>Pearl Signature Room</option>
                                <option value="Deluxe Room" ${booking.room_type === 'Deluxe Room' ? 'selected' : ''}>Deluxe Room</option>
                                <option value="Premium Room" ${booking.room_type === 'Premium Room' ? 'selected' : ''}>Premium Room</option>
                                <option value="Executive Room" ${booking.room_type === 'Executive Room' ? 'selected' : ''}>Executive Room</option>
                                <option value="Luxury Suite" ${booking.room_type === 'Luxury Suite' ? 'selected' : ''}>Luxury Suite</option>
                                <option value="Family Suite" ${booking.room_type === 'Family Suite' ? 'selected' : ''}>Family Suite</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Check In Date</label>
                            <input type="date" name="check_in_date" value="${booking.check_in_date}" required>
                        </div>
                        <div class="form-group">
                            <label>Check Out Date</label>
                            <input type="date" name="check_out_date" value="${booking.check_out_date}" required>
                        </div>
                        <div class="form-group">
                            <label>Number of Guests</label>
                            <input type="number" name="num_guests" value="${booking.num_guests}" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Number of Rooms</label>
                            <input type="number" name="num_rooms" value="${booking.num_rooms}" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Total Amount</label>
                            <input type="number" name="total_amount" value="${booking.total_amount}" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" required>
                                <option value="pending" ${booking.status === 'pending' ? 'selected' : ''}>Pending</option>
                                <option value="confirmed" ${booking.status === 'confirmed' ? 'selected' : ''}>Confirmed</option>
                                <option value="cancelled" ${booking.status === 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                <option value="completed" ${booking.status === 'completed' ? 'selected' : ''}>Completed</option>
                                <option value="checked-in" ${booking.status === 'checked-in' ? 'selected' : ''}>Checked-In</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label>Special Instructions</label>
                            <textarea name="special_instructions" rows="3">${booking.special_instructions || ''}</textarea>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-approve">Save Changes</button>
                        <button type="button" class="btn btn-reject" onclick="closeModal(this)">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    addModalStyles();
}

async function saveBookingChanges(event, bookingId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    const bookingData = {
        id: bookingId,
        customer_name: formData.get('customer_name'),
        customer_email: formData.get('customer_email'),
        customer_phone: formData.get('customer_phone'),
        room_type: formData.get('room_type'),
        check_in_date: formData.get('check_in_date'),
        check_out_date: formData.get('check_out_date'),
        num_guests: parseInt(formData.get('num_guests')),
        num_rooms: parseInt(formData.get('num_rooms')),
        total_amount: parseFloat(formData.get('total_amount')),
        status: formData.get('status'),
        special_instructions: formData.get('special_instructions')
    };
    
    try {
        const response = await fetch('Backend/Admin/update_booking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(bookingData)
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Booking updated successfully!');
            closeModal(document.querySelector('.modal'));
            location.reload();
        } else {
            alert('Error: ' + result.message);
        }
    } catch (error) {
        console.error('Error updating booking:', error);
        alert('Failed to update booking. Please try again.');
    }
}

function closeModal(element) {
    const modal = element.closest('.modal');
    if (modal) {
        modal.remove();
    }
}

function addModalStyles() {
    if (!document.getElementById('modal-styles')) {
        const styles = document.createElement('style');
        styles.id = 'modal-styles';
        styles.textContent = `
            .modal {
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .modal-content {
                background-color: #fff;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                width: 90%;
                max-width: 800px;
                max-height: 90vh;
                overflow-y: auto;
            }
            
            .modal-header {
                padding: 1.5rem;
                border-bottom: 1px solid #e0e0e0;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .modal-header h2 {
                margin: 0;
                color: #333;
            }
            
            .close {
                font-size: 2rem;
                cursor: pointer;
                color: #666;
                transition: color 0.3s ease;
            }
            
            .close:hover {
                color: #d4af37;
            }
            
            .modal-body {
                padding: 1.5rem;
            }
            
            .modal-footer {
                padding: 1.5rem;
                border-top: 1px solid #e0e0e0;
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
            }
            
            .booking-details-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                gap: 1.5rem;
            }
            
            .detail-section {
                background: #f8f9fa;
                padding: 1rem;
                border-radius: 8px;
                border-left: 4px solid #d4af37;
            }
            
            .detail-section.full-width {
                grid-column: 1 / -1;
            }
            
            .detail-section h3 {
                margin: 0 0 0.5rem 0;
                color: #333;
                font-size: 1.1rem;
            }
            
            .detail-section p {
                margin: 0.5rem 0;
                color: #666;
            }
            
            .form-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 1rem;
            }
            
            .form-group {
                display: flex;
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .form-group.full-width {
                grid-column: 1 / -1;
            }
            
            .form-group label {
                font-weight: 500;
                color: #333;
            }
            
            .form-group input,
            .form-group select,
            .form-group textarea {
                padding: 0.8rem;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }
            
            .form-group input:focus,
            .form-group select:focus,
            .form-group textarea:focus {
                outline: none;
                border-color: #d4af37;
                box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
            }
            
            .form-actions {
                display: flex;
                gap: 1rem;
                justify-content: flex-end;
                margin-top: 1.5rem;
                padding-top: 1rem;
                border-top: 1px solid #e0e0e0;
            }
        `;
        document.head.appendChild(styles);
    }
}

function viewCustomer(userId) {
    console.log('Viewing customer:', userId);
    // Implementation for viewing customer details
}

function editCustomer(userId) {
    console.log('Editing customer:', userId);
    // Implementation for editing customer
}

function viewServiceBooking(bookingId) {
    console.log('Viewing service booking:', bookingId);
    // Implementation for viewing service booking details
}

function updateServiceStatus(bookingId) {
    console.log('Updating service status:', bookingId);
    // Implementation for updating service booking status
}

function viewTourBooking(bookingId) {
    console.log('Viewing tour booking:', bookingId);
    // Implementation for viewing tour booking details
}

function updateTourStatus(bookingId) {
    console.log('Updating tour status:', bookingId);
    // Implementation for updating tour booking status
}

// Add duplicate prevention for form submissions
let isSubmitting = false;
let submissionTimeout = null;
let submissionStartTime = null;

// Function to prevent duplicate form submissions
function preventDuplicateSubmission(formElement, submitButton) {
    if (isSubmitting) {
        console.log('Form submission already in progress');
        alert('Please wait, your booking is being processed...');
        return false;
    }

    // Check if we're within 5 seconds of last submission
    if (submissionStartTime && (Date.now() - submissionStartTime) < 5000) {
        console.log('Submission too soon after last attempt');
        alert('Please wait a few seconds before trying again.');
        return false;
    }

    isSubmitting = true;
    submissionStartTime = Date.now();
    submitButton.disabled = true;
    submitButton.textContent = 'Submitting...';

    // Clear any existing timeout
    if (submissionTimeout) {
        clearTimeout(submissionTimeout);
    }

    // Re-enable after 15 seconds as a safety measure
    submissionTimeout = setTimeout(() => {
        isSubmitting = false;
        submitButton.disabled = false;
        submitButton.textContent = 'Submit';
        console.log('Form submission timeout reset');
    }, 15000);

    return true;
}

// Function to handle form submission with duplicate prevention
async function submitFormWithPrevention(formData, url, successCallback, errorCallback) {
    if (isSubmitting) {
        console.log('Form submission already in progress');
        return;
    }

    isSubmitting = true;

    try {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();

        if (result.success) {
            if (successCallback) successCallback(result);
        } else {
            if (result.duplicate) {
                // Handle duplicate booking case
                alert('This booking already exists. Please check your email for confirmation.');
            } else {
                if (errorCallback) errorCallback(result.message);
                else alert('Error: ' + result.message);
            }
        }
    } catch (error) {
        console.error('Form submission error:', error);
        if (errorCallback) errorCallback('Network error occurred');
        else alert('Network error occurred. Please try again.');
    } finally {
        isSubmitting = false;
    }
}

// Add event listeners to prevent duplicate submissions
document.addEventListener('DOMContentLoaded', function() {
    // Find all forms and add duplicate prevention
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const submitButton = form.querySelector('button[type="submit"], input[type="submit"]');
        if (submitButton) {
            form.addEventListener('submit', function(e) {
                if (!preventDuplicateSubmission(form, submitButton)) {
                    e.preventDefault();
                    return false;
                }
            });
        }
    });

    // Add specific handling for booking forms
    const bookingForms = document.querySelectorAll('.booking-form, #bookingForm');
    bookingForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (isSubmitting) {
                alert('Please wait, your booking is being processed...');
                return false;
            }

            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            submitFormWithPrevention(
                data,
                'Backend/room_booking_process.php',
                function(result) {
                    alert('Booking submitted successfully! Booking ID: ' + result.booking_id);
                    form.reset();
                },
                function(error) {
                    alert('Error: ' + error);
                }
            );
        });
    });
}); 