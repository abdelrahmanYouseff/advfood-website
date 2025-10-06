<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function recent()
    {
        $products = Product::with(['restaurant', 'category'])
            ->where('is_available', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        // Add image_url and formatted_price to each product
        $products->each(function ($product) {
            $product->image_url = $product->image ? asset('storage/' . $product->image) : asset('images/default-product.png');
            $product->formatted_price = number_format($product->price, 2) . ' ريال';
        });

        return response()->json([
            'products' => $products
        ]);
    }
}
