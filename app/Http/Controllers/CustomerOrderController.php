<?php

namespace App\Http\Controllers;

use App\Models\CustomerOrder;
use App\Models\Restaurant;
use App\Services\NoonPaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;

class CustomerOrderController extends Controller
{
    protected $noonPayment;

    public function __construct(NoonPaymentService $noonPayment)
    {
        $this->noonPayment = $noonPayment;
    }

    public function checkout(Request $request, $restaurantId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);

        return Inertia::render('Checkout', [
            'restaurant' => $restaurant,
            'cartItems' => $request->session()->get('cart', []),
        ]);
    }


    public function processCheckout(Request $request, $restaurantId)
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

        // Create order first with pending payment status
        $validated['order_number'] = 'ORD-' . strtoupper(Str::random(8));
        $validated['payment_status'] = 'pending';

        $order = CustomerOrder::create($validated);

        // Initialize Noon Payment with correct data format
        $paymentData = [
            'order_reference' => 'ORDER-' . $order->id . '-' . now()->timestamp,
            'amount' => $order->total,
            'currency' => 'SAR',
            'name' => 'Order #' . $order->order_number,
            'return_url' => route('payment.callback', ['order' => $order->id]),
        ];

        $paymentResult = $this->noonPayment->initiatePayment($paymentData);

        if (!$paymentResult['success']) {
            $errorMessage = $paymentResult['error'] ?? 'فشل في إنشاء عملية الدفع. الرجاء المحاولة مرة أخرى.';
            Log::error('Payment Initiation Error', ['error' => $errorMessage, 'details' => $paymentResult]);
            return back()->withErrors(['payment' => $errorMessage]);
        }

        // Extract Noon order ID from response
        $noonOrderId = $paymentResult['data']['result']['order']['id'] ??
                       $paymentResult['data']['order']['id'] ?? null;

        // Save Noon order ID and payment data
        $order->update([
            'noon_order_id' => $noonOrderId,
            'payment_data' => json_encode($paymentResult['data']),
        ]);

        // Get the checkout URL from Noon Payment response
        $checkoutUrl = $paymentResult['data']['result']['checkoutData']['postUrl'] ?? null;

        if (!$checkoutUrl) {
            Log::error('Checkout URL not found', ['response' => $paymentResult]);
            return back()->withErrors(['payment' => 'فشل في الحصول على رابط الدفع.']);
        }

        Log::info('Redirecting to Noon payment page', ['url' => $checkoutUrl, 'order_id' => $order->id]);

        // Redirect directly to Noon Payment checkout page
        Log::info('Redirecting to Noon Payment checkout', ['url' => $checkoutUrl]);

        // Return JSON response with redirect URL for JavaScript handling
        return response()->json([
            'success' => true,
            'redirect_url' => $checkoutUrl,
            'message' => 'Redirecting to payment page...'
        ]);
    }

    public function paymentCallback(Request $request, $orderId)
    {
        $order = CustomerOrder::findOrFail($orderId);

        // Verify payment with Noon
        $paymentStatus = $this->noonPayment->verifyCallback($order->noon_order_id);

        if ($paymentStatus['success']) {
            $status = $paymentStatus['data']['result']['order']['status'] ?? null;

            if ($status === 'CAPTURED' || $status === 'AUTHORIZED') {
                $order->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                return redirect()->route('order.success', $order->id)
                    ->with('success', 'تم الدفع بنجاح! سيتم تجهيز طلبك قريباً.');
            }
        }

        // Payment failed
        $order->update([
            'payment_status' => 'failed',
            'status' => 'cancelled',
        ]);

        return redirect()->route('payment.failed', $order->id)
            ->with('error', 'فشلت عملية الدفع. الرجاء المحاولة مرة أخرى.');
    }

    public function success($orderId)
    {
        $order = CustomerOrder::with('restaurant')->findOrFail($orderId);

        return Inertia::render('OrderSuccess', [
            'order' => $order,
        ]);
    }

    public function paymentFailed($orderId)
    {
        $order = CustomerOrder::with('restaurant')->findOrFail($orderId);

        return Inertia::render('PaymentFailed', [
            'order' => $order,
        ]);
    }
}
