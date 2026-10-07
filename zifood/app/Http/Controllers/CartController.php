<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('id_user', Auth::id())->with('menu')->get();
        return view('buyer.cart', compact('carts'));
    }

    public function addToCart(Request $request)
    {
        $request->validate(['id_menu' => 'required|exists:menus,id_menu']);
        $menu = Menu::findOrFail($request->id_menu);

        if($menu->stok < 1) return back()->with('error', 'Stok habis, Bro! 😢');

        $existingCart = Cart::where('id_user', Auth::id())->where('id_menu', $request->id_menu)->first();

        if ($existingCart) {
            $existingCart->increment('jumlah');
        } else {
            Cart::create(['id_user' => Auth::id(), 'id_menu' => $request->id_menu, 'jumlah' => 1]);
        }
        return back()->with('success', 'Berhasil masuk keranjang! 🛒');
    }

    // --- LOGIKA BARU: UPDATE JUMLAH (+ dan -) ---
    public function updateQuantity(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $menu = Menu::findOrFail($cart->id_menu);

        if($request->type == 'plus') {
            // Cek stok sebelum nambah
            if($menu->stok > $cart->jumlah) {
                $cart->increment('jumlah');
            } else {
                return back()->with('error', 'Stok mentok, gak bisa nambah lagi!');
            }
        } elseif ($request->type == 'minus') {
            // Minimal 1, kalau mau hapus pake tombol hapus
            if($cart->jumlah > 1) {
                $cart->decrement('jumlah');
            }
        }

        return back();
    }

    public function buyNow(Request $request)
    {
        // ... (Kode buyNow sama seperti sebelumnya) ...
        // Note: Buy Now biasanya tanpa catatan atau catatannya default
        // Kita fokus ke checkout keranjang dulu
        $request->validate(['id_menu' => 'required|exists:menus,id_menu']);
        $menu = Menu::findOrFail($request->id_menu);
        if($menu->stok < 1) return back()->with('error', 'Stok habis!');

        Order::create([
            'id_user' => Auth::id(),
            'id_menu' => $menu->id_menu,
            'id_penjual' => $menu->id_user,
            'jumlah' => 1,
            'total_harga' => $menu->harga,
            'status' => 'Menunggu',
            'metode_pembayaran' => 'Tunai',
            'lokasi_pengiriman' => Auth::user()->address ?? '-',
            'catatan' => 'Pesan Cepat' // Default note
        ]);
        return redirect()->route('buyer.orders')->with('success', 'Pesanan dibuat!');
    }

    public function destroy($id)
    {
        Cart::findOrFail($id)->delete();
        return back()->with('success', 'Dihapus dari keranjang.');
    }

    // --- UPDATE CHECKOUT: TERIMA CATATAN ---
    public function checkout(Request $request)
    {
        $carts = Cart::where('id_user', Auth::id())->get();

        if ($carts->isEmpty()) {
            return back()->with('error', 'Keranjang kosong!');
        }

        // Ambil catatan dari form
        $catatanUser = $request->input('catatan', '-');

        foreach ($carts as $item) {
            if($item->menu->stok >= $item->jumlah) {
                Order::create([
                    'id_user' => Auth::id(),
                    'id_menu' => $item->id_menu,
                    'id_penjual' => $item->menu->id_user,
                    'jumlah' => $item->jumlah,
                    'total_harga' => $item->menu->harga * $item->jumlah,
                    'status' => 'Menunggu',
                    'metode_pembayaran' => 'Tunai',
                    'lokasi_pengiriman' => Auth::user()->address ?? '-',
                    'catatan' => $catatanUser // <--- SIMPAN CATATAN KE DATABASE
                ]);
                
                // Kurangi stok (Opsional, kalau mau langsung potong stok)
                // $item->menu->decrement('stok', $item->jumlah);

                $item->delete();
            }
        }

        return redirect()->route('buyer.orders')->with('success', 'Checkout berhasil! Catatan sudah disampaikan ke penjual. 🔥');
    }
}