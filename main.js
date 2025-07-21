// Common JS for all pages

// Language and Currency Translation System
const translations = {
  'en-US': {
    // Navigation
    'HOME': 'HOME',
    'ABOUT US': 'ABOUT US',
    'ROOMS': 'ROOMS',
    'SERVICES': 'SERVICES',
    'GALLERY': 'GALLERY',
    'CONTACT US': 'CONTACT US',
    'LOCATIONS': 'LOCATIONS',
    
    // Common Actions
    'Save Preferences': 'Save Preferences',
    'Book Now': 'Book Now',
    'View Details': 'View Details',
    'Add to Wishlist': 'Add to Wishlist',
    'Remove from Wishlist': 'Remove from Wishlist',
    'Login': 'Login',
    'Sign Up': 'Sign Up',
    'Logout': 'Logout',
    'Back': 'Back',
    'Close': 'Close',
    'Cancel': 'Cancel',
    'Confirm': 'Confirm',
    'Submit': 'Submit',
    'Search': 'Search',
    'Filter': 'Filter',
    'Sort': 'Sort',
    
    // User Menu
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
    
    // Currency Symbols
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'INR': '₹',
    'JPY': '¥',
    
    // Common Text
    'per night': 'per night',
    'per person': 'per person',
    'per service': 'per service',
    'Total': 'Total',
    'Price': 'Price',
    'Available': 'Available',
    'Unavailable': 'Unavailable',
    'Booked': 'Booked',
    'Pending': 'Pending',
    'Confirmed': 'Confirmed',
    'Cancelled': 'Cancelled',
    'Completed': 'Completed',
    
    // Form Labels
    'Username': 'Username',
    'Email': 'Email',
    'Password': 'Password',
    'Confirm Password': 'Confirm Password',
    'Full Name': 'Full Name',
    'Phone Number': 'Phone Number',
    'Address': 'Address',
    'City': 'City',
    'Country': 'Country',
    'Postal Code': 'Postal Code',
    'Security Question': 'Security Question',
    'Security Answer': 'Security Answer',
    
    // Messages
    'Welcome back': 'Welcome back',
    'Login successful': 'Login successful',
    'Account created successfully': 'Account created successfully',
    'Please check your email for verification': 'Please check your email for verification',
    'Preferences saved successfully': 'Preferences saved successfully',
    'Your preferences will be applied across all pages': 'Your preferences will be applied across all pages',
    'Please select both language and currency preferences': 'Please select both language and currency preferences',
    'Selection Required': 'Selection Required',
    'Settings Updated': 'Settings Updated',
    'Active': 'Active',
    'You may need to refresh the page to see changes': 'You may need to refresh the page to see changes'
  },
  'en-UK': {
    // Navigation
    'HOME': 'HOME',
    'ABOUT US': 'ABOUT US',
    'ROOMS': 'ROOMS',
    'SERVICES': 'SERVICES',
    'GALLERY': 'GALLERY',
    'CONTACT US': 'CONTACT US',
    'LOCATIONS': 'LOCATIONS',
    
    // Common Actions
    'Save Preferences': 'Save Preferences',
    'Book Now': 'Book Now',
    'View Details': 'View Details',
    'Add to Wishlist': 'Add to Wishlist',
    'Remove from Wishlist': 'Remove from Wishlist',
    'Login': 'Login',
    'Sign Up': 'Sign Up',
    'Logout': 'Logout',
    'Back': 'Back',
    'Close': 'Close',
    'Cancel': 'Cancel',
    'Confirm': 'Confirm',
    'Submit': 'Submit',
    'Search': 'Search',
    'Filter': 'Filter',
    'Sort': 'Sort',
    
    // User Menu
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
    
    // Currency Symbols
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'INR': '₹',
    'JPY': '¥',
    
    // Common Text
    'per night': 'per night',
    'per person': 'per person',
    'per service': 'per service',
    'Total': 'Total',
    'Price': 'Price',
    'Available': 'Available',
    'Unavailable': 'Unavailable',
    'Booked': 'Booked',
    'Pending': 'Pending',
    'Confirmed': 'Confirmed',
    'Cancelled': 'Cancelled',
    'Completed': 'Completed',
    
    // Form Labels
    'Username': 'Username',
    'Email': 'Email',
    'Password': 'Password',
    'Confirm Password': 'Confirm Password',
    'Full Name': 'Full Name',
    'Phone Number': 'Phone Number',
    'Address': 'Address',
    'City': 'City',
    'Country': 'Country',
    'Postal Code': 'Postal Code',
    'Security Question': 'Security Question',
    'Security Answer': 'Security Answer',
    
    // Messages
    'Welcome back': 'Welcome back',
    'Login successful': 'Login successful',
    'Account created successfully': 'Account created successfully',
    'Please check your email for verification': 'Please check your email for verification',
    'Preferences saved successfully': 'Preferences saved successfully',
    'Your preferences will be applied across all pages': 'Your preferences will be applied across all pages',
    'Please select both language and currency preferences': 'Please select both language and currency preferences',
    'Selection Required': 'Selection Required',
    'Settings Updated': 'Settings Updated',
    'Active': 'Active',
    'You may need to refresh the page to see changes': 'You may need to refresh the page to see changes'
  },
  'fr': {
    // Navigation
    'HOME': 'ACCUEIL',
    'ABOUT US': 'À PROPOS',
    'ROOMS': 'CHAMBRES',
    'SERVICES': 'SERVICES',
    'GALLERY': 'GALERIE',
    'CONTACT US': 'CONTACT',
    'LOCATIONS': 'EMPLACEMENTS',
    
    // Common Actions
    'Save Preferences': 'Enregistrer les préférences',
    'Book Now': 'Réserver maintenant',
    'View Details': 'Voir les détails',
    'Add to Wishlist': 'Ajouter aux favoris',
    'Remove from Wishlist': 'Retirer des favoris',
    'Login': 'Connexion',
    'Sign Up': 'S\'inscrire',
    'Logout': 'Déconnexion',
    'Back': 'Retour',
    'Close': 'Fermer',
    'Cancel': 'Annuler',
    'Confirm': 'Confirmer',
    'Submit': 'Soumettre',
    'Search': 'Rechercher',
    'Filter': 'Filtrer',
    'Sort': 'Trier',
    
    // User Menu
    'Personal Information': 'Informations personnelles',
    'My Bookings': 'Mes réservations',
    'Wishlist': 'Liste de souhaits',
    'My Itinerary': 'Mon itinéraire',
    'Rewards & Membership': 'Récompenses et adhésion',
    'Privacy Policy': 'Politique de confidentialité',
    'Language & Currency Switch': 'Langue et devise',
    'Help': 'Aide',
    'Settings': 'Paramètres',
    'Feedback': 'Commentaires',
    
    // Currency Symbols
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'INR': '₹',
    'JPY': '¥',
    
    // Common Text
    'per night': 'par nuit',
    'per person': 'par personne',
    'per service': 'par service',
    'Total': 'Total',
    'Price': 'Prix',
    'Available': 'Disponible',
    'Unavailable': 'Indisponible',
    'Booked': 'Réservé',
    'Pending': 'En attente',
    'Confirmed': 'Confirmé',
    'Cancelled': 'Annulé',
    'Completed': 'Terminé',
    
    // Form Labels
    'Username': 'Nom d\'utilisateur',
    'Email': 'Email',
    'Password': 'Mot de passe',
    'Confirm Password': 'Confirmer le mot de passe',
    'Full Name': 'Nom complet',
    'Phone Number': 'Numéro de téléphone',
    'Address': 'Adresse',
    'City': 'Ville',
    'Country': 'Pays',
    'Postal Code': 'Code postal',
    'Security Question': 'Question de sécurité',
    'Security Answer': 'Réponse de sécurité',
    
    // Messages
    'Welcome back': 'Bon retour',
    'Login successful': 'Connexion réussie',
    'Account created successfully': 'Compte créé avec succès',
    'Please check your email for verification': 'Vérifiez votre email pour la vérification',
    'Preferences saved successfully': 'Préférences enregistrées avec succès',
    'Your preferences will be applied across all pages': 'Vos préférences seront appliquées sur toutes les pages',
    'Please select both language and currency preferences': 'Veuillez sélectionner la langue et la devise',
    'Selection Required': 'Sélection requise',
    'Settings Updated': 'Paramètres mis à jour',
    'Active': 'Actif',
    'You may need to refresh the page to see changes': 'Vous devrez peut-être actualiser la page pour voir les changements'
  },
  'es': {
    // Navigation
    'HOME': 'INICIO',
    'ABOUT US': 'SOBRE NOSOTROS',
    'ROOMS': 'HABITACIONES',
    'SERVICES': 'SERVICIOS',
    'GALLERY': 'GALERÍA',
    'CONTACT US': 'CONTACTO',
    'LOCATIONS': 'UBICACIONES',
    
    // Common Actions
    'Save Preferences': 'Guardar preferencias',
    'Book Now': 'Reservar ahora',
    'View Details': 'Ver detalles',
    'Add to Wishlist': 'Agregar a favoritos',
    'Remove from Wishlist': 'Quitar de favoritos',
    'Login': 'Iniciar sesión',
    'Sign Up': 'Registrarse',
    'Logout': 'Cerrar sesión',
    'Back': 'Atrás',
    'Close': 'Cerrar',
    'Cancel': 'Cancelar',
    'Confirm': 'Confirmar',
    'Submit': 'Enviar',
    'Search': 'Buscar',
    'Filter': 'Filtrar',
    'Sort': 'Ordenar',
    
    // User Menu
    'Personal Information': 'Información personal',
    'My Bookings': 'Mis reservas',
    'Wishlist': 'Lista de deseos',
    'My Itinerary': 'Mi itinerario',
    'Rewards & Membership': 'Recompensas y membresía',
    'Privacy Policy': 'Política de privacidad',
    'Language & Currency Switch': 'Idioma y moneda',
    'Help': 'Ayuda',
    'Settings': 'Configuración',
    'Feedback': 'Comentarios',
    
    // Currency Symbols
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'INR': '₹',
    'JPY': '¥',
    
    // Common Text
    'per night': 'por noche',
    'per person': 'por persona',
    'per service': 'por servicio',
    'Total': 'Total',
    'Price': 'Precio',
    'Available': 'Disponible',
    'Unavailable': 'No disponible',
    'Booked': 'Reservado',
    'Pending': 'Pendiente',
    'Confirmed': 'Confirmado',
    'Cancelled': 'Cancelado',
    'Completed': 'Completado',
    
    // Form Labels
    'Username': 'Nombre de usuario',
    'Email': 'Correo electrónico',
    'Password': 'Contraseña',
    'Confirm Password': 'Confirmar contraseña',
    'Full Name': 'Nombre completo',
    'Phone Number': 'Número de teléfono',
    'Address': 'Dirección',
    'City': 'Ciudad',
    'Country': 'País',
    'Postal Code': 'Código postal',
    'Security Question': 'Pregunta de seguridad',
    'Security Answer': 'Respuesta de seguridad',
    
    // Messages
    'Welcome back': 'Bienvenido de vuelta',
    'Login successful': 'Inicio de sesión exitoso',
    'Account created successfully': 'Cuenta creada exitosamente',
    'Please check your email for verification': 'Revise su correo para la verificación',
    'Preferences saved successfully': 'Preferencias guardadas exitosamente',
    'Your preferences will be applied across all pages': 'Sus preferencias se aplicarán en todas las páginas',
    'Please select both language and currency preferences': 'Por favor seleccione idioma y moneda',
    'Selection Required': 'Selección requerida',
    'Settings Updated': 'Configuración actualizada',
    'Active': 'Activo',
    'You may need to refresh the page to see changes': 'Es posible que necesite actualizar la página para ver los cambios'
  }
};

const roomPrices = {
  'Pearl Signature Room': 20695,
  'Deluxe Room': 3240,
  'Premium Room': 5580,
  'Executive Room': 8790,
  'Luxury Suite': 11920,
  'Family Suite': 14850
};

const GUEST_CHARGE_PER_NIGHT = 100;

// Currency conversion rates (simplified - in real app, these would be fetched from an API)
const currencyRates = {
  'USD': 1.0,
  'EUR': 0.85,
  'GBP': 0.73,
  'INR': 75.0,
  'JPY': 110.0
};

const servicePrices = {
  'fine-dining': 8000,
  'casual-dining': 4000,
  'bar-lounge': 5000,
  'room-service': 2000,
  'breakfast-buffet': 3000,
  'spa-massage': 1500,
  'facial-treatment': 1000,
  'body-treatment': 1200,
  'sauna-steam': 400,
  'fitness-center': 2500,
  'yoga-classes': 3000,
  'swimming-pool': 2000,
  'tennis-court': 3000,
  'golf-course': 7000,
  'gym-workout': 2500,
  'conference-room': 2000,
  'meeting-space': 1000,
  'wedding-venue': 5000,
  'event-planning': 3000,
  'audio-visual': 1500,
  'concierge-service': 6500,
  'transportation': 7800,
  'ticket-booking': 5100,
  'restaurant-reservation': 4500,
  'shopping-assistance': 5800,
  'romance-package': 3000,
  'family-package': 2500,
  'business-package': 2000,
  'wellness-package': 2800,
  'adventure-package': 2200,
  'kids-club': 3000,
  'babysitting': 5000,
  'family-activities': 4000,
  'children-menu': 1500,
  'playground': 1000,
  'pet-sitting': 4000,
  'pet-walking': 2000,
  'pet-grooming': 6000,
  'pet-friendly-room': 5000,
  'pet-amenities': 3000
};

// Function to get current language and currency from localStorage
function getCurrentPreferences() {
  return {
    language: localStorage.getItem('pv_language') || 'en-US',
    currency: localStorage.getItem('pv_currency') || 'USD'
  };
}

// Function to translate text based on current language
function translateText(text) {
  const { language } = getCurrentPreferences();
  const translation = translations[language];
  
  if (translation && translation[text]) {
    return translation[text];
  }
  
  // Fallback to English if translation not found
  const englishTranslation = translations['en-US'][text];
  return englishTranslation || text;
}

// Function to convert currency
function convertCurrency(amount, fromCurrency = 'USD', toCurrency = null) {
  if (!toCurrency) {
    toCurrency = getCurrentPreferences().currency;
  }
  
  if (fromCurrency === toCurrency) {
    return amount;
  }
  
  const fromRate = currencyRates[fromCurrency] || 1;
  const toRate = currencyRates[toCurrency] || 1;
  
  return (amount / fromRate) * toRate;
}

// Function to format currency with proper symbol
function formatCurrency(amount, currency = null) {
  if (!currency) {
    currency = getCurrentPreferences().currency;
  }
  
  const convertedAmount = convertCurrency(amount, 'USD', currency);
  const symbols = {
    'USD': '$',
    'EUR': '€',
    'GBP': '£',
    'INR': '₹',
    'JPY': '¥'
  };
  
  const symbol = symbols[currency] || '$';
  
  // Format based on currency
  if (currency === 'JPY') {
    return `${symbol}${Math.round(convertedAmount)}`;
  } else if (currency === 'INR') {
    return `${symbol}${Math.round(convertedAmount).toLocaleString('en-IN')}`;
  } else {
    return `${symbol}${convertedAmount.toFixed(2)}`;
  }
}

// Function to apply translations to the current page
function applyTranslations() {
  const { language } = getCurrentPreferences();
  
  // Update navigation links
  const navLinks = document.querySelectorAll('nav a, .header nav a');
  navLinks.forEach(link => {
    const originalText = link.getAttribute('data-original-text') || link.textContent;
    link.setAttribute('data-original-text', originalText);
    link.textContent = translateText(originalText);
  });
  
  // Update buttons
  const buttons = document.querySelectorAll('button, .btn');
  buttons.forEach(button => {
    const originalText = button.getAttribute('data-original-text') || button.textContent;
    button.setAttribute('data-original-text', originalText);
    button.textContent = translateText(originalText);
  });
  
  // Update form labels
  const labels = document.querySelectorAll('label');
  labels.forEach(label => {
    const originalText = label.getAttribute('data-original-text') || label.textContent;
    label.setAttribute('data-original-text', originalText);
    label.textContent = translateText(originalText);
  });
  
  // Update placeholders
  const inputs = document.querySelectorAll('input[placeholder], textarea[placeholder]');
  inputs.forEach(input => {
    const originalPlaceholder = input.getAttribute('data-original-placeholder') || input.placeholder;
    input.setAttribute('data-original-placeholder', originalPlaceholder);
    input.placeholder = translateText(originalPlaceholder);
  });
  
  // Update headings and other text elements
  const textElements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, div');
  textElements.forEach(element => {
    if (element.hasAttribute('data-translate')) {
      const originalText = element.getAttribute('data-original-text') || element.textContent;
      element.setAttribute('data-original-text', originalText);
      element.textContent = translateText(originalText);
    }
  });
}

// Function to apply currency formatting to the current page
function applyCurrencyFormatting() {
  const { currency } = getCurrentPreferences();
  
  // Find all price elements and update them
  const priceElements = document.querySelectorAll('[data-price]');
  priceElements.forEach(element => {
    const originalPrice = parseFloat(element.getAttribute('data-price'));
    const formattedPrice = formatCurrency(originalPrice, currency);
    element.textContent = formattedPrice;
  });
  
  // Update per night/per person text
  const perTextElements = document.querySelectorAll('.per-night, .per-person, .per-service');
  perTextElements.forEach(element => {
    const originalText = element.getAttribute('data-original-text') || element.textContent;
    element.setAttribute('data-original-text', originalText);
    element.textContent = translateText(originalText);
  });
}

// Function to initialize language and currency on page load
function initializeLanguageAndCurrency() {
  applyTranslations();
  applyCurrencyFormatting();
}

// Enhanced savePreferences function for language.html
function savePreferences() {
  const selectedLanguage = document.querySelector('input[name="language"]:checked');
  const selectedCurrency = document.querySelector('input[name="currency"]:checked');
  
  if (!selectedLanguage || !selectedCurrency) {
    showNotification('Please select both language and currency preferences', 'error');
    return;
  }
  
  const language = selectedLanguage.value;
  const currency = selectedCurrency.value;
  
  // Save to localStorage
  localStorage.setItem('pv_language', language);
  localStorage.setItem('pv_currency', currency);
  
  // Show success message
  showNotification('Preferences saved successfully! Your changes will be applied across all pages.', 'success');
  
  // Apply changes immediately to current page
  setTimeout(() => {
    applyTranslations();
    applyCurrencyFormatting();
  }, 1000);
  
  // Redirect to home page after a delay
  setTimeout(() => {
    window.location.href = 'home.html';
  }, 2000);
}

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

document.addEventListener('DOMContentLoaded', function() {
  const roomTypeSelect = document.getElementById('roomType');

  if (roomTypeSelect) {
    const options = roomTypeSelect.options;

    for (let i = 0; i < options.length; i++) {
      const option = options[i];
      const roomName = option.value;
      const price = roomPrices[roomName];

      if (price) {
        option.textContent = `${roomName} - $${price}/night`;
      }
    }
  }
});

// Auto-open booking modal if URL contains ?openBooking=true
if (window.location.pathname.includes('home.html') && window.location.search.includes('openBooking=true')) {
  setTimeout(function() {
    var btn = document.getElementById('openBookingModalBtn') || document.querySelector('.openBookingModalBtn');
    if (btn) btn.click();
  }, 400);
}

document.addEventListener('DOMContentLoaded', function() {
  const bookingForm = document.getElementById('bookingForm');
  if (bookingForm) {
    const roomTypeSelect = document.getElementById('roomType');
    const roomsInput = document.getElementById('rooms');
    const checkinInput = document.getElementById('checkin');
    const checkoutInput = document.getElementById('checkout');
    const guestsInput = document.getElementById('guests');
    const totalAmountInput = document.getElementById('totalAmount');

    function calculateTotal() {
      const roomType = roomTypeSelect.value;
      const numberOfRooms = parseInt(roomsInput.value, 10);
      const numberOfGuests = parseInt(guestsInput.value, 10);
      const checkinDate = new Date(checkinInput.value);
      const checkoutDate = new Date(checkoutInput.value);

      if (roomType && numberOfRooms > 0 && numberOfGuests > 0 && checkinInput.value && checkoutInput.value && checkoutDate > checkinDate) {
        const price = roomPrices[roomType];
        const numberOfNights = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
        const total = (price * numberOfRooms + GUEST_CHARGE_PER_NIGHT * numberOfGuests) * numberOfNights;
        totalAmountInput.value = `$${total.toFixed(2)}`;
      } else {
        totalAmountInput.value = '';
      }
    }

    roomTypeSelect.addEventListener('change', calculateTotal);
    roomsInput.addEventListener('input', calculateTotal);
    checkinInput.addEventListener('change', calculateTotal);
    checkoutInput.addEventListener('change', calculateTotal);
    guestsInput.addEventListener('input', calculateTotal);
  }
});

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
  const darkModeToggle = document.getElementById('darkModeToggle');
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

document.addEventListener('DOMContentLoaded', function() {
  var openSignatureBtn = document.getElementById('openSignatureDetailsBtn');
  var signatureModal = document.getElementById('signatureRoomModal');
  var closeSignatureBtn = document.getElementById('closeSignatureModalBtn');
  var signatureBookNowBtn = document.getElementById('signatureBookNowBtn');
  if (openSignatureBtn && signatureModal && closeSignatureBtn) {
    openSignatureBtn.onclick = function() {
      signatureModal.style.display = 'flex';
    };
    closeSignatureBtn.onclick = function() {
      signatureModal.style.display = 'none';
    };
    signatureModal.addEventListener('click', function(e) {
      if (e.target === signatureModal) signatureModal.style.display = 'none';
    });
  }
  if (signatureBookNowBtn) {
    signatureBookNowBtn.onclick = function() {
      signatureModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Pearl Signature Room in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Pearl Signature Room';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

document.addEventListener('DOMContentLoaded', function() {
  var openDeluxeBtn = document.getElementById('openDeluxeDetailsBtn');
  var deluxeModal = document.getElementById('deluxeRoomModal');
  var closeDeluxeBtn = document.getElementById('closeDeluxeModalBtn');
  var deluxeBookNowBtn = document.getElementById('deluxeBookNowBtn');
  if (openDeluxeBtn && deluxeModal && closeDeluxeBtn) {
    openDeluxeBtn.onclick = function() {
      deluxeModal.style.display = 'flex';
    };
    closeDeluxeBtn.onclick = function() {
      deluxeModal.style.display = 'none';
    };
    deluxeModal.addEventListener('click', function(e) {
      if (e.target === deluxeModal) deluxeModal.style.display = 'none';
    });
  }
  if (deluxeBookNowBtn) {
    deluxeBookNowBtn.onclick = function() {
      deluxeModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Deluxe Room in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Deluxe Room';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

document.addEventListener('DOMContentLoaded', function() {
  var openPremiumBtn = document.getElementById('openPremiumDetailsBtn');
  var premiumModal = document.getElementById('premiumRoomModal');
  var closePremiumBtn = document.getElementById('closePremiumModalBtn');
  var premiumBookNowBtn = document.getElementById('premiumBookNowBtn');
  if (openPremiumBtn && premiumModal && closePremiumBtn) {
    openPremiumBtn.onclick = function() {
      premiumModal.style.display = 'flex';
    };
    closePremiumBtn.onclick = function() {
      premiumModal.style.display = 'none';
    };
    premiumModal.addEventListener('click', function(e) {
      if (e.target === premiumModal) premiumModal.style.display = 'none';
    });
  }
  if (premiumBookNowBtn) {
    premiumBookNowBtn.onclick = function() {
      premiumModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Premium Room in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Premium Room';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

document.addEventListener('DOMContentLoaded', function() {
  var openExecutiveBtn = document.getElementById('openExecutiveDetailsBtn');
  var executiveModal = document.getElementById('executiveRoomModal');
  var closeExecutiveBtn = document.getElementById('closeExecutiveModalBtn');
  var executiveBookNowBtn = document.getElementById('executiveBookNowBtn');
  if (openExecutiveBtn && executiveModal && closeExecutiveBtn) {
    openExecutiveBtn.onclick = function() {
      executiveModal.style.display = 'flex';
    };
    closeExecutiveBtn.onclick = function() {
      executiveModal.style.display = 'none';
    };
    executiveModal.addEventListener('click', function(e) {
      if (e.target === executiveModal) executiveModal.style.display = 'none';
    });
  }
  if (executiveBookNowBtn) {
    executiveBookNowBtn.onclick = function() {
      executiveModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Executive Room in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Executive Room';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

document.addEventListener('DOMContentLoaded', function() {
  var openLuxuryBtn = document.getElementById('openLuxuryDetailsBtn');
  var luxuryModal = document.getElementById('luxurySuiteModal');
  var closeLuxuryBtn = document.getElementById('closeLuxuryModalBtn');
  var luxuryBookNowBtn = document.getElementById('luxuryBookNowBtn');
  if (openLuxuryBtn && luxuryModal && closeLuxuryBtn) {
    openLuxuryBtn.onclick = function() {
      luxuryModal.style.display = 'flex';
    };
    closeLuxuryBtn.onclick = function() {
      luxuryModal.style.display = 'none';
    };
    luxuryModal.addEventListener('click', function(e) {
      if (e.target === luxuryModal) luxuryModal.style.display = 'none';
    });
  }
  if (luxuryBookNowBtn) {
    luxuryBookNowBtn.onclick = function() {
      luxuryModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Luxury Suite in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Luxury Suite';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

document.addEventListener('DOMContentLoaded', function() {
  var openFamilyBtn = document.getElementById('openFamilyDetailsBtn');
  var familyModal = document.getElementById('familySuiteModal');
  var closeFamilyBtn = document.getElementById('closeFamilyModalBtn');
  var familyBookNowBtn = document.getElementById('familyBookNowBtn');
  if (openFamilyBtn && familyModal && closeFamilyBtn) {
    openFamilyBtn.onclick = function() {
      familyModal.style.display = 'flex';
    };
    closeFamilyBtn.onclick = function() {
      familyModal.style.display = 'none';
    };
    familyModal.addEventListener('click', function(e) {
      if (e.target === familyModal) familyModal.style.display = 'none';
    });
  }
  if (familyBookNowBtn) {
    familyBookNowBtn.onclick = function() {
      familyModal.style.display = 'none';
      // Try to open the booking modal if present on this page
      var bookingModal = document.getElementById('bookingModal');
      if (bookingModal) {
        bookingModal.style.display = 'flex';
        // Optionally, pre-select Family Suite in the booking form
        var roomType = document.getElementById('roomType');
        if (roomType) roomType.value = 'Family Suite';
      } else {
        // If not present, redirect to home with booking modal open
        window.location.href = 'home.html?openBooking=true';
      }
    };
  }
}); 

// --- My Bookings Page Functions ---

// View booking details
function viewBooking(bookingId) {
  showNotification(`Opening details for booking ${bookingId}...`, 'info');
  
  // Create a modal to show booking details
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    color: #333;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  
  // Get booking details based on ID
  const bookingDetails = getBookingDetails(bookingId);
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Booking Details</h2>
      <button id="closeModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important; hover: none;">&times;</button>
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Booking ID:</strong> ${bookingId}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Room Type:</strong> ${bookingDetails.roomType}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Check-in:</strong> ${bookingDetails.checkIn}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Check-out:</strong> ${bookingDetails.checkOut}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Guests:</strong> ${bookingDetails.guests}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Total Amount:</strong> $${bookingDetails.total}
    </div>
    <div style="margin-bottom: 15px; color: #333;">
      <strong>Status:</strong> <span style="color: ${bookingDetails.status === 'Confirmed' ? '#28a745' : '#ffc107'}">${bookingDetails.status}</span>
    </div>
    ${bookingDetails.specialRequests ? `<div style="margin-bottom: 15px; color: #333;"><strong>Special Requests:</strong> ${bookingDetails.specialRequests}</div>` : ''}
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeModalBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Modify booking
function modifyBooking(bookingId) {
  showNotification(`Opening modification form for booking ${bookingId}...`, 'info');
  
  // Create a modal for booking modification
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Modify Booking</h2>
      <button id="closeModifyModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important; hover: none;">&times;</button>
    </div>
    <form id="modifyBookingForm">
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Room Type:</label>
        <select id="modifyRoomType" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
          <option value="Luxury Suite">Luxury Suite</option>
          <option value="Deluxe Room">Deluxe Room</option>
          <option value="Executive Room">Executive Room</option>
          <option value="Premium Room">Premium Room</option>
          <option value="Family Suite">Family Suite</option>
          <option value="Pearl Signature Room">Pearl Signature Room</option>
        </select>
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Number of Rooms:</label>
        <input type="number" id="modifyRooms" min="1" max="10" value="1" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Check-in Date:</label>
        <input type="date" id="modifyCheckIn" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Check-out Date:</label>
        <input type="date" id="modifyCheckOut" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Number of Guests:</label>
        <input type="number" id="modifyGuests" min="1" max="10" value="1" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Special Requests:</label>
        <textarea id="modifyRequests" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Any special requests..."></textarea>
      </div>
      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="button" id="clearModifyBtn" 
                style="padding: 10px 20px; border: 1px solid #ddd; background: #f8f9fa; border-radius: 5px; cursor: pointer;">Clear</button>
        <button type="submit" 
                style="padding: 10px 20px; background: #FFD700; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Update Booking</button>
      </div>
    </form>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listeners for close and clear buttons
  const closeBtn = modalContent.querySelector('#closeModifyModalBtn');
  const clearBtn = modalContent.querySelector('#clearModifyBtn');
  
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  if (clearBtn) {
    clearBtn.addEventListener('click', function() {
      // Clear all form fields
      document.getElementById('modifyRoomType').value = 'Luxury Suite';
      document.getElementById('modifyRooms').value = '1';
      document.getElementById('modifyCheckIn').value = '';
      document.getElementById('modifyCheckOut').value = '';
      document.getElementById('modifyGuests').value = '1';
      document.getElementById('modifyRequests').value = '';
      showNotification('Form cleared successfully!', 'info');
    });
  }
  
  // Handle form submission
  const form = modalContent.querySelector('#modifyBookingForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    showNotification('Booking updated successfully!', 'success');
    modal.remove();
  });
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Cancel booking
function cancelBooking(bookingId) {
  // Create a personalized confirmation modal
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 400px;
    width: 90%;
    text-align: center;
    position: relative;
    color: #333;
  `;
  
  modalContent.innerHTML = `
    <div style="margin-bottom: 20px;">
      <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #dc3545; margin-bottom: 15px;"></i>
      <h3 style="color: #dc3545; margin: 0 0 15px 0; font-size: 1.5rem;">Cancel Booking</h3>
      <p style="margin: 0; font-size: 1.1rem; line-height: 1.5;">
        Are you sure you want to cancel booking <strong>${bookingId}</strong>?
      </p>
      <p style="margin: 10px 0 0 0; color: #666; font-size: 0.95rem;">
        This action cannot be undone.
      </p>
      <div style="margin-top: 15px; padding: 15px; background: #fff3cd; border: 1px solid #ffeaa7; border-radius: 8px;">
        <p style="margin: 0; color: #856404; font-size: 0.9rem; line-height: 1.4;">
          <i class="fas fa-info-circle" style="margin-right: 5px;"></i>
          <strong>Cancellation Policy:</strong> A cancellation fee of 25% of the total booking amount will be applied. 
          Refunds will be processed within 5-7 business days.
        </p>
      </div>
    </div>
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button id="cancelConfirmBtn" 
              style="padding: 12px 24px; background: #dc3545; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 1rem;">
        Yes, Cancel Booking
      </button>
      <button id="cancelCancelBtn" 
              style="padding: 12px 24px; background: #6c757d; color: white; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; font-size: 1rem;">
        No, Keep Booking
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listeners for buttons
  const confirmBtn = modalContent.querySelector('#cancelConfirmBtn');
  const cancelBtn = modalContent.querySelector('#cancelCancelBtn');
  
  if (confirmBtn) {
    confirmBtn.addEventListener('click', function() {
      modal.remove();
      showNotification(`Cancelling booking ${bookingId}...`, 'info');
      
      // Simulate cancellation process
      setTimeout(() => {
        showNotification('Booking cancelled successfully. A refund will be processed within 5-7 business days.', 'success');
        
        // Remove the booking card from the UI
        const bookingCard = document.querySelector(`[onclick*="${bookingId}"]`).closest('.booking-card');
        if (bookingCard) {
          bookingCard.style.animation = 'fadeOut 0.5s ease-out';
          setTimeout(() => {
            bookingCard.remove();
          }, 500);
        }
      }, 1500);
    });
  }
  
  if (cancelBtn) {
    cancelBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Write review for past booking
function writeReview(bookingId) {
  showNotification(`Opening review form for booking ${bookingId}...`, 'info');
  
  // Create a modal for writing review
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Write a Review</h2>
      <button id="closeReviewModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important; hover: none;">&times;</button>
    </div>
    <form id="reviewForm">
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Rating:</label>
        <div style="display: flex; gap: 5px;">
          <input type="radio" name="rating" value="5" id="star5" style="display: none;">
          <label for="star5" style="font-size: 24px; cursor: pointer; color: #ddd;">★</label>
          <input type="radio" name="rating" value="4" id="star4" style="display: none;">
          <label for="star4" style="font-size: 24px; cursor: pointer; color: #ddd;">★</label>
          <input type="radio" name="rating" value="3" id="star3" style="display: none;">
          <label for="star3" style="font-size: 24px; cursor: pointer; color: #ddd;">★</label>
          <input type="radio" name="rating" value="2" id="star2" style="display: none;">
          <label for="star2" style="font-size: 24px; cursor: pointer; color: #ddd;">★</label>
          <input type="radio" name="rating" value="1" id="star1" style="display: none;">
          <label for="star1" style="font-size: 24px; cursor: pointer; color: #ddd;">★</label>
        </div>
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Review Title:</label>
        <input type="text" id="reviewTitle" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Brief summary of your experience">
      </div>
      <div style="margin-bottom: 20px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Review:</label>
        <textarea id="reviewText" rows="5" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;" placeholder="Share your experience..."></textarea>
      </div>
      <div style="display: flex; gap: 10px; justify-content: flex-end;">
        <button type="submit" 
                style="padding: 10px 20px; background: #FFD700; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">Submit Review</button>
      </div>
    </form>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeReviewModalBtn');
  
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Handle star rating
  const stars = modalContent.querySelectorAll('input[name="rating"]');
  const starLabels = modalContent.querySelectorAll('label[for^="star"]');
  
  stars.forEach((star, index) => {
    star.addEventListener('change', function() {
      starLabels.forEach((label, labelIndex) => {
        if (labelIndex <= index) {
          label.style.color = '#FFD700';
        } else {
          label.style.color = '#ddd';
        }
      });
    });
  });
  
  // Handle form submission
  const form = modalContent.querySelector('#reviewForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const rating = document.querySelector('input[name="rating"]:checked');
    const title = document.getElementById('reviewTitle').value;
    const text = document.getElementById('reviewText').value;
    
    if (!rating || !title || !text) {
      showNotification('Please fill in all fields.', 'error');
      return;
    }
    
    showNotification('Review submitted successfully! Thank you for your feedback.', 'success');
    modal.remove();
  });
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Book again for past booking
function bookAgain(bookingId) {
  showNotification(`Redirecting to booking page for booking ${bookingId}...`, 'info');
  
  // Get booking details to pre-fill the booking form
  const bookingDetails = getBookingDetails(bookingId);
  
  // Store booking details in localStorage for pre-filling
  localStorage.setItem('pv_rebook_details', JSON.stringify(bookingDetails));
  
  // Redirect to home page with booking modal
  setTimeout(() => {
    window.location.href = 'home.html?openBooking=true&rebook=true';
  }, 1000);
}

// Download invoice
function downloadInvoice() {
  showNotification('Preparing invoices for download...', 'info');
  
  // Get only completed booking details
  const bookingData = {
    'BK-2023-015': {
      roomType: 'Executive Room',
      checkIn: 'December 20, 2024',
      checkOut: 'December 23, 2024',
      guests: '2 Guests',
      total: '26370',
      status: 'Completed',
      specialRequests: ''
    },
    'BK-2023-014': {
      roomType: 'Family Suite',
      checkIn: 'November 10, 2024',
      checkOut: 'November 12, 2024',
      guests: '4 Guests',
      total: '59420',
      status: 'Completed',
      specialRequests: 'Extra towels requested'
    }
  };
  
  // Create HTML content for professional invoice
  const htmlContent = generateInvoicePDF(bookingData);
  
  // Simulate download process
  setTimeout(() => {
    showNotification('Invoices downloaded successfully!', 'success');
    
    // Create a new window with the HTML content
    const newWindow = window.open('', '_blank');
    newWindow.document.write(htmlContent);
    newWindow.document.close();
    
    // Wait for content to load then print
    newWindow.onload = function() {
      newWindow.print();
    };
  }, 2000);
}

// Generate PDF content for invoices
function generateInvoicePDF(bookingData) {
  const currentDate = new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  });
  const username = localStorage.getItem('pv_username') || 'Guest';
  
  // Create HTML content for a professional invoice
  const htmlContent = `
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pearl Vista Hotel - Invoice Report</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            min-height: 100vh;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            overflow: hidden;
            border: 2px solid #FFD700;
        }
        .header {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #1a1a1a;
            padding: 30px;
            text-align: center;
            position: relative;
            border-bottom: 3px solid #1a1a1a;
        }
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="20" cy="20" r="2" fill="rgba(255,255,255,0.1)"/><circle cx="80" cy="40" r="1.5" fill="rgba(255,255,255,0.1)"/><circle cx="40" cy="80" r="1" fill="rgba(255,255,255,0.1)"/></svg>');
            opacity: 0.3;
        }
        .hotel-logo {
            font-size: 2.5em;
            font-weight: bold;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .hotel-subtitle {
            font-size: 1.2em;
            opacity: 0.9;
            margin-bottom: 5px;
        }
        .hotel-tagline {
            font-size: 0.9em;
            opacity: 0.8;
        }
        .invoice-info {
            padding: 25px 30px;
            background: #1a1a1a;
            color: white;
            border-bottom: 3px solid #FFD700;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .info-label {
            font-weight: bold;
            color: #FFD700;
            min-width: 120px;
        }
        .info-value {
            color: white;
        }
        .bookings-section {
            padding: 30px;
        }
        .section-title {
            font-size: 1.5em;
            color: #1a1a1a;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #FFD700;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .booking-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border-left: 4px solid #FFD700;
            border: 2px solid #1a1a1a;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .booking-id {
            font-size: 1.1em;
            font-weight: bold;
            color: #1a1a1a;
        }
        .booking-status {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: bold;
        }
        .status-confirmed {
            background: #d4edda;
            color: #155724;
        }
        .status-completed {
            background: #cce5ff;
            color: #004085;
        }
        .booking-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        .detail-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .detail-icon {
            color: #FFD700;
            width: 16px;
        }
        .detail-label {
            font-weight: bold;
            color: #1a1a1a;
            min-width: 80px;
        }
        .detail-value {
            color: #333;
        }
        .booking-amount {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #e0e0e0;
            text-align: right;
        }
        .amount-label {
            font-size: 0.9em;
            color: #666;
        }
        .amount-value {
            font-size: 1.3em;
            font-weight: bold;
            color: #28a745;
        }
        .summary-section {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            padding: 25px 30px;
            color: white;
            border-top: 3px solid #FFD700;
        }
        .summary-title {
            font-size: 1.3em;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: center;
        }
        .summary-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            text-align: center;
        }
        .summary-item {
            background: rgba(255,215,0,0.1);
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #FFD700;
        }
        .summary-label {
            font-size: 0.9em;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        .summary-value {
            font-size: 1.2em;
            font-weight: bold;
        }
        .footer {
            padding: 30px;
            background: #1a1a1a;
            color: white;
            text-align: center;
            border-top: 3px solid #FFD700;
        }
        .gratitude {
            font-size: 1.2em;
            margin-bottom: 15px;
            color: #FFD700;
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .contact-item {
            margin: 8px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .contact-icon {
            color: #FFD700;
        }
        .legal-note {
            font-size: 0.8em;
            opacity: 0.7;
            margin-top: 20px;
            padding-top: 15px;
            border-top: 1px solid #555;
        }
        @media print {
            body { background: white; }
            .invoice-container { box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <div class="hotel-logo">Pearl Vista Hotel</div>
            <div class="hotel-subtitle">Luxury & Comfort</div>
            <div class="hotel-tagline">Your Perfect Stay Awaits</div>
        </div>
        
        <div class="invoice-info">
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">📅 Generated:</span>
                    <span class="info-value">${currentDate}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">👤 Customer:</span>
                    <span class="info-value">${username}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">📋 Document:</span>
                    <span class="info-value">Comprehensive Invoice Report</span>
                </div>
                <div class="info-item">
                    <span class="info-label">🏢 Hotel:</span>
                    <span class="info-value">Pearl Vista Hotel</span>
                </div>
            </div>
        </div>
        
        <div class="bookings-section">
            <div class="section-title">
                📊 Booking Details
            </div>
            ${Object.keys(bookingData).map((bookingId, index) => {
                const booking = bookingData[bookingId];
                const statusClass = booking.status === 'Confirmed' ? 'status-confirmed' : 'status-completed';
                return `
                <div class="booking-card">
                    <div class="booking-header">
                        <div class="booking-id">${bookingId}</div>
                        <div class="booking-status ${statusClass}">${booking.status}</div>
                    </div>
                    <div class="booking-details">
                        <div class="detail-item">
                            <span class="detail-icon">🏠</span>
                            <span class="detail-label">Room:</span>
                            <span class="detail-value">${booking.roomType}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">📅</span>
                            <span class="detail-label">Check-in:</span>
                            <span class="detail-value">${booking.checkIn}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">📅</span>
                            <span class="detail-label">Check-out:</span>
                            <span class="detail-value">${booking.checkOut}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-icon">👥</span>
                            <span class="detail-label">Guests:</span>
                            <span class="detail-value">${booking.guests}</span>
                        </div>
                        ${booking.specialRequests ? `
                        <div class="detail-item">
                            <span class="detail-icon">📝</span>
                            <span class="detail-label">Requests:</span>
                            <span class="detail-value">${booking.specialRequests}</span>
                        </div>
                        ` : ''}
                    </div>
                    <div class="booking-amount">
                        <div class="amount-label">Total Amount</div>
                        <div class="amount-value">$${parseInt(booking.total).toLocaleString()}</div>
                    </div>
                </div>
                `;
            }).join('')}
        </div>
        
        <div class="summary-section">
            <div class="summary-title">📈 Summary</div>
            <div class="summary-grid">
                <div class="summary-item">
                    <div class="summary-label">Total Bookings</div>
                    <div class="summary-value">${Object.keys(bookingData).length}</div>
                </div>
                <div class="summary-item">
                    <div class="summary-label">Total Amount</div>
                    <div class="summary-value">$${Object.values(bookingData).reduce((sum, booking) => sum + parseInt(booking.total), 0).toLocaleString()}</div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <div class="gratitude">🙏 Thank you for choosing Pearl Vista Hotel!</div>
            <div style="margin-bottom: 20px; opacity: 0.9;">
                We appreciate your trust and look forward to welcoming you again.
            </div>
            <div class="contact-info">
                <div class="contact-item">
                    <span class="contact-icon">📞</span>
                    <span>+1 (212) 555-0123</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">✉️</span>
                    <span>reservations@pearlvista.com</span>
                </div>
                <div class="contact-item">
                    <span class="contact-icon">🌐</span>
                    <span>www.pearlvista.com</span>
                </div>
            </div>
            <div class="legal-note">
                This document is computer generated and serves as an official invoice record.
            </div>
        </div>
    </div>
</body>
</html>
`;

  // Convert HTML to PDF using jsPDF and html2canvas
  return htmlContent;
}

// Contact support
function contactSupport() {
  showNotification('Opening support chat...', 'info');
  
  // Create a support chat modal
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 400px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
  `;
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Contact Support</h2>
      <button id="closeSupportModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none;">&times;</button>
    </div>
    <div style="text-align: center; margin-bottom: 20px;">
      <i class="fas fa-headset" style="font-size: 48px; color: #FFD700; margin-bottom: 15px;"></i>
      <p style="margin: 0; color: #666;">Our support team is here to help!</p>
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Phone:</strong> +1 (212) 555-0123
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Email:</strong> support@pearlvista.com
    </div>
    <div style="margin-bottom: 20px;">
      <strong>Hours:</strong> 24/7 Support Available
    </div>
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button onclick="window.open('tel:+12125550123')" 
              style="padding: 10px 20px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">
        <i class="fas fa-phone"></i> Call Now
      </button>
      <button onclick="window.open('mailto:support@pearlvista.com')" 
              style="padding: 10px 20px; background: #17a2b8; color: white; border: none; border-radius: 5px; cursor: pointer;">
        <i class="fas fa-envelope"></i> Email
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeSupportModalBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Helper function to get booking details
function getBookingDetails(bookingId) {
  const bookingData = {
    'BK-2024-001': {
      roomType: 'Luxury Suite',
      checkIn: 'March 15, 2025',
      checkOut: 'March 18, 2025',
      guests: '2 Guests',
      total: '35760',
      status: 'Confirmed',
      specialRequests: 'Late check-in requested'
    },
    'BK-2024-002': {
      roomType: 'Deluxe Room',
      checkIn: 'April 5, 2025',
      checkOut: 'April 7, 2025',
      guests: '1 Guest',
      total: '6480',
      status: 'Confirmed',
      specialRequests: ''
    },
    'BK-2023-015': {
      roomType: 'Executive Room',
      checkIn: 'December 20, 2024',
      checkOut: 'December 23, 2024',
      guests: '2 Guests',
      total: '26370',
      status: 'Completed',
      specialRequests: ''
    },
    'BK-2023-014': {
      roomType: 'Family Suite',
      checkIn: 'November 10, 2024',
      checkOut: 'November 12, 2024',
      guests: '4 Guests',
      total: '59420',
      status: 'Completed',
      specialRequests: 'Extra towels requested'
    }
  };
  
  return bookingData[bookingId] || {
    roomType: 'Unknown Room',
    checkIn: 'Unknown',
    checkOut: 'Unknown',
    guests: 'Unknown',
    total: '0',
    status: 'Unknown',
    specialRequests: ''
  };
}

// Add CSS animations for fade out effect
const style = document.createElement('style');
style.textContent = `
  @keyframes fadeOut {
    from { opacity: 1; transform: translateY(0); }
    to { opacity: 0; transform: translateY(-20px); }
  }
`;
document.head.appendChild(style);

// ===== WISHLIST FUNCTIONS =====

// Book Now function for rooms
function bookNow(roomId) {
  showNotification(`Opening booking form for ${roomId}...`, 'info');
  
  // Redirect to home page with booking modal open
  window.location.href = 'home.html?openBooking=true&room=' + roomId;
}

// View Details function for rooms
function viewDetails(roomId) {
  showNotification(`Opening details for ${roomId}...`, 'info');
  
  // Create a modal to show room details
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    color: #333;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  
  // Get room details based on ID
  const roomDetails = getRoomDetails(roomId);
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Room Details</h2>
      <button id="closeRoomModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important;">&times;</button>
    </div>
    <div style="margin-bottom: 20px;">
      <img src="images/${roomDetails.image}" alt="${roomDetails.name}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
    </div>
    <div style="margin-bottom: 15px;">
      <h3 style="color: #333; margin: 0 0 10px 0;">${roomDetails.name}</h3>
      <p style="color: #666; margin: 0 0 15px 0;">${roomDetails.description}</p>
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Capacity:</strong> ${roomDetails.capacity}
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Bed Type:</strong> ${roomDetails.bedType}
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Amenities:</strong> ${roomDetails.amenities}
    </div>
    <div style="margin-bottom: 20px;">
      <strong>Price:</strong> <span style="color: #FFD700; font-size: 1.2em; font-weight: bold;">$${roomDetails.price}</span> per night
    </div>
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button onclick="bookNow('${roomId}')" 
              style="padding: 12px 24px; background: #FFD700; color: #000; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-calendar-check" style="color: #000;"></i> Book Now
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeRoomModalBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Book Service function for services
function bookService(serviceId, singleSelect) {
  showNotification(`Opening service booking for ${serviceId}...`, 'info');
  // Create a modal for service booking
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  const serviceDetails = getServiceDetails(serviceId);
  // Helper to get input type
  const inputType = singleSelect ? 'radio' : 'checkbox';
  // Helper to get name attribute for radio group
  const inputName = singleSelect ? 'serviceOption' : '';
  // Label text
  const labelText = singleSelect ? 'Select Service (Choose One):' : 'Select Services (Choose Multiple):';
  // Only show Dining & Bar for private-dining
  let showDiningOnly = serviceId === 'private-dining';
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Book Service</h2>
      <button id="closeServiceModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important;">&times;</button>
    </div>
    <form id="serviceBookingForm">
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 10px; font-weight: bold; color: #333;">${labelText}</label>
        <div style="max-height: 300px; overflow-y: auto; border: 1px solid #ddd; border-radius: 5px; padding: 10px; background: #f9f9f9;">
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Dining & Bar</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="fine-dining" style="margin-right: 8px;"> Fine Dining Restaurant - $${servicePrices['fine-dining']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="casual-dining" style="margin-right: 8px;"> Casual Dining - $${servicePrices['casual-dining']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="bar-lounge" style="margin-right: 8px;"> Bar & Lounge - $${servicePrices['bar-lounge']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="room-service" style="margin-right: 8px;"> Room Service - $${servicePrices['room-service']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="breakfast-buffet" style="margin-right: 8px;"> Breakfast Buffet - $${servicePrices['breakfast-buffet']}
            </label>
          </div>
          ${!showDiningOnly ? `
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Wellness & Spa</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="spa-massage" style="margin-right: 8px;"> Spa & Massage - $${servicePrices['spa-massage']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="facial-treatment" style="margin-right: 8px;"> Facial Treatment - $${servicePrices['facial-treatment']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="body-treatment" style="margin-right: 8px;"> Body Treatment - $${servicePrices['body-treatment']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="sauna-steam" style="margin-right: 8px;"> Sauna & Steam Room - $${servicePrices['sauna-steam']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="fitness-center" style="margin-right: 8px;"> Fitness Center - $${servicePrices['fitness-center']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="yoga-classes" style="margin-right: 8px;"> Yoga Classes - $${servicePrices['yoga-classes']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Leisure & Activities</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="swimming-pool" style="margin-right: 8px;"> Swimming Pool - $${servicePrices['swimming-pool']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="tennis-court" style="margin-right: 8px;"> Tennis Court - $${servicePrices['tennis-court']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="golf-course" style="margin-right: 8px;"> Golf Course - $${servicePrices['golf-course']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="gym-workout" style="margin-right: 8px;"> Gym & Workout - $${servicePrices['gym-workout']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Events & Meetings</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="conference-room" style="margin-right: 8px;"> Conference Room - $${servicePrices['conference-room']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="meeting-space" style="margin-right: 8px;"> Meeting Space - $${servicePrices['meeting-space']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="wedding-venue" style="margin-right: 8px;"> Wedding Venue - $${servicePrices['wedding-venue']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="event-planning" style="margin-right: 8px;"> Event Planning - $${servicePrices['event-planning']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="audio-visual" style="margin-right: 8px;"> Audio Visual Equipment - $${servicePrices['audio-visual']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Concierge Services</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="concierge-service" style="margin-right: 8px;"> Concierge Service - $${servicePrices['concierge-service']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="transportation" style="margin-right: 8px;"> Transportation - $${servicePrices['transportation']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="ticket-booking" style="margin-right: 8px;"> Ticket Booking - $${servicePrices['ticket-booking']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="restaurant-reservation" style="margin-right: 8px;"> Restaurant Reservation - $${servicePrices['restaurant-reservation']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="shopping-assistance" style="margin-right: 8px;"> Shopping Assistance - $${servicePrices['shopping-assistance']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Packages & Offers</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="romance-package" style="margin-right: 8px;"> Romance Package - $${servicePrices['romance-package']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="family-package" style="margin-right: 8px;"> Family Package - $${servicePrices['family-package']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="business-package" style="margin-right: 8px;"> Business Package - $${servicePrices['business-package']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="wellness-package" style="margin-right: 8px;"> Wellness Package - $${servicePrices['wellness-package']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="adventure-package" style="margin-right: 8px;"> Adventure Package - $${servicePrices['adventure-package']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Kids & Family</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="kids-club" style="margin-right: 8px;"> Kids Club - $${servicePrices['kids-club']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="babysitting" style="margin-right: 8px;"> Babysitting Service - $${servicePrices['babysitting']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="family-activities" style="margin-right: 8px;"> Family Activities - $${servicePrices['family-activities']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="children-menu" style="margin-right: 8px;"> Children's Menu - $${servicePrices['children-menu']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="playground" style="margin-right: 8px;"> Playground - $${servicePrices['playground']}
            </label>
          </div>
          <div style="margin-bottom: 15px;">
            <h4 style="margin: 0 0 8px 0; color: #FFD700; font-size: 14px;">Pet Services</h4>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="pet-sitting" style="margin-right: 8px;"> Pet Sitting - $${servicePrices['pet-sitting']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="pet-walking" style="margin-right: 8px;"> Pet Walking - $${servicePrices['pet-walking']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="pet-grooming" style="margin-right: 8px;"> Pet Grooming - $${servicePrices['pet-grooming']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="pet-friendly-room" style="margin-right: 8px;"> Pet-Friendly Room - $${servicePrices['pet-friendly-room']}
            </label>
            <label style="display: block; margin-bottom: 5px; cursor: pointer; color: #333;">
              <input type="${inputType}" name="${inputName}" value="pet-amenities" style="margin-right: 8px;"> Pet Amenities - $${servicePrices['pet-amenities']}
            </label>
          </div>
          ` : ''}
        </div>
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Date:</label>
        <input type="date" id="serviceDate" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Time:</label>
        <input type="time" id="serviceTime" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Number of People:</label>
        <input type="number" id="servicePeople" min="1" max="10" value="1" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      <div style="margin-top: 20px; text-align: right; font-size: 1.2rem; font-weight: bold; color: #333;" id="serviceTotalAmount">
        Total: $0
      </div>
      <div style="margin-top: 20px; display: flex; gap: 10px; justify-content: flex-end;">
        <button type="submit" 
                style="padding: 12px 24px; background: #FFD700; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
          Confirm Booking
        </button>
      </div>
    </form>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);

  const form = modalContent.querySelector('#serviceBookingForm');
  const serviceCheckboxes = form.querySelectorAll('input[type="checkbox"], input[type="radio"]');
  const totalAmountEl = document.getElementById('serviceTotalAmount');

  function updateServiceTotal() {
    let total = 0;
    const people = document.getElementById('servicePeople').value || 1;
    serviceCheckboxes.forEach(checkbox => {
      if (checkbox.checked) {
        const price = servicePrices[checkbox.value];
        if (price) {
          total += price;
        }
      }
    });
    totalAmountEl.textContent = `Total: $${total * people}`;
  }

  serviceCheckboxes.forEach(checkbox => {
    checkbox.addEventListener('change', updateServiceTotal);
  });

  document.getElementById('servicePeople').addEventListener('input', updateServiceTotal);

  const closeBtn = modalContent.querySelector('#closeServiceModalBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    const selectedServices = Array.from(form.querySelectorAll('input[type="checkbox"]:checked, input[type="radio"]:checked'))
      .map(input => input.value);
    
    if (selectedServices.length === 0) {
      showNotification('Please select at least one service.', 'error');
      return;
    }
    
    const totalText = totalAmountEl.textContent;
    const totalAmount = parseFloat(totalText.replace('Total: $', ''));
    
    const booking = {
      id: `SB-${Date.now()}`,
      type: 'service',
      services: selectedServices,
      date: document.getElementById('serviceDate').value,
      time: document.getElementById('serviceTime').value,
      people: document.getElementById('servicePeople').value,
      total: totalAmount,
      status: 'Confirmed'
    };
    
    const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
    bookings.push(booking);
    localStorage.setItem('pv_bookings', JSON.stringify(bookings));
    
    showNotification('Service Booked Sucessfully! Kindly check my bookings page to review your booking', 'success');
    modal.remove();
    
    if (window.location.pathname.includes('my-bookings.html')) {
      loadBookings();
    }
  });
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// View Service Details function for services
function viewServiceDetails(serviceId) {
  showNotification(`Opening details for ${serviceId}...`, 'info');
  
  // Create a modal to show service details
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    color: #333;
    scrollbar-width: none;
    -ms-overflow-style: none;
  `;
  
  const serviceDetails = getServiceDetails(serviceId);
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Service Details</h2>
      <button id="closeServiceDetailsModalBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666; transition: none !important; box-shadow: none !important;">&times;</button>
    </div>
    <div style="margin-bottom: 20px;">
      <img src="images/${serviceDetails.image}" alt="${serviceDetails.name}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
    </div>
    <div style="margin-bottom: 15px;">
      <h3 style="color: #333; margin: 0 0 10px 0;">${serviceDetails.name}</h3>
      <p style="color: #666; margin: 0 0 15px 0;">${serviceDetails.description}</p>
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Duration:</strong> ${serviceDetails.duration}
    </div>
    <div style="margin-bottom: 15px;">
      <strong>Features:</strong> ${serviceDetails.features}
    </div>
    <div style="margin-bottom: 20px;">
      <strong>Price:</strong> <span style="color: #FFD700; font-size: 1.2em; font-weight: bold;">$${serviceDetails.price}</span> per person
    </div>
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button onclick="bookService('${serviceId}')" 
              style="padding: 12px 24px; background: #FFD700; color: #000; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-calendar-check" style="color: #000;"></i> Book Service
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeServiceDetailsModalBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Remove from wishlist function
function removeFromWishlist(itemId) {
  // Determine if item is a room or service
  const roomNames = ['deluxe-room', 'premium-room', 'executive-room', 'luxury-suite', 'family-suite', 'pearl-signature'];
  const serviceIds = [
    'dining', 'spa', 'leisure', 'events', 'concierge', 'kids', 'packages', 'pet-services'
  ];
  let displayName = itemId;
  if (roomNames.includes(itemId)) {
    displayName = getRoomName(itemId);
  } else if (serviceIds.includes(itemId)) {
    displayName = getServiceDetails(itemId).name;
  }
  showNotification(`${displayName} removed from wishlist!`, 'info');

  // Find the wishlist card and animate its removal
  const wishlistCard = document.querySelector(`[onclick*="${itemId}"]`).closest('.wishlist-card, .service-wishlist-card');
  if (wishlistCard) {
    wishlistCard.style.animation = 'fadeOut 0.5s ease-out';
    setTimeout(() => {
      wishlistCard.remove();
      updateWishlistCounts();
    }, 500);
  }
}

// Clear all wishlist items
function clearWishlist() {
  showNotification('Clearing all wishlist items...', 'info');
  
  // Find all wishlist cards and animate their removal
  const wishlistCards = document.querySelectorAll('.wishlist-card, .service-wishlist-card');
  wishlistCards.forEach((card, index) => {
    setTimeout(() => {
      card.style.animation = 'fadeOut 0.5s ease-out';
      setTimeout(() => {
        card.remove();
      }, 500);
    }, index * 100);
  });
  
  setTimeout(() => {
    showNotification('All items removed from wishlist!', 'success');
    updateWishlistCounts();
  }, wishlistCards.length * 100 + 500);
}

// Update wishlist counts
// Remove this incomplete function - it's replaced by the enhanced version below

// Load and display bookings from localStorage
function loadBookings() {
  if (!window.location.pathname.includes('my-bookings.html')) {
    return;
  }
  
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  const currentBookingsGrid = document.querySelector('.current-bookings .bookings-grid');
  const pastBookingsGrid = document.querySelector('.past-bookings .bookings-grid');
  
  if (!currentBookingsGrid || !pastBookingsGrid) {
    return;
  }
  
  // Clear existing dynamic bookings (keep the static ones)
  const existingDynamicBookings = currentBookingsGrid.querySelectorAll('.booking-card[data-dynamic="true"]');
  existingDynamicBookings.forEach(booking => booking.remove());
  
  // Add service bookings to current bookings
  bookings.forEach(booking => {
    if (booking.type === 'service') {
      const bookingCard = createServiceBookingCard(booking);
      currentBookingsGrid.appendChild(bookingCard);
    }
  });
  
  // Update overview numbers
  updateBookingOverview();
}

// Create service booking card
function createServiceBookingCard(booking) {
  const card = document.createElement('div');
  card.className = 'booking-card';
  card.setAttribute('data-dynamic', 'true');
  
  // Get service names from service IDs
  const serviceNames = booking.services.map(serviceId => {
    const serviceMap = {
      'fine-dining': 'Fine Dining Restaurant',
      'casual-dining': 'Casual Dining',
      'bar-lounge': 'Bar & Lounge',
      'room-service': 'Room Service',
      'breakfast-buffet': 'Breakfast Buffet',
      'spa-massage': 'Spa & Massage',
      'facial-treatment': 'Facial Treatment',
      'body-treatment': 'Body Treatment',
      'sauna-steam': 'Sauna & Steam Room',
      'fitness-center': 'Fitness Center',
      'yoga-classes': 'Yoga Classes',
      'swimming-pool': 'Swimming Pool',
      'tennis-court': 'Tennis Court',
      'golf-course': 'Golf Course',
      'gym-workout': 'Gym & Workout',
      'bicycle-rental': 'Bicycle Rental',
      'city-tours': 'City Tours',
      'conference-room': 'Conference Room',
      'meeting-space': 'Meeting Space',
      'wedding-venue': 'Wedding Venue',
      'event-planning': 'Event Planning',
      'audio-visual': 'Audio Visual Equipment',
      'concierge-service': 'Concierge Service',
      'transportation': 'Transportation',
      'ticket-booking': 'Ticket Booking',
      'restaurant-reservation': 'Restaurant Reservation',
      'shopping-assistance': 'Shopping Assistance',
      'kids-club': 'Kids Club',
      'babysitting': 'Babysitting Service',
      'family-activities': 'Family Activities',
      'children-menu': 'Children\'s Menu',
      'playground': 'Playground',
      'romance-package': 'Romance Package',
      'family-package': 'Family Package',
      'business-package': 'Business Package',
      'wellness-package': 'Wellness Package',
      'adventure-package': 'Adventure Package',
      'pet-sitting': 'Pet Sitting',
      'pet-walking': 'Pet Walking',
      'pet-grooming': 'Pet Grooming',
      'pet-friendly-room': 'Pet-Friendly Room',
      'pet-amenities': 'Pet Amenities'
    };
    return serviceMap[serviceId] || serviceId;
  }).join(', ');
  
  card.innerHTML = `
    <div class="booking-header">
      <span class="booking-status">${booking.status}</span>
      <span class="booking-id">#${booking.id}</span>
    </div>
    <div class="booking-content">
      <div class="booking-image">
        <img src="images/service.png" alt="Service Booking">
      </div>
      <div class="booking-details">
        <h3>Service Booking</h3>
        <div class="booking-info">
          <span><i class="fas fa-calendar-alt"></i> Date: ${booking.date}</span>
          <span><i class="fas fa-clock"></i> Time: ${booking.time}</span>
          <span><i class="fas fa-users"></i> ${booking.people} People</span>
          <span><i class="fas fa-concierge-bell"></i> ${booking.services.length} Services</span>
          <span><i class="fas fa-check-circle"></i> Booked: ${booking.status}</span>
        </div>
        <div class="service-list">
          <i class="fas fa-tags"></i>
          <strong>Services:</strong> ${serviceNames}
        </div>
        <div class="booking-total">
          <span class="total-amount">$${booking.total}</span>
          <span class="total-label">Total for services</span>
        </div>
      </div>
    </div>
    <div class="booking-actions">
      <button class="btn" onclick="viewServiceBooking('${booking.id}')"><i class="fas fa-eye"></i> View Details</button>
      <button class="btn" onclick="modifyServiceBooking('${booking.id}')"><i class="fas fa-edit"></i> Modify</button>
      <button class="btn btn-cancel" onclick="cancelServiceBooking('${booking.id}')"><i class="fas fa-times"></i> Cancel</button>
    </div>
  `;
  
  return card;
}

// Update booking overview numbers
function updateBookingOverview() {
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  const serviceBookings = bookings.filter(booking => booking.type === 'service');
  
  // Update active bookings count (including service bookings)
  const activeBookingsElement = document.querySelector('.overview-cards .overview-card:nth-child(1) .overview-number');
  if (activeBookingsElement) {
    const staticBookings = 2; // The existing room bookings
    const totalActiveBookings = staticBookings + serviceBookings.length;
    activeBookingsElement.textContent = totalActiveBookings;
  }
}

// View service booking details
function viewServiceBooking(bookingId) {
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  const booking = bookings.find(b => b.id === bookingId);
  
  if (!booking) {
    showNotification('Booking not found.', 'error');
    return;
  }
  
  // Create modal to show booking details
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    color: #333;
  `;
  
  // Get service names
  const serviceNames = booking.services.map(serviceId => {
    const serviceMap = {
      'fine-dining': 'Fine Dining Restaurant',
      'casual-dining': 'Casual Dining',
      'bar-lounge': 'Bar & Lounge',
      'room-service': 'Room Service',
      'breakfast-buffet': 'Breakfast Buffet',
      'spa-massage': 'Spa & Massage',
      'facial-treatment': 'Facial Treatment',
      'body-treatment': 'Body Treatment',
      'sauna-steam': 'Sauna & Steam Room',
      'fitness-center': 'Fitness Center',
      'yoga-classes': 'Yoga Classes',
      'swimming-pool': 'Swimming Pool',
      'tennis-court': 'Tennis Court',
      'golf-course': 'Golf Course',
      'gym-workout': 'Gym & Workout',
      'bicycle-rental': 'Bicycle Rental',
      'city-tours': 'City Tours',
      'conference-room': 'Conference Room',
      'meeting-space': 'Meeting Space',
      'wedding-venue': 'Wedding Venue',
      'event-planning': 'Event Planning',
      'audio-visual': 'Audio Visual Equipment',
      'concierge-service': 'Concierge Service',
      'transportation': 'Transportation',
      'ticket-booking': 'Ticket Booking',
      'restaurant-reservation': 'Restaurant Reservation',
      'shopping-assistance': 'Shopping Assistance',
      'kids-club': 'Kids Club',
      'babysitting': 'Babysitting Service',
      'family-activities': 'Family Activities',
      'children-menu': 'Children\'s Menu',
      'playground': 'Playground',
      'romance-package': 'Romance Package',
      'family-package': 'Family Package',
      'business-package': 'Business Package',
      'wellness-package': 'Wellness Package',
      'adventure-package': 'Adventure Package',
      'pet-sitting': 'Pet Sitting',
      'pet-walking': 'Pet Walking',
      'pet-grooming': 'Pet Grooming',
      'pet-friendly-room': 'Pet-Friendly Room',
      'pet-amenities': 'Pet Amenities'
    };
    return serviceMap[serviceId] || serviceId;
  });
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Service Booking Details</h2>
      <button id="closeServiceDetailsBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
    </div>
    
    <div style="margin-bottom: 20px;">
      <img src="images/service.png" alt="Service Booking" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px;">
    </div>
    
    <div style="margin-bottom: 15px;">
      <h3 style="color: #333; margin: 0 0 10px 0;">Booking Information</h3>
      <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; margin-bottom: 15px;">
        <p><strong>Booking ID:</strong> ${booking.id}</p>
        <p><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">${booking.status}</span></p>
        <p><strong>Date:</strong> ${booking.date}</p>
        <p><strong>Time:</strong> ${booking.time}</p>
        <p><strong>Number of People:</strong> ${booking.people}</p>
        <p><strong>Total Amount:</strong> <span style="color: #FFD700; font-weight: bold; font-size: 1.2em;">${booking.amount}</span></p>
        <p><strong>Booked On:</strong> ${booking.bookingDate}</p>
      </div>
    </div>
    
    <div style="margin-bottom: 15px;">
      <h4 style="color: #333; margin: 0 0 10px 0;">Selected Services (${booking.services.length})</h4>
      <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
        <ul style="margin: 0; padding-left: 20px; color: #333;">
          ${serviceNames.map(service => `<li>${service}</li>`).join('')}
        </ul>
      </div>
    </div>
    
    ${booking.requests ? `
    <div style="margin-bottom: 15px;">
      <h4 style="color: #333; margin: 0 0 10px 0;">Special Requests</h4>
      <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; color: #333;">
        <p style="margin: 0;">${booking.requests}</p>
      </div>
    </div>
    ` : ''}
    
    <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
      <button onclick="modifyServiceBooking('${booking.id}')" 
              style="padding: 12px 24px; background: #FFD700; color: #000; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-edit" style="color: #000;"></i> Modify Booking
      </button>
      <button onclick="cancelServiceBooking('${booking.id}')" 
              style="padding: 12px 24px; background: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-times" style="color: #fff;"></i> Cancel Booking
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeServiceDetailsBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Modify service booking
function modifyServiceBooking(bookingId) {
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  const booking = bookings.find(b => b.id === bookingId);
  
  if (!booking) {
    showNotification('Booking not found.', 'error');
    return;
  }
  
  // Create modal for modifying booking
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    color: #333;
  `;
  
  modalContent.innerHTML = `
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
      <h2 style="color: #FFD700; margin: 0;">Modify Service Booking</h2>
      <button id="closeModifyBtn" style="background: none; border: none; font-size: 24px; cursor: pointer; color: #666;">&times;</button>
    </div>
    
    <form id="modifyBookingForm">
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Booking ID:</label>
        <input type="text" value="${booking.id}" readonly style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; background-color: #f8f9fa;">
      </div>
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Date:</label>
        <input type="date" id="modifyDate" value="${booking.date}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Time:</label>
        <input type="time" id="modifyTime" value="${booking.time}" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Number of People:</label>
        <input type="number" id="modifyPeople" value="${booking.people}" min="1" max="10" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
      </div>
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Special Requests:</label>
        <textarea id="modifyRequests" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; resize: vertical;">${booking.requests || ''}</textarea>
      </div>
      
      <div style="margin-bottom: 15px;">
        <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #333;">Selected Services:</label>
        <div style="background: #f8f9fa; padding: 15px; border-radius: 8px; color: #333;">
          <p style="margin: 0; font-weight: bold;">${booking.services.length} services selected</p>
          <p style="margin: 5px 0 0 0; font-size: 0.9em; color: #666;">Note: Services cannot be modified after booking. Please cancel and rebook if you need to change services.</p>
        </div>
      </div>
      
      <div style="display: flex; gap: 10px; justify-content: center; margin-top: 20px;">
        <button type="submit" 
                style="padding: 12px 24px; background: #FFD700; color: #000; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
          <i class="fas fa-save" style="color: #000;"></i> Save Changes
        </button>
        <button type="button" onclick="cancelServiceBooking('${booking.id}')" 
                style="padding: 12px 24px; background: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
          <i class="fas fa-times" style="color: #fff;"></i> Cancel Booking
        </button>
      </div>
    </form>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Handle form submission
  const form = modalContent.querySelector('#modifyBookingForm');
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const updatedBooking = {
      ...booking,
      date: document.getElementById('modifyDate').value,
      time: document.getElementById('modifyTime').value,
      people: document.getElementById('modifyPeople').value,
      requests: document.getElementById('modifyRequests').value
    };
    
    // Update booking in localStorage
    const updatedBookings = bookings.map(b => b.id === bookingId ? updatedBooking : b);
    localStorage.setItem('pv_bookings', JSON.stringify(updatedBookings));
    
    showNotification('Booking modified successfully!', 'success');
    modal.remove();
    
    // Reload bookings to update the display
    setTimeout(() => {
      loadBookings();
    }, 500);
  });
  
  // Add event listener for close button
  const closeBtn = modalContent.querySelector('#closeModifyBtn');
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      modal.remove();
    });
  }
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Cancel service booking
function cancelServiceBooking(bookingId) {
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  const updatedBookings = bookings.filter(b => b.id !== bookingId);
  localStorage.setItem('pv_bookings', JSON.stringify(updatedBookings));
  
  showNotification(`Service booking ${bookingId} cancelled successfully!`, 'success');
  
  // Reload bookings to update the display
  setTimeout(() => {
    loadBookings();
  }, 500);
}

// Load bookings when page loads
document.addEventListener('DOMContentLoaded', function() {
  loadBookings();
});

// Enhanced wishlist functionality for rooms
function toggleRoomWishlist(roomId) {
  const heartElement = document.getElementById(`${roomId}-heart`);
  const heartContainer = heartElement.parentElement;
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  
  if (heartContainer.classList.contains('active')) {
    // Remove from wishlist
    heartContainer.classList.remove('active');
    heartElement.style.color = '#ccc';
    
    // Remove from localStorage
    const updatedWishlist = wishlistItems.filter(id => id !== roomId);
    localStorage.setItem('pv_wishlist_rooms', JSON.stringify(updatedWishlist));
    
    showNotification(`${getRoomName(roomId)} removed from wishlist!`, 'info');
  } else {
    // Add to wishlist
    heartContainer.classList.add('active');
    heartElement.style.color = '#ff0000';
    
    // Add to localStorage
    if (!wishlistItems.includes(roomId)) {
      wishlistItems.push(roomId);
      localStorage.setItem('pv_wishlist_rooms', JSON.stringify(wishlistItems));
    }
    
    showNotification(`${getRoomName(roomId)} added to wishlist!`, 'success');
  }
}

// Get room name from room ID
function getRoomName(roomId) {
  const roomNames = {
    'deluxe-room': 'Deluxe Room',
    'premium-room': 'Premium Room',
    'executive-room': 'Executive Room',
    'luxury-suite': 'Luxury Suite',
    'family-suite': 'Family Suite',
    'pearl-signature': 'Pearl Signature Room'
  };
  return roomNames[roomId] || roomId;
}

// Initialize wishlist hearts on page load
function initializeWishlistHearts() {
  // Initialize room hearts
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  wishlistItems.forEach(roomId => {
    const heartElement = document.getElementById(`${roomId}-heart`);
    if (heartElement) {
      const heartContainer = heartElement.parentElement;
      heartContainer.classList.add('active');
      heartElement.style.color = '#ff0000';
    }
  });
  
  // Initialize service hearts
  const serviceWishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_services') || '[]');
  serviceWishlistItems.forEach(serviceId => {
    const heartElement = document.getElementById(`${serviceId}-heart`);
    if (heartElement) {
      const heartContainer = heartElement.parentElement;
      heartContainer.classList.add('active');
      heartElement.style.color = '#ff0000';
    }
  });
}

// Initialize wishlist when page loads
document.addEventListener('DOMContentLoaded', function() {
  initializeWishlistHearts();
});

// Add More Rooms functionality
function addMoreRooms() {
  showNotification('Redirecting to rooms page...', 'info');
  setTimeout(() => {
    window.location.href = 'rooms.html';
  }, 1000);
}

// Add More Services functionality
function addMoreServices() {
  showNotification('Redirecting to services page...', 'info');
  setTimeout(() => {
    window.location.href = 'services.html';
  }, 1000);
}

// Enhanced Clear All functionality
function clearWishlist() {
  // Create confirmation modal
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 500px;
    width: 90%;
    text-align: center;
    color: #333;
  `;
  
  modalContent.innerHTML = `
    <div style="margin-bottom: 20px;">
      <i class="fas fa-exclamation-triangle" style="color: #ffc107; font-size: 3rem; margin-bottom: 15px;"></i>
      <h2 style="color: #333; margin: 0 0 10px 0;">Clear All Wishlist Items?</h2>
      <p style="color: #666; margin: 0;">This action will permanently remove all saved rooms and services from your wishlist. This action cannot be undone.</p>
    </div>
    
    <div style="display: flex; gap: 10px; justify-content: center;">
      <button id="confirmClearBtn" 
              style="padding: 12px 24px; background: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-trash" style="color: #fff;"></i> Yes, Clear All
      </button>
      <button id="cancelClearBtn" 
              style="padding: 12px 24px; background: #6c757d; color: #fff; border: none; border-radius: 5px; cursor: pointer; font-weight: bold;">
        <i class="fas fa-times" style="color: #fff;"></i> Cancel
      </button>
    </div>
  `;
  
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  // Handle confirmation
  const confirmBtn = modalContent.querySelector('#confirmClearBtn');
  const cancelBtn = modalContent.querySelector('#cancelClearBtn');
  
  confirmBtn.addEventListener('click', function() {
    // Clear all wishlist items
    const wishlistCards = document.querySelectorAll('.wishlist-card, .service-wishlist-card');
    
    wishlistCards.forEach((card, index) => {
      setTimeout(() => {
        card.style.animation = 'fadeOut 0.5s ease-out';
        setTimeout(() => {
          card.remove();
        }, 500);
      }, index * 100);
    });
    
    // Clear localStorage
    localStorage.removeItem('pv_wishlist_rooms');
    localStorage.removeItem('pv_wishlist_services');
    
    // Update wishlist counts
    setTimeout(() => {
      updateWishlistCounts();
      showNotification('All wishlist items cleared successfully!', 'success');
    }, wishlistCards.length * 100 + 500);
    
    modal.remove();
  });
  
  cancelBtn.addEventListener('click', function() {
    modal.remove();
  });
  
  // Close modal when clicking outside
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      modal.remove();
    }
  });
}

// Helper function to get room details
function getRoomDetails(roomId) {
  const roomData = {
    'pearl-signature': {
      name: 'Pearl Signature Room',
      description: 'Our most luxurious room with panoramic city views and premium amenities',
      capacity: '2 Guests',
      bedType: '1 King Bed',
      amenities: 'Free WiFi, Mini Bar, Room Service, City View',
      price: '18990',
      image: 'sophistication-room.png'
    },
    'deluxe-room': {
      name: 'Deluxe Room',
      description: 'Perfect for solo travelers or couples seeking comfort and style',
      capacity: '2 Guests',
      bedType: '1 King Bed',
      amenities: 'Free WiFi, Mini Bar, Room Service, City View',
      price: '3240',
      image: 'deluxe-room.png'
    },
    'premium-room': {
      name: 'Premium Room',
      description: 'Enhanced comfort with premium amenities and stunning city views',
      capacity: '2 Guests',
      bedType: '1 King Bed',
      amenities: 'Free WiFi, Mini Bar, Room Service, City View',
      price: '5580',
      image: 'premium-room.png'
    },
    'executive-room': {
      name: 'Executive Room',
      description: 'Business travelers\' choice with work space and executive lounge access',
      capacity: '2 Guests',
      bedType: '1 King Bed',
      amenities: 'Free WiFi, Work Desk, Premium Toiletries, City View',
      price: '8790',
      image: 'executive-room.png'
    },
    'luxury-suite': {
      name: 'Luxury Suite',
      description: 'Ultimate luxury with separate living area and premium amenities',
      capacity: '3 Guests',
      bedType: '1 King Bed',
      amenities: 'Free WiFi, Mini Bar, Room Service, City View',
      price: '11920',
      image: 'Luxury_suite.jpg'
    },
    'family-suite': {
      name: 'Family Suite',
      description: 'Spacious suite perfect for families with separate bedrooms and living area',
      capacity: '4 Guests',
      bedType: '2 Bedrooms with King and Queen Beds',
      amenities: 'Free WiFi, Mini Bar, Room Service, City View',
      price: '14855',
      image: 'family-suite.png'
    }
  };
  
  return roomData[roomId] || {
    name: 'Unknown Room',
    description: 'Room details not available',
    capacity: 'Unknown',
    bedType: 'Unknown',
    amenities: 'Unknown',
    price: '0',
    image: 'room.png'
  };
}

// Helper function to get service details
function getServiceDetails(serviceId) {
  const serviceData = {
    'dining': {
      name: 'Dining & Culinary Excellence',
      description: 'Experience world-class cuisine prepared by renowned chefs using the finest ingredients',
      duration: 'All Day Dining',
      features: 'International Cuisine, Local Specialties, Premium Ingredients',
      price: '80',
      image: 'dining.png'
    },
    'spa': {
      name: 'Wellness & Spa Services',
      description: 'Rejuvenate your mind, body, and soul with our luxury spa and wellness treatments',
      duration: '60-120 minutes',
      features: 'Premium Treatments, Natural Products, Expert Therapists',
      price: '150',
      image: 'spa.png'
    },
    'leisure': {
      name: 'Leisure & Activities',
      description: 'Stay active and entertained with our range of leisure activities and recreational facilities',
      duration: 'Unlimited access',
      features: 'Swimming Pool, Recreation Center, Outdoor Activities',
      price: '25',
      image: 'pool.png'
    },
    'events': {
      name: 'Events & Meetings',
      description: 'Professional event spaces and meeting facilities for corporate and social gatherings',
      duration: 'Flexible hours',
      features: 'Conference Rooms, Wedding Venues, Social Events',
      price: '200',
      image: 'service.png'
    },
    'concierge': {
      name: 'Concierge Services',
      description: 'Personalized assistance and exclusive services to enhance your stay',
      duration: '24/7 Available',
      features: 'Travel Arrangements, Tourist Services, Personal Shopping',
      price: '50',
      image: 'service.png'
    },
    'kids': {
      name: 'Kids & Family',
      description: 'Specialized services and activities designed for families with children',
      duration: '9:00 AM - 6:00 PM',
      features: 'Kids Club, Family Activities, Babysitting',
      price: '30',
      image: 'service.png'
    },
    'packages': {
      name: 'Packages & Experiences',
      description: 'Exclusive offers and curated experiences for every guest',
      duration: 'Custom duration',
      features: 'Romantic Escape, Family Adventure, Seasonal Specials',
      price: '300',
      image: 'service.png'
    },
    'pet-services': {
      name: 'Pet Services',
      description: 'Amenities and care for your furry companions',
      duration: '24/7 Available',
      features: 'Pet-Friendly Rooms, Pet Sitting, Pet Grooming',
      price: '40',
      image: 'service.png'
    }
  };
  
  return serviceData[serviceId] || {
    name: 'Unknown Service',
    description: 'Service details not available',
    duration: 'Unknown',
    features: 'Unknown',
    price: '0',
    image: 'service.png'
  };
}

// Toggle wishlist function for HTML onclick calls
function toggleWishlist(roomId) {
  toggleRoomWishlist(roomId);
}

// Enhanced wishlist management with simultaneous updates
function toggleRoomWishlist(roomId) {
  const heartElement = document.getElementById(`${roomId}-heart`);
  const heartContainer = heartElement.parentElement;
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  
  if (heartContainer.classList.contains('active')) {
    // Remove from wishlist
    heartContainer.classList.remove('active');
    heartElement.style.color = '#ccc';
    
    // Remove from localStorage
    const updatedWishlist = wishlistItems.filter(id => id !== roomId);
    localStorage.setItem('pv_wishlist_rooms', JSON.stringify(updatedWishlist));
    
    // Update wishlist display if on wishlist page
    if (window.location.pathname.includes('my-wishlist.html')) {
      removeWishlistItem(roomId);
    }
    
    // Update wishlist counts
    updateWishlistCounts();
    
    showNotification(`${getRoomName(roomId)} removed from wishlist!`, 'info');
  } else {
    // Add to wishlist
    heartContainer.classList.add('active');
    heartElement.style.color = '#ff0000';
    
    // Add to localStorage
    if (!wishlistItems.includes(roomId)) {
      wishlistItems.push(roomId);
      localStorage.setItem('pv_wishlist_rooms', JSON.stringify(wishlistItems));
    }
    
    // Update wishlist display if on wishlist page
    if (window.location.pathname.includes('my-wishlist.html')) {
      addWishlistItem(roomId);
    }
    
    // Update wishlist counts
    updateWishlistCounts();
    
    showNotification(`${getRoomName(roomId)} added to wishlist!`, 'success');
  }
}

// Add wishlist item to display
function addWishlistItem(roomId) {
  const roomDetails = getRoomDetails(roomId);
  const wishlistGrid = document.querySelector('.wishlist-grid');
  
  if (!wishlistGrid) return;
  
  // Check if item already exists
  const existingItem = document.querySelector(`[data-room-id="${roomId}"]`);
  if (existingItem) return;
  
  const wishlistCard = document.createElement('div');
  wishlistCard.className = 'wishlist-card';
  wishlistCard.setAttribute('data-room-id', roomId);
  
  wishlistCard.innerHTML = `
    <div class="wishlist-image">
      <img src="images/${roomDetails.image}" alt="${roomDetails.name}">
      <div class="wishlist-overlay">
        <button class="remove-btn" onclick="removeFromWishlist('${roomId}')">
          <i class="fas fa-heart" style="color: #ff0000;"></i>
        </button>
      </div>
    </div>

    <div class="wishlist-content">
      <h3>${roomDetails.name}</h3>
      <div class="wishlist-details">
        <span><i class="fas fa-user"></i> ${roomDetails.capacity}</span>
        <span><i class="fas fa-bed"></i> ${roomDetails.bedType}</span>
        <span><i class="fas fa-wifi"></i> Free WiFi</span>
      </div>
      <div class="wishlist-price">
        <span class="price">$${roomDetails.price}</span>
        <span class="per-night">per night</span>
      </div>
      <div class="wishlist-actions">
        <button class="btn signup" onclick="bookNow('${roomId}')">
          <i class="fas fa-calendar-check" style="color: #000;"></i> Book Now
        </button>
        <button class="btn login" onclick="viewDetails('${roomId}')">
          <i class="fas fa-eye" style="color: #000;"></i> View Details
        </button>
      </div>
    </div>
  `;
  
  // Add animation
  wishlistCard.style.opacity = '0';
  wishlistCard.style.transform = 'translateY(20px)';
  wishlistGrid.appendChild(wishlistCard);
  
  // Animate in
  setTimeout(() => {
    wishlistCard.style.transition = 'all 0.3s ease';
    wishlistCard.style.opacity = '1';
    wishlistCard.style.transform = 'translateY(0)';
  }, 10);
}

// Remove wishlist item from display
function removeWishlistItem(roomId) {
  const wishlistItem = document.querySelector(`[data-room-id="${roomId}"]`);
  if (!wishlistItem) return;
  
  // Animate out
  wishlistItem.style.transition = 'all 0.3s ease';
  wishlistItem.style.opacity = '0';
  wishlistItem.style.transform = 'translateY(-20px)';
  
  setTimeout(() => {
    wishlistItem.remove();
    updateWishlistCounts();
  }, 300);
}

// Load wishlist items on page load
function loadWishlistItems() {
  if (!window.location.pathname.includes('my-wishlist.html')) {
    return;
  }
  
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  const wishlistGrid = document.querySelector('.wishlist-grid');
  
  if (!wishlistGrid) return;
  
  // Clear ALL existing items (both static and dynamic)
  const existingItems = wishlistGrid.querySelectorAll('.wishlist-card');
  existingItems.forEach(item => item.remove());
  
  // Add wishlist items from localStorage
  wishlistItems.forEach(roomId => {
    addWishlistItem(roomId);
  });
  
  updateWishlistCounts();
}

// Enhanced remove from wishlist function
function removeFromWishlist(itemId) {
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  const updatedWishlist = wishlistItems.filter(id => id !== itemId);
  localStorage.setItem('pv_wishlist_rooms', JSON.stringify(updatedWishlist));
  
  // Update heart icon on other pages
  const heartElement = document.getElementById(`${itemId}-heart`);
  if (heartElement) {
    const heartContainer = heartElement.parentElement;
    heartContainer.classList.remove('active');
    heartElement.style.color = '#ccc';
  }
  
  // Remove from wishlist display
  removeWishlistItem(itemId);
  
  showNotification(`${getRoomName(itemId)} removed from wishlist!`, 'info');
}

// Remove duplicate function - using the enhanced version below

// Initialize wishlist on page load
document.addEventListener('DOMContentLoaded', function() {
  initializeWishlistHearts();
  loadWishlistItems();
  loadServiceWishlistItems();
  updateWishlistCounts();
});

// Toggle wishlist for services
function toggleServiceWishlist(serviceId) {
  const heartElement = document.getElementById(`${serviceId}-heart`);
  const heartContainer = heartElement.parentElement;
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_services') || '[]');

  if (heartContainer.classList.contains('active')) {
    // Remove from wishlist
    heartContainer.classList.remove('active');
    heartElement.style.color = '#ccc';
    const updatedWishlist = wishlistItems.filter(id => id !== serviceId);
    localStorage.setItem('pv_wishlist_services', JSON.stringify(updatedWishlist));
    if (window.location.pathname.includes('my-wishlist.html')) {
      removeServiceWishlistItem(serviceId);
    }
    updateWishlistCounts();
    showNotification(`${getServiceDetails(serviceId).name} removed from wishlist!`, 'info');
  } else {
    // Add to wishlist
    heartContainer.classList.add('active');
    heartElement.style.color = '#ff0000';
    if (!wishlistItems.includes(serviceId)) {
      wishlistItems.push(serviceId);
      localStorage.setItem('pv_wishlist_services', JSON.stringify(wishlistItems));
    }
    if (window.location.pathname.includes('my-wishlist.html')) {
      addServiceWishlistItem(serviceId);
    }
    updateWishlistCounts();
    showNotification(`${getServiceDetails(serviceId).name} added to wishlist!`, 'success');
  }
}

// Add service wishlist item to display
function addServiceWishlistItem(serviceId) {
  const serviceDetails = getServiceDetails(serviceId);
  const servicesWishlistGrid = document.querySelector('.services-wishlist-grid');
  
  if (!servicesWishlistGrid) return;
  
  // Check if item already exists
  const existingItem = document.querySelector(`[data-service-id="${serviceId}"]`);
  if (existingItem) return;
  
  const serviceWishlistCard = document.createElement('div');
  serviceWishlistCard.className = 'service-wishlist-card';
  serviceWishlistCard.setAttribute('data-service-id', serviceId);
  
  serviceWishlistCard.innerHTML = `
    <div class="service-wishlist-image">
      <img src="images/${serviceDetails.image}" alt="${serviceDetails.name}">
      <div class="wishlist-overlay">
        <button class="remove-btn" onclick="removeServiceFromWishlist('${serviceId}')">
          <i class="fas fa-heart" style="color: #ff0000;"></i>
        </button>
      </div>
    </div>

    <div class="service-wishlist-content">
      <h3>${serviceDetails.name}</h3>
      <p>${serviceDetails.description}</p>
      <div class="service-wishlist-features">
        <span><i class="fas fa-clock"></i> ${serviceDetails.duration}</span>
        <span><i class="fas fa-star"></i> ${serviceDetails.features}</span>
      </div>
      <div class="service-wishlist-actions">
        <button class="btn signup" onclick="bookService('${serviceId}')">
          <i class="fas fa-calendar-check" style="color: #000;"></i> Book Service
        </button>
        <button class="btn login" onclick="viewServiceDetails('${serviceId}')">
          <i class="fas fa-eye" style="color: #000;"></i> View Details
        </button>
      </div>
    </div>
  `;
  
  // Add animation
  serviceWishlistCard.style.opacity = '0';
  serviceWishlistCard.style.transform = 'translateY(20px)';
  servicesWishlistGrid.appendChild(serviceWishlistCard);
  
  // Animate in
  setTimeout(() => {
    serviceWishlistCard.style.transition = 'all 0.3s ease';
    serviceWishlistCard.style.opacity = '1';
    serviceWishlistCard.style.transform = 'translateY(0)';
  }, 10);
}

// Remove service wishlist item from display
function removeServiceWishlistItem(serviceId) {
  const serviceWishlistItem = document.querySelector(`[data-service-id="${serviceId}"]`);
  if (!serviceWishlistItem) return;
  
  // Animate out
  serviceWishlistItem.style.transition = 'all 0.3s ease';
  serviceWishlistItem.style.opacity = '0';
  serviceWishlistItem.style.transform = 'translateY(-20px)';
  
  setTimeout(() => {
    serviceWishlistItem.remove();
    updateWishlistCounts();
  }, 300);
}

// Enhanced remove service from wishlist function
function removeServiceFromWishlist(serviceId) {
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_services') || '[]');
  const updatedWishlist = wishlistItems.filter(id => id !== serviceId);
  localStorage.setItem('pv_wishlist_services', JSON.stringify(updatedWishlist));
  
  // Update heart icon on services page
  const heartElement = document.getElementById(`${serviceId}-heart`);
  if (heartElement) {
    const heartContainer = heartElement.parentElement;
    heartContainer.classList.remove('active');
    heartElement.style.color = '#ccc';
  }
  
  // Remove from wishlist display
  removeServiceWishlistItem(serviceId);
  
  showNotification(`${getServiceName(serviceId)} removed from wishlist!`, 'info');
}

// Load service wishlist items on page load
function loadServiceWishlistItems() {
  if (!window.location.pathname.includes('my-wishlist.html')) {
    return;
  }
  
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_services') || '[]');
  const servicesWishlistGrid = document.querySelector('.services-wishlist-grid');
  
  if (!servicesWishlistGrid) return;
  
  // Clear ALL existing service items (both static and dynamic)
  const existingServiceItems = servicesWishlistGrid.querySelectorAll('.service-wishlist-card');
  existingServiceItems.forEach(item => item.remove());
  
  // Add service wishlist items from localStorage
  wishlistItems.forEach(serviceId => {
    addServiceWishlistItem(serviceId);
  });
  
  updateWishlistCounts();
}

// Enhanced update wishlist counts to include services and future dates
function updateWishlistCounts() {
  const wishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_rooms') || '[]');
  const serviceWishlistItems = JSON.parse(localStorage.getItem('pv_wishlist_services') || '[]');
  const bookings = JSON.parse(localStorage.getItem('pv_bookings') || '[]');
  
  const savedRooms = wishlistItems.length;
  const savedServices = serviceWishlistItems.length;
  const totalItems = savedRooms + savedServices;
  
  // Calculate future dates from bookings
  const today = new Date();
  const futureBookings = bookings.filter(booking => {
    const bookingDate = new Date(booking.date);
    return bookingDate > today;
  });
  const futureDates = futureBookings.length;
  
  // Update overview numbers if on wishlist page
  if (window.location.pathname.includes('my-wishlist.html')) {
    const savedRoomsElement = document.querySelector('.overview-cards .overview-card:nth-child(1) .overview-number');
    const savedServicesElement = document.querySelector('.overview-cards .overview-card:nth-child(2) .overview-number');
    const futureDatesElement = document.querySelector('.overview-cards .overview-card:nth-child(3) .overview-number');
    const totalItemsElement = document.querySelector('.overview-cards .overview-card:nth-child(4) .overview-number');
    
    if (savedRoomsElement) savedRoomsElement.textContent = savedRooms;
    if (savedServicesElement) savedServicesElement.textContent = savedServices;
    if (futureDatesElement) futureDatesElement.textContent = futureDates;
    if (totalItemsElement) totalItemsElement.textContent = totalItems;
  }
  
  // Update wishlist count in navigation if exists
  const wishlistCountElements = document.querySelectorAll('.wishlist-count');
  wishlistCountElements.forEach(element => {
    element.textContent = totalItems;
  });
}

// Initialize wishlist on page load
document.addEventListener('DOMContentLoaded', function() {
  initializeWishlistHearts();
  loadWishlistItems();
  loadServiceWishlistItems();
  updateWishlistCounts();
});

// My Itinerary Action Functions

// Book Spa Service
function bookSpaService() {
  showNotification('Redirecting to spa services...', 'info');
  setTimeout(() => {
    window.location.href = 'services.html#spa';
  }, 1000);
}

// Reserve Table
function reserveTable() {
  showNotification('Redirecting to dining services...', 'info');
  setTimeout(() => {
    window.location.href = 'services.html#dining';
  }, 1000);
}

// Plan an Event
function planEvent() {
  showNotification('Redirecting to event planning services...', 'info');
  setTimeout(() => {
    window.location.href = 'services.html#events';
  }, 1000);
}

// Download Itinerary PDF
function downloadItineraryPDF() {
  // Get itinerary data
  const itineraryData = {
    title: 'My Itinerary - The Pearl Vista',
    date: new Date().toLocaleDateString(),
    guestInfo: {
      name: localStorage.getItem('pv_username') || 'Guest',
      dates: 'July 11 - July 17, 2025',
      guests: '2 Adults, 1 Child',
      room: 'Luxury Suite'
    },
    activities: []
  };
  
  // Get activities from the page
  const activityElements = document.querySelectorAll('.event');
  activityElements.forEach((activity, index) => {
    const timeElement = activity.querySelector('strong');
    const descElement = activity.querySelector('span');
    
    if (timeElement && descElement) {
      itineraryData.activities.push({
        id: index + 1,
        time: timeElement.textContent,
        description: descElement.textContent
      });
    }
  });
  
  // Create PDF content
  let pdfContent = `
    <div style="font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px;">
      <div style="text-align: center; border-bottom: 2px solid #FFD700; padding-bottom: 20px; margin-bottom: 30px;">
        <h1 style="color: #1a2238; margin: 0;">${itineraryData.title}</h1>
        <p style="color: #666; margin: 10px 0;">Generated on ${itineraryData.date}</p>
      </div>
      
      <div style="background: #f8f9fa; padding: 20px; border-radius: 10px; margin-bottom: 30px;">
        <h2 style="color: #1a2238; margin-top: 0;">Guest Information</h2>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
          <div><strong>Name:</strong> ${itineraryData.guestInfo.name}</div>
          <div><strong>Dates:</strong> ${itineraryData.guestInfo.dates}</div>
          <div><strong>Guests:</strong> ${itineraryData.guestInfo.guests}</div>
          <div><strong>Room:</strong> ${itineraryData.guestInfo.room}</div>
        </div>
      </div>
      
      <div>
        <h2 style="color: #1a2238;">Itinerary Activities</h2>
  `;
  
  if (itineraryData.activities.length > 0) {
    itineraryData.activities.forEach(activity => {
      pdfContent += `
        <div style="border-left: 3px solid #FFD700; padding-left: 15px; margin-bottom: 20px;">
          <h3 style="color: #1a2238; margin: 0 0 5px 0;">${activity.time}</h3>
          <p style="color: #666; margin: 0;">${activity.description}</p>
        </div>
      `;
    });
  } else {
    pdfContent += `
      <div style="text-align: center; padding: 40px; color: #666;">
        <p>No activities planned yet.</p>
        <p>Use the "Add Activity" button to plan your itinerary!</p>
      </div>
    `;
  }
  
  pdfContent += `
      </div>
      
      <div style="margin-top: 40px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; color: #666;">
        <p>Thank you for choosing The Pearl Vista!</p>
        <p>For any changes to your itinerary, please contact our concierge.</p>
      </div>
    </div>
  `;
  
  // Generate and download PDF
  generateItineraryPDF(itineraryData.title, pdfContent);
}

// Generate Itinerary PDF
function generateItineraryPDF(title, content) {
  // Create a new window with the PDF content
  const printWindow = window.open('', '_blank');
  printWindow.document.write(`
    <!DOCTYPE html>
    <html>
    <head>
      <title>${title}</title>
      <style>
        body { margin: 0; padding: 20px; font-family: Arial, sans-serif; }
        @media print {
          body { margin: 0; }
          .no-print { display: none; }
        }
      </style>
    </head>
    <body>
      ${content}
      <div class="no-print" style="text-align: center; margin-top: 30px;">
        <button onclick="window.print()" style="background: #FFD700; color: #1a2238; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-weight: bold;">
          Print PDF
        </button>
        <button onclick="window.close()" style="background: #666; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; margin-left: 10px;">
          Close
        </button>
      </div>
    </body>
    </html>
  `);
  printWindow.document.close();
  
  showNotification('Itinerary PDF generated! Opening in new window...', 'success');
}

// ... existing code ... 

function showBarMenu() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Restaurant & Bar Menu</h2>
      <button id='closeBarMenuBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Restaurant Menu</div>
    <div style="margin-bottom: 18px;">
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:18px 0 8px 0; border-bottom:1px solid #FFD700;'>Appetizers</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Burrata Salad</strong><br><span style='color:#FFD700;font-size:0.97em;'>Heirloom tomatoes, basil, olive oil</span></span><span style='color:#FFD700;font-weight:700;'>$2400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Lobster Bisque</strong><br><span style='color:#FFD700;font-size:0.97em;'>Creamy lobster soup, chive oil</span></span><span style='color:#FFD700;font-weight:700;'>$2900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Spring Rolls</strong><br><span style='color:#FFD700;font-size:0.97em;'>Vegetable filling, sweet chili sauce</span></span><span style='color:#FFD700;font-weight:700;'>$1500</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:18px 0 8px 0; border-bottom:1px solid #FFD700;'>Mains</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Grilled Salmon</strong><br><span style='color:#FFD700;font-size:0.97em;'>With lemon butter sauce, seasonal vegetables</span></span><span style='color:#FFD700;font-weight:700;'>$5200</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px; background:#2a2f4a; border-radius:8px; box-shadow:0 2px 8px #FFD70033;'><span><strong>Filet Mignon <span style="color:#FFD700; font-size:1.1em;">★</span></strong><br><span style='color:#FFD700;font-size:0.97em;'>Prime beef, truffle mashed potatoes, asparagus</span><br><span style='background:#FFD700; color:#1a2238; font-size:0.85em; font-weight:700; border-radius:4px; padding:2px 8px; margin-top:2px; display:inline-block;'>Chef's Special</span></span><span style='color:#FFD700;font-weight:700;'>$6800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Seafood Paella</strong><br><span style='color:#FFD700;font-size:0.97em;'>Saffron rice, shrimp, mussels, calamari</span></span><span style='color:#FFD700;font-weight:700;'>$5400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Herb-Crusted Lamb Chops</strong><br><span style='color:#FFD700;font-size:0.97em;'>Rosemary jus, root vegetables</span></span><span style='color:#FFD700;font-weight:700;'>$6200</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Butter Chicken</strong><br><span style='color:#FFD700;font-size:0.97em;'>Creamy tomato sauce, basmati rice, naan</span></span><span style='color:#FFD700;font-weight:700;'>$3600</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Chicken Alfredo Pasta</strong><br><span style='color:#FFD700;font-size:0.97em;'>Creamy parmesan sauce, grilled chicken, fettuccine</span></span><span style='color:#FFD700;font-weight:700;'>$3700</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Moroccan Lamb Tagine</strong><br><span style='color:#FFD700;font-size:0.97em;'>Spiced lamb, apricots, almonds, couscous</span></span><span style='color:#FFD700;font-weight:700;'>$5800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Duck à l'Orange</strong><br><span style='color:#FFD700;font-size:0.97em;'>Roast duck, orange sauce, glazed carrots</span></span><span style='color:#FFD700;font-weight:700;'>$5900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Grilled Swordfish</strong><br><span style='color:#FFD700;font-size:0.97em;'>Lemon caper butter, asparagus, wild rice</span></span><span style='color:#FFD700;font-weight:700;'>$5700</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Beef Bourguignon</strong><br><span style='color:#FFD700;font-size:0.97em;'>Red wine braised beef, pearl onions, mushrooms</span></span><span style='color:#FFD700;font-weight:700;'>$4900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Chicken Cordon Bleu</strong><br><span style='color:#FFD700;font-size:0.97em;'>Stuffed chicken, ham, Swiss cheese, Dijon cream</span></span><span style='color:#FFD700;font-weight:700;'>$4100</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:18px 0 8px 0; border-bottom:1px solid #FFD700;'>Vegetarian & Vegan</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Vegetarian Risotto</strong><br><span style='color:#FFD700;font-size:0.97em;'>Wild mushrooms, parmesan, fresh herbs</span></span><span style='color:#FFD700;font-weight:700;'>$3800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Eggplant Parmesan</strong><br><span style='color:#FFD700;font-size:0.97em;'>Breaded eggplant, marinara, mozzarella</span></span><span style='color:#FFD700;font-weight:700;'>$3200</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Thai Green Curry</strong><br><span style='color:#FFD700;font-size:0.97em;'>Chicken, coconut milk, vegetables, jasmine rice</span></span><span style='color:#FFD700;font-weight:700;'>$3400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Vegan Buddha Bowl</strong><br><span style='color:#FFD700;font-size:0.97em;'>Quinoa, chickpeas, avocado, roasted veggies</span></span><span style='color:#FFD700;font-weight:700;'>$2900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Mushroom Stroganoff</strong><br><span style='color:#FFD700;font-size:0.97em;'>Wild mushrooms, creamy sauce, egg noodles</span></span><span style='color:#FFD700;font-weight:700;'>$3300</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Vegetable Pad Thai</strong><br><span style='color:#FFD700;font-size:0.97em;'>Rice noodles, tofu, peanuts, tamarind sauce</span></span><span style='color:#FFD700;font-weight:700;'>$2800</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:18px 0 8px 0; border-bottom:1px solid #FFD700;'>Snacks & Sides</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Truffle Fries</strong><br><span style='color:#FFD700;font-size:0.97em;'>Crispy fries, truffle oil, parmesan</span></span><span style='color:#FFD700;font-weight:700;'>$1600</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Mini Sliders</strong><br><span style='color:#FFD700;font-size:0.97em;'>Beef patties, cheddar, brioche buns</span></span><span style='color:#FFD700;font-weight:700;'>$2100</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Chicken Satay</strong><br><span style='color:#FFD700;font-size:0.97em;'>Peanut sauce, cucumber relish</span></span><span style='color:#FFD700;font-weight:700;'>$1900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Margherita Pizza</strong><br><span style='color:#FFD700;font-size:0.97em;'>Tomato, mozzarella, basil</span></span><span style='color:#FFD700;font-weight:700;'>$2700</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Pepperoni Pizza</strong><br><span style='color:#FFD700;font-size:0.97em;'>Pepperoni, mozzarella</span></span><span style='color:#FFD700;font-weight:700;'>$2900</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Club Sandwich</strong><br><span style='color:#FFD700;font-size:0.97em;'>Turkey, bacon, lettuce, tomato, fries</span></span><span style='color:#FFD700;font-weight:700;'>$2300</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Cheese Platter</strong><br><span style='color:#FFD700;font-size:0.97em;'>Assorted cheeses, crackers, fruit</span></span><span style='color:#FFD700;font-weight:700;'>$2500</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:18px 0 8px 0; border-bottom:1px solid #FFD700;'>Desserts</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Chocolate Lava Cake</strong><br><span style='color:#FFD700;font-size:0.97em;'>Warm chocolate cake, vanilla ice cream</span></span><span style='color:#FFD700;font-weight:700;'>$1800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Classic Tiramisu</strong><br><span style='color:#FFD700;font-size:0.97em;'>Espresso, mascarpone, cocoa</span></span><span style='color:#FFD700;font-weight:700;'>$1900</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:24px 0 8px 0; border-bottom:1px solid #FFD700;'>Signature Cocktails</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Classic Martini</strong><br><span style='color:#FFD700;font-size:0.97em;'>Gin, Dry Vermouth, Olive</span></span><span style='color:#FFD700;font-weight:700;'>$4200</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Mojito</strong><br><span style='color:#FFD700;font-size:0.97em;'>White Rum, Mint, Lime, Soda</span></span><span style='color:#FFD700;font-weight:700;'>$3800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Cosmopolitan</strong><br><span style='color:#FFD700;font-size:0.97em;'>Vodka, Cointreau, Cranberry, Lime</span></span><span style='color:#FFD700;font-weight:700;'>$4000</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Margarita</strong><br><span style='color:#FFD700;font-size:0.97em;'>Tequila, Triple Sec, Lime</span></span><span style='color:#FFD700;font-weight:700;'>$4100</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Old Fashioned</strong><br><span style='color:#FFD700;font-size:0.97em;'>Bourbon, Bitters, Sugar, Orange</span></span><span style='color:#FFD700;font-weight:700;'>$4500</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Empire Manhattan</strong><br><span style='color:#FFD700;font-size:0.97em;'>Rye Whiskey, Sweet Vermouth, Luxardo Cherry</span></span><span style='color:#FFD700;font-weight:700;'>$4400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Golden Apple Spritz</strong><br><span style='color:#FFD700;font-size:0.97em;'>Apple Brandy, Prosecco, Gold Leaf</span></span><span style='color:#FFD700;font-weight:700;'>$4800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Park Avenue Negroni</strong><br><span style='color:#FFD700;font-size:0.97em;'>Gin, Campari, Vermouth, Orange Zest</span></span><span style='color:#FFD700;font-weight:700;'>$4300</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Fifth Avenue Fizz</strong><br><span style='color:#FFD700;font-size:0.97em;'>Champagne, Gin, Lemon, Sugar</span></span><span style='color:#FFD700;font-weight:700;'>$4600</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:24px 0 8px 0; border-bottom:1px solid #FFD700;'>Wines</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Chardonnay</strong><br><span style='color:#FFD700;font-size:0.97em;'>White, California</span></span><span style='color:#FFD700;font-weight:700;'>$3800/glass</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Merlot</strong><br><span style='color:#FFD700;font-size:0.97em;'>Red, France</span></span><span style='color:#FFD700;font-weight:700;'>$4200/glass</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Cabernet Sauvignon</strong><br><span style='color:#FFD700;font-size:0.97em;'>Red, Chile</span></span><span style='color:#FFD700;font-weight:700;'>$4800/glass</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Pinot Grigio</strong><br><span style='color:#FFD700;font-size:0.97em;'>White, Italy</span></span><span style='color:#FFD700;font-weight:700;'>$4000/glass</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Château Margaux 2015</strong><br><span style='color:#FFD700;font-size:0.97em;'>Bordeaux, France</span></span><span style='color:#FFD700;font-weight:700;'>$3200/glass  $1200/bottle</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Opus One 2018</strong><br><span style='color:#FFD700;font-size:0.97em;'>Napa Valley, USA</span></span><span style='color:#FFD700;font-weight:700;'>$2950/glass  $1100/bottle</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Dom Pérignon Vintage</strong><br><span style='color:#FFD700;font-size:0.97em;'>Champagne, France</span></span><span style='color:#FFD700;font-weight:700;'>$4200/bottle</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:24px 0 8px 0; border-bottom:1px solid #FFD700;'>Beers</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Lager</strong><br><span style='color:#FFD700;font-size:0.97em;'>Crisp, Refreshing</span></span><span style='color:#FFD700;font-weight:700;'>$1800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>IPA</strong><br><span style='color:#FFD700;font-size:0.97em;'>Hoppy, Bold</span></span><span style='color:#FFD700;font-weight:700;'>$2200</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Stout</strong><br><span style='color:#FFD700;font-size:0.97em;'>Dark, Roasted</span></span><span style='color:#FFD700;font-weight:700;'>$2000</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Trappist Ale</strong><br><span style='color:#FFD700;font-size:0.97em;'>Belgian, Rare</span></span><span style='color:#FFD700;font-weight:700;'>$2800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Imperial Pilsner</strong><br><span style='color:#FFD700;font-size:0.97em;'>German, Limited Edition</span></span><span style='color:#FFD700;font-weight:700;'>$3200</span></div>
      <div style='font-size:1.05rem; color:#FFD700; font-weight:600; margin:24px 0 8px 0; border-bottom:1px solid #FFD700;'>Non-Alcoholic</div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Fresh Juices</strong><br><span style='color:#FFD700;font-size:0.97em;'>Orange, Apple, Pineapple</span></span><span style='color:#FFD700;font-weight:700;'>$1400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Mocktails</strong><br><span style='color:#FFD700;font-size:0.97em;'>Ask for our daily specials</span></span><span style='color:#FFD700;font-weight:700;'>$1800</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Soft Drinks</strong><br><span style='color:#FFD700;font-size:0.97em;'>Cola, Lemonade, Tonic</span></span><span style='color:#FFD700;font-weight:700;'>$1500</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Mineral Water</strong><br><span style='color:#FFD700;font-size:0.97em;'>Still or Sparkling</span></span><span style='color:#FFD700;font-weight:700;'>$1400</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Virgin Bellini</strong><br><span style='color:#FFD700;font-size:0.97em;'>Peach, Sparkling Grape Juice</span></span><span style='color:#FFD700;font-weight:700;'>$1600</span></div>
      <div style='display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:10px;'><span><strong>Luxury Iced Tea</strong><br><span style='color:#FFD700;font-size:0.97em;'>Darjeeling, Lemon, Gold Flakes</span></span><span style='color:#FFD700;font-weight:700;'>$1800</span></div>
    </div>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>All prices are in USD. Please ask our staff for allergen information or special requests.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeBarMenuBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showFitnessClasses() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Fitness Class Schedule</h2>
      <button id='closeFitnessClassesBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Today's Classes</div>
    <div style="margin-bottom: 18px;">
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Sunrise Yoga</strong><br><span style='color:#FFD700;font-size:0.97em;'>6:30 AM – 7:30 AM | Instructor: Olivia Chen</span></span><span style='color:#FFD700;font-weight:700;'>Studio 1</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>HIIT Blast</strong><br><span style='color:#FFD700;font-size:0.97em;'>8:00 AM – 8:45 AM | Instructor: Marcus Lee</span></span><span style='color:#FFD700;font-weight:700;'>Studio 2</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Pilates Fusion</strong><br><span style='color:#FFD700;font-size:0.97em;'>10:00 AM – 11:00 AM | Instructor: Sophia Martinez</span></span><span style='color:#FFD700;font-weight:700;'>Studio 1</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Strength & Conditioning</strong><br><span style='color:#FFD700;font-size:0.97em;'>12:00 PM – 1:00 PM | Instructor: David Kim</span></span><span style='color:#FFD700;font-weight:700;'>Studio 2</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Luxury Spin</strong><br><span style='color:#FFD700;font-size:0.97em;'>2:00 PM – 2:45 PM | Instructor: Emma Rossi</span></span><span style='color:#FFD700;font-weight:700;'>Spin Studio</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Boxing Elite</strong><br><span style='color:#FFD700;font-size:0.97em;'>4:00 PM – 5:00 PM | Instructor: Carlos Rivera</span></span><span style='color:#FFD700;font-weight:700;'>Studio 2</span></div>
      <div style='display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 12px;'><span><strong>Evening Meditation</strong><br><span style='color:#FFD700;font-size:0.97em;'>7:00 PM – 7:45 PM | Instructor: Priya Singh</span></span><span style='color:#FFD700;font-weight:700;'>Studio 1</span></div>
    </div>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>Please book your spot in advance. Private sessions available upon request.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeFitnessClassesBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showPoolSchedule() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Swimming Pool Schedule</h2>
      <button id='closePoolScheduleBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Hours & Special Events</div>
    <div style="margin-bottom: 18px;">
      <div style='margin-bottom: 10px;'><strong>Daily Hours:</strong> <span style='color:#FFD700;'>6:00 AM – 10:00 PM</span></div>
      <div style='margin-bottom: 10px;'><strong>Family Swim:</strong> 10:00 AM – 12:00 PM</div>
      <div style='margin-bottom: 10px;'><strong>Adults Only:</strong> 7:00 PM – 10:00 PM</div>
      <div style='margin-bottom: 10px;'><strong>Poolside Yoga:</strong> Saturdays 8:00 AM – 9:00 AM</div>
      <div style='margin-bottom: 10px;'><strong>Swim-Up Bar:</strong> 4:00 PM – 8:00 PM</div>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Pool Etiquette</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li>Shower before entering the pool</li>
      <li>Swimwear required at all times</li>
      <li>No glassware in pool area</li>
      <li>Children under 12 must be supervised</li>
      <li>Pool towels provided at entrance</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>For private poolside events, please contact concierge.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closePoolScheduleBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showOutdoorActivities() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Outdoor Activities</h2>
      <button id='closeOutdoorActivitiesBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Available Activities</div>
    <div style="margin-bottom: 18px;">
      <div style='margin-bottom: 10px;'><strong>Guided City Tour</strong> <span style='color:#FFD700;'>9:00 AM – 12:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Explore iconic NYC landmarks with a professional guide</span></div>
      <div style='margin-bottom: 10px;'><strong>Central Park Cycling</strong> <span style='color:#FFD700;'>2:00 PM – 4:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Bikes provided, all levels welcome</span></div>
      <div style='margin-bottom: 10px;'><strong>Rooftop Yoga</strong> <span style='color:#FFD700;'>6:30 AM – 7:30 AM</span><br><span style='color:#FFD700;font-size:0.97em;'>Sunrise session with city views</span></div>
      <div style='margin-bottom: 10px;'><strong>Hudson Kayaking</strong> <span style='color:#FFD700;'>11:00 AM – 1:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Guided river adventure, equipment included</span></div>
      <div style='margin-bottom: 10px;'><strong>Outdoor Personal Training</strong> <span style='color:#FFD700;'>By Appointment</span><br><span style='color:#FFD700;font-size:0.97em;'>One-on-one or group sessions in the park</span></div>
      <div style='margin-bottom: 10px;'><strong>Evening Running Club</strong> <span style='color:#FFD700;'>7:00 PM – 8:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Join fellow guests for a scenic city run</span></div>
      <div style='margin-bottom: 10px;'><strong>Helicopter Tour</strong> <span style='color:#FFD700;'>10:00 AM, 2:00 PM, 5:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Aerial views of Manhattan, 30-minute luxury flight</span></div>
      <div style='margin-bottom: 10px;'><strong>Private Yacht Cruise</strong> <span style='color:#FFD700;'>By Reservation</span><br><span style='color:#FFD700;font-size:0.97em;'>Champagne, skyline views, and sunset on the Hudson</span></div>
      <div style='margin-bottom: 10px;'><strong>Gourmet Picnic in the Park</strong> <span style='color:#FFD700;'>12:30 PM – 2:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Curated basket, butler service, and live music</span></div>
      <div style='margin-bottom: 10px;'><strong>Horseback Riding</strong> <span style='color:#FFD700;'>9:00 AM – 11:00 AM</span><br><span style='color:#FFD700;font-size:0.97em;'>Central Park bridle paths, all skill levels</span></div>
      <div style='margin-bottom: 10px;'><strong>Tennis Lessons</strong> <span style='color:#FFD700;'>By Appointment</span><br><span style='color:#FFD700;font-size:0.97em;'>Private or group, professional instructor</span></div>
      <div style='margin-bottom: 10px;'><strong>Exclusive Golf Outing</strong> <span style='color:#FFD700;'>By Reservation</span><br><span style='color:#FFD700;font-size:0.97em;'>Private transfer to top NY golf clubs, caddie included</span></div>
    </div>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>Contact concierge to reserve your spot or request a custom outdoor experience.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeOutdoorActivitiesBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showFamilyActivities() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Family Activities</h2>
      <button id='closeFamilyActivitiesBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Today's Activities</div>
    <div style="margin-bottom: 18px;">
      <div style='margin-bottom: 10px;'><strong>Family Board Games</strong> <span style='color:#FFD700;'>10:00 AM – 11:30 AM</span><br><span style='color:#FFD700;font-size:0.97em;'>Classic and modern games for all ages</span></div>
      <div style='margin-bottom: 10px;'><strong>Arts & Crafts Workshop</strong> <span style='color:#FFD700;'>12:00 PM – 1:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Painting, origami, and creative fun</span></div>
      <div style='margin-bottom: 10px;'><strong>Gourmet Cookie Decorating</strong> <span style='color:#FFD700;'>1:45 PM – 2:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Luxury cookies, chef-led, take home your creations</span></div>
      <div style='margin-bottom: 10px;'><strong>Family Karaoke</strong> <span style='color:#FFD700;'>2:45 PM – 3:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Sing your favorites in our private lounge</span></div>
      <div style='margin-bottom: 10px;'><strong>Family Movie Matinee</strong> <span style='color:#FFD700;'>3:45 PM – 5:15 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Luxury screening room, popcorn included</span></div>
      <div style='margin-bottom: 10px;'><strong>Pool Games</strong> <span style='color:#FFD700;'>5:30 PM – 6:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Fun competitions and prizes at the pool</span></div>
      <div style='margin-bottom: 10px;'><strong>Magic Show</strong> <span style='color:#FFD700;'>6:15 PM – 6:45 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Live performance by a world-class magician</span></div>
      <div style='margin-bottom: 10px;'><strong>Science Fun</strong> <span style='color:#FFD700;'>7:00 PM – 7:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Interactive experiments for curious minds</span></div>
      <div style='margin-bottom: 10px;'><strong>Scavenger Hunt</strong> <span style='color:#FFD700;'>7:45 PM – 8:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Team up for a fun hotel-wide adventure</span></div>
      <div style='margin-bottom: 10px;'><strong>Family Talent Show</strong> <span style='color:#FFD700;'>8:45 PM – 9:30 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Showcase your family's unique talents</span></div>
      <div style='margin-bottom: 10px;'><strong>Evening Storytime</strong> <span style='color:#FFD700;'>9:30 PM – 10:00 PM</span><br><span style='color:#FFD700;font-size:0.97em;'>Hosted by our guest storyteller</span></div>
    </div>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>Please sign up at the Kids Club desk or contact concierge for private family events.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeFamilyActivitiesBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showFamilyAdventure() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Family Adventure Package</h2>
      <button id='closeFamilyAdventureBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Package Highlights</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li>Private family suite with welcome amenities</li>
      <li>Daily breakfast for the whole family</li>
      <li>Guided city adventure tour</li>
      <li>Kids Club access and exclusive activities</li>
      <li>Family movie night with gourmet snacks</li>
      <li>Luxury picnic in Central Park</li>
      <li>Complimentary pool games and prizes</li>
      <li>Late checkout for extra family time</li>
      <li>Private museum tour with expert guide</li>
      <li>Family spa session (massage & wellness for all ages)</li>
      <li>Chef's table dinner with interactive cooking for kids</li>
      <li>Exclusive family photo session with professional photographer</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>Contact concierge to book or customize your adventure.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeFamilyAdventureBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showSeasonalSpecials() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #1a2238;
    padding: 36px 28px 28px 28px;
    border-radius: 18px;
    max-width: 520px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(26,34,56,0.22), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Seasonal Specials</h2>
      <button id='closeSeasonalSpecialsBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; font-size: 1.08rem; color: #FFD700; font-weight: 600; letter-spacing: 0.5px;">Current Exclusive Offers</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li><strong>Spring in the City:</strong> Complimentary spa treatment with every suite booking</li>
      <li><strong>Summer Family Escape:</strong> Kids stay and dine free, poolside movie nights</li>
      <li><strong>Autumn Gourmet Getaway:</strong> Private chef dinner and wine pairing</li>
      <li><strong>Winter Wonderland:</strong> Ice skating passes and hot chocolate bar</li>
      <li><strong>Anniversary Celebration:</strong> Champagne, flowers, and late checkout</li>
      <li><strong>Exclusive Suite Upgrade:</strong> Book a deluxe room, get a complimentary upgrade</li>
      <li><strong>New Year's Gala:</strong> Black-tie event, live orchestra, midnight fireworks</li>
      <li><strong>Valentine's Romance:</strong> Rose petal turndown, couples massage, private dinner</li>
      <li><strong>VIP Shopping Experience:</strong> Personal stylist, private transport, exclusive access to luxury boutiques</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.8;'>Contact concierge for details and availability. Limited time only.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeSeasonalSpecialsBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showRomanceOffer() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #111;
    padding: 36px 28px 28px 28px;
    border-radius: 24px;
    max-width: 480px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(212,175,55,0.18), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
    border: 2.5px solid #FFD700;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Romance in the City</h2>
      <button id='closeRomanceOfferBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;">Offer Highlights</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li>Champagne on arrival in your luxury suite</li>
      <li>Couple's spa treatment and wellness ritual</li>
      <li>Private candlelit dinner overlooking Manhattan skyline</li>
      <li>Rose petal turndown and chocolate amenities</li>
      <li>Late checkout for a relaxed morning</li>
      <li>Personalized concierge for romantic requests</li>
      <li>Private butler service for the evening</li>
      <li>In-room breakfast with skyline views</li>
      <li>Custom floral arrangement and handwritten note</li>
      <li>Luxury car transfer for a night out in NYC</li>
    </ul>
    <div style='margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;'>Tasting Menu Preview</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 0.98rem;'>
      <li>Oysters with Champagne Mignonette</li>
      <li>Truffle Risotto</li>
      <li>Filet Mignon with Foie Gras</li>
      <li>Chocolate Fondant with Gold Leaf</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.85;'>Contact us to reserve your romantic escape.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeRomanceOfferBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showSpaOffer() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #111;
    padding: 36px 28px 28px 28px;
    border-radius: 24px;
    max-width: 480px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(212,175,55,0.18), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
    border: 2.5px solid #FFD700;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Ultimate Spa Retreat</h2>
      <button id='closeSpaOfferBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;">Offer Highlights</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li>Full-day luxury spa access for two</li>
      <li>Signature massages and facials</li>
      <li>Private wellness suite with amenities</li>
      <li>Healthy gourmet lunch and herbal teas</li>
      <li>Personalized wellness consultation</li>
      <li>Access to sauna, steam, and hydrotherapy</li>
      <li>Couple's aromatherapy ritual</li>
      <li>Infinity pool and relaxation lounge access</li>
      <li>Exclusive spa gift set to take home</li>
      <li>Guided meditation or yoga session</li>
    </ul>
    <div style='margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;'>Signature Rituals</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 0.98rem;'>
      <li>Gold Leaf Facial</li>
      <li>Hot Stone Massage</li>
      <li>Detoxifying Seaweed Wrap</li>
      <li>Champagne Bubble Bath</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.85;'>Contact us to reserve your spa retreat.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeSpaOfferBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}

function showGourmetOffer() {
  const modal = document.createElement('div');
  modal.style.cssText = `
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
  `;
  const modalContent = document.createElement('div');
  modalContent.style.cssText = `
    background: #111;
    padding: 36px 28px 28px 28px;
    border-radius: 24px;
    max-width: 480px;
    width: 95%;
    max-height: 85vh;
    overflow-y: auto;
    position: relative;
    box-shadow: 0 8px 32px rgba(212,175,55,0.18), 0 2px 12px rgba(255,215,0,0.13);
    font-family: 'Lato', Arial, sans-serif;
    color: #fff;
    border: 2.5px solid #FFD700;
  `;
  modalContent.innerHTML = `
    <div style='display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px;'>
      <h2 style="color: #FFD700; font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 700; margin: 0; letter-spacing: 1px;">Gourmet Escape</h2>
      <button id='closeGourmetOfferBtn' style='background: none; border: none; font-size: 28px; cursor: pointer; color: #FFD700;'>&times;</button>
    </div>
    <div style="margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;">Offer Highlights</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 1.01rem;'>
      <li>Curated tasting menu by our executive chef</li>
      <li>Wine pairings from our award-winning cellar</li>
      <li>Private chef's table experience</li>
      <li>Exclusive kitchen tour and meet the chef</li>
      <li>Personalized menu for dietary preferences</li>
      <li>Complimentary after-dinner digestif</li>
      <li>Sommelier-led wine tasting</li>
      <li>Table with skyline views</li>
      <li>Live music during dinner</li>
      <li>Luxury car transfer for your evening</li>
    </ul>
    <div style='margin-bottom: 18px; color: #FFD700; font-size: 1.13rem; font-weight: 600;'>Sample Tasting Menu</div>
    <ul style='margin-bottom: 18px; color: #FFD700; padding-left: 18px; font-size: 0.98rem;'>
      <li>Osetra Caviar & Blinis</li>
      <li>Lobster Bisque</li>
      <li>Wagyu Beef with Truffle Jus</li>
      <li>Grand Marnier Soufflé</li>
    </ul>
    <div style='margin-top: 18px; text-align: right; font-size: 0.98rem; color: #FFD700; opacity: 0.85;'>Contact us to reserve your gourmet escape.</div>
  `;
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  document.getElementById('closeGourmetOfferBtn').onclick = function() {
    document.body.removeChild(modal);
  };
  modal.addEventListener('click', function(e) {
    if (e.target === modal) {
      document.body.removeChild(modal);
    }
  });
}