const translations = {
  es: {
    menu: "Menú",
    commerceModule: "Módulo de comercios",
    productModule: "Módulo de productos",
    eventModule: "Módulo de Eventos",
    accommodation: "Alojamiento",
    reserves: "Reservas(pendiente)",
    images: "Imágenes(pendiente)",
    userModule: "Módulo de Usuarios",
    roles: "Roles(pendiente)",
    profile: "Perfil",
    logout: "Cerrar Sesión",
    copyright: "Todos los derechos reservados.",
    // Comercio
    login_and_registration: "Login y Registro",
    accommodations: "Alojamientos",
    user: "Usuario",
    products: "Productos",
    user_management: "Gestión y perfil de usuario."
  },
  en: {
    menu: "Menu",
    commerceModule: "Commerce module",
    productModule: "Product module",
    eventModule: "Event module",
    accommodation: "Accommodation",
    reserves: "Reservations (pending)",
    images: "Images (pending)",
    userModule: "User module",
    roles: "Roles(pending)",
    profile: "Profile",
    logout: "Logout",
    copyright: "All rights reserved.",
    // Main page
    page_title: "My Page",
    login_and_registration: "Login and Registration",
    accommodations: "Accommodations",
    products: "Products",
    user_management: "User management and profile."
  }
};

// Función para cambiar el idioma en la página principal y simbolo moneda 
function switchLanguage(language) {
  const elements = document.querySelectorAll("[data-translate]");
  elements.forEach(element => {
    const key = element.getAttribute("data-translate");
    if (translations[language][key]) {
      element.innerText = translations[language][key];
    }
  });

// Actualizar el símbolo de moneda
const currencySymbol = language === 'es' ? '₡' : '$';
const currencyElement = document.getElementById("currency-symbol");
if (currencyElement) {
  currencyElement.textContent = currencySymbol;
}
}



// Eventos para los botones de cambio de idioma
document.querySelectorAll('.flags__item').forEach(flag => {
  flag.addEventListener('click', () => {
    const language = flag.getAttribute('data-language');
    switchLanguage(language);
    selectLanguageFlag(flag);  // Seleccionar la bandera actual
  });
});

// Actualiza la selección de la bandera
function selectLanguageFlag(selected) {
  const flags = document.querySelectorAll('.flags__item');
  flags.forEach(flag => flag.classList.remove('selected'));
  selected.classList.add('selected');
}

// Traducción en la página de comercios
const commerceTranslations = {
  en: {
    title: "List of Businesses",
    createButton: "Create",
    thId: "ID",
    thName: "Name",
    thBusinessType: "Business Type",
    thPhone: "Phone",
    thImage: "Image",
    thAddressText: "Address Text",
    thActions: "Actions",
    imgNotAvailable: "Not available",
    viewText: "View",
    editText: "Edit",
    deleteText: "Delete"
  },
  es: {
    title: "Lista de Comercios",
    createButton: "Crear",
    thId: "ID",
    thName: "Nombre",
    thBusinessType: "Tipo de Negocio",
    thPhone: "Teléfono",
    thImage: "Imagen",
    thAddressText: "Dirección Texto",
    thActions: "Acciones",
    imgNotAvailable: "No disponible",
    viewText: "Ver",
    editText: "Editar",
    deleteText: "Eliminar"
  }
};

// Función para cambiar idioma en la página de comercios
function switchCommerceLanguage(lang) {
  const translations = commerceTranslations[lang];
  document.getElementById("title").innerText = translations.title;
  document.getElementById("createButton").innerText = translations.createButton;
  document.getElementById("th-id").innerText = translations.thId;
  document.getElementById("th-name").innerText = translations.thName;
  document.getElementById("th-business-type").innerText = translations.thBusinessType;
  document.getElementById("th-phone").innerText = translations.thPhone;
  document.getElementById("th-image").innerText = translations.thImage;
  document.getElementById("th-address-text").innerText = translations.thAddressText;
  document.getElementById("th-actions").innerText = translations.thActions;

  document.querySelectorAll(".img-not-available").forEach(el => {
    el.innerText = translations.imgNotAvailable;
  });

  document.querySelectorAll(".view-text").forEach(el => {
    el.innerText = translations.viewText;
  });

  document.querySelectorAll(".edit-text").forEach(el => {
    el.innerText = translations.editText;
  });

  document.querySelectorAll(".delete-text").forEach(el => {
    el.innerText = translations.deleteText;
  });
}


// Idioma.js
document.addEventListener("DOMContentLoaded", function () {
  const language = localStorage.getItem('language') || 'es'; // Idioma predeterminado: español
  changeLanguage(language);
});

function selectLanguage(lang) {
  localStorage.setItem('language', lang);
  changeLanguage(lang);
}

function changeLanguage(lang) {
  const translations = {
      es: {
          title: "Lista de Comercios",
          createButton: "Crear",
          thId: "ID",
          thName: "Nombre",
          thBusinessType: "Tipo de Negocio",
          thPhone: "Teléfono",
          thImage: "Imagen",
          thAddressText: "Dirección Texto",
          thActions: "Acciones",
          imgNotAvailable: "No disponible",
          viewText: "Ver",
          editText: "Editar",
          deleteText: "Eliminar"
      },
      en: {
          title: "Business List",
          createButton: "Create",
          thId: "ID",
          thName: "Name",
          thBusinessType: "Business Type",
          thPhone: "Phone",
          thImage: "Image",
          thAddressText: "Address",
          thActions: "Actions",
          imgNotAvailable: "Not available",
          viewText: "View",
          editText: "Edit",
          deleteText: "Delete"
      }
  };

  const elements = {
      title: document.getElementById("title"),
      createButton: document.getElementById("createButton"),
      thId: document.getElementById("th-id"),
      thName: document.getElementById("th-name"),
      thBusinessType: document.getElementById("th-business-type"),
      thPhone: document.getElementById("th-phone"),
      thImage: document.getElementById("th-image"),
      thAddressText: document.getElementById("th-address-text"),
      thActions: document.getElementById("th-actions"),
      imgNotAvailable: document.getElementById("img-not-available"),
      viewText: document.querySelector(".view-text"),
      editText: document.querySelector(".edit-text"),
      deleteText: document.querySelector(".delete-text")
  };

  elements.title.textContent = translations[lang].title;
  elements.createButton.textContent = translations[lang].createButton;
  elements.thId.textContent = translations[lang].thId;
  elements.thName.textContent = translations[lang].thName;
  elements.thBusinessType.textContent = translations[lang].thBusinessType;
  elements.thPhone.textContent = translations[lang].thPhone;
  elements.thImage.textContent = translations[lang].thImage;
  elements.thAddressText.textContent = translations[lang].thAddressText;
  elements.thActions.textContent = translations[lang].thActions;

  if (elements.imgNotAvailable) {
      elements.imgNotAvailable.textContent = translations[lang].imgNotAvailable;
  }

  elements.viewText.textContent = translations[lang].viewText;
  elements.editText.textContent = translations[lang].editText;
  elements.deleteText.textContent = translations[lang].deleteText;



// Función para seleccionar el idioma

}


