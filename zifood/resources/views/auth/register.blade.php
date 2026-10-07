<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | ZiFood Enterprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        
        /* Smooth Fade In */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade { animation: fadeIn 0.6s ease-out forwards; }
        
        /* Custom Radio Selection */
        input[type="radio"]:checked + div {
            border-color: #ea580c;
            background-color: #fff7ed;
            box-shadow: 0 4px 20px rgba(234, 88, 12, 0.15);
        }
        input[type="radio"]:checked + div .icon-box { background-color: #ea580c; color: white; transform: rotate(-6deg); }
        
        /* Hide Scrollbar */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-white min-h-screen flex overflow-hidden selection:bg-orange-500 selection:text-white">

    <div class="hidden lg:flex w-[50%] relative bg-gradient-to-br from-orange-600 to-red-700 items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 2px, transparent 2px); background-size: 30px 30px;"></div>
        
        <div class="relative z-10 text-center px-12 animate-fade">
            <div class="relative inline-block group">
                <div class="absolute -inset-1 bg-white rounded-full blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                <img src="https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" 
                     class="relative w-72 h-72 object-cover rounded-full shadow-2xl border-8 border-white/20 animate-[spin_20s_linear_infinite]">
            </div>
            
            <h2 class="text-4xl font-black text-white mt-10 mb-4 drop-shadow-md">Gabung Sekarang! 🚀</h2>
            <p class="text-orange-50 text-lg max-w-md mx-auto font-medium">
                Jadilah bagian dari revolusi layanan pengantar makanan digital. Pesan, bayar, dan ambil makananmu dengan gaya.
            </p>
        </div>
    </div>

    <div class="w-full lg:w-[50%] flex flex-col h-screen bg-white">
        <div class="flex-1 overflow-y-auto no-scrollbar p-8 lg:p-16 flex flex-col justify-center">
            
            <div class="w-full max-w-md mx-auto animate-fade" style="animation-delay: 0.1s;">
                
                <div class="lg:hidden mb-8 flex items-center gap-3">
                    <div class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-orange-500/40">Z</div>
                    <span class="font-bold text-2xl text-slate-800">ZiFood.</span>
                </div>

                <div class="mb-8">
                    <h2 class="text-3xl font-black text-slate-900 mb-2">Buat Akun Baru.</h2>
                    <p class="text-slate-500 font-medium">Isi data dirimu dengan benar ya.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1">Nama</label>
                        <input type="text" name="name" required 
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400" 
                            placeholder="Isi nama lengkapmu">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 ml-1">Email</label>
                        <input type="email" name="email" required 
                            class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400" 
                            placeholder="nama@gmail.com">
                    </div>

                    <div class="space-y-3 pt-2">
                        <label class="text-xs font-black text-slate-400 uppercase tracking-widest ml-1">Tipe Akun</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer group relative">
                                <input type="radio" name="role" value="pembeli" class="hidden" checked>
                                <div class="border-2 border-slate-100 rounded-2xl p-4 transition-all duration-300 hover:border-orange-200 h-full relative overflow-hidden bg-white">
                                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-xl mb-3 icon-box transition-transform duration-300">🍔</div>
                                    <span class="block text-slate-900 font-bold">Pembeli</span>
                                    <span class="text-xs text-slate-500">Mau jajan enak</span>
                                </div>
                            </label>
                            
                            <label class="cursor-pointer group relative">
                                <input type="radio" name="role" value="penjual" class="hidden">
                                <div class="border-2 border-slate-100 rounded-2xl p-4 transition-all duration-300 hover:border-orange-200 h-full relative overflow-hidden bg-white">
                                    <div class="w-10 h-10 bg-slate-100 rounded-lg flex items-center justify-center text-xl mb-3 icon-box transition-transform duration-300">👨‍🍳</div>
                                    <span class="block text-slate-900 font-bold">Penjual</span>
                                    <span class="text-xs text-slate-500">Mau jualan produk</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    
    <div class="space-y-2">
        <label class="text-sm font-bold text-slate-700 ml-1">Password</label>
        <div class="relative">
            <input type="password" name="password" id="password" required 
                class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400 pr-12" 
                placeholder="••••••••">
            <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-orange-500 transition-colors focus:outline-none">
                <svg id="eyeIcon1" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
    </div>

        <div class="space-y-2">
            <label class="text-sm font-bold text-slate-700 ml-1">Konfirmasi</label>
            <div class="relative">
                <input type="password" name="password_confirmation" id="password_confirmation" required 
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400 pr-12" 
                    placeholder="••••••••">
                <button type="button" id="toggleConfirm" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-orange-500 transition-colors focus:outline-none">
                    <svg id="eyeIcon2" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </button>
            </div>
        </div>

    </div>

                    <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold uppercase text-xs tracking-[0.2em] hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-200 transform hover:-translate-y-1 mt-4">
                        Buat Akun Sekarang
                    </button>
                </form>

                <div class="mt-8 text-center pb-10">
                    <p class="text-slate-500 text-sm font-medium">Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-orange-600 font-bold hover:underline">Masuk aja</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        
        // Fungsi reusable untuk menangani klik tombol mata
        function setupToggle(buttonId, inputId, iconId) {
            const toggleBtn = document.getElementById(buttonId);
            const inputField = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            toggleBtn.addEventListener('click', function () {
                const type = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', type);
                
                if (type === 'password') {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                } else {
                    eyeIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                    `;
                }
            });
        }

        // Panggil fungsi untuk masing-masing kolom password
        setupToggle('togglePassword', 'password', 'eyeIcon1');
        setupToggle('toggleConfirm', 'password_confirmation', 'eyeIcon2');
        
    });
</script>
</body>
</html>