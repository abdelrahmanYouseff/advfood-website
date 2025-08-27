<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['restaurant', 'category'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Add image_url to each product
        $products->each(function ($product) {
            $product->image_url = $product->image ? asset('storage/' . $product->image) : null;
        });

        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'success' => session('success'),
            'error' => session('error')
        ]);
    }

    public function create()
    {
        $restaurants = Restaurant::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();

        return Inertia::render('Admin/Products/Create', [
            'restaurants' => $restaurants,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم إنشاء المنتج بنجاح!');
    }

    public function edit(Product $product)
    {
        $restaurants = Restaurant::where('is_active', true)->get();
        $categories = Category::where('is_active', true)->get();

        // Load product with relationships and convert to array
        $productData = $product->load(['restaurant', 'category'])->toArray();
        $productData['image_url'] = $product->image ? asset('storage/' . $product->image) : null;

        return Inertia::render('Admin/Products/Edit', [
            'product' => $productData,
            'restaurants' => $restaurants,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products/images', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    public function destroy(Product $product)
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح!');
    }
}

