<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        // Obtener todos los productos
        $productos = Producto::all();
        
        // Pasamos los productos a la vista
        return view('Producto.index', compact('productos'));
    }
    
    public function create()
    {
        // Obtener todos los comercios disponibles
        $comercios = \App\Models\Comercio::all();
        
        // Pasar los comercios a la vista
        return view('Producto.create', compact('comercios'));
    }

    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombreProducto' => 'required|max:255',
            'descripcionProducto' => 'nullable|max:1000',
            'precioProducto' => 'required|numeric',
            'categoria' => 'required|max:255',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'imagenProducto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación de imagen
        ]);

       // Crear un nuevo producto
       $producto = new Producto($request->except('imagenProducto'));

       // Si hay una imagen, procesarla y guardarla
       if ($request->hasFile('imagenProducto')) {
        $file = $request->file('imagenProducto');
        $destinationPath = 'img/imagen/'; // Cambia a la carpeta img/imagen/
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName); // Mover el archivo
        $producto->imagenProducto = $destinationPath . $fileName;
       }

       // Guardar el producto en la base de datos
       $producto->save();

       // Redirigir a la lista de productos con un mensaje de éxito
       return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
   }

    public function show(Producto $producto)
    {
        // Mostrar la vista de un producto específico
        return view('Producto.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        // Obtener todos los comercios disponibles
        $comercios = \App\Models\Comercio::all();
        
        // Pasar los comercios y el producto a la vista
        return view('Producto.edit', compact('producto', 'comercios'));
    }

    public function update(Request $request, Producto $producto)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombreProducto' => 'required|max:255',
            'descripcionProducto' => 'nullable|max:1000',
            'precioProducto' => 'required|numeric',
            'categoria' => 'required|max:255',
            'idComercio_fk' => 'required|exists:comercios,idComercio',
            'imagenProducto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

    
        // Actualizar el producto con los datos validados
        $producto->fill($request->except('imagenProducto'));

        // Si se subió una nueva imagen, actualizarla
        if ($request->hasFile('imagenProducto')) {
            $file = $request->file('imagenProducto');
        $destinationPath = 'img/imagen/'; // Cambia a la carpeta img/imagen/
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($destinationPath, $fileName); // Mover el archivo
        $producto->imagenProducto = $destinationPath . $fileName; // Guardar la ruta completa
        }

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        // Eliminar el producto
        $producto->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}