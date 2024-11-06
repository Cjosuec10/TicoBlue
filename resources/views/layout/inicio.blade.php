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

<!-- animacion pantallas -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">


  <!-- Main CSS File -->
  <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
  

  @stack('css') <!-- Para incluir CSS adicional específico de la vista -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid position-relative d-flex align-items-center justify-content-between">
      <a href="/" class="logo d-flex align-items-center">
      <img src="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" alt="" style="width: 100px; height: auto;">
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

  <footer class="text-center text-lg-start text-white" style="background-color: #0159AA;">
    <!-- Grid container -->
    <div class="container p-4 footer-text-white">
      <!-- Grid row -->
      <div class="row my-4">
        
        <!-- Logo y Contacto -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <div class="rounded-circle bg-white shadow-1-strong d-flex align-items-center justify-content-center mb-4 mx-auto" style="width: 150px; height: 150px;">
            <img src="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" height="70" alt="Logo TICOBLUE" loading="lazy" />
          </div>
          <p class="text-center footer-text-white">Nicoya, Costa Rica, Guanacaste</p>
          <p class="text-center footer-text-white"><strong>Phone:</strong> +1 5589 55488 55</p>
          <p class="text-center footer-text-white"><strong>Email:</strong> info@ticoblue.com</p>

          <ul class="list-unstyled d-flex flex-row justify-content-center mt-3">
            <li><a class="text-white px-2" href="#"><i class="bi bi-facebook"></i></a></li>
            <li><a class="text-white px-2" href="#"><i class="bi bi-instagram"></i></a></li>
            <li><a class="text-white px-2" href="#"><i class="bi bi-twitter"></i></a></li>
            <li><a class="text-white px-2" href="#"><i class="bi bi-linkedin"></i></a></li>
          </ul>
        </div>
        
        <!-- Enlaces Útiles -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <br>
          <h5 class="text-uppercase mb-4 footer-text-white">Enlaces útiles</h5>
          <br><br>
          <ul class="list-unstyled">
            <li class="mb-2"><a href="/" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Inicio</a></li>
            <li class="mb-2"><a href="/Comercios" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Comercios</a></li>
            <li class="mb-2"><a href="/Eventos" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Eventos</a></li>
            <li class="mb-2"><a href="/Productos" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Productos</a></li>
            <li class="mb-2"><a href="/Alojamientos" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Alojamientos</a></li>
            <li class="mb-2"><a href="{{ route('home') }}#services" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Servicios</a></li>
          </ul>
        </div>

        <!-- Información Adicional -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase mb-4">  <br><br><br><br></h5>
          <ul class="list-unstyled">
          <li class="mb-2"><a href="/Sobre-nosotros" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Sobre Nosotros</a></li>
            <li class="mb-2"><a href="{{ route('sobre-nosotros') }}#mision" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Misión</a></li>
            <li class="mb-2"><a href="{{ route('sobre-nosotros') }}#mision" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Visión</a></li>
            <li class="mb-2"><a href="{{ route('sobre-nosotros') }}#valores" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Valores</a></li>
            <li class="mb-2"><a href="/Contacto" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Contacto</a></li>
            <li class="mb-2"><a href="{{ route('login') }}" class="text-white"><i class="bi bi-chevron-right pe-2"></i>Login</a></li>
          </ul>
        </div>

        <!-- Dirección y Horarios -->
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0 footer-text-white">
        <br>
          <h5 class="text-uppercase mb-4 footer-text-white">Dirección y Horarios</h5>
          <br>
          <ul class="list-unstyled footer-text-white">
            <li><p class="footer-text-white"><i class="bi bi-geo-alt-fill pe-2 footer-text-white"></i>Nicoya, Guanacaste, Costa Rica</p></li><br>
            <li><p class="footer-text-white"><i class="bi bi-clock-fill pe-2 footer-text-white"></i>Lunes - Viernes: 8:00 am - 5:00 pm</p></li><br>
            <li><p class="footer-text-white"><i class="bi bi-envelope-fill pe-2 mb-0 footer-text-white"></i>info@ticoblue.com</p></li>
          </ul>
        </div>
      </div>
      <!-- Grid row -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3 footer-text-white"  style="background-color: #01489C">
      © 2024 Copyright:
      <a class="text-white" href="#">TICOBLUE</a>. Todos los derechos reservados.
    </div>
    <!-- Copyright -->
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

 <!-- animacion pantallas-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script>
    // Inicializar AOS por primera vez
    AOS.init({
        duration: 1000,
        once: false,
        mirror: true
    });

    // Detectar el scroll para reinicializar AOS
    let scrollTimeout;

    window.addEventListener('scroll', function () {
        // Reinicializar AOS si el usuario está en la parte superior de la página
        if (window.scrollY === 0) {
            clearTimeout(scrollTimeout);

            // Retrasar un poco para evitar múltiples reinicios
            scrollTimeout = setTimeout(() => {
                AOS.refresh();  // Reinicia AOS para que las animaciones se vuelvan a activar
            }, 200); 
        }
    });
</script>


  <!-- Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  @stack('scripts') <!-- Para incluir scripts adicionales en cada vista -->
</body>

</html>
