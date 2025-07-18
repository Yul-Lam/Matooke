@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Harvest Batches</h1>

    <form method="GET" action="{{ route('harvest-batches.index') }}" class="mb-4">
        <input type="text" name="search" placeholder="Search farm or grade" class="border px-3 py-2 rounded">
        <select name="status" class="border px-3 py-2 rounded">
            <option value="">All Statuses</option>
            <option value="in_storage">In Storage</option>
            <option value="shipped">Shipped</option>
        </select>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-6 py-3">Farm</th>
                <th class="px-6 py-3">Grade</th>
                <th class="px-6 py-3">Quantity</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($harvestBatches as $batch)
            <tr>
                <td class="px-6 py-4">{{ $batch->farm->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $batch->coffeeGrade->name ?? '-' }}</td>
                <td class="px-6 py-4">{{ $batch->quantity_kg }} kg</td>
                <td class="px-6 py-4">{{ ucfirst($batch->status) }}</td>
                <td class="px-6 py-4">
                    <a href="{{ route('harvest-batches.show', $batch->id) }}" class="text-blue-500">View</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $harvestBatches->links() }}
    </div>
</div>
@endsection
