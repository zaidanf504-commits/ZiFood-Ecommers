<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_order' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500'
        ]);

        $order = Order::findOrFail($request->id_order);

        if($order->id_user != Auth::id() || $order->status != 'Selesai') {
            return back()->with('error', 'Transaksi belum selesai atau bukan milikmu!');
        }

        $existingReview = Review::where('id_order', $order->id)->first();
        if($existingReview) {
            return back()->with('error', 'Kamu sudah mengulas pesanan ini.');
        }

        Review::create([
            'id_user' => Auth::id(),
            'id_menu' => $order->id_menu,
            'id_order' => $order->id,
            'rating' => $request->rating,
            'komentar' => $request->komentar
        ]);

        return back()->with('success', 'Terima kasih! Ulasanmu sangat berarti. ⭐');
    }
}