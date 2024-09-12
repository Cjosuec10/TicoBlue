
    <h1>Lista de Comercios</h1>
    <a href="{{ route('comercios.create') }}">Crear Comercio</a>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo de Negocio</th>
                <th>Correo</th>
                <th>Teléfono</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comercios as $comercio)
                <tr>
                    <td>{{ $comercio->idComercio }}</td>
                    <td>{{ $comercio->nombreComercio }}</td>
                    <td>{{ $comercio->tipoNegocio }}</td>
                    <td>{{ $comercio->correoComercio }}</td>
                    <td>{{ $comercio->telefonoComercio }}</td>
                    <td>{{ $comercio->descripcionComercio }}</td>
                    <td>
                        <a href="{{ route('comercios.show', $comercio->idComercio) }}">Ver</a>
                        <a href="{{ route('comercios.edit', $comercio->idComercio) }}">Editar</a>
                        <form action="{{ route('comercios.destroy', $comercio->idComercio) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

