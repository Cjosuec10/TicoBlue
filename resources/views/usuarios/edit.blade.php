@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <!-- Formulario para editar usuario -->
            <form id="editarUsuarioForm" action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')

                <!-- Nombre del Usuario -->
                <div class="col-md-6">
                    <label for="nombreUsuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreUsuario" name="nombre" value="{{ $usuario->nombre }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del usuario.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Correo del Usuario -->
                <div class="col-md-6">
                    <label for="correoUsuario" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correoUsuario" name="correo" value="{{ $usuario->correo }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo electrónico válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Teléfono del Usuario -->
                <div class="col-md-6">
                    <label for="telefonoUsuario" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoUsuario" name="telefono" value="{{ $usuario->telefono }}">
                    <div class="invalid-feedback">
                        Por favor, ingrese un número de teléfono válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Rol del Usuario -->
                <div class="col-md-6">
                    <label for="rolUsuario" class="form-label">Rol</label>
                    <select class="form-select" id="rolUsuario" name="rol" required>
                        <option disabled value="">Seleccione un rol</option>
                        <option value="Administrador" {{ $usuario->rol == 'Administrador' ? 'selected' : '' }}>Administrador</option>
                        <option value="Usuario" {{ $usuario->rol == 'Usuario' ? 'selected' : '' }}>Usuario</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un rol.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Contraseña del Usuario (opcional) -->
                <div class="col-md-6">
                    <label for="contrasenaUsuario" class="form-label">Nueva Contraseña (opcional)</label>
                    <input type="password" class="form-control" id="contrasenaUsuario" name="contrasena">
                    <div class="invalid-feedback">
                        Por favor, ingrese una contraseña válida.
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="col-md-6">
                    <label for="confirmarContrasena" class="form-label">Confirmar Nueva Contraseña</label>
                    <input type="password" class="form-control" id="confirmarContrasena" name="contrasena_confirmation">
                    <div class="invalid-feedback">
                        Por favor, confirme la nueva contraseña.
                    </div>
                </div>

                <!-- Botón para Actualizar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Actualizar -->
                    <button class="btn btn-success" type="submit">Actualizar</button>

                    <!-- Botón Volver -->
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">
                        Volver
                    </button>
                </div>
                
            </form>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('editarUsuarioForm').addEventListener('submit', function(event) {
            // Verifica si el formulario es válido
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault(); // Evita que el formulario se envíe inmediatamente

                // Muestra la alerta rápida si el formulario es válido
                Swal.fire({
                    icon: "success",
                    title: "El usuario ha sido actualizado",
                    showConfirmButton: false,
                    timer: 2100
                });

                // Envía el formulario después de un breve retraso para permitir que se muestre la alerta
                setTimeout(() => {
                    this.submit();
                }, 1600); // Espera 1.6 segundos para que el SweetAlert desaparezca
            }
        });
    </script>
@endsection
