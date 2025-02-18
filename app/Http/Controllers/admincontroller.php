<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class admincontroller extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            // If logged in, show the admin page with categories
            $category = category::all();
            return view('admin.category', compact('category'));
        } else {
            // If not logged in, redirect to login page
            return redirect('/login');
        }
    }
    public function store(Request $request)
    {
        $category = new category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->back()->with('success', 'Category Added Successfully!');
    }
    public function destroy($id)
    {
        $category = category::find($id);
        $category->delete();

        return redirect()->back()->with('warning', 'Category Deleted Successfully!');
    }
}
