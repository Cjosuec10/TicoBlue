@extends('layout.administracion')

@section('content')
    <div class="container">
        <h1 class="card-title">Crear Reservación</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="card-title"></h1>
                <form action="{{ route('reservaciones.store') }}" method="POST" enctype="multipart/form-data"
                    id="crearReservacionForm" class="row g-3 needs-validation" novalidate>
                    @csrf

                    @if (Auth::check())
                        <!-- ID del Usuario Logueado (campo oculto) -->
                        <input type="hidden" name="idUsuario_fk" value="{{ Auth::user()->idUsuario }}">

                        <!-- Nombre del Usuario -->
                        <div class="col-md-6 mb-3">
                            <label for="nombreUsuarioReservacion" class="form-label">Nombre del Usuario</label>
                            <input type="text" class="form-control" id="nombreUsuarioReservacion"
                                name="nombreUsuarioReservacion" value="{{ Auth::user()->nombre }}" readonly required>
                            <div class="valid-feedback">¡Correcto!</div>
                        </div>

                        <!-- Correo del Usuario -->
                        <div class="col-md-6 mb-3">
                            <label for="correoUsuarioReservacion" class="form-label">Correo del Usuario</label>
                            <input type="email" class="form-control" id="correoUsuarioReservacion"
                                name="correoUsuarioReservacion" value="{{ Auth::user()->correo }}" readonly required>
                            <div class="valid-feedback">¡Correcto!</div>
                        </div>

                        <!-- Teléfono del Usuario con Selección de País -->
                        <div class="col-md-6 mb-3"hidden>
                            <label for="country" class="form-label">País</label>
                            <select id="country" class="form-select" name="codigoPais"
                                onchange="actualizarPrefijoTelefono()">
                                <option value="506" data-country="Costa Rica">Costa Rica (+506)</option>
                                <!-- Agrega más opciones de país aquí -->
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <div class="input-group">
                                <input type="tel" name="telefono" class="form-control" id="telefono"
                                    placeholder="+506 XXXX-XXXX" 
                                    value="{{ Auth::user()->telefono ?? '' }}" required>
                            </div>
                            <div class="invalid-feedback">Por favor, ingresa un número de teléfono válido.</div>
                        </div>

                        <!-- Campo de Comercio Asociado (lectura solamente) -->
                        <div class="col-md-6 mb-3">
                            <label for="comercio" class="form-label">Comercio Asociado</label>
                            <input type="text" class="form-control" id="comercio" readonly>
                        </div>

                        <!-- Campo Oculto para `idComercio_fk` -->
                        <input type="hidden" name="idComercio_fk" id="idComercio_fk">

                        <!-- Selección de Evento -->
                        <div class="col-md-6 mb-3">
                            <label for="idEvento_fk" class="form-label">Evento (opcional)</label>
                            <select class="form-select" id="idEvento_fk" name="idEvento_fk" onchange="actualizarComercio()">
                                <option selected disabled value="">Seleccione un evento</option>
                                @foreach ($eventos as $evento)
                                    <option value="{{ $evento->idEvento }}"
                                        data-comercio="{{ $evento->comercio->nombreComercio ?? 'No especificado' }}"
                                        data-comercio-id="{{ $evento->comercio->idComercio ?? '' }}">
                                        {{ $evento->nombreEvento }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione un evento válido o deje el campo vacío.
                            </div>
                        </div>

                        <!-- Selección de Alojamiento -->
                        <div class="col-md-6 mb-3">
                            <label for="idAlojamiento_fk" class="form-label">Alojamiento (opcional)</label>
                            <select class="form-select" id="idAlojamiento_fk" name="idAlojamiento_fk"
                                onchange="actualizarComercio()">
                                <option selected disabled value="">Seleccione un alojamiento</option>
                                @foreach ($alojamientos as $alojamiento)
                                    <option value="{{ $alojamiento->idAlojamiento }}"
                                        data-comercio="{{ $alojamiento->comercio->nombreComercio ?? 'No especificado' }}"
                                        data-comercio-id="{{ $alojamiento->comercio->idComercio ?? '' }}">
                                        {{ $alojamiento->nombreAlojamiento }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Por favor, seleccione un alojamiento válido o deje el campo vacío.
                            </div>
                        </div>

                        <!-- Botones de Acción -->
                        <div class="col-12 d-flex justify-content-center gap-3 mt-4">
                            <button type="submit" class="btn btn-success">Crear Reservación</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.history.back();">Volver</button>
                        </div>
                    @else
                        <p class="text-center text-danger">Por favor, inicia sesión para completar una reservación.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript para actualizar el comercio asociado, país, y mostrar notificación -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function actualizarComercio() {
            const eventoSelect = document.getElementById('idEvento_fk');
            const alojamientoSelect = document.getElementById('idAlojamiento_fk');
            const comercioInput = document.getElementById('comercio');
            const idComercioInput = document.getElementById('idComercio_fk');

            const eventoComercio = eventoSelect.selectedOptions[0]?.getAttribute('data-comercio');
            const eventoComercioId = eventoSelect.selectedOptions[0]?.getAttribute('data-comercio-id');
            const alojamientoComercio = alojamientoSelect.selectedOptions[0]?.getAttribute('data-comercio');
            const alojamientoComercioId = alojamientoSelect.selectedOptions[0]?.getAttribute('data-comercio-id');

            if (eventoSelect.value) {
                comercioInput.value = eventoComercio;
                idComercioInput.value = eventoComercioId;
            } else if (alojamientoSelect.value) {
                comercioInput.value = alojamientoComercio;
                idComercioInput.value = alojamientoComercioId;
            } else {
                comercioInput.value = '';
                idComercioInput.value = '';
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const inputPhone = document.querySelector("#telefono");
            const selectCountry = document.querySelector("#country");
            const form = document.querySelector("#crearReservacionForm");

            // Actualiza el valor del campo de teléfono al cambiar el país seleccionado
            selectCountry.addEventListener("change", function() {
                const countryCode = selectCountry.value;
                inputPhone.value = "+" + countryCode + " "; // Añadir el nuevo código de país
            });

            // Aplicar el formato XXXX-XXXX mientras se escribe
            inputPhone.addEventListener("input", function() {
                let value = inputPhone.value.replace(/[^\d]/g, ""); // Remover caracteres no numéricos
                if (value.startsWith(selectCountry.value)) {
                    value = value.slice(selectCountry.value.length); // Remover código duplicado si existe
                }
                if (value.length > 4) {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8);
                }
                inputPhone.value = "+" + selectCountry.value + " " + value;
            });

            // Antes de enviar el formulario, guarda el número completo con el código de país
            form.addEventListener("submit", function(event) {
                const countryCode = selectCountry.value;
                let value = inputPhone.value.replace(/[^\d]/g, "");
                if (value.startsWith(countryCode)) {
                    value = value.slice(countryCode.length); // Remover código de país duplicado si existe
                }
                value = "+" + countryCode + value;
                inputPhone.value = value; // Asignar el valor actualizado al campo input
            });
        });

        // Validación del formulario y notificación de éxito
        document.getElementById('crearReservacionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevenir el envío inmediato
            if (!this.checkValidity()) {
                event.stopPropagation(); // Detener la propagación si no es válido
                this.classList.add('was-validated');
            } else {
                Swal.fire({
                    icon: "success",
                    title: "Reservación creada exitosamente",
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    this.submit(); // Enviar el formulario después de mostrar la alerta
                });
            }
        });
    </script>
@endsection
