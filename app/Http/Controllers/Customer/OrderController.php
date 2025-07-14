<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PDF;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $cart = session()->get('customer_cart', []);

        if (empty($cart)) {
            return redirect()->route('customer.products')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'delivery_address' => 'required|string|max:255',
        ]);

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
            'delivery_address' => $request->delivery_address
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);

            $product = Product::find($productId);
            if ($product) {
                $product->quantity -= $item['quantity'];
                $product->save();
            }
        }

        session()->forget('customer_cart');

        return redirect()->route('customer.orders.index')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer.orders.index', compact('orders'));
    }

    public function generateInvoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);

    }
    $pdf = PDF::loadView('customer.orders.invoice', compact('order'));
    return $pdf->download("order_invoice_{$order->id}.pdf");


}

   public function create()
   {
    $cart = session()->get('ccustomer_cart', []);

    return view('customer.checkout', compact('cart'));
   }
}

