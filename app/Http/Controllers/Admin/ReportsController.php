<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\WholesalerOrder;

class ReportsController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count() + WholesalerOrder::count();

        $deliveredOrders = Order::where('status', 'delivered')->count()
            + WholesalerOrder::where('status', 'delivered')->count();
    
        $shippedOrders = Order::where('status', 'shipped')->count()
            + WholesalerOrder::where('status', 'shipped')->count();
    
        $pendingOrders = Order::where('status', 'pending')->count()
            + WholesalerOrder::where('status', 'pending')->count();

            $totalRevenue = Order::sum('total') + WholesalerOrder::sum('total');

            return view('admin.reports.index', compact(
                'totalOrders',
                'deliveredOrders',
                'shippedOrders',
                'pendingOrders',
                'totalRevenue'
            ));
                
        
    
    }
    
       
}