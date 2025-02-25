<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class adminmiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // ✅ If user is not logged in, redirect to login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must be logged in.');
        }

        // ✅ If user is not an admin, redirect to homepage
        if (Auth::user()->usertype != 1) {
            return redirect('/error')->with('error', 'Access Denied: Admins Only.');
        }

        return $next($request); // ✅ Allow access for admins
    }
}
