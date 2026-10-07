<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Review;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // 1. DAFTAR SEMUA TOKO (Halaman yang kamu ss)
    public function index()
    {
        // Ambil user role penjual + hitung jumlah menu mereka
        $shops = User::where('role', 'penjual')->withCount('menus')->get();
        
        return view('buyer.shops.index', compact('shops'));
    }

    // 2. DETAIL TOKO
    public function show($id, Request $request)
    {
        $seller = User::findOrFail($id);
        
        if($seller->role != 'penjual') {
            abort(404, 'Toko tidak ditemukan');
        }

        // Logic Filter
        $query = Menu::where('id_user', $id);
        if ($request->filled('search')) {
            $query->where('nama_MakananMinuman', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('kategori') && $request->kategori != 'Semua') {
            $query->where('kategori', $request->kategori);
        }
        $menus = $query->latest()->get();

        // Hitung Rating
        $rating = Review::whereHas('menu', function($q) use ($id) {
            $q->where('id_user', $id);
        })->avg('rating');
        $rating = $rating ? number_format($rating, 1) : '0.0';

        // Hitung Total Ulasan
        $totalReviews = Review::whereHas('menu', function($q) use ($id) {
            $q->where('id_user', $id);
        })->count();

        return view('buyer.shops.show', compact('seller', 'menus', 'rating', 'totalReviews'));
    }
}