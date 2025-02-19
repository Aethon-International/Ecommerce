<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\category;
use App\Models\product;
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
    if ($request->hasFile('image')) {
        $product->image = $request->file('image')->store('product_images', 'public');
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
}
