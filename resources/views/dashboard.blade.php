@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
    <a href="{{ route('harvest-batches.index') }}">View All Batches</a>


    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Grade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity (kg)</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Base Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($harvestBatches as $batch)
            <tr>
                <td class="px-6 py-4">{{ $batch->coffeeGrade->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $batch->quantity_kg }}</td>
                <td class="px-6 py-4">{{ $batch->coffeeGrade->base_price_per_kg ?? 'N/A' }}</td>
                <td class="px-6 py-4">kg</td>
                <td class="px-6 py-4">
                    <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                        {{ $batch->quantity_kg < 100 ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                        {{ $batch->quantity_kg < 100 ? 'Low Stock' : 'In Stock' }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">No harvest batches found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
