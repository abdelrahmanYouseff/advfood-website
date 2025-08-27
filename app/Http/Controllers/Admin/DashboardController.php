<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        // Get statistics for admin dashboard
        $stats = [
            'total_orders' => Order::count(),
            'total_products' => Product::count(),
            'total_restaurants' => Restaurant::count(),
            'total_users' => User::count(),
            'recent_orders' => Order::with(['user', 'restaurant'])
                ->latest()
                ->take(5)
                ->get(),
        ];

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats
        ]);
    }
}

