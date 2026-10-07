<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu | ZiFood Seller</title>
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
                <a href="{{ route('seller.products') }}" class="flex items-center space-x-3 px-4 py-3 text-slate-500 hover:bg-slate-50 rounded-xl font-bold transition-all">
                    <span class="text-lg">📋</span> <span>Daftar Produk</span>
                </a>
                <a href="{{ route('menu.create') }}" class="flex items-center space-x-3 px-4 py-3 active-link rounded-xl font-bold transition-all">
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

    <main class="flex-1 lg:max-h-screen lg:overflow-y-auto">
        <header class="bg-white/80 backdrop-blur-md sticky top-0 z-40 px-10 py-6 border-b border-slate-50 flex justify-between items-center">
            <div>
                <h2 class="text-xl font-extrabold text-slate-800 italic uppercase tracking-tighter">Tambah Menu Baru</h2>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest italic mt-1">Ciptakan karya kuliner terbaikmu</p>
            </div>
            <div class="flex items-center space-x-6">
                <a href="{{ route('seller.products') }}" class="px-5 py-2.5 bg-slate-100 text-slate-600 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-200 transition">
                    ← Batal
                </a>
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <div class="p-10 max-w-5xl mx-auto">
            {{-- Error Handling --}}
            @if ($errors->any())
            <div class="mb-8 bg-red-50 border border-red-200 rounded-2xl p-6 flex items-start space-x-4 animate-pulse">
                <div class="text-2xl">⚠️</div>
                <div>
                    <h4 class="font-black text-red-600 text-sm uppercase tracking-widest mb-1">Ada yang salah nih!</h4>
                    <ul class="text-sm text-red-600 font-medium list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            {{-- Form Start --}}
            <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                @csrf
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight mb-6">Informasi Menu</h3>
                        <div class="mb-6">
                            <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Makanan / Minuman</label>
                            <input type="text" name="nama_MakananMinuman" value="{{ old('nama_MakananMinuman') }}" required placeholder="Contoh: Nasi Goreng Spesial Lava" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 focus:bg-white transition-all placeholder-slate-300">
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Kategori</label>
                                <div class="relative">
                                    <select name="kategori" required class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 focus:bg-white transition-all appearance-none cursor-pointer">
                                        <option value="" disabled selected>Pilih Kategori...</option>
                                        <option value="Makanan Berat" {{ old('kategori') == 'Makanan Berat' ? 'selected' : '' }}>🍔 Makanan Berat</option>
                                        <option value="Minuman" {{ old('kategori') == 'Minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                                        <option value="Camilan" {{ old('kategori') == 'Camilan' ? 'selected' : '' }}>🍟 Camilan</option>
                                    </select>
                                    <div class="absolute right-5 top-1/2 transform -translate-y-1/2 pointer-events-none text-slate-400">▼</div>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Stok Harian</label>
                                <input type="number" name="stok" value="{{ old('stok') }}" required placeholder="0" class="w-full px-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 focus:bg-white transition-all">
                            </div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight mb-6">Harga Jual</h3>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 transform -translate-y-1/2 text-slate-400 font-black text-xl">Rp</span>
                            <input type="number" name="harga" value="{{ old('harga') }}" required placeholder="0" class="w-full pl-14 pr-5 py-4 bg-slate-50 border-2 border-slate-100 rounded-2xl font-black text-2xl text-slate-800 focus:outline-none focus:border-green-500 focus:bg-white transition-all placeholder-slate-300">
                        </div>
                    </div>
                </div>

                {{-- Image Upload Section --}}
                <div class="space-y-8">
                    <div class="bg-white p-8 rounded-[2.5rem] border border-slate-50 shadow-sm h-full flex flex-col">
                        <h3 class="text-lg font-black text-slate-800 uppercase italic tracking-tight mb-6">Foto Masterpiece</h3>
                        <div class="flex-1 border-4 border-dashed border-slate-100 rounded-3xl relative hover:bg-slate-50 hover:border-orange-200 transition-all group cursor-pointer flex flex-col items-center justify-center p-6 text-center overflow-hidden">
                            <input type="file" name="foto" id="foto-input" required accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage(this)">
                            
                            <div id="placeholder" class="space-y-4">
                                <div class="w-20 h-20 bg-orange-50 text-orange-500 rounded-full flex items-center justify-center text-4xl mx-auto group-hover:scale-110 transition-transform">📷</div>
                                <div>
                                    <p class="font-bold text-slate-600">Klik untuk upload</p>
                                    <p class="text-xs text-slate-400 mt-1">PNG, JPG, WEBP up to 10MB</p>
                                </div>
                            </div>
                            
                            <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-[1.2rem] z-0" />
                            
                            <div id="edit-overlay" class="hidden absolute inset-0 bg-black/40 items-center justify-center text-white font-bold text-xs uppercase tracking-widest z-20">
                                Klik untuk Ganti Foto
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-5 bg-slate-900 text-white rounded-2xl font-black uppercase text-sm tracking-[0.2em] hover:bg-orange-600 transition shadow-xl shadow-slate-200 hover:shadow-orange-200 transform active:scale-95 duration-200">🚀 Terbitkan Menu</button>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');
            const overlay = document.getElementById('edit-overlay');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    placeholder.classList.add('hidden');
                    // Tambahkan class hover untuk menunjukkan bisa ganti
                    overlay.classList.remove('hidden');
                    overlay.classList.add('flex');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>