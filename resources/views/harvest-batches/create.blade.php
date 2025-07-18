@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">Create Harvest Batch</h2>

    <form method="POST" action="{{ route('harvest-batches.store') }}">
        @csrf

        <div class="mb-4">
            <label for="farm_id" class="block font-medium">Farm</label>
            <select name="farm_id" class="w-full border px-3 py-2 rounded">
                @foreach($farms as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="coffee_grade_id" class="block font-medium">Coffee Grade</label>
            <select name="coffee_grade_id" class="w-full border px-3 py-2 rounded">
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="harvest_date" class="block font-medium">Harvest Date</label>
            <input type="date" name="harvest_date" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="quantity_kg" class="block font-medium">Quantity (kg)</label>
            <input type="number" name="quantity_kg" class="w-full border px-3 py-2 rounded">
        </div>

        <div class="mb-4">
            <label for="status" class="block font-medium">Status</label>
            <select name="status" class="w-full border px-3 py-2 rounded">
                <option value="in_storage">In Storage</option>
                <option value="shipped">Shipped</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="processing_method" class="block font-medium">Processing Method</label>
            <input type="text" name="processing_method" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create Batch</button>
    </form>
</div>
@endsection
