@extends('layout.inicio')
@section('title', 'Eventos')
@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- JavaScript para manejar el envío del formulario y mostrar SweetAlert -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const forms = document.querySelectorAll('.crearEventoForm');

                forms.forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Evita el envío inmediato del formulario

                        if (!form.checkValidity()) {
                            form.classList.add('was-validated');
                        } else {
                            Swal.fire({
                                icon: "success",
                                title: "Reservación realizada exitosamente",
                                text: "Gracias por realizar la reservación. ¡Te esperamos pronto!",
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                form.submit();
                            });
                        }
                    });
                });
            });
        </script>

        <!-- Título y Barra de Búsqueda -->
        <section class="events section py-5 custom-gray" id="events">
            <!-- Contenedor del Título -->
            <div class="container title-container mb-0">
                <div class="row">
                    <div class="col-12 text-center">
                        <h2 class="fw-bold">Catálogo de Eventos</h2>
                    </div>
                </div>
            </div><!-- End Title Container -->

            <!-- Contenedor de la Barra de Búsqueda -->
            <div class="container search-container mb-4">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="input-group" style="width: 100%; max-width: 300px;">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" id="search" class="form-control" placeholder="Buscar eventos..."
                                aria-label="Buscar eventos">
                            <span class="input-group-text bg-white">
                                <i class="fas fa-times" id="clear-search" style="cursor: pointer;"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div><!-- End Search Container -->

            <!-- Eventos -->
            <div class="event-wrap mt-2">
                <div class="container">
                    @if ($eventos->isEmpty())
                        <div class="text-center">
                            <p>No hay eventos disponibles en este momento.</p>
                        </div>
                    @else
                        <div class="container mt-5">
                            <div class="row">
                                @foreach ($eventos as $ev)
                                    <div class="col-lg-3 col-md-4 mb-4">
                                        <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                            <!-- Mostrar la imagen si está disponible -->
                                            @if ($ev->imagen)
                                                <img src="{{ asset($ev->imagen) }}" alt="{{ $ev->nombreEvento }}"
                                                    class="card-img-top" style="height: 150px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/default-image.jpg') }}"
                                                    alt="Imagen no disponible" class="card-img-top"
                                                    style="height: 150px; object-fit: cover;">
                                            @endif
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title text-center">{{ $ev->nombreEvento }}</h5>
                                                <p><strong>Fecha de Inicio:</strong>
                                                    {{ \Carbon\Carbon::parse($ev->fechaInicio)->format('d/m/Y') }}</p>
                                                <p><strong>Fecha de Fin:</strong>
                                                    {{ \Carbon\Carbon::parse($ev->fechaFin)->format('d/m/Y') }}</p>
                                                <!-- Botones de Ver Más y Reservar -->
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#eventoModal{{ $ev->idEvento }}">
                                                        Ver más
                                                    </button>
                                                    <button type="button" class="btn btn-secondary ms-2"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#reservarEventoModal{{ $ev->idEvento }}">
                                                        Reservar
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Ver más -->
                                    <div class="modal fade" id="eventoModal{{ $ev->idEvento }}" tabindex="-1"
                                        aria-labelledby="eventoModalLabel{{ $ev->idEvento }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                <div class="modal-header bg-light text-dark justify-content-center">
                                                    <h5 class="modal-title text-center fw-bold"
                                                        id="eventoModalLabel{{ $ev->idEvento }}"
                                                        style="font-size: 1.75rem;">
                                                        {{ $ev->nombreEvento }}
                                                    </h5>
                                                    <button type="button" class="btn-close position-absolute end-0 me-3"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($ev->imagen)
                                                        <img src="{{ asset($ev->imagen) }}" alt="{{ $ev->nombreEvento }}"
                                                            class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-image.jpg') }}"
                                                            alt="Imagen no disponible"
                                                            class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @endif
                                                    <div class="event-details">
                                                        <p class="text-success"><strong>Correo:</strong>
                                                            {{ $ev->correoEvento }}</p>
                                                        <p><strong>Teléfono:</strong> {{ $ev->telefonoEvento }}</p>
                                                        <p><strong>Dirección:</strong> {{ $ev->direccionEvento }}</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin del Modal Ver más -->
                                    <!-- Modal para el formulario de reservación de evento -->
                                    <div class="modal fade" id="reservarEventoModal{{ $ev->idEvento }}" tabindex="-1"
                                        aria-labelledby="reservarEventoModalLabel{{ $ev->idEvento }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content border-0 shadow-lg rounded-4">
                                                <div class="modal-header bg-light text-dark justify-content-center">
                                                    <h5 class="modal-title text-center fw-bold"
                                                        id="reservarEventoModalLabel{{ $ev->idEvento }}">
                                                        Crear Nueva Reservación para {{ $ev->nombreEvento }}
                                                    </h5>
                                                    <button type="button" class="btn-close position-absolute end-0 me-3"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulario de Reservación -->
                                                    <form action="{{ route('reservaciones.store') }}" method="POST"
                                                        enctype="multipart/form-data" class="crearEventoForm">
                                                        @csrf

                                                        <!-- ID del Evento -->
                                                        <input type="hidden" name="idEvento_fk"
                                                            value="{{ $ev->idEvento }}">

                                                        @if (Auth::check())
                                                            <!-- ID del Usuario Logueado -->
                                                            <input type="hidden" name="idUsuario_fk"
                                                                value="{{ Auth::user()->idUsuario }}">

                                                            <!-- Nombre del Usuario para la Reservación -->
                                                            <div class="form-group mb-3">
                                                                <label for="nombreUsuarioReservacion">Nombre del
                                                                    Usuario:</label>
                                                                <input type="text" name="nombreUsuarioReservacion"
                                                                    class="form-control"
                                                                    value="{{ Auth::user()->nombre }}" required readonly>
                                                            </div>

                                                            <!-- Correo del Usuario -->
                                                            <div class="form-group mb-3">
                                                                <label for="correoUsuarioReservacion">Correo del
                                                                    Usuario:</label>
                                                                <input type="email" name="correoUsuarioReservacion"
                                                                    class="form-control"
                                                                    value="{{ Auth::user()->correo }}" required readonly>
                                                            </div>

                                                            <!-- Teléfono del Usuario -->
                                                            <div class="form-group mb-3">
                                                                <label for="telefonoUsuarioReservacion">Teléfono:</label>
                                                                <input type="text" name="telefonoUsuarioReservacion"
                                                                    class="form-control"
                                                                    value="{{ Auth::user()->telefono }}">
                                                            </div>
                                                            <!-- Mostrar Nombre del Comercio -->
                                                            <div class="form-group mb-3">
                                                                <label for="idComercio_fk">Comercio:</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $ev->comercio->nombreComercio ?? 'No especificado' }}"
                                                                    readonly>
                                                                <input type="hidden" name="idComercio_fk"
                                                                    value="{{ $ev->idComercio_fk }}">
                                                            </div>
                                                            <input type="hidden" name="redirect_to"
                                                                value="{{ request()->routeIs('eventos') ? 'eventos' : 'reservaciones.index' }}">

                                                            <!-- Botón para Crear Reservación -->
                                                            <button type="submit" class="btn btn-primary w-100">Crear
                                                                Reservación</button>
                                                        @else
                                                            <!-- Mostrar mensaje o redirigir al login -->
                                                            <p class="text-center text-danger">Por favor, inicia sesión
                                                                para hacer una
                                                                reservación.</p>
                                                        @endif
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fin del Modal de Reservación -->
                                @endforeach
                            </div>
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
