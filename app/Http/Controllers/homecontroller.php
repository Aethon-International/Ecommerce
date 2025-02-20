<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\cart;
use Session;
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
    public function cart(Request $request ,$id)
    {
        if (Auth::id()) {
            $user=Auth::user();
           
            $product=product::find($id);
            $cart = new cart();
            $cart->name=$user->name;
            $cart->email=$user->email;
            $cart->phone=$user->phone;
            $cart->address=$user->address;
            $cart->product_title=$product->name;
            $cart->price=$product->price *  $request->quantity;
            $cart->quantity=$request->quantity;
            $cart->image=$product->image;
            $cart->product_id=$product->id;
            $cart->user_id=$user->id;
            $cart->save();
           
            Alert::success('Success', 'Product added to cart successfully!');
            return redirect()->back();
         



        } else
         {
            Alert::error('Access Denied', 'Please login first!');
           return redirect()->back();
        }
    }
}
