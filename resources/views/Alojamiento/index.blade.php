@extends('layout.administracion')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <h1 class="card-title">Lista de Alojamientos</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @can('crear-alojamiento')
                        <a href="{{ route('alojamiento.create') }}" class="btn btn-success btn-sm" title="Crear">
                            <i class="bi bi-check-circle"></i> Crear
                        </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Precio</th>
                                    <th>Capacidad</th>
                                    <th>Imagen</th>
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
                                            @if ($alojamiento->imagen)
                                                <img src="{{asset($alojamiento->imagen)}}" alt="{{$alojamiento->nombreAlojamiento}}" class="img-fluid" width="120px">
                                            @else
                                                <span>No disponible</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                               <!-- Botón Ver -->
@can('ver-alojamiento')
<a href="{{ route('alojamiento.show',  $alojamiento->idAlojamiento) }}" class="btn btn-info btn-sm me-1 w-80" title="Ver">
    <i class="bi bi-eye"></i> Ver
</a>
@endcan

<!-- Botón Editar -->
@can('editar-alojamiento')
<a href="{{ route('alojamiento.edit', $alojamiento->idAlojamiento) }}" class="btn btn-warning btn-sm me-1 w-80" title="Editar">
    <i class="bi bi-exclamation-triangle"></i> Editar
</a>
@endcan

                                                <!-- Switch para activar/desactivar -->
            <div class="d-flex align-items-center form-check form-switch custom-switch-size ms-2">
                <input 
                    class="form-check-input toggle-activation" 
                    type="checkbox" 
                    role="switch" 
                    data-id="{{ $alojamiento->idAlojamiento }}" 
                    id="switch-{{ $alojamiento->idAlojamiento }}"
                    {{ $alojamiento->activo ? 'checked' : '' }}
                />
                <label class="form-check-label" for="switch-{{ $alojamiento->idAlojamiento }}">
                    {{ $alojamiento->activo ? 'Activo' : 'Inactivo' }}
                </label>
            </div>
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
    <style>
    .custom-switch-size .form-check-input {
        width: 40px;
        height: 20px;
        transform: scale(1.2); /* Cambia el valor si deseas hacerlo aún más grande */
    }

    .custom-switch-size .form-check-label {
        font-size: 14px;
        font-weight: bold;
        margin-left: 10px;
    }
    .btn-sm {
    padding: 4px 8px;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}

</style>
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
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-activation').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const alojamientoId = this.getAttribute('data-id');
            const isActive = this.checked;

            fetch(`/alojamientos/${alojamientoId}/toggle-activation`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ activo: isActive })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.nextElementSibling.textContent = isActive ? 'Activo' : 'Inactivo';
                } else {
                    alert('Error al cambiar el estado');
                    this.checked = !isActive;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al procesar la solicitud');
                this.checked = !isActive;
            });
        });
    });
});
    </script>
@endsection
