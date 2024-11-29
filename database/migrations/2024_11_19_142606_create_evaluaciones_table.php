<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('evaluaciones', function (Blueprint $table) {
            $table->id(); // Llave primaria
            $table->foreignId('id_empleado')
                ->constrained('empleados') // Relación con la tabla 'empleados'
                ->onDelete('cascade') // Eliminación en cascada
                ->onUpdate('cascade'); // Actualización en cascada, opcional pero útil

            $table->date('fecha'); // Fecha de la evaluación
            $table->unsignedTinyInteger('calificacion') // Usar unsignedTinyInteger para calificaciones pequeñas
                  ->comment('Calificación de 1 a 5'); // Ayuda a documentar el esquema
            $table->text('comentarios')->nullable(); // Campo de comentarios opcional
            $table->timestamps(); // Campos de control de tiempo: created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('evaluaciones');
    }
}
