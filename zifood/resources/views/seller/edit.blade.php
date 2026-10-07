<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu | ZiFood Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: radial-gradient(circle at top right, #fff5f2, #f8fafc); min-height: 100vh; }
        .master-container { background: white; box-shadow: 0px 100px 80px rgba(0, 0, 0, 0.03); border: 1px solid rgba(255, 77, 0, 0.08); border-radius: 4rem; }
        .input-box { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); border: 2px solid #f8fafc; }
        .input-box:focus-within { border-color: #ff4d00; background: white; transform: translateY(-2px); box-shadow: 0 20px 25px -5px rgba(255, 77, 0, 0.05); }
    </style>
</head>
<body class="flex items-center justify-center py-24 px-6">

    <div class="max-w-6xl w-full">
        <div class="mb-12 flex justify-start px-6">
            <a href="{{ route('seller.products') }}" class="group flex items-center space-x-4">
                <div class="bg-white w-12 h-12 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                <span class="font-black text-xs uppercase tracking-[0.3em] text-slate-400 group-hover:text-orange-600 transition">Batal & Kembali</span>
            </a>
        </div>

        <div class="master-container overflow-hidden bg-white">
            <form action="{{ route('menu.update', $menu->id_menu) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-12">
                    <div class="lg:col-span-7 p-12 lg:p-20 border-r border-slate-50">
                        <div class="mb-16">
                            <div class="inline-block bg-orange-50 text-orange-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">Update Mode</div>
                            <h1 class="text-5xl font-extrabold text-slate-900 tracking-tighter leading-none mb-4">Edit Menu <br><span class="text-orange-500">Masterpiece.</span></h1>
                        </div>

                        @if ($errors->any())
                        <div class="mb-8 bg-red-50 p-4 rounded-2xl border border-red-100">
                            <ul class="text-red-500 text-sm font-bold list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="space-y-10">
                            <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                <div class="px-6 py-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Produk</label>
                                    <input type="text" name="nama_MakananMinuman" value="{{ old('nama_MakananMinuman', $menu->nama_MakananMinuman) }}" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 text-lg" required>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-8">
                                <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                    <div class="px-6 py-4">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori</label>
                                        <select name="kategori" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 appearance-none cursor-pointer">
                                            <option value="Makanan Berat" {{ $menu->kategori == 'Makanan Berat' ? 'selected' : '' }}>🍱 Makanan Berat</option>
                                            <option value="Minuman" {{ $menu->kategori == 'Minuman' ? 'selected' : '' }}>🍹 Minuman</option>
                                            <option value="Camilan" {{ $menu->kategori == 'Camilan' ? 'selected' : '' }}>🍪 Camilan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                    <div class="px-6 py-4">
                                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Stok</label>
                                        <input type="number" name="stok" value="{{ old('stok', $menu->stok) }}" class="w-full bg-transparent border-none outline-none font-bold text-slate-800" required>
                                    </div>
                                </div>
                            </div>

                            <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                <div class="px-6 py-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Harga Final (Rp)</label>
                                    <div class="flex items-center">
                                        <span class="font-black text-slate-300 mr-2">Rp</span>
                                        <input type="number" name="harga" value="{{ old('harga', $menu->harga) }}" class="w-full bg-transparent border-none outline-none font-bold text-slate-800" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-slate-900 hover:bg-orange-600 text-white font-black py-7 rounded-[2.5rem] transition-all duration-500 uppercase tracking-[0.2em] text-xs shadow-2xl shadow-slate-200 hover:shadow-orange-200 transform active:scale-[0.98]">
                                Simpan Perubahan Menu
                            </button>
                        </div>
                    </div>

                    <div class="lg:col-span-5 bg-slate-50/80 p-12 lg:p-20 flex flex-col justify-center items-center relative">
                        <div class="w-full max-w-sm text-center relative z-10">
                            <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.3em] mb-10 text-orange-500">Visual Preview</h3>
                            
                            <label for="foto_edit" class="group cursor-pointer block relative">
                                <div class="aspect-[4/5] w-full rounded-[4.5rem] bg-white shadow-2xl border-4 border-white overflow-hidden relative transition-all duration-500 group-hover:scale-[1.02]">
                                    <img id="image_preview" src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center backdrop-blur-sm">
                                        <div class="text-center">
                                            <span class="text-white font-black text-[10px] uppercase tracking-widest block mb-2">Ganti Foto</span>
                                            <div class="w-10 h-10 bg-white/20 rounded-full mx-auto flex items-center justify-center text-white border border-white/30">📷</div>
                                        </div>
                                    </div>
                                </div>
                            </label>

                            <input type="file" name="foto" id="foto_edit" class="hidden" accept="image/*" onchange="previewUpdate(event)">
                            
                            <p class="text-[10px] text-slate-400 font-bold uppercase mt-8 tracking-widest leading-relaxed">
                                Klik gambar di atas untuk mengganti foto. <br> Kosongkan jika tidak ingin mengubah.
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function previewUpdate(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('image_preview').src = reader.result;
            };
            if (input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>