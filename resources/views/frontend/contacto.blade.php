
  @extends('layout.inicio')

  @section('title', 'contacto')
  
  @section('content')
   
  <main class="main">

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

  <h1 class="text-center">Contáctanos</h1>
    <p class="text-center">¿Tienes alguna pregunta, duda o sugerencia? Estamos aquí para ayudarte. Llena el formulario o utiliza nuestros canales de contacto.</p>

    <!-- Información de contacto general -->
  


   
<!-- Contenedor del formulario de contacto -->
<div class="container contact-container mt-5">
    <h3 class="contact-title">Envíanos un mensaje</h3>
    <p class="contact-description">Por favor, completa el formulario a continuación para contactarnos.</p>
    <form action="{{ route('notifications.store') }}" method="POST" class="contact-form">
        @csrf
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre Completo</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" class="form-control" id="telefono" name="telefono">
            </div>
            <div class="col-md-6 mb-3">
                <label for="tipo_consulta" class="form-label">Tipo de Consulta</label>
                <select class="form-control" id="tipo_consulta" name="tipo_consulta" required>
                    <option value="" disabled selected>Selecciona una opción</option>
                    <option value="Soporte Técnico">Soporte Técnico</option>
                    <option value="Publicar Comercio/Evento">Publicar Comercio/Evento</option>
                    <option value="Consultas Generales">Consultas Generales</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required></textarea>
        </div>
        <button type="submit" class="submit-btn">Enviar Mensaje</button>
    </form>
</div>
    <div class="container row justify-content-center align-items-center vh-100">
    <div class="col-md-4 text-center">
        <h3>Información General</h3>
        <p><strong>Teléfono:</strong> +506 1234-5678</p>
        <p><strong>Email:</strong> ticoblue@gmail.com</p>
        <p><strong>Dirección:</strong> Nicoya, Costa Rica</p>
    </div>

    <div class="col-md-4 text-center">
        <h3>Horario de Atención</h3>
        <p><strong>Lunes a Viernes:</strong> 9:00 AM - 6:00 PM</p>
        <p><strong>Sábado:</strong> 9:00 AM - 1:00 PM</p>
        <p><strong>Domingo:</strong> Cerrado</p>
    </div>

    <div class="col-md-4 mb-5 text-center">
       
        <iframe class="map-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20139.809096891896!2d-85.44625!3d10.134833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen=""></iframe>
    </div><!-- End Google Maps -->
</div>

</div>
<!-- Redes sociales y otros contactos -->
<div class="container contact-container mt-5 text-center">
<h3 class="contact-title">Síguenos en nuestras redes sociales</h3>
<p class="contact-description">Conéctate con nosotros para recibir noticias, ofertas especiales y más.</p>
<a href="https://facebook.com" target="_blank" class="btn btn-outline-primary">Facebook</a>
<a href="https://instagram.com" target="_blank" class="btn btn-outline-danger">Instagram</a>
<a href="https://twitter.com" target="_blank" class="btn btn-outline-info">Twitter</a>
</div> 
</div>
    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.webp);">
      <div class="container position-relative">
        <h1>Contact</h1>
        <p>
          Home
          /
          Contact
        </p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">


      <div class="container" data-aos="fade">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>Get in touch</h3>
              <p>Et id eius voluptates atque nihil voluptatem enim in tempore minima sit ad mollitia commodi minus.</p>

              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>A108 Adam Street, New York, NY 535022</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>info@example.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>+1 5589 55488 55</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-8">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required="">
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" placeholder="Message" required=""></textarea>
              </div>
              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section light-background">

      <div class="content">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-6">
              <h3>Subscribe To Our Newsletter</h3>
              <p class="opacity-50">
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Nesciunt, reprehenderit!
              </p>
            </div>
            <div class="col-lg-6">
              <form action="forms/newsletter.php" class="form-subscribe php-email-form">
                <div class="form-group d-flex align-items-stretch">
                  <input type="email" name="email" class="form-control h-100" placeholder="Enter your e-mail">
                  <input type="submit" class="btn btn-secondary px-4" value="Subcribe">
                </div>
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">
                  Your subscription request has been sent. Thank you!
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section><!-- /Call To Action Section -->

  </main>
  @endsection