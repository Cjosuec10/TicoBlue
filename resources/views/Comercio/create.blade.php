@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Comercio</h1>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"></h1>
            <!-- Agregamos el id "crearComercioForm" al formulario -->
            <form id="crearComercioForm" action="{{ route('comercios.store') }}" method="POST" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- Nombre del Comercio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label">Nombre del Comercio<span class="text-danger">**</span></label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" required
                        placeholder="Ingrese el nombre del comercio">
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del comercio.
                    </div>
                </div>

                <!-- Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio<span class="text-danger">**</span></label>
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
                    <label for="correoComercio" class="form-label">Correo<span class="text-danger">**</span></label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio" required
                        placeholder="Ingrese el correo electrónico">
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                </div>
                
                <!-- Teléfono del Comercio -->
                <div class="col-md-4">
                    <label for="telefonoComercio" class="form-label">Teléfono (opcional)</label>
                    <input type="tel" class="form-control" id="telefonoComercio" name="telefonoComercio" required
                        placeholder="+506 XXXX-XXXX">
                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                </div>

                <!-- Mostrar Usuario Actual -->
                <div class="col-md-2">
                    <label for="idUsuario_fk" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="nombre"
                        value="{{ auth()->user()->nombre ?? 'Nombre no disponible' }}" readonly>
                    <input type="hidden" name="idUsuario_fk" value="{{ auth()->user()->id }}">
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción (opcional)</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio"
                        placeholder="Ingrese una descripción del comercio"></textarea>
                </div>

                <!-- Dirección URL -->
                <div class="col-md-12">
                    <label for="direccion_url" class="form-label">ID del Mapa de Google (opcional)</label>
                    <textarea class="form-control @error('direccion_url') is-invalid @enderror" id="direccion_url" name="direccion_url"
                        rows="3" placeholder="Ingrese ID de Mapa de Google">{{ old('direccion_url') }}</textarea>
                    <div class="invalid-feedback">
                        Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres,
                        EJEMPLO:
                        !1m14!1m8!1m3!1d1413.9851815063669!2d-85.4482709!3d10.134871!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f9fb11a28532a23%3A0x3a2a875002c1f8c0!2sGimnasio%20Universidad%20Nacional!5e1!3m2!1ses!2scr!4v1729878403294!5m2!1ses!2scr
                    </div>
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-12">
                    <label for="direccion_texto" class="form-label">Dirección (opcional)</label>
                    <textarea type="text" class="form-control" id="direccion_texto" name="direccion_texto"
                        placeholder="Ingrese la dirección completa del comercio"></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una dirección.
                    </div>
                </div>

                <div class="col-3" hidden>
                    <label for="country" class="form-label">País (opcional)</label>
                    <select id="country" class="form-select">
                        <option value="506" data-country="Costa Rica" selected>Costa Rica (+506)</option>
                    </select>
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagen">Imagen (opcional)</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <!-- Botón para Enviar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
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

        document.addEventListener("DOMContentLoaded", function() {
            const inputPhone = document.querySelector("#telefonoComercio");
            const selectCountry = document.querySelector("#country");
            const form = document.querySelector("#crearComercioForm");

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
@endsection
