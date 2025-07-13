<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoastController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
        'harvest_batch_id' => 'required|exists:harvest_batches,id',
        'roast_date' => 'required|date',
        'roast_level' => 'required|in:light,medium,dark',
        'input_quantity_kg' => 'required|numeric|min:0.1',
        'output_quantity_kg' => 'required|numeric|min:0.01',
        'flavor_notes' => 'nullable|string',
    ]);

    // Calculate shrinkage
    $shrinkage = (($validated['input_quantity_kg'] - $validated['output_quantity_kg']) / $validated['input_quantity_kg']) * 100;
    $validated['shrinkage_percentage'] = round($shrinkage, 2);

    $roast = Roast::create($validated);

    // Create inventory transactions
    // Remove from green coffee inventory
    InventoryTransaction::create([
        'harvest_batch_id' => $roast->harvest_batch_id,
        'from_location_id' => InventoryLocation::where('type', 'storage')->first()->id,
        'quantity_kg' => $roast->input_quantity_kg,
        'transaction_type' => 'roasting',
        'notes' => 'Roasting process input',
    ]);

    // Add to roasted coffee inventory
    InventoryTransaction::create([
        'harvest_batch_id' => $roast->harvest_batch_id,
        'to_location_id' => InventoryLocation::where('type', 'roasting')->first()->id,
        'quantity_kg' => $roast->output_quantity_kg,
        'transaction_type' => 'roasting',
        'notes' => 'Roasting process output - '.$roast->roast_level.' roast',
    ]);

    return redirect()->route('roasts.show', $roast->id)
        ->with('success', 'Roast recorded successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
