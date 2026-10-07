<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZiFood Seller Centre | Enterprise Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .active-link { background: #fff1ec; color: #ff4d00; border-right: 4px solid #ff4d00; }
        .card-shadow { box-shadow: 0px 20px 25px -5px rgba(0, 0, 0, 0.02), 0px 10px 10px -5px rgba(0, 0, 0, 0.01); }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen">

    @php
        $id = Auth::id();
        // 1. Hitung Pesanan Baru (Status Menunggu)
        $pesananBaru = \App\Models\Order::where('id_penjual', $id)->where('status', 'Menunggu')->count();

        // 2. Hitung Pendapatan (Status Selesai)
        $pendapatan = \App\Models\Order::where('id_penjual', $id)->where('status', 'Selesai')->sum('total_harga');

        // 3. Hitung Rating Toko
        $avgRating = \App\Models\Review::whereHas('menu', function($q) use ($id) {
            $q->where('id_user', $id);
        })->avg('rating');
        $avgRating = $avgRating ? number_format($avgRating, 1) : '0.0';
    @endphp

    @if(session('success'))
    <div id="toast-success" class="fixed top-10 right-10 z-[100] transform transition-all duration-500 translate-x-full">
        <div class="bg-slate-900 text-white px-8 py-5 rounded-[2rem] shadow-2xl border border-slate-800 flex items-center space-x-4">
            <div class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center text-xl">✨</div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-orange-500">System Message</p>
                <p class="font-bold text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    <script>
        setTimeout(() => { document.getElementById('toast-success').classList.remove('translate-x-full'); }, 500);
        setTimeout(() => { document.getElementById('toast-success').classList.add('translate-x-full'); }, 4000);
    </script>
    @endif

    <aside class="w-80 bg-white border-r border-slate-100 h-screen sticky top-0 hidden lg:flex flex-col z-50">
        <div class="p-8 mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 bg-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-200">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tighter">ZiFood</h1>
                    <span class="text-[10px] font-extrabold text-orange-500 uppercase tracking-widest bg-orange-50 px-2 py-0.5 rounded-md">PRO SELLER</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 pb-10 custom-scrollbar">
            <div class="mb-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Business Overview</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.dashboard') }}" class="flex items-center space-x-3 px-4 py-3.5 active-link rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">🏠</span> <span>Dashboard Utama</span>
                    </a>
                </div>
            </div>

            <div class="mb-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Feedback</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.reviews') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">⭐</span> <span>Ulasan Pelanggan</span>
                    </a>
                </div>
            </div>

            <div class="mb-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Menu Management</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.products') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                    <span class="text-lg">📋</span> <span>Daftar Produk</span>
                    </a>
                    <a href="{{ route('menu.create') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl">➕</span> <span>Tambah Menu</span>
                    </a>
                </div>
            </div>

            <div class="mb-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Operations</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.orders') }}" class="flex items-center justify-between px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <div class="flex items-center space-x-3"><span class="text-xl italic font-black">📦</span> <span>Pesanan Masuk</span></div>
                        @if($pesananBaru > 0)
                        <span class="bg-orange-600 text-white text-[10px] px-2 py-0.5 rounded-lg font-black animate-pulse shadow-lg shadow-orange-200">{{ $pesananBaru }} New</span>
                        @endif
                    </a>
                    <a href="{{ route('seller.finance') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">💰</span> <span>Saldo & Finance</span>
                    </a>
                </div>
            </div>

            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Settings</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.shop') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">🏪</span> <span>Toko Saya</span>
                    </a>    
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-3.5 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all">
                            <span class="text-xl italic font-black">🚪</span> <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>
    </aside>

    <main class="flex-1 lg:max-h-screen lg:overflow-y-auto">
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 px-10 py-6 border-b border-slate-50 flex justify-between items-center">
            <h2 class="text-xl font-extrabold text-slate-800 italic uppercase tracking-tighter">Ringkasan Performa</h2>
            <div class="flex items-center space-x-6">
                <div class="text-right">
                    <p class="text-sm font-black text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-green-500 uppercase tracking-widest italic">● Toko Buka</p>
                </div>
                <a href="{{ route('seller.shop') }}" class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg overflow-hidden border-2 border-slate-100 hover:scale-105 transition">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('uploads/profiles/'.Auth::user()->photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @endif
                </a>
            </div>
        </header>

        <div class="p-10">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-50 group transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-xl flex items-center justify-center mb-6 text-2xl">🍔</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Produk Aktif</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-slate-800">{{ $totalProduk ?? 0 }}</h3>
                        <span class="text-xs font-bold text-green-500 italic">Live</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-50 group transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 text-2xl">📥</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Pesanan Baru</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-slate-800">{{ $pesananBaru }}</h3>
                        <span class="text-xs font-bold {{ $pesananBaru > 0 ? 'text-green-500 animate-pulse' : 'text-slate-300' }}">
                            {{ $pesananBaru > 0 ? 'Perlu Diproses' : 'No data' }}
                        </span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-50 group transition-all hover:-translate-y-2 italic">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center mb-6 text-2xl">💸</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest italic">Pendapatan</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-3xl font-black text-slate-800 italic truncate" title="Rp{{ number_format($pendapatan, 0, ',', '.') }}">
                            Rp{{ number_format($pendapatan, 0, ',', '.') }}
                        </h3>
                        <span class="text-xs font-bold text-green-500 italic">+Omzet</span>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-[2.5rem] card-shadow border border-slate-50 group transition-all hover:-translate-y-2">
                    <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center mb-6 text-2xl">⭐</div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rating Toko</p>
                    <div class="flex items-end justify-between mt-2">
                        <h3 class="text-4xl font-black text-slate-800">{{ $avgRating }}</h3>
                        <span class="text-xs font-bold text-yellow-500 italic">
                            {{ $avgRating >= 4.5 ? 'Excellent' : ($avgRating > 0 ? 'Good' : 'No Rating') }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex justify-between items-center mb-8 px-2">
                <div>
                    <h3 class="text-2xl font-black text-slate-800 tracking-tight italic uppercase">Katalog Masterpiece</h3>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Manage your culinary arts</p>
                </div>
                <a href="{{ route('menu.create') }}" class="bg-orange-600 text-white px-8 py-4 rounded-2xl font-extrabold text-xs uppercase tracking-widest hover:bg-orange-700 transition shadow-xl shadow-orange-100 transform active:scale-95">
                    + Tambah Menu Baru
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
                @forelse($menus as $menu)
                <div class="group bg-white rounded-[3rem] card-shadow border border-slate-50 overflow-hidden hover:shadow-2xl transition-all duration-500 flex flex-col">
                    <div class="relative h-56 overflow-hidden">
                        <img src="{{ asset('uploads/'.$menu->foto) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" 
                             onerror="this.src='https://via.placeholder.com/400x300?text=No+Image'">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1 rounded-xl shadow-sm border border-white/20">
                            <span class="text-[10px] font-black text-orange-600 uppercase italic tracking-tighter">{{ $menu->kategori }}</span>
                        </div>
                    </div>

                    <div class="p-8 flex-1 flex flex-col">
                        <div class="mb-6">
                            <h4 class="text-xl font-black text-slate-800 uppercase italic leading-tight tracking-tighter group-hover:text-orange-600 transition-colors">{{ $menu->nama_MakananMinuman }}</h4>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="w-2 h-2 {{ $menu->stok > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full animate-pulse"></span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest tracking-widest">
                                    {{ $menu->stok }} Unit Tersedia
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-auto flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="text-[8px] font-black text-slate-300 uppercase tracking-widest">Price Unit</span>
                                <span class="text-2xl font-black text-slate-900 italic tracking-tighter">Rp{{ number_format($menu->harga, 0, ',', '.') }}</span>
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('menu.edit', $menu->id_menu) }}" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-blue-50 hover:text-blue-600 transition shadow-sm border border-slate-100">
                                    ✏️
                                </a>
                                <form action="{{ route('menu.destroy', $menu->id_menu) }}" method="POST" onsubmit="return confirm('Hapus menu masterpiece ini dari katalog?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-11 h-11 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-red-50 hover:text-red-600 transition shadow-sm border border-slate-100">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center bg-white rounded-[3rem] card-shadow border border-slate-50 border-dashed">
                    <div class="text-6xl mb-4 opacity-20 animate-bounce">🍜</div>
                    <h4 class="text-2xl font-black text-slate-300 uppercase italic tracking-widest">Dapur Kamu Masih Dingin</h4>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-[10px] mt-2">Mulai upload menu masterpiece pertamamu!</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>

</body>
</html>