@extends('layout.inicio')

@section('title', 'Alojamientos')

@section('content')
    <main class="main">
        <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

        <!-- Sección de Título y Barra de Búsqueda -->
        <section class="alojamientos section py-5 custom-gray" id="alojamientos">
            <div class="container section-title mb-3">
                <!-- Contenedor del Título -->
    <div class="container title-container mb-0">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Catálogo de Alojamientos</h2>
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
                    <input type="text" id="search" class="form-control" placeholder="Buscar alojamientos..." aria-label="Buscar alojamientos">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-times" id="clear-search" style="cursor: pointer;"></i>
                    </span>
                </div>
            </div>
        </div>
    </div><!-- End Search Container -->

            <!-- Lista de Alojamientos -->
            <div class="alojamiento-wrap mt-2">
                <div class="container">
                    @if ($alojamientos->isEmpty())
                        <div class="text-center">
                            <p>No hay alojamientos disponibles en este momento.</p>
                        </div>
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
                                                <img src="{{ asset('assets/img/default-image.jpg') }}"
                                                    alt="Imagen no disponible" class="card-img-top"
                                                    style="height: 150px; object-fit: cover;">
                                            @endif

                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title text-center">{{ $aloja->nombreAlojamiento }}</h5>
                                                <p class="text-center">Precio: {{ $aloja->precioAlojamiento }} CRC</p>

                                                <!-- Botones de Ver Más y Reservar -->
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#alojaModal{{ $aloja->idAlojamiento }}">
                                                        Ver más
                                                    </button>
                                                    <button type="button" class="btn btn-secondary ms-2"
                                                        data-bs-toggle="modal"
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
                                                        id="alojaModalLabel{{ $aloja->idAlojamiento }}"
                                                        style="font-size: 1.75rem;">
                                                        {{ $aloja->nombreAlojamiento }}
                                                    </h5>
                                                    <button type="button" class="btn-close position-absolute end-0 me-3"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($aloja->imagen)
                                                        <img src="{{ asset($aloja->imagen) }}"
                                                            alt="{{ $aloja->nombreAlojamiento }}"
                                                            class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-image.jpg') }}"
                                                            alt="Imagen no disponible"
                                                            class="img-fluid mb-3 d-block mx-auto rounded-3"
                                                            style="max-height: 300px; object-fit: cover;">
                                                    @endif
                                                    <div class="alojamiento-details">
                                                        <p><strong>Descripción:</strong>
                                                            {{ $aloja->descripcionAlojamiento }}</p>
                                                        <p class="text-success"><strong>Precio:</strong>
                                                            {{ $aloja->precioAlojamiento }} CRC</p>
                                                        <p><strong>Capacidad:</strong> {{ $aloja->capacidad }} personas</p>
                                                        <p><strong>Comercio:</strong>
    {{ $aloja->comercio->nombreComercio ?? 'No especificado' }}
</p>

                                                        <p><strong>Fecha de Inicio:</strong>
                                                            {{ \Carbon\Carbon::parse($aloja->fechaInicio)->format('d/m/Y') }}
                                                        </p>
                                                        <p><strong>Fecha de Fin:</strong>
                                                            {{ \Carbon\Carbon::parse($aloja->fechaFin)->format('d/m/Y') }}
                                                        </p>
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
                                    <div class="modal fade" id="reservarAlojamientoModal{{ $aloja->idAlojamiento }}"
                                        tabindex="-1"
                                        aria-labelledby="reservarAlojamientoModalLabel{{ $aloja->idAlojamiento }}"
                                        aria-hidden="true">
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

                                                        <!-- ID del Alojamiento -->
                                                        <input type="hidden" name="idAlojamiento_fk"
                                                            value="{{ $aloja->idAlojamiento }}">

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
                                                            <!-- Mostrar Nombre del Comercio sin Select, Solo Lectura -->
                                                            <div class="form-group mb-3">
                                                                <label for="idComercio_fk">Comercio:</label>
                                                                <input type="text" class="form-control"
                                                                    value="{{ $aloja->comercio->nombreComercio ?? 'No especificado' }}"
                                                                    readonly>
                                                                <input type="hidden" name="idComercio_fk"
                                                                    value="{{ $aloja->idComercio_fk }}">
                                                            </div>

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
        <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search');
        const clearButton = document.getElementById('clear-search');

        // Función de debounce para evitar múltiples llamadas mientras el usuario escribe
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        // Función para inicializar modales después de la actualización AJAX
        function initializeModals() {
            const modalTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'));
            modalTriggerList.forEach(function(modalTriggerEl) {
                new bootstrap.Modal(modalTriggerEl);
            });
        }

        // Función para realizar la búsqueda AJAX y manejar la paginación
        function fetchAlojamientos(query, page = 1) {
            fetch(`/buscar-alojamientos?q=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    const alojamientoWrap = document.querySelector('.alojamiento-wrap .row');
                    alojamientoWrap.innerHTML = '';

                    if (data.alojamientos.length > 0) {
                        data.alojamientos.forEach(alojamiento => {
                            const alojamientoHTML = `
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                    <img src="${alojamiento.imagen ? `{{ asset('') }}${alojamiento.imagen}` : '{{ asset('assets/img/default-image.jpg') }}'}" 
                                         alt="${alojamiento.nombreAlojamiento}" 
                                         class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-center">${alojamiento.nombreAlojamiento}</h5>
                                        <p class="text-center">Precio: ${alojamiento.precioAlojamiento} CRC</p>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#alojaModal${alojamiento.idAlojamiento}">
                                                Ver más
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="alojaModal${alojamiento.idAlojamiento}" tabindex="-1" aria-labelledby="alojaModalLabel${alojamiento.idAlojamiento}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header bg-light text-dark justify-content-center">
                                            <h5 class="modal-title text-center fw-bold" id="alojaModalLabel${alojamiento.idAlojamiento}" style="font-size: 1.75rem;">
                                                ${alojamiento.nombreAlojamiento}
                                            </h5>
                                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="${alojamiento.imagen ? `{{ asset('') }}${alojamiento.imagen}` : '{{ asset('assets/img/default-image.jpg') }}'}" 
                                                 alt="${alojamiento.nombreAlojamiento}" 
                                                 class="img-fluid mb-3 d-block mx-auto rounded-3" 
                                                 style="max-height: 300px; object-fit: cover;">
                                            <div class="alojamiento-details">
                                                <p><strong>Descripción:</strong> ${alojamiento.descripcionAlojamiento}</p>
                                                <p class="text-success"><strong>Precio:</strong> ${alojamiento.precioAlojamiento} CRC</p>
                                                <p><strong>Capacidad:</strong> ${alojamiento.capacidad} personas</p>
                                                <p><strong>Comercio:</strong> ${alojamiento.comercio ? alojamiento.comercio.nombreComercio : 'No especificado'}</p>
                                                <p><strong>Fecha de Inicio:</strong> ${new Date(alojamiento.fechaInicio).toLocaleDateString()}</p>
                                                <p><strong>Fecha de Fin:</strong> ${new Date(alojamiento.fechaFin).toLocaleDateString()}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                            alojamientoWrap.insertAdjacentHTML('beforeend', alojamientoHTML);
                        });
                    } else {
                        alojamientoWrap.innerHTML =
                            '<div class="col-12 text-center"><p>No hay alojamientos que coincidan con tu búsqueda.</p></div>';
                    }

                    // Actualizar paginación
                    const pagination = document.querySelector('.pagination');
                    pagination.innerHTML = data.pagination;

                    // Reinicializar modales
                    initializeModals();
                });
        }

        // Búsqueda en tiempo real con debounce
        searchInput.addEventListener('input', debounce(function() {
            fetchAlojamientos(this.value);
        }, 300)); // 300ms de espera antes de ejecutar la búsqueda

        // Limpiar el campo de búsqueda
        clearButton.addEventListener('click', function() {
            searchInput.value = '';
            fetchAlojamientos(''); // Limpiar la búsqueda
        });

        // Manejar la paginación
        document.addEventListener('click', function(event) {
            if (event.target.closest('.pagination a')) {
                event.preventDefault();
                const page = event.target.getAttribute('href').split('page=')[1];
                fetchAlojamientos(searchInput.value, page);
            }
        });
    });
</script>

    </main>
@endsection
