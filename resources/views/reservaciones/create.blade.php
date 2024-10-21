@extends('layout.administracion')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card w-50 p-4">
        <h1 class="text-center">Crear Nueva Reservación</h1>

        <form action="{{ route('reservaciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label for="nombreUsuarioReservacion">Nombre del Usuario:</label>
                <input type="text" name="nombreUsuarioReservacion" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="correoUsuarioReservacion">Correo del Usuario:</label>
                <input type="email" name="correoUsuarioReservacion" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="telefonoUsuarioReservacion">Teléfono:</label>
                <input type="text" name="telefonoUsuarioReservacion" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="fechaInicio">Fecha de Inicio:</label>
                <input type="date" name="fechaInicio" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="fechaFin">Fecha de Fin:</label>
                <input type="date" name="fechaFin" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="idComercio_fk" class="form-label">Comercio</label>
                <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                    <option selected disabled value="">Seleccione un comercio</option>
                    @foreach($comercios as $comercio)
                        <option value="{{ $comercio->idComercio }}">{{ $comercio->nombreComercio }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un comercio.
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="idEvento_fk" class="form-label">Evento</label>
                <select class="form-select" id="idEvento_fk" name="idEvento_fk" required>
                    <option selected disabled value="">Seleccione un evento</option>
                    @foreach($eventos as $evento)
                        <option value="{{ $evento->idEvento }}">{{ $evento->nombreEvento }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un evento.
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="idUsuario_fk" class="form-label">Usuario</label>
                <select class="form-select" id="idUsuario_fk" name="idUsuario_fk" required>
                    <option selected disabled value="">Seleccione un usuario</option>
                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->idUsuario }}">{{ $usuario->nombre }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un usuario.
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="idAlojamiento_fk" class="form-label">Alojamiento (opcional)</label>
                <select class="form-select" id="idAlojamiento_fk" name="idAlojamiento_fk">
                    <option selected disabled value="">Seleccione un alojamiento</option>
                    @foreach($alojamientos as $alojamiento)
                        <option value="{{ $alojamiento->idAlojamiento }}">{{ $alojamiento->nombreAlojamiento }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un alojamiento válido.
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Crear Reservación</button>
        </form>
    </div>
</div>
@endsection
