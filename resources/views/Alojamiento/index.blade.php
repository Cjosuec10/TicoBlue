@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Lista de Alojamientos</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <a href="{{ route('alojamiento.create') }}" class="btn btn-success" title="Crear">
                            <i class="bi bi-check-circle"></i> Crear
                        </a>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Capacidad</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($alojamientos as $alojamiento)
                                    <tr>
                                        <td>{{ $alojamiento->idAlojamiento }}</td>
                                        <td>{{ $alojamiento->nombreAlojamiento }}</td>
                                        <td>{{ $alojamiento->descripcionAlojamiento }}</td>
                                        <td>{{ $alojamiento->precioAlojamiento }}</td>
                                        <td>{{ $alojamiento->capacidad }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <!-- Botón Editar -->
                                                <a href="{{ route('alojamiento.edit', $alojamiento->idAlojamiento) }}" class="btn btn-warning me-1 w-80" title="Editar">
                                                    <i class="bi bi-exclamation-triangle"></i> Editar
                                                </a>

                                                <!-- Botón Eliminar -->
                                                <form action="{{ route('alojamiento.destroy', $alojamiento->idAlojamiento) }}" method="POST" class="form-eliminar w-80" style="display:inline;">
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
        document.addEventListener('DOMContentLoaded', function () {
            function setDeleteEventListeners() {
                document.querySelectorAll('.form-eliminar').forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

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
                                form.submit();
                            }
                        });
                    });
                });
            }

            setDeleteEventListeners();
        });
    </script>
@endsection