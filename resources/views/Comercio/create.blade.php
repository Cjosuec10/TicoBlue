@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Comercio</h1>

    <div class="card">
        <div class="card-body">
            <!-- Agregamos el id "crearComercioForm" al formulario -->
            <form id="crearComercioForm" action="{{ route('comercios.store') }}" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf

                <!-- Nombre del Comercio -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="nombreComercio" class="form-label">Nombre del Comercio</label>
                    <input type="text" class="form-control" id="nombreComercio" name="nombreComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del comercio.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Tipo de Negocio -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="tipoNegocio" class="form-label">Tipo de Negocio</label>
                    <select class="form-select" id="tipoNegocio" name="tipoNegocio" required>
                        <option selected disabled value="">Seleccione el tipo de negocio</option>
                        <option value="Soda">Soda</option>
                        <option value="Restaurante">Restaurante</option>
                        <option value="Cafeterías">Cafeterías</option>
                        <option value="Mercadoslocales">Mercados locales</option>
                        <option value="Tiendasdeartesanías">Tiendas de artesanías</option>
                        <option value="Talleres">Talleres</option>
                        <option value="DeportesyOcio">Deportes y Ocio</option>
                        <option value="alojamientosalojamientos">alojamientos alojamientos</option>
                        <option value="ArteyEntretenimiento">Arte y Entretenimiento</option>
                        <option value="Educación">Educación</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione el tipo de negocio.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Correo del Comercio -->
                <div class="col-md-6">
                    <label for="correoComercio" class="form-label">Correo</label>
                    <input type="email" class="form-control" id="correoComercio" name="correoComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un correo válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Teléfono del Comercio -->
                <div class="col-md-6">
                    <label for="telefonoComercio" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefonoComercio" name="telefonoComercio" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un teléfono válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Descripción del Comercio -->
                <div class="col-md-12">
                    <label for="descripcionComercio" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcionComercio" name="descripcionComercio"></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>
                <!-- Selección de imagen -->
                <div class="col-md-6">
                    <label for="imagen" >Imagen</label>
                    <input type="file" id="imagen" name="imagen">
                </div>

                <!-- Dirección URL -->
                <div class="col-md-12">
                    <label for="direccion_url" class="form-label">ID del Mapa de Google</label>
                    <textarea class="form-control" id="direccion_url" name="direccion_url" rows="3" placeholder="Ingrese ID de Mapa de Google">{{ old('direccion_url', $comercio->direccion_url ?? '') }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese el ID de Mapa de Google
                    </div>
                </div>


                <!-- Dirección en Texto -->
                <div class="col-md-6">
                    <label for="direccion_texto" class="form-label">Dirección (Texto)</label>
                    <input type="text" class="form-control" id="direccion_texto" name="direccion_texto">
                    <div class="invalid-feedback">
                        Por favor, ingrese una dirección.
                    </div>
                </div>

                <!-- Selección de Usuario -->
                <div class="col-md-6">
                    <label for="idUsuario_fk" class="form-label">Usuario</label>
                    <select class="form-select" id="idUsuario_fk" name="idUsuario_fk" required>
                        <option selected disabled value="">Seleccione un usuario</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->idUsuario }}">{{ $usuario->nombre }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un usuario.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Botón para Enviar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Guardar -->
                    <button class="btn btn-success" type="submit">Guardar</button>

                    <!-- Botón Volver -->
                    <button type="button" class="btn btn-primary" onclick="window.history.back();">
                        Volver
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('crearComercioForm').addEventListener('submit', function(event) {
            // Verifica si el formulario es válido
            if (!this.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                this.classList.add('was-validated');
            } else {
                event.preventDefault(); // Evita que el formulario se envíe inmediatamente

                // Muestra la alerta rápida si el formulario es válido
                Swal.fire({
                    icon: "success",
                    title: "El comercio ha sido creado",
                    showConfirmButton: false,
                    timer: 2100
                });

                // Envía el formulario después de un breve retraso para permitir que se muestre la alerta
                setTimeout(() => {
                    this.submit();
                }, 1600); // Espera 1.6 segundos para que el SweetAlert desaparezca
            }
        });
    </script>
@endsection



