@extends('layout.inicio')

@section('title', 'Productos')

@section('content')
<main class="main">

<!-- Productos Section -->
<section class="products section py-5" id="products">
    <!-- Section Title -->
    <div class="container section-title mb-3"> 
        <!-- Título principal -->
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Catálogo de Productos</h2>
            </div>
        </div>
        <!-- Fila con texto y barra de búsqueda -->
        <div class="row align-items-center mt-2">
            <div class="col-md-8 text-md-start text-center">
                <p class="text-muted">Descubre los productos disponibles a continuación.</p>
            </div>
            <!-- Barra de búsqueda con ícono de lupa y botón de limpiar -->
            <div class="col-md-4 d-flex justify-content-md-end justify-content-center mt-2 mt-md-0">
                <div class="input-group w-75">
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
    </div><!-- End Section Title -->

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
                <div class="col-lg-3 col-md-4 mb-4">
                    <div class="card shadow-sm rounded-4 border-0" style="width: 15rem;">
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
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="productoModalLabel{{ $producto->idProducto }}">{{ $producto->nombreProducto }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ asset($producto->imagenProducto) }}" alt="{{ $producto->nombreProducto }}" class="img-fluid mb-3 d-block mx-auto" style="max-height: 300px;">
                                <p><strong>Descripción:</strong> {{ $producto->descripcionProducto }}</p>
                                <p><strong>Precio:</strong> ${{ $producto->precioProducto }}</p>
                                <p><strong>Categoría:</strong> {{ $producto->categoria }}</p>
                                <p><strong>Vendido por:</strong> {{ $producto->comercio->nombreComercio }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin del Modal -->
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-center mt-4">
            {{ $productos->links('pagination::bootstrap-4') }}
            </div>
            @endif
        </div>
    </div>
</section><!-- /Productos Section -->

</main>

<!-- Script para la búsqueda en tiempo real, botón de limpiar y paginación AJAX -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const clearButton = document.getElementById('clear-search');

        // Función para realizar la búsqueda AJAX
        function fetchProducts(query, page = 1) {
            fetch(`/buscar-productos?q=${query}&page=${page}`)
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
                            `;
                            productWrap.insertAdjacentHTML('beforeend', productHTML);
                        });
                    } else {
                        productWrap.innerHTML = '<div class="col-12 text-center"><p>No hay productos que coincidan con tu búsqueda.</p></div>';
                    }

                    // Actualizar paginación
                    const pagination = document.querySelector('.pagination');
                    pagination.innerHTML = data.pagination;
                });
        }

        // Búsqueda en tiempo real
        searchInput.addEventListener('input', function () {
            fetchProducts(this.value);
        });

        // Limpiar el campo de búsqueda
        clearButton.addEventListener('click', function () {
            searchInput.value = '';
            fetchProducts('');
        });

        // Manejar la paginación
        document.addEventListener('click', function (event) {
            if (event.target.closest('.pagination a')) {
                event.preventDefault();
                const page = event.target.getAttribute('href').split('page=')[1];
                fetchProducts(searchInput.value, page);
            }
        });
    });
</script>

@endsection
