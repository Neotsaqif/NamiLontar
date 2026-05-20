<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminProductController;

Route::get('/', [PageController::class, 'home']);
Route::get('/about', [PageController::class, 'about']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/transactions', [PageController::class, 'transactions'])->name('transactions');
Route::get('/orders', [PageController::class, 'orders'])->name('orders');
Route::get('/orders/{id}/tracking', [PageController::class, 'tracking'])->name('tracking');

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminDiscountController;

Route::get('/product/{id?}', [ProductController::class, 'show']);

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Cart Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/api/cart/add', [CartController::class, 'add']);
    Route::post('/api/cart/update', [CartController::class, 'update']);
    Route::post('/api/cart/remove', [CartController::class, 'remove']);
    Route::get('/api/cart', [CartController::class, 'getCart']);
    
    // Checkout Routes
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/orders', [AdminController::class, 'orders']);
    Route::get('/orders/{id}', [AdminController::class, 'orderShow'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.updateStatus');
    Route::get('/customers', [AdminController::class, 'customers']);
    Route::get('/customers/{id}', [AdminController::class, 'customerShow'])->name('admin.customers.show');
    Route::get('/settings', [AdminController::class, 'settings']);

    // Product CRUD
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');

    // Category CRUD
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/categories/{id}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // Discount CRUD
    Route::get('/discounts', [AdminDiscountController::class, 'index'])->name('admin.discounts.index');
    Route::get('/discounts/create', [AdminDiscountController::class, 'create'])->name('admin.discounts.create');
    Route::post('/discounts', [AdminDiscountController::class, 'store'])->name('admin.discounts.store');
    Route::get('/discounts/{id}/edit', [AdminDiscountController::class, 'edit'])->name('admin.discounts.edit');
    Route::put('/discounts/{id}', [AdminDiscountController::class, 'update'])->name('admin.discounts.update');
    Route::delete('/discounts/{id}', [AdminDiscountController::class, 'destroy'])->name('admin.discounts.destroy');
});
