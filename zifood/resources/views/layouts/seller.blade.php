<aside class="w-72 bg-white border-r border-gray-200 h-screen sticky top-0 overflow-y-auto">
    <div class="p-8 border-b border-gray-50 flex items-center space-x-3">
        <div class="bg-orange-500 p-2 rounded-xl shadow-lg shadow-orange-100">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 11-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
        </div>
        <span class="text-xl font-black text-gray-800 tracking-tighter">Seller Centre</span>
    </div>

    <nav class="p-6 space-y-8">
        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">Utama</p>
            <div class="space-y-1">
                <a href="{{ route('seller.dashboard') }}" class="flex items-center space-x-3 p-3 bg-orange-50 text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">🏠</span> <span>Dashboard</span>
                </a>
            </div>
        </div>

        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">Manajemen Produk</p>
            <div class="space-y-1">
                <a href="{{ route('menu.create') }}" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">📋</span> <span>Daftar Produk</span>
                </a>
                <a href="{{ route('menu.create') }}" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">➕</span> <span>Tambah Produk</span>
                </a>
            </div>
        </div>

        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">Pesanan & Keuangan</p>
            <div class="space-y-1">
                <a href="#" class="flex items-center justify-between p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <div class="flex items-center space-x-3">
                        <span class="text-lg">🧾</span> <span>Pesanan</span>
                    </div>
                    <span class="bg-red-500 text-white text-[10px] px-2 py-0.5 rounded-full">3</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">💰</span> <span>Saldo & Pendapatan</span>
                </a>
            </div>
        </div>

        <div>
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-4 px-2">Pengaturan</p>
            <div class="space-y-1">
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">🏪</span> <span>Toko Saya</span>
                </a>
                <a href="#" class="flex items-center space-x-3 p-3 text-gray-500 hover:bg-gray-50 hover:text-orange-600 rounded-xl font-bold transition-all">
                    <span class="text-lg">⚙️</span> <span>Pengaturan</span>
                </a>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 p-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all text-sm">
                    <span>🚪</span> <span>Logout Akun</span>
                </button>
            </form>
        </div>
    </nav>
</aside>