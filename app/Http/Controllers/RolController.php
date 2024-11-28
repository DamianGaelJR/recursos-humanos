<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Mostrar una lista de roles.
     */
    public function index()
    {
        $roles = Rol::all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Mostrar el formulario para crear un nuevo rol.
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Almacenar un rol recién creado en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:100|unique:roles,nombre',
            'descripcion' => 'required|max:255',
        ]);

        Rol::create($request->all());

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    /**
     * Mostrar un rol específico (opcional).
     */
    public function show(Rol $rol)
    {
        return view('roles.show', compact('rol'));
    }

    /**
     * Mostrar el formulario para editar un rol existente.
     */
    public function edit(Rol $role)
    {
        return view('roles.edit', compact('role'));
    }

    /**
     * Actualizar un rol existente en la base de datos.
     */
    public function update(Request $request, Rol $role)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        // Otras reglas de validación
    ]);

    $role->update($request->all());

    return redirect()->route('roles.index')->with('success', 'Rol actualizado correctamente');
}


    /**
     * Eliminar un rol de la base de datos.
     */
    public function destroy(Rol $rol)
    {
        $rol->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
