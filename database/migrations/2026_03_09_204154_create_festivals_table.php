<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFestivalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('festivals', function (Blueprint $table) {
            $table->id(); // Crea el ID autonumérico
            $table->string('name'); // Columna para el nombre
            $table->string('location'); // Columna para la ciudad
            $table->string('style'); // Columna para el estilo musical
            $table->date('date'); // Columna para la fecha
            $table->string('image_url'); // Columna para la ruta de la foto
            $table->timestamps(); // Crea created_at y updated_at automáticamente
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('festivals');
    }
}
