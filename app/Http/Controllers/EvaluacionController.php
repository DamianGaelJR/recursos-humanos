<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener evaluaciones con la relación de empleado
        $evaluaciones = Evaluacion::with('empleado')->get();
        return view('evaluaciones.index', compact('evaluaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todos los empleados para la creación de una nueva evaluación
        $empleados = Empleado::all();
        return view('evaluaciones.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',  // Verificar que el empleado exista
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',  // Asegurarse de que la calificación esté entre 1 y 5
            'comentarios' => 'nullable|string',
        ]);

        try {
            // Crear la nueva evaluación
            Evaluacion::create($request->all());
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación registrada exitosamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('evaluaciones.index')->with('error', 'Hubo un error al registrar la evaluación.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluacion $evaluacion)
    {
        // Aquí se puede agregar código para mostrar una evaluación específica
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluacion $evaluacion)
    {
        // Obtener empleados para la edición de la evaluación
        $empleados = Empleado::all();
        return view('evaluaciones.edit', compact('evaluacion', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        // Validar los datos del formulario
        $request->validate([
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',
            'comentarios' => 'nullable|string',
        ]);

        try {
            // Actualizar la evaluación
            $evaluacion->update($request->all());
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada exitosamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('evaluaciones.index')->with('error', 'Hubo un error al actualizar la evaluación.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluacion $evaluacion)
    {
        try {
            // Eliminar la evaluación
            $evaluacion->delete();
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada exitosamente.');
        } catch (\Exception $e) {
            // Manejo de errores
            return redirect()->route('evaluaciones.index')->with('error', 'Hubo un error al eliminar la evaluación.');
        }
    }
}
