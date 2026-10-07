<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Cek dulu biar gak error kalau kolomnya udah ada
            if (!Schema::hasColumn('orders', 'metode_pembayaran')) {
                $table->string('metode_pembayaran')->default('Tunai')->after('status');
            }
            if (!Schema::hasColumn('orders', 'lokasi_pengiriman')) {
                $table->text('lokasi_pengiriman')->nullable()->after('metode_pembayaran');
            }
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['metode_pembayaran', 'lokasi_pengiriman']);
        });
    }
};