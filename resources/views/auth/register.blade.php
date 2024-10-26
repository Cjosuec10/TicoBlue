<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
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

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-1">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                <img src="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" alt="" style="width: 200px; height: auto;">
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Crear Cuenta</h5>
                    <p class="text-center small">Por favor ingrese la información correspondiente</p>
                  </div>

                  <!-- Formulario de registro con validaciones del lado del cliente -->
                  <form class="row g-3 needs-validation" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf <!-- Token de seguridad necesario en Laravel -->

                    <div class="col-12">
                      <label for="yourName" class="form-label">Nombre</label>
                      <input type="text" name="nombre" class="form-control" id="yourName" required minlength="3" maxlength="100" placeholder="Ingresa tu nombre">
                      <div class="invalid-feedback">Por favor, ingresa tu nombre (mínimo 3 caracteres).</div>
                      @if ($errors->has('nombre'))
                        <div class="text-danger">{{ $errors->first('nombre') }}</div>
                      @endif
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Correo Electrónico</label>
                      <input type="email" name="correo" class="form-control" id="yourEmail" required placeholder="Ingresa tu correo electrónico">
                      <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
                      @if ($errors->has('correo'))
                        <div class="text-danger">{{ $errors->first('correo') }}</div>
                      @endif
                    </div>

                    <div class="col-12">
                      <label for="yourPhone" class="form-label">Teléfono</label>
                      <input type="tel" name="telefono" class="form-control" id="yourPhone" pattern="\d{8,20}" placeholder="Ingresa tu número de teléfono">
                      <div class="invalid-feedback">Por favor, ingresa un número de teléfono válido (mínimo 8 dígitos).</div>
                      @if ($errors->has('telefono'))
                        <div class="text-danger">{{ $errors->first('telefono') }}</div>
                      @endif
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Contraseña</label>
                      <input type="password" name="contrasena" class="form-control" id="yourPassword" required minlength="8" placeholder="Ingresa tu contraseña">
                      <div class="invalid-feedback">Por favor, ingresa tu contraseña (mínimo 8 caracteres).</div>
                      @if ($errors->has('contrasena'))
                        <div class="text-danger">{{ $errors->first('contrasena') }}</div>
                      @endif
                    </div>

                    <div class="col-12">
                      <label for="yourPasswordConfirmation" class="form-label">Confirmar Contraseña</label>
                      <input type="password" name="contrasena_confirmation" class="form-control" id="yourPasswordConfirmation" required placeholder="Confirma tu contraseña">
                      <div class="invalid-feedback">Por favor, confirma tu contraseña.</div>
                      @if ($errors->has('contrasena_confirmation'))
                        <div class="text-danger">{{ $errors->first('contrasena_confirmation') }}</div>
                      @endif
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Registrar Cuenta</button>
                    </div>
                    <div class="col-12">
                      <a href="{{ route('login') }}" class="btn btn-secondary w-100">Regresar</a>
                   </div>
                  </form><!-- End Formulario -->

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>
  </main><!-- End #main -->

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <script>
    // Bootstrap 5 validación del formulario
    (function () {
      'use strict'

      // Obtener todos los formularios con clase 'needs-validation'
      var forms = document.querySelectorAll('.needs-validation')

      // Prevenir el envío de formularios no válidos
      Array.prototype.slice.call(forms).forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
  </script>

</body>

</html>
