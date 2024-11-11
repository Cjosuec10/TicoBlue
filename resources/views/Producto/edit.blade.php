@extends('layout.administracion')

@section('content')
    <h1 class="card-title">Editar Producto</h1>

    <div class="card">
        <div class="card-body">
            <h1 class="card-title"></h1>
            <!-- Formulario para editar producto -->
            <form id="editarProductoForm" action="{{ route('productos.update', $producto->idProducto) }}" method="POST" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <!-- Nombre del Producto -->
                <div class="col-md-6">
                    <label for="nombreProducto" class="form-label">Nombre del Producto<span
                        class="text-danger">**</span></label>
                    <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" value="{{ $producto->nombreProducto }}" required placeholder="Ingrese el nombre del producto">
                    <div class="invalid-feedback">
                        Por favor, ingrese el nombre del producto.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Descripción del Producto -->
                <div class="col-md-6">
                    <label for="descripcionProducto" class="form-label">Descripción del Producto<span
                        class="text-danger">**</span></label>
                    <textarea class="form-control" id="descripcionProducto" name="descripcionProducto" placeholder="Ingrese una breve descripción del producto" required>{{ $producto->descripcionProducto }}</textarea>
                    <div class="invalid-feedback">
                        Por favor, ingrese una descripción.
                    </div>
                    <div class="valid-feedback">
                        ¡Correcto!
                    </div>
                </div>

                <!-- Precio del Producto -->
                <div class="col-md-6">
                    <label for="precioProducto" class="form-label">Precio del Producto<span
                        class="text-danger">**</span></label>
                    <input type="number" step="0.01" class="form-control" id="precioProducto" name="precioProducto" value="{{ $producto->precioProducto }}" required placeholder="Ingrese el precio en formato 0.00">
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
        <option value="Ropa" {{ $producto->categoria == 'Ropa' ? 'selected' : '' }}>Ropa</option>
        <option value="Electrónica" {{ $producto->categoria == 'Electrónica' ? 'selected' : '' }}>Electrónica</option>
        <option value="Hogar" {{ $producto->categoria == 'Hogar' ? 'selected' : '' }}>Hogar</option>
        <option value="Juguetes" {{ $producto->categoria == 'Juguetes' ? 'selected' : '' }}>Juguetes</option>
        <option value="Libros" {{ $producto->categoria == 'Libros' ? 'selected' : '' }}>Libros</option>
        <option value="Deportes" {{ $producto->categoria == 'Deportes' ? 'selected' : '' }}>Deportes</option>
        <option value="Salud y Belleza" {{ $producto->categoria == 'Salud y Belleza' ? 'selected' : '' }}>Salud y Belleza</option>
        <option value="Automóviles" {{ $producto->categoria == 'Automóviles' ? 'selected' : '' }}>Automóviles</option>
        <option value="Joyería" {{ $producto->categoria == 'Joyería' ? 'selected' : '' }}>Joyería</option>
        <option value="Alimentos y Bebidas" {{ $producto->categoria == 'Alimentos y Bebidas' ? 'selected' : '' }}>Alimentos y Bebidas</option>
        <option value="Muebles" {{ $producto->categoria == 'Muebles' ? 'selected' : '' }}>Muebles</option>
        <option value="Mascotas" {{ $producto->categoria == 'Mascotas' ? 'selected' : '' }}>Mascotas</option>
        <option value="Accesorios" {{ $producto->categoria == 'Accesorios' ? 'selected' : '' }}>Accesorios</option>
        <option value="Herramientas" {{ $producto->categoria == 'Herramientas' ? 'selected' : '' }}>Herramientas</option>
        <option value="Hospedaje" {{ $producto->categoria == 'Hospedaje' ? 'selected' : '' }}>Hospedaje</option>
        <option value="Jardinería" {{ $producto->categoria == 'Jardinería' ? 'selected' : '' }}>Jardinería</option>
        <option value="Videojuegos" {{ $producto->categoria == 'Videojuegos' ? 'selected' : '' }}>Videojuegos</option>
        <option value="Instrumentos Musicales" {{ $producto->categoria == 'Instrumentos Musicales' ? 'selected' : '' }}>Instrumentos Musicales</option>
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
                            <option value="{{ $comercio->idComercio }}" {{ $producto->idComercio_fk == $comercio->idComercio ? 'selected' : '' }}>
                                {{ $comercio->nombreComercio }}
                            </option>
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
                    @if($producto->imagenProducto)
                        <div class="mt-2">
                            <img src="{{ asset($producto->imagenProducto) }}" alt="Imagen del producto" width="150px">
                        </div>
                    @endif
                </div>


                <!-- Botón para Actualizar -->
                <div class="col-12 d-flex justify-content-center gap-2">
                    <!-- Botón Actualizar -->
                    <button class="btn btn-success" type="submit">Actualizar</button>

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
        document.getElementById('editarProductoForm').addEventListener('submit', function(event) {
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
                    title: "El producto ha sido actualizado",
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
