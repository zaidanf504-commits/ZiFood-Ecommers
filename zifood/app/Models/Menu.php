<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Kunci utama: nama tabel dan primary key
    protected $table = 'menus'; 
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_MakananMinuman',
        'kategori',
        'harga',
        'stok',
        'foto',
        'id_user'
    ];

    // Relasi balik ke penjual
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}