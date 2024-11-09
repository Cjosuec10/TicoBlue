@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Evento</h1>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"></h1>
            <form id="editarEventoForm" action="{{ route('eventos.update', $evento->idEvento) }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="nombreEvento" class="form-label">Nombre del Evento<span class="text-danger">**</span></label>
                    <input type="text" placeholder="Ingrese el nombre del evento" class="form-control" id="nombreEvento" name="nombreEvento"
                        value="{{ $evento->nombreEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="tipoEvento" class="form-label">Tipo de Evento<span class="text-danger">**</span></label>
                    <input type="text" placeholder="Tipo de evento (e.g., Concierto, Feria)" class="form-control" id="tipoEvento" name="tipoEvento"
                        value="{{ $evento->tipoEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese el tipo del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="correoEvento" class="form-label">Correo<span class="text-danger">**</span></label>
                    <input type="email" placeholder="ejemplo@correo.com" class="form-control" id="correoEvento" name="correoEvento"
                        value="{{ $evento->correoEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese un correo válido.</div>
                </div>
                <div class="col-6" hidden>
                    <label for="country" class="form-label">País</label>
                    <select id="country" class="form-select">
                        <option value="506" data-country="Costa Rica" selected>Costa Rica (+506)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="telefonoEvento" class="form-label">Teléfono (opcional)</label>
                    <input type="text" placeholder="+506 XXXX-XXXX"  class="form-control" id="telefonoEvento" name="telefonoEvento"
                        value="{{ $evento->telefonoEvento }}">
                        <div class="invalid-feedback">
                            Por favor, ingrese un teléfono válido.
                        </div>
                        <div class="valid-feedback">
                            ¡Correcto!
                        </div>
                </div>
                <div class="col-md-6">
                    <label for="direccionEvento" class="form-label">Dirección (opcional)</label>
                    <input type="text" placeholder="Dirección del evento" class="form-control" id="direccionEvento" name="direccionEvento"
                        value="{{ $evento->direccionEvento }}">
                </div>
                <div class="col-md-6">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio<span class="text-danger">**</span></label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"
                        value="{{ $evento->fechaInicio }}" required>
                    <div class="invalid-feedback">Por favor, ingrese la fecha de inicio.</div>
                </div>
                <div class="col-md-6">
                    <label for="fechaFin" class="form-label">Fecha de Fin<span class="text-danger">**</span></label>
                    <input type="date" class="form-control" id="fechaFin" name="fechaFin"
                        value="{{ $evento->fechaFin }}" required>
                    <div class="invalid-feedback">Por favor, ingrese la fecha de fin.</div>
                </div>
                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <input type="file" placeholder="Seleccione una imagen" class="form-control" id="imagen" name="imagen">
                    @if ($evento->imagen)
                        <img src="{{ asset($evento->imagen) }}" alt="Imagen del evento" class="img-fluid mt-2"
                            width="120px">
                    @endif
                </div>
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio (opcional)</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option disabled value="">Seleccione un comercio</option>
                        @foreach ($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}"
                                {{ $evento->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>
                                {{ $comercio->nombreComercio }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
                </div>

                <div class="col-12 d-flex justify-content-center gap-2">
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('editarEventoForm').addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault();
                Swal.fire({
                    icon: "success",
                    title: "El evento ha sido actualizado",
                    showConfirmButton: false,
                    timer: 2100
                });
                setTimeout(() => {
                    this.submit();
                }, 1600);
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
        const telefonoInput = document.getElementById("telefonoEvento");

        function aplicarFormatoTelefono() {
            let value = telefonoInput.value.replace(/\D/g, "");

            if (value.startsWith("506")) {
                value = value.slice(3);
            }

            if (value.length > 4) {
                value = value.slice(0, 4) + '-' + value.slice(4, 8);
            } else {
                value = value.slice(0, 4);
            }

            telefonoInput.value = "+506 " + value;
        }

        telefonoInput.addEventListener("input", aplicarFormatoTelefono);

        telefonoInput.addEventListener("focus", function() {
            if (!telefonoInput.value.startsWith("+506")) {
                telefonoInput.value = "+506 ";
            }
        });
    });
    </script>
@endsection
