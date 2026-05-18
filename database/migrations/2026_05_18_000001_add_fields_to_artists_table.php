<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('country');
            $table->string('spotify_url')->nullable()->after('bio');
            $table->string('youtube_url')->nullable()->after('spotify_url');
        });
    }

    public function down()
    {
        Schema::table('artists', function (Blueprint $table) {
            $table->dropColumn(['bio', 'spotify_url', 'youtube_url']);
        });
    }
};
