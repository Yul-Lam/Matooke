@extends('layouts.app')

@section('title', 'Edit Supply')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-warning text-dark">
            <strong>Edit Supply</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('supplies.update', $supply->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-select">
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ $supply->supplier_id == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="coffee_id" class="form-label">Coffee</label>
                    <select name="coffee_id" class="form-select">
                        @foreach ($coffees as $coffee)
                            <option value="{{ $coffee->id }}" {{ $supply->coffee_id == $coffee->id ? 'selected' : '' }}>
                                {{ $coffee->type }} {{ $coffee->grade ? '(' . $coffee->grade . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $supply->quantity }}" required>
                </div>

                <div class="mb-3">
                    <label for="supply_date" class="form-label">Supply Date</label>
                    <input type="date" name="supply_date" class="form-control" value="{{ $supply->supply_date->format('Y-m-d') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Supply</button>
                <a href="{{ route('supplies.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection