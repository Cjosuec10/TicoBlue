@extends('layout.administracion')

@section('content')
    <h1 class="card-title text-center">Editar Alojamiento</h1>

    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar alojamiento -->
            <form id="editarAlojamientoForm" action="{{ route('alojamiento.update', $alojamiento->idAlojamiento) }}"
                method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')


                <!-- Nombre del Alojamiento -->
                <div class="col-md-6">
                    <label for="nombreAlojamiento" class="form-label">Nombre del Alojamiento</label>
                    <input type="text" class="form-control" id="nombreAlojamiento" name="nombreAlojamiento"
                        value="{{ $alojamiento->nombreAlojamiento }}" required>
                    <input type="text" class="form-control" id="nombreAlojamiento" name="nombreAlojamiento"
                        value="{{ $alojamiento->nombreAlojamiento }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del alojamiento.
                    </div>
                </div>

                <!-- Selección de Comercio -->
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option selected disabled value="">Seleccione un comercio</option>
                        @foreach ($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}"
                                {{ $alojamiento->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>
                                {{ $comercio->nombreComercio }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
                </div>

                <!-- Descripción del Alojamiento -->
                <div class="col-md-12">
                    <label for="descripcionAlojamiento" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionAlojamiento" name="descripcionAlojamiento" rows="3" required>{{ $alojamiento->descripcionAlojamiento }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                </div>
                <!-- Descripción del Alojamiento -->
                <div class="col-md-12">
                    <label for="descripcionAlojamiento" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionAlojamiento" name="descripcionAlojamiento" required>{{ $alojamiento->descripcionAlojamiento }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <!-- Descripción del Alojamiento -->
                <div class="col-md-12">
                    <label for="descripcionAlojamiento" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionAlojamiento" name="descripcionAlojamiento" required>{{ $alojamiento->descripcionAlojamiento }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Precio del Alojamiento -->
                <div class="col-md-6">
                    <label for="precioAlojamiento" class="form-label">Precio por Noche</label>
                    <input type="number" step="0.01" class="form-control" id="precioAlojamiento"
                        name="precioAlojamiento" value="{{ $alojamiento->precioAlojamiento }}" required>
                    <input type="number" step="0.01" class="form-control" id="precioAlojamiento"
                        name="precioAlojamiento" value="{{ $alojamiento->precioAlojamiento }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el precio por noche.
                    </div>
                </div>

                <!-- Capacidad -->
                <div class="col-md-6">
                    <label for="capacidad" class="form-label">Capacidad</label>
                    <input type="number" class="form-control" id="capacidad" name="capacidad"
                        value="{{ $alojamiento->capacidad }}" required>
                    <input type="number" class="form-control" id="capacidad" name="capacidad"
                        value="{{ $alojamiento->capacidad }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la capacidad.
                    </div>
                </div>

                <!-- Imagen del Alojamiento -->
                <div class="col-md-6">
                    <label for="imagen" class="form-label">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    @if ($alojamiento->imagen)
                        <img src="{{ asset($alojamiento->imagen) }}" alt="Imagen del alojamiento" class="img-fluid mt-2"
                            width="120px">
                    @endif
                    <div class="invalid-feedback">
                        Por favor, seleccione una imagen válida.
                    </div>
                </div>

                <!-- Fecha de Inicio -->
                <div class="col-md-6">
                    <label for="fechaInicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio"
                        value="{{ $alojamiento->fechaInicio }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la fecha de inicio.
                    </div>
                </div>

                <!-- Fecha de Fin -->
                <div class="col-md-6">
                    <label for="fechaFin" class="form-label">Fecha de Fin</label>
                    <input type="date" class="form-control" id="fechaFin" name="fechaFin"
                        value="{{ $alojamiento->fechaFin }}" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese la fecha de fin.
                    </div>
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagenActual">Imagen Actual</label>
                    <div class="mb-3">
                        @if ($alojamiento->imagen)
                            <img src="{{ asset($alojamiento->imagen) }}" alt="Imagen actual del alojamiento"
                                class="img-thumbnail" style="max-width: 200px;">
                        @else
                            <p>No hay imagen disponible</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="imagen">Ingresa nueva Imagen (opcional)</label>
                    <input type="file" id="imagen" name="imagen">
                </div>

                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagenActual">Imagen Actual</label>
                    <div class="mb-3">
                        @if ($alojamiento->imagen)
                            <img src="{{ asset($alojamiento->imagen) }}" alt="Imagen actual del alojamiento"
                                class="img-thumbnail" style="max-width: 200px;">
                        @else
                            <p>No hay imagen disponible</p>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="imagen">Ingresa nueva Imagen (opcional)</label>
                    <input type="file" id="imagen" name="imagen">
                </div>

                <!-- Selección de Usuario -->
                <div class="col-md-6">
                    <label for="idUsuario_fk" class="form-label">Usuario</label>
                    <select class="form-select" id="idUsuario_fk" name="idUsuario_fk" required>
                        <option selected disabled value="">Seleccione un usuario</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->idUsuario }}"
                                {{ $alojamiento->idUsuario_fk == $usuario->idUsuario ? 'selected' : '' }}>
                                {{ $usuario->nombre }}
                            </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un usuario.
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
                }, 1600);
            }
        });
    </script>
@endsection
