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
  let icon = '';
  if (type === 'success') {
    icon = '<i class="fa fa-check-circle" style="margin-right:10px;color:#d4af37;font-size:1.3em;vertical-align:middle;"></i>';
  } else if (type === 'error') {
    icon = '<i class="fa fa-times-circle" style="margin-right:10px;color:#dc3545;font-size:1.3em;vertical-align:middle;"></i>';
  } else if (type === 'info') {
    icon = '<i class="fa fa-info-circle" style="margin-right:10px;color:#17a2b8;font-size:1.3em;vertical-align:middle;"></i>';
  } else if (type === 'warning') {
    icon = '<i class="fa fa-exclamation-triangle" style="margin-right:10px;color:#ffc107;font-size:1.3em;vertical-align:middle;"></i>';
  }
  notification.innerHTML = `${icon}<span style='vertical-align:middle;'>${message}</span>`;
  notification.style.cssText = `
    position: fixed;
    top: 32px;
    right: 32px;
    padding: 20px 32px;
    border-radius: 18px;
    font-weight: 600;
    font-size: 1.15rem;
    z-index: 10000;
    max-width: 380px;
    min-width: 260px;
    display: flex;
    align-items: center;
    gap: 8px;
    animation: fadeInNotif 0.4s;
    transition: opacity 0.3s, transform 0.3s;
    ${type === 'success' ? `
      background: #111;
      color: #27e02a;
      border: 2.5px solid #d4af37;
      box-shadow: 0 6px 32px rgba(0,0,0,0.18), 0 0 16px 3px #d4af37;
    ` : type === 'error' ? `
      background: linear-gradient(90deg, #dc3545 80%, #d4af37 100%);
      color: #fff;
      border: 2.5px solid #d4af37;
      box-shadow: 0 6px 32px rgba(0,0,0,0.18), 0 0 12px 2px #d4af37;
    ` : type === 'info' ? `
      background: linear-gradient(90deg, #17a2b8 80%, #d4af37 100%);
      color: #fff;
      border: 2.5px solid #d4af37;
      box-shadow: 0 6px 32px rgba(0,0,0,0.18), 0 0 12px 2px #d4af37;
    ` : `
      background: linear-gradient(90deg, #ffc107 80%, #d4af37 100%);
      color: #fff;
      border: 2.5px solid #d4af37;
      box-shadow: 0 6px 32px rgba(0,0,0,0.18), 0 0 12px 2px #d4af37;
    `}
  `;
  const style = document.createElement('style');
  style.textContent = `
    @keyframes fadeInNotif {
      from { opacity: 0; transform: translateY(-20px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .notification { opacity: 1; }
    .notification.fadeOut { opacity: 0; transform: translateY(-20px) scale(0.98); }
  `;
  document.head.appendChild(style);
  document.body.appendChild(notification);
  setTimeout(() => {
    notification.classList.add('fadeOut');
    setTimeout(() => {
      if (notification.parentNode) notification.parentNode.removeChild(notification);
      if (style.parentNode) style.parentNode.removeChild(style);
    }, 350);
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
    // Set flag for home page modal
    localStorage.setItem('justLoggedIn', '1');
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
    // Set flag for home page modal
    localStorage.setItem('justLoggedIn', '1');
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
    const guestAgesContainer = document.getElementById('guestAgesContainer');
    const EXTRA_GUEST_CHARGE_PER_NIGHT = 2500;

    // Helper: Render guest age fields
    function renderGuestAges() {
      const numGuests = parseInt(guestsInput.value, 10) || 1;
      guestAgesContainer.innerHTML = '';
      for (let i = 1; i <= numGuests; i++) {
        const label = document.createElement('label');
        label.textContent = `Age of Guest ${i}`;
        label.setAttribute('for', `guestAge${i}`);
        label.style.fontWeight = '500';
        label.style.fontSize = '0.95rem';
        const input = document.createElement('input');
        input.type = 'number';
        input.min = '0';
        input.max = '120';
        input.required = true;
        input.className = 'booking-input enhanced-input guest-age-input';
        input.id = `guestAge${i}`;
        guestAgesContainer.appendChild(label);
        guestAgesContainer.appendChild(input);
      }
    }

    // Initial render
    renderGuestAges();
    guestsInput.addEventListener('input', function() {
      renderGuestAges();
      calculateTotal();
    });
    guestAgesContainer.addEventListener('input', calculateTotal);

    function calculateTotal() {
      const roomType = roomTypeSelect.value;
      const numberOfRooms = parseInt(roomsInput.value, 10);
      const checkinDate = new Date(checkinInput.value);
      const checkoutDate = new Date(checkoutInput.value);
        const numberOfNights = (checkoutDate - checkinDate) / (1000 * 60 * 60 * 24);
      const guestAgeInputs = guestAgesContainer.querySelectorAll('.guest-age-input');
      const guestAges = Array.from(guestAgeInputs).map(input => parseInt(input.value, 10) || 0);
      const numAdults = guestAges.filter(age => age > 16).length;
      const standardCapacity = numberOfRooms * 2;
      const extraAdults = Math.max(0, numAdults - standardCapacity);
      if (
        roomType &&
        numberOfRooms > 0 &&
        checkinInput.value &&
        checkoutInput.value &&
        checkoutDate > checkinDate &&
        guestAges.length === (parseInt(guestsInput.value, 10) || 1) &&
        guestAges.every(age => !isNaN(age))
      ) {
        const price = roomPrices[roomType];
        const baseAmount = price * numberOfRooms * numberOfNights;
        const extraGuestCharge = extraAdults * EXTRA_GUEST_CHARGE_PER_NIGHT * numberOfNights;
        const total = baseAmount + extraGuestCharge;
        totalAmountInput.value = `$${total.toFixed(2)}`;
        window.currentTotalAmount = total; // <-- Add this line
      } else {
        totalAmountInput.value = '';
      }
    }

    roomTypeSelect.addEventListener('change', calculateTotal);
    roomsInput.addEventListener('input', calculateTotal);
    checkinInput.addEventListener('change', calculateTotal);
    checkoutInput.addEventListener('change', calculateTotal);
  }
});

// ... existing code ...
// After all event listeners for booking form fields:
document.addEventListener('DOMContentLoaded', function() {
  if (typeof calculateTotal === 'function') {
    calculateTotal();
  }
});
// ... existing code ...

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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
      const bookingModal = document.getElementById('bookingModal');
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
}

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
    
    showNotification('Service Booked Successfully! Kindly check my bookings page to review your booking', 'success');
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
  modal.setAttribute('aria-modal', 'true');
  modal.setAttribute('role', 'dialog');
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

// Toast notification function
function showToast(message, color = '#17a2b8') {
  // Remove any existing toast
  const oldToast = document.getElementById('wishlist-toast');
  if (oldToast) oldToast.remove();
  // Create toast
  const toast = document.createElement('div');
  toast.id = 'wishlist-toast';
  toast.textContent = message;
  toast.style.position = 'fixed';
  toast.style.top = '2rem';
  toast.style.left = '50%';
  toast.style.transform = 'translateX(-50%)';
  toast.style.background = color;
  toast.style.color = '#fff';
  toast.style.padding = '1.1rem 2.2rem';
  toast.style.borderRadius = '12px';
  toast.style.fontSize = '1.15rem';
  toast.style.fontWeight = '500';
  toast.style.boxShadow = '0 4px 24px rgba(0,0,0,0.13)';
  toast.style.zIndex = '9999';
  toast.style.transition = 'opacity 0.3s';
  toast.style.opacity = '1';
  document.body.appendChild(toast);
  setTimeout(() => {
    toast.style.opacity = '0';
    setTimeout(() => { toast.remove(); }, 400);
  }, 2000);
}

function toggleWishlist(roomId) {
  const room = roomData.find(r => r.id === roomId);
  if (isRoomInWishlist(roomId)) {
    removeRoomFromWishlist(roomId);
    showToast(`${room ? room.name : 'Room'} removed from wishlist!`, '#17a2b8');
  } else {
    addRoomToWishlist(roomId);
    showToast(`${room ? room.name : 'Room'} added to wishlist!`, '#28a745');
  }
  updateWishlistHearts && updateWishlistHearts();
}

// --- Wishlist Sync Logic ---
// Room data for sync (should match rooms page)
const roomData = [
  {
    id: 'pearl-signature',
    name: 'Pearl Signature Room',
    image: 'images/sophistication-room.png',
    price: 20695,
    description: 'The Pearl Signature Room is the crown jewel of THE PEARL VISTA hotel—our bestseller and most luxurious offering. Enjoy breathtaking views, exquisite interiors, unmatched comfort, and world-class services.'
  },
  {
    id: 'deluxe-room',
    name: 'Deluxe Room',
    image: 'Gallery/deluxe_room1.jpg',
    price: 3240,
    description: 'Perfect for solo travelers or couples seeking comfort and style.'
  },
  {
    id: 'premium-room',
    name: 'Premium Room',
    image: 'images/Premium_room1.png',
    price: 5580,
    description: 'Enhanced comfort with premium amenities and stunning city views.'
  },
  {
    id: 'executive-room',
    name: 'Executive Room',
    image: 'Gallery/Executive_room2.jpg',
    price: 8790,
    description: "Business travelers' choice with work space and executive lounge access."
  },
  {
    id: 'luxury-suite',
    name: 'Luxury Suite',
    image: 'images/Luxury_suite.jpg',
    price: 11920,
    description: 'Ultimate luxury with separate living area and premium amenities.'
  },
  {
    id: 'family-suite',
    name: 'Family Suite',
    image: 'images/Family_suite.jpg',
    price: 14855,
    description: 'Spacious accommodation perfect for families with children.'
  }
];

function getWishlist() {
  return JSON.parse(localStorage.getItem('pv_wishlist') || '[]');
}
function setWishlist(arr) {
  localStorage.setItem('pv_wishlist', JSON.stringify(arr));
}
function isRoomInWishlist(roomId) {
  return getWishlist().includes(roomId);
}
function addRoomToWishlist(roomId) {
  const wishlist = getWishlist();
  if (!wishlist.includes(roomId)) {
    wishlist.push(roomId);
    setWishlist(wishlist);
  }
}
function removeRoomFromWishlist(roomId) {
  const wishlist = getWishlist().filter(id => id !== roomId);
  setWishlist(wishlist);
}
// For rooms page: update heart icons
function updateWishlistHearts() {
  roomData.forEach(room => {
    const heart = document.getElementById(`${room.id}-heart`);
    if (heart) {
      if (isRoomInWishlist(room.id)) {
        heart.classList.add('active');
        heart.style.color = '#ff0000';
  } else {
        heart.classList.remove('active');
        heart.style.color = '';
      }
    }
  });
}
// For wishlist page: render wishlist
function renderWishlistRooms() {
  const wishlist = getWishlist();
  const grid = document.querySelector('.wishlist-grid');
  // Update the Saved Rooms count
  const countSpan = document.getElementById('wishlistRoomCount');
  if (countSpan) countSpan.textContent = wishlist.length;
  // Update Saved Services count (if you have a similar system for services)
  const serviceCountSpan = document.getElementById('wishlistServiceCount');
  if (serviceCountSpan) serviceCountSpan.textContent = 0; // Update if you add service wishlist logic
  // Update Total Items count
  const totalCountSpan = document.getElementById('wishlistTotalCount');
  if (totalCountSpan) totalCountSpan.textContent = wishlist.length + 0; // Add service count if needed
  if (!grid) return;
  grid.innerHTML = '';
  if (!wishlist.length) {
    grid.innerHTML = '<div style="padding:2rem; color:#888; text-align:center; width:100%;">No rooms in your wishlist yet.</div>';
    return;
  }
  wishlist.forEach(roomId => {
    const room = roomData.find(r => r.id === roomId);
    if (!room) return;
    grid.innerHTML += `
      <div class="wishlist-card">
    <div class="wishlist-image">
          <img src="${room.image}" alt="${room.name}">
      <div class="wishlist-overlay">
            <button class="remove-btn" onclick="removeFromWishlist('${room.id}')">
          <i class="fas fa-heart" style="color: #ff0000;"></i>
        </button>
      </div>
    </div>
    <div class="wishlist-content">
          <h3>${room.name}</h3>
      <div class="wishlist-details">
            <span><i class="fas fa-user"></i> ${room.name === 'Family Suite' ? '4 Guests' : room.name === 'Luxury Suite' ? '3 Guests' : '2 Guests'}</span>
            <span><i class="fas fa-bed"></i> ${room.name === 'Family Suite' ? '2 Bedrooms' : 'King Bed'}</span>
        <span><i class="fas fa-wifi"></i> Free WiFi</span>
      </div>
      <div class="wishlist-price">
            <span class="price">$${room.price}</span>
        <span class="per-night">per night</span>
      </div>
          <div style="margin-bottom:0.7rem; color:#444; font-size:0.98rem;">${room.description}</div>
      <div class="wishlist-actions">
            <button class="btn signup" onclick="bookNow('${room.id}')">
          <i class="fas fa-calendar-check" style="color: #000;"></i> Book Now
        </button>
            <button class="btn login" onclick="viewDetails('${room.id}')">
          <i class="fas fa-eye" style="color: #000;"></i> View Details
        </button>
      </div>
      </div>
    </div>
  `;
    });
}
// Remove from wishlist from wishlist page
function removeFromWishlist(roomId) {
  removeRoomFromWishlist(roomId);
  renderWishlistRooms();
  updateWishlistHearts && updateWishlistHearts();
}
// On wishlist page load
if (window.location.pathname.includes('my-wishlist.html')) {
  document.addEventListener('DOMContentLoaded', renderWishlistRooms);
}
// On rooms page load
if (window.location.pathname.includes('rooms.html')) {
  document.addEventListener('DOMContentLoaded', updateWishlistHearts);
}

// --- Service Wishlist Logic ---
function getServiceWishlist() {
  return JSON.parse(localStorage.getItem('pv_service_wishlist') || '[]');
}
function setServiceWishlist(arr) {
  localStorage.setItem('pv_service_wishlist', JSON.stringify(arr));
}
function isServiceInWishlist(serviceId) {
  return getServiceWishlist().includes(serviceId);
}
function addServiceToWishlist(serviceId) {
  const wishlist = getServiceWishlist();
  if (!wishlist.includes(serviceId)) {
    wishlist.push(serviceId);
    setServiceWishlist(wishlist);
  }
}
function removeServiceFromWishlist(serviceId) {
  const wishlist = getServiceWishlist().filter(id => id !== serviceId);
  setServiceWishlist(wishlist);
}
function toggleServiceWishlist(serviceId) {
  const service = getServiceDetails(serviceId);
  if (isServiceInWishlist(serviceId)) {
    removeServiceFromWishlist(serviceId);
    showToast(`${service.name} removed from wishlist!`, '#17a2b8');
  } else {
    addServiceToWishlist(serviceId);
    showToast(`${service.name} added to wishlist!`, '#28a745');
  }
  updateServiceWishlistHearts && updateServiceWishlistHearts();
}
function updateServiceWishlistHearts() {
  const ids = Object.keys(getServiceDetails(''));
  [
    'dining','spa','leisure','events','concierge','kids','packages','pet-services'
  ].forEach(serviceId => {
    const heart = document.getElementById(`${serviceId}-heart`);
    if (heart) {
      if (isServiceInWishlist(serviceId)) {
        heart.classList.add('active');
        heart.style.color = '#ff0000';
  } else {
        heart.classList.remove('active');
        heart.style.color = '#ccc';
      }
    }
  });
}
function renderWishlistServices() {
  const wishlist = getServiceWishlist();
  const grid = document.querySelector('.services-wishlist-grid');
  const countSpan = document.getElementById('wishlistServiceCount');
  if (countSpan) countSpan.textContent = wishlist.length;
  const totalCountSpan = document.getElementById('wishlistTotalCount');
  if (totalCountSpan) totalCountSpan.textContent = (parseInt(document.getElementById('wishlistRoomCount')?.textContent || '0') + wishlist.length);
  if (!grid) return;
  grid.innerHTML = '';
  if (!wishlist.length) {
    grid.innerHTML = '<div style="padding:2rem; color:#888; text-align:center; width:100%;">No services in your wishlist yet.</div>';
    return;
  }
  wishlist.forEach(serviceId => {
    const service = getServiceDetails(serviceId);
    grid.innerHTML += `
      <div class="service-wishlist-card">
    <div class="service-wishlist-image">
          <img src="images/${service.image}" alt="${service.name}">
      <div class="wishlist-overlay">
            <button class="remove-btn" onclick="toggleServiceWishlist('${serviceId}')">
          <i class="fas fa-heart" style="color: #ff0000;"></i>
        </button>
      </div>
    </div>
    <div class="service-wishlist-content">
          <h3>${service.name}</h3>
          <p>${service.description}</p>
      <div class="service-wishlist-features">
            <span><i class="fas fa-info-circle"></i> ${service.features}</span>
            <span><i class="fas fa-clock"></i> ${service.duration}</span>
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
        </div>
      `;
    });
}
// On services page load
if (window.location.pathname.includes('services.html')) {
  document.addEventListener('DOMContentLoaded', updateServiceWishlistHearts);
}
// On wishlist page load
if (window.location.pathname.includes('my-wishlist.html')) {
  document.addEventListener('DOMContentLoaded', renderWishlistServices);
}

// --- Check Availability Modal Logic ---
document.addEventListener('DOMContentLoaded', function() {
  if (window.location.pathname.endsWith('home.html')) {
    // Check for justLoggedIn or justSignedUp flag
    var justLoggedIn = localStorage.getItem('justLoggedIn') === '1' || sessionStorage.getItem('justLoggedIn') === '1';
    if (justLoggedIn) {
      var modal = document.getElementById('checkAvailabilityModal');
      if (modal) {
        modal.style.display = 'flex';
        // Clear the flag so it doesn't show again
        localStorage.removeItem('justLoggedIn');
        sessionStorage.removeItem('justLoggedIn');
      }
    }
    // Modal button logic
    var openBtn = document.getElementById('openAvailabilityFormBtn');
    var denyBtn = document.getElementById('denyAvailabilityBtn');
    var formModal = document.getElementById('availabilityFormModal');
    var closeFormBtn = document.getElementById('closeAvailabilityFormBtn');
    var checkModal = document.getElementById('checkAvailabilityModal');
    if (openBtn && formModal && checkModal) {
      openBtn.onclick = function() {
        checkModal.style.display = 'none';
        formModal.style.display = 'flex';
      };
    }
    if (denyBtn && checkModal) {
      denyBtn.onclick = function() {
        checkModal.style.display = 'none';
      };
    }
    if (closeFormBtn && formModal) {
      closeFormBtn.onclick = function() {
        formModal.style.display = 'none';
      };
    }
    // Form submit logic
    var availForm = document.getElementById('availabilityForm');
    if (availForm) {
      availForm.onsubmit = function(e) {
        e.preventDefault();
        var checkin = document.getElementById('checkinDate').value;
        var checkout = document.getElementById('checkoutDate').value;
        var guests = parseInt(document.getElementById('guests').value, 10);
        var roomType = document.getElementById('roomType').value;
        var numRooms = parseInt(document.getElementById('numRooms').value, 10);
        // Simple logic: available if <=5 rooms and guests <=10
        var available = (numRooms <= 5 && guests <= 10);
        formModal.style.display = 'none';
        if (available) {
          showNotification('Your preferred room is available! You can proceed to book.', 'success');
        } else {
          showNotification('Sorry, the preferred room is not available for the selected criteria.', 'error');
        }
      };
    }
    // Close modal when clicking outside
    [document.getElementById('checkAvailabilityModal'), document.getElementById('availabilityFormModal')].forEach(function(modal) {
      if (modal) {
        modal.addEventListener('click', function(e) {
          if (e.target === modal) modal.style.display = 'none';
        });
      }
    });
  }
});
// ... existing code ...