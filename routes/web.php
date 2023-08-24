<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ShowProductController;
use App\Http\Controllers\SocialiteController;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $products = Product::all();
    return view('index', compact('products'));
});



Route::get('auth/facebook', [SocialiteController::class, 'redirectToFacebook']);
Route::get('auth/facebook/collback', [SocialiteController::class, 'handleFacebookCallback']);
// https: //127.0.0.1:8000/auth/facebook/collback
Route::get('/auth/google', [SocialiteController::class, 'redirectToGoogle']);
Route::get('/auth/google/collback', [SocialiteController::class, 'handleGoogleCallback']);



Route::middleware('auth')->group(function () {
    Route::get('/shop', [ShowProductController::class, 'index'])->name('shop');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::get('/cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/update_cart', [CartController::class, 'update_cart'])->name('update_cart');
    Route::get('/remove_from_cart/{id}', [CartController::class, 'remove_from_cart'])->name('remove_from_cart');

    Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('cartEmpty');
    Route::post('/checkout', [CartController::class, 'checkout_store'])->name('checkout_store')->middleware('cartEmpty');
});



Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/news', function () {
    return view('news');
})->name('news');
Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');