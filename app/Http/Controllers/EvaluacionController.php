<?php

namespace App\Http\Controllers;

use App\Models\Evaluacion;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class EvaluacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evaluaciones = Evaluacion::with('empleado')->get();
        return view('evaluaciones.index', compact('evaluaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::all();
        return view('evaluaciones.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',
            'comentarios' => 'nullable|string',
        ]);

        Evaluacion::create($request->all());
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación registrada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluacion $evaluacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluacion $evaluacion)
    {
        $empleados = Empleado::all();
        return view('evaluaciones.edit', compact('evaluacion', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluacion $evaluacion)
    {
        $request->validate([
            'fecha' => 'required|date',
            'calificacion' => 'required|integer|between:1,5',
            'comentarios' => 'nullable|string',
        ]);

        $evaluacion->update($request->all());

        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluacion $evaluacion)
    {
        $evaluacion->delete();
        return redirect()->route('evaluaciones.index')->with('success', 'Evaluación eliminada.');
    }
}
