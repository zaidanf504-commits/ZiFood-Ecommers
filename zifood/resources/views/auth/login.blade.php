<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | ZiFood Enterprise</title>
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
        
        /* Glass Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-white min-h-screen flex overflow-hidden selection:bg-orange-500 selection:text-white">

    <div class="hidden lg:flex w-[50%] relative bg-gradient-to-br from-orange-600 to-red-700 items-center justify-center overflow-hidden">
        
        <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 2px, transparent 2px); background-size: 30px 30px;"></div>
        
        <div class="absolute top-[-10%] left-[-10%] w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-96 h-96 bg-yellow-400 opacity-20 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-lg px-10 text-white animate-fade">
            <div class="inline-flex items-center gap-2 bg-white/20 border border-white/20 rounded-full px-4 py-1.5 mb-6 backdrop-blur-md">
                <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                <span class="text-xs font-bold tracking-wider uppercase">Official Paket makanan System</span>
            </div>
            
            <h1 class="text-6xl font-black leading-tight mb-6 drop-shadow-sm">
                Layanan Juara,<br>
                <span class="text-yellow-300">Harga Pelajar.</span>
            </h1>
            <p class="text-orange-50 text-lg leading-relaxed mb-10 font-medium">
                Nikmati kemudahan memesan makanan favoritmu di manapun tanpa antri. Platform eksklusif untuk warga Indonesia.
            </p>
            
            <div class="glass-card p-5 rounded-2xl flex items-center gap-4 transform hover:scale-105 transition duration-300">
                <img src="data:image/jpeg;base64,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" class="w-12 h-12 rounded-full border-2 border-white shadow-md">
                <div>
                    <div class="flex text-yellow-300 text-xs mb-1">★★★★★</div>
                    <p class="text-sm font-semibold italic">"Pesen bakso sekarang gampang banget, tinggal klik langsung jadi!"</p>
                    <p class="text-xs text-orange-100 mt-1 font-bold">— Mas Gibran, Wakil Presiden</p>
                </div>
            </div>
        </div>
    </div>

    <div class="w-full lg:w-[50%] flex flex-col justify-center items-center p-8 lg:p-16 bg-white relative">
        <div class="w-full max-w-md animate-fade" style="animation-delay: 0.1s;">
            
            <div class="lg:hidden mb-8 flex items-center gap-3">
                <div class="w-10 h-10 bg-orange-600 rounded-xl flex items-center justify-center text-white font-bold shadow-lg shadow-orange-500/40">Z</div>
                <span class="font-bold text-2xl text-slate-800">ZiFood.</span>
            </div>

            <div class="mb-10">
                <h2 class="text-3xl font-black text-slate-900 mb-2">Selamat Datang! 👋</h2>
                <p class="text-slate-500 font-medium">Masuk untuk mulai memesan makanan.</p>
            </div>

            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 text-red-600 p-4 rounded-xl text-sm font-bold mb-8 flex items-center gap-3 shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                {{ session('error') }}
            </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="text-sm font-bold text-slate-700 ml-1">Email</label>
                    <input type="email" name="email" required 
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400" 
                        placeholder="contoh: siswa@smk.sch.id">
                </div>

                <div class="space-y-2">
                    <div class="flex justify-between items-center px-1">
                        <label class="text-sm font-bold text-slate-700">Password</label>
                        <a href="#" class="text-xs font-bold text-orange-600 hover:text-orange-700 hover:underline">Lupa Password?</a>
                    </div>
                    <div class="relative">
                        <input type="password" name="password" id="password" required 
                        class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-xl text-slate-900 font-bold focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition-all duration-300 placeholder-slate-400 pr-12" 
                        placeholder="••••••••">

                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-orange-500 transition-colors focus:outline-none">
                            <svg id="eyeIcon" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </button>    
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-slate-900 text-white rounded-xl font-bold uppercase text-xs tracking-[0.2em] hover:bg-orange-600 transition-all duration-300 shadow-xl hover:shadow-orange-200 transform hover:-translate-y-1 mt-4">
                    Masuk Sekarang
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-slate-500 text-sm font-medium">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-orange-600 font-bold hover:underline">Daftar disini</a>
                </p>
            </div>

            <a href="{{ url('/') }}" class="mt-8 block text-center text-xs font-bold text-slate-300 hover:text-slate-500 transition">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            togglePassword.addEventListener('click', function () {
                // Toggle atribut type
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle SVG path (Mata terbuka vs Mata disilang)
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
        });
    </script>
</body>
</html>