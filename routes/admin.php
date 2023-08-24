<?php

use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminRegisterController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
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

Route::group(['prefix' => "admin"], function () {
    //Login Page
    Route::get('', [AdminHomeController::class, 'index']);
    Route::get('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'checkLogin'])->name('admin.login.check');
    //Register Page
    Route::get('/register', [AdminRegisterController::class, 'register'])->name('admin.register');
    Route::post('/register', [AdminRegisterController::class, 'store'])->name('admin.register.store');
});


Route::group(['prefix' => "admin", "middleware" => "auth:admin"], function () {
    Route::get('/home', function () {
        return view('Admin.dashboard');
    })->name('admin.home');

    Route::resource('categores', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
    Route::get('orders', [OrderController::class, 'index'])->name('orders');


    //logout
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});