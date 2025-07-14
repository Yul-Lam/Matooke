<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $totalCustomers = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
       
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'shippedOrders',
            'deliveredOrders',
            'totalCustomers',
            'totalProducts'

        ));
           
    }
}
