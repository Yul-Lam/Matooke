<?php


namespace App\Http\Controllers;

use App\Models\HarvestBatch;
use App\Exports\HarvestBatchesExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Farm;
use App\Models\CoffeeGrade;
use Illuminate\Support\Facades\DB;



class HarvestBatchController extends Controller
{
    public function export()
    {
        return Excel::download(new HarvestBatchesExport, 'harvest_batches.xlsx');
    }
    /**
     * Display a listing of the resource.
     */
    
public function index(Request $request)
{
    $query = \App\Models\HarvestBatch::with(['farm', 'coffeeGrade']);

    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->whereHas('farm', fn($q) => $q->where('name', 'like', "%$search%"))
              ->orWhereHas('coffeeGrade', fn($q) => $q->where('name', 'like', "%$search%"));
    }

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Sorting
    $sort = $request->get('sort', 'id');
    $direction = $request->get('direction', 'desc');
    $query->orderBy($sort, $direction);

    $harvestBatches = $query->paginate(10);

    // Stats for dashboard
    $stats = [
        'total' => \App\Models\HarvestBatch::count(),
        'in_storage' => \App\Models\HarvestBatch::where('status', 'in_storage')->count(),
        'shipped' => \App\Models\HarvestBatch::where('status', 'shipped')->count(),
        'total_quantity' => \App\Models\HarvestBatch::sum('quantity_kg'),
    ];

    return view('coffee-inventory.index', compact('harvestBatches', 'stats'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('harvest-batches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    // Example: create a batch of jobs (adjust jobs as needed)
        $batch = Bus::batch([
            new \App\Jobs\HarvestJob1(),
            new \App\Jobs\HarvestJob2(),
            // add your jobs here
        ])->name('Harvest Batch')->dispatch();

     
// Create inventory transaction...
return redirect()->route('harvest-batches.show', $batch->id)
                 ->with('success', 'Harvest batch recorded successfully');


    $validated = $request->validate([
        
    'farm_id' => 'required|exists:farms,id',
    'coffee_grade_id' => 'required|exists:coffee_grades,id',
    'harvest_date' => 'required|date',
    'quantity_kg' => 'required|integer',
    'status' => 'required|string',
    'processing_method' => 'required|string'

    ]);

    $batch = HarvestBatch::create($validated);

    // Create initial inventory transaction
    InventoryTransaction::create([
        'harvest_batch_id' => $batch->id,
        'to_location_id' => InventoryLocation::where('type', 'storage')->first()->id,
        'quantity_kg' => $batch->quantity_kg,
        'transaction_type' => 'intake',
        'notes' => 'Initial harvest intake',
    ]);

    return redirect()->route('harvest-batches.show', $batch->id)
        ->with('success', 'Harvest batch recorded successfully');
}
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $batch = HarvestBatch::findOrFail($id);
    return view('harvest-batches.show', compact('batch'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $batch = HarvestBatch::findOrFail($id);
    $farms = Farm::all();
    $grades = CoffeeGrade::all();

    return view('harvest-batches.edit', compact('batch', 'farms', 'grades'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $batch = HarvestBatch::findOrFail($id);
    $batch->update($request->all());
    return redirect()->route('harvest-batches.index')->with('success', 'Batch updated successfully'); 
    return redirect()->route('dashboard')->with('success', 'Batch updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $batch = HarvestBatch::findOrFail($id);
    $batch->delete();
    return redirect()->route('harvest-batches.index')->with('success', 'Batch deleted successfully'); 
    }
    

public function dashboard()
{
    $harvestBatches = HarvestBatch::with('coffeeGrade')->get(); // eager-load related coffee grade
    return view('dashboard', compact('harvestBatches'));
}



public function analytics()
{
    $totalBatches = HarvestBatch::count();
    $totalQuantity = HarvestBatch::sum('quantity_kg');

    $statusCounts = HarvestBatch::select('status', DB::raw('COUNT(*) as count'))
        ->groupBy('status')
        ->get();

    $monthlyHarvests = HarvestBatch::selectRaw('DATE_FORMAT(harvest_date, "%M %Y") as month, COUNT(*) as count')
        ->groupBy('month')
        ->orderByRaw('MIN(harvest_date)')
        ->get();

    $farmPerformance = HarvestBatch::select('farm_id', DB::raw('SUM(quantity_kg) as total_kg'))
        ->groupBy('farm_id')
        ->with('farm')
        ->get();

    $gradeDistribution = HarvestBatch::select('coffee_grade_id', DB::raw('COUNT(*) as count'))
        ->groupBy('coffee_grade_id')
        ->with('coffeeGrade')
        ->get();

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
