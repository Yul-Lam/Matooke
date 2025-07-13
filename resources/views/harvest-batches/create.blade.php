@extends('layouts.app')

@section('content')
<a href="{{ route('harvest-batches.create') }}" class="btn btn-success mb-3">➕ Add New Harvest Batch</a>

<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">Add New Harvest Batch</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('harvest-batches.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label for="farm_id" class="block font-medium">Farm:</label>
            <select name="farm_id" id="farm_id" required class="w-full border px-3 py-2 rounded">
                @foreach(App\Models\Farm::all() as $farm)
                    <option value="{{ $farm->id }}">{{ $farm->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="coffee_grade_id" class="block font-medium">Coffee Grade:</label>
            <select name="coffee_grade_id" id="coffee_grade_id" required class="w-full border px-3 py-2 rounded">
                @foreach(App\Models\CoffeeGrade::all() as $grade)
                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="harvest_date" class="block font-medium">Harvest Date:</label>
            <input type="date" name="harvest_date" id="harvest_date" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label for="quantity_kg" class="block font-medium">Quantity (kg):</label>
            <input type="number" name="quantity_kg" id="quantity_kg" required class="w-full border px-3 py-2 rounded">
        </div>

        <div>
            <label for="status" class="block font-medium">Status:</label>
            <select name="status" id="status" required class="w-full border px-3 py-2 rounded">
                <option value="in_storage">In Storage</option>
                <option value="shipped">Shipped</option>
            </select>
        </div>

        <div>
            <label for="processing_method" class="block font-medium">Processing Method:</label>
            <input type="text" name="processing_method" id="processing_method" required class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
            Submit Batch
        </button>
    </form>
</div>
@endsection
