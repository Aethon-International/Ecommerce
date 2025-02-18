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
    return view('admin.product',compact('category'));
   }
   public function store(Request $request)
   {
    // Creating the new product directly without validation
    $product = new Product;
    $product->name = $request->name;
    $product->category_id = $request->category_id;
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

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
   }
}
