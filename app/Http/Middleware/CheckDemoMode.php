<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDemoMode
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika session 'is_demo' bernilai true (pengunjung sedang dalam mode demo)
        if (session('is_demo') === true) {
            // Blokir jika mereka mencoba mengirim data (Tambah/Edit/Hapus)
            if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])) {
                return redirect()->back()->with('error', 'Mode Demo: Anda hanya diizinkan untuk melihat (Read-Only).');
            }
        }

        return $next($request);
    }
}