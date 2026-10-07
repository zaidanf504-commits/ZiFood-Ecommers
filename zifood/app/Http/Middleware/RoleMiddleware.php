<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Jika belum login, tendang ke halaman login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Jika role tidak sesuai (misal pembeli mau masuk area penjual)
        if (Auth::user()->role !== $role) {
            // Mental ke halaman masing-masing jika coba-coba pindah lapak
            return Auth::user()->role === 'penjual' 
                ? redirect('/seller/dashboard') 
                : redirect('/dashboard');
        }

        return $next($request);
    }
}