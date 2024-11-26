<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'departamentos';

    // Permitir asignación masiva en estos campos
    protected $fillable = ['nombre', 'descripcion'];
}
