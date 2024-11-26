<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\Rol;
use App\Models\Departamento;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    /**
     * Mostrar una lista de los empleados.
     */
    public function index()
    {
        // Obtener empleados con sus relaciones (departamento y rol)
        $empleados = Empleado::with(['departamento', 'rol'])->get();
        return view('empleados.index', compact('empleados'));
    }

    /**
     * Mostrar el formulario para crear un nuevo empleado.
     */
    public function create()
    {
        // Obtener departamentos y roles para los select del formulario
        $departamentos = Departamento::all();
        $roles = Rol::all();
        return view('empleados.create', compact('departamentos', 'roles'));
    }

    /**
     * Guardar un nuevo empleado en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:empleados,email',
            'telefono' => 'nullable|string|max:15',
            'fecha_contratacion' => 'required|date',
            'departamento_id' => 'required|exists:departamentos,id',
            'rol_id' => 'required|exists:roles,id',
        ]);
        Empleado::create($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('empleados.index')->with('success', 'Empleado agregado correctamente.');
        /*
        try {
             //Crear el empleado
            Empleado::create($request->all());
            return redirect()->route('empleados.index')->with('success', 'Empleado creado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear el empleado. Inténtalo nuevamente.');
        }*/
    }

    /**
     * Mostrar los detalles de un empleado específico.
     */
    public function show(Empleado $empleado)
    {
        // Cargar las relaciones necesarias
        $empleado->load(['departamento', 'rol']);
        return view('empleados.show', compact('empleado'));
    }

    /**
     * Mostrar el formulario para editar un empleado existente.
     */
    public function edit(Empleado $empleado)
    {
        // Obtener departamentos y roles para los select del formulario
        $departamentos = Departamento::all();
        $roles = Rol::all();
        return view('empleados.edit', compact('empleado', 'departamentos', 'roles'));
    }

    /**
     * Actualizar un empleado en la base de datos.
     */
    public function update(Request $request, Empleado $empleado)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|unique:empleados,email,' . $empleado->id,
            'telefono' => 'nullable|string|max:15',
            'fecha_contratacion' => 'required|date',
            'departamento_id' => 'required|exists:departamentos,id',
            'rol_id' => 'required|exists:roles,id',
        ]);

        try {
            // Actualizar el empleado
            $empleado->update($request->all());
            return redirect()->route('empleados.index')->with('success', 'Empleado actualizado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al actualizar el empleado. Inténtalo nuevamente.');
        }
    }

    /**
     * Eliminar un empleado de la base de datos.
     */
    public function destroy(Empleado $empleado)
    {
        try {
            // Eliminar el empleado
            $empleado->delete();
            return redirect()->route('empleados.index')->with('success', 'Empleado eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el empleado. Inténtalo nuevamente.');
        }
    }
}
