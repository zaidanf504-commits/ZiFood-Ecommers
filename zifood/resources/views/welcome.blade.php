<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZiFood - Rasakan Kelezatan Karya Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FAFAFA; color: #1e293b; overflow-x: hidden; }
        
        /* Glassmorphism */
        .glass { background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(16px); border-bottom: 1px solid rgba(255, 255, 255, 0.3); }
        .glass-card { background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.4); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07); }

        /* Text Gradient */
        .text-gradient { background: linear-gradient(135deg, #ea580c 0%, #f59e0b 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .text-gradient-blue { background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }

        /* Animasi */
        @keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
        .animate-float { animation: float 6s ease-in-out infinite; }
        
        @keyframes pulse-soft { 0%, 100% { opacity: 0.6; transform: scale(1); } 50% { opacity: 0.8; transform: scale(1.05); } }
        .animate-pulse-soft { animation: pulse-soft 4s infinite; }

        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    </style>
</head>
<body class="antialiased" x-data="{ videoModalOpen: false }">

    <nav class="fixed top-0 w-full z-50 glass transition-all duration-300" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 md:h-24">
                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="relative">
                        <div class=""></div>
                        <img src="{{ asset('img/logo.png') }}" alt="ZiFood Logo" class="relative h-16 w-16 md:h-20 md:w-20 object-contain transform group-hover:rotate-12 transition duration-500">
                    </div>
                    <span class="text-2xl font-black tracking-tighter text-slate-900 group-hover:text-orange-600 transition">ZiFood<span class="text-orange-500">.</span></span>
                </div>
                
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="#beranda" class="text-sm font-bold text-slate-600 hover:text-orange-600 transition relative group">
                        Beranda <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#menu" class="text-sm font-bold text-slate-600 hover:text-orange-600 transition relative group">
                        Menu Favorit <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#fitur" class="text-sm font-bold text-slate-600 hover:text-orange-600 transition relative group">
                        Kenapa Kami? <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                    </a>
                    <a href="#faq" class="text-sm font-bold text-slate-600 hover:text-orange-600 transition relative group">
                        Bantuan <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-orange-600 transition-all group-hover:w-full"></span>
                    </a>
                </div>

                <div class="flex items-center gap-3 md:gap-4">
                    @if (Route::has('login'))
                        @auth
                            @if(Auth::user()->role == 'penjual')
                                <a href="{{ route('seller.dashboard') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-200 transition transform hover:-translate-y-1 flex items-center gap-2">
                                    <i class="fas fa-store"></i> Dashboard
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="bg-slate-900 text-white px-5 py-2.5 rounded-full font-bold text-xs uppercase tracking-widest hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-200 transition transform hover:-translate-y-1 flex items-center gap-2">
                                    <i class="fas fa-user"></i> Dashboard
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="hidden md:block text-sm font-black text-slate-900 hover:text-orange-600 transition">Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-gradient-to-r from-orange-600 to-orange-500 text-white px-6 py-3 rounded-full font-black text-xs uppercase tracking-widest hover:shadow-xl hover:shadow-orange-300 transition transform hover:-translate-y-1 group">
                                    Daftar Sekarang <i class="fas fa-arrow-right ml-1 group-hover:translate-x-1 transition"></i>
                                </a>
                            @endif
                        @endauth
                    @endif
                    </div>
            </div>
        </div>
    </nav>

    <section id="beranda" class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white">
        <div class="absolute top-0 right-0 w-[800px] h-[800px] bg-gradient-to-br from-orange-100 to-transparent rounded-full blur-3xl opacity-60 -translate-y-1/2 translate-x-1/3 z-0 animate-pulse-soft"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-gradient-to-tr from-blue-100 to-transparent rounded-full blur-3xl opacity-60 translate-y-1/3 -translate-x-1/4 z-0"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="text-center lg:text-left space-y-8">
                    <div class="inline-flex items-center gap-2 bg-white border border-slate-200 px-4 py-2 rounded-full shadow-sm animate-bounce" style="animation-duration: 3s;">
                        <span class="bg-green-100 text-green-700 p-1 rounded-full text-xs"><i class="fas fa-check"></i></span>
                        <span class="text-xs font-bold text-slate-600 uppercase tracking-wide">Platform Kuliner PT Zifood</span>
                    </div>
                    
                    <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1.1] tracking-tight">
                        Nikmati Karya <br>
                        <span class="text-gradient">Masterpiece</span> <br>
                        PT ZiFood.
                    </h1>
                    
                    <p class="text-lg text-slate-500 font-medium leading-relaxed max-w-xl mx-auto lg:mx-0">
                        Dukung talenta muda Indonesia. Pesan hidangan lezat buatan para masyarakat indonesia, nikmati harga pelajar dengan kualitas bintang lima.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="bg-slate-900 text-white px-8 py-4 rounded-full font-black text-sm uppercase tracking-widest shadow-xl shadow-slate-300 hover:bg-orange-600 hover:shadow-orange-300 transition transform hover:-translate-y-1 text-center group">
                            <i class="fas fa-utensils mr-2"></i> Pesan Sekarang
                        </a>
                        <button type="button" 
                                @click="videoModalOpen = true; $nextTick(() => { const v = $refs.zifoodVideo; if(v) v.play(); })" 
                                class="bg-white text-slate-800 border border-slate-200 px-8 py-4 rounded-full font-black text-sm uppercase tracking-widest hover:border-orange-500 hover:text-orange-600 transition text-center flex items-center justify-center gap-2 group cursor-pointer shadow-sm hover:shadow-md">
                            <span class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-orange-100 group-hover:text-orange-600 text-slate-600 transition">
                                <i class="fas fa-play text-[10px]"></i>
                            </span> 
                            Tonton Video
                        </button>
                    </div>

                    <div class="pt-8 flex items-center justify-center lg:justify-start gap-12 border-t border-slate-100">
                        <div>
                            <p class="text-3xl font-black text-slate-900">500+</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Menu Tersedia</p>
                        </div>
                        <div class="w-px h-12 bg-slate-200"></div>
                        <div>
                            <p class="text-3xl font-black text-slate-900">1.5k+</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Pelanggan Puas</p>
                        </div>
                        <div class="w-px h-12 bg-slate-200"></div>
                        <div>
                            <p class="text-3xl font-black text-slate-900">4.9</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Rating Rata-rata</p>
                        </div>
                    </div>
                </div>

                <div class="relative lg:h-[650px] flex items-center justify-center lg:justify-end">
                    <div class="absolute w-[500px] h-[500px] border-2 border-dashed border-orange-200 rounded-full animate-[spin_30s_linear_infinite]"></div>
                    
                    <div class="relative z-10 w-full max-w-md animate-float">
                        <div class="absolute inset-0 bg-orange-500 rounded-[3rem] rotate-6 opacity-20 blur-xl"></div>
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" 
                             alt="Delicious Food" 
                             class="relative rounded-[3rem] shadow-2xl shadow-orange-900/10 object-cover border-[6px] border-white w-full h-[500px]">
                        
                        <div class="absolute -left-12 top-20 glass-card p-4 rounded-2xl flex items-center gap-4 animate-bounce" style="animation-duration: 4s;">
                            <img src="https://malanglive.livetoday.id/wp-content/uploads/2024/10/1000188475.jpg" class="w-12 h-12 rounded-full object-cover border-2 border-white shadow-md">
                            <div>
                                <p class="text-xs font-bold text-slate-400 uppercase">Chef Terbaik Indonesia</p>
                                <p class="font-black text-slate-800">Chef Jujun</p>
                            </div>
                        </div>

                        <div class="absolute -right-6 bottom-32 glass-card p-4 rounded-2xl flex items-center gap-3 animate-bounce" style="animation-duration: 5s;">
                            <div class="text-orange-500 text-xl"><i class="fas fa-star"></i></div>
                            <div>
                                <p class="text-2xl font-black text-slate-800">4.9</p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Best Quality</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="py-10 border-y border-slate-100 bg-slate-50/50">
        <div class="max-w-7xl mx-auto px-6 overflow-hidden">
            <p class="text-center text-xs font-bold text-slate-400 uppercase tracking-[0.3em] mb-8">Didukung Oleh Perusahaan Ternama</p>
            <div class="flex justify-center flex-wrap gap-8 md:gap-16 opacity-50 grayscale hover:grayscale-0 transition-all duration-500">
                <i class="fab fa-google text-4xl"></i>
                <i class="fab fa-aws text-4xl"></i>
                <i class="fab fa-laravel text-4xl"></i>
                <i class="fab fa-react text-4xl"></i>
                <i class="fab fa-node text-4xl"></i>
            </div>
        </div>
    </div>

    <section id="fitur" class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="text-orange-600 font-black text-xs uppercase tracking-widest mb-2 block">Kenapa Harus ZiFood?</span>
                <h2 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight mb-6">Solusi Lapar di Era Digital</h2>
                <p class="text-slate-500 text-lg leading-relaxed">Kami menggabungkan teknologi modern dengan keahlian kuliner, untuk memberikan pengalaman jajan yang beda.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-orange-100 w-32 h-32 rounded-bl-full opacity-50 transition group-hover:scale-110"></div>
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm text-orange-600 relative z-10 group-hover:bg-orange-600 group-hover:text-white transition">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Pesan Kilat</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Pesan dari kelas, kantin, atau rumah. Makanan siap saat kamu sampai. Ucapkan selamat tinggal pada antrian.</p>
                </div>
                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-blue-100 w-32 h-32 rounded-bl-full opacity-50 transition group-hover:scale-110"></div>
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm text-blue-600 relative z-10 group-hover:bg-blue-600 group-hover:text-white transition">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Higienis & Halal</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Standar dapur profesional. Setiap bahan dipilih dengan teliti dan diproses dengan standar kebersihan tinggi.</p>
                </div>
                <div class="group p-8 rounded-[2.5rem] bg-slate-50 border border-slate-100 hover:bg-white hover:shadow-2xl hover:-translate-y-2 transition duration-500 relative overflow-hidden">
                    <div class="absolute top-0 right-0 bg-green-100 w-32 h-32 rounded-bl-full opacity-50 transition group-hover:scale-110"></div>
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-3xl mb-8 shadow-sm text-green-600 relative z-10 group-hover:bg-green-600 group-hover:text-white transition">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-4">Harga Jujur</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Ramah di kantong pelajar. Transparansi harga tanpa biaya tersembunyi yang bikin kaget di akhir.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="menu" class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden">
            <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-orange-600 rounded-full blur-[100px] opacity-20"></div>
            <div class="absolute bottom-[-10%] left-[-5%] w-96 h-96 bg-blue-600 rounded-full blur-[100px] opacity-20"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div>
                    <span class="text-orange-500 font-bold uppercase tracking-widest text-xs mb-2 block">Menu Spesial</span>
                    <h2 class="text-3xl lg:text-5xl font-black text-white tracking-tight">Karya Terbaik Minggu Ini</h2>
                </div>
                <a href="{{ route('login') }}" class="group flex items-center gap-2 text-white font-bold text-sm uppercase tracking-widest hover:text-orange-500 transition">
                    Lihat Semua Menu <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($menus->take(4) as $index => $menu)
                <div class="group bg-slate-800 rounded-[2.5rem] p-4 border border-slate-700 hover:border-orange-500/50 transition duration-500 hover:-translate-y-2">
                    <div class="relative h-64 rounded-[2rem] overflow-hidden mb-5">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent opacity-60 z-10"></div>
                        <img src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" onerror="this.src='https://via.placeholder.com/400x300?text=ZiFood'">
                        
                        <div class="absolute top-4 left-4 z-20 bg-white/10 backdrop-blur-md border border-white/20 text-white px-3 py-1 rounded-lg text-[10px] font-black uppercase tracking-widest">
                            {{ $menu->kategori }}
                        </div>

                        <div class="absolute inset-0 z-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <a href="{{ route('login') }}" class="bg-orange-600 text-white w-12 h-12 rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition transform">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>

                    <div class="px-2">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-black text-white leading-tight line-clamp-2 group-hover:text-orange-500 transition">{{ $menu->nama_MakananMinuman }}</h3>
                        </div>
                        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">By {{ $menu->user->name ?? 'Chef ZiFood' }}</p>
                        
                        <div class="flex items-center justify-between border-t border-slate-700 pt-4">
                            <div>
                                <p class="text-[10px] text-slate-400 uppercase font-bold">Harga</p>
                                <p class="text-xl font-black text-white">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                            </div>
                            <div class="flex text-yellow-500 text-xs gap-0.5">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-black text-slate-900 tracking-tight">Kata Mereka Tentang <span class="text-gradient">ZiFood</span></h2>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 relative">
                    <i class="fas fa-quote-right absolute top-8 right-8 text-4xl text-slate-200"></i>
                    <p class="text-slate-600 italic mb-6 leading-relaxed">"ZiFood ini sederhana, cepat, dan tepat sasaran. Yang penting rakyat kenyang dulu, urusan lain belakangan."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQbdkV5j7hcCrMyo-CGBRQB49KzTFobPMRGWQ&s" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-black text-slate-900 text-sm">Jokowi</p>
                            <p class="text-xs text-slate-500 font-bold uppercase">Mantan Presiden RI</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 relative mt-0 md:-mt-8 shadow-xl shadow-slate-100">
                    <i class="fas fa-quote-right absolute top-8 right-8 text-4xl text-orange-200"></i>
                    <p class="text-slate-600 italic mb-6 leading-relaxed">"Ketahanan perut adalah bagian dari ketahanan nasional. ZiFood harus jadi tulang punggung logistik makan siang anak kos!"</p>
                    <div class="flex items-center gap-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/55/Prabowo_Subianto_2024_official_portrait.jpg/250px-Prabowo_Subianto_2024_official_portrait.jpg" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-black text-slate-900 text-sm">Prabowo Subianto</p>
                            <p class="text-xs text-slate-500 font-bold uppercase">Presiden RI</p>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 p-8 rounded-[2rem] border border-slate-100 relative">
                    <i class="fas fa-quote-right absolute top-8 right-8 text-4xl text-slate-200"></i>
                    <p class="text-slate-600 italic mb-6 leading-relaxed">"Before Mars, we optimize food delivery. ZiFood is a good start."</p>
                    <div class="flex items-center gap-4">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Elon_Musk_-_54820081119_%28cropped%29.jpg/250px-Elon_Musk_-_54820081119_%28cropped%29.jpg" class="w-12 h-12 rounded-full">
                        <div>
                            <p class="font-black text-slate-900 text-sm">Musk Elon</p>
                            <p class="text-xs text-slate-500 font-bold uppercase">CEO SpaceX</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="py-20 bg-slate-50 border-t border-slate-200">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-black text-slate-900">Sering Ditanyakan (FAQ)</h2>
            </div>
            
            <div class="space-y-4" x-data="{ active: null }">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = (active === 1 ? null : 1)" class="w-full px-6 py-4 text-left flex justify-between items-center font-bold text-slate-800 hover:bg-slate-50 transition">
                        <span>Bagaimana cara memesan makanan?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="active === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-6 text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-4">
                        Cukup daftar akun sebagai pembeli, pilih menu yang kamu suka, masukkan ke keranjang, dan lakukan checkout. Kamu bisa bayar tunai saat pengambilan atau via transfer.
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = (active === 2 ? null : 2)" class="w-full px-6 py-4 text-left flex justify-between items-center font-bold text-slate-800 hover:bg-slate-50 transition">
                        <span>Apakah bisa delivery ke rumah?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="active === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-6 text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-4">
                        Ya, tentu bisa! ZiFood menyediakan layanan delivery langsung ke rumah oleh tim pengantar kami. Setelah melakukan pemesanan, kamu cukup memilih opsi pengiriman, dan pesanan akan diantar dengan aman, cepat, dan tepat waktu ke lokasi tujuanmu.
                    </div>
                </div>
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden">
                    <button @click="active = (active === 3 ? null : 3)" class="w-full px-6 py-4 text-left flex justify-between items-center font-bold text-slate-800 hover:bg-slate-50 transition">
                        <span>Saya ingin berjualan, bagaimana caranya?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="active === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-6 text-slate-600 text-sm leading-relaxed border-t border-slate-100 pt-4">
                        Mudah sekali! Daftarkan akunmu dan pilih peran sebagai "Penjual". Lengkapi profil usaha, tambahkan menu beserta foto terbaikmu, lalu kirim untuk verifikasi. Tim ZiFood akan meninjau data usahamu, dan setelah disetujui, kamu siap menerima pesanan dan mengembangkan bisnismu bersama kami.
            </div>
        </div>
    </section>

    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-slate-900"></div>
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <div class="absolute -right-20 -top-20 w-96 h-96 bg-orange-600 rounded-full blur-[150px] opacity-40"></div>
        
        <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
            <h2 class="text-4xl lg:text-6xl font-black text-white tracking-tight mb-8">Perut Kenyang, Hati Senang.<br>Tunggu Apa Lagi?</h2>
            <p class="text-slate-400 text-lg mb-12 max-w-2xl mx-auto">Bergabunglah sekarang dan nikmati revolusi kuliner sekolah yang modern, cepat, dan lezat.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-6">
                <a href="{{ route('register') }}" class="bg-orange-600 text-white px-12 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white hover:text-orange-600 transition duration-300 shadow-2xl shadow-orange-900/50 transform hover:scale-105">
                    Buat Akun Gratis
                </a>
                <a href="{{ route('login') }}" class="bg-transparent border-2 border-slate-700 text-white px-12 py-5 rounded-full font-black text-sm uppercase tracking-widest hover:bg-white hover:text-slate-900 hover:border-white transition duration-300">
                    Masuk Akun
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-white pt-20 pb-10 border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/logo.png') }}" class="h-8 w-8 object-contain">
                        <span class="text-2xl font-black text-slate-900">ZiFood.</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed max-w-sm mb-6">
                        Platform e-commerce kuliner yang didedikasikan untuk memajukan potensi masyarakat indonesia. Menghubungkan cita rasa lokal dengan teknologi masa depan.
                    </p>
                    <div class="flex gap-4">
                        <a href="https://www.instagram.com/jidan_flutter/" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-orange-600 hover:text-white transition"><i class="fab fa-instagram"></i></a>
                        <a href="https://web.facebook.com/profile.php?id=100085864167154" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-blue-600 hover:text-white transition"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-sky-500 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 uppercase tracking-widest text-xs mb-6">Tautan Cepat</h4>
                    <ul class="space-y-4 text-sm font-medium text-slate-500">
                        <li><a href="#" class="hover:text-orange-600 transition">Beranda</a></li>
                        <li><a href="#" class="hover:text-orange-600 transition">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-orange-600 transition">Daftar Menu</a></li>
                        <li><a href="#" class="hover:text-orange-600 transition">Daftar Mitra</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-black text-slate-900 uppercase tracking-widest text-xs mb-6">Kontak & Dukungan</h4>
                    <ul class="space-y-4 text-sm font-medium text-slate-500">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1 text-orange-500"></i>
                            <span>Perumahan Pesona candi 4,<br> Jl. Sekargadung, Kec. purworejo, Kota Pasuruan, Jawa Timur 67122</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-envelope text-orange-500"></i>
                            <span>Zaidanf504@gmail.com</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <i class="fas fa-phone text-orange-500"></i>
                            <span>+62 821 4006 6232</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">© 2026 ZiFood Inc. All rights reserved.</p>
                <div class="flex gap-6 text-xs font-bold text-slate-400 uppercase tracking-widest">
                    <a href="#" class="hover:text-orange-600 transition">Privacy Policy</a>
                    <a href="#" class="hover:text-orange-600 transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Video Modal -->
    <div x-show="videoModalOpen" 
         x-cloak
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="videoModalOpen = false; const v = $refs.zifoodVideo; if(v) { v.pause(); v.currentTime = 0; }"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 md:p-10 bg-slate-950/80 backdrop-blur-md">
        
        <!-- Backdrop Click to Close -->
        <div class="fixed inset-0" @click="videoModalOpen = false; const v = $refs.zifoodVideo; if(v) { v.pause(); v.currentTime = 0; }"></div>

        <!-- Modal Box -->
        <div x-show="videoModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4"
             class="relative w-full max-w-4xl bg-slate-900 border border-slate-700/60 rounded-3xl overflow-hidden shadow-2xl z-10">
            
            <!-- Modal Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-slate-800 bg-slate-900/90">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-orange-500/20 text-orange-500 flex items-center justify-center">
                        <i class="fas fa-play text-xs"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-white text-base">Video Profil ZiFood</h3>
                        <p class="text-xs text-slate-400">Kenali lebih dekat inovasi dan kelezatan karya ZiFood</p>
                    </div>
                </div>
                <button type="button" 
                        @click="videoModalOpen = false; const v = $refs.zifoodVideo; if(v) { v.pause(); v.currentTime = 0; }"
                        class="w-9 h-9 rounded-full bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700 flex items-center justify-center transition cursor-pointer">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <!-- Video Player -->
            <div class="relative bg-black aspect-video flex items-center justify-center">
                <video x-ref="zifoodVideo" 
                       class="w-full h-full object-contain" 
                       controls 
                       preload="metadata"
                       playsinline>
                    <source src="{{ asset('vid/zifood vidio.mp4') }}" type="video/mp4">
                    Browser Anda tidak mendukung pemutar video.
                </video>
            </div>
        </div>
    </div>

</body>
</html>