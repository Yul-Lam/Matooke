<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use PDF;


class OrderController extends Controller
{
    public function generateInvoice(Order $order)
    {
        
        //optional: restrict access to <owner

        if (Auth::id() !== $order->user_id) {
            abort(403, 'Unauthorized access to invoice');
        }
    
        $order->load('items.product');
    
        $pdf = \PDF::loadView('orders.invoice', compact('order'));
        return $pdf->download("Invoice-Order-{$order->id}.pdf");
    

    }
    public function create()
    {
       $cart = session()->get('cart', []);
       if (empty($cart)){
        return redirect()->route('retailer.cart')->with('error', 'Your cart is empty.');
       }
       return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => 'required|string',
        ]);
    
        // ✅ LOAD CART
        $cart = session()->get('cart', []);
    
        if (empty($cart)) {
            return redirect()->route('retailer.cart')->with('error', 'Your cart is empty.');
        }
    
        $total = 0;
    
        // ✅ Calculate total from cart
        foreach ($cart as $id => $item) {
            $product = Product::findOrFail($id);
            $qty = $item['quantity'];
    
            if ($qty > 0) {
                if ($product->quantity < $qty) {
                    return back()->with('error', "Not enough stock for {$product->name}");
                }
                $total += $product->price * $qty;
            }
        }
    
        // ✅ Create the order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
            'total' => $total,
            'delivery_address' => $request->delivery_address
        ]);
    
        // ✅ Create order items
        foreach ($cart as $id => $item) {
            $qty = $item['quantity'];
            if ($qty > 0) {
                $product = Product::findOrFail($id);
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'price' => $product->price
                ]);
                $product->decrement('quantity', $qty);
            }
        }
    
        // ✅ Clear the cart
        session()->forget('cart');
    
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }
    public function index(){
        $orders = Order::with('items.product')->where('user_id', Auth::id())
        ->latest()
        ->get();
        return view('orders.index', compact('orders'));
    }
    
}
