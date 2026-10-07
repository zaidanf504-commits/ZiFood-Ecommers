@extends('layouts.buyer')

@section('title', 'Pesanan Saya')
@section('header_title', 'Riwayat Pesanan')

@section('content')

    <div class="flex gap-2 mb-8 overflow-x-auto pb-2 custom-scrollbar">
        <button class="px-5 py-2.5 bg-slate-900 text-white rounded-full text-xs font-bold shadow-lg shadow-slate-200">Semua</button>
        <button class="px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-xs font-bold hover:border-orange-500 hover:text-orange-500 transition">⏳ Menunggu</button>
        <button class="px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-xs font-bold hover:border-blue-500 hover:text-blue-500 transition">🔥 Diproses</button>
        <button class="px-5 py-2.5 bg-white text-slate-500 border border-slate-200 rounded-full text-xs font-bold hover:border-green-500 hover:text-green-500 transition">✅ Selesai</button>
    </div>

    <div class="space-y-6" x-data="{ reviewModalOpen: false, selectedOrderId: null, selectedMenuName: '' }">
        
        @forelse($orders as $order)
        <div class="bg-white rounded-[2rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 group">
            <div class="flex flex-col md:flex-row justify-between md:items-center gap-6">
                
                <div class="flex gap-5 items-center">
                    <div class="w-20 h-20 rounded-2xl overflow-hidden bg-slate-100 shrink-0 border border-slate-100">
                        <img src="{{ asset('uploads/'.$order->menu->foto) }}" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-[10px] font-black bg-slate-100 text-slate-500 px-2 py-0.5 rounded-md uppercase tracking-widest">#{{ $order->id }}</span>
                            <span class="text-[10px] font-bold text-slate-400">{{ $order->created_at->format('d M Y, H:i') }}</span>
                        </div>
                        <h3 class="text-lg font-black text-slate-800 leading-tight">{{ $order->menu->nama_MakananMinuman }}</h3>
                        <p class="text-sm text-slate-500 font-medium mt-1">{{ $order->jumlah }} Porsi x Rp{{ number_format($order->menu->harga, 0, ',', '.') }}</p>
                    </div>
                </div>

                <div class="flex flex-col items-end gap-3 w-full md:w-auto border-t md:border-t-0 border-slate-50 pt-4 md:pt-0">
                    <div class="text-right">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Bayar</p>
                        <p class="text-xl font-black text-orange-600">Rp{{ number_format($order->total_harga, 0, ',', '.') }}</p>
                    </div>
                    
                    <div class="flex flex-wrap justify-end gap-2">
                        @php
                            $statusColor = match($order->status) {
                                'Menunggu' => 'bg-yellow-50 text-yellow-600 border-yellow-200',
                                'Diproses' => 'bg-blue-50 text-blue-600 border-blue-200 animate-pulse',
                                'Selesai' => 'bg-green-50 text-green-600 border-green-200',
                                'Dibatalkan' => 'bg-slate-100 text-slate-400 border-slate-200 line-through',
                                default => 'bg-slate-100 text-slate-700'
                            };
                        @endphp
                        <div class="px-4 py-2 rounded-xl border {{ $statusColor }} text-[10px] font-black uppercase tracking-widest text-center">
                            {{ $order->status }}
                        </div>

                        @if($order->status == 'Menunggu')
                            <form action="{{ route('buyer.orders.cancel', $order->id) }}" method="POST" onsubmit="return confirm('Yakin batalin?')">
                                @csrf @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-red-50 text-red-500 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-red-500 hover:text-white transition border border-red-100">
                                    ❌ Batal
                                </button>
                            </form>
                        @elseif($order->status == 'Selesai')
                            @php
                                $hasReviewed = \App\Models\Review::where('id_order', $order->id)->exists();
                            @endphp

                            @if(!$hasReviewed)
                                <button @click="reviewModalOpen = true; selectedOrderId = {{ $order->id }}; selectedMenuName = '{{ $order->menu->nama_MakananMinuman }}'" 
                                        class="px-4 py-2 bg-yellow-50 text-yellow-600 rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-yellow-400 hover:text-white transition border border-yellow-200 shadow-sm">
                                    ⭐ Ulas
                                </button>
                            @else
                                <span class="px-4 py-2 bg-slate-50 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-widest border border-slate-100">
                                    ⭐ Diulas
                                </span>
                            @endif

                            <form action="{{ route('buyer.orders.reorder', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-slate-900 text-white rounded-xl text-[10px] font-black uppercase tracking-widest hover:bg-orange-600 transition shadow-lg">
                                    🛒 Beli Lagi
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="text-center py-20">
            <h3 class="text-xl font-black text-slate-300">Belum ada pesanan nih</h3>
        </div>
        @endforelse

        <div x-show="reviewModalOpen" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center px-4">
            <div @click="reviewModalOpen = false" class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity"></div>
            
            <div class="bg-white rounded-[2rem] w-full max-w-md p-8 relative z-10 shadow-2xl animate-fade-in-up">
                <button @click="reviewModalOpen = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-800">✕</button>
                
                <h3 class="text-xl font-black text-slate-800 italic mb-1">Beri Ulasan</h3>
                <p class="text-sm text-slate-500 mb-6">Gimana rasa <span class="font-bold text-orange-600" x-text="selectedMenuName"></span>?</p>

                <form action="{{ route('review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_order" x-model="selectedOrderId">
                    
                    <div class="flex justify-center gap-2 mb-6" x-data="{ rating: 0, hoverRating: 0 }">
                        <input type="hidden" name="rating" x-model="rating">
                        <template x-for="star in 5">
                            <button type="button" 
                                    @click="rating = star" 
                                    @mouseover="hoverRating = star" 
                                    @mouseleave="hoverRating = 0"
                                    class="text-4xl transition-transform duration-200 hover:scale-110 focus:outline-none"
                                    :class="(hoverRating >= star || rating >= star) ? 'text-yellow-400' : 'text-slate-200'">
                                ★
                            </button>
                        </template>
                    </div>

                    <textarea name="komentar" rows="3" placeholder="Ceritakan pengalamanmu... (Opsional)" 
                              class="w-full bg-slate-50 border border-slate-200 rounded-xl p-4 text-sm font-bold focus:outline-none focus:border-orange-500 mb-6"></textarea>

                    <button type="submit" class="w-full py-3 bg-slate-900 text-white rounded-xl font-bold uppercase text-xs tracking-widest hover:bg-orange-600 transition shadow-lg">
                        Kirim Ulasan 🚀
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection