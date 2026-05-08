<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/cart', [PageController::class, 'cart']);
Route::get('/login', [PageController::class, 'login']);

Route::get('/product/{id?}', [ProductController::class, 'show']);

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/orders', [AdminController::class, 'orders']);
    Route::get('/categories', [AdminController::class, 'categories']);
    Route::get('/customers', [AdminController::class, 'customers']);
    Route::get('/discounts', [AdminController::class, 'discounts']);
    Route::get('/settings', [AdminController::class, 'settings']);
});
