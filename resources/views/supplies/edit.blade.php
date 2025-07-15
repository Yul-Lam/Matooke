@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">✏️ Edit Supply</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following issues:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('supplies.update', $supply->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-select">
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supply->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="coffee_id" class="form-label">Coffee</label>
                    <select name="coffee_id" id="coffee_id" class="form-select">
                        @foreach($coffees as $coffee)
                            <option value="{{ $coffee->id }}" {{ $supply->coffee_id == $coffee->id ? 'selected' : '' }}>
                                {{ $coffee->type }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $supply->quantity }}">
                </div>

                <div class="mb-3">
                    <label for="supply_date" class="form-label">Date Supplied</label>
                    <input type="date" name="supply_date" id="supply_date" class="form-control" value="{{ $supply->supply_date }}">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">💾 Update Supply</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
