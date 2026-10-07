<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Cart;
use App\Models\Review;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class MenuController extends Controller
{
    // ====================================================
    // FITUR PENJUAL (SELLER)
    // ====================================================

    // Dashboard Penjual
    public function index()
    {
        $menus = Menu::where('id_user', Auth::id())->get();
        $totalProduk = $menus->count();
        $stokAman = $menus->where('stok', '>', 5)->count();
        $stokTipis = $menus->where('stok', '<=', 5)->count();
        return view('seller.dashboard', compact('menus', 'totalProduk', 'stokAman', 'stokTipis'));
    }

    // Daftar Produk Penjual
    public function myProducts()
    {
        $menus = Menu::where('id_user', Auth::id())->latest()->get();
        return view('seller.products', compact('menus'));
    }

    // Form Tambah Menu
    public function create() { return view('seller.create'); }

    // Simpan Menu Baru
    public function store(Request $request)
    {
        $request->validate([
            'nama_MakananMinuman' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string',
            // Tambahkan mimes webp agar file .webp kamu bisa diupload
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        $imageName = time().'.'.$request->foto->extension();  
        $request->foto->move(public_path('uploads'), $imageName);

        Menu::create([
            'id_user' => Auth::id(),
            'nama_MakananMinuman' => $request->nama_MakananMinuman,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'foto' => $imageName,
        ]);

        return redirect()->route('seller.products')->with('success', 'Menu Masterpiece berhasil dirilis! 🚀');
    }

    // Form Edit Menu
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->id_user != Auth::id()) abort(403);
        return view('seller.edit', compact('menu'));
    }

    // Update Menu
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->id_user != Auth::id()) abort(403);

        $request->validate([
            'nama_MakananMinuman' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'kategori' => 'required|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
        ]);

        if ($request->hasFile('foto')) {
            if(file_exists(public_path('uploads/'.$menu->foto))){
                unlink(public_path('uploads/'.$menu->foto));
            }
            $imageName = time().'.'.$request->foto->extension();  
            $request->foto->move(public_path('uploads'), $imageName);
            $menu->foto = $imageName;
        }

        $menu->update([
            'nama_MakananMinuman' => $request->nama_MakananMinuman,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'kategori' => $request->kategori,
            'foto' => $menu->foto,
        ]);

        return redirect()->route('seller.products')->with('success', 'Menu berhasil diupdate! ✨');
    }

    // Hapus Menu
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->id_user != Auth::id()) abort(403);
        
        if(file_exists(public_path('uploads/'.$menu->foto))){
            unlink(public_path('uploads/'.$menu->foto));
        }

        $menu->delete();
        return back()->with('success', 'Menu dihapus.');
    }

    // Halaman Keuangan Penjual
    public function finance()
    {
        $userId = Auth::id();
        $totalSaldo = Order::where('id_penjual', $userId)->where('status', 'Selesai')->sum('total_harga');
        $incomeThisMonth = Order::where('id_penjual', $userId)->where('status', 'Selesai')->whereMonth('created_at', now()->month)->sum('total_harga');
        $pendingSaldo = Order::where('id_penjual', $userId)->whereIn('status', ['Menunggu', 'Diproses'])->sum('total_harga');
        $transactions = Order::where('id_penjual', $userId)->where('status', 'Selesai')->latest()->get();

        return view('seller.finance', compact('totalSaldo', 'incomeThisMonth', 'pendingSaldo', 'transactions'));
    }

    // Review dari Pembeli
    public function reviews()
    {
        $reviews = Review::whereHas('menu', function($q) {
            $q->where('id_user', Auth::id());
        })->with(['user', 'menu'])->latest()->get();
        return view('seller.reviews', compact('reviews'));
    }

    // Halaman Profil Toko
    public function shop()
    {
        $user = Auth::user();
        $totalProduk = Menu::where('id_user', $user->id)->count();
        $rating = Review::whereHas('menu', function($q) use ($user) {
            $q->where('id_user', $user->id);
        })->avg('rating');
        $rating = $rating ? number_format($rating, 1) : '0.0';

        return view('seller.shop', compact('user', 'totalProduk', 'rating'));
    }

    // Update Profil Toko
    public function updateShop(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string|max:500',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $path = public_path('uploads/profiles');
        if(!File::exists($path)) { File::makeDirectory($path, 0777, true, true); }

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('uploads/profiles/'.$user->photo))) { 
                unlink(public_path('uploads/profiles/'.$user->photo)); 
            }
            $photoName = time().'_photo.'.$request->photo->extension();
            $request->photo->move($path, $photoName);
            $user->photo = $photoName;
        }

        if ($request->hasFile('cover')) {
            if ($user->cover && file_exists(public_path('uploads/profiles/'.$user->cover))) { 
                unlink(public_path('uploads/profiles/'.$user->cover)); 
            }
            $coverName = time().'_cover.'.$request->cover->extension();
            $request->cover->move($path, $coverName);
            $user->cover = $coverName;
        }

        $user->update([
            'name' => $request->name, 
            'phone' => $request->phone, 
            'bio' => $request->bio, 
            'address' => $request->address, 
            'photo' => $user->photo, 
            'cover' => $user->cover
        ]);

        return back()->with('success', 'Profil toko berhasil diperbarui! ✨');
    }

    // ====================================================
    // FITUR PEMBELI (BUYER)
    // ====================================================

    // Explore Menu
    public function explore(Request $request)
    {
        $query = Menu::query();
        if ($request->filled('search')) $query->where('nama_MakananMinuman', 'like', '%' . $request->search . '%');
        if ($request->filled('kategori') && $request->kategori != 'Semua') $query->where('kategori', $request->kategori);
        
        if ($request->filled('sort')) {
            if ($request->sort == 'termurah') $query->orderBy('harga', 'asc');
            elseif ($request->sort == 'termahal') $query->orderBy('harga', 'desc');
            elseif ($request->sort == 'terbaru') $query->latest();
        } else {
            $query->latest();
        }
        $menus = $query->get();
        return view('buyer.explore', compact('menus'));
    }

    // Profil Pembeli
    public function buyerProfile()
    {
        $user = Auth::user();
        $orders = Order::where('id_user', $user->id)->with('menu')->latest()->get();
        $totalSpent = $orders->where('status', 'Selesai')->sum('total_harga');
        $totalOrders = $orders->count();

        return view('buyer.profile', compact('user', 'orders', 'totalSpent', 'totalOrders'));
    }

    // Update Profil Pembeli
    public function updateBuyerProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ]);

        $path = public_path('uploads/profiles');
        if(!File::exists($path)) { File::makeDirectory($path, 0777, true, true); }

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('uploads/profiles/'.$user->photo))) {
                unlink(public_path('uploads/profiles/'.$user->photo));
            }
            $photoName = time().'_buyer.'.$request->photo->extension();
            $request->photo->move($path, $photoName);
            $user->photo = $photoName;
        }

        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'photo' => $user->photo,
        ]);

        return back()->with('success', 'Profil berhasil diupdate! ✨');
    }
}