<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $item) {
            $product = Product::with('restaurant')->find($productId);
            if ($product) {
                // إعداد البيانات الإضافية للمنتج
                $productData = $product->toArray();
                $productData['image_url'] = $product->image_url;
                $productData['formatted_price'] = $product->formatted_price;

                // إعداد بيانات المطعمa
                if ($product->restaurant) {
                    $restaurantData = $product->restaurant->toArray();
                    $restaurantData['logo_url'] = $product->restaurant->logo_url;
                    $restaurantData['cover_image_url'] = $product->restaurant->cover_image_url;
                    $productData['restaurant'] = $restaurantData;
                }

                $item['product'] = $productData;
                $item['subtotal'] = (float) $product->price * (int) $item['quantity'];
                $cartItems[] = $item;
                $total += $item['subtotal'];
            }
        }

        return Inertia::render('Cart/Index', [
            'cartItems' => $cartItems,
            'total' => (float) $total
        ]);
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'options' => 'nullable|array',
            'notes' => 'nullable|string'
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_available) {
            return back()->with('error', 'المنتج غير متاح حالياً');
        }

        $cart = session()->get('cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $request->quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $request->quantity,
                'options' => $request->options ?? [],
                'notes' => $request->notes ?? ''
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'تم إضافة المنتج إلى السلة');
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم تحديث الكمية');
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'تم إزالة المنتج من السلة');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'تم تفريغ السلة');
    }
}

