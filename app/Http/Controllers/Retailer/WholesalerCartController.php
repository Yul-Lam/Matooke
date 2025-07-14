<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WholesalerProduct;

class WholesalerCartController extends Controller
{
    public function index()
    {
        $cart = session()->get('wholesaler_cart', []);
        return view('retailer.wholesaler_cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = WholesalerProduct::findOrFail($request->product_id);

        $cart = session()->get('wholesaler_cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'grade' => $product->grade,
                'price' => $product->price,
                'quantity' => 1
            ];
        }

        session()->put('wholesaler_cart', $cart);

        return redirect()->route('retailer.wholesaler.cart')->with('success', 'Product added to wholesaler cart.');
    }

    public function remove($id)
    {
        $cart = session()->get('wholesaler_cart', []);
        unset($cart[$id]);
        session()->put('wholesaler_cart', $cart);

        return back()->with('success', 'Product removed from wholesaler cart.');
    }

    public function clear()
    {
        session()->forget('wholesaler_cart');
        return back()->with('success', 'Wholesaler cart cleared.');

    }

}
