<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email')->unique();
            $table->string('telefono')->nullable();
            $table->date('fecha_contratacion')->nullable();
            
            // Relaciones con otras tablas
            $table->foreignId('id_departamento')
                  ->constrained('departamentos')
                  ->onDelete('cascade');
            
            $table->foreignId('id_rol')
                  ->constrained('roles')
                  ->onDelete('cascade');
            
            $table->timestamps(); // Para created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('empleados');
    }
}
