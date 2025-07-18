<?php

namespace App\Http\Controllers;

use App\Models\Supply;
use App\Models\Supplier;
use App\Models\Coffee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SupplyController extends Controller
{
    /**
     * Display a listing of supplies.
     */
    public function index()
    {
        $supplies = Supply::all();
        return view('supplies.index', compact('supplies'));
    }

    /**
     * Show the form for creating a new supply.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $coffees = Coffee::all();

        return view('supplies.create', compact('suppliers', 'coffees'));
    }

    /**
     * Store a newly created supply in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'coffee_id'   => 'required|exists:coffees,id',
            'quantity'    => 'required|numeric',
            'supply_date' => 'required|date',
        ]);

        Supply::create($request->all());

        return redirect()
            ->route('supplies.index')
            ->with('success', 'Supply added successfully!');
    }

    /**
     * Show the form for editing the specified supply.
     */
    public function edit($id)
    {
        $supply = Supply::findOrFail($id);
        $supply->supply_date = Carbon::parse($supply->supply_date);

        $suppliers = Supplier::all();
        $coffees = Coffee::all();

        return view('supplies.edit', compact('supply', 'suppliers', 'coffees'));
    }

    /**
     * Update the specified supply in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'coffee_id'   => 'required|exists:coffees,id',
            'quantity'    => 'required|integer|min:1',
            'supply_date' => 'required|date',
        ]);

        $supply = Supply::findOrFail($id);
        $supply->update($request->all());

        return redirect()
            ->route('supplies.index')
            ->with('success', 'Supply updated successfully!');
    }

    /**
     * Remove the specified supply from storage.
     */
    public function destroy($id)
    {
        $supply = Supply::findOrFail($id);
        $supply->delete();

        return redirect()
            ->route('supplies.index')
            ->with('success', 'Supply deleted successfully!');
    }
}
