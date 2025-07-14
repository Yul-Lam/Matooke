<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RetailerProduct;
use Illuminate\Support\Facades\Auth;

class RetailerProductController extends Controller
{
    public function index()
    {
        $products = RetailerProduct::where('retailer_id', Auth::id())->get();
        return view('retailer.products.index', compact('products'));
    }

    public function create()
    {
        return view('retailer.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'nullable|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'description' => 'nullable|string',
        ]);

        RetailerProduct::create([
            'retailer_id' => Auth::id(),
            'name' => $request->name,
            'grade' => $request->grade,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);
        return redirect()->route('retailer.products')->with('success', 'Product uploaded!');

    }
}
