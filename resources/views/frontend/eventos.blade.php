@extends('layout.inicio')
@section('title', 'Eventos')
@section('content')
<main class="main">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- Título y Barra de Búsqueda -->
    <section class="events section py-5 custom-gray" id="events">
        <div class="container title-container mb-0">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Catálogo de Eventos</h2>
                </div>
            </div>
        </div>

        <!-- Contenedor de la Barra de Búsqueda -->
        <div class="container search-container mb-4">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="input-group" style="width: 100%; max-width: 300px;">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="search" class="form-control" placeholder="Buscar eventos..." aria-label="Buscar eventos">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-times" id="clear-search" style="cursor: pointer;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Eventos -->
        <div class="event-wrap mt-2">
            <div class="container">
                <div class="row" id="eventos-list">
                    @if ($eventos->isEmpty())
                        <div class="text-center">
                            <p>No hay eventos disponibles en este momento.</p>
                        </div>
                    @else
                        @foreach ($eventos as $ev)
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                    @if ($ev->imagen)
                                        <img src="{{ asset($ev->imagen) }}" alt="{{ $ev->nombreEvento }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Imagen no disponible" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    @endif
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-center">{{ $ev->nombreEvento }}</h5>
                                        <p><strong>Fecha de Inicio:</strong> {{ \Carbon\Carbon::parse($ev->fechaInicio)->format('d/m/Y') }}</p>
                                        <p><strong>Fecha de Fin:</strong> {{ \Carbon\Carbon::parse($ev->fechaFin)->format('d/m/Y') }}</p>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventoModal{{ $ev->idEvento }}">
                                                Ver más
                                            </button>
                                            <button type="button" class="btn btn-secondary ms-2" data-bs-toggle="modal" data-bs-target="#reservarEventoModal{{ $ev->idEvento }}">
                                                Reservar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Ver más -->
                            <div class="modal fade" id="eventoModal{{ $ev->idEvento }}" tabindex="-1" aria-labelledby="eventoModalLabel{{ $ev->idEvento }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header bg-light text-dark justify-content-center">
                                            <h5 class="modal-title text-center fw-bold" id="eventoModalLabel{{ $ev->idEvento }}" style="font-size: 1.75rem;">
                                                {{ $ev->nombreEvento }}
                                            </h5>
                                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($ev->imagen)
                                                <img src="{{ asset($ev->imagen) }}" alt="{{ $ev->nombreEvento }}" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                            @else
                                                <img src="{{ asset('assets/img/default-image.jpg') }}" alt="Imagen no disponible" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                            @endif
                                            <div class="event-details">
                                                <p class="text-success"><strong>Correo:</strong> {{ $ev->correoEvento }}</p>
                                                <p><strong>Teléfono:</strong> {{ $ev->telefonoEvento }}</p>
                                                <p><strong>Dirección:</strong> {{ $ev->direccionEvento }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Modal Ver más -->

                            <!-- Modal para el formulario de reservación de evento -->
                            <div class="modal fade" id="reservarEventoModal{{ $ev->idEvento }}" tabindex="-1" aria-labelledby="reservarEventoModalLabel{{ $ev->idEvento }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header bg-light text-dark justify-content-center">
                                            <h5 class="modal-title text-center fw-bold" id="reservarEventoModalLabel{{ $ev->idEvento }}">
                                                Crear Nueva Reservación para {{ $ev->nombreEvento }}
                                            </h5>
                                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Formulario de Reservación -->
                                            <form action="{{ route('reservaciones.store') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="idEvento_fk" value="{{ $ev->idEvento }}">

                                                @if (Auth::check())
                                                    <input type="hidden" name="idUsuario_fk" value="{{ Auth::user()->idUsuario }}">
                                                    <div class="form-group mb-3">
                                                        <label for="nombreUsuarioReservacion">Nombre del Usuario:</label>
                                                        <input type="text" name="nombreUsuarioReservacion" class="form-control" value="{{ Auth::user()->nombre }}" required readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="correoUsuarioReservacion">Correo del Usuario:</label>
                                                        <input type="email" name="correoUsuarioReservacion" class="form-control" value="{{ Auth::user()->correo }}" required readonly>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="telefonoUsuarioReservacion">Teléfono:</label>
                                                        <input type="text" name="telefonoUsuarioReservacion" class="form-control" value="{{ Auth::user()->telefono }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="idComercio_fk">Comercio:</label>
                                                        <input type="text" class="form-control" value="{{ $ev->comercio->nombreComercio ?? 'No especificado' }}" readonly>
                                                        <input type="hidden" name="idComercio_fk" value="{{ $ev->idComercio_fk }}">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary w-100">Crear Reservación</button>
                                                @else
                                                    <p class="text-center text-danger">Por favor, inicia sesión para hacer una reservación.</p>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Fin del Modal de Reservación -->
                        @endforeach
                    @endif
                </div>
                <!-- Contenedor de la paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $eventos->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search');
    const clearButton = document.getElementById('clear-search');
    const eventosList = document.getElementById('eventos-list');

    if (!eventosList) {
        console.error("Error: No se encontró el contenedor de eventos con id 'eventos-list'.");
        return;
    }

    function debounce(func, delay) {
        let timeout;
        return function(...args) {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), delay);
        };
    }

    function fetchEventos(query, page = 1) {
    fetch(`/buscar-eventos?q=${query}&page=${page}`)
        .then(response => response.json())
        .then(data => {
            eventosList.innerHTML = '';

            if (data.eventos.length > 0) {
                data.eventos.forEach(ev => {
                    const eventoHTML = `
                        <div class="col-lg-3 col-md-4 mb-4">
                            <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                <img src="${ev.imagen}" alt="${ev.nombreEvento}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">${ev.nombreEvento}</h5>
                                    <p><strong>Fecha de Inicio:</strong> ${ev.fechaInicio}</p>
                                    <p><strong>Fecha de Fin:</strong> ${ev.fechaFin}</p>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#eventoModal${ev.idEvento}">
                                        Ver más
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Ver más -->
                        <div class="modal fade" id="eventoModal${ev.idEvento}" tabindex="-1" aria-labelledby="eventoModalLabel${ev.idEvento}" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content border-0 shadow-lg rounded-4">
                                    <div class="modal-header bg-light text-dark justify-content-center">
                                        <h5 class="modal-title text-center fw-bold" id="eventoModalLabel${ev.idEvento}" style="font-size: 1.75rem;">
                                            ${ev.nombreEvento}
                                        </h5>
                                        <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img src="${ev.imagen}" alt="${ev.nombreEvento}" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                        <div class="event-details">
                                            <p class="text-success"><strong>Correo:</strong> ${ev.correoEvento}</p>
                                            <p><strong>Teléfono:</strong> ${ev.telefonoEvento}</p>
                                            <p><strong>Dirección:</strong> ${ev.direccionEvento}</p>
                                        </div>
                                    </div>
                                    <div class="modal-footer bg-light">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    eventosList.insertAdjacentHTML('beforeend', eventoHTML);
                });
            } else {
                eventosList.innerHTML = '<div class="col-12 text-center"><p>No hay eventos que coincidan con tu búsqueda.</p></div>';
            }

            // Actualizar la paginación
            const pagination = document.querySelector('.pagination');
            if (pagination) {
                pagination.innerHTML = data.pagination;
            }

            // Re-inicializar los modales
            document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
                const modalId = button.getAttribute('data-bs-target');
                const modalElement = document.querySelector(modalId);
                if (modalElement) {
                    new bootstrap.Modal(modalElement);
                }
            });
        });
}


    searchInput.addEventListener('input', debounce(function() {
        fetchEventos(this.value);
    }, 300));

    clearButton.addEventListener('click', function() {
        searchInput.value = '';
        fetchEventos('');
    });

    document.addEventListener('click', function(event) {
        if (event.target.closest('.pagination a')) {
            event.preventDefault();
            const page = event.target.getAttribute('href').split('page=')[1];
            fetchEventos(searchInput.value, page);
        }
    });
});
</script>
@endsection