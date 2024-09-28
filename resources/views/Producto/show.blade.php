@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <!-- Título de la tarjeta -->
            <h5 class="card-title mb-3">Información del Producto</h5>

            <!-- Layout en dos columnas: imagen a la izquierda, datos del producto a la derecha -->
            <div class="row">
                <!-- Columna para la imagen -->
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                    @if($producto->imagenProducto)
                        <div class="p-2 bg-light rounded shadow">
                            <img src="{{ asset($producto->imagenProducto) }}" alt="Imagen de {{ $producto->nombreProducto }}" class="img-fluid rounded" style="max-width: 100%;">
                        </div>
                    @else
                        <p><strong>No hay imagen disponible para este producto.</strong></p>
                    @endif
                </div>

                <!-- Columna para los detalles del producto -->
                <div class="col-md-8">
                    <!-- Detalles del producto -->
                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
                            <strong>Nombre del Producto:</strong>
                            <p class="mb-1">{{ $producto->nombreProducto }}</p>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
                            <strong>Descripción:</strong>
                            <p class="mb-1">{{ $producto->descripcionProducto }}</p>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
                            <strong>Precio:</strong>
                            <p class="mb-1">${{ number_format($producto->precioProducto, 2) }}</p>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
                            <strong>Categoría:</strong>
                            <p class="mb-1">{{ $producto->categoria }}</p>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <div class="col-12">
                            <strong>Comercio Asociado:</strong>
                            <p class="mb-1">{{ $producto->comercio->nombreComercio }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botón Volver -->
            <div class="col-12 d-flex justify-content-center mt-3">
                <a href="{{ route('productos.index') }}" class="btn btn-primary">
                    <i class="bi bi-arrow-left-circle"></i> Volver a la Lista
                </a>
            </div>
        </div>
    </div>
@endsection
