@extends('layout.inicio')

@section('title', 'Eventos')

@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

        <!-- Page Title -->
        <h1 class="text-center">Lista de Eventos</h1>

        @if ($eventos->isEmpty())
            <p class="text-center">No hay eventos disponibles.</p>
        @else
            <div class="container mt-5">
                <div class="row">
                    @foreach ($eventos as $ev)
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                <!-- Mostrar la imagen si está disponible -->
                                @if ($ev->imagen)
                                    <img src="{{ asset($ev->imagen) }}" alt="{{ $ev->nombreEvento }}" class="card-img-top"
                                        style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Imagen no disponible"
                                        class="card-img-top" style="height: 150px; object-fit: cover;">
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
                                        <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal"
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
                                            id="eventoModalLabel{{ $ev->idEvento }}" style="font-size: 1.75rem;">
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
                                                alt="Imagen no disponible" class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                style="max-height: 300px; object-fit: cover;">
                                        @endif
                                        <div class="event-details">
                                            <p class="text-success"><strong>Correo:</strong> {{ $ev->correoEvento }}</p>
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
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="idEvento_fk" value="{{ $ev->idEvento }}">

                                            @if (Auth::check())
                                                <input type="hidden" name="idUsuario_fk"
                                                    value="{{ Auth::user()->idUsuario }}">

                                                <!-- Nombre del Usuario para la Reservación -->
                                                <div class="form-group mb-3">
                                                    <label for="nombreUsuarioReservacion">Nombre del Usuario:</label>
                                                    <input type="text" name="nombreUsuarioReservacion"
                                                        class="form-control" value="{{ Auth::user()->nombre }}" required
                                                        readonly>
                                                </div>

                                                <!-- Correo del Usuario -->
                                                <div class="form-group mb-3">
                                                    <label for="correoUsuarioReservacion">Correo del Usuario:</label>
                                                    <input type="email" name="correoUsuarioReservacion"
                                                        class="form-control" value="{{ Auth::user()->correo }}" required
                                                        readonly>
                                                </div>

                                                <!-- Teléfono del Usuario -->
                                                <div class="form-group mb-3">
                                                    <label for="telefonoUsuarioReservacion">Teléfono:</label>
                                                    <input type="text" name="telefonoUsuarioReservacion"
                                                        class="form-control" value="{{ Auth::user()->telefono }}">
                                                </div>
                                            @else
                                                <!-- Mostrar mensaje o redirigir al login -->
                                                <p class="text-center text-danger">Por favor, inicia sesión para hacer una
                                                    reservación.</p>
                                            @endif

                                            <button type="submit" class="btn btn-primary w-100">Crear
                                                Reservación</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </main>
@endsection
