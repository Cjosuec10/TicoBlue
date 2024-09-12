
    <h1>Editar Comercio</h1>
    <form action="{{ route('comercios.update', $comercio->idComercio) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nombreComercio">Nombre:</label>
        <input type="text" name="nombreComercio" value="{{ $comercio->nombreComercio }}" required>

        <label for="tipoNegocio">Tipo de Negocio:</label>
        <input type="text" name="tipoNegocio" value="{{ $comercio->tipoNegocio }}" required>

        <label for="correoComercio">Correo:</label>
        <input type="email" name="correoComercio" value="{{ $comercio->correoComercio }}" required>

        <label for="telefonoComercio">Teléfono:</label>
        <input type="text" name="telefonoComercio" value="{{ $comercio->telefonoComercio }}">

        <label for="descripcionComercio">Descripción:</label>
        <textarea name="descripcionComercio">{{ $comercio->descripcionComercio }}</textarea>

        <label for="idUsuario_fk">Usuario:</label>
        <input type="text" name="idUsuario_fk" value="{{ $comercio->idUsuario_fk }}" required>

        <button type="submit">Actualizar</button>
    </form>

