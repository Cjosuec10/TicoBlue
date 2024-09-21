@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Detalles del Producto</h1>

    <div class="card">
        <div class="card-body">
            <!-- Título de la tarjeta -->
            <h5 class="card-title mb-3">Información del Producto</h5>
            
            <!-- Detalles del producto en formato compacto -->
            <div class="row mb-2 align-items-center">
                <div class="col-1">
                    <i class="bi bi-box-seam h5"></i> <!-- Icono de producto -->
                </div>
                <div class="col-11">
                    <strong>Nombre del Producto:</strong>
                    <p class="mb-1">{{ $producto->nombreProducto }}</p>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-1">
                    <i class="bi bi-file-text h5"></i> <!-- Icono de descripción -->
                </div>
                <div class="col-11">
                    <strong>Descripción:</strong>
                    <p class="mb-1">{{ $producto->descripcionProducto }}</p>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-1">
                    <i class="bi bi-currency-dollar h5"></i> <!-- Icono de precio -->
                </div>
                <div class="col-11">
                    <strong>Precio:</strong>
                    <p class="mb-1">${{ number_format($producto->precioProducto, 2) }}</p>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-1">
                    <i class="bi bi-tag h5"></i> <!-- Icono de categoría -->
                </div>
                <div class="col-11">
                    <strong>Categoría:</strong>
                    <p class="mb-1">{{ $producto->categoria }}</p>
                </div>
            </div>

            <div class="row mb-2 align-items-center">
                <div class="col-1">
                    <i class="bi bi-building h5"></i> <!-- Icono de comercio -->
                </div>
                <div class="col-11">
                    <strong>Comercio Asociado:</strong>
                    <p class="mb-1">{{ $producto->comercio->nombreComercio }}</p>
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
