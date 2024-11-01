@extends('layout.administracion')

@section('content')
    <div class="container">
        <h1 class="card-title text-center my-4">Detalles de la Reservación</h1>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Reservación de: <strong>{{ $reservacion->nombreUsuarioReservacion ?? 'Usuario no especificado' }}</strong></h5>
                
                <!-- Información del Usuario -->
                <p><strong>Correo del Usuario:</strong> {{ $reservacion->correoUsuarioReservacion ?? 'No proporcionado' }}</p>
                <p><strong>Teléfono del Usuario:</strong> {{ $reservacion->telefonoUsuarioReservacion ?? 'No proporcionado' }}</p>

                <!-- Información del Comercio, Evento y Alojamiento -->
                <p><strong>Comercio Asociado:</strong> {{ $reservacion->comercio->nombreComercio ?? 'N/A' }}</p>
                <p><strong>Evento:</strong> {{ $reservacion->evento->nombreEvento ?? 'N/A' }}</p>
                <p><strong>Alojamiento:</strong> {{ $reservacion->alojamiento->nombreAlojamiento ?? 'N/A' }}</p>

                <!-- Botón para Volver -->
                <div class="d-flex justify-content-center mt-4">
                    <a href="{{ route('reservaciones.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
@endsection
