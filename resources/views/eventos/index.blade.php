@extends('layout.administracion')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <h1 class="card-title">Lista de Eventos</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @can('crear-evento')
                        <a href="{{ route('eventos.create') }}" class="btn btn-success btn-sm" title="Crear">
                            <i class="bi bi-plus-circle"></i> Crear
                        </a>
                        @endcan
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Tipo de Evento</th>
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
                                            <td>{{ $evento->comercio->nombreComercio }}</td>
                                            <td>
                                                <img src="{{asset($evento->imagen)}}" alt="{{$evento->imagen}}" class="img-fluid" width="120px">
                                            </td>

                                            <td>
                                                <div class="d-flex">
                                                   <!-- Botón Ver -->
@can('ver-evento')
<a href="{{ route('eventos.show', $evento->idEvento) }}" class="btn btn-info btn-sm me-1 w-80" title="Ver">
    <i class="bi bi-eye"></i> Ver
</a>
@endcan

<!-- Botón Editar -->
@can('editar-evento')
<a href="{{ route('eventos.edit', $evento->idEvento) }}" class="btn btn-warning btn-sm me-1 w-80" title="Editar">
    <i class="bi bi-exclamation-triangle"></i> Editar
</a>
@endcan

                                                    <div class="d-flex align-items-center form-check form-switch custom-switch-size ms-2">
    <input 
        class="form-check-input toggle-activation" 
        type="checkbox" 
        role="switch" 
        data-id="{{ $evento->idEvento }}" 
        id="switch-{{ $evento->idEvento }}"
        {{ $evento->activo ? 'checked' : '' }}
    />
    <label class="form-check-label" for="switch-{{ $evento->idEvento }}">
        {{ $evento->activo ? 'Activo' : 'Inactivo' }}
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
</style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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
        });
        document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-activation').forEach(switchElement => {
        switchElement.addEventListener('change', function () {
            const eventId = this.getAttribute('data-id');
            const isActive = this.checked;

            fetch(`/eventos/${eventId}/toggle-activation`, {
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
                    alert('Error al cambiar el estado del evento.');
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
