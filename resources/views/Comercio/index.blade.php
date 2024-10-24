@extends('layout.administracion')

@section('content')
    <h1 id="title" class="card-title">Lista de Comercios</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @can('crear-comercio')
                        <a href="{{ route('comercios.create') }}" class="btn btn-success btn-sm" title="Crear">
                            <i class="bi bi-check-circle"></i> Crear
                        </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Negocio</th>
                                        <th>Teléfono</th>
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
                                    <td>{{ $comercio->telefonoComercio }}</td>
                                    <td>
                                        @if ($comercio->imagen)
                                            <img src="{{asset($comercio->imagen)}}" alt="{{$comercio->nombreComercio}}" class="img-fluid" width="120px">
                                        @else
                                            <span>No disponible</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            @can('ver-comercio')
                                                <a href="{{ route('comercios.show', $comercio->idComercio) }}" class="btn btn-info me-1 w-80" title="Ver">
                                                    <i class="bi bi-eye"></i> Ver
                                                </a>
                                            @endcan

                                            @can('editar-comercio')
                                                <a href="{{ route('comercios.edit', $comercio->idComercio) }}" class="btn btn-warning me-1 w-80" title="Editar">
                                                    <i class="bi bi-exclamation-triangle"></i> Editar
                                                </a>
                                            @endcan

                                            @can('borrar-comercio')
                                                <form action="{{ route('comercios.destroy', $comercio->idComercio) }}" method="POST" class="form-eliminar w-80" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger w-100" title="Eliminar">
                                                        <i class="bi bi-exclamation-octagon"></i> Eliminar
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

    <!-- Script para el SweetAlert en la eliminación -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
