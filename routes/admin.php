<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RestaurantController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Admin routess
Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (login)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AuthController::class, 'login']);
    });

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // Admin Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Restaurant management
        Route::resource('restaurants', RestaurantController::class);

        // Product management
        Route::resource('products', ProductController::class);

        // Order management
        Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit', 'update']);
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    });
});
