<?php

namespace App\Http\Controllers\Wholesaler;

use Illuminate\Http\Request;
use App\Models\WholesalerProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Wholesaler\WholesalerProductController;

class WholesalerProductController extends Controller
{
    public function index()
    {
        $products = WholesalerProduct::where('wholesaler_id', Auth::id())->get();
        return view('wholesaler.products.index', compact('products'));
    }

    public function create()
    {
        return view('wholesaler.products.create');
    }

    
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'grade' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0'
    ]);
    WholesalerProduct::create([
        'name' => $request->name,
        'grade' => $request->grade,
        'quantity' => $request->quantity,
        'price' => $request->price,
        'wholesaler_id' => Auth::id()
    ]);
    return redirect()->route('wholesaler.products.index')->with('success', 'Product uploaded successfully.');

}


}
