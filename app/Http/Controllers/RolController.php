<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RolController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create', 'store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit', 'update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);
    }

    /**
     * Mostrar la lista de roles con paginación.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
        // Paginación de roles, 5 por página
        $roles = Role::all(); // Obtiene todos los roles
        return view('roles.index', compact('roles'));
    }

    /**
     * Mostrar el formulario para crear un nuevo rol.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener todos los permisos para asignarlos a un nuevo rol
        $permissions = Permission::all(); // Asegúrate de que esta variable sea plural
        return view('roles.crear', compact('permissions')); // Cambia 'permissions' en la vista a 'permissions'
    }

    /**
     * Almacenar un nuevo rol en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name',
            'permission' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el rol
        $role = Role::create(['name' => $request->input('name')]);

        // Obtener los permisos por sus IDs y sincronizar
        $permissions = Permission::whereIn('id', $request->input('permission'))->get();

        $role->syncPermissions($permissions);

        return redirect()->route('roles.index')
            ->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Mostrar el formulario para editar un rol específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permissions = Permission::all(); // Obtener todos los permisos disponibles
        $rolePermissions = $role->permissions->pluck('id')->toArray(); // Obtener permisos actuales del rol

        return view('roles.editar', compact('role', 'permissions', 'rolePermissions'));
    }

    /**
     * Actualizar un rol existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del rol
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permission' => 'required',
        ]);

        // Actualizar el nombre del rol y sincronizar permisos
        $role = Role::findOrFail($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));

        return redirect()->route('roles.index')
                         ->with('success', 'Rol actualizado exitosamente');
    }

    /**
     * Eliminar un rol específico de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Eliminar el rol de la base de datos
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
                         ->with('success', 'Rol eliminado exitosamente');
    }
}
