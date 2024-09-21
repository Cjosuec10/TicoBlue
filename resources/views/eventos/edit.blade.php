@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Evento</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('eventos.update', $evento->idEvento) }}" method="POST" class="row g-3 needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="col-md-6">
                    <label for="nombreEvento" class="form-label">Nombre del Evento</label>
                    <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" value="{{ $evento->nombreEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="tipoEvento" class="form-label">Tipo de Evento</label>
                    <input type="text" class="form-control" id="tipoEvento" name="tipoEvento" value="{{ $evento->tipoEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese el tipo del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="correoEvento" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoEvento" name="correoEvento" value="{{ $evento->correoEvento }}" required>
                    <div class="invalid-feedback">Por favor, ingrese un correo válido.</div>
                </div>
                <div class="col-md-6">
                    <label for="telefonoEvento" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoEvento" name="telefonoEvento" value="{{ $evento->telefonoEvento }}">
                </div>
                <div class="col-md-6">
                    <label for="direccionEvento" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccionEvento" name="direccionEvento" value="{{ $evento->direccionEvento }}">
                </div>
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option disabled value="">Seleccione un comercio</option>
                        @foreach($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}" {{ $evento->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>{{ $comercio->nombreComercio }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
                </div>
                <div class="col-md-6">
                    <label for="imagen">Imagen</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    @if ($evento->imagen)
                        <img src="{{ asset($evento->imagen) }}" alt="Imagen del evento" class="img-fluid" width="120px">
                    @endif
                </div>
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button class="btn btn-success" type="submit">Actualizar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
