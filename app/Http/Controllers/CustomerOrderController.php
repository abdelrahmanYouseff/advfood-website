<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerOrderController extends Controller
{
    public function checkout(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);

        return Inertia::render('Checkout', [
            'restaurant' => $restaurant,
            'cartItems' => $request->session()->get('cart', []),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'address' => 'required|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'apartment' => 'nullable|string|max:50',
            'building_number' => 'nullable|string|max:50',
            'landmark' => 'nullable|string|max:255',
            'items' => 'required|array',
            'subtotal' => 'required|numeric|min:0',
            'delivery_fee' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $order = CustomerOrder::create($validated);

        return redirect()->route('order.success', $order->id)
            ->with('success', 'تم إرسال طلبك بنجاح!');
    }

    public function success($orderId)
    {
        $order = CustomerOrder::with('restaurant')->findOrFail($orderId);

        return Inertia::render('OrderSuccess', [
            'order' => $order,
        ]);
    }
}
