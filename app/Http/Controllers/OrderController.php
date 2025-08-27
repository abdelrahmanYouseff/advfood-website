<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['restaurant', 'items'])
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('Orders/Index', [
            'orders' => $orders
        ]);
    }

    public function show(Order $order)
    {
        $order->load(['restaurant', 'items.product']);

        return Inertia::render('Orders/Show', [
            'order' => $order
        ]);
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        $cartItems = [];
        $total = 0;
        $restaurantId = null;

        foreach ($cart as $productId => $item) {
            $product = Product::with('restaurant')->find($productId);
            if ($product) {
                if ($restaurantId && $restaurantId !== $product->restaurant_id) {
                    return redirect()->route('cart.index')->with('error', 'لا يمكن طلب من مطاعم مختلفة في نفس الطلب');
                }

                $restaurantId = $product->restaurant_id;
                $item['product'] = $product;
                $item['subtotal'] = $product->price * $item['quantity'];
                $cartItems[] = $item;
                $total += $item['subtotal'];
            }
        }

        $restaurant = \App\Models\Restaurant::find($restaurantId);

        return Inertia::render('Orders/Checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'restaurant' => $restaurant
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_name' => 'required|string|max:255',
            'delivery_phone' => 'required|string|max:20',
            'delivery_address' => 'required|string',
            'notes' => 'nullable|string'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'السلة فارغة');
        }

        $cartItems = [];
        $subtotal = 0;
        $restaurantId = null;

        foreach ($cart as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                if ($restaurantId && $restaurantId !== $product->restaurant_id) {
                    return redirect()->route('cart.index')->with('error', 'لا يمكن طلب من مطاعم مختلفة في نفس الطلب');
                }

                $restaurantId = $product->restaurant_id;
                $itemSubtotal = $product->price * $item['quantity'];
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal,
                    'options' => $item['options'] ?? [],
                    'notes' => $item['notes'] ?? ''
                ];
                $subtotal += $itemSubtotal;
            }
        }

        $restaurant = \App\Models\Restaurant::find($restaurantId);
        $deliveryFee = $restaurant->delivery_fee;
        $tax = $subtotal * 0.14; // 14% tax
        $total = $subtotal + $deliveryFee + $tax;

        $order = Order::create([
            'user_id' => auth()->id(),
            'restaurant_id' => $restaurantId,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'tax' => $tax,
            'total' => $total,
            'notes' => $request->notes,
            'delivery_address' => $request->delivery_address,
            'delivery_phone' => $request->delivery_phone,
            'delivery_name' => $request->delivery_name,
            'estimated_delivery_time' => now()->addMinutes($restaurant->delivery_time)
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'product_name' => $item['product']->name,
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total' => $item['subtotal'],
                'options' => $item['options'],
                'notes' => $item['notes']
            ]);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order)
            ->with('success', 'تم إنشاء الطلب بنجاح');
    }
}

