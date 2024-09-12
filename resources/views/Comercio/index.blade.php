<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comercios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Azul claro */
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #007bff; /* Azul */
            text-align: center;
        }

        a {
            color: white;
            background-color: #007bff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #0056b3;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table td a {
            margin-right: 10px;
        }

        button {
            color: white;
            background-color: #dc3545;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }

        button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <h1>Lista de Comercios</h1>

    <a href="{{ route('comercios.create') }}">Crear Comercio</a>

    @if (session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif

    <table>
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

</body>
</html>
