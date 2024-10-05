@extends('layout.administracion')

@section('content')
<div class="container mt-5">
    <h1>Detalles de la Reservación</h1>

    <div class="card">
        <div class="card-header bg-primary text-white">
            Detalles de la Reservación de {{ $reservacion->nombreUsuarioReservacion }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Fecha de Inicio:</strong> {{ $reservacion->fechaInicio }}</p>
                    <p><strong>Fecha de Fin:</strong> {{ $reservacion->fechaFin }}</p>
                    <p><strong>Correo del Usuario:</strong> {{ $reservacion->correoUsuarioReservacion }}</p>
                    <p><strong>Teléfono del Usuario:</strong> {{ $reservacion->telefonoUsuarioReservacion }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Comercio:</strong> {{ $reservacion->comercio->nombreComercio ?? 'No asignado' }}</p>
                    <p><strong>Evento:</strong> {{ $reservacion->evento->nombreEvento ?? 'No asignado' }}</p>
                    <p><strong>Usuario:</strong> {{ $reservacion->usuario->nombreUsuario ?? 'No asignado' }}</p>
                    <p><strong>Alojamiento:</strong> {{ $reservacion->alojamiento->nombreAlojamiento ?? 'No asignado' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('reservaciones.index') }}" class="btn btn-primary">
            Regresar a la lista
        </a>
    </div>
</div>
@endsection
