@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Detalles del Evento</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $evento->nombreEvento }}</h5>
            <p><strong>Descripción:</strong> {{ $evento->descripcionEvento }}</p>
            <p><strong>Tipo:</strong> {{ $evento->tipoEvento }}</p>
            <p><strong>Correo:</strong> {{ $evento->correoEvento }}</p>
            <p><strong>Teléfono:</strong> {{ $evento->telefonoEvento }}</p>
            <p><strong>Dirección:</strong> {{ $evento->direccionEvento }}</p>
            <p><strong>ID Comercio:</strong> {{ $evento->idComercio_fk }}</p>
            @if ($evento->imagen)
            <img src="{{ asset($evento->imagen) }}" alt="Imagen del evento" class="img-fluid">
            @endif

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('eventos.index') }}" class="btn btn-primary">Volver</a>
                <a href="{{ route('eventos.edit', $evento->idEvento) }}" class="btn btn-warning">Editar</a>
            </div>
        </div>
    </div>
@endsection
