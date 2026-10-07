<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZiFood | Tambah Menu Masterpiece</title>
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
            <a href="{{ route('seller.dashboard') }}" class="group flex items-center space-x-4">
                <div class="bg-white w-12 h-12 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path></svg>
                </div>
                <span class="font-black text-xs uppercase tracking-[0.3em] text-slate-400 group-hover:text-orange-600 transition">Kembali ke Dashboard</span>
            </a>
        </div>

        <div class="master-container overflow-hidden bg-white">
            <div class="grid grid-cols-1 lg:grid-cols-12">
                
                <div class="lg:col-span-7 p-12 lg:p-20 border-r border-slate-50">
                    <div class="mb-16">
                        <div class="inline-block bg-orange-50 text-orange-600 px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest mb-6">Create New Collection</div>
                        <h1 class="text-5xl font-extrabold text-slate-900 tracking-tighter leading-none mb-4">Terbitkan Menu <br><span class="text-orange-500">Masterpiece.</span></h1>
                    </div>

                    <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
                        @csrf
                        
                        <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                            <div class="px-6 py-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nama Produk</label>
                                <input type="text" name="nama_makanan" placeholder="Contoh: Rawon Daging Spesial" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 text-lg placeholder:text-slate-300" required>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-8">
                            <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                <div class="px-6 py-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Kategori</label>
                                    <select name="kategori" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 appearance-none cursor-pointer">
                                        <option value="Makanan Berat">🍱 Makanan Berat</option>
                                        <option value="Minuman">🍹 Minuman</option>
                                        <option value="Snack">🍪 Snack</option>
                                    </select>
                                </div>
                            </div>
                            <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                                <div class="px-6 py-4">
                                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Stok Tersedia</label>
                                    <input type="number" name="stok" placeholder="0" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 placeholder:text-slate-300" required>
                                </div>
                            </div>
                        </div>

                        <div class="input-box p-1 bg-slate-50/50 rounded-[2rem]">
                            <div class="px-6 py-4">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Harga Satuan (IDR)</label>
                                <div class="flex items-center">
                                    <span class="font-black text-slate-300 mr-2">Rp</span>
                                    <input type="number" name="harga" placeholder="15.000" class="w-full bg-transparent border-none outline-none font-bold text-slate-800 placeholder:text-slate-300" required>
                                </div>
                            </div>
                        </div>

                        <input type="file" name="foto" id="foto_upload" class="hidden" accept="image/*" required onchange="previewImage(event)">

                        <button type="submit" class="w-full bg-slate-900 hover:bg-orange-600 text-white font-black py-7 rounded-[2.5rem] transition-all duration-500 shadow-2xl shadow-slate-200 uppercase tracking-[0.2em] text-xs">
                            Publikasikan Menu Sekarang
                        </button>
                    </form>
                </div>

                <div class="lg:col-span-5 bg-slate-50/80 p-12 lg:p-20 flex flex-col justify-center items-center relative">
                    <div class="absolute top-10 right-10 flex space-x-2">
                        <div class="w-3 h-3 bg-orange-200 rounded-full"></div>
                        <div class="w-3 h-3 bg-orange-400 rounded-full"></div>
                        <div class="w-3 h-3 bg-orange-600 rounded-full"></div>
                    </div>

                    <div class="w-full max-w-sm text-center">
                        <h3 class="text-sm font-black text-slate-800 uppercase tracking-[0.3em] mb-12">Visual Preview</h3>
                        
                        <label for="foto_upload" class="group cursor-pointer block relative">
                            <div class="aspect-[4/5] w-full rounded-[4.5rem] bg-white shadow-2xl border-4 border-white overflow-hidden relative transition-transform duration-500 group-hover:scale-[1.02]">
                                <img id="output_image" src="https://via.placeholder.com/600x800?text=Pilih+Foto+Menu" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white font-black text-xs uppercase tracking-widest">Ganti Foto</span>
                                </div>
                            </div>
                        </label>

                        <p class="mt-10 text-[10px] font-bold text-slate-400 leading-relaxed uppercase tracking-widest">
                            Gunakan foto dengan pencahayaan baik <br> agar pelanggan lebih tertarik.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('output_image');
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>