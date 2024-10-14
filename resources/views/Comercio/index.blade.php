@extends('layout.administracion')

@section('content')
    <div class="flags" id="flags">
        <div class="flags__item" data-language="es" onclick="selectLanguage('es')">
            <img src="/assets/icons/cr.svg" alt="Español">
        </div>
        <div class="flags__item" data-language="en" onclick="selectLanguage('en')">
            <img src="/assets/icons/us.svg" alt="English">
        </div>
    </div>

    <h1 id="title" class="card-title">Lista de Comercios</h1>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <a id="createButton" href="{{ route('comercios.create') }}" class="btn btn-success" title="Crear">
                            <i class="bi bi-check-circle"></i> <span>Crear</span>
                        </a>
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th id="th-id">ID</th>
                                        <th id="th-name">Nombre</th>
                                        <th id="th-business-type">Tipo de Negocio</th>
                                        <th id="th-phone">Teléfono</th>
                                        <th id="th-image">Imagen</th>
                                        <th id="th-address-text">Dirección Texto</th>
                                        <th id="th-actions">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comercios as $comercio)
                                    <tr>
                                        <td>{{ $comercio->idComercio }}</td>
                                        <td>{{ $comercio->nombreComercio }}</td>
                                        <td>{{ $comercio->tipoNegocio }}</td>
                                        <td>{{ $comercio->telefonoComercio }}</td>
                                        <td>
                                            @if ($comercio->imagen)
                                                <img src="{{ asset($comercio->imagen) }}" alt="{{ $comercio->nombreComercio }}" class="img-fluid" width="120px">
                                            @else
                                                <span id="img-not-available">No disponible</span>
                                            @endif
                                        </td>
                                        <td>{{ $comercio->direccion_texto ?? 'No disponible' }}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('comercios.show', $comercio->idComercio) }}" class="btn btn-info me-1 w-80" title="Ver">
                                                    <i class="bi bi-eye"></i> <span class="view-text">Ver</span>
                                                </a>                             

                                                <a href="{{ route('comercios.edit', $comercio->idComercio) }}" class="btn btn-warning me-1 w-80" title="Editar">
                                                    <i class="bi bi-exclamation-triangle"></i> <span class="edit-text">Editar</span>
                                                </a>

                                                <form action="{{ route('comercios.destroy', $comercio->idComercio) }}" method="POST" class="form-eliminar w-80" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger w-100" title="Eliminar">
                                                        <i class="bi bi-exclamation-octagon"></i> <span class="delete-text">Eliminar</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('assets/js/Idioma.js') }}"></script>
@endsection
