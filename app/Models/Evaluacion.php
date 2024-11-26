<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluacion extends Model
{
    use HasFactory;

    // Especificar el nombre correcto de la tabla si no sigue la convención
    protected $table = 'evaluaciones';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = ['id_empleado', 'fecha', 'calificacion', 'comentarios'];

    /**
     * Relación con el modelo Empleado
     * Una evaluación pertenece a un empleado.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}
