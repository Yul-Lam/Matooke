<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\HarvestBatch;
use App\Http\Controllers\HarvestBatchController;



Route::get('/analytics', [HarvestBatchController::class, 'analytics'])->name('analytics');





Route::get('/dashboard', function () {
    $user = auth()->user();
    $harvestBatches = \App\Models\HarvestBatch::with('coffeeGrade')->get();
    $stats = [
        'total' => \App\Models\HarvestBatch::count(),
        'in_storage' => \App\Models\HarvestBatch::where('status', 'in_storage')->count(),
        'shipped' => \App\Models\HarvestBatch::where('status', 'shipped')->count(),
        'total_quantity' => \App\Models\HarvestBatch::sum('quantity_kg'),
    ];

    switch ($user->role) {
        case 'admin':
            return view('dashboards.admin', compact('harvestBatches', 'stats'));

        case 'cooperative':
            return view('dashboards.cooperative', compact('harvestBatches', 'stats'));

            case 'wholesaler':
                $harvestBatches = \App\Models\HarvestBatch::where('status', 'shipped')->get();
    $stats = [
        'total' => $harvestBatches->count(),
        'total_quantity' => $harvestBatches->sum('quantity_kg'),];
    return view('dashboards.wholesaler', compact('harvestBatches', 'stats'));

case 'retailer':
    $receivedBatches = \App\Models\Batch::where('retailer_id', $user->id)->get();
    $stats = [
        'total' => $receivedBatches->where('status', 'received')->count(),
        'total_quantity' => $receivedBatches->sum('quantity_kg'),
    ];
    return view('dashboards.retailer', compact('receivedBatches', 'stats'));

    
        // other roles...
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('harvest-batches', HarvestBatchController::class);
    Route::get('harvest-batches-export', [HarvestBatchController::class, 'export'])->name('harvest-batches.export');
});



Route::resource('harvest-batches', HarvestBatchController::class);



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::get('/harvest-batches/{id}', [BatchController::class, 'show'])->name('harvest-batches.show'); // View
Route::get('/harvest-batches/{id}/edit', [BatchController::class, 'edit'])->name('harvest-batches.edit'); // Edit
Route::put('/harvest-batches/{id}', [BatchController::class, 'update'])->name('harvest-batches.update'); // Update (form submission)
Route::delete('/harvest-batches/{id}', [BatchController::class, 'destroy'])->name('harvest-batches.destroy'); // Delete


Route::post('/harvest-batches', [HarvestBatchController::class, 'store'])->name('harvest-batches.store');


Route::post('/harvest-batches', [HarvestBatchController::class, 'store'])->name('harvest-batches.store');
Route::get('/harvest-batches/{id}', [HarvestBatchController::class, 'show'])->name('harvest-batches.show');
Route::get('/harvest-batches/{id}/edit', [HarvestBatchController::class, 'edit'])->name('harvest-batches.edit');
use App\Http\Controllers\RetailerDashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/retailer/dashboard', [RetailerDashboardController::class, 'index'])->name('retailer.dashboard');
});
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

