<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->unsignedInteger('capacity');
            $table->text('description')->nullable();
        });

        Schema::table('festivals', function (Blueprint $table) {
            $table->foreignId('location_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('festivals', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropColumn('location_id');
        });

        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn(['name', 'address', 'city', 'country', 'capacity', 'description']);
        });
    }
};