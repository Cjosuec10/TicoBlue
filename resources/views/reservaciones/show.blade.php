@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Detalles de la Reservación</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Reservación de: {{ $reservacion->nombreUsuarioReservacion }}</h5>
            <p><strong>Correo del Usuario:</strong> {{ $reservacion->correoUsuarioReservacion }}</p>
            <p><strong>Teléfono del Usuario:</strong> {{ $reservacion->telefonoUsuarioReservacion ?? 'No proporcionado' }}
            </p>

            <p><strong>Comercio:</strong> {{ $reservacion->comercio->nombreComercio ?? 'N/A' }}</p>
            <p><strong>Evento:</strong> {{ $reservacion->evento->nombreEvento ?? 'N/A' }}</p>
            <p><strong>Alojamiento:</strong> {{ $reservacion->alojamiento->nombreAlojamiento ?? 'N/A' }}</p>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('reservaciones.index') }}" class="btn btn-primary">Volver</a>
                <a href="{{ route('reservaciones.edit', $reservacion->idReservacion) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
@endsection
