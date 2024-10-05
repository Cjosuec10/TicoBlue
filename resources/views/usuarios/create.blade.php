@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Usuario</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title"></h5>
            <form id="crearUsuarioForm" action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- Nombre del Usuario -->
                <div class="col-md-6">
                    <label for="nombreUsuario" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombreUsuario" name="nombre" required>
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
                    <input type="email" class="form-control" id="correoUsuario" name="correo" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Contraseña del Usuario -->
                <div class="col-md-6">
                    <label for="contrasenaUsuario" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="contrasenaUsuario" name="contrasena" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una contraseña.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="col-md-6">
                    <label for="confirmarContrasena" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="confirmarContrasena" name="contrasena_confirmation" required>
                    <div class="invalid-feedback">
                        Por favor, confirme la contraseña.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Teléfono del Usuario -->
                <div class="col-md-6">
                    <label for="telefonoUsuario" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoUsuario" name="telefono">
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
                    <select class="form-select" id="rolUsuario" name="roles[]" required>
                        <option selected disabled value="">Seleccione un rol</option>
                        @foreach($roles as $role)
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

                <!-- Botones de acción -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Guardar -->
                    <button class="btn btn-success" type="submit">Guardar</button>

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
        document.getElementById('crearUsuarioForm').addEventListener('submit', function(event) {
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
                    title: "El usuario ha sido creado",
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
