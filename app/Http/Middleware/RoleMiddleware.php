<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Cek apakah user yang login punya role yang sesuai.
     * Contoh pakai: Route::middleware('role:1') -> $role = '1'
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        if ((string) Auth::user()->role !== $role) {
            abort(403, 'Akses ditolak. Anda tidak punya izin untuk halaman ini.');
        }

        return $next($request);
    }
}