@extends('layouts.app')

@section('content')
<div class="container py-5">

    <h2 class="fw-bold text-success mb-4">☕ Coffee Cooperative Dashboard</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Inventory Table --}}
    <h4 class="mb-3">📦 Current Coffee Batches Inventory</h4>
    <table class="table table-striped table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Batch ID</th>
                <th>Farm Name</th>
                <th>Grade</th>
                <th>Quantity (kg)</th>
                <th>Harvest Date</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($harvestBatches as $batch)
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->farm->name ?? '—' }}</td>
                    <td>{{ $batch->coffeeGrade->name ?? '—' }}</td>
                    <td>{{ $batch->quantity_kg }}</td>
                    <td>{{ \Carbon\Carbon::parse($batch->harvest_date)->format('d M Y') }}</td>
                    <td>{{ ucfirst($batch->status) }}</td>
                    <td class="text-center">
                        <a href="{{ route('harvest-batches.show', $batch->id) }}" class="btn btn-sm btn-outline-primary">View</a>
                        <a href="{{ route('harvest-batches.edit', $batch->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No batches available.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Add New Batch Form --}}
    <h4 class="mt-5 fw-bold text-primary">➕ Add New Harvest Batch</h4>
    <form method="POST" action="{{ route('harvest-batches.store') }}" class="mt-3">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Farm</label>
                <select name="farm_id" class="form-select" required>
                    @foreach($farms as $farm)
                        <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label">Coffee Grade</label>
                <select name="coffee_grade_id" class="form-select" required>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label">Harvest Date</label>
                <input type="date" name="harvest_date" class="form-control" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Quantity (kg)</label>
                <input type="number" name="quantity_kg" class="form-control" min="1" step="0.01" required>
            </div>

            <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="in_storage">In Storage</option>
                    <option value="shipped">Shipped</option>
                    <option value="pending">Pending</option>
                    <option value="rejected">Rejected</option>
                </select>
            </div>

            <div class="col-md-12">
                <label class="form-label">Processing Method</label>
                <input type="text" name="processing_method" class="form-control" placeholder="e.g. Washed, Natural">
            </div>

            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-success mt-3">✅ Submit New Batch</button>
            </div>
        </div>
    </form>
</div>
@endsection
