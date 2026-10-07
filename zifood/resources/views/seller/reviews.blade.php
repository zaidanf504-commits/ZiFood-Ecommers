<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Pelanggan | ZiFood Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .active-link { background: #fff1ec; color: #ff4d00; border-right: 4px solid #ff4d00; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen">

    <aside class="w-72 bg-white border-r border-slate-100 h-screen sticky top-0 hidden lg:flex flex-col z-50">
        <div class="p-8 mb-2">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center shadow-lg shadow-orange-200">
                    <span class="text-white font-black text-xl">Z</span>
                </div>
                <div>
                    <h1 class="text-xl font-black text-slate-800 tracking-tighter">ZiFood</h1>
                    <span class="text-[9px] font-extrabold text-orange-500 uppercase tracking-widest bg-orange-50 px-2 py-0.5 rounded-md">Pro Seller</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 overflow-y-auto px-4 pb-10 custom-scrollbar space-y-8">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 px-4">Overview</p>
                <a href="{{ route('seller.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                    <span class="text-lg">🏠</span> <span>Dashboard Utama</span>
                </a>
            </div>
            
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 px-4">Feedback</p>
                <a href="{{ route('seller.reviews') }}" class="flex items-center space-x-3 px-4 py-3 active-link rounded-xl font-bold transition-all">
                    <span class="text-lg">⭐</span> <span>Ulasan Pelanggan</span>
                </a>
            </div>

            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 px-4">Menu Management</p>
                <a href="{{ route('seller.products') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                    <span class="text-lg">📋</span> <span>Daftar Produk</span>
                </a>
                <a href="{{ route('menu.create') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">➕</span> <span>Tambah Menu</span>
                </a>
            </div>

            <div class="mt-auto pt-8 border-t border-slate-50">
                 <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all">
                        <span class="text-lg">🚪</span> <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <header class="bg-white border-b border-slate-100 px-8 py-6 flex justify-between items-center z-10 sticky top-0">
            <div>
                <h2 class="text-xl font-black text-slate-800 italic">Ulasan Pelanggan</h2>
                <p class="text-xs text-slate-400 font-bold">Apa kata mereka tentang masakanmu?</p>
            </div>
            <div class="px-4 py-2 bg-orange-50 text-orange-600 rounded-lg text-xs font-black uppercase tracking-widest border border-orange-100 shadow-sm">
                Total: {{ $reviews->count() }} Ulasan
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar bg-slate-50/50">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 pb-20">
                @forelse($reviews as $review)
                <div class="bg-white p-6 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                    
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-black text-sm shadow-md">
                                {{ substr($review->user->name, 0, 1) }}
                            </div>
                            <div>
                                <h4 class="font-black text-slate-800 text-sm">{{ $review->user->name }}</h4>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wide">{{ $review->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="flex gap-0.5 bg-yellow-50 px-2 py-1 rounded-lg border border-yellow-100">
                            @for($i=1; $i<=5; $i++)
                                <span class="text-sm {{ $i <= $review->rating ? 'text-yellow-400' : 'text-slate-200' }}">★</span>
                            @endfor
                        </div>
                    </div>
                    
                    <div class="bg-slate-50 p-4 rounded-2xl mb-4 border border-slate-100 relative">
                        <div class="absolute -top-2 -left-2 bg-white w-6 h-6 rounded-full flex items-center justify-center text-slate-300 border border-slate-100 shadow-sm text-xs">❝</div>
                        <p class="text-slate-600 text-sm italic leading-relaxed">
                            "{{ $review->komentar ?? 'Tidak ada komentar tertulis.' }}"
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-4 border-t border-slate-50/80">
                        <div class="w-10 h-10 rounded-lg overflow-hidden border border-slate-100 shadow-sm">
                            <img src="{{ asset('uploads/'.$review->menu->foto) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-0.5">Produk:</p>
                            <p class="text-xs font-black text-slate-800 line-clamp-1">{{ $review->menu->nama_MakananMinuman }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-32 text-center">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-4 grayscale opacity-50">
                        ⭐
                    </div>
                    <h3 class="text-xl font-black text-slate-300">Belum ada ulasan masuk</h3>
                    <p class="text-xs text-slate-400 font-bold mt-2">Sabar ya, mungkin pembeli lagi ngunyah.</p>
                </div>
                @endforelse
            </div>
        </div>
    </main>
</body>
</html>