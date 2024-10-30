@extends('layout.inicio')

@section('title', 'Sobre Nosotros')

@section('content')

<main class="main bg-light" >

    <div class="container my-5 p-4">
        <!-- Encabezado principal -->
        <div class="text-center mb-5" data-aos="fade-down">
            <h1 class="display-4 fw-bold" style="color: #0159AA;">Sobre nosotros</h1>
            <p class="text-muted mt-2">Conoce más sobre nuestra historia, misión y equipo.</p>
        </div>

<!-- Sección de "Quiénes Somos", Misión y Visión -->
<section class="animated-card row align-items-center mb-5 bg-white p-4 rounded shadow-sm">
    <!-- Logo y Quiénes Somos -->
    <div class="col-md-5 text-center mb-3 mb-md-0 " data-aos="fade-down">
        <img src="/assets/img/ProyectoTICOBLUE.png" alt="Logo de TicoBlue" class="img-fluid" style="max-width: 100%; width: 400px;">
    </div>
    <div class="col-md-7"  data-aos="fade-down">
        <h2 class="h2 fw-semibold mb-3" style="color: #0159AA;">Quiénes Somos</h2>
        <p class="text-secondary" style="line-height: 1.8; font-size: 1.2rem;">
            En TicoBlue, conectamos a turistas y residentes con los negocios locales, pequeños emprendimientos y 
            actividades auténticas de la "Zona Azul" de la región Chorotega. Nuestra plataforma permite conocer y experimentar lo mejor de la región, 
            facilitando la reserva y exploración de alojamientos, restaurantes, eventos y productos únicos.
        </p>
    </div>

    <!-- División entre secciones para mejor separación visual -->
    <div class="w-100 mt-5 mb-5"></div>

    <!-- Sección de Misión y Visión -->
    <div class="row d-flex align-items-stretch" data-aos="fade-up-left">
    <div class="col-md-6 mb-4">
        <div class="p-4 h-100 rounded shadow-sm d-flex flex-column justify-content-center" style="background-color: #F3F7FA; min-height: 300px;">
            <h2 class="h4 fw-semibold mb-3 text-center" style="color: #0159AA;">Nuestra Misión</h2>
            <p class="text-secondary text-center" style="line-height: 1.8;">
                Promover el turismo sostenible en la Zona Azul de Nicoya mediante una plataforma accesible que dé visibilidad a los pequeños negocios locales, mejorando la economía y apoyando la cultura y tradiciones de la región.
            </p>
        </div>
    </div>
    <div class="col-md-6 mb-4" data-aos="fade-up-left">
        <div class="p-4 h-100 rounded shadow-sm d-flex flex-column justify-content-center" style="background-color: #F3F7FA; min-height: 300px;">
            <h2 class="h4 fw-semibold mb-3 text-center" style="color: #0159AA;">Nuestra Visión</h2>
            <p class="text-secondary text-center" style="line-height: 1.8;">
                Ser el sitio de referencia para explorar la autenticidad de la Zona Azul, apoyando el crecimiento de los negocios locales y ayudándolos a alcanzar una visibilidad global mientras preservamos el patrimonio de esta región única.
            </p>
        </div>
    </div>
</div>
</section>


<!-- Sección de Valores -->
<section class="animated-card card-container py-5 rounded bg-light" data-aos="flip-right">
    <h2 class="h4 fw-semibold mb-5 text-center" style="color: #0159AA;">Nuestros Valores</h2>
    <div class="row text-center gx-4 gy-5">
        <!-- Valor 1: Autenticidad -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 p-4" style="background-color: rgba(1, 89, 170, 0.9);">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-gem mb-3" style="font-size: 50px; color: #ffffff;"></i>
                    <h5 class="card-title fw-bold" style="color: #ffffff;">Autenticidad</h5>
                    <p class="card-text text-light text-center mt-3">
                        Promovemos la riqueza cultural y natural de la Zona Azul.
                    </p>
                </div>
            </div>
        </div>

        <!-- Valor 2: Sostenibilidad -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 p-4" style="background-color: rgba(1, 89, 170, 0.9);">
                <div class="card-body d-flex flex-column align-items-center">
                <i class="bi bi-recycle mb-3" style="font-size: 50px; color: #ffffff;"></i>
                    <h5 class="card-title fw-bold" style="color: #ffffff;">Sostenibilidad</h5>
                    <p class="card-text text-light text-center mt-3">
                        Fomentamos un turismo responsable y beneficioso para la región.
                    </p>
                </div>
            </div>
        </div>

        <!-- Valor 3: Accesibilidad -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100 rounded-4 p-4" style="background-color: rgba(1, 89, 170, 0.9);">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-arrows-fullscreen mb-3" style="font-size: 50px; color: #ffffff;"></i>
                    <h5 class="card-title fw-bold" style="color: #ffffff;">Accesibilidad</h5>
                    <p class="card-text text-light text-center mt-3">
                        Simplificamos la exploración y reserva de servicios locales.
                    </p>
                </div>
            </div>
        </div>

        <!-- Valor 4: Compromiso Comunitario -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4 p-4" style="background-color: rgba(1, 89, 170, 0.9);">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-people mb-3" style="font-size: 50px; color: #ffffff;"></i>
                    <h5 class="card-title fw-bold" style="color: #ffffff;">Compromiso Comunitario</h5>
                    <p class="card-text text-light text-center mt-3">
                        Impulsamos el desarrollo económico en colaboración con los emprendedores locales.
                    </p>
                </div>
            </div>
        </div>

        <!-- Valor 5: Innovación -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100 rounded-4 p-4" style="background-color: rgba(1, 89, 170, 0.9);">
                <div class="card-body d-flex flex-column align-items-center">
                    <i class="bi bi-lightbulb mb-3" style="font-size: 50px; color: #ffffff;"></i>
                    <h5 class="card-title fw-bold" style="color: #ffffff;">Innovación</h5>
                    <p class="card-text text-light text-center mt-3">
                        Utilizamos la tecnología para conectar a los usuarios con experiencias auténticas y facilitar su visita a la Zona Azul.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>





        <!-- Sección de Equipo -->
        <section class="mb-5 animated-card row align-items-center mb-5 bg-white p-4 rounded shadow-sm" data-aos="fade-up">
            <h2 class="fw-semibold mb-3 text-center">Nuestro equipo</h2>
            
            <div class="row text-center mt-4">
                <!-- Miembro del equipo en un card uniforme -->
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #F3F7FA;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="bi bi-person-circle mb-3" style="font-size: 50px; color: #01489C;"></i> <!-- Icono de desarrollador -->
                            <h5 class="card-title fw-semibold" style="color: #01489C;">Alfieri <br> Mora Jiménez</h5>
                            <p class="card-text text-muted">Desarrollador</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #F3F7FA;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="bi bi-person-circle mb-3" style="font-size: 50px; color: #01489C;"></i> <!-- Icono de desarrollador -->
                            <h5 class="card-title fw-semibold" style="color: #01489C;">Jean Carlos <br> Castro Quirós</h5>
                            <p class="card-text text-muted">Desarrollador</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #F3F7FA;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="bi bi-person-circle mb-3" style="font-size: 50px; color: #01489C;"></i> <!-- Icono de desarrollador -->
                            <h5 class="card-title fw-semibold" style="color: #01489C;">Yustin <br>Ordoñez Coronado</h5>
                            <p class="card-text text-muted">Desarrollador</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card border-0 shadow-sm h-100" style="background-color: #F3F7FA;">
                        <div class="card-body d-flex flex-column align-items-center">
                            <i class="bi bi-person-circle mb-3" style="font-size: 50px; color: #01489C;"></i> <!-- Icono de desarrollador -->
                            <h5 class="card-title fw-semibold" style="color: #01489C;">Carlos Josué <br>Ugalde López</h5>
                            <p class="card-text text-muted">Desarrollador</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <style>
        /* Estilo para el efecto hover en las tarjetas de la sección de Valores */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px); /* Movimiento hacia arriba */
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
    </style>
</main>

@endsection
