<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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
    Route::get('/cart', [UserController::class, 'index'])->name('cart');
    Route::post('/add-cart', [UserController::class, 'store'])->name('add.cart');
    Route::get('/edit-cart/{id}', [UserController::class, 'edit'])->name('edit.cart');
    Route::post('/edit-cart', [UserController::class, 'update'])->name('update.cart');
    Route::post('/delete-cart/{id}', [UserController::class, 'delete'])->name('delete.cart');
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
});
