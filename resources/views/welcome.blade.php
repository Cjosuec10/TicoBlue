@extends('layout.inicio')

@section('title', 'Inicio')

@section('content')
<main class="main">

 <!-- Header Section -->
<section class="header-body header-section d-flex align-items-center" style="height: 100vh;">
    <div class="overlay"></div>
    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in">
            <div class="col-12 col-md-9 text-center">
                <div class="content-box">
                    <h1>BIENVENIDO A TICOBLUE</h1>
                    <p class="subtitle">
                        Descubre la esencia de TicoBlue, una aplicación<br> 
                        donde podrás encontrar todo lo que necesitas 
                        para disfrutar de la Zona Azul de la Península de Nicoya.
                    </p>
                    <div class="button-group mt-3">
                        <a href="/Contacto" class="btn btn-primary me-2">Contacto</a>
                        <a href="Sobre-nosotros" class="btn btn-info">Sobre nosotros</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Contenedor con fondo blanco -->
<section class="bg-white py-3 py-5 text-center text-md-start">
  <h2 class="display-6 fw-bold mb-4 mb-md-5 text-center"data-aos="fade-down">Descubre la Esencia de la Zona Azul</h2>

  <!-- Espacio para la primera imagen -->
  <div class="container mb-3 mb-md-4" data-aos="fade-up-right">
    <div class="row justify-content-center align-items-center">
      <div class="col-10 col-md-6 mb-3 mb-md-0">
        <img src="assets/img/montanias.jpg" alt="Imagen 1" class="img-fluid rounded mx-auto d-block">
      </div>
      <div class="col-12 col-md-6">
        <h3 class="fw-bold mt-3 mt-md-0">BELLEZA NATURAL</h3>
        <p class="descripcion-imagen">
          Nicoya ofrece un entorno natural único, con playas de arena blanca, reservas biológicas y parques nacionales como Barra Honda y Palo Verde, que destacan por su biodiversidad y belleza escénica.
        </p>
      </div>
    </div>
  </div>

  <!-- segunda imágenen -->
  <div class="container mb-3 mb-md-4">
    <div class="row justify-content-center align-items-center" data-aos="fade-up-left">
      <div class="col-10 col-md-6 mb-3 mb-md-0 order-md-2">
        <img src="assets/img/Nicoya.jpg" alt="Imagen 2" class="img-fluid rounded mx-auto d-block">
      </div>
      <div class="col-12 col-md-6 order-md-1">
        <h3 class="fw-bold mt-3 mt-md-0">DESTINO TURÍSTICO DE BIENESTAR</h3>
        <p class="descripcion-imagen">
          Nicoya no solo es famosa por su longevidad, sino también por sus aventuras y experiencias culturales...
        </p>
      </div>
    </div>
  </div>

 <!-- tercera imágenen -->
  <div class="container mb-3 mb-md-4">
    <div class="row justify-content-center align-items-center"  data-aos="fade-up-right">
      <div class="col-10 col-md-6 mb-3 mb-md-0">
        <img src="assets/img/adultomayor.jpg" alt="Imagen 3" class="img-fluid rounded mx-auto d-block">
      </div>
      <div class="col-12 col-md-6">
        <h3 class="fw-bold mt-3 mt-md-0">LONGEVIDAD EXCEPCIONAL</h3>
        <p class="descripcion-imagen">
          La península de Nicoya en Costa Rica es una de las cinco Zonas Azules del mundo, regiones reconocidas por albergar a una gran cantidad de personas que superan los 100 años de edad...
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section id="services" class="services section bg-light py-5">
  <div class="section-title text-center mt-5 mb-4" data-aos="fade-down">
    <h2 class="display-6 fw-bold">EXPLORA LA ZONA AZUL</h2>
    <p class="lead text-secondary">Encuentra servicios locales y oportunidades en la Península de Nicoya</p>
  </div>
  
  <div class="content">
    <div class="container" data-aos="zoom-in-up">
      <div class="row g-4">
        
        <!-- Service Item -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
            
              <h3 class="mt-3">Comercios locales</h3>
              <p class="card-text">
                Explora los mercados locales y apoya a los emprendedores de la Zona Azul de la Península de Nicoya.
              </p>
            </div>
          </div>
        </div>

        <!-- Service Item -->
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
              
              <h3 class="mt-3">Ubicaciones</h3>
              <p class="card-text">
                Encuentra fácilmente las ubicaciones de los mejores lugares en la Zona Azul de la Península Nicoya, y utiliza nuestra plataforma para guiarte en tu recorrido.
              </p>
            </div>
          </div>
        </div>
        
        <!-- Continúa con los otros cuadros en el mismo formato -->
        
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
              
              <h3 class="mt-3">Productos locales</h3>
              <p class="card-text">
                Descubre productos de la zona vendidos por los talentosos artesanos locales en la Península de Nicoya.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
             
              <h3 class="mt-3">Alojamientos</h3>
              <p class="card-text">
                Encuentra cómodos alojamientos en una de las Zonas Azules del planeta y disfruta de una estancia inolvidable en un entorno único.
              </p>
            </div>
          </div>
        </div>

        <!-- Repetir el mismo formato para los demás servicios -->
        
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
          
              <h3 class="mt-3">Reservaciones</h3>
              <p class="card-text">
                Permite a los usuarios hacer reservaciones en los alojamientos y restaurantes locales directamente desde la plataforma.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
           
              <h3 class="mt-3">Contacto</h3>
              <p class="card-text">
                Facilita el contacto directo con comercios locales para consultas y compras personalizadas.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
              
              <h3 class="mt-3">Eventos locales</h3>
              <p class="card-text">
                Encuentra información actualizada sobre actividades de la región para disfrutar de experiencias auténticas.
              </p>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
          <div class="card shadow-sm border-0 h-100">
            <div class="card-body text-center">
              <h3 class="mt-3">Emprendedores</h3>
              <p class="card-text">
                Los emprendedores locales pueden ofrecer sus productos, servicios y alojamiento a través de nuestra plataforma.
              </p>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<style>
    /* Efecto de hover en cards */
    .card {
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card:hover {
      transform: translateY(-10px); /* Movimiento hacia arriba */
      box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
    }
  </style>

</main>
@endsection