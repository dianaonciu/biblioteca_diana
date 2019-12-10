<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('prestamos');
        Schema::create('prestamos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('fecha_prestamo')->nullable();
            $table->dateTime('fecha_devolucion')->nullable();
            $table->time('hora_prestamo')->nullable();
            $table->unsignedInteger('libro_id');
            $table->unsignedInteger('usuario_id');
            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
