<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seller->name }} | ZiFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .custom-scrollbar::-webkit-scrollbar { width: 0px; background: transparent; }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('buyer.explore') }}" class="flex items-center gap-2 text-slate-500 hover:text-orange-600 font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            <span>Kembali</span>
        </a>
        <div class="font-black text-xl tracking-tighter text-slate-800">ZiFood <span class="text-orange-600">.</span></div>
        <a href="{{ route('cart.index') }}" class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center hover:bg-orange-100 hover:text-orange-600 transition relative">
            🛒
            @php $cartCount = \App\Models\Cart::where('id_user', Auth::id())->sum('jumlah'); @endphp
            @if($cartCount > 0)
                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-[9px] font-black w-4 h-4 rounded-full flex items-center justify-center">{{ $cartCount }}</span>
            @endif
        </a>
    </nav>

    @if(session('success'))
    <div id="notif-success" class="fixed top-24 right-6 z-[100] bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
        <span class="text-xl">✨</span> 
        <div>
            <p class="font-bold text-sm">{{ session('success') }}</p>
        </div>
    </div>
    <script>
        setTimeout(() => { document.getElementById('notif-success').style.display = 'none'; }, 3000);
    </script>
    @endif

    @if(session('error'))
    <div id="notif-error" class="fixed top-24 right-6 z-[100] bg-red-500 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-pulse">
        <span class="text-xl">⚠️</span> 
        <div>
            <p class="font-bold text-sm">{{ session('error') }}</p>
        </div>
    </div>
    <script>
        setTimeout(() => { document.getElementById('notif-error').style.display = 'none'; }, 3000);
    </script>
    @endif

    <div class="relative w-full h-72 md:h-96 bg-slate-800 overflow-hidden mt-16">
        <img src="{{ $seller->cover ? asset('uploads/profiles/'.$seller->cover) : 'https://via.placeholder.com/1200x500?text=Cover+Toko+ZiFood' }}" 
             class="w-full h-full object-cover opacity-80">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
    </div>

    <div class="max-w-6xl mx-auto px-6 w-full -mt-24 relative z-10 mb-12">
        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-100 p-8 md:p-10 flex flex-col md:flex-row items-center md:items-end gap-8 text-center md:text-left">
            <div class="w-32 h-32 md:w-44 md:h-44 rounded-full border-4 border-white shadow-xl overflow-hidden bg-white shrink-0">
                <img src="{{ $seller->photo ? asset('uploads/profiles/'.$seller->photo) : 'https://ui-avatars.com/api/?name='.urlencode($seller->name).'&background=random' }}" 
                     class="w-full h-full object-cover">
            </div>
            <div class="flex-1">
                <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight mb-2 flex items-center justify-center md:justify-start gap-2">
                    {{ $seller->name }}
                    <svg class="w-6 h-6 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg>
                </h1>
                <p class="text-slate-500 font-medium text-sm md:text-base leading-relaxed max-w-2xl mx-auto md:mx-0">
                    {{ $seller->bio ?? 'Toko ini menyajikan makanan lezat dengan penuh cinta.' }}
                </p>
                <div class="flex flex-wrap justify-center md:justify-start gap-4 mt-6">
                    @if($seller->address)
                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                        📍 {{ $seller->address }}
                    </div>
                    @endif
                    <div class="flex items-center gap-1.5 text-xs font-bold text-slate-400 uppercase tracking-widest bg-slate-50 px-3 py-1.5 rounded-lg border border-slate-100">
                        ⭐ {{ $rating }} Rating
                    </div>
                </div>
            </div>
            <div class="flex flex-col gap-3 w-full md:w-auto">
                @if($seller->phone)
                <a href="https://wa.me/{{ $seller->phone }}" target="_blank" class="bg-green-500 text-white px-8 py-3 rounded-xl font-bold text-sm uppercase tracking-widest hover:bg-green-600 transition shadow-lg shadow-green-200 transform active:scale-95 flex items-center justify-center gap-2">
                    <span>💬 Chat Penjual</span>
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 pb-24 w-full">
        <div class="flex items-center gap-4 mb-8">
            <h3 class="text-2xl font-black text-slate-800 italic uppercase tracking-tight">Daftar Menu</h3>
            <div class="h-1 flex-1 bg-slate-100 rounded-full"></div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $menus->count() }} Item</span>
        </div>

        @if($menus->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach($menus as $menu)
                <div class="group bg-white rounded-[2.5rem] border border-slate-100 p-4 shadow-sm hover:shadow-2xl hover:border-orange-100 transition-all duration-300 hover:-translate-y-2 flex flex-col">
                    <div class="relative h-56 rounded-[2rem] overflow-hidden mb-5">
                        <img src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full border border-white/20 shadow-sm">
                            <span class="text-[10px] font-black text-orange-600 uppercase tracking-widest">{{ $menu->kategori }}</span>
                        </div>
                    </div>

                    <div class="px-2 pb-2 flex-1 flex flex-col">
                        <h4 class="text-lg font-black text-slate-800 uppercase italic leading-tight mb-2 line-clamp-2">{{ $menu->nama_MakananMinuman }}</h4>
                        
                        <div class="flex items-center gap-2 mb-6">
                            @if($menu->stok > 0)
                                <span class="w-2 h-2 rounded-full bg-green-500"></span>
                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tersedia: {{ $menu->stok }}</span>
                            @else
                                <span class="w-2 h-2 rounded-full bg-red-500"></span>
                                <span class="text-[10px] font-bold text-red-400 uppercase tracking-widest">Habis</span>
                            @endif
                        </div>

                        <div class="mb-4">
                            <p class="text-[9px] font-bold text-slate-300 uppercase tracking-widest">Harga</p>
                            <p class="text-xl font-black text-slate-800">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>

                        <div class="mt-auto grid grid-cols-5 gap-2">
                            @if($menu->stok > 0)
                                <form action="{{ route('cart.add') }}" method="POST" class="col-span-2">
                                    @csrf
                                    <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                                    <button type="submit" class="w-full h-12 bg-slate-100 rounded-2xl flex items-center justify-center text-slate-600 hover:bg-slate-200 hover:text-slate-900 transition active:scale-95 group/btn" title="Tambah ke Keranjang">
                                        🛒 <span class="text-[10px] ml-1 font-bold group-hover/btn:inline hidden">+1</span>
                                    </button>
                                </form>

                                <form action="{{ route('cart.buyNow') }}" method="POST" class="col-span-3">
                                    @csrf
                                    <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                                    <button type="submit" class="w-full h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-bold text-xs uppercase tracking-widest shadow-lg hover:bg-orange-600 transition active:scale-95">
                                        Beli Sekarang
                                    </button>
                                </form>
                            @else
                                <button disabled class="col-span-5 h-12 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 font-bold text-xs uppercase tracking-widest cursor-not-allowed border border-slate-100">
                                    Stok Habis
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                <div class="text-6xl mb-4 opacity-30">🍳</div>
                <h3 class="text-xl font-black text-slate-300 uppercase italic tracking-widest">Menu Belum Tersedia</h3>
                <p class="text-xs font-bold text-slate-400 mt-2">Penjual ini sedang menyiapkan masakan terbaiknya.</p>
            </div>
        @endif
    </div>

</body>
</html>