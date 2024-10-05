@extends('layout.administracion')

@section('content')
<div class="container">
    <h1>Lista de Reservaciones</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>


                <th>Nombre Usuario</th>
                <th>Correo</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Teléfono</th>
                <th>Comercio</th>
                <th>Evento</th>
                <th>Usuario</th>
                <th>Alojamiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reservaciones as $reservacion)
            <tr>
                {{-- <td>{{ $reservacion->idReservacion }}</td>  <!-- Si el ID es 'id' --> --}}
                <td>{{ $reservacion->nombreUsuarioReservacion }}</td>
                <td>{{ $reservacion->correoUsuarioReservacion }}</td>
                <td>{{ $reservacion->fechaInicio }}</td>
                <td>{{ $reservacion->fechaFin }}</td>
                <td>{{ $reservacion->telefonoUsuarioReservacion }}</td>
                <td>{{ $reservacion->comercio->nombreComercio ?? 'No Ingresado' }}</td>
                <td>{{ $reservacion->evento->nombreEvento ?? 'No Ingresado' }}</td>
                <td>{{ $reservacion->usuario->nombre ?? 'No Ingresado' }}</td>
                <td>{{ $reservacion->alojamiento->nombreAlojamiento ?? 'No Ingresado' }}</td>
                <td>
                    <div class="d-flex">
                        <a href="{{ route('reservaciones.show', $reservacion->idReservacion) }}" class="btn btn-warning me-1" title="Editar">
                            <i class="bi bi-pencil"></i> Ver
                        </a>

                        <a href="{{ route('reservaciones.edit', $reservacion->idReservacion) }}" class="btn btn-warning me-1" title="Editar">
                            <i class="bi bi-pencil"></i> Editar
                        </a>
                        <form action="{{ route('reservaciones.destroy', $reservacion->idReservacion) }}" method="POST" class="form-eliminar" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" title="Eliminar">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('reservaciones.create') }}" class="btn btn-success">Crear Nueva Reservación</a>
</div>
@endsection
