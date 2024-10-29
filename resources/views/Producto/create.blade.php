@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Crear Producto</h1>

    <div class="card">
        <div class="card-body">
            <!-- Agregamos el id "crearProductoForm" al formulario -->
            <form id="crearProductoForm" action="{{ route('productos.store') }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                
                <!-- Nombre del Producto -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="nombreProducto" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del producto.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Descripción del Producto -->
                <div class="col-md-6">
                    <h5 class="card-title"></h5>
                    <label for="descripcionProducto" class="form-label">Descripción del Producto (opcional)</label>
                    <textarea class="form-control" id="descripcionProducto" name="descripcionProducto"></textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Precio del Producto -->
                <div class="col-md-6">
                    <label for="precioProducto" class="form-label">Precio del Producto</label>
                    <input type="number" step="0.01" class="form-control" id="precioProducto" name="precioProducto" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un precio válido.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

               <!-- Categoría del Producto -->
<div class="col-md-6">
    <label for="categoria" class="form-label">Categoría del Producto</label>
    <select class="form-select" id="categoria" name="categoria" required>
        <option selected disabled value="">Seleccione una categoría</option>
        <option value="Ropa">Ropa</option>
        <option value="Electrónica">Electrónica</option>
        <option value="Hogar">Hogar</option>
        <option value="Juguetes">Juguetes</option>
        <option value="Libros">Libros</option>
        <option value="Deportes">Deportes</option>
        <option value="Salud y Belleza">Salud y Belleza</option>
        <option value="Automóviles">Automóviles</option>
        <option value="Joyería">Joyería</option>
        <option value="Alimentos y Bebidas">Alimentos y Bebidas</option>
        <option value="Muebles">Muebles</option>
        <option value="Mascotas">Mascotas</option>
        <option value="Accesorios">Accesorios</option>
        <option value="Herramientas">Herramientas</option>
        <option value="Hospedaje">Hospedaje</option>
        <option value="Jardinería">Jardinería</option>
        <option value="Videojuegos">Videojuegos</option>
        <option value="Instrumentos Musicales">Instrumentos Musicales</option>
    </select>
    <div class="invalid-feedback">
        Por favor, seleccione una categoría.
    </div>
    <div class="valid-feedback">
        ¡Correcto!
    </div>
</div>


                <!-- Comercio asociado -->
                <div class="col-md-6">
                    <label for="idComercio_fk" class="form-label">Comercio Asociado</label>
                    <select class="form-select" id="idComercio_fk" name="idComercio_fk" required>
                        <option selected disabled value="">Seleccione un comercio</option>
                        @foreach($comercios as $comercio)
                            <option value="{{ $comercio->idComercio }}">{{ $comercio->nombreComercio }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un comercio.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                   <!-- Imagen del Producto -->
                   <div class="col-md-6">
    <label for="imagenProducto" class="form-label">Imagen (opcional)</label>
    <input type="file" class="form-control" id="imagenProducto" name="imagenProducto">
    
    @if(isset($producto) && $producto->imagenProducto)
        <div class="mt-2">
            <img src="{{ asset($producto->imagenProducto) }}" alt="Imagen del producto" width="150px">
        </div>
    @endif
</div>


                <!-- Botones de acción -->
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
        document.getElementById('crearProductoForm').addEventListener('submit', function(event) {
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
                    title: "El producto ha sido creado",
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
