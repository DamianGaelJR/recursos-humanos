<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    /**
     * Mostrar una lista de los departamentos con la opción de búsqueda.
     */
    public function index(Request $request)
    {
        // Obtener el valor y campo de búsqueda desde la petición
        $campo = $request->input('campo', 'id'); // Por defecto, buscar por ID
        $valor = $request->input('valor', ''); // Valor de búsqueda

        // Filtrar departamentos según el campo de búsqueda
        $departamentosQuery = Departamento::query();
        
        if ($valor) {
            switch ($campo) {
                case 'id':
                    $departamentosQuery->where('id', 'like', "%{$valor}%");
                    break;
                case 'nombre':
                    $departamentosQuery->where('nombre', 'like', "%{$valor}%");
                    break;
                case 'descripcion':
                    $departamentosQuery->where('descripcion', 'like', "%{$valor}%");
                    break;
                default:
                    // Si el campo no es válido, se busca por ID por defecto
                    $departamentosQuery->where('id', 'like', "%{$valor}%");
                    break;
            }
        }

        // Obtener los departamentos filtrados
        $departamentos = $departamentosQuery->get();

        return view('departamentos.index', compact('departamentos'));
    }

    /**
     * Mostrar el formulario para crear un nuevo departamento.
     */
    public function create()
    {
        return view('departamentos.create');
    }

    /**
     * Guardar un nuevo departamento en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        Departamento::create($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('departamentos.index')->with('success', 'Departamento agregado correctamente.');
    }

    /**
     * Mostrar los detalles de un departamento específico.
     */
    public function show(Departamento $departamento)
    {
        return view('departamentos.show', compact('departamento'));
    }

    /**
     * Mostrar el formulario para editar un departamento existente.
     */
    public function edit(Departamento $departamento)
    {
        return view('departamentos.edit', compact('departamento'));
    }

    /**
     * Actualizar un departamento en la base de datos.
     */
    public function update(Request $request, Departamento $departamento)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
        ]);

        $departamento->update($request->all());

        // Redireccionar con mensaje de éxito
        return redirect()->route('departamentos.index')->with('success', 'Departamento actualizado exitosamente.');
    }

    /**
     * Eliminar un departamento de la base de datos.
     */
    public function destroy(Departamento $departamento)
    {
        try {
            // Eliminar el departamento
            $departamento->delete();
            return redirect()->route('departamentos.index')->with('success', 'Departamento eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al eliminar el departamento. Inténtalo nuevamente.');
        }
    }
}
