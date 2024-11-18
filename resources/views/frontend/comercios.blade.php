@extends('layout.inicio')

@section('title', 'Comercios')

@section('content')
<main class="main">

    <!-- Comercios Section -->
    <section class="comercios section py-5 custom-gray" id="comercios">
        <!-- Contenedor del Título -->
        <div class="container title-container mb-0">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="fw-bold">Catálogo de Comercios</h2>
                </div>
            </div>
        </div>
        <!-- End Title Container -->

        <!-- Contenedor de la Barra de Búsqueda -->
        <div class="container search-container mb-4">
            <div class="row">
                <div class="col-12 d-flex justify-content-end">
                    <div class="input-group" style="width: 100%; max-width: 300px;">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" id="search" class="form-control" placeholder="Buscar comercios..." aria-label="Buscar comercios">
                        <span class="input-group-text bg-white">
                            <i class="fas fa-times" id="clear-search" style="cursor: pointer;"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Container -->

        <!-- Comercios -->
        <div class="comercio-wrap mt-2">
            <div class="container">
                @if($comercios->isEmpty())
                    <div class="text-center">
                        <p>No hay comercios disponibles en este momento.</p>
                    </div>
                @else
                    <div class="row">
                        @foreach($comercios as $comercio)
                            <!-- Responsive Classes for Different Screen Sizes -->
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                                <div class="card shadow-sm rounded-4 border-0" style="width: 100%;">
                                    <img src="{{ asset($comercio->imagen) }}" alt="{{ $comercio->nombreComercio }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-center">{{ $comercio->nombreComercio }}</h5>
                                        <p class="text-center">{{ $comercio->descripcionComercio }}</p>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comercioModal{{ $comercio->idComercio }}">
                                                Ver más
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="comercioModal{{ $comercio->idComercio }}" tabindex="-1" aria-labelledby="comercioModalLabel{{ $comercio->idComercio }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header bg-light text-dark justify-content-center">
                                            <h5 class="modal-title text-center fw-bold" id="comercioModalLabel{{ $comercio->idComercio }}" style="font-size: 1.75rem;">
                                                {{ $comercio->nombreComercio }}
                                            </h5>
                                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="{{ asset($comercio->imagen) }}" alt="{{ $comercio->nombreComercio }}" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                            <div class="comercio-details">
                                                <p><strong>Descripción:</strong> {{ $comercio->descripcionComercio }}</p>
                                                <p><strong>Correo:</strong> {{ $comercio->correoComercio }}</p>
                                                <p><strong>Teléfono:</strong>
                                                    @if ($comercio->codigoPais == '506' && strlen($comercio->telefonoComercio) == 8)
                                                        {{ '+506 ' . substr($comercio->telefonoComercio, 0, 4) . '-' . substr($comercio->telefonoComercio, 4) }}
                                                    @elseif ($comercio->codigoPais != '506')
                                                        {{ $comercio->codigoPais . ' ' . implode('-', str_split($comercio->telefonoComercio, 4)) }}
                                                    @else
                                                        {{ $comercio->telefonoComercio }}
                                                    @endif
                                                </p>
                                                <p><strong>Tipo de Negocio:</strong> {{ $comercio->tipoNegocio }}</p>
                                                <div class="col-md-12">
                                                    <label for="mapa" class="form-label">Mapa de Ubicación</label>
                                                    @if ($comercio->direccion_url)
                                                        <iframe width="100%" height="100%" style="border:0; border-radius: 8px; max-height: 300px;" loading="lazy" allowfullscreen src="https://www.google.com/maps/embed?pb={{ $comercio->direccion_url }}">
                                                        </iframe>
                                                    @else
                                                        <p>No hay información de ubicación disponible para este comercio.</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Modal -->
                        @endforeach
                    </div>
                @endif
                <!-- Paginación -->
                <div class="d-flex justify-content-center mt-4">
                    {{ $comercios->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </section>
    <!-- /Comercios Section -->

    <!-- JavaScript for Search and AJAX Pagination -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const clearButton = document.getElementById('clear-search');

            // Debounce function to prevent multiple calls while typing
            function debounce(func, delay) {
                let timeout;
                return function(...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
                };
            }

            // Initialize modals after AJAX update
            function initializeModals() {
                const modalTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="modal"]'));
                modalTriggerList.forEach(function(modalTriggerEl) {
                    new bootstrap.Modal(modalTriggerEl);
                });
            }

            // Fetch comercios with AJAX for search and pagination
            function fetchComercios(query, page = 1) {
                fetch(`/buscar-comercios?q=${query}&page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        const comercioWrap = document.querySelector('.comercio-wrap .row');
                        comercioWrap.innerHTML = '';

                        if (data.comercios.length > 0) {
                            data.comercios.forEach(comercio => {
                                const comercioHTML = `
                                    <div class="col-lg-3 col-md-4 mb-4">
                                        <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                            <img src="${comercio.imagen}" alt="${comercio.nombreComercio}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                            <div class="card-body d-flex flex-column justify-content-between">
                                                <h5 class="card-title text-center">${comercio.nombreComercio}</h5>
                                                <p class="text-center">${comercio.descripcionComercio}</p>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#comercioModal${comercio.idComercio}">
                                                        Ver más
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                comercioWrap.insertAdjacentHTML('beforeend', comercioHTML);
                            });
                        } else {
                            comercioWrap.innerHTML = '<div class="col-12 text-center"><p>No hay comercios que coincidan con tu búsqueda.</p></div>';
                        }

                        // Update pagination
                        const pagination = document.querySelector('.pagination');
                        pagination.innerHTML = data.pagination;

                        // Reinitialize modals
                        initializeModals();
                    });
            }

            // Real-time search with debounce
            searchInput.addEventListener('input', debounce(function() {
                fetchComercios(this.value);
            }, 300)); // 300ms delay before executing the search

            // Clear search input
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                fetchComercios(''); // Clear search
            });

            // Handle pagination click events
            document.addEventListener('click', function(event) {
                if (event.target.closest('.pagination a')) {
                    event.preventDefault();
                    const page = event.target.getAttribute('href').split('page=')[1];
                    fetchComercios(searchInput.value, page);
                }
            });
        });
    </script>
@endsection
