@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Detalles del Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form class="row g-3">
                @csrf

                <!-- Nombre del Usuario -->
                <div class="col-md-6">
                    <label for="nombreUsuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario"
                        value="{{ $usuario->nombre }}" disabled>
                </div>

                <!-- Correo del Usuario -->
                <div class="col-md-6">
                    <label for="correoUsuario" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correoUsuario" name="correoUsuario"
                        value="{{ $usuario->correo }}" disabled>
                </div>

                <!-- Teléfono del Usuario -->
                <div class="col-md-6">
                    <label for="telefonoUsuario" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoUsuario" name="telefonoUsuario"
                        value="{{ $usuario->telefono }}" disabled>
                </div>

                <!-- Rol del Usuario -->
                <div class="col-md-6">
                    <label for="rolUsuario" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="rolUsuario" name="rolUsuario"
                        value="{{ $roles->implode(', ') }}" disabled>
                </div>

                <!-- Botón para volver -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
