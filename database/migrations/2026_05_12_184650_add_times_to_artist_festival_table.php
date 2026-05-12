<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Esto CREA la tabla que une a Artistas con Festivales y sus horas de actuación
        Schema::create('artist_festival', function (Blueprint $table) {
            $table->id();

            // Relación con el artista
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            // Relación con el festival
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');

            // Horas de la actuación de ese artista
            $table->time('performance_start')->nullable();
            $table->time('performance_end')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('artist_festival');
    }
};