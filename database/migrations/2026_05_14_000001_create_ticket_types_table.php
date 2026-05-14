<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ticket_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('festival_id')->constrained()->onDelete('cascade');
            $table->string('name'); // General, VIP, Early Bird...
            $table->decimal('price', 8, 2);
            $table->unsignedInteger('quantity'); // aforo máximo
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ticket_types');
    }
};
