@extends('layout.administracion')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <h1 class="card-title">Lista de Comercios</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        @can('crear-comercio')
                            <a href="{{ route('comercios.create') }}" class="btn btn-success btn-sm mb-3" title="Crear">
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
                                            <td>
                                                @if ($comercio->codigoPais == '506' && strlen($comercio->telefonoComercio) == 8)
                                                    {{-- Formato para Costa Rica: +506 XXXX-XXXX --}}
                                                    {{ '+506 ' . substr($comercio->telefonoComercio, 0, 4) . '-' . substr($comercio->telefonoComercio, 4) }}
                                                @else
                                                    {{-- Formato genérico en bloques de 4 dígitos para otros países --}}
                                                    {{ '' . $comercio->codigoPais . ' ' . implode('-', str_split($comercio->telefonoComercio, 4)) }}
                                                @endif
                                            </td>



                                            <td>
                                                @if ($comercio->imagen)
                                                    <img src="{{ asset($comercio->imagen) }}"
                                                        alt="{{ $comercio->nombreComercio }}" class="img-fluid"
                                                        width="120px">
                                                @else
                                                    <span>No disponible</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @can('ver-comercio')
                                                        <a href="{{ route('comercios.show', $comercio->idComercio) }}"
                                                            class="btn btn-info btn-sm me-1 w-80" title="Ver">
                                                            <i class="bi bi-eye"></i> Ver
                                                        </a>
                                                    @endcan

                                                    @can('editar-comercio')
                                                        <a href="{{ route('comercios.edit', $comercio->idComercio) }}"
                                                            class="btn btn-warning btn-sm me-1 w-80" title="Editar">
                                                            <i class="bi bi-exclamation-triangle"></i> Editar
                                                        </a>
                                                    @endcan

                                                    <!-- Toggle Activación -->
                                                    <div
                                                        class="d-flex align-items-center form-check form-switch custom-switch-size ms-2">
                                                        <input class="form-check-input toggle-activation" type="checkbox"
                                                            role="switch" data-id="{{ $comercio->idComercio }}"
                                                            id="switch-{{ $comercio->idComercio }}"
                                                            {{ $comercio->activo ? 'checked' : '' }} />
                                                        <label class="form-check-label"
                                                            for="switch-{{ $comercio->idComercio }}">
                                                            {{ $comercio->activo ? 'Activo' : 'Inactivo' }}
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
            transform: scale(1.2);
        }

        .custom-switch-size .form-check-label {
            font-size: 14px;
            font-weight: bold;
            margin-left: 10px;
        }

        .btn {
            min-width: 80px;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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

        //         document.addEventListener("DOMContentLoaded", function() {
        //     document.querySelectorAll('tbody tr').forEach(row => {
        //         const telefonoCell = row.querySelector('td:nth-child(4)'); // Ajusta el índice si cambia la posición de la columna

        //         if (telefonoCell) {
        //             let telefono = telefonoCell.textContent.trim();
        //             let codigoPais = telefono.match(/^\+(\d+)/)?.[1] || "";
        //             let numero = telefono.replace(/^\+\d+\s*/, "").replace(/\D/g, ""); // Remueve caracteres no numéricos

        //             // Formato específico para Costa Rica (+506)
        //             if (codigoPais === "506" && numero.length === 8) {
        //                 telefono = `+506 ${numero.slice(0, 4)}-${numero.slice(4)}`;
        //             } else {
        //                 // Formatear en bloques de 4 dígitos para otros países
        //                 let formattedNumero = numero.match(/.{1,4}/g)?.join("-") || numero;
        //                 telefono = `+${codigoPais} ${formattedNumero}`;
        //             }

        //             telefonoCell.textContent = telefono;
        //         }
        //     });
        // });





        document.addEventListener('DOMContentLoaded', function() {
            // Selecciona todos los interruptores de activación
            document.querySelectorAll('.toggle-activation').forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const comercioId = this.getAttribute(
                    'data-id'); // Obtiene el ID del comercio del atributo data-id
                    const isActive = this.checked; // Comprueba si está marcado o no

                    // Envía la solicitud para activar/desactivar el comercio
                    fetch(`/comercios/${comercioId}/toggle-activation`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                activo: isActive
                            }) // Envia el estado activo/inactivo en el cuerpo de la solicitud
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Actualiza el texto del label al lado del switch
                                this.nextElementSibling.textContent = isActive ? 'Activo' :
                                    'Inactivo';
                            } else {
                                // Mostrar un mensaje de error si algo sale mal
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Error al cambiar el estado del comercio.',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                this.checked = !isActive; // Revertir el cambio si hubo un error
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Hubo un problema al procesar la solicitud.',
                                timer: 2000,
                                showConfirmButton: false
                            });
                            this.checked = !isActive; // Revertir el cambio si hubo un error
                        });
                });
            });
        });
    </script>
@endsection
