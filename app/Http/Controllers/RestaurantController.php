<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::where('is_active', true)
            ->with(['products' => function ($query) {
                $query->where('is_available', true);
            }])
            ->orderBy('rating', 'desc')
            ->get();

        // Add image URLs to each restaurant
        $restaurants->each(function ($restaurant) {
            // Check if logo path starts with 'restaurants/' (uploaded via storage) or other paths (public/)
            if ($restaurant->logo) {
                $restaurant->logo_url = str_starts_with($restaurant->logo, 'restaurants/')
                    ? asset('storage/' . $restaurant->logo)
                    : asset($restaurant->logo);
            } else {
                $restaurant->logo_url = asset('images/default-restaurant-logo.png');
            }

            // Check if cover_image path starts with 'restaurants/' (uploaded via storage) or other paths (public/)
            if ($restaurant->cover_image) {
                $restaurant->cover_image_url = str_starts_with($restaurant->cover_image, 'restaurants/')
                    ? asset('storage/' . $restaurant->cover_image)
                    : asset($restaurant->cover_image);
            } else {
                $restaurant->cover_image_url = asset('images/default-restaurant-cover.png');
            }
        });

        // Check if request is for API (JSON)
        if (request()->wantsJson() || request()->is('api/*')) {
            return response()->json([
                'restaurants' => $restaurants
            ]);
        }

        return Inertia::render('Restaurants/Index', [
            'restaurants' => $restaurants
        ]);
    }

    public function show(Restaurant $restaurant)
    {
        // Load restaurant with products and categories
        $restaurant->load(['products' => function ($query) {
            $query->where('is_available', true)
                  ->with('category')
                  ->orderBy('sort_order');
        }]);

        // Get all categories that have products in this restaurant
        $categories = Category::where('is_active', true)
            ->whereHas('products', function ($query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->id)
                      ->where('is_available', true);
            })
            ->with(['products' => function ($query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->id)
                      ->where('is_available', true)
                      ->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        // Add accessor methods to categories
        $categories->each(function ($category) {
            $category->image_url = $category->image ? asset('storage/' . $category->image) : asset('images/default-category.png');
        });

        // Get all products for this restaurant
        $products = $restaurant->products()->with('category')->get();

        // Add accessor methods to products
        $products->each(function ($product) {
            // Check if product image path starts with 'products/' (uploaded via storage) or other paths (public/)
            if ($product->image) {
                $product->image_url = str_starts_with($product->image, 'products/')
                    ? asset('storage/' . $product->image)
                    : asset($product->image);
            } else {
                $product->image_url = asset('images/default-product.png');
            }
            $product->formatted_price = number_format($product->price, 2) . ' ريال';
        });

        // Add logo_url and cover_image_url to restaurant
        $restaurantData = $restaurant->toArray();

        // Check if logo path starts with 'restaurants/' (uploaded via storage) or other paths (public/)
        if ($restaurant->logo) {
            $restaurantData['logo_url'] = str_starts_with($restaurant->logo, 'restaurants/')
                ? asset('storage/' . $restaurant->logo)
                : asset($restaurant->logo);
        } else {
            $restaurantData['logo_url'] = asset('images/default-restaurant-logo.png');
        }

        // Check if cover_image path starts with 'restaurants/' (uploaded via storage) or other paths (public/)
        if ($restaurant->cover_image) {
            if (str_starts_with($restaurant->cover_image, 'http://') || str_starts_with($restaurant->cover_image, 'https://')) {
                $restaurantData['cover_image_url'] = $restaurant->cover_image;
            } elseif (str_starts_with($restaurant->cover_image, 'restaurants/')) {
                $restaurantData['cover_image_url'] = url('storage/' . $restaurant->cover_image);
            } else {
                $restaurantData['cover_image_url'] = url(ltrim($restaurant->cover_image, '/'));
            }
        } else {
            $restaurantData['cover_image_url'] = url('images/default-restaurant-cover.png');
        }

        return Inertia::render('Restaurants/Show', [
            'restaurant' => $restaurantData,
            'categories' => $categories,
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        try {
            \Log::info('Restaurant store request received', $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'address' => 'required|string|max:500',
                'phone' => 'required|string|max:50',
                'email' => 'nullable|email|max:255',
                'working_hours' => 'nullable|string|max:500',
                'delivery_time' => 'required|integer|min:1',
                'delivery_fee' => 'required|numeric|min:0',
                'minimum_order' => 'required|numeric|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'is_active' => 'boolean'
            ]);

            \Log::info('Validation passed', $validated);

            $restaurantData = $validated;

            // Handle logo upload (separate validation)
            if ($request->hasFile('logo')) {
                $request->validate(['logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $logoPath = $request->file('logo')->store('restaurants/logos', 'public');
                $restaurantData['logo'] = $logoPath;
                \Log::info('Logo uploaded to: ' . $logoPath);
            }

            // Handle cover image upload (separate validation)
            if ($request->hasFile('cover_image')) {
                $request->validate(['cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $coverPath = $request->file('cover_image')->store('restaurants/covers', 'public');
                $restaurantData['cover_image'] = $coverPath;
                \Log::info('Cover image uploaded to: ' . $coverPath);
            }

            $restaurant = Restaurant::create($restaurantData);
            \Log::info('Restaurant created successfully', $restaurant->toArray());

            return response()->json([
                'message' => 'تم إضافة المطعم بنجاح',
                'restaurant' => $restaurant
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating restaurant: ' . $e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ في إضافة المطعم: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        try {
            \Log::info('Restaurant update request received', $request->all());

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:2000',
                'address' => 'required|string|max:500',
                'phone' => 'required|string|max:50',
                'email' => 'nullable|email|max:255',
                'working_hours' => 'nullable|string|max:500',
                'delivery_time' => 'required|integer|min:1',
                'delivery_fee' => 'required|numeric|min:0',
                'minimum_order' => 'required|numeric|min:0',
                'rating' => 'nullable|numeric|min:0|max:5',
                'is_active' => 'boolean'
            ]);

            \Log::info('Validation passed', $validated);

            $restaurantData = $validated;

            // Handle logo upload (separate validation)
            if ($request->hasFile('logo')) {
                $request->validate(['logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $logoPath = $request->file('logo')->store('restaurants/logos', 'public');
                $restaurantData['logo'] = $logoPath;
                \Log::info('Logo uploaded to: ' . $logoPath);
            }

            // Handle cover image upload (separate validation)
            if ($request->hasFile('cover_image')) {
                $request->validate(['cover_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);
                $coverPath = $request->file('cover_image')->store('restaurants/covers', 'public');
                $restaurantData['cover_image'] = $coverPath;
                \Log::info('Cover image uploaded to: ' . $coverPath);
            }

            $restaurant->update($restaurantData);
            \Log::info('Restaurant updated successfully', $restaurant->toArray());

            return response()->json([
                'message' => 'تم تحديث المطعم بنجاح',
                'restaurant' => $restaurant
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error updating restaurant: ' . $e->getMessage());
            return response()->json([
                'message' => 'حدث خطأ في تحديث المطعم: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();

        return response()->json([
            'message' => 'تم حذف المطعم بنجاح'
        ]);
    }
}
