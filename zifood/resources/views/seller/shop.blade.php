<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Toko | ZiFood Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fcfcfd; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        [x-cloak] { display: none !important; }
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
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 px-4">Settings</p>
                <a href="{{ route('seller.shop') }}" class="flex items-center space-x-3 px-4 py-3 bg-orange-50 text-orange-600 border-r-4 border-orange-600 rounded-xl font-bold transition-all"><span class="text-xl">🏪</span><span>Toko Saya</span></a>
                <form action="{{ route('logout') }}" method="POST">@csrf<button class="w-full text-left flex items-center space-x-3 px-4 py-3 text-red-500 hover:bg-red-50 rounded-xl font-bold transition-all"><span class="text-xl">🚪</span><span>Logout</span></button></form>
            </div>
        </nav>
    </aside>

    <main class="flex-1 h-screen overflow-y-auto custom-scrollbar relative">
        @if(session('success'))
        <div x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-5 right-5 z-[100] bg-slate-900 text-white px-6 py-4 rounded-2xl shadow-xl flex items-center gap-3 animate-bounce">
            <span>✨</span> {{ session('success') }}
        </div>
        @endif

        <div class="pb-20">
            <form action="{{ route('seller.shop.update') }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="relative h-64 md:h-80 w-full bg-slate-200 overflow-hidden group">
                    <img id="cover_preview" src="{{ $user->cover ? asset('uploads/profiles/'.$user->cover) : 'https://via.placeholder.com/1200x400?text=Cover+Toko' }}" class="w-full h-full object-cover transition-opacity duration-300">
                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/50 transition-colors"></div>
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <label for="file_cover" class="cursor-pointer bg-white/20 backdrop-blur-md border border-white/50 text-white px-6 py-3 rounded-full font-bold hover:bg-white hover:text-slate-900 transition flex items-center gap-2">📷 Ganti Foto Sampul</label>
                        <input type="file" name="cover" id="file_cover" class="hidden" accept="image/*" onchange="previewImage(this, 'cover_preview')">
                    </div>
                </div>

                <div class="max-w-6xl mx-auto px-6 relative -mt-20 z-10">
                    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-6 md:p-10 flex flex-col md:flex-row items-center md:items-end gap-6 md:gap-10 text-center md:text-left">
                        <div class="relative group">
                            <div class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white shadow-2xl overflow-hidden bg-slate-100">
                                <img id="photo_preview" src="{{ $user->photo ? asset('uploads/profiles/'.$user->photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=ea580c&color=fff' }}" class="w-full h-full object-cover">
                            </div>
                            <label for="file_photo" class="absolute bottom-2 right-2 bg-slate-900 text-white w-10 h-10 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition border-2 border-white cursor-pointer">✏️</label>
                            <input type="file" name="photo" id="file_photo" class="hidden" accept="image/*" onchange="previewImage(this, 'photo_preview')">
                        </div>
                        <div class="flex-1 pb-2">
                            <h1 class="text-3xl font-black text-slate-800 tracking-tight">{{ $user->name }} ✅</h1>
                            <p class="text-slate-500 font-medium mt-2">{{ $user->bio ?? 'Belum ada bio.' }}</p>
                        </div>
                        <div>
                            <button type="submit" class="bg-orange-600 text-white px-8 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-orange-700 transition shadow-lg shadow-orange-200 transform active:scale-95">💾 Simpan Perubahan</button>
                        </div>
                    </div>
                </div>

                <div class="max-w-6xl mx-auto px-6 mt-10 grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-slate-100 space-y-6">
                            <h3 class="text-lg font-black text-slate-800 mb-6 italic">Edit Informasi</h3>
                            <div><label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Toko</label><input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition"></div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div><label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Email</label><input type="email" value="{{ $user->email }}" disabled class="w-full px-5 py-3 bg-slate-100 border border-slate-200 rounded-xl font-bold text-slate-400 cursor-not-allowed"></div>
                                <div><label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">WhatsApp</label><input type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="08..." class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition"></div>
                            </div>
                            <div><label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Bio / Slogan</label><textarea name="bio" rows="3" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition">{{ old('bio', $user->bio) }}</textarea></div>
                            <div><label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Alamat</label><textarea name="address" rows="2" class="w-full px-5 py-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-slate-800 focus:outline-none focus:border-orange-500 transition">{{ old('address', $user->address) }}</textarea></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        function previewImage(input, targetId) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) { document.getElementById(targetId).src = e.target.result; }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>