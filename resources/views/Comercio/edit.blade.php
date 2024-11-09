@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Comercio</h1>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"></h1>
            <form id="editarComercioForm" action="{{ route('comercios.update', $comercio->idComercio) }}" method="POST"
                enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Nombre del Comercio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label">Nombre del Comercio<span class="text-danger">**</span></label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio"
                        value="{{ $comercio->nombreComercio }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del comercio.
                    </div>
                </div>

                <!-- Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio<span class="text-danger">**</span></label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" required>
                        <option selected disabled value="">Seleccione el tipo de negocio</option>
                        <option value="Soda" {{ $comercio->tipoNegocio == 'Soda' ? 'selected' : '' }}>Soda</option>
                        <option value="Restaurante" {{ $comercio->tipoNegocio == 'Restaurante' ? 'selected' : '' }}>Restaurante</option>
                        <option value="Cafeterías" {{ $comercio->tipoNegocio == 'Cafeterías' ? 'selected' : '' }}>Cafeterías</option>
                        <option value="Mercados locales" {{ $comercio->tipoNegocio == 'Mercados locales' ? 'selected' : '' }}>Mercados locales</option>
                        <option value="Tiendas de artesanías" {{ $comercio->tipoNegocio == 'Tiendas de artesanías' ? 'selected' : '' }}>Tiendas de artesanías</option>
                        <option value="Talleres" {{ $comercio->tipoNegocio == 'Talleres' ? 'selected' : '' }}>Talleres</option>
                        <option value="Deportes y Ocio" {{ $comercio->tipoNegocio == 'Deportes y Ocio' ? 'selected' : '' }}>Deportes y Ocio</option>
                        <option value="Alojamientos" {{ $comercio->tipoNegocio == 'Alojamientos' ? 'selected' : '' }}>Alojamientos</option>
                        <option value="Arte y Entretenimiento" {{ $comercio->tipoNegocio == 'Arte y Entretenimiento' ? 'selected' : '' }}>Arte y Entretenimiento</option>
                        <option value="Educación" {{ $comercio->tipoNegocio == 'Educación' ? 'selected' : '' }}>Educación</option>
                        <option value="Otros" {{ $comercio->tipoNegocio == 'Otros' ? 'selected' : '' }}>Otros</option>
                    </select>                    
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de negocio.
                    </div>
                </div>

                <!-- Correo del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label">Correo<span class="text-danger">**</span></label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio"
                        value="{{ $comercio->correoComercio }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                </div>

                <!-- País (Código de País) -->
                <div class="col-6" hidden>
                    <label for="country" class="form-label">País</label>
                    <select id="country" class="form-select">
                        <option value="506" data-country="Costa Rica" selected>Costa Rica (+506)</option>
                    </select>
                </div>

                <!-- Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono (opcional)</label>
                    <input type="tel" class="form-control" id="telefonoComercio" name="telefonoComercio"
                        value="{{ substr($comercio->telefonoComercio, 0, 4) }} {{ substr($comercio->telefonoComercio, 4) }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción (opcional)</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio" rows="4" required>{{ $comercio->descripcionComercio }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                </div>

                <!-- Dirección URL -->
                <div class="col-md-12">
                    <label for="direccion_url" class="form-label">ID de Mapa de Google (opcional)</label>
                    <textarea class="form-control" id="direccion_url" name="direccion_url" rows="3">{{ old('direccion_url', $comercio->direccion_url ?? '') }}</textarea>
                    <div class="invalid-feedback">
                        Asegúrese de que el ID del Mapa de Google tenga menos de 500 caracteres.
                    </div>
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-12">
                    <label for="direccion_texto" class="form-label">Dirección (opcional)</label>
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
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('editarComercioForm').addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault();
                Swal.fire({
                    icon: "success",
                    title: "El comercio ha sido actualizado",
                    showConfirmButton: false,
                    timer: 2100
                });
                setTimeout(() => { this.submit(); }, 1600);
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            const telefonoInput = document.getElementById("telefonoComercio");

            function aplicarFormatoTelefono() {
                let value = telefonoInput.value.replace(/\D/g, "");
                if (value.startsWith("506")) { value = value.slice(3); }
                if (value.length > 4) { value = value.slice(0, 4) + '-' + value.slice(4, 8); }
                else { value = value.slice(0, 4); }
                telefonoInput.value = "+506 " + value;
            }

            telefonoInput.addEventListener("input", aplicarFormatoTelefono);
            telefonoInput.addEventListener("focus", function() {
                if (!telefonoInput.value.startsWith("+506")) { telefonoInput.value = "+506 "; }
            });
        });
    </script>
@endsection
