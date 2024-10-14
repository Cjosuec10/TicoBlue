<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
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
        /* Banderas */
        .flags {
            display: flex;
            gap: 10px;
        }
        .flags__item img {
            width: 30px;
            cursor: pointer;
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
        <div class="flags" id="flags">
            <div class="flags__item" data-language="es" onclick="selectLanguage(this)">
                <img src="/assets/icons/cr.svg" alt="Español">
            </div>
            <div class="flags__item" data-language="en" onclick="selectLanguage(this)">
                <img src="/assets/icons/us.svg" alt="English">
            </div>
        </div>
    </nav>

    <div class="content" id="content">
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

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/Idioma.js') }}"></script>
</body>
</html>
