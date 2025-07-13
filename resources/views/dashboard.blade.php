{{-- filepath: resources/views/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Inventory Dashboard
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400">Manage your coffee inventory</p>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Stats Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="flex items-center bg-blue-100 p-6 rounded shadow">
        <img src="https://img.icons8.com/color/48/coffee.png" alt="Total Coffee Batches" class="w-10 h-10 mr-4">
        <div>
            <div class="text-3xl font-bold text-blue-700">{{ $stats['total'] ?? 0 }}</div>
            <div class="text-xs uppercase text-gray-600 mt-1">Total Coffee Batches</div>
        </div>
    </div>
    <div class="flex items-center bg-green-100 p-6 rounded shadow">
    <img src="https://img.icons8.com/color/48/warehouse.png" alt="Coffee In Storage" class="w-10 h-10 mr-4">
    <div>
        <div class="text-3xl font-bold text-green-700">{{ $stats['in_storage'] ?? 0 }}</div>
        <div class="text-xs uppercase text-gray-600 mt-1">Coffee In Storage</div>
    </div>
</div>
    <div class="flex items-center bg-yellow-100 p-6 rounded shadow">
        <img src="https://img.icons8.com/color/48/shipped.png" alt="Coffee Shipped" class="w-10 h-10 mr-4">
        <div>
            <div class="text-3xl font-bold text-yellow-700">{{ $stats['shipped'] ?? 0 }}</div>
            <div class="text-xs uppercase text-gray-600 mt-1">Coffee Shipped</div>
        </div>
    </div>
    <div class="flex items-center bg-purple-100 p-6 rounded shadow">
        <img src="https://img.icons8.com/color/48/scale.png" alt="Total Coffee Quantity" class="w-10 h-10 mr-4">
        <div>
            <div class="text-3xl font-bold text-purple-700">{{ $stats['total_quantity'] ?? 0 }} kg</div>
            <div class="text-xs uppercase text-gray-600 mt-1">Total Coffee Quantity</div>
        </div>
    </div>
</div>

        {{-- Search and Add --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <form method="GET" action="{{ route('harvest-batches.index') }}" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="border rounded px-3 py-2 w-64">
                <button type="submit" class="bg-blue-600 text-white px-4 rounded">Search</button>
            </form>
            <a href="{{ route('harvest-batches.create') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded shadow">
    + Add New Item
</a>
        </div>

        {{-- Inventory Table --}}
        <div class="overflow-x-auto bg-white dark:bg-gray-800 shadow rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coffee Grade</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Unit Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Measurement</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                    @forelse($harvestBatches as $batch)
                    <tr>
                        <td class="px-6 py-4">{{ $batch->coffeeGrade->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $batch->quantity_kg }}</td>
                        <td class="px-6 py-4">
                            {{ $batch->coffeeGrade->base_price_per_kg ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">kg</td>
                        <td class="px-6 py-4">
                            <span class="inline-block px-2 py-1 text-xs font-semibold rounded
                                {{ $batch->quantity_kg < 100 ? 'bg-red-200 text-red-800' : 'bg-green-200 text-green-800' }}">
                                {{ $batch->quantity_kg < 100 ? 'Low Stock' : 'In Stock' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 space-x-2 flex items-center">
                            <a href="{{ route('harvest-batches.show', $batch->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs">View</a>
                            <a href="{{ route('harvest-batches.edit', $batch->id) }}" class="inline-block bg-yellow-400 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs">Edit</a>
                            <form action="{{ route('harvest-batches.destroy', $batch->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this item?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-block bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded text-xs">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">No products found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>