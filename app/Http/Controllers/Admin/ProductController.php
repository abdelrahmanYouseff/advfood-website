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
            if ($product->image) {
                if (str_starts_with($product->image, 'http')) {
                    $product->image_url = $product->image;
                } elseif (str_starts_with($product->image, 'menu/')) {
                    $product->image_url = url($product->image);
                } else {
                    $product->image_url = url('storage/' . $product->image);
                }
            } else {
                $product->image_url = null;
            }
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
            'name_ar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'nullable|string',
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
        $productData['image_url'] = $product->image
            ? (str_starts_with($product->image, 'http') ? $product->image : (str_starts_with($product->image, 'menu/') ? url($product->image) : url('storage/' . $product->image)))
            : null;

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
            'name_ar' => 'nullable|string|max:255',
            'description' => 'required|string',
            'description_ar' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_available' => 'boolean',
            'is_featured' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists (only for storage paths)
            if ($product->image && str_starts_with($product->image, 'products/')) {
                Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products/images', 'public');
            $validated['image'] = $imagePath;
        } else {
            // احتفظ بالصورة الحالية - لا تغيير
            unset($validated['image']);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'تم تحديث المنتج بنجاح!');
    }

    public function destroy(Product $product)
    {
        // Delete image from storage only if it was uploaded (products/ path)
        if ($product->image && str_starts_with($product->image, 'products/')) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'تم حذف المنتج بنجاح!');
    }
}

