<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WholesalerProduct;
use App\Models\WholesalerOrder;
use App\Models\WholesalerOrderItem;
use Barryvdh\DomPDF\Facade\Pdf; // make sure you have barryvdh/laravel-dompdf installed


class RetailerWholesalerOrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('wholesaler_cart', []);
        if (empty($cart)) {
            return redirect()->route('retailer.wholesaler.products')->with('error', 'Cart is empty.');
        }

        return view('retailer.wholesaler_checkout', compact('cart'));
    }

    public function store(Request $request)
{
    $cart = session()->get('wholesaler_cart', []);

    if (empty($cart)) {
        return redirect()->route('retailer.wholesaler.products')->with('error', 'Cart is empty.');
    }

    $request->validate([
        'delivery_address' => 'required|string|max:255',
    ]);

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    $order = WholesalerOrder::create([
        'retailer_id' => Auth::id(),
        'status' => 'pending',
        'total' => $total,
        'delivery_address' => $request->delivery_address
    ]);

    foreach ($cart as $productId => $item) {
        // Create the order item
        WholesalerOrderItem::create([
            'wholesaler_order_id' => $order->id,
            'wholesaler_product_id' => $productId,
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ]);

        // 🔽 Deduct stock from wholesaler product
        $product = \App\Models\WholesalerProduct::find($productId);
        if ($product) {
            $product->quantity -= $item['quantity'];
            $product->save();
        }
    }

    session()->forget('wholesaler_cart');

    return redirect()->route('retailer.wholesaler.orders')->with('success', 'Order placed successfully!');
}

    public function index()
    {
        $orders = WholesalerOrder::where('retailer_id', Auth::id())->with('items.product')->latest()->get();

        return view('retailer.wholesaler_orders', compact('orders'));

    }

    public function generateInvoice($orderId)
{
    $order = WholesalerOrder::with(['items.product', 'retailer'])->findOrFail($orderId);

    if ($order->retailer_id !== auth()->id()) {
        abort(403, 'Unauthorized access to invoice.');
    }

    $pdf = Pdf::loadView('invoices.retailer-wholesaler', compact('order'));
    return $pdf->download('invoice_order_'.$order->id.'.pdf');
}

}
