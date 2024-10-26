@extends('layout.inicio')

@section('title', 'Productos')

@section('content')
    <main class="main">

<!-- Productos Section -->
<section class="products section py-5 bg-light" id="products">
    <!-- Contenedor del Título -->
    <div class="container title-container mb-0"> 
        <div class="row">
            <!-- Título principal centrado en pantallas pequeñas y alineado a la izquierda en pantallas medianas en adelante -->
            <div class="col-12 text-center">
                <h2 class="fw-bold">Catálogo de Productos</h2>
            </div>
        </div>
    </div><!-- End Title Container -->

    <!-- Contenedor de la Barra de Búsqueda -->
<div class="container search-container mb-4"> 
    <div class="row">
        <!-- Barra de búsqueda alineada a la derecha en todas las pantallas -->
        <div class="col-12 d-flex justify-content-end">
            <div class="input-group" style="width: 100%; max-width: 300px;">
                <span class="input-group-text bg-white">
                    <i class="fas fa-search"></i>
                </span>
                <input type="text" id="search" class="form-control" placeholder="Buscar productos..." aria-label="Buscar productos">
                <span class="input-group-text bg-white">
                    <i class="fas fa-times" id="clear-search" style="cursor: pointer;"></i>
                </span>
            </div>
        </div>
    </div>
</div><!-- End Search Container -->


    <!-- Productos -->
    <div class="product-wrap mt-2">
        <div class="container">
            @if($productos->isEmpty())
                <div class="text-center">
                    <p>No hay productos disponibles en este momento.</p>
                </div>
            @else
            <div class="row">
                @foreach($productos as $producto)
                <!-- Clases responsivas para diferentes tamaños de pantalla -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm rounded-4 border-0" style="width: 100%;">
                        <img src="{{ asset($producto->imagenProducto) }}" alt="{{ $producto->nombreProducto }}" class="card-img-top" style="height: 150px; object-fit: cover;">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <h5 class="card-title text-center">{{ $producto->nombreProducto }}</h5>
                            <p class="text-center">${{ $producto->precioProducto }}</p>
                            <div class="d-flex justify-content-center mt-3">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal{{ $producto->idProducto }}">
                                    Ver más
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="productoModal{{ $producto->idProducto }}" tabindex="-1" aria-labelledby="productoModalLabel{{ $producto->idProducto }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg rounded-4">
                            <div class="modal-header bg-light text-dark justify-content-center">
                                <h5 class="modal-title text-center fw-bold" id="productoModalLabel{{ $producto->idProducto }}" style="font-size: 1.75rem;">
                                    {{ $producto->nombreProducto }}
                                </h5>
                                <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset($producto->imagenProducto) }}" alt="{{ $producto->nombreProducto }}" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                <div class="product-details">
                                    <p><strong>Descripción:</strong> {{ $producto->descripcionProducto }}</p>
                                    <p class="text-success"><strong>Precio:</strong> ${{ $producto->precioProducto }}</p>
                                    <p><strong>Categoría:</strong> {{ $producto->categoria }}</p>
                                    <p><strong>Vendido por:</strong> <span class="text-primary">{{ $producto->comercio->nombreComercio }}</span></p>
                                </div>
                            </div>
                            <div class="modal-footer bg-light">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin del Modal -->
                @endforeach
            </div>
            @endif
            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
                {{ $productos->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</section><!-- /Productos Section -->

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
            function fetchProducts(query, page = 1) {
                // Deshabilitar los botones "Ver más" antes de hacer la búsqueda
                const verMasButtons = document.querySelectorAll('.btn-primary');
                verMasButtons.forEach(button => {
                    button.setAttribute('disabled', 'true');
                });

                fetch(`/buscar-productos-informativo?q=${query}&page=${page}`)
                    .then(response => response.json())
                    .then(data => {
                        const productWrap = document.querySelector('.product-wrap .row');
                        productWrap.innerHTML = '';

                        if (data.productos.length > 0) {
                            data.productos.forEach(producto => {
                                const productHTML = `
                            <div class="col-lg-3 col-md-4 mb-4">
                                <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
                                    <img src="${producto.imagenProducto}" alt="${producto.nombreProducto}" class="card-img-top" style="height: 150px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h5 class="card-title text-center">${producto.nombreProducto}</h5>
                                        <p class="text-center">$${producto.precioProducto}</p>
                                        <div class="d-flex justify-content-center mt-3">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productoModal${producto.idProducto}">
                                                Ver más
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="productoModal${producto.idProducto}" tabindex="-1" aria-labelledby="productoModalLabel${producto.idProducto}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow-lg rounded-4">
                                        <div class="modal-header bg-light text-dark justify-content-center">
                                            <h5 class="modal-title text-center fw-bold" id="productoModalLabel${producto.idProducto}" style="font-size: 1.75rem;">
                                                ${producto.nombreProducto}
                                            </h5>
                                            <button type="button" class="btn-close position-absolute end-0 me-3" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <img src="${producto.imagenProducto}" alt="${producto.nombreProducto}" class="img-fluid mb-3 d-block mx-auto rounded-3" style="max-height: 300px; object-fit: cover;">
                                            <div class="product-details">
                                                <p><strong>Descripción:</strong> ${producto.descripcionProducto}</p>
                                                <p class="text-success"><strong>Precio:</strong> $${producto.precioProducto}</p>
                                                <p><strong>Categoría:</strong> ${producto.categoria}</p>
                                                <p><strong>Vendido por:</strong> <span class="text-primary">${producto.comercio.nombreComercio || 'Comercio desconocido'}</span></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer bg-light">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                                productWrap.insertAdjacentHTML('beforeend', productHTML);
                            });
                        } else {
                            productWrap.innerHTML =
                                '<div class="col-12 text-center"><p>No hay productos que coincidan con tu búsqueda.</p></div>';
                        }

                        // Actualizar paginación
                        const pagination = document.querySelector('.pagination');
                        pagination.innerHTML = data.pagination;

                        // Habilitar los botones inmediatamente después de cargar los productos
                        const newVerMasButtons = document.querySelectorAll('.btn-primary');
                        newVerMasButtons.forEach(button => {
                            button.removeAttribute('disabled');
                        });

                        // Reinicializar modales
                        initializeModals();
                    });
            }

            // Búsqueda en tiempo real con debounce
            searchInput.addEventListener('input', debounce(function() {
                fetchProducts(this.value);
            }, 300)); // 300ms de espera antes de ejecutar la búsqueda

            // Limpiar el campo de búsqueda
            clearButton.addEventListener('click', function() {
                searchInput.value = '';
                fetchProducts(''); // Limpiar la búsqueda
            });

            // Manejar la paginación
            document.addEventListener('click', function(event) {
                if (event.target.closest('.pagination a')) {
                    event.preventDefault();
                    const page = event.target.getAttribute('href').split('page=')[1];
                    fetchProducts(searchInput.value, page);
                }
            });
        });
    </script>

@endsection
