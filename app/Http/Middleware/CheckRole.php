<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$role)
    {
        // Pemeriksaan CSRF Token
        if ($request->method() !== 'GET') {
            $referer = URL::previous();
            if ($referer !== $request->url() && !URL::isValidUrl($referer)) {
                abort(419, 'CSRF token mismatch');
            }
        }

        // Periksa apakah pengguna telah login
        if (!Auth::check()) {
            // Jika belum login, arahkan kembali ke halaman login
            return redirect()->route('login.index');
        }

        // Periksa apakah pengguna memiliki role yang sesuai
        if (in_array($request->user()->role, $role)) {
            return $next($request);
        }

        abort(403, 'Unauthorized.');
        // abort(404, 'Page not found.');
    }
}