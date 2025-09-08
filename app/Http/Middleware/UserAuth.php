<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Agar user login hai aur fir login page khol raha hai → home bhejo
        if ($request->path() == "login" && $request->session()->has('user')) {
            return redirect('/');
        }

        // Agar user login nahi hai aur product page khol raha hai → login bhejo
        if ($request->path() == "/" && !$request->session()->has('user')) {
            return redirect('/login');
        }

        return $next($request);
    }
}