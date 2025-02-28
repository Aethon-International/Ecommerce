<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\cart;
use App\Models\order;
use App\Models\contact;
use App\Models\notifications;
use Illuminate\Support\Facades\Validator;
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
     
        
            $totalusers = user::count(); // Total users
            $totalorders = order::count(); // Total orders
        
            // Count orders by status
            $pendingorders = order::where('delivery_status', 'pending')->count();
            $shippedorders = order::where('delivery_status', 'shipped')->count();
            $deliveredorders = order::where('delivery_status', 'delivered')->count();
            $canceledorders = order::where('delivery_status', 'canceled')->count();
                return view('admin.home',compact('totalusers','totalorders','shippedorders','pendingorders','deliveredorders','canceledorders',));
       
        
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

            if (Auth::id())
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
            } else{
                $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
                return view('frontend.error',compact('cartcount'));
            }

            
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
public function shop_search(Request $request){
    $search_text=$request->search;
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

    $product=product::where('name','LIKE',"%$search_text%")->orwhere('category_id','LIKE',"$search_text")->paginate(12);
    return view('frontend.shop_page',compact('product','cartcount'));
}

public function shop()
{
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
    $product = product::paginate(12);
    return view('frontend.shop_page',compact('cartcount','product'));
}
public function apple(Request $request)
{
    $search_text = 'apple';

    // Get the category ID where name matches 'apple'
    $category = Category::where('name', 'LIKE', "%$search_text%")->first();
    
    $category_id = $category ? $category->id : null;
    
    // Search products by name or category_id
    $product = product::where('name', 'LIKE', "%$search_text%")
        ->orWhere('category_id', $category_id)
        ->paginate(12);
    
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

    return view('frontend.shop_page',compact('cartcount','product'));
}
public function oranges(Request $request)
{
    $search_text = 'oragnes';

    // Get the category ID where name matches 'apple'
    $category = Category::where('name', 'LIKE', "%$search_text%")->first();
    
    $category_id = $category ? $category->id : null;
    
    // Search products by name or category_id
    $product = product::where('name', 'LIKE', "%$search_text%")
        ->orWhere('category_id', $category_id)
        ->paginate(12);
    
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

    return view('frontend.shop_page',compact('cartcount','product'));
}
public function bnana(Request $request)
{
    $search_text = 'bnana';

    // Get the category ID where name matches 'apple'
    $category = Category::where('name', 'LIKE', "%$search_text%")->first();
    
    $category_id = $category ? $category->id : null;
    
    // Search products by name or category_id
    $product = product::where('name', 'LIKE', "%$search_text%")
        ->orWhere('category_id', $category_id)
        ->paginate(12);
    
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

    return view('frontend.shop_page',compact('cartcount','product'));
}
public function strabury(Request $request)
{
    $search_text = 'strabury';

    // Get the category ID where name matches 'apple'
    $category = Category::where('name', 'LIKE', "%$search_text%")->first();
    
    $category_id = $category ? $category->id : null;
    
    // Search products by name or category_id
    $product = product::where('name', 'LIKE', "%$search_text%")
        ->orWhere('category_id', $category_id)
        ->paginate(12);
    
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;

    return view('frontend.shop_page',compact('cartcount','product'));
}
public function contact()
{
    
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
    $product = product::paginate(12);
    return view('frontend.contact',compact('cartcount','product'));

}
public function contact_form(Request $request)
{
    $contact=new contact();
    $contact->name=$request->name;
    $contact->email=$request->email;
    $contact->messages=$request->messages;
    $contact->save();
    Alert::success('Success ', 'We Have Recieved Your Inquery!');
    return redirect()-> back();
       

}
public function subscribe(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|unique:notifications,email', // Ensure 'subscribes' is correct
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Create a new instance of Subscribe model
    $subscribe = new notifications();
    $subscribe->email = $request->email;
    $subscribe->save();

    // Show success message
    Alert::success('Success', 'Subscription Successful! You will receive daily updates.');

    return redirect()->back();
}
public function error()
{
    $cartcount = Auth::check() ? cart::where('user_id', Auth::id())->count() : 0;
    $product = product::paginate(12);
    return view('frontend.error',compact('cartcount','product'));
    
}
}
