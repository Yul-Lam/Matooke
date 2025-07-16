<?php

namespace App\Http\Controllers;

use App\Models\HarvestBatch;
use App\Models\Farm;
use App\Models\CoffeeGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\HarvestBatchesExport;
use App\Models\InventoryLocation;
use App\Models\InventoryTransaction;

class HarvestBatchController extends Controller
{
    /**
     * Export all batches to Excel
     */
    public function export()
    {
        return Excel::download(new HarvestBatchesExport, 'harvest_batches.xlsx');
    }

    /**
     * List harvest batches + filters
     */
    public function index(Request $request)
    {
        $query = HarvestBatch::with(['farm', 'coffeeGrade']);

        if ($request->filled('search')) {
            $query->whereHas('farm', fn($q) => $q->where('name', 'like', "%{$request->search}%"))
                  ->orWhereHas('coffeeGrade', fn($q) => $q->where('name', 'like', "%{$request->search}%"));
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $query->orderBy($request->get('sort', 'id'), $request->get('direction', 'desc'));

        $harvestBatches = $query->paginate(10);

        $stats = [
            'total' => HarvestBatch::count(),
            'in_storage' => HarvestBatch::where('status', 'in_storage')->count(),
            'shipped' => HarvestBatch::where('status', 'shipped')->count(),
            'total_quantity' => HarvestBatch::sum('quantity_kg'),
        ];

        return view('coffee-inventory.index', compact('harvestBatches', 'stats'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $farms = Farm::all();
        $grades = CoffeeGrade::all();

        return view('harvest-batches.create', compact('farms', 'grades'));
    }

    /**
     * Store new batch
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'coffee_grade_id' => 'required|exists:coffee_grades,id',
            'harvest_date' => 'required|date',
            'quantity_kg' => 'required|integer',
            'status' => 'required|string',
            'processing_method' => 'required|string',
        ]);

        $batch = HarvestBatch::create($validated);

        InventoryTransaction::create([
            'harvest_batch_id' => $batch->id,
            'to_location_id' => InventoryLocation::where('type', 'storage')->value('id'),
            'quantity_kg' => $batch->quantity_kg,
            'transaction_type' => 'intake',
            'notes' => 'Initial harvest intake',
        ]);

        return redirect()->route('harvest-batches.show', $batch->id)
                         ->with('success', 'Harvest batch recorded successfully');
    }

    /**
     * Show single batch
     */
    public function show(string $id)
    {
        $batch = HarvestBatch::with(['farm', 'coffeeGrade'])->findOrFail($id);
        return view('harvest-batches.show', compact('batch'));
    }

    /**
     * Show edit form
     */
    public function edit(string $id)
    {
        $batch = HarvestBatch::findOrFail($id);
        $farms = Farm::all();
        $grades = CoffeeGrade::all();

        return view('harvest-batches.edit', compact('batch', 'farms', 'grades'));
    }

    /**
     * Update batch
     */
    public function update(Request $request, string $id)
    {
        $batch = HarvestBatch::findOrFail($id);

        $validated = $request->validate([
            'farm_id' => 'required|exists:farms,id',
            'coffee_grade_id' => 'required|exists:coffee_grades,id',
            'harvest_date' => 'required|date',
            'quantity_kg' => 'required|integer',
            'status' => 'required|string',
            'processing_method' => 'required|string',
        ]);

        $batch->update($validated);

        return redirect()->route('harvest-batches.index')
                         ->with('success', 'Batch updated successfully');
    }

    /**
     * Delete batch
     */
    public function destroy(string $id)
    {
        $batch = HarvestBatch::findOrFail($id);
        $batch->delete();

        return redirect()->route('harvest-batches.index')
                         ->with('success', 'Batch deleted successfully');
    }

    /**
     * Dashboard view
     */
    public function dashboard()
    {
        $harvestBatches = HarvestBatch::with('coffeeGrade')->get();
        return view('dashboard', compact('harvestBatches'));
    }

    /**
     * Analytics view
     */
    public function analytics()
    {
        $totalBatches = HarvestBatch::count();
        $totalQuantity = HarvestBatch::sum('quantity_kg');

        $statusCounts = HarvestBatch::select('status', DB::raw('COUNT(*) as count'))
                                    ->groupBy('status')->get();

        $monthlyHarvests = HarvestBatch::selectRaw('DATE_FORMAT(harvest_date, "%M %Y") as month, COUNT(*) as count')
                                       ->groupBy('month')
                                       ->orderByRaw('MIN(harvest_date)')
                                       ->get();

        $farmPerformance = HarvestBatch::select('farm_id', DB::raw('SUM(quantity_kg) as total_kg'))
                                       ->groupBy('farm_id')
                                       ->with('farm')->get();

        $gradeDistribution = HarvestBatch::select('coffee_grade_id', DB::raw('COUNT(*) as count'))
                                         ->groupBy('coffee_grade_id')
                                         ->with('coffeeGrade')->get();

        return view('analytics.index', compact(
            'totalBatches',
            'totalQuantity',
            'statusCounts',
            'monthlyHarvests',
            'farmPerformance',
            'gradeDistribution'
        ));
    }
}
