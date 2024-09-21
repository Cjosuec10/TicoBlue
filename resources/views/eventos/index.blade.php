@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Lista de Eventos</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('eventos.create') }}" class="btn btn-success mb-3" title="Crear">
                            <i class="bi bi-plus-circle"></i> Crear
                        </a>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Evento</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Comercio</th>
                                        <th>Imagen</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($eventos as $evento)
                                        <tr>
                                            <td>{{ $evento->idEvento }}</td>
                                            <td>{{ $evento->nombreEvento }}</td>
                                            <td>{{ $evento->tipoEvento }}</td>
                                            <td>{{ $evento->correoEvento }}</td>
                                            <td>{{ $evento->telefonoEvento }}</td>
                                            <td>{{ $evento->direccionEvento }}</td>
                                            <td>{{ $evento->comercio->nombreComercio }}</td>
                                            <td>
                                                <img src="{{asset($evento->imagen)}}" alt="{{$evento->imagen}}" class="img-fluid" width="120px">
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                    <!-- Botón Ver -->
                                                    <a href="{{ route('eventos.show', $evento->idEvento) }}" class="btn btn-info me-1 w-80" title="Ver">
                                                        <i class="bi bi-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('eventos.edit', $evento->idEvento) }}" class="btn btn-warning me-1" title="Editar">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </a>
                                                    <form action="{{ route('eventos.destroy', $evento->idEvento) }}" method="POST" class="form-eliminar" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" title="Eliminar">
                                                            <i class="bi bi-trash"></i> Eliminar
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
