@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Comercio</h1>

    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar comercio -->
            <form id="editarComercioForm" action="{{ route('comercios.update', $comercio->idComercio) }}" method="POST"
                enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Nombre del Comercio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio"
                        value="{{ $comercio->nombreComercio }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del comercio.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" required>
                        <option disabled value="">Seleccione el tipo de negocio</option>
                        <option value="Alimentación y Bebidas"
                            {{ $comercio->tipoNegocio == 'Alimentación y Bebidas' ? 'selected' : '' }}>Alimentación y
                            Bebidas</option>
                        <option value="Salud y Belleza" {{ $comercio->tipoNegocio == 'Salud y Belleza' ? 'selected' : '' }}>
                            Salud y Belleza</option>
                        <option value="Moda y Accesorios"
                            {{ $comercio->tipoNegocio == 'Moda y Accesorios' ? 'selected' : '' }}>Moda y Accesorios</option>
                        <option value="Hogar y Decoración"
                            {{ $comercio->tipoNegocio == 'Hogar y Decoración' ? 'selected' : '' }}>Hogar y Decoración
                        </option>
                        <option value="Tecnología y Electrónica"
                            {{ $comercio->tipoNegocio == 'Tecnología y Electrónica' ? 'selected' : '' }}>Tecnología y
                            Electrónica</option>
                        <option value="Servicios" {{ $comercio->tipoNegocio == 'Servicios' ? 'selected' : '' }}>Servicios
                        </option>
                        <option value="Deportes y Ocio" {{ $comercio->tipoNegocio == 'Deportes y Ocio' ? 'selected' : '' }}>
                            Deportes y Ocio</option>
                        <option value="Automoción" {{ $comercio->tipoNegocio == 'Automoción' ? 'selected' : '' }}>Automoción
                        </option>
                        <option value="Arte y Entretenimiento"
                            {{ $comercio->tipoNegocio == 'Arte y Entretenimiento' ? 'selected' : '' }}>Arte y
                            Entretenimiento</option>
                        <option value="Educación" {{ $comercio->tipoNegocio == 'Educación' ? 'selected' : '' }}>Educación
                        </option>
                        <option value="Mascotas y Animales"
                            {{ $comercio->tipoNegocio == 'Mascotas y Animales' ? 'selected' : '' }}>Mascotas y Animales
                        </option>
                        <option value="Jardinería y Agricultura"
                            {{ $comercio->tipoNegocio == 'Jardinería y Agricultura' ? 'selected' : '' }}>Jardinería y
                            Agricultura</option>
                        <option value="Construcción e Inmobiliaria"
                            {{ $comercio->tipoNegocio == 'Construcción e Inmobiliaria' ? 'selected' : '' }}>Construcción e
                            Inmobiliaria</option>
                        <option value="Juguetes y Niños"
                            {{ $comercio->tipoNegocio == 'Juguetes y Niños' ? 'selected' : '' }}>Juguetes y Niños</option>
                        <option value="Otros" {{ $comercio->tipoNegocio == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de negocio.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Correo del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio"
                        value="{{ $comercio->correoComercio }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-6">
                    <label for="country" class="form-label">País</label>
                    <select id="country" class="form-select">
                        <option value="506" data-country="Costa Rica" selected>Costa Rica (+506)</option>
                    </select>
                </div>

                <!-- Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="telefonoComercio" name="telefonoComercio"
                        value=" {{ substr($comercio->telefonoComercio, 0, 4) }} {{ substr($comercio->telefonoComercio, 4) }}" required>

                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>




                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio" rows="4" required>{{ $comercio->descripcionComercio }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <div class="col-md-4 d-flex flex-column align-items-center">
                    @if ($comercio->direccion_url)
                        <label for="mapa" class="form-label">Mapa de Ubicación</label>
                        <iframe width="100%" height="250" style="border:0; border-radius: 8px;" loading="lazy"
                            allowfullscreen src="https://www.google.com/maps/embed?pb={{ $comercio->direccion_url }}">
                        </iframe>
                    @else
                        <p>No hay información de ubicación disponible para este comercio.</p>
                    @endif
                </div>

                <!-- Dirección URL -->
                <div class="col-md-8">
                    <label for="direccion_url" class="form-label">ID de Mapa de Google</label>
                    <textarea class="form-control" id="direccion_url" name="direccion_url" rows="3"
                        placeholder="Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres,
                        EJEMPLO:!1m14!1m8!1m3!1d1413.9851815063669!2d-85.4482709!3d10.134871!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f9fb11a28532a23%3A0x3a2a875002c1f8c0!2sGimnasio%20Universidad%20Nacional!5e1!3m2!1ses!2scr!4v1729878403294!5m2!1ses!2scr">{{ old('direccion_url', $comercio->direccion_url ?? '') }}</textarea>
                    <div class="invalid-feedback">
                        Asegúrese de que el ID del Mapa de Google tenga menos de 500
                        caracteres,EJEMPLO:!1m14!1m8!1m3!1d1413.9851815063669!2d-85.4482709!3d10.134871!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f9fb11a28532a23%3A0x3a2a875002c1f8c0!2sGimnasio%20Universidad%20Nacional!5e1!3m2!1ses!2scr!4v1729878403294!5m2!1ses!2scr
                    </div>
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-6">
                    <label for="direccion_texto" class="form-label">Dirección (Texto)</label>
                    <textarea class="form-control" id="direccion_texto" name="direccion_texto" rows="4">{{ $comercio->direccion_texto }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una dirección válida.
                    </div>
                </div>

                <!-- Imagen del Comercio -->
                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    @if ($comercio->imagen)
                        <div class="mt-2">
                            <img src="{{ asset($comercio->imagen) }}" alt="Imagen del comercio" width="150px">
                        </div>
                    @endif
                </div>

                <!-- Botón para Actualizar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Actualizar -->
                    <button class="btn btn-success" type="submit">Actualizar</button>

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
        document.getElementById('editarComercioForm').addEventListener('submit', function(event) {
            // Verifica si el formulario es válido
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault(); // Evita que el formulario se envíe inmediatamente

                // Muestra la alerta rápida si el formulario es válido
                Swal.fire({
                    icon: "success",
                    title: "El comercio ha sido actualizado",
                    showConfirmButton: false,
                    timer: 2100
                });

                // Envía el formulario después de un breve retraso para permitir que se muestre la alerta
                setTimeout(() => {
                    this.submit();
                }, 1600); // Espera 1.6 segundos para que el SweetAlert desaparezca
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
        const telefonoInput = document.getElementById("telefonoComercio");

        // Función para aplicar el formato
        function aplicarFormatoTelefono() {
            let value = telefonoInput.value.replace(/\D/g, ""); // Remueve caracteres no numéricos

            // Remueve el código de país si ya está presente en el valor
            if (value.startsWith("506")) {
                value = value.slice(3); // Quita el prefijo 506 si está duplicado
            }

            // Limita a 8 dígitos después del código de país y aplica el formato XXXX-XXXX
            if (value.length > 4) {
                value = value.slice(0, 4) + '-' + value.slice(4, 8);
            } else {
                value = value.slice(0, 4);
            }

            telefonoInput.value = "+506 " + value;
        }

        // Llama a la función de formato cuando el usuario escribe en el campo de teléfono
        telefonoInput.addEventListener("input", aplicarFormatoTelefono);

        // Llama a la función de formato al hacer clic en el campo de teléfono si está vacío
        telefonoInput.addEventListener("focus", function() {
            if (!telefonoInput.value.startsWith("+506")) {
                telefonoInput.value = "+506 ";
            }
        });
    });
    </script>
@endsection
