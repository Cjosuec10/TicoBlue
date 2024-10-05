// Idioma.js
const translations = {
    es: {
      menu: "Menú",
      commerceModule: "Módulo de comercios",
      productModule: "Módulo de productos",
      eventModule: "Módulo de Eventos",
      accommodation: "Alojamiento",
      reserves: "Reservas(pendiente)",
      images: "Imagenes(pendiente)",
      userModule: "Módulo de Usuarios",
      roles: "Roles(pendiente)",
      profile: "Perfil",
      logout: "Cerrar Sesión",
      copyright: "Todos los derechos reservados."
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
      roles: "Roles (pending)",
      profile: "Profile",
      logout: "Logout",
      copyright: "All rights reserved."
    }
  };
  
  // Función para cambiar el idioma
  function changeLanguage(language) {
    const elements = document.querySelectorAll("[data-translate]");
    elements.forEach(element => {
      const key = element.getAttribute("data-translate");
      if (translations[language][key]) {
        element.innerText = translations[language][key];
      }
    });
  }
  
  // Eventos para los botones de cambio de idioma
  document.querySelectorAll('.flags__item').forEach(flag => {
    flag.addEventListener('click', () => {
      const language = flag.getAttribute('data-language');
      changeLanguage(language);
    });
  });
  function selectLanguage(selected) {
    // Quitar la clase 'selected' de todos los elementos
    const flags = document.querySelectorAll('.flags__item');
    flags.forEach(flag => {
      flag.classList.remove('selected');
    });
  
    // Agregar la clase 'selected' al elemento seleccionado
    selected.classList.add('selected');
  }