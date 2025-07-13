@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-info">Edit Harvest Batch — ID {{ $batch->id }}</h2>

    <form method="POST" action="{{ route('harvest-batches.update', $batch->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="farm_id" class="form-label">Farm</label>
            <select name="farm_id" id="farm_id" class="form-control" required>
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}" {{ $batch->farm_id == $farm->id ? 'selected' : '' }}>
                        {{ $farm->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="coffee_grade_id" class="form-label">Grade</label>
            <select name="coffee_grade_id" id="coffee_grade_id" class="form-control" required>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ $batch->coffee_grade_id == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity_kg" class="form-label">Quantity (kg)</label>
            <input type="number" name="quantity_kg" class="form-control" value="{{ $batch->quantity_kg }}" required>
        </div>

        <div class="mb-3">
            <label for="harvest_date" class="form-label">Harvest Date</label>
            <input type="date" name="harvest_date" class="form-control" value="{{ $batch->harvest_date }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $batch->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_storage" {{ $batch->status == 'in_storage' ? 'selected' : '' }}>In Storage</option>
                <option value="shipped" {{ $batch->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="rejected" {{ $batch->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Batch</button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</div>
@endsection
