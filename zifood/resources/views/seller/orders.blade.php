<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pesanan | ZiFood Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .active-link { background: #fff1ec; color: #ff4d00; border-right: 4px solid #ff4d00; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    </style>
</head>
<body class="flex min-h-screen bg-slate-50">

    <aside class="w-80 bg-white border-r border-slate-100 h-screen sticky top-0 hidden lg:flex flex-col z-50">
        <div class="p-8 mb-4">
            <div class="flex items-center space-x-3">
                <div class="w-11 h-11 bg-orange-600 rounded-2xl flex items-center justify-center shadow-lg shadow-orange-200">
                    <span class="text-white font-black text-xl">Z</span>
                </div>
                <div>
                    <h1 class="text-2xl font-black text-slate-800 tracking-tighter">ZiFood</h1>
                    <span class="text-[10px] font-extrabold text-orange-500 uppercase tracking-widest bg-orange-50 px-2 py-0.5 rounded-md">PRO SELLER</span>
                </div>
            </div>
        </div>
        <nav class="flex-1 px-4 pb-10 custom-scrollbar space-y-8">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Overview</p>
                <a href="{{ route('seller.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all"><span class="text-xl">🏠</span><span>Dashboard</span></a>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Operations</p>
                <a href="{{ route('seller.orders') }}" class="flex items-center justify-between px-4 py-3 bg-orange-50 text-orange-600 border-r-4 border-orange-600 rounded-xl font-bold transition-all">
                    <div class="flex items-center space-x-3"><span class="text-xl">📦</span><span>Pesanan Masuk</span></div>
                </a>
                <a href="{{ route('seller.finance') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all"><span class="text-xl">💰</span><span>Saldo & Finance</span></a>
            </div>
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Settings</p>
                <a href="{{ route('seller.shop') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all"><span class="text-xl">🏪</span><span>Toko Saya</span></a>
                <form action="{{ route('logout') }}" method="POST">@csrf<button class="w-full text-left flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all"><span class="text-xl">🚪</span><span>Logout</span></button></form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto custom-scrollbar relative">
        @if(session('success'))
        <div class="fixed top-5 right-5 z-[100] bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
            <span>✨</span> {{ session('success') }}
        </div>
        @endif

        <div class="p-10 pb-20">
            <div class="mb-10 flex justify-between items-end">
                <div>
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">Pesanan Masuk 📦</h1>
                    <p class="text-slate-500 font-medium mt-1">Kelola pesanan pelanggan dengan cepat dan tepat.</p>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100 text-[10px] font-black uppercase tracking-widest text-slate-400">
                                <th class="p-6 pl-8">Info Menu</th>
                                <th class="p-6">Pemesan</th>
                                <th class="p-6">Status & Aksi</th>
                                <th class="p-6 text-right pr-8">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($orders as $order)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="p-6 pl-8 align-top">
                                    <div class="flex gap-4">
                                        <div class="w-16 h-16 rounded-xl bg-slate-100 overflow-hidden shrink-0 border border-slate-200">
                                            <img src="{{ asset('uploads/'.$order->menu->foto) }}" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-black text-slate-800 text-sm">{{ $order->menu->nama_MakananMinuman }}</p>
                                            <p class="text-xs font-bold text-slate-400 mt-0.5">{{ $order->jumlah }} x Rp{{ number_format($order->menu->harga, 0, ',', '.') }}</p>
                                            
                                            @if($order->catatan)
                                            <div class="mt-2 bg-yellow-50 border border-yellow-100 text-yellow-700 px-3 py-2 rounded-lg text-xs font-medium inline-block max-w-xs">
                                                <span class="font-bold flex items-center gap-1 mb-1">
                                                    📝 Catatan:
                                                </span>
                                                "{{ $order->catatan }}"
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <td class="p-6 align-top">
                                    <p class="font-bold text-slate-800 text-sm">{{ $order->user->name }}</p>
                                    <div class="text-xs text-slate-500 mt-1 space-y-1">
                                        <p>📅 {{ $order->created_at->format('d M, H:i') }}</p>
                                        <p>📍 {{ $order->lokasi_pengiriman ?? 'Ambil di Tempat' }}</p>
                                        <p>💳 {{ $order->metode_pembayaran ?? 'Tunai' }}</p>
                                    </div>
                                </td>

                                <td class="p-6 align-top">
                                    <div class="flex flex-col gap-3">
                                        <div>
                                            @if($order->status == 'Menunggu')
                                                <span class="px-3 py-1 bg-blue-50 text-blue-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100 animate-pulse">
                                                    ⏳ Menunggu Konfirmasi
                                                </span>
                                            @elseif($order->status == 'Diproses')
                                                <span class="px-3 py-1 bg-yellow-50 text-yellow-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-yellow-100">
                                                    🔥 Sedang Dimasak
                                                </span>
                                            @elseif($order->status == 'Selesai')
                                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">
                                                    ✅ Selesai
                                                </span>
                                            @elseif($order->status == 'Dibatalkan')
                                                <span class="px-3 py-1 bg-red-50 text-red-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-red-100">
                                                    ❌ Dibatalkan
                                                </span>
                                            @endif
                                        </div>

                                        @if($order->status == 'Menunggu')
                                        <div class="flex gap-2">
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Diproses">
                                                <button type="submit" class="bg-slate-900 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-orange-600 transition shadow-lg shadow-slate-200">
                                                    Terima & Masak
                                                </button>
                                            </form>
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Dibatalkan">
                                                <button type="submit" class="bg-white border border-slate-200 text-red-500 px-3 py-2 rounded-xl text-xs font-bold hover:bg-red-50 transition">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                        @elseif($order->status == 'Diproses')
                                        <div>
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf @method('PATCH')
                                                <input type="hidden" name="status" value="Selesai">
                                                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-green-600 transition shadow-lg shadow-green-200 w-full">
                                                    Selesai & Antar
                                                </button>
                                            </form>
                                        </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="p-6 align-top text-right pr-8">
                                    <p class="text-lg font-black text-slate-800">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Bayar</p>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-20 text-center">
                                    <div class="flex flex-col items-center justify-center opacity-50">
                                        <span class="text-6xl mb-4">📭</span>
                                        <h3 class="text-xl font-bold text-slate-400">Belum Ada Pesanan</h3>
                                        <p class="text-sm text-slate-300">Sabar ya, rejeki gak kemana kok.</p>
                                    </div>
                                </td>
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