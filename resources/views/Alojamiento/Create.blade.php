@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <!-- Agregamos el id "crearAlojamientoForm" al formulario -->
            <form id="crearAlojamientoForm" action="{{ route('alojamiento.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- Nombre del Alojamiento -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="nombreAlojamiento" class="form-label">Nombre del Alojamiento</label>
                    <input type="text" class="form-control" id="nombreAlojamiento" name="nombreAlojamiento" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del alojamiento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Descripción del Alojamiento -->
                <div class="col-md-12">
                    <label for="descripcionAlojamiento" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionAlojamiento" name="descripcionAlojamiento" required></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Precio del Alojamiento -->
                <div class="col-md-6">
                    <label for="precioAlojamiento" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="precioAlojamiento" name="precioAlojamiento" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el precio del alojamiento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagen" >Imagen</label>
                    <input type="file" id="imagen" name="imagen">
                </div>
                <!-- Capacidad del Alojamiento -->
                <div class="col-md-6">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la capacidad del alojamiento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Selección de Usuario -->
        <!-- Selección de Usuario -->
<div class="col-md-6">
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
    <div class="valid-feedback">
        ¡Correcto!
    </div>
</div>

<!-- Selección de Comercio -->
<div class="col-md-6">
    <label for="idComercio_fk" class="form-label">Comercio</label>
    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
        <option selected disabled value="">Seleccione un comercio</option>
        @foreach($comercios as $comercio)
            <option value="{{ $comercio->idComercio }}">{{ $comercio->nombreComercio }}</option>
        @endforeach
    </select>
    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
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
        document.getElementById('crearAlojamientoForm').addEventListener('submit', function(event) {
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault();

                Swal.fire({
                    icon: "success",
                    title: "El alojamiento ha sido creado",
                    showConfirmButton: false,
                    timer: 2100
                });

                setTimeout(() => {
                    this.submit();
                }, 1600);
            }
        });
    </script>
@endsection
