<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class usermiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and is a normal user (usertype = 0)
        if (Auth::check() && Auth::user()->usertype == 0) {
            return $next($request);
        }

        // Redirect unauthorized users
        return redirect('/')->with('error', 'Access Denied! Users only.');
        
    }
}
