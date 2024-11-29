<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    // Nombre de la tabla en la base de datos
    protected $table = 'empleados';
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'fecha_contratacion',
        'id_departamento',
        'id_rol', // Cambiar a 'id_rol' si es el nombre en la base de datos
    ];
    

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'id_departamento');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol');
    }


    public function salarios()
    {
        return $this->hasMany(Salario::class, 'id_empleado');
    }

    public function evaluaciones()
    {
        return $this->hasMany(Evaluacion::class, 'id_empleado');
    }
}
