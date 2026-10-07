<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use App\Models\Cart; // Jangan lupa import Cart buat fitur Reorder
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // --- FITUR PENJUAL (SELLER) ---

    // 1. Lihat Semua Pesanan Masuk
    public function index()
    {
        $orders = Order::with(['user', 'menu'])
            ->where('id_penjual', Auth::id())
            ->latest()
            ->get();

        return view('seller.orders', compact('orders'));
    }

    // 2. Update Status Pesanan (Terima/Tolak/Selesai)
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        if ($order->id_penjual != Auth::id()) {
            abort(403);
        }

        $order->update(['status' => $request->status]);
        
        return back()->with('success', 'Status Pesanan Diupdate: ' . $request->status);
    }

    // --- FITUR PEMBELI (BUYER) ---

    // 3. Beli Langsung (Tanpa Keranjang)
    public function store(Request $request)
    {
        $request->validate([
            'id_menu' => 'required|exists:menus,id_menu',
            'jumlah' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->id_menu);

        if($menu->stok < $request->jumlah) {
            return back()->with('error', 'Waduh, stok habis keduluan orang lain!');
        }

        Order::create([
            'id_user' => Auth::id(),
            'id_penjual' => $menu->id_user,
            'id_menu' => $menu->id_menu,
            'jumlah' => $request->jumlah,
            'total_harga' => $menu->harga * $request->jumlah,
            'status' => 'Menunggu'
        ]);

        $menu->decrement('stok', $request->jumlah);

        return back()->with('success', 'Pesanan Berhasil! Silakan tunggu konfirmasi penjual ya ⚡');
    }

    // 4. Lihat Riwayat Pesanan Saya
    public function myOrders()
    {
        $orders = Order::with('menu')
            ->where('id_user', Auth::id())
            ->latest()
            ->get();

        return view('buyer.orders', compact('orders'));
    }

    // 5. Batalkan Pesanan
    public function cancelOrder($id)
    {
        $order = Order::findOrFail($id);

        if ($order->id_user != Auth::id()) {
            return back()->with('error', 'Akses ditolak!');
        }

        if ($order->status != 'Menunggu') {
            return back()->with('error', 'Pesanan sudah diproses, tidak bisa dibatalkan!');
        }

        $order->update(['status' => 'Dibatalkan']);
        $order->menu->increment('stok', $order->jumlah);

        return back()->with('success', 'Pesanan dibatalkan. Stok barang telah dikembalikan.');
    }

    // 6. FITUR BELI LAGI (REORDER) - BARU!
    public function reorder($id)
    {
        $order = Order::findOrFail($id);
        
        // Cek stok menu saat ini
        if($order->menu->stok < 1) {
            return back()->with('error', 'Yah, menu ini lagi kosong stoknya!');
        }

        // Masukkan ke Keranjang
        $existingCart = Cart::where('id_user', Auth::id())
                            ->where('id_menu', $order->id_menu)
                            ->first();

        if($existingCart) {
            $existingCart->increment('jumlah', 1);
        } else {
            Cart::create([
                'id_user' => Auth::id(),
                'id_menu' => $order->id_menu,
                'jumlah' => 1 // Default beli 1 aja dulu
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Menu berhasil masuk keranjang lagi! 🛒');
    }
}