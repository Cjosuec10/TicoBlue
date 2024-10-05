@extends('layout.administracion')

@section('content')
<div class="container">
    <h1>Editar Reservación</h1>

    <form action="{{ route('reservaciones.update', $reservacion->idReservacion) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos del formulario -->
        <div class="form-group">
            <label for="nombreUsuarioReservacion">Nombre del Usuario</label>
            <input type="text" name="nombreUsuarioReservacion" value="{{ $reservacion->nombreUsuarioReservacion }}" class="form-control">
        </div>

        <!-- Más campos de la reservación -->

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>

    <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Cancelar</a>
</div>
@endsection
