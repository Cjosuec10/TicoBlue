
    <h1>Crear Comercio</h1>
    <form action="{{ route('comercios.store') }}" method="POST">
        @csrf
        <label for="nombreComercio">Nombre:</label>
        <input type="text" name="nombreComercio" required>

        <label for="tipoNegocio">Tipo de Negocio:</label>
        <input type="text" name="tipoNegocio" required>

        <label for="correoComercio">Correo:</label>
        <input type="email" name="correoComercio" required>

        <label for="telefonoComercio">Teléfono:</label>
        <input type="text" name="telefonoComercio">

        <label for="descripcionComercio">Descripción:</label>
        <textarea name="descripcionComercio"></textarea>

        <label for="idUsuario_fk">Usuario:</label>
        <input type="text" name="idUsuario_fk" required>

        <button type="submit">Guardar</button>
    </form>

