<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::withCount('products')
            ->orderBy('created_at', 'desc')
            ->get();

        // Debug: Add logo_url and cover_image_url to each restaurant
        $restaurants->each(function ($restaurant) {
            $restaurant->logo_url = $restaurant->logo ? asset('storage/' . $restaurant->logo) : null;
            $restaurant->cover_image_url = $restaurant->cover_image ? asset('storage/' . $restaurant->cover_image) : null;
        });

        return Inertia::render('Admin/Restaurants/Index', [
            'restaurants' => $restaurants,
            'success' => session('success'),
            'error' => session('error')
        ]);
    }

    public function create()
    {
        return Inertia::render('Admin/Restaurants/Create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:restaurants,email',
            'working_hours' => 'nullable|string',
            'delivery_time' => 'required|integer|min:1',
            'delivery_fee' => 'required|numeric|min:0',
            'minimum_order' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 0;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('restaurants/logos', 'public');
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('restaurants/covers', 'public');
        }

        Restaurant::create($validated);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant created successfully!');
    }

    public function edit(Restaurant $restaurant)
    {
        return Inertia::render('Admin/Restaurants/Edit', [
            'restaurant' => $restaurant
        ]);
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|unique:restaurants,email,' . $restaurant->id,
            'working_hours' => 'nullable|string',
            'delivery_time' => 'required|integer|min:1',
            'delivery_fee' => 'required|numeric|min:0',
            'minimum_order' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'is_active' => 'boolean',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Set default values
        $validated['is_active'] = $request->has('is_active');
        $validated['rating'] = $validated['rating'] ?? 0;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($restaurant->logo) {
                Storage::disk('public')->delete($restaurant->logo);
            }
            $validated['logo'] = $request->file('logo')->store('restaurants/logos', 'public');
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            // Delete old cover image if exists
            if ($restaurant->cover_image) {
                Storage::disk('public')->delete($restaurant->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('restaurants/covers', 'public');
        }

        $restaurant->update($validated);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restaurant updated successfully!');
    }

    public function destroy(Restaurant $restaurant)
    {
        try {
            $restaurantName = $restaurant->name;
            $productsCount = $restaurant->products()->count();

            // Delete the restaurant (products will be deleted automatically due to cascade)
            $restaurant->delete();

            $message = "Restaurant '{$restaurantName}' deleted successfully!";
            if ($productsCount > 0) {
                $message .= " ({$productsCount} products were also deleted)";
            }

            return redirect()->route('admin.restaurants.index')
                ->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->route('admin.restaurants.index')
                ->with('error', 'Error deleting restaurant: ' . $e->getMessage());
        }
    }
}
