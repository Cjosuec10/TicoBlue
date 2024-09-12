<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Comercio</title>
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

        form {
            background-color: #fff;
            padding: 20px;
            margin: 0 auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            margin-top: 20px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

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

</body>
</html>
