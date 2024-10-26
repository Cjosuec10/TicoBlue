@extends('layout.administracion')

@section('content')
    <h1 class="card-title text-center">Detalles del Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Nombre del Alojamiento</h5>
                    <p class="card-text">{{ $alojamiento->nombreAlojamiento }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Comercio</h5>
                    <p class="card-text">{{ $alojamiento->comercio->nombreComercio ?? 'N/A' }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Descripción</h5>
                    <p class="card-text">{{ $alojamiento->descripcionAlojamiento }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Precio por Noche</h5>
                    <p class="card-text">${{ $alojamiento->precioAlojamiento }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Capacidad</h5>
                    <p class="card-text">{{ $alojamiento->capacidad }} personas</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Fecha de Inicio</h5>
                    <p class="card-text">{{ \Carbon\Carbon::parse($alojamiento->fechaInicio)->format('d/m/Y') }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Fecha de Fin</h5>
                    <p class="card-text">{{ \Carbon\Carbon::parse($alojamiento->fechaFin)->format('d/m/Y') }}</p>
                </div>

                <div class="col-md-6">
                    <h5 class="card-title">Imagen del Alojamiento</h5>
                    @if ($alojamiento->imagen)
                        <img src="{{ asset($alojamiento->imagen) }}" alt="Imagen del alojamiento" class="img-fluid mt-2"
                            style="max-width: 300px;">
                    @else
                        <p>No hay imagen disponible</p>
                    @endif
                </div>
            </div>

            <div class="col-12 d-flex justify-content-center mt-4">
                <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
            </div>
        </div>
    </div>
@endsection
