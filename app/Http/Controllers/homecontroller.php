<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;




use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class homecontroller extends Controller
{
   public function index()
   {
    return view('frontend.home');
   }
   public function admin()
   {
    return view('admin.home');
   }
   public function redirect()
   {

   $user = Auth::user(); // Logged-in user

    if ($user && $user->usertype == '1') {
        return view('admin.home'); // Admin redirect
    } else {
        return view('frontend.home'); // Normal user redirect
    }
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}