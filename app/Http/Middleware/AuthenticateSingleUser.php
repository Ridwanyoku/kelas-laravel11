<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateSingleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        // Jika pengguna belum login dan bukan di halaman login, arahkan ke login
        if (!$request->session()->has('authenticated') && !$request->is('auth/login')) {
            return redirect()->route('login');
        }

        // Jika pengguna sudah login dan mencoba mengakses login lagi, arahkan ke dashboard
        if ($request->session()->has('authenticated') && $request->is('auth/login')) {
            return redirect()->route('students.index');
        }

        return $next($request);
    }
}
