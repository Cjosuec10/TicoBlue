<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        nav {
            background-color: #333;
            padding: 1rem;
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: space-around;
        }
        nav ul li {
            margin: 0;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 1rem;
            display: block;
        }
        nav ul li a:hover {
            background-color: #575757;
        }
        .content {
            padding: 2rem;
        }
    </style>
</head>
<body>

    <nav>
        <ul>
            <li><a href="#login">Login y Registro</a></li>
            <li><a href="{{ route('comercios.index') }}">Comercios</a></li>

            <li><a href="#roles">Roles</a></li>
            <li><a href="#usuario">Usuario</a></li>
            <li><a href="#productos">Productos</a></li>
        </ul>
    </nav>

    <a href="{{ route('set.language', ['lang' => 'en']) }}">English</a> | 
<a href="{{ route('set.language', ['lang' => 'es']) }}">Español</a>


    <div class="content">
        <section id="login">
            <h2>Login y Registro</h2>
            <p>Contenido relacionado con el login y el registro de usuarios.</p>
        </section>

        <section id="alojamientos">
            <h2>Alojamientos</h2>
            <p>Información sobre los alojamientos disponibles.</p>
        </section>

        <section id="roles">
            <h2>Roles</h2>
            <p>Descripción de los diferentes roles de usuario en el sistema.</p>
        </section>

        <section id="usuario">
            <h2>Usuario</h2>
            <p>Gestión y perfil de usuario.</p>
        </section>

        <section id="productos">
            <h2>Productos</h2>
            <p>Listado de productos disponibles.</p>
        </section>
    </div>

</body>
</html>
