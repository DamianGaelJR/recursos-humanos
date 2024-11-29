<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evaluacion extends Model
{
    use HasFactory;

    protected $table = 'evaluaciones'; // Nombre de la tabla en la base de datos

    protected $fillable = ['id_empleado', 'fecha', 'calificacion', 'comentarios']; // Campos asignables

    /**
     * Relación con el modelo Empleado.
     * Una evaluación pertenece a un empleado.
     */
    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}
