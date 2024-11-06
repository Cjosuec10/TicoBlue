
  @extends('layout.inicio')

  @section('title', 'contacto')
  
  @section('content')
   
  <main class="main custom-gray">

  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

  <h2 class="text-center">Contáctanos</h2>
    <p class="text-center">¿Tienes alguna pregunta, duda o sugerencia? Estamos aquí para ayudarte. Llena el formulario o utiliza nuestros canales de contacto.</p>

    <!-- Información de contacto general -->
  


 <!-- Sección de Contacto -->
<section id="contact" class="contact section py-5 custom-gray">
    <div class="container" data-aos="fade">
        <div class="row gy-5 gx-lg-5">
            
            <!-- Columna de Información de Contacto -->
            <div class="col-lg-4">
                <div class="info p-4 border rounded">
                    <h3 class="mb-4">Mantente en contacto!</h3>
                    <p>Mantente en contacto con nosotros. Ya sea para soporte, consultas o comentarios, estamos aquí para ayudarte.</p>

                    <div class="info-item d-flex mb-3">
                        <i class="bi bi-geo-alt flex-shrink-0 me-3"></i>
                        <div>
                            <h4>Localización:</h4>
                            <p>Nicoya, Costa Rica, Guanacaste</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex mb-3">
                        <i class="bi bi-envelope flex-shrink-0 me-3"></i>
                        <div>
                            <h4>Email:</h4>
                            <p>info@ticoblue.com</p>
                        </div>
                    </div><!-- End Info Item -->

                    <div class="info-item d-flex mb-3">
                        <i class="bi bi-phone flex-shrink-0 me-3"></i>
                        <div>
                            <h4>Phone:</h4>
                            <p>+1 5589 55488 55</p>
                        </div>
                    </div><!-- End Info Item -->
                    <div class="info-item d-flex mb-3">
    <i class="bi bi-share flex-shrink-0 me-3"></i>
    <div>
        <h4>Síguenos:</h4>
        <p>Encuentra nuestras últimas actualizaciones en nuestras redes sociales. <br>
        <a href="https://facebook.com/ticoblue" target="_blank">Facebook</a> | 
        <a href="https://instagram.com/ticoblue" target="_blank">Instagram</a> | 
        <a href="https://twitter.com/ticoblue" target="_blank">Twitter</a></p>
    </div>
</div>

                </div>
            </div><!-- Fin Columna de Información de Contacto -->

            <!-- Columna del Formulario de Contacto -->
            <div class="col-lg-8">
                <div class="container contact-container">
                    
                <form id="contact-form" action="{{ route('notifications.store') }}" method="POST" class="contact-form">
                @csrf
                        <div class="row">
                        <h3 class="mb-4">Envíanos un mensaje</h3>
                        <p class="contact-description mb-4">Por favor, completa el formulario a continuación para contactarnos.</p>
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
                
    <div class="g-recaptcha mb-3" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                        <button type="submit" class="mt-2 mb-1 btn btn-primary w-100">Enviar Mensaje</button>
                    </form>
                    <!-- Cargar el script de reCAPTCHA -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: '¡Formulario enviado!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        });
    </script>
@endif
                </div>
            </div><!-- Fin Columna del Formulario de Contacto -->
        </div>
    </div>
</section><!-- Fin Sección de Contacto -->

  </main>
  @endsection