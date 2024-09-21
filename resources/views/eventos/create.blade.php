@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Evento</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                <div class="col-md-6">
                    <label for="nombreEvento" class="form-label">Nombre del Evento</label>
                    <input type="text" class="form-control" id="nombreEvento" name="nombreEvento" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del evento.</div>
                </div>
                {{-- <div class="col-md-6">
                    <label for="tipoEvento" class="form-label">Tipo de Evento</label>
                    <input type="text" class="form-control" id="tipoEvento" name="tipoEvento" required>
                    <div class="invalid-feedback">Por favor, ingrese el tipo del evento.</div>
                </div> --}}
                <div class="col-md-6">
                    <label for="descripcionEvento" class="form-label">Descripcion del Evento</label>
                    <input type="text" class="form-control" id="descripcionEvento" name="descripcionEvento" required>
                    <div class="invalid-feedback">Por favor, ingrese el nombre del evento.</div>
                </div>
                <div class="col-md-6">
                    <label for="tipoEvento" class="form-label">Tipo de Evento</label>
                    <select class="form-select" id="tipoEvento" name="tipoEvento" required>
                        <option selected disabled value="">Seleccione el tipo de evento</option>
                        <option value="Concierto">Concierto</option>
                        <option value="Deporte">Deporte</option>
                        <option value="Exposición">Exposición</option>
                        <option value="Feria">Feria</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Educativo">Educativo</option>
                        <option value="Social">Social</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de evento.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="correoEvento" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoEvento" name="correoEvento" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="telefonoEvento" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoEvento" name="telefonoEvento">
                </div>
                <div class="col-md-6">
                    <label for="direccionEvento" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="direccionEvento" name="direccionEvento">
                </div>
                <div class="col-md-6">
                    <label for="imagen" >Imagen</label>
                    <input type="file" id="imagen" name="imagen">
                </div>
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option selected disabled value="">Seleccione un comercio</option>
                        @foreach($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}">{{ $comercio->nombreComercio }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">Por favor, seleccione un comercio.</div>
                </div>
                <div class="col-12 d-flex justify-content-center gap-2">
                    <button class="btn btn-success" type="submit">Guardar</button>
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">Volver</button>
                </div>
            </form>
        </div>
    </div>
@endsection
