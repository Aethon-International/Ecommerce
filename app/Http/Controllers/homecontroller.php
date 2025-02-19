<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;



use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class homecontroller extends Controller
{
    public function index()
    {
        $product = product::paginate(12);
        return view('frontend.home', compact('product'));
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
    public function details($id)
    {
        $product = product::find($id);
        return view('frontend.product_details', compact('product'));
    }
    public function cart($id)
    {
        if (Auth::id()) {

        } else
         {
            return redirect('/login');
        }
    }
}
