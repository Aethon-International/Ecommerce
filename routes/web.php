<?php

use App\Http\Controllers\admincontroller;
use App\Http\Controllers\homecontroller;
use App\Http\Controllers\productcontroller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//frontedn routes
Route::get('/', [homecontroller::class, 'index']);
//backend rotute
Route::get('/admin', [homecontroller::class, 'admin']);
// user admin seprate login 
Route::get('/redirect', [homecontroller::class, 'redirect']);
// logout routes 
Route::get('/logout', [homecontroller::class, 'logout']);

// all amdin dashboard side routes 
// categoryu route
Route::get('/category', [admincontroller::class, 'index']);
// addd category form route
Route::post('/add/category', [admincontroller::class, 'store']);
// delete category 
Route::get('/delete/category/{id}', [admincontroller::class, 'destroy']);
// producdt route
Route::get('/products', [productcontroller::class, 'index']);
// add products route data 
Route::post('/add/product', [productcontroller::class, 'store']);
// delete product 
Route::delete('/delete/product/{id}', [productcontroller::class, 'destroy']);
// show all produts in table seprate table
Route::get('/all/products', [productcontroller::class, 'show']);
// edit products from routes 
Route::get('/edit/product/{id}', [productcontroller::class, 'edit']);
//update proeucdt routes
Route::POST('/update/product/{id}', [productcontroller::class, 'update']);



/// frontend routes 
Route::get('/product/details/{id}', [homecontroller::class, 'details']);
// add to cart routes
Route::post('/add/product/cart/{id}', [homecontroller::class, 'cart']);
// show prouducts route
Route::get('/cart', [homecontroller::class, 'show_cart']);
// remvoe product from add to catg
Route::get('/remove/cart/{id}', [homecontroller::class, 'remove_cart']);
// move cart item to order table 
Route::get('/cash/order', [homecontroller::class, 'cash_order']);
// all orders route
Route::get('/orders', [homecontroller::class, 'orders']);
//cancel order 
Route::get('/remove/orders/{id}', [homecontroller::class, 'remove_orders']);





// testigtnf sweet alert works or not 
Route::get('/test-alert', function() {
    Alert::success('Hello!', 'SweetAlert is working!');
    return view('welcome');
});





