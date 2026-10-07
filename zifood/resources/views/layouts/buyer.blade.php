<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZiFood | @yield('title', 'Dashboard Pembeli')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .active-nav { background-color: #fff1ec; color: #ea580c; border-right: 4px solid #ea580c; }
        .glass-header { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(8px); }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex min-h-screen">

    @if(session('success'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 4000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         class="fixed top-24 right-5 z-[100] flex items-center gap-4 bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-2xl border border-slate-700 lg:right-10">
        
        <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center text-xl shrink-0 animate-bounce">
            🛒
        </div>
        <div>
            <p class="text-[10px] font-black text-green-400 uppercase tracking-widest mb-0.5">Berhasil!</p>
            <p class="text-sm font-bold text-white leading-tight">{{ session('success') }}</p>
        </div>
        <button @click="show = false" class="text-slate-500 hover:text-white transition ml-2">✕</button>
    </div>
    @endif

    @if(session('error'))
    <div x-data="{ show: true }"
         x-init="setTimeout(() => show = false, 5000)"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         class="fixed top-24 right-5 z-[100] flex items-center gap-4 bg-white text-slate-800 px-6 py-4 rounded-2xl shadow-2xl border-l-4 border-red-500 lg:right-10">
        
        <div class="text-2xl">⚠️</div>
        <div>
            <p class="text-[10px] font-black text-red-500 uppercase tracking-widest mb-0.5">Oops!</p>
            <p class="text-sm font-bold leading-tight">{{ session('error') }}</p>
        </div>
        <button @click="show = false" class="text-slate-400 hover:text-slate-800 transition ml-2">✕</button>
    </div>
    @endif

    <aside class="w-72 bg-white border-r border-slate-100 hidden lg:flex flex-col sticky top-0 h-screen z-40">
        <div class="p-8">
            <div class="flex items-center gap-3">
                <img src="{{ asset('img/logo.png') }}" alt="ZiFood Logo" class="w-10 h-10 object-contain rounded-xl shadow-sm bg-white p-1">
                <h1 class="text-2xl font-black text-slate-800 tracking-tighter">ZiFood</h1>
            </div>
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mt-2 pl-1">Premium Buyer Access</p>
        </div>

        <nav class="flex-1 px-4 space-y-1 overflow-y-auto custom-scrollbar">
            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 mt-4">Utama</p>
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('dashboard') ? 'active-nav' : 'text-slate-500' }}">
                <span>🏠</span> Home
            </a>
            <a href="{{ route('buyer.explore') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('buyer.explore') ? 'active-nav' : 'text-slate-500' }}">
                <span>🍱</span> Jelajah Menu
            </a>
            <a href="{{ route('buyer.shops.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('buyer.shops.*') ? 'active-nav' : 'text-slate-500' }}">
                <span>🏪</span> Toko / Restoran
            </a>

            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 mt-8">Transaksi</p>
            <a href="{{ route('cart.index') }}" class="flex items-center justify-between px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('cart.index') ? 'active-nav' : 'text-slate-500' }}">
                <div class="flex items-center gap-3"><span>🛒</span> Keranjang</div>
                @php $cartCount = \App\Models\Cart::where('id_user', Auth::id())->count(); @endphp
                @if($cartCount > 0)
                    <span class="bg-orange-100 text-orange-600 text-[10px] px-2 py-0.5 rounded-md font-black animate-pulse">{{ $cartCount }}</span>
                @endif
            </a>
            <a href="{{ route('buyer.orders') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('buyer.orders') ? 'active-nav' : 'text-slate-500' }}">
                <span>📦</span> Pesanan Saya
            </a>

            <p class="px-4 text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 mt-8">Personal</p>
            <a href="{{ route('buyer.profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold rounded-xl transition-all hover:bg-slate-50 {{ request()->routeIs('buyer.profile') ? 'active-nav' : 'text-slate-500' }}">
                <span>👤</span> Akun Saya
            </a>

            <div class="pt-8 pb-4">
                 <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all">
                        <span>🚪</span> Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 flex flex-col min-w-0">
        <header class="glass-header sticky top-0 z-30 border-b border-slate-100 px-8 py-4 flex justify-between items-center">
            <h2 class="text-xl font-black text-slate-800 italic">@yield('header_title', 'Selamat Datang')</h2>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-bold text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">Foodie Member</p>
                </div>
                <a href="{{ route('buyer.profile') }}" class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-white font-bold shadow-md border-2 border-slate-200 overflow-hidden hover:scale-110 transition">
                    @if(Auth::user()->photo)
                        <img src="{{ asset('uploads/profiles/'.Auth::user()->photo) }}" class="w-full h-full object-cover">
                    @else
                        {{ substr(Auth::user()->name, 0, 1) }}
                    @endif
                </a>
            </div>
        </header>

        <div class="p-8 overflow-y-auto h-[calc(100vh-80px)] custom-scrollbar">
            @yield('content')
        </div>
    </main>

</body>
</html>