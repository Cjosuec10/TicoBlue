<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>@yield('title', 'Administración - Tico Blue')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1XsbG/b6y/z+3+5" crossorigin="anonymous">

<!-- Bootstrap JS (requerido para el modal) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12WXT6Bf6wr7mZgftIURF1rRXuozcuOzj6STZ1QnQsEJQG4g" crossorigin="anonymous"></script>

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

  @yield('css') <!-- Aquí puedes incluir CSS extra en las vistas específicas -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" alt="" style="width: 90px; height: auto;">
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
    <div class="flags" id="flags">
  <div class="flags__item" data-language="es" onclick="selectLanguage(this)">
    <img src="/assets/icons/cr.svg" alt="Español">
  </div>
  <div class="flags__item" data-language="en" onclick="selectLanguage(this)">
    <img src="/assets/icons/us.svg" alt="English">
  </div>
</div>

<?php
    // Contar las notificaciones no leídas
    $unreadNotificationsCount = \App\Models\Notification::where('is_read', false)->count();
?>
<div>

    <a href="{{ route('notifications.index') }}" class="nav-link">
        Notificaciones <span class="badge badge-pill badge-danger">{{ $unreadNotificationsCount }}</span>
    </a>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">







    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

        
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"></span>
            
          </a><!-- End Profile Image Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <hr class="dropdown-divider">
            </li>
            

            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ url('users-profile') }}">
                <i class="bi bi-person"></i>
                <span data-translate="profile">Perfil</span> <!-- Marcado para traducción -->
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>


            <li>
              <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i>
                <span data-translate="logout">Cerrar Sesión</span> <!-- Marcado para traducción -->
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->
      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="/admin">
        <i class="bi bi-grid"></i>
        <span data-translate="menu">Menu</span> <!-- Marcado para traducción -->
      </a>
    </li><!-- End Dashboard Nav -->

    @can('ver-comercio')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/comercios">
          <i class="bi bi-shop"></i><span data-translate="commerceModule">Módulo de Comercios</span> <!-- Usé un ícono de tienda -->
      </a>
    </li><!-- End Módulo de Comercios Nav -->
    @endcan

    @can('ver-producto')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/productos">
        <i class="bi bi-box-seam"></i><span data-translate="productModule">Módulo de Productos</span> <!-- Usé un ícono de caja -->
      </a>
    </li><!-- End Módulo de Productos Nav -->
    @endcan

    @can('ver-evento')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/eventos">
          <i class="bi bi-calendar-event"></i><span data-translate="eventModule">Módulo de Eventos</span> <!-- Usé un ícono de evento -->
      </a>
    </li><!-- End Módulo de Eventos Nav -->
    @endcan

    @can('ver-alojamiento')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/alojamiento">
        <i class="bi bi-house-door"></i><span data-translate="accommodation">Módulo de Alojamiento</span> <!-- Usé un ícono de casa -->
      </a>
    </li><!-- End Módulo de Alojamiento Nav -->
    @endcan

    @can('ver-reservacion')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/reservaciones">
        <i class="bi bi-bookmark-check"></i><span data-translate="reserves">Módulo de Reservas</span> <!-- Usé un ícono de reserva/marcador -->
      </a>
    </li><!-- End Módulo de Reservas Nav -->
    @endcan

    @can('ver-imagen')
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-image"></i><span data-translate="images">Imagenes(pendiente)</span><i class="bi bi-chevron-down ms-auto"></i> <!-- Usé un ícono de imagen -->
      </a>
    </li><!-- End Módulo de Imágenes Nav -->
    @endcan

    @can('ver-usuario')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/usuarios">
        <i class="bi bi-person"></i><span data-translate="userModule">Módulo de Usuarios</span> <!-- Usé un ícono de persona -->
      </a>
    </li><!-- End Módulo de Usuarios Nav -->
    @endcan

    @can('ver-rol')
    <li class="nav-item">
      <a class="nav-link collapsed" href="/roles">
        <i class="bi bi-shield-lock"></i><span data-translate="roles">Módulo de Roles</span> <!-- Usé un ícono de escudo para roles/permisos -->
      </a>
    </li><!-- End Módulo de Roles Nav -->
    @endcan

  </ul>
  @yield('sidebar') <!-- Aquí se puede personalizar el sidebar en cada vista -->
</aside><!-- End Sidebar-->

  <main id="main" class="main">
    <section class="section dashboard">
      <div class="row">
        @yield('content') <!-- Aquí va el contenido principal de cada vista -->
      </div>
    </section>
  </main><!-- End Main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span data-translate="footer">Tico Blue</span></strong>. <span data-translate="all_rights_reserved">Todos los derechos reservados.</span> <!-- Marcado para traducción -->
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <script src="{{ asset('assets/js/Idioma.js') }}"></script>

  @yield('scripts') 

</body>

</html>
