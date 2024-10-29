<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto', ['only' => ['index']]);
        $this->middleware('permission:crear-producto', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-producto', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-producto', ['only' => ['destroy']]);
    }

    public function index()
    {

        // Obtener los comercios del usuario autenticado
    $comercios = auth()->user()->comercios->pluck('idComercio');

        // Filtrar los productos que pertenecen a esos comercios
    $productos = Producto::whereIn('idComercio_fk', $comercios)->get();
        
    
        // Pasamos los productos a la vista
        return view('Producto.index', compact('productos'));
    }
    
    public function mostrarInformacionProductos(Request $request)
    {
       // Obtener solo productos activos, paginados
    $productos = Producto::where('activo', true)->paginate(8);
    
        // Verificar si es una solicitud AJAX para búsqueda
        if ($request->ajax()) {
            return view('frontend.productos_lista', compact('productos'))->render();
        }
    
        // Retornar la vista principal
        return view('frontend.productos', compact('productos'));
    }
    
    public function toggleActivation(Request $request, $id)
{
    $producto = Producto::findOrFail($id);
    $producto->activo = $request->input('activo');
    $producto->save();

    return response()->json(['success' => true]);
}


    public function buscar(Request $request)
    {
        $query = $request->input('q');

         // Obtener los comercios del usuario autenticado
    $comercios = auth()->user()->comercios->pluck('idComercio');
    
        // Filtrar productos por nombre o descripción y también por los comercios del usuario
    $productos = Producto::with('comercio')
    ->whereIn('idComercio_fk', $comercios)
    ->where(function($q) use ($query) {
        $q->where('nombreProducto', 'LIKE', "%{$query}%")
          ->orWhere('descripcionProducto', 'LIKE', "%{$query}%");
    })
    ->paginate(8);
    
        // Retornar productos con paginación en la respuesta JSON
        return response()->json([
            'productos' => $productos->items(),
            'pagination' => (string) $productos->links('pagination::bootstrap-4'),
        ]);
    }
    
    public function buscarInformativo(Request $request)
    {
        $query = $request->input('q');
        
        // Obtener solo los productos activos que coincidan con el criterio de búsqueda
        $productos = Producto::with('comercio')
                             ->where('activo', true) // Filtrar productos activos
                             ->where(function ($q) use ($query) {
                                 $q->where('nombreProducto', 'LIKE', "%{$query}%")
                                   ->orWhere('descripcionProducto', 'LIKE', "%{$query}%");
                             })
                             ->paginate(8);
        
        // Retornar productos con paginación en la respuesta JSON
        return response()->json([
            'productos' => $productos->items(),
            'pagination' => (string) $productos->links('pagination::bootstrap-4'),
        ]);
    }
    


    public function create()
    {
        // Obtener solo los comercios ligados al usuario autenticado
        $comercios = auth()->user()->comercios; 
        
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
       // Obtener solo los comercios ligados al usuario autenticado
       $comercios = auth()->user()->comercios; 
        
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

    public function activar($id)
{
    $producto = Producto::findOrFail($id);
    $producto->activo = true;
    $producto->save();

    return redirect()->route('productos.index')->with('success', 'Producto activado exitosamente.');
}

public function desactivar($id)
{
    $producto = Producto::findOrFail($id);
    $producto->activo = false;
    $producto->save();

    return redirect()->route('productos.index')->with('success', 'Producto desactivado exitosamente.');
}

}
