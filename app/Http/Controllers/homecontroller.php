<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use Illuminate\Support\Facades\DB;
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
        $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

        return view('frontend.home', compact('product','cartcount'));
    }
    public function admin()
    {
        return view('admin.home');
    }
    public function redirect()
    {

        $user = Auth::user(); // Logged-in user
        $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

        if ($user && $user->usertype == '1') {
            return view('admin.home'); // Admin redirect
        } else {
            $product = product::paginate(12);
            return view('frontend.home',compact('product','cartcount')); // Normal user redirect
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
        $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
        return view('frontend.product_details', compact('product','cartcount'));
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
            $cart->price=$product->price;
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
    public function show_cart()
        {

            $user=Auth::user();
            $id=Auth::user()->id;
            $cart = cart::where('user_id',$id)->get();
            //cart items coutn 
            $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

            $subtotal = Cart::where('user_id', Auth::id())
    ->select(DB::raw('SUM(price * quantity) as total_price'))
    ->value('total_price');

     $subquantity = Cart::where('user_id', Auth::id())->sum('quantity');

// Total (No need to add quantity to price)
           $total = $subtotal ?? 0; // Handle null case

           

            return view('frontend.cart',compact('cart','cartcount','subtotal','user'));
        }
        public function remove_cart($id)
        {
        $cart=cart::find($id);
        $cart->delete();
        Alert::success('Success', 'Product Remove From Cart');
           return redirect()->back();
        }
        public function cash_order()
        {
            $user=Auth::user();
            $userid=Auth::id();
            $data=cart::where('user_id','=',$userid)->get();
            foreach($data as $data)
            {
              $order=new order;
              $order->name=$data->name;
              $order->email=$data->email;
              $order->phone=$data->phone;
              $order->address=$data->address;
              $order->user_id=$data->user_id;
              $order->product_title=$data->product_title;
              $order->quantity=$data->quantity;
              $order->price=$data->price;
              $order->image=$data->image;
              $order->product_id=$data->product_id;
              
              $order->payment_status = "cash on delivery";
              $order->delivery_status = "pending";
              $order->save();
              
              $cart_id=$data->id;
              $cart=cart::find($cart_id);
              $cart->delete();
             

            }
            Alert::success('Success ', 'We Have Recieved Your Order!');
            return  redirect('/orders');

            
            
        }
        public function orders()
    {
        $user = Auth::user();
         $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
         $userid=Auth::id();
            $order=order::where('user_id','=',$userid)->get();
        

        return view('frontend.orders',compact('cartcount','order'));
    }
    public function remove_orders($id)
    {
        $order = order::find($id);

        if ($order && $order->delivery_status == 'pending') {
            $order->delete(); 
            Alert::success('Success ', 'Product Remove From Orders!');
            
        }
        return redirect()-> back();
        Alert::warning('Warning ', 'Order Cannot Be Modified!');

    }
      
    public function product_search(Request $request){
        $search_text=$request->search;
        $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
    
        $product=product::where('name','LIKE',"%$search_text%")->orwhere('category_id','LIKE',"$search_text")->paginate(12);
        return view('frontend.home',compact('product','cartcount'));

}
}
