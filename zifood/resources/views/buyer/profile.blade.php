<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akun Saya | ZiFood</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .glass-nav { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="flex flex-col min-h-screen">

    <nav class="fixed top-0 w-full z-50 glass-nav border-b border-slate-100 px-6 py-4 flex justify-between items-center">
        <a href="{{ route('buyer.explore') }}" class="flex items-center gap-2 text-slate-500 hover:text-orange-600 font-bold transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
            <span>Kembali</span>
        </a>
        <div class="font-black text-xl tracking-tighter text-slate-800">ZiFood <span class="text-orange-600">.</span></div>
        <div class="w-10"></div>
    </nav>

    <main class="flex-1 w-full max-w-5xl mx-auto px-6 pt-24 pb-20" x-data="{ activeTab: 'history' }">
        
        <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-xl shadow-slate-200/50 border border-slate-100 mb-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-orange-50 rounded-full -mr-20 -mt-20 blur-3xl opacity-50"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-8 text-center md:text-left">
                <div class="relative group">
                    <div class="w-32 h-32 rounded-full border-4 border-white shadow-2xl overflow-hidden bg-slate-100">
                        <img src="{{ $user->photo ? asset('uploads/profiles/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=f97316&color=fff' }}" class="w-full h-full object-cover">
                    </div>
                </div>

                <div class="flex-1">
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">{{ $user->name }}</h1>
                    <p class="text-slate-500 font-medium">{{ $user->email }}</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-3 mt-4">
                        <span class="bg-orange-100 text-orange-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">Foodie Member</span>
                        <span class="bg-slate-100 text-slate-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">Gabung {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>

                <div class="flex gap-8 border-t md:border-t-0 md:border-l border-slate-100 pt-6 md:pt-0 md:pl-8">
                    <div class="text-center">
                        <p class="text-2xl font-black text-slate-800">{{ $totalOrders }}</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pesanan</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-black text-slate-800">Rp{{ number_format($totalSpent/1000, 0) }}k</p>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jajan</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-center md:justify-start border-b border-slate-200 mb-8">
            <button @click="activeTab = 'history'" 
                    :class="activeTab === 'history' ? 'border-orange-500 text-orange-600' : 'border-transparent text-slate-400 hover:text-slate-600'"
                    class="px-8 py-4 border-b-4 font-black text-xs uppercase tracking-widest transition-all">
                📦 Riwayat Pesanan
            </button>
            <button @click="activeTab = 'settings'" 
                    :class="activeTab === 'settings' ? 'border-orange-500 text-orange-600' : 'border-transparent text-slate-400 hover:text-slate-600'"
                    class="px-8 py-4 border-b-4 font-black text-xs uppercase tracking-widest transition-all">
                ⚙️ Edit Profil
            </button>
        </div>

        <div x-show="activeTab === 'history'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
            
            <div class="space-y-6">
                @forelse($orders as $order)
                <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-lg transition duration-300 flex flex-col md:flex-row gap-6 items-center">
                    
                    <div class="w-full md:w-24 h-24 rounded-2xl overflow-hidden shrink-0 bg-slate-50 border border-slate-100 relative">
                        <img src="{{ asset('uploads/'.$order->menu->foto) }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/10"></div>
                    </div>

                    <div class="flex-1 w-full text-center md:text-left">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-2">
                            <h4 class="text-lg font-black text-slate-800">{{ $order->menu->nama_MakananMinuman }}</h4>
                            <span class="text-xs font-bold text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        
                        <p class="text-sm text-slate-500 font-medium mb-3">
                            {{ $order->jumlah }} item • Total: <span class="text-slate-800 font-bold">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</span>
                        </p>

                        <div>
                            @if($order->status == 'Menunggu')
                                <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-blue-100">⏳ Menunggu Konfirmasi</span>
                            @elseif($order->status == 'Diproses')
                                <span class="bg-yellow-50 text-yellow-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-yellow-100 animate-pulse">🔥 Sedang Dimasak</span>
                            @elseif($order->status == 'Selesai')
                                <span class="bg-green-50 text-green-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-green-100">✅ Selesai</span>
                            @elseif($order->status == 'Dibatalkan')
                                <span class="bg-red-50 text-red-600 px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest border border-red-100">❌ Dibatalkan</span>
                            @endif
                        </div>
                    </div>

                    @if($order->status == 'Selesai')
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf <input type="hidden" name="id_menu" value="{{ $order->id_menu }}">
                        <button type="submit" class="bg-orange-50 text-orange-600 px-6 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-orange-600 hover:text-white transition">
                            Pesan Lagi ↺
                        </button>
                    </form>
                    @endif
                </div>
                @empty
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200">
                    <div class="text-6xl mb-4 opacity-30">🍽️</div>
                    <h3 class="text-xl font-black text-slate-300 uppercase italic tracking-widest">Belum Ada Riwayat</h3>
                    <p class="text-xs font-bold text-slate-400 mt-2">Mulai petualangan kulinermu sekarang!</p>
                </div>
                @endforelse
            </div>
        </div>

        <div x-show="activeTab === 'settings'" x-cloak x-transition:enter="transition ease-out duration-300" class="max-w-2xl mx-auto">
            <div class="bg-white rounded-[2.5rem] p-8 md:p-10 shadow-sm border border-slate-100">
                
                @if(session('success'))
                <div class="mb-6 bg-green-50 text-green-700 px-4 py-3 rounded-xl border border-green-100 flex items-center gap-2">
                    <span>✅</span> {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('buyer.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf @method('PUT')
                    
                    <div class="flex justify-center mb-6">
                        <div class="relative group cursor-pointer" onclick="document.getElementById('file_photo').click()">
                            <div class="w-24 h-24 rounded-full bg-slate-100 border-4 border-slate-50 overflow-hidden">
                                <img id="preview_photo" src="{{ $user->photo ? asset('uploads/profiles/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name) }}" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition text-white font-bold text-xs">Ubah</div>
                            <input type="file" name="photo" id="file_photo" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email</label>
                            <input type="email" value="{{ $user->email }}" disabled class="w-full px-5 py-3 bg-slate-100 border border-slate-200 rounded-xl font-bold text-slate-400 cursor-not-allowed">
                        </div>
                        <div>
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">WhatsApp</label>
                            <input type="text" name="phone" value="{{ $user->phone }}" placeholder="08..." class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Alamat Pengiriman Utama</label>
                        <textarea name="address" rows="3" placeholder="Jl. Kenangan No. 12..." class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition">{{ $user->address }}</textarea>
                    </div>

                    <div class="pt-4 border-t border-slate-100 flex justify-between items-center">
                        <button type="submit" form="logout-form" class="text-red-500 font-bold text-xs uppercase tracking-widest hover:text-red-700 transition">
                            Keluar Akun
                        </button>
                        
                        <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-orange-600 transition shadow-lg shadow-orange-100">
                            Simpan Profil
                        </button>
                    </div>
                </form>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            </div>
        </div>

    </main>

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) { document.getElementById('preview_photo').src = e.target.result; }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>