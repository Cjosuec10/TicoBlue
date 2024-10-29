@extends('layout.administracion')

@section('content')
    <div class="container">
        <h1 class="card-title text-center my-4">Editar Reservación</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('reservaciones.update', $reservacion->id) }}" method="POST"
                    enctype="multipart/form-data" id="editarReservacionForm" class="row g-3 needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Datos del Usuario -->
                    <div class="col-md-6 mb-3">
                        <label for="nombreUsuarioReservacion" class="form-label">Nombre del Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuarioReservacion"
                            name="nombreUsuarioReservacion"
                            value="{{ old('nombreUsuarioReservacion', $reservacion->nombreUsuarioReservacion) }}" required>
                        <div class="valid-feedback">¡Correcto!</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="correoUsuarioReservacion" class="form-label">Correo del Usuario</label>
                        <input type="email" class="form-control" id="correoUsuarioReservacion"
                            name="correoUsuarioReservacion"
                            value="{{ old('correoUsuarioReservacion', $reservacion->correoUsuarioReservacion) }}" required>
                        <div class="valid-feedback">¡Correcto!</div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telefonoUsuarioReservacion" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefonoUsuarioReservacion"
                            name="telefonoUsuarioReservacion"
                            value="{{ old('telefonoUsuarioReservacion', $reservacion->telefonoUsuarioReservacion) }}">
                    </div>

                    <!-- Campo de Comercio Asociado (lectura solamente) -->
                    <div class="col-md-6 mb-3">
                        <label for="comercio" class="form-label">Comercio Asociado</label>
                        <input type="text" class="form-control" id="comercio"
                            value="{{ $reservacion->comercio->nombreComercio ?? '' }}" readonly>
                    </div>

                    <!-- Campo Oculto para `idComercio_fk` -->
                    <input type="hidden" name="idComercio_fk" id="idComercio_fk" value="{{ $reservacion->idComercio_fk }}">

                    <!-- Selección de Evento -->
                    <div class="col-md-6 mb-3">
                        <label for="idEvento_fk" class="form-label">Evento (opcional)</label>
                        <select class="form-select" id="idEvento_fk" name="idEvento_fk" onchange="actualizarComercio()">
                            <option value="">Seleccione un evento</option>
                            @foreach ($eventos as $evento)
                                <option value="{{ $evento->idEvento }}"
                                    data-comercio="{{ $evento->comercio->nombreComercio ?? 'No especificado' }}"
                                    data-comercio-id="{{ $evento->comercio->idComercio ?? '' }}"
                                    {{ $reservacion->idEvento_fk == $evento->idEvento ? 'selected' : '' }}>
                                    {{ $evento->nombreEvento }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Por favor, seleccione un evento válido o deje el campo vacío.</div>
                    </div>

                    <!-- Selección de Alojamiento -->
                    <div class="col-md-6 mb-3">
                        <label for="idAlojamiento_fk" class="form-label">Alojamiento (opcional)</label>
                        <select class="form-select" id="idAlojamiento_fk" name="idAlojamiento_fk"
                            onchange="actualizarComercio()">
                            <option value="">Seleccione un alojamiento</option>
                            @foreach ($alojamientos as $alojamiento)
                                <option value="{{ $alojamiento->idAlojamiento }}"
                                    data-comercio="{{ $alojamiento->comercio->nombreComercio ?? 'No especificado' }}"
                                    data-comercio-id="{{ $alojamiento->comercio->idComercio ?? '' }}"
                                    {{ $reservacion->idAlojamiento_fk == $alojamiento->idAlojamiento ? 'selected' : '' }}>
                                    {{ $alojamiento->nombreAlojamiento }}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Por favor, seleccione un alojamiento válido o deje el campo vacío.
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="col-12 d-flex justify-content-center gap-3 mt-4">
                        <button type="submit" class="btn btn-success">Editar Reservación</button>
                        <button type="button" class="btn btn-secondary" onclick="window.history.back();">Volver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript para actualizar el comercio asociado y mostrar notificación -->
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

    // Manejar el envío del formulario con SweetAlert
    document.getElementById('editarReservacionForm').addEventListener('submit', function(event) {
        event.preventDefault();

        if (this.checkValidity()) {
            // Mostrar SweetAlert y luego enviar el formulario
            Swal.fire({
                icon: "success",
                title: "Reservación actualizada exitosamente",
                showConfirmButton: false,
                timer: 2000
            }).then(() => {
                this.submit(); // Enviar formulario
            });
        } else {
            event.stopPropagation();
            this.classList.add('was-validated');
        }
    }); 

    
</script>

    
    
@endsection
