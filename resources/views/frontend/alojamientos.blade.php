@extends('layout.inicio')

@section('title', 'Alojamientos')

@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

        <!-- Page Title -->
        <h1 class="text-center">Lista de Alojamientos</h1>

        @if ($alojamientos->isEmpty())
            <p class="text-center">No hay alojamientos disponibles.</p>
        @else
            <div class="container mt-5">
                <div class="row">
                    @foreach ($alojamientos as $aloja)
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                <!-- Mostrar la imagen si está disponible -->
                                @if ($aloja->imagen)
                                    <img src="{{ asset($aloja->imagen) }}" alt="{{ $aloja->nombreAlojamiento }}"
                                        class="card-img-top" style="height: 150px; object-fit: cover;">
                                @else
                                    <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Imagen no disponible"
                                        class="card-img-top" style="height: 150px; object-fit: cover;">
                                @endif

                                <div class="card-body d-flex flex-column justify-content-between">
                                    <h5 class="card-title text-center">{{ $aloja->nombreAlojamiento }}</h5>
                                    <p class="text-center">Precio: {{ $aloja->precioAlojamiento }} USD</p>

                                    <!-- Botones de Ver Más y Reservar -->
                                    <div class="d-flex justify-content-center mt-3">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#alojaModal{{ $aloja->idAlojamiento }}">
                                            Ver más
                                        </button>
                                        <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal"
                                            data-bs-target="#reservarAlojamientoModal{{ $aloja->idAlojamiento }}">
                                            Reservar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Ver más -->
                        <div class="modal fade" id="alojaModal{{ $aloja->idAlojamiento }}" tabindex="-1"
                            aria-labelledby="alojaModalLabel{{ $aloja->idAlojamiento }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-light text-dark justify-content-center">
                                        <h5 class="modal-title text-center fw-bold"
                                            id="alojaModalLabel{{ $aloja->idAlojamiento }}" style="font-size: 1.75rem;">
                                            {{ $aloja->nombreAlojamiento }}
                                        </h5>
                                        <button type="button" class="btn-close position-absolute end-0 me-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($aloja->imagen)
                                            <img src="{{ asset($aloja->imagen) }}" alt="{{ $aloja->nombreAlojamiento }}"
                                                class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                style="max-height: 300px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('assets/img/default-image.jpg') }}"
                                                alt="Imagen no disponible" class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                style="max-height: 300px; object-fit: cover;">
                                        @endif
                                        <div class="alojamiento-details">
                                            <p><strong>Descripción:</strong> {{ $aloja->descripcionAlojamiento }}</p>
                                            <p class="text-success"><strong>Precio:</strong>
                                                {{ $aloja->precioAlojamiento }} USD</p>
                                            <p><strong>Capacidad:</strong> {{ $aloja->capacidad }} personas</p>
                                            <p><strong>Comercio:</strong>
                                                @foreach ($comercios as $comercio)
                                                    @if (isset($aloja) && $aloja->idComercio_fk == $comercio->idComercio)
                                                        {{ $comercio->nombreComercio }}
                                                    @endif
                                                @endforeach
                                            </p>
                                            <p><strong>Fecha de Inicio:</strong>
                                                {{ \Carbon\Carbon::parse($aloja->fechaInicio)->format('d/m/Y') }}</p>
                                            <p><strong>Fecha de Fin:</strong>
                                                {{ \Carbon\Carbon::parse($aloja->fechaFin)->format('d/m/Y') }}</p>
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
                        <!-- Modal para el formulario de reservación de alojamiento -->
                        <div class="modal fade" id="reservarAlojamientoModal{{ $aloja->idAlojamiento }}" tabindex="-1"
                            aria-labelledby="reservarAlojamientoModalLabel{{ $aloja->idAlojamiento }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-light text-dark justify-content-center">
                                        <h5 class="modal-title text-center fw-bold"
                                            id="reservarAlojamientoModalLabel{{ $aloja->idAlojamiento }}">
                                            Crear Nueva Reservación para {{ $aloja->nombreAlojamiento }}
                                        </h5>
                                        <button type="button" class="btn-close position-absolute end-0 me-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario de Reservación -->
                                        <form action="{{ route('reservaciones.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="idAlojamiento_fk"
                                                value="{{ $aloja->idAlojamiento }}">

                                            <!-- Mostrar el Usuario Logueado -->
                                            <input type="hidden" name="idUsuario_fk"
                                                value="{{ $usuarioLogueado->idUsuario }}">

                                            <!-- Nombre del Usuario para la Reservación -->
                                            <div class="form-group mb-3">
                                                <label for="nombreUsuarioReservacion">Nombre del Usuario:</label>
                                                <input type="text" name="nombreUsuarioReservacion" class="form-control"
                                                    value="{{ $usuarioLogueado->nombre }}" required readonly>
                                            </div>

                                            <!-- Correo del Usuario -->
                                            <div class="form-group mb-3">
                                                <label for="correoUsuarioReservacion">Correo del Usuario:</label>
                                                <input type="email" name="correoUsuarioReservacion" class="form-control"
                                                    value="{{ $usuarioLogueado->correo }}" required readonly>
                                            </div>

                                            <!-- Teléfono del Usuario -->
                                            <div class="form-group mb-3">
                                                <label for="telefonoUsuarioReservacion">Teléfono:</label>
                                                <input type="text" name="telefonoUsuarioReservacion"
                                                    class="form-control" value="{{ $usuarioLogueado->telefono }}">
                                            </div>

                                            <!-- Mostrar Nombre del Comercio sin Select, Solo Lectura -->
                                            <div class="form-group mb-3">
                                                <label for="idComercio_fk">Comercio:</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $aloja->comercio->nombreComercio ?? 'No especificado' }}"
                                                    readonly>
                                                <input type="hidden" name="idComercio_fk"
                                                    value="{{ $aloja->idComercio_fk }}">
                                            </div>

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
