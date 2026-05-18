<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // MySQL no permite modificar ENUMs con Blueprint directamente,
        // así que usamos SQL raw
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed', 'refunded') NOT NULL DEFAULT 'confirmed'");
    }

    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'confirmed') NOT NULL DEFAULT 'confirmed'");
    }
};
