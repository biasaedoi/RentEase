<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\DashboardController;


Route::get('/', fn() => redirect()->route('products.index'));

Route::get('/register', [AuthController::class, 'showRegister'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.show');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);

    Route::get('/rentals', [RentalController::class, 'index'])->name('rentals.index');
    Route::post('/products/{product}/rent', [RentalController::class, 'store'])->name('rentals.store');
    Route::post('/rentals/{rental}/status', [RentalController::class, 'updateStatus'])->name('rentals.updateStatus');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/rentals', [RentalController::class, 'adminIndex'])
        ->name('admin.rentals.index');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::resource('products', ProductController::class)->only(['index', 'show']);

