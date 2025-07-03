<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Supplier;
use App\Models\Coffee;
use Illuminate\Http\Request;

class SupplyController extends Controller
{
    
    public function index()
    {
         $supplies = \App\Models\Supply::all();
    return view('supplies.index', compact('supplies'));

        
    }
    public function create()
    {
        $suppliers = \App\Models\Supplier::all();
        $coffees = \App\Models\Coffee::all();

        return view('supplies.create',
        compact('suppliers', 'coffees'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'supplier_id' => 'required|exists:suppliers,id',
        'coffee_id' => 'required|exists:coffees,id',
        'quantity' => 'required|numeric',
        'supplied_on' => 'required|date'
    ]);

    \App\Models\Supply::create($request->all());

    return redirect()->route('supplies.index')->with('success', 'Supply added successfully!');
}
    }

