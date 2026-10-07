<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        // KOLOM BARU TOKO
        'phone', 
        'bio', 
        'address', 
        'photo', 
        'cover'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // RELASI PENTING (JANGAN DIHAPUS)
    public function menus() { return $this->hasMany(Menu::class, 'id_user'); }
    public function carts() { return $this->hasMany(Cart::class, 'id_user'); }
    public function orders() { return $this->hasMany(Order::class, 'id_user'); }
}