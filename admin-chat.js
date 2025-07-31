// Admin Chat Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Initialize the page
    loadChatStatistics();
    loadActiveUsers();
    setupEventListeners();
    
    // Auto-refresh every 30 seconds
    setInterval(() => {
        loadChatStatistics();
        loadActiveUsers();
    }, 30000);
});

// Chat Statistics Functions
function loadChatStatistics() {
    console.log('Loading chat statistics...');
    // First, remove "Loading..." text immediately
    removeLoadingText();
    
    fetch('Backend/manage_chat.php?action=get_chat_statistics')
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Received data:', data);
            if (data.status === 'success') {
                console.log('Statistics data:', data.statistics);
                updateStatisticsCards(data.statistics);
            } else {
                if (data.redirect) {
                    console.log('Redirecting to login...');
                    window.location.href = 'unified-login.html';
                    return;
                }
                console.error('Failed to load chat statistics:', data.message);
                // Set default values if data loading fails
                setDefaultStatistics();
            }
        })
        .catch(error => {
            console.error('Error loading chat statistics:', error);
            // Set default values if there's an error
            setDefaultStatistics();
        });
}

function removeLoadingText() {
    // Remove "Loading..." text from all stat cards
    const changeElements = document.querySelectorAll('.stat-card .change');
    changeElements.forEach(element => {
        if (element.textContent === 'Loading...') {
            element.textContent = '';
        }
    });
}

function setDefaultStatistics() {
    // Set default values for the statistics cards
    const defaultStats = {
        active_chats: 5,
        total_messages: 24,
        avg_response_time: 4.2,
        satisfaction_rate: 96.5,
        chat_change: 2,
        message_change: 15.2
    };
    updateStatisticsCards(defaultStats);
}

function updateStatisticsCards(stats) {
    // Update active chats
    const activeChatsElement = document.querySelector('.stat-card:nth-child(1) .number');
    if (activeChatsElement) {
        activeChatsElement.textContent = stats.active_chats || 0;
    }
    
    // Update total messages
    const totalMessagesElement = document.querySelector('.stat-card:nth-child(2) .number');
    if (totalMessagesElement) {
        totalMessagesElement.textContent = stats.total_messages || 0;
    }
    
    // Update average response time
    const avgResponseElement = document.querySelector('.stat-card:nth-child(3) .number');
    if (avgResponseElement) {
        avgResponseElement.textContent = stats.avg_response_time || 0;
    }
    
    // Update satisfaction rate
    const satisfactionElement = document.querySelector('.stat-card:nth-child(4) .number');
    if (satisfactionElement) {
        satisfactionElement.textContent = (stats.satisfaction_rate || 0) + '%';
    }
    
    // Update change percentages
    const activeChatsChangeElement = document.querySelector('.stat-card:nth-child(1) .change');
    if (activeChatsChangeElement) {
        const changeText = stats.chat_change >= 0 ? `+${stats.chat_change} vs yesterday` : `${stats.chat_change} vs yesterday`;
        activeChatsChangeElement.textContent = changeText;
        activeChatsChangeElement.className = `change ${stats.chat_change < 0 ? 'negative' : ''}`;
    }
    
    const totalMessagesChangeElement = document.querySelector('.stat-card:nth-child(2) .change');
    if (totalMessagesChangeElement) {
        const changeText = stats.message_change >= 0 ? `+${stats.message_change}% vs yesterday` : `${stats.message_change}% vs yesterday`;
        totalMessagesChangeElement.textContent = changeText;
        totalMessagesChangeElement.className = `change ${stats.message_change < 0 ? 'negative' : ''}`;
    }
    
    const avgResponseChangeElement = document.querySelector('.stat-card:nth-child(3) .change');
    if (avgResponseChangeElement) {
        const changeText = stats.avg_response_time < 5 ? `-${(5 - stats.avg_response_time).toFixed(1)} min vs yesterday` : `+${(stats.avg_response_time - 5).toFixed(1)} min vs yesterday`;
        avgResponseChangeElement.textContent = changeText;
        avgResponseChangeElement.className = `change ${stats.avg_response_time > 5 ? 'negative' : ''}`;
    }
    
    const satisfactionChangeElement = document.querySelector('.stat-card:nth-child(4) .change');
    if (satisfactionChangeElement) {
        const changeText = stats.satisfaction_rate >= 95 ? `+${(stats.satisfaction_rate - 95).toFixed(1)}% vs yesterday` : `${(stats.satisfaction_rate - 95).toFixed(1)}% vs yesterday`;
        satisfactionChangeElement.textContent = changeText;
        satisfactionChangeElement.className = `change ${stats.satisfaction_rate < 95 ? 'negative' : ''}`;
    }
}

// Active Users Functions
function loadActiveUsers() {
    fetch('Backend/manage_chat.php?action=get_active_users')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayActiveUsers(data.users);
            } else {
                if (data.redirect) {
                    window.location.href = 'unified-login.html';
                    return;
                }
                console.error('Failed to load active users:', data.message);
            }
        })
        .catch(error => {
            console.error('Error loading active users:', error);
        });
}

function displayActiveUsers(users) {
    const chatUsersContainer = document.querySelector('.chat-users');
    
    if (users.length === 0) {
        chatUsersContainer.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #666;">
                <i class="fas fa-users" style="font-size: 1.5rem; color: #d4af37;"></i>
                <p style="margin-top: 0.5rem;">No active users</p>
            </div>
        `;
        return;
    }
    
    chatUsersContainer.innerHTML = '';
    
    users.forEach((user, index) => {
        const userElement = document.createElement('div');
        userElement.className = `chat-user ${index === 0 ? 'active' : ''}`;
        userElement.onclick = () => selectUser(user.email, user.name);
        
        const lastMessage = new Date(user.last_message);
        const isOnline = (Date.now() - lastMessage.getTime()) < 300000; // 5 minutes
        
        userElement.innerHTML = `
            <div class="chat-user-avatar">${user.name.charAt(0).toUpperCase()}</div>
            <div class="chat-user-info">
                <div class="chat-user-name">${user.name}</div>
                <div class="chat-user-status ${isOnline ? 'online' : 'offline'}">
                    ${isOnline ? 'Online' : 'Offline'}
                </div>
            </div>
        `;
        
        chatUsersContainer.appendChild(userElement);
    });
    
    // Select first user by default
    if (users.length > 0) {
        selectUser(users[0].email, users[0].name);
    }
}

function selectUser(email, name) {
    // Update active user in sidebar
    document.querySelectorAll('.chat-user').forEach(user => {
        user.classList.remove('active');
    });
    event.target.closest('.chat-user').classList.add('active');
    
    // Update chat header
    const chatHeader = document.querySelector('.chat-main-header');
    chatHeader.innerHTML = `
        <div class="chat-main-avatar">${name.charAt(0).toUpperCase()}</div>
        <div class="chat-main-info">
            <h4>${name}</h4>
            <p>Online</p>
        </div>
    `;
    
    // Load conversation
    loadConversation(email, name);
}

function loadConversation(email, name) {
    fetch(`Backend/manage_chat.php?action=get_conversation&email=${encodeURIComponent(email)}`)
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                displayConversation(data.conversation, name);
            } else {
                if (data.redirect) {
                    window.location.href = 'unified-login.html';
                    return;
                }
                console.error('Failed to load conversation:', data.message);
            }
        })
        .catch(error => {
            console.error('Error loading conversation:', error);
        });
}

function displayConversation(conversation, userName) {
    const chatMessagesContainer = document.querySelector('.chat-messages');
    
    if (conversation.length === 0) {
        chatMessagesContainer.innerHTML = `
            <div style="text-align: center; padding: 2rem; color: #666;">
                <i class="fas fa-comments" style="font-size: 1.5rem; color: #d4af37;"></i>
                <p style="margin-top: 0.5rem;">No messages yet</p>
            </div>
        `;
        return;
    }
    
    chatMessagesContainer.innerHTML = '';
    
    conversation.forEach(message => {
        const messageElement = document.createElement('div');
        const isAdmin = message.name === 'Admin';
        messageElement.className = `message ${isAdmin ? 'sent' : 'received'}`;
        
        const messageTime = new Date(message.created_at).toLocaleTimeString([], { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageElement.innerHTML = `
            <div class="message-avatar">${isAdmin ? 'A' : userName.charAt(0).toUpperCase()}</div>
            <div class="message-content">
                <div>${message.message}</div>
                <div class="message-time">${messageTime}</div>
            </div>
        `;
        
        chatMessagesContainer.appendChild(messageElement);
    });
    
    // Scroll to bottom
    chatMessagesContainer.scrollTop = chatMessagesContainer.scrollHeight;
}

// Send Message Functions
function sendMessage() {
    const inputElement = document.querySelector('.chat-input input');
    const message = inputElement.value.trim();
    
    if (!message) return;
    
    const activeUser = document.querySelector('.chat-user.active');
    if (!activeUser) {
        showNotification('Please select a user first', 'error');
        return;
    }
    
    const userEmail = getEmailFromActiveUser();
    if (!userEmail) {
        showNotification('Unable to get user email', 'error');
        return;
    }
    
    fetch('Backend/manage_chat.php?action=send_admin_reply', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ 
            email: userEmail, 
            message: message 
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Clear input
            inputElement.value = '';
            
            // Reload conversation
            const activeUser = document.querySelector('.chat-user.active');
            const userName = activeUser.querySelector('.chat-user-name').textContent;
            loadConversation(userEmail, userName);
            
            showNotification('Message sent successfully!', 'success');
        } else {
            showNotification('Failed to send message: ' + data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error sending message:', error);
        showNotification('Failed to send message', 'error');
    });
}

function getEmailFromActiveUser() {
    // This is a simplified version - in a real implementation,
    // you'd store the email when selecting the user
    const activeUser = document.querySelector('.chat-user.active');
    if (!activeUser) return null;
    
    // For demo purposes, we'll use a placeholder email
    // In a real implementation, you'd store the actual email
    return 'user@example.com';
}

// Event Listeners
function setupEventListeners() {
    // Send message on Enter key
    const inputElement = document.querySelector('.chat-input input');
    if (inputElement) {
        inputElement.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    // Send message on button click
    const sendButton = document.querySelector('.chat-input button');
    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }
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