<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariosTable extends Migration
{
    public function up()
    {
        Schema::create('salarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_empleado')->constrained('empleados')->onDelete('cascade');
            $table->decimal('salario', 10, 2);
            $table->date('fecha_registro');
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('salarios');
    }
}
