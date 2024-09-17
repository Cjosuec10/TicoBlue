@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Lista de Comercios</h1>

    <section class="section">
        <div class="row">
          <div class="col-lg-12">

            <div class="card">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <a href="{{ route('comercios.create') }}" class="btn btn-success" title="Crear">
                    <i class="bi bi-check-circle"></i> Crear
                </a>
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Tipo de Negocio</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Descripción</th>
                            <th>Imagen</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($comercios as $comercio)
                            <tr>
                                <td>{{ $comercio->idComercio }}</td>
                                <td>{{ $comercio->nombreComercio }}</td>
                                <td>{{ $comercio->tipoNegocio }}</td>
                                <td>{{ $comercio->correoComercio }}</td>
                                <td>{{ $comercio->telefonoComercio }}</td>
                                <td>{{ $comercio->descripcionComercio }}</td>
                                <td>
                                    <img src="{{asset($comercio->imagen)}}" alt="{{$comercio->imagen}}" class="img-fluid" width="120px">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <!-- Botón Editar -->
                                        <a href="{{ route('comercios.edit', $comercio->idComercio) }}" class="btn btn-warning me-1 w-80" title="Editar">
                                            <i class="bi bi-exclamation-triangle"></i> Editar
                                        </a>

                                        <!-- Botón Eliminar -->
                                        <form action="{{ route('comercios.destroy', $comercio->idComercio) }}" method="POST" class="form-eliminar w-80" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100" title="Eliminar">
                                                <i class="bi bi-exclamation-octagon"></i> Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para el SweetAlert en la eliminación -->
    <script>
        // Esperar a que el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function () {
            // Función para asignar el evento de confirmación a los formularios de eliminación
            function setDeleteEventListeners() {
                document.querySelectorAll('.form-eliminar').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Evitar que el formulario se envíe de inmediato

                        Swal.fire({
                            title: '¿Estás seguro?',
                            text: "¡No podrás revertir esto!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Sí, eliminarlo',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Si el usuario confirma, se envía el formulario
                                form.submit();
                            }
                        });
                    });
                });
            }

            // Asignar los eventos al cargar la página
            setDeleteEventListeners();

            // Si estás haciendo algún tipo de actualización dinámica de la tabla, deberías
            // llamar a setDeleteEventListeners() nuevamente después de actualizar la tabla
        });
    </script>
@endsection
