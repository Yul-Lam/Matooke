<?php

namespace App\Http\Controllers\Wholesaler;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\WholesalerOrder;

class WholesalerOrderController extends Controller
{
    public function index()
{
    $wholesalerId = Auth::id();

    $orders = \App\Models\WholesalerOrderItem::with(['order.retailer', 'product'])
        ->whereHas('product', function ($query) use ($wholesalerId) {
            $query->where('wholesaler_id', $wholesalerId);
        })
        ->get()
        ->groupBy('wholesaler_order_id'); // 🔥 this is very important!

    return view('wholesaler.orders.index', compact('orders'));
}

    public function updateStatus(Request $request, WholesalerOrder $order)
    {
        $request->validate([
            'status' => 'required|in:processing,shipped,delivered',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->back()->with('success', 'Order status updated.');



    }

}
