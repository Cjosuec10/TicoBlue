@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Reservación</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('reservaciones.update', $reservacion->idReservacion) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Nombre del Usuario -->
                <div class="mb-3">
                    <label for="nombreUsuarioReservacion" class="form-label">Nombre del Usuario</label>
                    <input type="text" name="nombreUsuarioReservacion" id="nombreUsuarioReservacion" class="form-control"
                        value="{{ old('nombreUsuarioReservacion', $reservacion->nombreUsuarioReservacion) }}" required>
                </div>

                <!-- Correo del Usuario -->
                <div class="mb-3">
                    <label for="correoUsuarioReservacion" class="form-label">Correo del Usuario</label>
                    <input type="email" name="correoUsuarioReservacion" id="correoUsuarioReservacion" class="form-control"
                        value="{{ old('correoUsuarioReservacion', $reservacion->correoUsuarioReservacion) }}" required>
                </div>

                <!-- Teléfono del Usuario -->
                <div class="mb-3">
                    <label for="telefonoUsuarioReservacion" class="form-label">Teléfono del Usuario</label>
                    <input type="text" name="telefonoUsuarioReservacion" id="telefonoUsuarioReservacion"
                        class="form-control"
                        value="{{ old('telefonoUsuarioReservacion', $reservacion->telefonoUsuarioReservacion) }}">
                </div>

                <!-- Selección de Comercio -->
                <div class="mb-3">
                    <label for="idComercio_fk" class="form-label">Comercio</label>
                    <select name="idComercio_fk" id="idComercio_fk" class="form-select" required>
                        @foreach ($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}"
                                {{ $reservacion->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>
                                {{ $comercio->nombreComercio }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Selección de Evento (opcional) -->
                <div class="mb-3">
                    <label for="idEvento_fk" class="form-label">Evento (opcional)</label>
                    <select name="idEvento_fk" id="idEvento_fk" class="form-select">
                        <option value="">Seleccione un evento</option>
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->idEvento }}"
                                {{ $reservacion->idEvento_fk == $evento->idEvento ? 'selected' : '' }}>
                                {{ $evento->nombreEvento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Selección de Usuario -->
                <div class="col-md-6">
                    <label for="idUsuario_fk" class="form-label">Usuario</label>
                    <select class="form-select" id="idUsuario_fk" name="idUsuario_fk" required>
                        <option disabled value="">Seleccione un usuario</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->idUsuario }}"
                                {{ $usuario->idUsuario == $reservacion->idUsuario_fk ? 'selected' : '' }}>
                                {{ $usuario->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un usuario.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Selección de Alojamiento (opcional) -->
                <div class="mb-3">
                    <label for="idAlojamiento_fk" class="form-label">Alojamiento (opcional)</label>
                    <select name="idAlojamiento_fk" id="idAlojamiento_fk" class="form-select">
                        <option value="">Seleccione un alojamiento</option>
                        @foreach ($alojamientos as $alojamiento)
                            <option value="{{ $alojamiento->idAlojamiento }}"
                                {{ $reservacion->idAlojamiento_fk == $alojamiento->idAlojamiento ? 'selected' : '' }}>
                                {{ $alojamiento->nombreAlojamiento }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('reservaciones.index') }}" class="btn btn-secondary">Volver</a>
                    <button type="submit" class="btn btn-primary">Actualizar Reservación</button>
                </div>
            </form>
        </div>
    </div>
@endsection