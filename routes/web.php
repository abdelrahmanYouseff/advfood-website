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

Route::get('/gather-us/the-chefz', function () {
    return Inertia::render('GatherUs/TheChefz');
})->name('gather-us.the-chefz');

Route::get('/gatherus-jahez', function () {
    return Inertia::render('GatherUs/TheChefz', [
        'logo' => '/images/gatherus-logo.png',
        'bgColor' => '#ffffff',
        'linkUrl' => 'https://jahez.link/A7T4Ol0FB1b',
        'appImage' => '/images/jahez-logo.png',
        'appImageAlt' => 'جاهز',
    ]);
})->name('gatherus.jahez');

Route::get('/bakiza/gahez', function () {
    return Inertia::render('GatherUs/TheChefz', [
        'logo' => '/rest/bakiza-logo.png',
        'linkUrl' => 'https://jahez.link/A7T4Ol0FB1b',
        'appImage' => '/images/jahez-logo.png',
        'appImageAlt' => 'جاهز',
    ]);
})->name('bakiza.gahez');

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

// Menu images serving route (supports subdirectories like menu/delawa/new/filename.jpg)
Route::get('/menu/{path}', function ($path) {
    $filePath = public_path('menu/' . $path);

    if (!file_exists($filePath)) {
        abort(404, 'Menu image not found');
    }

    return response()->file($filePath);
})->where('path', '.*');

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

// تشخيص رفع الملفات - احذف هذا المسار بعد حل المشكلة
Route::get('/upload-check', function () {
    $storagePath = storage_path('app/public');
    $storageWritable = is_writable($storagePath);
    $productsDir = $storagePath . '/products/images';
    $restaurantsDir = $storagePath . '/restaurants/covers';

    return response()->json([
        'upload_max_filesize' => ini_get('upload_max_filesize'),
        'post_max_size' => ini_get('post_max_size'),
        'storage_writable' => $storageWritable,
        'storage_path' => $storagePath,
        'products_dir_exists' => is_dir($productsDir),
        'products_dir_writable' => is_dir($productsDir) ? is_writable($productsDir) : false,
        'app_url' => config('app.url'),
        'fix' => !$storageWritable ? 'chmod -R 775 storage && chown -R forge:forge storage' : null,
        'php_upload_limit_note' => ini_get('upload_max_filesize') === '2M' ? 'قد يكون 2M صغير جداً - زوّد upload_max_filesize إلى 10M' : null,
    ]);
});

// Restaurant routesss
Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])->name('restaurants.show');

// Customer Order routes (no authentication required)
Route::get('/checkout/{restaurant}', [App\Http\Controllers\CustomerOrderController::class, 'checkout'])->name('customer.checkout');
Route::post('/checkout/{restaurant}/process', [App\Http\Controllers\CustomerOrderController::class, 'processCheckout'])->name('customer.checkout.process');
Route::get('/order-success/{order}', [App\Http\Controllers\CustomerOrderController::class, 'success'])->name('order.success');
Route::get('/payment-callback/{order}', [App\Http\Controllers\CustomerOrderController::class, 'paymentCallback'])->name('payment.callback');
Route::get('/payment-failed/{order}', [App\Http\Controllers\CustomerOrderController::class, 'paymentFailed'])->name('payment.failed');

Route::get('/api/products/recent', [App\Http\Controllers\ProductController::class, 'recent'])->name('api.products.recent');

// API منتجات مطعم ديلاوة: اسم، سعر، صورة فقط
Route::get('/api/delawa/products', function () {
    $restaurant = \App\Models\Restaurant::where('name', 'Delawa')->where('is_active', true)->first();
    if (!$restaurant) {
        return response()->json(['products' => [], 'message' => 'Restaurant not found'], 404);
    }
    $products = \App\Models\Product::where('restaurant_id', $restaurant->id)
        ->where('is_available', true)
        ->orderBy('sort_order')
        ->get()
        ->map(function ($product) {
            $imageUrl = $product->image
                ? (str_starts_with($product->image, 'menu/') ? url($product->image) : url('storage/' . $product->image))
                : url('images/default-product.png');
            return [
                'id' => $product->id,
                'name' => $product->name,
                'price' => (float) $product->price,
                'image' => $imageUrl,
            ];
        });
    return response()->json(['products' => $products]);
})->name('api.delawa.products');

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

