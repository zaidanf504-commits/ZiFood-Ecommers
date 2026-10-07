<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_menu',
        'id_penjual',
        'jumlah',
        'total_harga',
        'status',
        'metode_pembayaran',
        'lokasi_pengiriman',
        'catatan' // <--- TAMBAHKAN INI
    ];

    // Relasi ke Pembeli
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Relasi ke Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'id_menu');
    }
}