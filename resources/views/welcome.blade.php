@extends('layout.inicio')

@section('title', 'Inicio')

@section('content')
<main class="main">

<div class="container-fluid text-container">
    <div class="row align-items-center">
        <div class="col-md-6 offset-md-3 text-center text-box">
        <h1>Bienvenido a <span style="color:#107acc;">Ticoblue</span></h1>
            <p>Descubre la esencia de TicoBlue, una aplicación donde podrás encontrar todo lo que necesitas para disfrutar de la Zona Azul de Nicoya, un lugar reconocido por su bienestar y longevidad. Aquí te ofrecemos una plataforma completa que te permitirá explorar alojamientos acogedores, restaurantes locales con gastronomía auténtica, y una variedad de eventos culturales y recreativos.
            </p>
            <p>Además, en TicoBlue encontrarás una guía detallada de comercios locales, así como productos y servicios ofrecidos por emprendedores que reflejan la identidad y tradición de esta maravillosa región. Nuestro objetivo es conectar a visitantes y locales con lo mejor que Nicoya tiene para ofrecer, en un solo lugar.
</p>
            <p>Navega por nuestra aplicación para conocer más sobre los maravillosos destinos y servicios que ofrecemos, y descubre cómo puedes realizar tus reservaciones en alojamientos o eventos de manera rápida y sencilla. ¡Explora lo mejor de Nicoya y planifica tu visita con nosotros!</p>
        </div>
    </div>
</div>

<section id="hero" class="hero section dark-background">

  <div id="hero-carousel" class="carousel slide carousel-fade carousel-container-small" data-bs-ride="carousel" data-bs-interval="5000">

    <div class="carousel-item active">
      <img src="assets/img/montanias.jpg" class="d-block w-100" alt="">
      <div class="carousel-container text-center">
        <h2>Belleza natural</h2>
        <div class="overlay-text-container">
          <p class="custom-text">Nicoya ofrece un entorno natural único, con playas de arena blanca, reservas biológicas y parques nacionales como Barra Honda y Palo Verde, que destacan por su biodiversidad y belleza escénica.</p>
        </div>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/nicoya.jpg" class="d-block w-100" alt="">
      <div class="carousel-container text-center">
        <h2>Destino Turístico de Bienestar</h2>
        <div class="overlay-text-container">
          <p class="custom-text">Nicoya no solo es famosa por su longevidad, sino también por sus aventuras y experiencias culturales. Desde cabalgatas por sus paisajes rurales, hasta explorar pueblos auténticos donde la vida tradicional sigue intacta, los visitantes pueden disfrutar de actividades al aire libre, como senderismo en parques nacionales, y aprender sobre la rica historia y cultura de la península.</p>
        </div>
      </div>
    </div>

    <div class="carousel-item">
      <img src="assets/img/adultomayor.jpg" class="d-block w-100" alt="">
      <div class="carousel-container text-center">
        <h2>Longevidad Excepcional</h2>
        <div class="overlay-text-container">
          <p class="custom-text">La península de Nicoya en Costa Rica es una de las cinco Zonas Azules del mundo, regiones reconocidas por albergar a una gran cantidad de personas que superan los 100 años de edad. Esta longevidad excepcional ha sido objeto de interés debido a la alta concentración de centenarios en esta región</p>
        </div>
      </div>
    </div>

    <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </a>

    <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
      <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </a>

  </div>

</section>

    <!-- Services Section -->
    <section id="services" class="services section">
    <div class="section-title text-center">
    <h2>Explora la Zona Azul!</h2>
    <p>Encuentra servicios locales y oportunidades en la Península de Nicoya</p>
  </div>
      <!-- Section Title -->
      
      <div class="content">
        <div class="container">
          <div class="row g-0">
          <div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">01</span>
    <div class="service-item-content">
      <h3 class="service-heading">Comercios locales</h3>
      <p>
        Explora los mercados locales y apoya a los emprendedores de la Zona Azul de la Península de Nicoya.
      </p>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">02</span>
    
    <div class="service-item-content">
      <h3 class="service-heading">Ubicaciones y guías</h3>
      <p>
        Encuentra fácilmente las ubicaciones de los mejores lugares en la Zona Azul de la Península Nicoya, y utiliza nuestra plataforma para guiarte en tu recorrido.
      </p>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">03</span>
    <div class="service-item-content">
      <h3 class="service-heading">Productos locales</h3>
      <p>
        Descubre productos de la zona vendidos por los talentosos artesanos locales en la Península de Nicoya.
      </p>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">04</span>
    <div class="service-item-content">
      <h3 class="service-heading">Alojamientos</h3>
      <p>
        Encuentra cómodos alojamientos en la una de las Zonas Azules del planeta y disfruta de una estancia inolvidable en un entorno único.
      </p>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">05</span>
   
    <div class="service-item-content">
      <h3 class="service-heading">Reservaciones</h3>
      <p>
        Permite a los usuarios hacer reservaciones en los alojamientos y restaurantes locales directamente desde la plataforma.
      </p>
    </div>
  </div>
</div>

<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">06</span>
    
    <div class="service-item-content">
      <h3 class="service-heading">Contacto con comercios</h3>
      <p>
        Facilita el contacto directo con comercios locales para consultas y compras personalizadas.
      </p>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">07</span>
    
    <div class="service-item-content">
      <h3 class="service-heading">Eventos locales</h3>
      <p>
        Encuentra información actualizada sobre actividades de la región para disfrutar de experiencias auténticas.
      </p>
    </div>
  </div>
</div>
<div class="col-lg-3 col-md-6">
  <div class="service-item">
    <span class="number">08</span>
    
    <div class="service-item-content">
      <h3 class="service-heading">Oportunidades para emprendedores</h3>
      <p>
        Los emprendedores locales pueden ofrecer sus productos, servicios y alojamiento a través de nuestra plataforma.
      </p>
    </div>
  </div>
</div>

          </div>
        </div>
      </div>
    </section><!-- /Services Section -->



        </div>

      </div>

    </section><!-- /Recent Posts Section -->


  </main>
@endsection