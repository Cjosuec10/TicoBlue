@extends('layout.administracion')

@section('content')
    <h1 class="card-title text-center">Detalles del Comercio</h1>

    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <form class="row g-4">
                @csrf

                <!-- Nombre del Comercio y Tipo de Negocio -->
                <div class="col-md-6">
                    <label for="nombreComercio" class="form-label">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" value="{{ $comercio->nombreComercio }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" disabled>
                        <option disabled value="">Seleccione el tipo de negocio</option>
                        <option value="Alimentación y Bebidas" {{ $comercio->tipoNegocio == 'Alimentación y Bebidas' ? 'selected' : '' }}>Alimentación y Bebidas</option>
                        <option value="Salud y Belleza" {{ $comercio->tipoNegocio == 'Salud y Belleza' ? 'selected' : '' }}>Salud y Belleza</option>
                        <option value="Moda y Accesorios" {{ $comercio->tipoNegocio == 'Moda y Accesorios' ? 'selected' : '' }}>Moda y Accesorios</option>
                        <option value="Hogar y Decoración" {{ $comercio->tipoNegocio == 'Hogar y Decoración' ? 'selected' : '' }}>Hogar y Decoración</option>
                        <option value="Tecnología y Electrónica" {{ $comercio->tipoNegocio == 'Tecnología y Electrónica' ? 'selected' : '' }}>Tecnología y Electrónica</option>
                    </select>
                </div>

                <!-- Correo y Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio" value="{{ $comercio->correoComercio }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComercio" name="telefonoComercio" value="{{ $comercio->telefonoComercio }}" disabled>
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio" rows="3" disabled>{{ $comercio->descripcionComercio }}</textarea>
                </div>

                <!-- Imagen y Mapa de Ubicación -->
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <label for="imagen" class="form-label">Imagen</label>
                    @if ($comercio->imagen)
                        <img src="{{ asset($comercio->imagen) }}" alt="Imagen del comercio" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 8px;">
                    @else
                        <p>No disponible</p>
                    @endif
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    @if ($comercio->direccion_url)
                        <label for="mapa" class="form-label">Mapa de Ubicación</label>
                        <iframe
                            width="100%"
                            height="250"
                            style="border:0; border-radius: 8px;"
                            loading="lazy"
                            allowfullscreen
                            src="https://www.google.com/maps/embed?pb={{ $comercio->direccion_url }}">
                        </iframe>
                    @else
                        <p>No hay información de ubicación disponible para este comercio.</p>
                    @endif
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-12">
                    <label for="direccion_texto" class="form-label">Dirección (Texto)</label>
                    <input type="text" class="form-control" id="direccion_texto" name="direccion_texto" value="{{ $comercio->direccion_texto }}" disabled>
                </div>

                <!-- Botón para volver -->
                <div class="col-12 d-flex justify-content-center gap-2 mt-4">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
