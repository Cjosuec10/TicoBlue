@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Rol</h1>

    <div class="card">
        <div class="card-body">
            <!-- Mostrar errores si existen -->
            @if ($errors->any())
                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                    <strong>¡Revise los campos!</strong>
                    @foreach ($errors->all() as $error)
                        <span class="badge badge-danger">{{ $error }}</span>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <!-- Formulario para crear un nuevo rol -->
            <form action="{{ route('roles.store') }}" method="POST" id="crearRolForm" class="row g-3 needs-validation" novalidate>
                @csrf
                <!-- Nombre del Rol -->
                <div class="col-md-12">
                    <label for="name" class="form-label">Nombre del Rol:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del rol.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
            
                <!-- Permisos para el Rol -->
                <div class="col-md-12">
                    <label for="permissions" class="form-label">Permisos para este Rol:</label>
                    <div class="row py-3">
                        @foreach ($permissions as $value)
                            <div class="col-md-4 col-lg-3">
                                <div class="form-check">
                                    <input type="checkbox" name="permission[]" value="{{ $value->id }}" class="form-check-input" id="permission-{{ $value->id }}">
                                    <label class="form-check-label" for="permission-{{ $value->id }}">{{ $value->name }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            
                <!-- Botón para Enviar -->
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
        document.getElementById('crearRolForm').addEventListener('submit', function(event) {
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
                    title: "El rol ha sido creado",
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
