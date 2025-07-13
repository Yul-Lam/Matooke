<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventoryReportController extends Controller
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
        //
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

    public function currentStock()
    {
        // Get current stock by location and coffee grade
        $stockByLocation = DB::table('inventory_transactions')
            ->select(
                'to_location_id',
                'inventory_locations.name as location_name',
                'coffee_grades.name as coffee_grade',
                DB::raw('SUM(
                    CASE 
                        WHEN transaction_type = "intake" THEN quantity_kg
                        WHEN transaction_type = "roasting" AND to_location_id IS NOT NULL THEN quantity_kg
                        ELSE -quantity_kg
                    END
                ) as current_stock')
            )
            ->leftJoin('inventory_locations', 'inventory_transactions.to_location_id', '=', 'inventory_locations.id')
            ->leftJoin('harvest_batches', 'inventory_transactions.harvest_batch_id', '=', 'harvest_batches.id')
            ->leftJoin('coffee_grades', 'harvest_batches.coffee_grade_id', '=', 'coffee_grades.id')
            ->groupBy('to_location_id', 'coffee_grades.name', 'inventory_locations.name')
            ->having('current_stock', '>', 0)
            ->get();

        return view('coffee-inventory.reports.current-stock', compact('stockByLocation'));
    }

    public function shrinkage()
    {
        $shrinkageData = Roast::select(
                'harvest_batches.id as batch_id',
                'farms.name as farm_name',
                'coffee_grades.name as coffee_grade',
                DB::raw('AVG(shrinkage_percentage) as avg_shrinkage'),
                DB::raw('COUNT(roasts.id) as roast_count')
            )
            ->join('harvest_batches', 'roasts.harvest_batch_id', '=', 'harvest_batches.id')
            ->join('farms', 'harvest_batches.farm_id', '=', 'farms.id')
            ->join('coffee_grades', 'harvest_batches.coffee_grade_id', '=', 'coffee_grades.id')
            ->groupBy('harvest_batches.id', 'farms.name', 'coffee_grades.name')
            ->get();

        return view('coffee-inventory.reports.shrinkage', compact('shrinkageData'));
    }
}

