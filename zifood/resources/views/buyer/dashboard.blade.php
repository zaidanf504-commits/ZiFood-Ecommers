@extends('layouts.buyer')

@section('title', 'Jelajah Kuliner')
@section('header_title', 'Mau makan apa hari ini?')

@section('content')

    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        <form action="{{ route('buyer.explore') }}" method="GET" class="relative w-full md:w-96 group">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-orange-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <input type="text" name="search" value="{{ request('search') }}" class="w-full pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder-slate-400 focus:outline-none focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition shadow-sm" placeholder="Cari nasi goreng, kopi, dll...">
        </form>

        <div class="flex gap-2 overflow-x-auto pb-2 w-full md:w-auto custom-scrollbar">
            <a href="{{ route('buyer.explore') }}" class="px-5 py-2.5 {{ !request('kategori') || request('kategori') == 'Semua' ? 'bg-slate-900 text-white' : 'bg-white text-slate-500 border border-slate-100' }} rounded-xl text-xs font-bold shadow-sm shrink-0 hover:bg-orange-600 hover:text-white transition flex items-center gap-2">🔥 Semua</a>
            
            <a href="{{ route('buyer.explore', ['kategori' => 'Makanan']) }}" class="px-5 py-2.5 {{ request('kategori') == 'Makanan' ? 'bg-slate-900 text-white' : 'bg-white text-slate-500 border border-slate-100' }} rounded-xl text-xs font-bold shrink-0 hover:border-orange-200 hover:text-orange-600 hover:shadow-md transition flex items-center gap-2">🍔 Makanan</a>
            
            <a href="{{ route('buyer.explore', ['kategori' => 'Minuman']) }}" class="px-5 py-2.5 {{ request('kategori') == 'Minuman' ? 'bg-slate-900 text-white' : 'bg-white text-slate-500 border border-slate-100' }} rounded-xl text-xs font-bold shrink-0 hover:border-orange-200 hover:text-orange-600 hover:shadow-md transition flex items-center gap-2">🥤 Minuman</a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8">
        @forelse($menus as $menu)
        <div class="group bg-white rounded-[2.5rem] p-4 border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full relative">
            
            <div class="relative h-52 rounded-[2rem] overflow-hidden mb-4 bg-slate-50">
                <img src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onerror="this.src='https://via.placeholder.com/400x300?text=ZiFood'">
                
                <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-sm border border-white/20">
                    <span class="text-[9px] font-black text-orange-600 uppercase tracking-widest">{{ $menu->kategori }}</span>
                </div>

                @if($menu->stok < 1)
                <div class="absolute inset-0 bg-slate-900/70 backdrop-blur-[2px] flex items-center justify-center z-10">
                    <span class="text-white font-black text-lg uppercase tracking-widest border-2 border-white px-4 py-2 rounded-xl -rotate-12">Sold Out</span>
                </div>
                @endif
            </div>

            <div class="px-2 flex-1 flex flex-col">
                <h3 class="text-lg font-black text-slate-800 uppercase italic leading-tight line-clamp-2 group-hover:text-orange-600 transition-colors mb-2">{{ $menu->nama_MakananMinuman }}</h3>
                
                <a href="{{ route('buyer.shops.show', $menu->id_user) }}" class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4 hover:text-orange-500 transition">
                    By {{ $menu->user->name ?? 'Toko ZiFood' }} 🏪
                </a>
                
                <div class="mt-auto pt-4 border-t border-slate-50 border-dashed">
                    <div class="flex justify-between items-end mb-4">
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-0.5">Harga</p>
                            <p class="text-xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-0.5">Stok</p>
                            <p class="text-sm font-bold {{ $menu->stok < 5 ? 'text-red-500 animate-pulse' : 'text-slate-600' }}">{{ $menu->stok }} porsi</p>
                        </div>
                    </div>

                    @if($menu->stok > 0)
                    <div class="flex gap-2">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                            <button type="submit" class="w-full py-3 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:border-orange-500 hover:text-orange-500 transition shadow-sm flex items-center justify-center gap-2 group/btn">
                                🛒 <span class="group-hover/btn:translate-x-0.5 transition-transform">+1</span>
                            </button>
                        </form>

                        <form action="{{ route('cart.buyNow') }}" method="POST" class="flex-[2]">
                            @csrf
                            <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                            <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-orange-600 transition shadow-lg active:scale-95 flex items-center justify-center gap-2">
                                ⚡ Beli Cepat
                            </button>
                        </form>
                    </div>
                    @else
                    <button disabled class="w-full bg-slate-100 text-slate-300 py-3 rounded-xl font-bold uppercase text-[10px] tracking-widest cursor-not-allowed border border-slate-50">Stok Habis</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-32 text-center opacity-60">
            <div class="text-6xl mb-4 grayscale">🍽️</div>
            <h3 class="text-xl font-black text-slate-400 italic">Belum ada menu tersedia untuk saat ini...</h3>
        </div>
        @endforelse
    </div>
@endsection