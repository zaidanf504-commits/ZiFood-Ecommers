<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk | ZiFood Seller</title>
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
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 px-4">Menu Management</p>
                <a href="{{ route('seller.products') }}" class="flex items-center space-x-3 px-4 py-3 active-link rounded-xl font-bold transition-all">
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
        <header class="bg-white border-b border-slate-100 px-8 py-4 flex justify-between items-center z-10">
            <div>
                <h2 class="text-xl font-black text-slate-800 italic">Daftar Produk</h2>
                <p class="text-xs text-slate-400 font-bold">Kelola semua menu masterpiece kamu.</p>
            </div>
            <a href="{{ route('menu.create') }}" class="px-5 py-2.5 bg-slate-900 text-white rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-orange-600 transition shadow-lg flex items-center gap-2">
                <span>➕ Tambah Baru</span>
            </a>
        </header>

        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar bg-slate-50">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 font-bold text-sm">
                <span>🎉</span> {{ session('success') }}
            </div>
            @endif

            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 text-slate-400 text-[10px] font-black uppercase tracking-widest border-b border-slate-100">
                                <th class="p-6">Foto</th>
                                <th class="p-6">Nama Produk</th>
                                <th class="p-6">Kategori</th>
                                <th class="p-6">Harga</th>
                                <th class="p-6">Stok</th>
                                <th class="p-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($menus as $menu)
                            <tr class="group hover:bg-orange-50/30 transition-colors">
                                <td class="p-6 w-24">
                                    <div class="w-16 h-16 rounded-xl overflow-hidden bg-slate-100 border border-slate-100 shadow-sm">
                                        <img src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-6">
                                    <p class="font-black text-slate-800 text-sm">{{ $menu->nama_MakananMinuman }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">ID: #{{ $menu->id_menu }}</p>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-white border border-slate-200 text-slate-600 rounded-lg text-[10px] font-bold uppercase">
                                        {{ $menu->kategori }}
                                    </span>
                                </td>
                                <td class="p-6">
                                    <p class="font-bold text-slate-700 text-sm">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full {{ $menu->stok > 5 ? 'bg-green-500' : 'bg-red-500 animate-pulse' }}"></span>
                                        <span class="font-bold text-sm {{ $menu->stok > 5 ? 'text-slate-600' : 'text-red-500' }}">{{ $menu->stok }} Unit</span>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('menu.edit', $menu->id_menu) }}" class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-500 hover:text-white transition">✏️</a>
                                        <form action="{{ route('menu.destroy', $menu->id_menu) }}" method="POST" onsubmit="return confirm('Hapus menu ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition">🗑️</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-12 text-center text-slate-400 font-bold">Belum ada produk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>