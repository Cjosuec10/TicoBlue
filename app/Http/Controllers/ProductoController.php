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
        ]);

        // Crear el producto en la base de datos
        Producto::create($request->all());

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
        ]);

        // Actualizar el producto con los datos validados
        $producto->update($request->all());

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
