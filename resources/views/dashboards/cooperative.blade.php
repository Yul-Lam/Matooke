{{-- resources/views/cooperative.blade.php --}}
@extends('layouts.app')

@section('title', 'Coffee Cooperative Dashboard')

@section('content')
<div class="container my-4">

    {{-- Dashboard Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Coffee Cooperative Dashboard</h1>
        <form action="{{ route('harvest-batches.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add New Batch
            </button>
        </form>
    </div>

   

        

    {{-- Status message --}}
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Coffee Batches Table --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Current Coffee Batches Inventory</h5>
        </div>
        <div class="card-body p-0">
            @if($harvestBatches->isEmpty())
                <p class="text-center p-4">No coffee batches available.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Batch ID</th>
                                <th>Name</th>
                                <th>Quantity (kg)</th>
                                <th>Harvest Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($harvestBatches as $batch)
                                <tr>
                                    <td>{{ $batch->id }}</td>
                                    <td>{{ $batch->name }}</td>
                                    <td>{{ $batch->quantity }}</td>
                                    <td>{{ $batch->harvest_date->format('d M Y') }}</td>
                                    <td>
                                        <span class="badge 
                                            {{ $batch->status == 'processed' ? 'bg-success' : 'bg-warning' }}">
                                            {{ ucfirst($batch->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('harvest-batches.show', $batch->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('harvest-batches.edit', $batch->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

</div>
<h3 class="fw-bold mt-4">Add New Harvest Batch</h3>
<form action="{{ route('harvest-batches.store') }}" method="POST" class="row gy-3 mt-3">
    @csrf

    <div class="col-md-6">
        <label for="farm_id" class="form-label">Farm</label>
        <select name="farm_id" id="farm_id" class="form-select" required>
            @foreach(App\Models\Farm::all() as $farm)
                <option value="{{ $farm->id }}">{{ $farm->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label for="coffee_grade_id" class="form-label">Coffee Grade</label>
        <select name="coffee_grade_id" id="coffee_grade_id" class="form-select" required>
            @foreach(App\Models\CoffeeGrade::all() as $grade)
                <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-6">
        <label for="harvest_date" class="form-label">Harvest Date</label>
        <input type="date" name="harvest_date" id="harvest_date" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="quantity_kg" class="form-label">Quantity (kg)</label>
        <input type="number" name="quantity_kg" id="quantity_kg" class="form-control" required>
    </div>

    <div class="col-md-6">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="in_storage">In Storage</option>
            <option value="shipped">Shipped</option>
        </select>
    </div>

    <div class="col-md-6">
        <label for="processing_method" class="form-label">Processing Method</label>
        <input type="text" name="processing_method" id="processing_method" class="form-control" required>
    </div>

    <div class="col-12 text-end">
        <button type="submit" class="btn btn-primary px-4">Submit</button>
    </div>
</form>

@endsection