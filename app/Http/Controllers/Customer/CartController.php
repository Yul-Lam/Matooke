<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerProduct; // <-- Use RetailerProduct, not Product

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('customer_cart', []);
        return view('customer.cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $product = RetailerProduct::findOrFail($productId); // <-- Correct model

        $cart = session()->get('customer_cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += 1;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('customer_cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function remove($id)
    {
        $cart = session()->get('customer_cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('customer_cart', $cart);
        }

        return redirect()->back()->with('success', 'Item removed.');
    }

    public function clear()
    {
        session()->forget('customer_cart');
        return redirect()->back()->with('success', 'Cart cleared.');

    }
}
