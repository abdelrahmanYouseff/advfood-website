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

        // Debug: Add logo_url and cover_image_url to each restaurant
        $restaurants->each(function ($restaurant) {
            $restaurant->logo_url = $restaurant->logo ? asset('storage/' . $restaurant->logo) : null;
            $restaurant->cover_image_url = $restaurant->cover_image ? asset('storage/' . $restaurant->cover_image) : null;
        });

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
            $product->image_url = $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png');
            $product->formatted_price = number_format($product->price, 2) . ' ريال';
        });

        // Debug: Add logo_url and cover_image_url to restaurant
        $restaurantData = $restaurant->toArray();
        $restaurantData['logo_url'] = $restaurant->logo ? asset('storage/' . $restaurant->logo) : null;
        $restaurantData['cover_image_url'] = $restaurant->cover_image ? asset('storage/' . $restaurant->cover_image) : null;

        return Inertia::render('Restaurants/Show', [
            'restaurant' => $restaurantData,
            'categories' => $categories,
            'products' => $products
        ]);
    }
}
