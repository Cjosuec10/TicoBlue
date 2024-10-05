@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar alojamiento -->
            <form id="editarAlojamientoForm" action="{{ route('alojamientos.update', $alojamiento->idAlojamiento) }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                
                <!-- Nombre del Alojamiento -->
                <div class="col-md-6">
                    <label for="nombreAlojamiento" class="form-label">Nombre del Alojamiento</label>
                    <input type="text" class="form-control" id="nombreAlojamiento" name="nombreAlojamiento" value="{{ $alojamiento->nombreAlojamiento }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del alojamiento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Precio del Alojamiento -->
                <div class="col-md-6">
                    <label for="precioAlojamiento" class="form-label">Precio por Noche</label>
                    <input type="number" step="0.01" class="form-control" id="precioAlojamiento" name="precioAlojamiento" value="{{ $alojamiento->precioAlojamiento }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el precio por noche.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Capacidad -->
                <div class="col-md-6">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad" value="{{ $alojamiento->capacidad }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la capacidad.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Selección de Comercio (deshabilitado) -->
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk_disabled" disabled>
                        <option selected disabled value="">Seleccione un comercio</option>
                        @foreach($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}" {{ $alojamiento->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>
                                {{ $comercio->nombreComercio }}
                            </option>
                        @endforeach
                    </select>
                    <input type="hidden" name="idComercio_fk" value="{{ $alojamiento->idComercio_fk }}">
                    <div class="invalid-feedback">
                        Por favor, seleccione un comercio.
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
        document.getElementById('editarAlojamientoForm').addEventListener('submit', function(event) {
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
                    title: "El alojamiento ha sido actualizado",
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
