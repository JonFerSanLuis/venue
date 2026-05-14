<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_type_id')->constrained()->onDelete('cascade');
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('total_price', 8, 2);
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_phone')->nullable();
            $table->enum('status', ['pending', 'confirmed'])->default('confirmed');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['ticket_type_id']);
            $table->dropColumn(['user_id', 'ticket_type_id', 'quantity', 'total_price', 'buyer_name', 'buyer_email', 'buyer_phone', 'status']);
        });
    }
};
