<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        // 1. Buat Tabel Menu Dulu
        // Tabel ini harus ada sebelum 'orders' karena 'orders' akan merujuk ke sini
        Schema::create('menus', function (Blueprint $table) {
            $table->id('id_menu'); // Primary Key kustom
            $table->string('nama_MakananMinuman');
            $table->string('kategori')->nullable();
            $table->integer('harga');
            $table->integer('stok');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('id_user'); // Foreign Key ke tabel users (penjual)
            $table->timestamps();
            
            // Relasi penjual yang memiliki menu ini
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        // 2. Baru Buat Tabel Pesanan (Orders)
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user'); // ID Pembeli
            $table->unsignedBigInteger('id_penjual'); // ID Penjual
            $table->unsignedBigInteger('id_menu'); // ID Menu yang dibeli
            $table->integer('jumlah');
            $table->decimal('total_harga', 10, 2);
            $table->enum('status', ['Menunggu', 'Diproses', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->timestamps();

            // Definisi Foreign Keys (Tali Penghubung)
            $table->foreign('id_menu')->references('id_menu')->on('menus')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_penjual')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        // Hapus orders dulu baru menus agar tidak ada error constraint
        Schema::dropIfExists('orders');
        Schema::dropIfExists('menus');
    }
};