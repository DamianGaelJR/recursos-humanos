<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class SalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salarios = Salario::with('empleado')->get();
        return view('salarios.index', compact('salarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $empleados = Empleado::all();
        return view('salarios.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
            'salario' => 'required|numeric|min:0',
            'fecha_registro' => 'required|date',
        ]);

        Salario::create($request->all());
        return redirect()->route('salarios.index')->with('success', 'Salario registrado.');
   
    }

    /**
     * Display the specified resource.
     */
    public function show(Salario $salario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salario $salario)
    {
        $empleados = Empleado::all();
        return view('salarios.edit', compact('salario', 'empleados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salario $salario)
    {
        $request->validate([
            'id_empleado' => 'required|exists:empleados,id',
            'salario' => 'required|numeric|min:0',
            'fecha_registro' => 'required|date',
        ]);

        $salario->update($request->all());
        return redirect()->route('salarios.index')->with('success', 'Salario actualizado.');
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salario $salario)
    {
        $salario->delete();
        return redirect()->route('salarios.index')->with('success', 'Salario eliminado.');

    }
}
