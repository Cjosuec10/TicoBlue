@extends('layout.administracion')

@section('content')
    <h1 class="card-title text-center" id="title">Información del Comercio</h1>

    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <form class="row g-4">
                @csrf

                <!-- Nombre del Comercio y Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label" id="label-nombreComercio">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio"
                        value="{{ $comercio->nombreComercio }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label" id="label-tipoNegocio">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" disabled>
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
                </div>

                <!-- Correo y Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label" id="label-correoComercio">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio"
                        value="{{ $comercio->correoComercio }}" disabled>
                </div>


                <!-- Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComercio" name="telefonoComercio"
                        value="{{ $comercio->codigoPais }} {{ substr($comercio->telefonoComercio, 0, 4) }} {{ substr($comercio->telefonoComercio, 4) }}"
                        disabled>
                </div>


                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label" id="label-descripcionComercio">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio" rows="3" disabled>{{ $comercio->descripcionComercio }}</textarea>
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6 d-flex flex-column align-items-start">
                    <label for="imagen" id="label-imagen" class="form-label">Imagen</label>
                    @if ($comercio->imagen)
                        <img src="{{ asset($comercio->imagen) }}" alt="Imagen del comercio" class="img-fluid"
                            style="max-width: auto; height: 250px; border-radius: 8px;">
                    @else
                        <p>No disponible</p>
                    @endif
                </div>

                <!-- Dirección URL -->
                <div class="col-md-6 d-flex flex-column align-items-start">
                    <label for="mapa" class="form-label">Mapa de Ubicación</label>
                    @if ($comercio->direccion_url)
                        <iframe width="100%" height="250" style="border:0; border-radius: 8px;" loading="lazy"
                            allowfullscreen src="https://www.google.com/maps/embed?pb={{ $comercio->direccion_url }}">
                        </iframe>
                    @else
                        <p>No hay información de ubicación disponible para este comercio.</p>
                    @endif
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-12">
                    <label for="direccion_texto" class="form-label" id="label-direccion_texto">Dirección (Texto)</label>
                    <textarea class="form-control" id="direccion_texto" name="direccion_texto" rows="4" disabled>{{ $comercio->direccion_texto }}</textarea>
                </div>

                <!-- Botón para volver -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary"
                        onclick="window.history.back();">{{ __('Volver') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/Idioma.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var telefonoInput = document.getElementById("telefonoComercio");
            var telefono = telefonoInput.value;

            // Aplica el formato deseado con guiones
            telefono = telefono.replace(/(\d{4})(\d{4})$/, "$1-$2");

            // Actualiza el valor del input
            telefonoInput.value = telefono;
        });
    </script>
@endsection
