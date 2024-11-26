<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salario extends Model
{
    use HasFactory;

    protected $fillable = ['id_empleado', 'salario', 'fecha_registro'];

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado');
    }
}
