<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Include admin routesss
require __DIR__.'/admin.php';

Route::get('/', function () {
    $restaurants = \App\Models\Restaurant::where('is_active', true)
        ->with(['products' => function($query) {
            $query->where('is_available', true)->take(3);
        }])
        ->get();

    return Inertia::render('Home', [
        'restaurants' => $restaurants
    ]);
});

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/privacy', function () {
    return Inertia::render('Privacy');
})->name('privacy');

// QR Image Book Viewer Routeee
Route::get('/qrs/{id}', [App\Http\Controllers\QRController::class, 'show']);

// PDF file serving route
Route::get('/pdf/{filename}', function ($filename) {
    $filePath = public_path('asset/bakiza-pdf/' . $filename);

    if (!file_exists($filePath)) {
        abort(404, 'PDF file not found');
    }

    return response()->file($filePath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . $filename . '"',
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => 'GET',
        'Access-Control-Allow-Headers' => 'Content-Type',
    ]);
});

// Menu images serving route
Route::get('/menu/{filename}', function ($filename) {
    $filePath = public_path('menu/' . $filename);

    if (!file_exists($filePath)) {
        abort(404, 'Menu image not found');
    }

    return response()->file($filePath);
});

// Restaurant images serving route
Route::get('/rest/{filename}', function ($filename) {
    $filePath = public_path('rest/' . $filename);

    if (!file_exists($filePath)) {
        abort(404, 'Restaurant image not found');
    }

    return response()->file($filePath);
});

// Test route
Route::get('/test-qr', function () {
    return response()->json(['message' => 'QR test route works']);
});

// Restaurant routesss
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

// Customer Order routes (no authentication required)
Route::get('/checkout/{restaurant}', [App\Http\Controllers\CustomerOrderController::class, 'checkout'])->name('customer.checkout');
Route::post('/customer-orders', [App\Http\Controllers\CustomerOrderController::class, 'store'])->name('customer.orders.store');
Route::get('/order-success/{order}', [App\Http\Controllers\CustomerOrderController::class, 'success'])->name('order.success');

Route::get('/api/products/recent', [App\Http\Controllers\ProductController::class, 'recent'])->name('api.products.recent');

// API route for restaurants
Route::get('/api/restaurants', function () {
    $restaurants = \App\Models\Restaurant::where('is_active', true)
        ->with(['products' => function($query) {
            $query->where('is_available', true)->take(6);
        }])
        ->get()
        ->map(function($restaurant) {
            return [
                'id' => $restaurant->id,
                'name' => $restaurant->name,
                'description' => $restaurant->description,
                'logo' => $restaurant->logo ? asset(ltrim($restaurant->logo, '/')) : asset('images/default-restaurant-logo.png'),
                'logo_url' => $restaurant->logo ? asset(ltrim($restaurant->logo, '/')) : asset('images/default-restaurant-logo.png'),
                'cover_image' => $restaurant->cover_image ? asset(ltrim($restaurant->cover_image, '/')) : asset('images/default-restaurant-cover.png'),
                'cover_image_url' => $restaurant->cover_image ? asset(ltrim($restaurant->cover_image, '/')) : asset('images/default-restaurant-cover.png'),
                'address' => $restaurant->address,
                'phone' => $restaurant->phone,
                'rating' => $restaurant->rating,
                'delivery_time' => $restaurant->delivery_time,
                'delivery_fee' => $restaurant->delivery_fee,
                'minimum_order' => $restaurant->minimum_order,
                'products' => $restaurant->products->map(function($product) {
                    return [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'price' => $product->price,
                        'image' => $product->image ? asset(ltrim($product->image, '/')) : asset('images/default-product.png'),
                        'is_featured' => $product->is_featured,
                        'restaurant' => [
                            'id' => $product->restaurant_id,
                            'name' => $product->restaurant->name ?? '',
                        ]
                    ];
                })
            ];
        });

    return response()->json(['restaurants' => $restaurants]);
});

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{productId}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{productId}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

// Order routes (require authentication)
Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    Route::get('/dashboard/restaurants', function () {
        return Inertia::render('Admin/Restaurants');
    })->name('dashboard.restaurants');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});

