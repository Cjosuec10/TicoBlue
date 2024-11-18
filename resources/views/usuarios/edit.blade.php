@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <!-- Formulario para editar usuario -->
            <form id="editarUsuarioForm" action="{{ route('usuarios.update', $usuario->idUsuario) }}" method="POST"
                enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')


                <!-- Nombre del Usuario -->
                <div class="col-md-6">
                    <label for="nombreUsuario" class="form-label">Nombre<span class="text-danger">**</span></label>
                    <input type="text" placeholder="Ingrese el nombre del usuario" class="form-control"
                        id="nombreUsuario" name="nombre" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del usuario.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Correo del Usuario -->
                <div class="col-md-6">
                    <label for="correoUsuario" class="form-label">Correo Electrónico<span
                            class="text-danger">**</span></label>
                    <input type="email" placeholder="ejemplo@correo.com" class="form-control" id="correoUsuario"
                        name="correo" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Teléfono del Usuario -->
                <div class="col-md-6">
                    <label for="telefonoUsuario" class="form-label">Teléfono (opcional)</label>
                    <input type="text" placeholder="Ingrese el número de teléfono" class="form-control"
                        id="telefonoUsuario" name="telefono">
                    <div class="invalid-feedback">
                        Por favor, ingrese un número de teléfono válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Rol del Usuario -->
                <div class="col-md-6">
                    <label for="rolUsuario" class="form-label">Rol<span class="text-danger">**</span></label>
                    <select class="form-select" id="rolUsuario" name="roles[]" required>
                        <option selected disabled value="">Seleccione un rol</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un rol.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Contraseña del Usuario -->
                <div class="col-md-6">
                    <label for="contrasenaUsuario" class="form-label">Contraseña (opcional)</label>
                    <input type="password" placeholder="Ingrese una contraseña" class="form-control" id="contrasenaUsuario"
                        name="contrasena">
                    <div class="invalid-feedback">
                        Por favor, ingrese una contraseña.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="col-md-6">
                    <label for="confirmarContrasena" class="form-label">Confirmar Contraseña (opcional)</label>
                    <input type="password" placeholder="Confirme la contraseña" class="form-control"
                        id="confirmarContrasena" name="contrasena_confirmation">
                    <div class="invalid-feedback">
                        Por favor, confirme la contraseña.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
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
                }).then(() => {
                    // Envía el formulario después de que SweetAlert desaparezca
                    this.submit();
                });
            }
        });
    </script>
@endsection
