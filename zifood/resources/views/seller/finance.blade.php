<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saldo & Finance | ZiFood Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .active-link { background: #fff1ec; color: #ff4d00; border-right: 4px solid #ff4d00; }
        .card-shadow { box-shadow: 0px 20px 25px -5px rgba(0, 0, 0, 0.02), 0px 10px 10px -5px rgba(0, 0, 0, 0.01); }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }
        .glass-wallet {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }
        .glass-wallet::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 77, 0, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }
    </style>
</head>
<body class="flex min-h-screen">

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
                    <a href="{{ route('seller.dashboard') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">🏠</span> <span>Dashboard Utama</span>
                    </a>
                </div>
            </div>

            <div class="mb-8">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Feedback</p>
                <div class="space-y-1">
                    <a href="{{ route('seller.reviews') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
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
                    <a href="{{ route('seller.orders') }}" class="flex items-center space-x-3 px-4 py-3.5 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                        <span class="text-xl italic font-black">📦</span> <span>Pesanan Masuk</span>
                    </a>
                    <a href="{{ route('seller.finance') }}" class="flex items-center space-x-3 px-4 py-3.5 active-link rounded-xl font-bold transition-all">
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
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 italic uppercase tracking-tighter">Dompet Toko</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1 italic">Kelola pendapatan & pencairan danamu.</p>
            </div>
            
            <div class="flex items-center space-x-6">
                <div class="text-right hidden md:block">
                    <p class="text-sm font-black text-slate-800">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] font-bold text-green-500 uppercase tracking-widest italic">● Verified Seller</p>
                </div>
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-10 max-w-7xl">
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-12">
                
                <div class="lg:col-span-2 glass-wallet rounded-[2.5rem] p-10 text-white shadow-2xl shadow-slate-200 flex flex-col justify-between relative group">
                    <div class="relative z-10 flex justify-between items-start">
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Saldo Aktif</p>
                            <h2 class="text-5xl font-black tracking-tighter">Rp{{ number_format($totalSaldo, 0, ',', '.') }}</h2>
                        </div>
                        <div class="w-12 h-12 bg-white/10 rounded-full flex items-center justify-center backdrop-blur-md border border-white/10">
                            <span class="text-2xl">💳</span>
                        </div>
                    </div>

                    <div class="relative z-10 mt-8 flex items-end justify-between">
                        <div class="space-y-1">
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Nomor Rekening Virtual</p>
                            <p class="font-mono text-lg tracking-widest text-slate-200">**** **** 8892</p>
                        </div>
                        <button class="bg-orange-600 hover:bg-orange-500 text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest transition shadow-lg shadow-orange-900/50 transform active:scale-95 flex items-center gap-2">
                            <span>💸 Tarik Saldo</span>
                        </button>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-6 rounded-[2rem] card-shadow border border-slate-50 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Pemasukan Bulan Ini</p>
                            <h3 class="text-2xl font-black text-slate-800">Rp{{ number_format($incomeThisMonth, 0, ',', '.') }}</h3>
                        </div>
                        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">📈</div>
                    </div>

                    <div class="bg-white p-6 rounded-[2rem] card-shadow border border-slate-50 flex items-center justify-between">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Dana Ditahan (Pending)</p>
                            <h3 class="text-2xl font-black text-slate-400">Rp{{ number_format($pendingSaldo, 0, ',', '.') }}</h3>
                            <p class="text-[9px] text-slate-400 mt-1 italic">*Menunggu pesanan selesai</p>
                        </div>
                        <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">⏳</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] card-shadow border border-slate-50 overflow-hidden">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center">
                    <div>
                        <h3 class="text-xl font-black text-slate-800 uppercase italic tracking-tight">Riwayat Mutasi</h3>
                        <p class="text-xs text-slate-400 font-bold mt-1">Catatan uang masuk dan keluar.</p>
                    </div>
                    <button class="text-xs font-bold text-orange-600 hover:text-orange-700 uppercase tracking-widest border-b border-orange-200 border-dashed pb-0.5">
                        Download Laporan ⇩
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 text-slate-400 text-[10px] font-black uppercase tracking-widest border-b border-slate-50">
                                <th class="p-6 pl-8">ID Transaksi</th>
                                <th class="p-6">Keterangan</th>
                                <th class="p-6">Tanggal</th>
                                <th class="p-6">Status</th>
                                <th class="p-6 pr-8 text-right">Nominal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($transactions as $trx)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="p-6 pl-8">
                                    <span class="font-mono text-xs font-bold text-slate-500">#TRX-{{ $trx->id }}</span>
                                </td>
                                <td class="p-6">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-green-50 text-green-600 flex items-center justify-center text-xs">⬇️</div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm">Penjualan Produk</p>
                                            <p class="text-[10px] text-slate-400 font-bold">Order ID #{{ $trx->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6">
                                    <p class="text-xs font-bold text-slate-600">{{ $trx->updated_at->format('d M Y, H:i') }}</p>
                                </td>
                                <td class="p-6">
                                    <span class="px-3 py-1 bg-green-50 text-green-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">
                                        Berhasil
                                    </span>
                                </td>
                                <td class="p-6 pr-8 text-right">
                                    <p class="font-black text-green-500 text-sm">+ Rp{{ number_format($trx->total_harga, 0, ',', '.') }}</p>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-12 text-center text-slate-400">
                                    <div class="flex flex-col items-center opacity-50">
                                        <span class="text-4xl mb-2">🍃</span>
                                        <p class="font-bold text-xs uppercase tracking-widest">Belum ada transaksi</p>
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