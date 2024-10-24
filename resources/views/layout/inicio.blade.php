<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'Tico Blue')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

  @stack('css') <!-- Para incluir CSS adicional específico de la vista -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="/" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/img/logo.png') }}" alt="AgriCulture">
      </a>

    <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Inicio</a></li>
          <li><a href="/Comercios" class="{{ request()->is('comercios') ? 'active' : '' }}">Comercios</a></li>
          <li><a href="/Eventos" class="{{ request()->is('eventos') ? 'active' : '' }}">Eventos</a></li>
          <li><a href="/Productos" class="{{ request()->is('productos') ? 'active' : '' }}">Productos</a></li>
          <li><a href="/Alojamientos" class="{{ request()->is('alojamientos') ? 'active' : '' }}">Alojamientos</a></li>
          <li><a href="/Sobre-nosotros" class="{{ request()->is('sobre-nosotros') ? 'active' : '' }}">Sobre Nosotros</a></li>
          <li><a href="/Contacto" class="{{ request()->is('contacto') ? 'active' : '' }}">Contacto</a></li>
          
          <!-- Verificar si el usuario tiene uno o varios de los permisos -->
            @canany(['ver-rol', 'ver-usuario', 'ver-alojamiento', 'ver-comercio', 'ver-evento', 'ver-producto', 'ver-reservacion', 'ver-imagen'])
              <li class="dropdown">
                  <a href="/admin"><span>Admin</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                  <ul>
                      <!-- Mostrar opciones solo si el usuario tiene el permiso adecuado -->
                      @can('ver-rol')
                          <li><a href="{{ route('roles.index') }}">Gestionar Roles</a></li>
                      @endcan
                      @can('ver-usuario')
                          <li><a href="{{ route('usuarios.index') }}">Gestionar Usuarios</a></li>
                      @endcan
                      @can('ver-alojamiento')
                          <li><a href="{{ route('alojamiento.index') }}">Gestionar Alojamientos</a></li>
                      @endcan
                      @can('ver-comercio')
                          <li><a href="{{ route('comercios.index') }}">Gestionar Comercios</a></li>
                      @endcan
                      @can('ver-evento')
                          <li><a href="{{ route('eventos.index') }}">Gestionar Eventos</a></li>
                      @endcan
                      @can('ver-producto')
                          <li><a href="{{ route('productos.index') }}">Gestionar Productos</a></li>
                      @endcan
                      @can('ver-reservacion')
                          <li><a href="{{ route('reservaciones.index') }}">Gestionar Reservaciones</a></li>
                      @endcan
                     
                  </ul>
              </li>
          @endcanany
            <!-- Dropdown con opciones de autenticación -->
            <li class="dropdown">
                <a href="#"><span>Cuenta</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                    <!-- Mostrar opciones de autenticación cuando el usuario no está autenticado -->
                    @guest
                        <li><a href="{{ route('login') }}" class="{{ request()->is('login') ? 'active' : '' }}">Login</a></li>
                        <li><a href="{{ route('register.form') }}" class="{{ request()->is('register') ? 'active' : '' }}">Register</a></li>
                    @endguest

                    <!-- Mostrar opción de logout cuando el usuario está autenticado -->
                    @auth
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>
                        <!-- Formulario oculto para logout -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endauth
                </ul>
            </li>
            </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
  </header>

  <main class="main">
    @yield('content') <!-- Sección donde se incluirá el contenido de cada vista -->
  </main>

  <footer id="footer" class="footer dark-background">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="/" class="logo d-flex align-items-center">
              <span class="sitename">AgriCulture</span>
            </a>
            <div class="footer-contact pt-3">
              <p>A108 Adam Street</p>
              <p>New York, NY 535022</p>
              <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
              <p><strong>Email:</strong> <span>info@example.com</span></p>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Enlaces útiles</h4>
            <ul>
              <li><a href="/">Inicio</a></li>
              <li><a href="/sobre-nosotros">Sobre Nosotros</a></li>
              <li><a href="/productos">Productos</a></li>
              <li><a href="#">Términos de servicio</a></li>
              <li><a href="#">Política de privacidad</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="copyright text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div>
            © Copyright <strong><span>AgriCulture</span></strong>. Todos los derechos reservados
          </div>
          <div class="credits">
            Diseñado por <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href="#"><i class="bi bi-twitter"></i></a>
          <a href="#"><i class="bi bi-facebook"></i></a>
          <a href="#"><i class="bi bi-instagram"></i></a>
          <a href="#"><i class="bi bi-linkedin"></i></a>
        </div>

      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @stack('scripts') <!-- Para incluir scripts adicionales en cada vista -->
</body>

</html>
