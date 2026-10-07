<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | ZiFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('buyer.explore') }}" class="flex items-center gap-2 text-slate-500 hover:text-orange-600 font-bold transition group">
            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-orange-50 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            </div>
            <span>Kembali Belanja</span>
        </a>
        <div class="font-black text-xl tracking-tighter text-slate-800">ZiFood <span class="text-orange-600">.</span></div>
        <div class="w-20"></div>
    </nav>

    <main class="flex-1 w-full max-w-7xl mx-auto px-6 pt-28 pb-20">
        
        <div class="mb-8">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Keranjang Kamu 🛒</h1>
            <p class="text-slate-500 font-medium mt-1">Cek lagi pesananmu sebelum checkout ya.</p>
        </div>

        @if(session('success'))
        <div class="mb-8 bg-green-50 text-green-700 px-6 py-4 rounded-2xl border border-green-100 flex items-center gap-4 shadow-sm animate-bounce">
            <span class="text-2xl">✅</span> <p class="font-bold">{{ session('success') }}</p>
        </div>
        @endif
        @if(session('error'))
        <div class="mb-8 bg-red-50 text-red-700 px-6 py-4 rounded-2xl border border-red-100 flex items-center gap-4 shadow-sm animate-pulse">
            <span class="text-2xl">⚠️</span> <p class="font-bold">{{ session('error') }}</p>
        </div>
        @endif

        @if($carts->count() > 0)
            @php 
                $totalBayar = 0; 
                $biayaLayanan = 2000; 
            @endphp

            <form action="{{ route('cart.checkout') }}" method="POST" id="checkoutForm">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
                
                <div class="lg:col-span-2 space-y-6">
                    @foreach($carts as $cart)
                        @php 
                            $subtotal = $cart->menu->harga * $cart->jumlah; 
                            $totalBayar += $subtotal;
                        @endphp
                        
                        <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition duration-300 flex flex-col md:flex-row gap-6 items-center group relative">
                            <div class="w-24 h-24 rounded-2xl overflow-hidden shrink-0 border border-slate-100 bg-slate-50">
                                <img src="{{ asset('uploads/'.$cart->menu->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>

                            <div class="flex-1 min-w-0 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <span class="text-[10px] font-bold bg-orange-50 text-orange-600 px-2 py-0.5 rounded-md uppercase tracking-widest">{{ $cart->menu->kategori }}</span>
                                        <h3 class="text-lg font-black text-slate-800 mt-1 truncate pr-4">{{ $cart->menu->nama_MakananMinuman }}</h3>
                                    </div>
                                    <button type="submit" form="delete-{{ $cart->id }}" class="text-slate-300 hover:text-red-500 transition p-2" title="Hapus item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                                
                                <div class="flex flex-col md:flex-row items-end md:items-center justify-between mt-3 gap-4">
                                    <div class="flex flex-col">
                                        <p class="text-xs text-slate-400 font-bold mb-0.5">Harga Satuan</p>
                                        <p class="font-bold text-slate-600">Rp{{ number_format($cart->menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                    
                                    <div class="flex items-center gap-4">
                                        <button type="submit" form="qty-minus-{{ $cart->id }}" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center font-bold text-slate-600 transition">-</button>
                                        
                                        <span class="font-black text-slate-800 w-6 text-center">{{ $cart->jumlah }}</span>
                                        
                                        <button type="submit" form="qty-plus-{{ $cart->id }}" class="w-8 h-8 rounded-full bg-slate-900 hover:bg-orange-600 flex items-center justify-center font-bold text-white transition shadow-lg shadow-orange-100">+</button>
                                    </div>

                                    <div class="text-right min-w-[100px]">
                                        <p class="text-xs text-slate-400 font-bold mb-0.5">Subtotal</p>
                                        <p class="text-lg font-black text-orange-600">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm">
                        <label class="flex items-center gap-2 text-sm font-bold text-slate-700 mb-3">
                            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            Catatan untuk Penjual (Opsional)
                        </label>
                        <textarea name="catatan" rows="2" placeholder="Contoh: Jangan terlalu pedas ya, nasinya banyakin..." class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-orange-500 transition resize-none font-medium text-slate-700"></textarea>
                        <p class="text-[10px] text-slate-400 mt-2 italic">*Catatan ini akan dikirim ke penjual saat kamu checkout.</p>
                    </div>
                </div>

                <div class="lg:col-span-1 sticky top-28">
                    <div class="bg-white p-6 rounded-[2.5rem] shadow-xl border border-slate-100 relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-10 -mt-10 blur-2xl opacity-50"></div>

                        <h3 class="text-lg font-black text-slate-800 mb-6 relative z-10">Ringkasan Belanja</h3>
                        
                        <div class="space-y-4 relative z-10">
                            <div class="flex justify-between items-center text-sm text-slate-500">
                                <span>Total Harga ({{ $carts->sum('jumlah') }} item)</span>
                                <span class="font-bold text-slate-800">Rp{{ number_format($totalBayar, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm text-slate-500">
                                <span>Biaya Layanan</span>
                                <span class="font-bold text-slate-800">Rp{{ number_format($biayaLayanan, 0, ',', '.') }}</span>
                            </div>
                            <div class="h-px bg-slate-100 border-t border-dashed border-slate-200 my-4"></div>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-base font-bold text-slate-800">Total Tagihan</span>
                                <span class="text-2xl font-black text-orange-600">Rp{{ number_format($totalBayar + $biayaLayanan, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Metode Pembayaran</p>
                            <div class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="font-bold text-slate-700 text-sm">Tunai (Bayar di Kasir)</span>
                            </div>
                        </div>

                        <div class="mt-8">
                            <button type="submit" class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm uppercase tracking-widest shadow-lg shadow-orange-200 hover:bg-orange-600 hover:shadow-orange-400 transition transform active:scale-95 flex items-center justify-center gap-2 group">
                                <span>Checkout Sekarang</span>
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                            <p class="text-center text-[10px] text-slate-400 mt-3 font-medium">
                                Dengan checkout, kamu setuju dengan S&K ZiFood.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            </form>

            @foreach($carts as $cart)
                <form id="delete-{{ $cart->id }}" action="{{ route('cart.destroy', $cart->id) }}" method="POST" class="hidden">
                    @csrf @method('DELETE')
                </form>
                <form id="qty-minus-{{ $cart->id }}" action="{{ route('cart.update', $cart->id) }}" method="POST" class="hidden">
                    @csrf @method('PATCH') <input type="hidden" name="type" value="minus">
                </form>
                <form id="qty-plus-{{ $cart->id }}" action="{{ route('cart.update', $cart->id) }}" method="POST" class="hidden">
                    @csrf @method('PATCH') <input type="hidden" name="type" value="plus">
                </form>
            @endforeach

        @else
            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                <div class="w-32 h-32 bg-orange-50 rounded-full flex items-center justify-center mb-6 animate-pulse">
                    <span class="text-6xl">🛍️</span>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-2">Keranjang Masih Kosong</h3>
                <p class="text-slate-400 font-medium mb-8">Perut kenyang hati senang, yuk pesan sekarang!</p>
                <a href="{{ route('buyer.explore') }}" class="bg-orange-600 text-white px-8 py-4 rounded-2xl font-bold text-sm uppercase tracking-widest hover:bg-orange-700 transition shadow-lg shadow-orange-200">
                    Jelajahi Menu
                </a>
            </div>
        @endif

    </main>

</body>
</html>