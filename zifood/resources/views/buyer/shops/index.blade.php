@extends('layouts.buyer')

@section('title', 'Daftar Toko')
@section('header_title', 'Pilih Restoran Favoritmu')

@section('content')

    <div class="mb-10 text-center md:text-left">
        <p class="text-slate-500 font-medium">Temukan koki terbaik dan nikmati hidangan spesial mereka.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8 pb-20">
        @forelse($shops as $shop)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden flex flex-col h-full">
            
            <div class="h-32 bg-slate-100 relative overflow-hidden">
                @if($shop->cover)
                    <img src="{{ asset('uploads/profiles/'.$shop->cover) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/0 transition"></div>
                @else
                    <div class="w-full h-full bg-gradient-to-r from-orange-100 to-orange-50 flex items-center justify-center">
                        <span class="text-4xl opacity-20">🏪</span>
                    </div>
                @endif
            </div>

            <div class="px-8 relative -mt-12 flex justify-center">
                <div class="w-24 h-24 rounded-full border-4 border-white shadow-lg bg-white overflow-hidden">
                    @if($shop->photo)
                        <img src="{{ asset('uploads/profiles/'.$shop->photo) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-orange-50 flex items-center justify-center text-orange-600 font-black text-2xl">
                            {{ substr($shop->name, 0, 1) }}
                        </div>
                    @endif
                </div>
            </div>

            <div class="p-6 text-center flex-1 flex flex-col">
                <h3 class="text-xl font-black text-slate-800 tracking-tight mb-1">{{ $shop->name }}</h3>
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-4">Mitra Resmi ZiFood</p>
                
                @if($shop->bio)
                    <p class="text-sm text-slate-500 line-clamp-2 mb-6 px-4 italic">"{{ $shop->bio }}"</p>
                @endif

                <div class="grid grid-cols-2 gap-4 mb-6 mt-auto">
                    <div class="bg-slate-50 rounded-2xl p-3">
                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Menu</p>
                        <p class="text-lg font-black text-slate-800">{{ $shop->menus_count }}</p>
                    </div>
                    <div class="bg-green-50 rounded-2xl p-3">
                        <p class="text-[9px] font-black text-green-600 uppercase tracking-widest">Status</p>
                        <p class="text-lg font-black text-green-700">Buka</p>
                    </div>
                </div>

                <a href="{{ route('buyer.shops.show', $shop->id) }}" class="w-full py-4 bg-slate-900 text-white rounded-2xl font-bold text-xs uppercase tracking-widest shadow-lg hover:bg-orange-600 hover:shadow-orange-200 transition transform active:scale-95">
                    Kunjungi Toko
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 opacity-50">
            <div class="text-6xl mb-4 grayscale">🏘️</div>
            <h3 class="text-xl font-bold text-slate-400">Belum ada mitra bergabung.</h3>
        </div>
        @endforelse
    </div>

@endsection