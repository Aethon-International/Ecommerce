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
Route::get('/admin', [homecontroller::class, 'admin']) ->middleware(['auth', 'admin']);
// user admin seprate login 
Route::get('/redirect', [homecontroller::class, 'redirect']);
// logout routes 
Route::get('/logout', [homecontroller::class, 'logout']);

// all amdin dashboard side routes 
// categoryu route
Route::get('/category', [admincontroller::class, 'index'])->middleware(['auth', 'admin']);
// addd category form route
Route::post('/add/category', [admincontroller::class, 'store']);
// delete category 
Route::get('/delete/category/{id}', [admincontroller::class, 'destroy']);
// producdt route
Route::get('/products', [productcontroller::class, 'index'])->middleware(['auth', 'admin']);
// add products route data 
Route::post('/add/product', [productcontroller::class, 'store']);
// delete product 
Route::delete('/delete/product/{id}', [productcontroller::class, 'destroy']);
// show all produts in table seprate table
Route::get('/all/products', [productcontroller::class, 'show'])->middleware(['auth', 'admin']);
// edit products from routes 
Route::get('/edit/product/{id}', [productcontroller::class, 'edit']);
//update proeucdt routes
Route::POST('/update/product/{id}', [productcontroller::class, 'update']);
// route for orders
Route::get('/orders/route', [productcontroller::class, 'orders'])->middleware(['auth', 'admin']);
//  update order status 
Route::post('/update/order/status/{id}', [productcontroller::class, 'update_delivery_status']);
// all mesages from contact form
Route::get('/messages', [productcontroller::class, 'msg'])->middleware(['auth', 'admin']);




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
// product searvh system
Route::get('/search', [homecontroller::class, 'product_search']);
// search for shop page search seprate
Route::get('/search/shop', [homecontroller::class, 'shop_search']);
// seprate shop page 
Route::get('/shop/page', [homecontroller::class, 'shop']);
// category alll
Route::get('/apple', [homecontroller::class, 'apple']);
Route::get('/oranges', [homecontroller::class, 'oranges']);
Route::get('/bnana', [homecontroller::class, 'bnana']);
Route::get('/strabury', [homecontroller::class, 'apple']);
/// all category end here you ca add manual category ok

//contact form roue indes
Route::get('/contact', [homecontroller::class, 'contact']);
// contact form uploda 
Route::post('/contact/form', [homecontroller::class, 'contact_form']);
// subscribe 
Route::post('/subscribe', [homecontroller::class, 'subscribe']);
// error page 404 not found
Route::get('/error', [homecontroller::class, 'error']);










// testigtnf sweet alert works or not 
Route::get('/test-alert', function() {
    Alert::success('Hello!', 'SweetAlert is working!');
    return view('welcome');
});





