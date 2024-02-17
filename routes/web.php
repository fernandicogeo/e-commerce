<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact-us', [HomeController::class, 'index_contact_us'])->name('contact-us');
Route::get('/item/{id}', [HomeController::class, 'item_detail'])->name('item.detail');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'authenticate'])->name('login.authenticate');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'store'])->name('register.store');
Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');

Route::middleware(['auth:web', 'checkrole:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});

Route::middleware('auth:web')->group(function () {
    // cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/add-cart', [CartController::class, 'store'])->name('add.cart');
    Route::get('/edit-cart/{id}', [CartController::class, 'edit'])->name('edit.cart');
    Route::post('/edit-cart', [CartController::class, 'update'])->name('update.cart');
    Route::post('/delete-cart/{id}', [CartController::class, 'delete'])->name('delete.cart');
    // payment
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::post('/payment-cancel/{id}', [PaymentController::class, 'cancel'])->name('payment.cancel');

    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});
