@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Evento</h1>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"></h1>
            <form id="crearEventoForm" action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data"
                class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-6">
                    <label for="nombreEvento" class="form-label">Nombre del Evento<span class="text-danger">**</span></label>
                    <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" placeholder="Ingrese el nombre del evento" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="descripcionEvento" class="form-label">Descripción del Evento<span class="text-danger">**</span></label>
                    <input type="text" class="form-control" id="descripcionEvento" name="descripcionEvento" placeholder="Breve descripción del evento" required>
                    <div class="invalid-feedback">Por favor, ingrese la descripción del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="tipoEvento" class="form-label">Tipo de Evento<span class="text-danger">**</span></label>
                    <select class="form-select" id="tipoEvento" name="tipoEvento" required>
                        <option selected disabled value="">Seleccione el tipo de evento</option>
                        <option value="Concierto">Concierto</option>
                        <option value="Deporte">Deporte</option>
                        <option value="Exposición">Exposición</option>
                        <option value="Feria">Feria</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Educativo">Educativo</option>
                        <option value="Social">Social</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de evento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="correoEvento" class="form-label">Correo<span class="text-danger">**</span></label>
                    <input type="email" class="form-control" id="correoEvento" name="correoEvento" placeholder="ejemplo@correo.com" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <div class="col-12" hidden>
                    <label for="country" class="form-label">País</label>
                    <select id="country" class="form-select">
                        <option value="506" data-country="Costa Rica" selected>Costa Rica (+506)</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="telefonoEvento" class="form-label">Teléfono (opcional)</label>
                    <input type="tel" class="form-control" id="telefonoEvento" name="telefonoEvento" placeholder="+506 XXXX-XXXX">
                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="direccionEvento" class="form-label">Dirección (opcional)</label>
                    <input type="text" class="form-control" id="direccionEvento" name="direccionEvento" placeholder="Dirección del evento">
                </div>
                <div class="col-md-6">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio<span class="text-danger">**</span></label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" required>
                    <div class="invalid-feedback">Por favor, ingrese la fecha de inicio.</div>
                </div>
                <div class="col-md-6">
                    <label for="fechaFin" class="form-label">Fecha de Fin<span class="text-danger">**</span></label>
                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" required>
                    <div class="invalid-feedback">Por favor, ingrese la fecha de fin.</div>
                </div>
                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen (opcional)</label>
                    <input type="file" class="form-control" id="imagen" name="imagen" placeholder="Seleccione una imagen">
                </div>
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio<span class="text-danger">**</span></label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option selected disabled value="">Seleccione un comercio</option>
                        @foreach ($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}">{{ $comercio->nombreComercio }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
                </div>
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.getElementById('crearEventoForm').addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                Swal.fire({
                    icon: "success",
                    title: "El evento ha sido creado",
                    showConfirmButton: false,
                    timer: 2100
                });
                setTimeout(() => {
                    this.submit();
                }, 1600);
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const inputPhone = document.querySelector("#telefonoEvento");
            const selectCountry = document.querySelector("#country");
            const form = document.querySelector("#crearEventoForm");

            selectCountry.addEventListener("change", function() {
                const countryCode = selectCountry.value;
                inputPhone.value = "+" + countryCode + " ";
            });

            inputPhone.addEventListener("input", function() {
                let value = inputPhone.value.replace(/[^\d]/g, "");
                if (value.startsWith(selectCountry.value)) {
                    value = value.slice(selectCountry.value.length);
                }
                if (value.length > 4) {
                    value = value.slice(0, 4) + '-' + value.slice(4, 8);
                }
                inputPhone.value = "+" + selectCountry.value + " " + value;
            });

            form.addEventListener("submit", function(event) {
                const countryCode = selectCountry.value;
                let value = inputPhone.value.replace(/[^\d]/g, "");
                if (value.startsWith(countryCode)) {
                    value = value.slice(countryCode.length);
                }
                value = "+" + countryCode + value;
                inputPhone.value = value;
            });
        });
    </script>
@endsection
