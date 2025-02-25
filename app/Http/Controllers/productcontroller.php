<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\order;
use App\Models\contact;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;


class productcontroller extends Controller
{
   public function index()
   {
    $category=category::all();
    $product=product::all();
    return view('admin.product',compact('category','product'));
   }
   public function store(Request $request)
   {
    // Creating the new product directly without validation
    $product = new Product;
    $product->name = $request->name;
    $product->category_id = $request->category_name;
    $product->price = $request->price;
    $product->original_price = $request->original_price;
    $product->description = $request->description;
    $product->quantity = $request->quantity;
    $product->status = $request->status;

    // Handling the image upload if present
    $image=$request->image;
    if($image)
    {
     $imagename=time().'.'.$image->getClientOriginalExtension();
     $request->image->move('product',$imagename);
     $product->image=$imagename;
  
    }
    

    $product->save();  // Save the product to the database

    return redirect()->back()->with('success', 'Product created successfully.');
   }
   public function destroy($id)
   {
    $product=product::find($id);
    $product->delete();
    return redirect()->back()->with('warning', 'Product deleted successfully.');
   }
   public function show()
   {
    $category=category::all();
    $product=product::all();
    return view('admin.allproducts',compact('category','product'));
   }
   public function edit($id)
   {
    $category=category::all();
    $product = product::find($id);
    return view('admin.edit',compact('category','product'));
   }
   public function update(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found.');
    }

    // Updating product details without validation
    $product->name = $request->name;
    $product->price = $request->price;
    $product->original_price = $request->original_price;
    $product->quantity = $request->quantity;
    $product->category_id = $request->category_id; 
    $product->description = $request->description;
    $product->status = $request->status;

    $image=$request->image;
    if($image)
    {
     $imagename=time().'.'.$image->getClientOriginalExtension();
     $request->image->move('product',$imagename);
     $product->image=$imagename;
  
    }
    $product->save();

    return redirect('/all/products')->with('success', 'Product updated successfully.');

}
public function  orders()
{
    $orders=order::all();
    return view('admin.orders',compact('orders'));
}
public function update_delivery_status( Request $request,$id)
{
    $order = Order::findOrFail($id);
    $order->delivery_status = $request->delivery_status; 
    $order->save(); 

    return redirect()->back()->with('success', 'Delivery status updated successfully.');
}
public function msg()
{
    $contact=contact::all();
    return view('admin.contact',compact('contact'));
}
}