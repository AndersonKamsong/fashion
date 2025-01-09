<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
    // return view('welcome');
});

Route::get("/home" , [UserController::class ,'getProducts'] )->name('home');
Route::get("/about-us" ,function(){ return view('about-us'); })->name('about-us');
Route::get("/product" ,function(){ return view('product'); })->name('product');
// Route::get("/product-detail" ,function(){ return view('product-detail'); })->name('product-detail');
Route::get("/cart" , [CartController::class ,'index'] )->name('cart');
Route::get("/help" ,function(){ return view('help'); })->name('help');

// Auths routes
// Route::get('/sign-in' ,function(){ return view('auth.login'); })->name('login');
// Route::get('/sign-up' ,function(){ return view('auth.register'); })->name('register');

Route::get('/dashboard/view' , [ProductController::class ,'index'] )->name('dashboard.view');
Route::get('/dashboard/create' , [ProductController::class ,'create'] )->name('dashboard.create');
Route::post('/dashboard/store' , [ProductController::class ,'store'] )->name('dashboard.store');
Route::get('/dashboard/edit/{product}' , [ProductController::class ,'edit'] )->name('dashboard.edit');
Route::post('/dashboard/update/{product}' , [ProductController::class ,'update'] )->name('dashboard.update');
Route::delete('/dashboard/delete/{product}' , [ProductController::class ,'destroy'] )->name('dashboard.destroy');

Route::get('/cart/add/{product}' ,[CartController::class ,'addToCart'])->name('cart.add');
Route::get('/cart/remove/{product}' ,[CartController::class ,'removeFromCart'])->name('cart.remove');
Route::get('/cart/increase/{product}' ,[CartController::class ,'increaseQuantity'])->name('cart.increase');
Route::get('/cart/decrease/{product}' ,[CartController::class ,'decreaseQuantity'])->name('cart.decrease');
Route::get('/cart/discard' ,[CartController::class ,'destroy'])->name('cart.discard');

Route::post('/order' ,[OrderController::class ,'index'])->name('order');
Route::get('/order/view' ,[OrderController::class ,'view'])->name('order.view');
Route::delete('/order/delete/{order}' ,[OrderController::class ,'destroy'])->name('order.delete');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
