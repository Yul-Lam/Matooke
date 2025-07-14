<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('retailer.cart', compact('cart'));
    }

    public function add(Request $request)
{
    $product = Product::findOrFail($request->product_id);

    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        $cart[$product->id]['quantity']++;
    } else {
        $cart[$product->id] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1
        ];
    }

    session()->put('cart', $cart);
    

    return redirect()->route('retailer.cart')->with('success', 'Product added to cart.');
}
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return back()->with('success', 'Product removed from cart.');
    }

    public function clear()
    {
        session()->forget('cart');
        return back()->with('success', 'Cart cleared.');
    }

    // Increase quantity
public function increase($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
        session()->put('cart', $cart);
    }
    return back()->with('success', 'Quantity increased.');
}

// Decrease quantity
public function decrease($id)
{
    $cart = session()->get('cart', []);
    if (isset($cart[$id]) && $cart[$id]['quantity'] > 1) {
        $cart[$id]['quantity']--;
        session()->put('cart', $cart);
    } elseif (isset($cart[$id])) {
        unset($cart[$id]); // remove if quantity is 1
        session()->put('cart', $cart);
    }
    return back()->with('success', 'Quantity decreased.');
}

}
