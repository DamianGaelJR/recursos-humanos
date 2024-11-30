<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    public function index()
    {
        // Obtener evaluaciones junto con sus empleados
        $evaluaciones = Evaluacion::with('empleado')->get();
        return view('evaluaciones.index', compact('evaluaciones'));
    }

    public function create()
    {
        $empleados = Empleado::all(); // Obtener todos los empleados
        return view('evaluaciones.create', compact('empleados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',
            'comentarios' => 'nullable|string',
        ]);

        try {
            Evaluacion::create($request->all());
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación registrada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('evaluaciones.index')->with('error', 'Error al registrar la evaluación.');
        }
    }

    public function edit(Evaluacion $evaluacion)
    {
        $empleados = Empleado::all();
        return view('evaluaciones.edit', compact('evaluacion', 'empleados'));
    }

    public function update(Request $request, Evaluacion $evaluacion)
    {
        $request->validate([
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',
            'comentarios' => 'nullable|string',
        ]);

        try {
            $evaluacion->update($request->all());
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('evaluaciones.index')->with('error', 'Error al actualizar la evaluación.');
        }
    }

    public function destroy(Evaluacion $evaluacion)
    {
        try {
            $evaluacion->delete();
            return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('evaluaciones.index')->with('error', 'Error al eliminar la evaluación.');
        }
    }
}
