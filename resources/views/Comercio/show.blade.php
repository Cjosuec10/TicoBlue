@extends('layout.administracion')

@section('content')
    <div class="flags" id="flags">
        <div class="flags__item" data-language="es" onclick="selectLanguage('es')">
            <img src="/assets/icons/cr.svg" alt="Español">
        </div>
        <div class="flags__item" data-language="en" onclick="selectLanguage('en')">
            <img src="/assets/icons/us.svg" alt="English">
        </div>
    </div>

    <h1 class="card-title" id="title">Información del Comercio</h1>

    <div class="card mx-auto" style="max-width: 800px;">
        <div class="card-body">
            <form class="row g-4">
                @csrf

                <!-- Nombre del Comercio y Tipo de Negocio -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="nombreComercio" class="form-label" id="label-nombreComercio">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" value="{{ $comercio->nombreComercio }}" disabled>
                </div>
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="tipoNegocio" class="form-label" id="label-tipoNegocio">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" disabled>
                        <option disabled value="">{{ __('Seleccione el tipo de negocio') }}</option>
                        <option value="Alimentación y Bebidas" {{ $comercio->tipoNegocio == 'Alimentación y Bebidas' ? 'selected' : '' }}>{{ __('Alimentación y Bebidas') }}</option>
                        <option value="Salud y Belleza" {{ $comercio->tipoNegocio == 'Salud y Belleza' ? 'selected' : '' }}>{{ __('Salud y Belleza') }}</option>
                        <option value="Moda y Accesorios" {{ $comercio->tipoNegocio == 'Moda y Accesorios' ? 'selected' : '' }}>{{ __('Moda y Accesorios') }}</option>
                        <option value="Hogar y Decoración" {{ $comercio->tipoNegocio == 'Hogar y Decoración' ? 'selected' : '' }}>{{ __('Hogar y Decoración') }}</option>
                        <option value="Tecnología y Electrónica" {{ $comercio->tipoNegocio == 'Tecnología y Electrónica' ? 'selected' : '' }}>{{ __('Tecnología y Electrónica') }}</option>
                    </select>
                </div>

                <!-- Correo y Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label" id="label-correoComercio">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio" value="{{ $comercio->correoComercio }}" disabled>
                </div>
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label" id="label-telefonoComercio">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComercio" name="telefonoComercio" value="{{ $comercio->telefonoComercio }}" disabled>
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label" id="label-descripcionComercio">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio" disabled>{{ $comercio->descripcionComercio }}</textarea>
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagen" id="label-imagen">Imagen</label>
                    @if ($comercio->imagen)
                        <img src="{{ asset($comercio->imagen) }}" alt="Imagen del comercio" class="img-fluid" style="max-width: 100%; height: auto; border-radius: 8px;">
                    @else
                        <p>No disponible</p>
                    @endif
                </div>

                <!-- Dirección URL -->
                <div class="col-md-6">
                    <label for="direccion_url" class="form-label" id="label-direccion_url">Dirección URL</label>
                    <p>
                        @if ($comercio->direccion_url)
                            <a href="{{ $comercio->direccion_url }}" target="_blank">{{ $comercio->direccion_url }}</a>
                        @else
                            No disponible
                        @endif
                    </p>
                </div>

                <!-- Dirección en Texto -->
                <div class="col-md-6">
                    <label for="direccion_texto" class="form-label" id="label-direccion_texto">Dirección (Texto)</label>
                    <input type="text" class="form-control" id="direccion_texto" name="direccion_texto" value="{{ $comercio->direccion_texto }}" disabled>
                </div>

                <!-- Botón para volver -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">{{ __('Volver') }}</button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/js/Idioma.js') }}"></script>
@endsection
