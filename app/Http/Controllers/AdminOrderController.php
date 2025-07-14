<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,shipped,delivered',
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated.');

    }

    
      

}
