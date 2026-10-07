<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // Data Dummy untuk ngetes UI/UX Premium
        DB::table('menu')->insert([
            [
                'nama_MakananMinuman' => 'Ayam Bakar Madu Spesial',
                'kategori' => 'Makanan Berat',
                'harga' => 25000,
                'diskon' => 10,
                'foto' => 'https://images.unsplash.com/photo-1598515214211-89d3c73ae83b?q=80&w=500&auto=format&fit=crop',
                'created_at' => now(),
            ],
            [
                'nama_MakananMinuman' => 'Es Teh Manis Segar',
                'kategori' => 'Minuman',
                'harga' => 5000,
                'diskon' => 0,
                'foto' => 'https://images.unsplash.com/photo-1556679343-c7306c1976bc?q=80&w=500&auto=format&fit=crop',
                'created_at' => now(),
            ],
        ]);
    }
}