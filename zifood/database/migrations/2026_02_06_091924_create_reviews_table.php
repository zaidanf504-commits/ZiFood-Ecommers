<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade'); // Pembeli
            $table->foreignId('id_menu')->constrained('menus', 'id_menu')->onDelete('cascade'); // Menu
            $table->foreignId('id_order')->constrained('orders')->onDelete('cascade'); // Transaksi yg mana
            $table->integer('rating'); // 1-5 Bintang
            $table->text('komentar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};