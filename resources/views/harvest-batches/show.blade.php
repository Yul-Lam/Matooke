@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-xl font-bold mb-4">Harvest Batch Details</h2>

    <div class="bg-white p-6 rounded shadow">
        <p><strong>Farm:</strong> {{ $batch->farm->name ?? '-' }}</p>
        <p><strong>Grade:</strong> {{ $batch->coffeeGrade->name ?? '-' }}</p>
        <p><strong>Harvest Date:</strong> {{ $batch->harvest_date }}</p>
        <p><strong>Quantity:</strong> {{ $batch->quantity_kg }} kg</p>
        <p><strong>Status:</strong> {{ ucfirst($batch->status) }}</p>
        <p><strong>Processing Method:</strong> {{ $batch->processing_method }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('harvest-batches.edit', $batch->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded">Edit</a>
        <form method="POST" action="{{ route('harvest-batches.destroy', $batch->id) }}" class="inline-block ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Delete</button>
        </form>
    </div>
</div>
@endsection
