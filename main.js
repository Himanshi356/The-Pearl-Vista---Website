// Common JS for all pages

// Utility: Show notification
function showNotification(message, type = "info") {
  // Remove existing notifications
  const existingNotifications = document.querySelectorAll('.notification');
  existingNotifications.forEach(notification => notification.remove());
  // Create new notification
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
    max-width: 300px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    animation: slideIn 0.3s ease-out;
  `;
  const colors = {
    success: '#28a745', error: '#dc3545', info: '#17a2b8', warning: '#ffc107'
  };
  notification.style.backgroundColor = colors[type] || colors.info;
  document.body.appendChild(notification);
  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease-in';
    setTimeout(() => {
      if (notification.parentNode) notification.parentNode.removeChild(notification);
    }, 300);
  }, 5000);
}

// Utility: Email validation
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

// Utility: Toggle password visibility
function togglePassword(id, toggleSpan) {
  const input = document.getElementById(id);
  const icon = toggleSpan.querySelector("i");
  if (input.type === "password") {
    input.type = "text";
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    input.type = "password";
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
}

// Show Sign Up and Login forms (for index.html)
function showSignUp() {
  if (document.getElementById("landingPage")) document.getElementById("landingPage").style.display = "none";
  if (document.getElementById("signUpPage")) document.getElementById("signUpPage").style.display = "flex";
  if (document.getElementById("loginPage")) document.getElementById("loginPage").style.display = "none";
}
function showLogin() {
  if (document.getElementById("landingPage")) document.getElementById("landingPage").style.display = "none";
  if (document.getElementById("loginPage")) document.getElementById("loginPage").style.display = "flex";
  if (document.getElementById("signUpPage")) document.getElementById("signUpPage").style.display = "none";
}

function showRecovery() {
  showNotification("Password recovery feature coming soon!", "info");
}

// --- Auth/Welcome Page Logic ---
if (document.getElementById('signupForm')) {
  document.getElementById('signupForm').onsubmit = function(event) {
    event.preventDefault();
    const username = document.getElementById("signupUsername").value.trim();
    const email = document.getElementById("signupEmail").value.trim();
    const securityQuestion = document.getElementById("securityQuestion").value;
    const securityAnswer = document.getElementById("securityAnswer").value.trim();
    if (!username || !email || !securityQuestion || !securityAnswer) {
      showNotification("Please fill in all fields.", "error");
      return;
    }
    if (!isValidEmail(email)) {
      showNotification("Please enter a valid email address.", "error");
      return;
    }
    // Simulate signup process
    localStorage.setItem('pv_logged_in', '1');
    localStorage.setItem('pv_username', username);
    showNotification("Account created successfully! Please check your email for verification.", "success");
    setTimeout(() => {
      // Redirect to email verification page with email parameter
      window.location.href = `email-verification.html?email=${encodeURIComponent(email)}`;
    }, 1500);
  };
}
if (document.getElementById('loginForm')) {
  document.getElementById('loginForm').onsubmit = function(event) {
    event.preventDefault();
    const username = document.getElementById("loginUsername").value.trim();
    const password = document.getElementById("loginPassword").value;
    if (!username || !password) {
      showNotification("Please enter both username and password.", "error");
      return;
    }
    localStorage.setItem('pv_logged_in', '1');
    localStorage.setItem('pv_username', username);
    showNotification("Login successful! Welcome back.", "success");
    setTimeout(() => {
      window.location.href = 'home.html';
    }, 1500);
  };
}

// --- Landing Page Button Logic ---
document.addEventListener('DOMContentLoaded', function() {
  // Connect Sign Up button to showSignUp
  const signUpBtn = document.querySelector('.hero-btn:not(.login)');
  if (signUpBtn) {
    signUpBtn.addEventListener('click', showSignUp);
  }
  // Optionally, connect Login button to showLogin
  const loginBtn = document.querySelector('.hero-btn.login');
  if (loginBtn) {
    loginBtn.addEventListener('click', showLogin);
  }
});

// --- Home Page Logic ---
if (window.location.pathname.endsWith('home.html')) {
  // User dropdown
  window.toggleUserMenu = function() {
    const menu = document.getElementById("userDropdown");
    menu.classList.toggle("active");
    menu.style.right = "32px";
    menu.style.left = "auto";
  };
  // Show/hide profile icon and dropdown based on login
  document.addEventListener('DOMContentLoaded', function() {
    const loggedIn = localStorage.getItem('pv_logged_in') === '1';
    const username = localStorage.getItem('pv_username') || 'User';
    const profileIcon = document.querySelector('.profile');
    const userDropdown = document.getElementById('userDropdown');
    if (profileIcon && userDropdown) {
      if (loggedIn) {
        profileIcon.style.display = 'flex';
        // Set username in dropdown
        const userHeader = userDropdown.querySelector('.user-header');
        if (userHeader) {
          userHeader.textContent = `Hey ${username}!`;
        }
      } else {
        profileIcon.style.display = 'none';
        userDropdown.classList.remove('show');
      }
    }
    // Hide dropdown by default
    if (userDropdown) userDropdown.classList.remove('show');
  });
  // Show availability
  window.showAvailability = function() {
    document.getElementById('homeContent').style.display = 'none';
    document.getElementById('availabilitySection').style.display = 'block';
    const overlay = document.querySelector('#homePage .overlay');
    if (overlay) overlay.style.display = 'none';
  };
  // Handle availability form
  const availForm = document.getElementById('availabilityForm');
  if (availForm) {
    availForm.onsubmit = function(event) {
      event.preventDefault();
      const arrivalDate = document.getElementById('arrivalDate').value;
      const departureDate = document.getElementById('departureDate').value;
      const guestCount = document.getElementById('guestCount').value;
      alert('Availability search submitted! We will contact you soon.');
    };
  }
  // Logout
  window.logout = function() {
    localStorage.removeItem('pv_logged_in');
    localStorage.removeItem('pv_username');
    window.location.href = 'index.html';
  };
  // Close user menu when clicking outside
  window.onclick = function(event) {
    const userDropdown = document.getElementById('userDropdown');
    const userIcon = document.querySelector('.profile');
    if (userDropdown && userIcon && !userDropdown.contains(event.target) && !userIcon.contains(event.target)) {
      userDropdown.classList.remove('show');
    }
  };

  // Home page user icon click handler
  const userIcon = document.querySelector('.profile');
  if (userIcon) {
    userIcon.addEventListener('click', function(event) {
      event.stopPropagation();
      const userDropdown = document.getElementById('userDropdown');
      if (userDropdown) {
        userDropdown.classList.toggle('show');
      }
    });
  }
}

// --- Language & Currency Page Logic ---
document.addEventListener('DOMContentLoaded', function() {
  const form = document.getElementById('languageCurrencyForm');
  if (form) {
    // Check for saved preferences, otherwise use defaults
    const savedLang = localStorage.getItem('pv_current_language') || 'en-US';
    const savedCurr = localStorage.getItem('pv_current_currency') || 'USD';
    
    const langRadios = form.elements['language'];
    const currRadios = form.elements['currency'];
    if (langRadios && langRadios.length) {
      for (let radio of langRadios) {
        radio.checked = (radio.value === savedLang);
      }
    }
    if (currRadios && currRadios.length) {
      for (let radio of currRadios) {
        radio.checked = (radio.value === savedCurr);
      }
    }
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      const lang = form.language.value;
      const curr = form.currency.value;
      // Save to localStorage for persistence
      localStorage.setItem('pv_language', lang);
      localStorage.setItem('pv_currency', curr);
      
      // Apply language and currency changes to the website
      applyLanguageAndCurrencyChanges(lang, curr);
      
      showNotification('Your preferences have been saved successfully.', 'success');
    });
    // Make Save Preferences button submit the form
    const saveBtn = document.querySelector('.btn.signup');
    if (saveBtn) {
      saveBtn.type = 'submit';
    }
  }
  // Make radio labels clickable (for accessibility, already handled by <label>, but ensure pointer)
  const radios = document.querySelectorAll('.custom-radio input[type="radio"]');
  radios.forEach(radio => {
    radio.addEventListener('focus', function() {
      this.parentElement.classList.add('focused');
    });
    radio.addEventListener('blur', function() {
      this.parentElement.classList.remove('focused');
    });
  });
});

// Function to apply language and currency changes
function applyLanguageAndCurrencyChanges(language, currency) {
  // Update document language
  document.documentElement.lang = language;
  
  // Update currency symbols throughout the website
  updateCurrencySymbols(currency);
  
  // Update text content based on language
  updateTextContent(language);
  
  // Store the changes for other pages
  localStorage.setItem('pv_current_language', language);
  localStorage.setItem('pv_current_currency', currency);
}

// Function to update currency symbols
function updateCurrencySymbols(currency) {
  const currencySymbols = {
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'JPY': '¥',
    'INR': '₹'
  };
  
  const symbol = currencySymbols[currency] || '$';
  
  // Update all price elements
  const priceElements = document.querySelectorAll('.price, [data-price]');
  priceElements.forEach(element => {
    const currentText = element.textContent;
    // Replace existing currency symbols with new one
    const updatedText = currentText.replace(/[\$€£¥₹]\s*/, symbol + ' ');
    element.textContent = updatedText;
  });
}

// Function to update text content based on language
function updateTextContent(language) {
  const translations = {
    'en-US': {
      'HOME': 'HOME',
      'ABOUT US': 'ABOUT US',
      'ROOMS': 'ROOMS',
      'SERVICES': 'SERVICES',
      'GALLERY': 'GALLERY',
      'CONTACT US': 'CONTACT US',
      'LOCATIONS': 'LOCATIONS',
      'Personal Information': 'Personal Information',
      'My Bookings': 'My Bookings',
      'Wishlist': 'Wishlist',
      'My Itinerary': 'My Itinerary',
      'Rewards & Membership': 'Rewards & Membership',
      'Privacy Policy': 'Privacy Policy',
      'Language & Currency Switch': 'Language & Currency Switch',
      'Help': 'Help',
      'Settings': 'Settings',
      'Feedback': 'Feedback',
      'Logout': 'Logout'
    },
    'en-UK': {
      'HOME': 'HOME',
      'ABOUT US': 'ABOUT US',
      'ROOMS': 'ROOMS',
      'SERVICES': 'SERVICES',
      'GALLERY': 'GALLERY',
      'CONTACT US': 'CONTACT US',
      'LOCATIONS': 'LOCATIONS',
      'Personal Information': 'Personal Information',
      'My Bookings': 'My Bookings',
      'Wishlist': 'Wishlist',
      'My Itinerary': 'My Itinerary',
      'Rewards & Membership': 'Rewards & Membership',
      'Privacy Policy': 'Privacy Policy',
      'Language & Currency Switch': 'Language & Currency Switch',
      'Help': 'Help',
      'Settings': 'Settings',
      'Feedback': 'Feedback',
      'Logout': 'Logout'
    },
    'fr': {
      'HOME': 'ACCUEIL',
      'ABOUT US': 'À PROPOS',
      'ROOMS': 'CHAMBRES',
      'SERVICES': 'SERVICES',
      'GALLERY': 'GALERIE',
      'CONTACT US': 'CONTACT',
      'LOCATIONS': 'EMPLACEMENTS',
      'Personal Information': 'Informations Personnelles',
      'My Bookings': 'Mes Réservations',
      'Wishlist': 'Liste de Souhaits',
      'My Itinerary': 'Mon Itinéraire',
      'Rewards & Membership': 'Récompenses & Adhésion',
      'Privacy Policy': 'Politique de Confidentialité',
      'Language & Currency Switch': 'Langue & Devise',
      'Help': 'Aide',
      'Settings': 'Paramètres',
      'Feedback': 'Commentaires',
      'Logout': 'Déconnexion'
    },
    'es': {
      'HOME': 'INICIO',
      'ABOUT US': 'SOBRE NOSOTROS',
      'ROOMS': 'HABITACIONES',
      'SERVICES': 'SERVICIOS',
      'GALLERY': 'GALERÍA',
      'CONTACT US': 'CONTÁCTENOS',
      'LOCATIONS': 'UBICACIONES',
      'Personal Information': 'Información Personal',
      'My Bookings': 'Mis Reservas',
      'Wishlist': 'Lista de Deseos',
      'My Itinerary': 'Mi Itinerario',
      'Rewards & Membership': 'Recompensas y Membresía',
      'Privacy Policy': 'Política de Privacidad',
      'Language & Currency Switch': 'Idioma y Moneda',
      'Help': 'Ayuda',
      'Settings': 'Configuración',
      'Feedback': 'Comentarios',
      'Logout': 'Cerrar Sesión'
    }
  };
  
  const currentTranslations = translations[language] || translations['en-US'];
  
  // Update navigation menu items
  const navLinks = document.querySelectorAll('nav a');
  navLinks.forEach(link => {
    const originalText = link.textContent.trim();
    if (currentTranslations[originalText]) {
      link.textContent = currentTranslations[originalText];
    }
  });
  
  // Update dropdown menu items
  const dropdownLinks = document.querySelectorAll('.user-dropdown a');
  dropdownLinks.forEach(link => {
    const linkText = link.textContent.trim();
    for (const [key, value] of Object.entries(currentTranslations)) {
      if (linkText.includes(key)) {
        link.innerHTML = link.innerHTML.replace(key, value);
        break;
      }
    }
  });
  
  // Update logout text
  const logoutElement = document.querySelector('.logout');
  if (logoutElement) {
    logoutElement.textContent = currentTranslations['Logout'];
  }
}

// Apply saved language and currency on page load
document.addEventListener('DOMContentLoaded', function() {
  const savedLanguage = localStorage.getItem('pv_current_language') || 'en-US';
  const savedCurrency = localStorage.getItem('pv_current_currency') || 'USD';
  
  if (savedLanguage !== 'en-US' || savedCurrency !== 'USD') {
    applyLanguageAndCurrencyChanges(savedLanguage, savedCurrency);
  }
}); 

// --- Settings Page Logic ---
document.addEventListener('DOMContentLoaded', function() {
  // Dark Mode Toggle Functionality
  const darkModeToggle = document.querySelector('input[type="checkbox"]');
  if (darkModeToggle) {
    // Check if dark mode was previously enabled
    const isDarkMode = localStorage.getItem('pv_dark_mode') === 'true';
    darkModeToggle.checked = isDarkMode;
    
    // Apply dark mode if it was previously enabled
    if (isDarkMode) {
      applyDarkMode();
    }
    
    // Add event listener for dark mode toggle
    darkModeToggle.addEventListener('change', function() {
      if (this.checked) {
        applyDarkMode();
        localStorage.setItem('pv_dark_mode', 'true');
        showNotification('Dark mode enabled', 'success');
      } else {
        removeDarkMode();
        localStorage.setItem('pv_dark_mode', 'false');
        showNotification('Dark mode disabled', 'info');
      }
    });
  }
  
  // Offers/Updates Toggle Functionality
  const offersToggle = document.querySelectorAll('input[type="checkbox"]')[1];
  if (offersToggle) {
    // Check if offers were previously enabled
    const isOffersEnabled = localStorage.getItem('pv_offers_enabled') === 'true';
    offersToggle.checked = isOffersEnabled;
    
    // Add event listener for offers toggle
    offersToggle.addEventListener('change', function() {
      if (this.checked) {
        localStorage.setItem('pv_offers_enabled', 'true');
        showNotification('You will receive the latest offers and updates from THE PEARL VISTA on your registered email id. Thank You!', 'success');
      } else {
        localStorage.setItem('pv_offers_enabled', 'false');
        showNotification('Offers and updates disabled', 'info');
      }
    });
  }
});

// Function to apply dark mode
function applyDarkMode() {
  const body = document.body;
  const cards = document.querySelectorAll('.wishlist-card, .overview-card, .booking-card, .review-card, .service-card, .room-card, .gallery-card');
  const textElements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, div');
  const navLinks = document.querySelectorAll('nav a');
  
  // Change body background to dark
  body.style.backgroundColor = '#1a1a1a';
  body.style.color = '#ffffff';
  
  // Change card backgrounds to dark
  cards.forEach(card => {
    card.style.backgroundColor = '#2d2d2d';
    card.style.color = '#ffffff';
  });
  
  // Change text colors to light
  textElements.forEach(element => {
    if (!element.classList.contains('gold-text') && !element.style.color.includes('FFD700') && !element.style.color.includes('e60000') && !element.classList.contains('logout')) {
      element.style.color = '#ffffff';
    }
  });
  
  // Change navigation background and ensure links are visible
  const nav = document.querySelector('nav');
  if (nav) {
    nav.style.backgroundColor = '#2d2d2d';
  }
  
  // Make navigation links visible in dark mode
  navLinks.forEach(link => {
    link.style.color = '#ffffff';
  });
  
  // Change header background
  const header = document.querySelector('.header');
  if (header) {
    header.style.backgroundColor = '#2d2d2d';
  }
}

// Function to remove dark mode
function removeDarkMode() {
  const body = document.body;
  const cards = document.querySelectorAll('.wishlist-card, .overview-card, .booking-card, .review-card, .service-card, .room-card, .gallery-card');
  const textElements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, div');
  const navLinks = document.querySelectorAll('nav a');
  const header = document.querySelector('.header');
  const pageHeader = document.querySelector('.page-header');
  
  // Reset body to original colors (black background, white text)
  body.style.backgroundColor = '#000';
  body.style.color = '#fff';
  
  // Reset card backgrounds to white with dark text
  cards.forEach(card => {
    card.style.backgroundColor = '#fff';
    card.style.color = '#1a2238';
  });
  
  // Reset text colors to ensure visibility
  textElements.forEach(element => {
    // Don't reset gold text elements, red delete account text, or logout text
    if (!element.classList.contains('gold-text') && !element.style.color.includes('FFD700') && !element.style.color.includes('e60000') && !element.classList.contains('logout')) {
      // Set appropriate colors based on element type and context
      if (element.closest('.wishlist-card, .overview-card, .booking-card, .review-card, .service-card, .room-card, .gallery-card')) {
        // Elements inside cards should be dark
        element.style.color = '#1a2238';
      } else if (element.closest('.page-header')) {
        // Page header elements should be gold
        element.style.color = '#FFD700';
      } else {
        // Elements outside cards should be white
        element.style.color = '#fff';
      }
    }
  });
  
  // Reset header and navigation to ensure visibility
  if (header) {
    header.style.backgroundColor = '#fff';
    header.style.color = '#1a2238';
  }
  
  // Reset navigation background
  const nav = document.querySelector('nav');
  if (nav) {
    nav.style.backgroundColor = '#fff';
    nav.style.color = '#1a2238';
  }
  
  // Reset navigation links to dark color for visibility on white background
  navLinks.forEach(link => {
    link.style.color = '#1a2238';
  });
  
  // Ensure page header text is gold
  if (pageHeader) {
    const pageHeaderTexts = pageHeader.querySelectorAll('h1, p');
    pageHeaderTexts.forEach(text => {
      text.style.color = '#FFD700';
    });
  }
  
  // Force a brief reflow to ensure styles are applied
  body.offsetHeight;
}

// Apply saved dark mode on page load
document.addEventListener('DOMContentLoaded', function() {
  const isDarkMode = localStorage.getItem('pv_dark_mode') === 'true';
  if (isDarkMode) {
    applyDarkMode();
  }
  
  // Ensure logout text is always visible
  const logoutElement = document.querySelector('.logout');
  if (logoutElement) {
    logoutElement.style.color = '#e60000';
    logoutElement.style.fontWeight = '700';
  }
}); 