@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Comercio</h1>

    <div class="card">
        <div class="card-body">
            <!-- Agregamos el id "crearComercioForm" al formulario -->
            <form id="crearComercioForm" action="{{ route('comercios.store') }}" method="POST" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- Nombre del Comercio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del comercio.
                    </div>
                </div>

                <!-- Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" required>
                        <option selected disabled value="">Seleccione el tipo de negocio</option>
                        <option value="Soda">Soda</option>
                        <option value="Restaurante">Restaurante</option>
                        <option value="Cafeterías">Cafeterías</option>
                        <option value="Mercados locales">Mercados locales</option>
                        <option value="Tiendas de artesanías">Tiendas de artesanías</option>
                        <option value="Talleres">Talleres</option>
                        <option value="Deportes y Ocio">Deportes y Ocio</option>
                        <option value="Alojamientos">Alojamientos</option>
                        <option value="Arte y Entretenimiento">Arte y Entretenimiento</option>
                        <option value="Educación">Educación</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de negocio.
                    </div>
                </div>

                <!-- Correo del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                </div>

                <!-- Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComercio" name="telefonoComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio"></textarea>
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagen">Imagen</label>
                    <input type="file" id="imagen" name="imagen">
                </div>

                <!-- Dirección URL -->
                <div class="col-md-12">
                    <label for="direccion_url" class="form-label">ID del Mapa de Google</label>
                    <textarea class="form-control @error('direccion_url') is-invalid @enderror" id="direccion_url" name="direccion_url"
                        rows="3" placeholder="Ingrese ID de Mapa de Google">{{ old('direccion_url') }}</textarea>
                    <div class="invalid-feedback">
                        Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres, EJEMPLO:
                        !1m14!1m8!1m3!1d1413.9851815063669!2d-85.4482709!3d10.134871!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f9fb11a28532a23%3A0x3a2a875002c1f8c0!2sGimnasio%20Universidad%20Nacional!5e1!3m2!1ses!2scr!4v1729878403294!5m2!1ses!2scr
                    </div>

                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-6">
                    <label for="direccion_texto" class="form-label">Dirección (Texto)</label>
                    <input type="text" class="form-control" id="direccion_texto" name="direccion_texto">
                    <div class="invalid-feedback">
                        Por favor, ingrese una dirección.
                    </div>
                </div>

                <!-- Selección de Usuario -->
                <div class="col-md-6">
                    <label for="idUsuario_fk" class="form-label">Usuario</label>
                    <select class="form-select" id="idUsuario_fk" name="idUsuario_fk" required>
                        <option selected disabled value="">Seleccione un usuario</option>
                        <option value="{{ $usuario->idUsuario }}">{{ $usuario->nombre }}</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un usuario.
                    </div>
                </div>

                <!-- Botón para Enviar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Guardar -->
                    <button class="btn btn-success" type="submit">Guardar</button>

                    <!-- Botón Volver -->
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('crearComercioForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío inmediato del formulario

            const direccionUrl = document.getElementById('direccion_url');
            let formularioValido = true;

            // Reiniciar las clases de validación
            direccionUrl.classList.remove('is-valid', 'is-invalid');

            // Verificar la longitud del campo dirección URL
            if (direccionUrl.value.length > 500) {
                formularioValido = false;
                direccionUrl.classList.add('is-invalid');
                direccionUrl.value = ""; // Limpiar el campo en caso de error
            } else {
                direccionUrl.classList.remove('is-invalid');
            }

            // Verificar si el formulario es válido (incluyendo los campos requeridos)
            if (!this.checkValidity() || !formularioValido) {
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                // Mostrar la alerta y luego enviar el formulario
                Swal.fire({
                    icon: "success",
                    title: "El comercio ha sido creado",
                    showConfirmButton: false,
                    timer: 2100
                }).then(() => {
                    this.submit();
                });
            }
        });
    </script>
@endsection
