<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ReviewController;
use App\Models\Menu;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// 1. HALAMAN PUBLIK (Landing Page)
Route::get('/', function () {
    return view('welcome', ['menus' => Menu::all()]);
})->name('home');

// 2. GUEST (Belum Login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// 3. AUTH (Sudah Login)
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Transaksi Umum
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');

    // --- PENJUAL (SELLER) ---
    Route::middleware('role:penjual')->group(function () {
        // Dashboard & Finance
        Route::get('/seller/dashboard', [MenuController::class, 'index'])->name('seller.dashboard');
        Route::get('/seller/finance', [MenuController::class, 'finance'])->name('seller.finance'); 
        
        // Toko Saya (Profil Toko)
        Route::get('/seller/shop', [MenuController::class, 'shop'])->name('seller.shop');
        Route::put('/seller/shop/update', [MenuController::class, 'updateShop'])->name('seller.shop.update');
        
        // Produk (Menu Management)
        Route::get('/seller/products', [MenuController::class, 'myProducts'])->name('seller.products');
        Route::get('/seller/menu/add', [MenuController::class, 'create'])->name('menu.create');
        Route::post('/seller/menu/store', [MenuController::class, 'store'])->name('menu.store');
        Route::get('/seller/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/seller/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/seller/menu/delete/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
        
        // Pesanan Masuk & Review
        Route::get('/seller/orders', [OrderController::class, 'index'])->name('seller.orders');
        Route::patch('/seller/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/seller/reviews', [MenuController::class, 'reviews'])->name('seller.reviews');
    });

    // --- PEMBELI (BUYER) ---
    Route::middleware('role:pembeli')->group(function () {
        // Dashboard Pembeli
        Route::get('/dashboard', function () {
            $cartCount = Cart::where('id_user', Auth::id())->count();
            return view('buyer.dashboard', ['menus' => Menu::all(), 'cartCount' => $cartCount]);
        })->name('dashboard');

        // Explore & Toko
        Route::get('/explore', [MenuController::class, 'explore'])->name('buyer.explore');
        Route::get('/shops', [ShopController::class, 'index'])->name('buyer.shops.index');
        Route::get('/shops/{id}', [ShopController::class, 'show'])->name('buyer.shops.show');

        // CART & CHECKOUT
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');           // Lihat Keranjang
        Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');     // Tambah ke Keranjang
        
        // Update Jumlah (+/-)
        Route::patch('/cart/update/{id}', [CartController::class, 'updateQuantity'])->name('cart.update'); 
        
        Route::post('/cart/buy-now', [CartController::class, 'buyNow'])->name('cart.buyNow'); // Beli Langsung
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');// Hapus Item
        Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout'); // Checkout Semua
        
        // Pesanan Saya & Review
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('buyer.orders');
        Route::patch('/my-orders/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('buyer.orders.cancel');
        Route::post('/my-orders/reorder/{id}', [OrderController::class, 'reorder'])->name('buyer.orders.reorder');
        Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');

        // Profil Saya (Akun Pembeli)
        Route::get('/my-profile', [MenuController::class, 'buyerProfile'])->name('buyer.profile');
        Route::put('/my-profile/update', [MenuController::class, 'updateBuyerProfile'])->name('buyer.profile.update');
    });
});