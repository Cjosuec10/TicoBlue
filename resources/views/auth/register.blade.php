<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Register</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" rel="icon">
    <link href="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

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

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-1">
                                <a href="/" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('assets/img/ProyectoTICOBLUE.png') }}" alt=""
                                        style="width: 200px; height: auto;">
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Crear Cuenta</h5>
                                        <p class="text-center small">Por favor ingrese la información correspondiente
                                        </p>
                                    </div>

                                    <!-- Formulario de registro con validaciones del lado del cliente -->
                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('register') }}" novalidate>
                                        @csrf <!-- Token de seguridad necesario en Laravel -->

                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nombre</label>
                                            <input type="text" name="nombre" class="form-control" id="yourName"
                                                required minlength="3" maxlength="100" placeholder="Ingresa tu nombre">
                                            <div class="invalid-feedback">Por favor, ingresa tu nombre (mínimo 3
                                                caracteres).</div>
                                            @if ($errors->has('nombre'))
                                                <div class="text-danger">{{ $errors->first('nombre') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Correo Electrónico</label>
                                            <input type="email" name="correo" class="form-control" id="yourEmail"
                                                required placeholder="Ingresa tu correo electrónico">
                                            <div class="invalid-feedback">Por favor, ingresa un correo válido.</div>
                                            @if ($errors->has('correo'))
                                                <div class="text-danger">{{ $errors->first('correo') }}</div>
                                            @endif
                                        </div>
                                        <!-- Selección de Rol -->
                                        <div class="col-12">
                                            <label for="rol" class="form-label">Selecciona un Rol</label>
                                            <select id="rol" name="rol" class="form-select" required>
                                                <option value="" selected disabled>Seleccione un rol</option>
                                                @foreach ($roles as $rol)
                                                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">Por favor, seleccione un rol.</div>
                                            @if ($errors->has('rol'))
                                                <div class="text-danger">{{ $errors->first('rol') }}</div>
                                            @endif
                                        </div>


                                        <div class="col-12">
                                            <label for="country" class="form-label">País</label>
                                            <select id="country" class="form-select">
                                                <option value="506" data-country="Costa Rica">Costa Rica (+506)
                                                </option>
                                                <option value="1" data-country="Estados Unidos">Estados Unidos (+1)
                                                </option>
                                                <option value="44" data-country="Reino Unido">Reino Unido (+44)
                                                </option>
                                                <!-- Agrega más opciones de país aquí -->
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPhone" class="form-label">Teléfono</label>
                                            <input type="tel" name="telefono" class="form-control" id="yourPhone"
                                                placeholder="Ingresa tu número de teléfono (ej: +506 2023-2365)">
                                            <div class="invalid-feedback">Por favor, ingresa un número de teléfono
                                                válido (formato +XXX XXXX-XXXX).</div>
                                            @if ($errors->has('telefono'))
                                                <div class="text-danger">{{ $errors->first('telefono') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Contraseña</label>
                                            <input type="password" name="contrasena" class="form-control"
                                                id="yourPassword" required minlength="8"
                                                placeholder="Ingresa tu contraseña">
                                            <div class="invalid-feedback">Por favor, ingresa tu contraseña (mínimo 8
                                                caracteres).</div>
                                            @if ($errors->has('contrasena'))
                                                <div class="text-danger">{{ $errors->first('contrasena') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPasswordConfirmation" class="form-label">Confirmar
                                                Contraseña</label>
                                            <input type="password" name="contrasena_confirmation"
                                                class="form-control" id="yourPasswordConfirmation" required
                                                placeholder="Confirma tu contraseña">
                                            <div class="invalid-feedback">Por favor, confirma tu contraseña.</div>
                                            @if ($errors->has('contrasena_confirmation'))
                                                <div class="text-danger">
                                                    {{ $errors->first('contrasena_confirmation') }}</div>
                                            @endif
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Registrar
                                                Cuenta</button>
                                        </div>
                                        <div class="col-12">
                                            <a href="{{ route('login') }}"
                                                class="btn btn-secondary w-100">Regresar</a>
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Bootstrap 5 validación del formulario
        (function() {
            'use strict'

            // Obtener todos los formularios con clase 'needs-validation'
            var forms = document.querySelectorAll('.needs-validation')

            // Prevenir el envío de formularios no válidos
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()

                        // Mostrar SweetAlert para formulario no válido
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Por favor, completa todos los campos correctamente.',
                        });
                    } else {
                        event.preventDefault(); // Evitar el envío inmediato del formulario

                        // Mostrar SweetAlert para confirmar envío del formulario
                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¿Deseas crear esta cuenta?",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, crear cuenta'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                form.submit(); // Enviar el formulario si el usuario confirma
                                Swal.fire({
                                    icon: 'success',
                                    title: '¡Usuario creado!'
                                });

                            }
                        });
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()

        document.addEventListener("DOMContentLoaded", function() {
            const inputPhone = document.querySelector("#yourPhone");
            const selectCountry = document.querySelector("#country");
            const form = document.querySelector("form");

            // Actualiza el valor del campo de teléfono al cambiar el país seleccionado
            selectCountry.addEventListener("change", function() {
                const countryCode = selectCountry.value;
                inputPhone.value = "+" + countryCode + " "; // Añadir el nuevo código de país
            });

            // Aplicar el formato XXXX-XXXX mientras se escribe
            inputPhone.addEventListener("input", function() {
                let value = inputPhone.value.replace(/[^\d]/g,
                    ""); // Remover cualquier carácter no numérico excepto el '+'
                if (value.startsWith(selectCountry.value)) {
                    value = value.slice(selectCountry.value
                        .length); // Remover código de país duplicado si existe
                }
                if (value.length > 4) {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8);
                }
                inputPhone.value = "+" + selectCountry.value + " " + value;
            });

            // Antes de enviar el formulario, guarda el número completo con el código de país
            form.addEventListener("submit", function(event) {
                const countryCode = selectCountry.value;
                let value = inputPhone.value.replace(/[^\d]/g,
                    ""); // Remover cualquier carácter que no sea número
                if (value.startsWith(countryCode)) {
                    value = value.slice(countryCode.length); // Remover código de país duplicado si existe
                }
                value = "+" + countryCode + value;
                inputPhone.value = value; // Asignar el valor actualizado al campo input
            });
        });
    </script>

</body>

</html>
