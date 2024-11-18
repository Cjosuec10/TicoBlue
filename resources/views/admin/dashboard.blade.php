@extends('layout.administracion')

@section('content')
<div class="container my-4">
    <h1 class="text-center mb-4" data-translate="overview">Visión General de Datos</h1>
    <div class="row text-center">
        <div class="col-12 col-sm-6 col-md-3 mb-4">
            <div class="card shadow border-light h-100"> 
                <div class="card-body">
                    <i class="bi bi-shop" style="font-size: 3rem; color: #28a745;"></i> <!-- Verde -->
                    <h2 class="card-title mt-3" data-translate="commerceSummary">Comercios</h2>
                    <p class="card-text display-4">{{ $totalComercios }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4"> 
            <div class="card shadow border-light h-100"> 
                <div class="card-body">
                    <i class="bi bi-calendar-event" style="font-size: 3rem; color: #007bff;"></i> <!-- Azul -->
                    <h2 class="card-title mt-3" data-translate="eventSummary">Eventos</h2>
                    <p class="card-text display-4">{{ $totalEventos }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4"> 
            <div class="card shadow border-light h-100"> 
                <div class="card-body">
                    <i class="bi bi-box-seam" style="font-size: 3rem; color: #ffc107;"></i> <!-- Amarillo -->
                    <h2 class="card-title mt-3" data-translate="productSummary">Productos</h2>
                    <p class="card-text display-4">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 mb-4"> 
            <div class="card shadow border-light h-100"> 
                <div class="card-body">
                    <i class="bi bi-house-door" style="font-size: 3rem; color: #dc3545;"></i> <!-- Rojo -->
                    <h2 class="card-title mt-3" data-translate="accommodationSummary">Alojamientos</h2>
                    <p class="card-text display-4">{{ $totalAlojamientos }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
