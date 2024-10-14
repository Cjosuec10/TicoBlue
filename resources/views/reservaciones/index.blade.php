@extends('layout.administracion')


@section('content')
    <h1 class="card-title">Lista de Reservaciones</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @can('crear-reservacion')
                        <a href="{{ route('reservaciones.create') }}" class="btn btn-success btn-sm" title="Crear">
                            <i class="bi bi-plus-circle"></i> Crear
                        </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha de Inicio</th>
                                        <th>Fecha de Fin</th>
                                        <th>Comercio</th>
                                        <th>Evento</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservaciones as $reservacion)
                                        <tr>
                                            <td>{{ $reservacion->idReservacion }}</td>
                                            <td>{{ $reservacion->fechaInicio }}</td>
                                            <td>{{ $reservacion->fechaFin }}</td>
                                            <td>{{ $reservacion->comercio->nombreComercio ?? 'N/A' }}</td>
                                            <td>{{ $reservacion->evento->nombreEvento ?? 'N/A' }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <!-- Botón Ver -->
                                                    @can('ver-reservacion')
                                                    <a href="{{ route('reservaciones.show', $reservacion->idReservacion) }}" class="btn btn-info btn-sm me-1 w-80"  title="Ver">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </a>
                                                    @endcan
                                                    @can('editar-reservacion')
                                                    <a href="{{ route('reservaciones.edit', $reservacion->idReservacion) }}" class="btn btn-warning btn-sm me-1 w-80"  title="Editar">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </a>
                                                    @endcan
                                                    @can('borrar-reservacion')
                                                    <form action="{{ route('reservaciones.destroy', $reservacion->idReservacion) }}" method="POST" class="form-eliminar" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm w-100" title="Eliminar">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                    @endcan
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
