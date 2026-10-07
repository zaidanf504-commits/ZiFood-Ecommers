@extends('layouts.buyer')

@section('title', 'Cari Makanan')
@section('header_title', 'Jelajah Rasa')

@section('content')
    
    <div class="bg-white rounded-[2rem] p-4 mb-8 shadow-sm border border-slate-100">
        <form action="{{ route('buyer.explore') }}" method="GET">
            <div class="flex flex-col xl:flex-row gap-4 items-center justify-between">
                
                <div class="w-full xl:flex-1 flex flex-col md:flex-row gap-3">
                    
                    <div class="relative w-full group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-orange-500 transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nasi goreng, kopi, dll..." 
                               class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-100 rounded-2xl text-sm font-bold text-slate-700 placeholder-slate-400 focus:outline-none focus:bg-white focus:border-orange-500 focus:ring-4 focus:ring-orange-500/10 transition shadow-sm">
                    </div>

                    <div class="relative w-full md:w-auto min-w-[200px]">
                        <select name="kategori" onchange="this.form.submit()" class="appearance-none w-full pl-4 pr-10 py-3.5 bg-slate-50 hover:bg-white border border-slate-100 rounded-2xl text-sm font-bold text-slate-600 focus:outline-none focus:border-orange-500 cursor-pointer shadow-sm transition hover:shadow-md">
                            <option value="Semua">🔥 Semua Kategori</option>
                            <option value="Makanan Berat" {{ request('kategori') == 'Makanan Berat' ? 'selected' : '' }}>🍔 Makanan Berat</option>
                            <option value="Minuman" {{ request('kategori') == 'Minuman' ? 'selected' : '' }}>🥤 Minuman</option>
                            <option value="Camilan" {{ request('kategori') == 'Camilan' ? 'selected' : '' }}>🍟 Camilan</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="relative w-full xl:w-auto min-w-[180px]">
                    <select name="sort" onchange="this.form.submit()" class="appearance-none w-full pl-5 pr-12 py-3.5 bg-slate-900 text-white border border-slate-900 rounded-2xl text-sm font-bold focus:outline-none cursor-pointer shadow-lg shadow-slate-200 hover:bg-orange-600 hover:border-orange-600 transition">
                        <option value="terbaru" {{ request('sort') == 'terbaru' ? 'selected' : '' }}>✨ Terbaru</option>
                        <option value="termurah" {{ request('sort') == 'termurah' ? 'selected' : '' }}>💰 Termurah</option>
                        <option value="termahal" {{ request('sort') == 'termahal' ? 'selected' : '' }}>💎 Termahal</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none text-white/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @if(request('search'))
        <div class="mb-8 flex items-center gap-2">
            <span class="text-sm font-bold text-slate-500">Hasil pencarian:</span>
            <span class="px-3 py-1 bg-orange-50 text-orange-600 rounded-lg text-xs font-black uppercase tracking-widest border border-orange-100">"{{ request('search') }}"</span>
            <a href="{{ route('buyer.explore') }}" class="ml-auto text-xs font-bold text-slate-400 hover:text-red-500 transition border-b border-dashed border-slate-300 hover:border-red-400 pb-0.5">Hapus Filter ✕</a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-8 pb-20">
        @forelse($menus as $menu)
        <div class="group bg-white rounded-[2.5rem] p-4 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col h-full relative">
            
            <div class="relative h-60 rounded-[2rem] overflow-hidden mb-5 bg-slate-50">
                <img src="{{ asset('uploads/'.$menu->foto) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" onerror="this.src='https://via.placeholder.com/400x300?text=ZiFood'">
                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-sm border border-white/20">
                    <span class="text-[9px] font-black text-orange-600 uppercase tracking-widest">{{ $menu->kategori }}</span>
                </div>
                @if($menu->stok < 1)
                <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-[2px] flex items-center justify-center z-10">
                    <span class="text-white font-black text-xl uppercase tracking-widest border-2 border-white px-6 py-3 rounded-2xl -rotate-12">Sold Out</span>
                </div>
                @endif
            </div>

            <div class="px-2 flex-1 flex flex-col">
                <div class="mb-4">
                    <h3 class="text-xl font-black text-slate-800 uppercase italic leading-tight line-clamp-2 group-hover:text-orange-600 transition-colors mb-2">{{ $menu->nama_MakananMinuman }}</h3>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-[10px] font-black text-slate-500">
                            {{ substr($menu->user->name ?? 'K', 0, 1) }}
                        </div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Koki {{ $menu->user->name ?? 'ZiFood' }}</p>
                    </div>
                </div>

                <div class="mt-auto pt-5 border-t border-slate-50 border-dashed">
                    <div class="flex justify-between items-end mb-5">
                        <div>
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Harga</p>
                            <p class="text-2xl font-black text-slate-900 tracking-tighter">Rp{{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-1">Stok</p>
                            <p class="text-sm font-bold {{ $menu->stok < 5 ? 'text-red-500 animate-pulse' : 'text-slate-600' }}">{{ $menu->stok }} Porsi</p>
                        </div>
                    </div>

                    @if($menu->stok > 0)
                    <div class="flex gap-3" x-data="{ count: 1 }">
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-1">
                            @csrf
                            <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                            <input type="hidden" name="jumlah" value="1">
                            <button type="submit" class="w-full py-3.5 bg-slate-50 border border-slate-100 text-slate-700 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-orange-50 hover:border-orange-100 hover:text-orange-600 transition shadow-sm flex items-center justify-center gap-2 group/btn">
                                🛒 <span class="group-hover/btn:translate-x-0.5 transition-transform">Add</span>
                            </button>
                        </form>
                        <form action="{{ route('order.store') }}" method="POST" class="flex-[2]">
                            @csrf
                            <input type="hidden" name="id_menu" value="{{ $menu->id_menu }}">
                            <input type="hidden" name="jumlah" value="1">
                            <button type="submit" class="w-full py-3.5 bg-slate-900 text-white rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-orange-600 transition shadow-lg shadow-slate-200 hover:shadow-orange-200 active:scale-95 flex items-center justify-center gap-2">
                                ⚡ Beli Cepat
                            </button>
                        </form>
                    </div>
                    @else
                    <button disabled class="w-full bg-slate-50 text-slate-300 py-3.5 rounded-xl font-bold uppercase text-[10px] tracking-widest cursor-not-allowed border border-slate-100">Stok Habis</button>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-32 text-center bg-white rounded-[3rem] border border-dashed border-slate-200 mx-4">
            <div class="text-7xl mb-6 opacity-20 grayscale animate-bounce">🍲</div>
            <h3 class="text-2xl font-black text-slate-300 uppercase italic tracking-tighter">Menu Tidak Ditemukan</h3>
            <p class="text-slate-400 text-sm mt-3 font-medium max-w-md mx-auto">Sepertinya koki belum masak menu yang kamu cari. Coba kata kunci lain?</p>
            <a href="{{ route('buyer.explore') }}" class="inline-block mt-8 px-8 py-3 bg-slate-900 text-white rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-orange-600 transition shadow-lg">Reset Filter ↺</a>
        </div>
        @endforelse
    </div>
@endsection