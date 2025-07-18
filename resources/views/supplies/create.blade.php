@extends('layouts.app')

@section('title', 'Add Supply')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <i class="bi bi-plus-circle"></i> Add New Supply
            </div>
            <div class="card-body">
                <form action="{{ route('supplies.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Supplier:</label>
                        <select name="supplier_id" class="form-select" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Coffee:</label>
                        <select name="coffee_id" class="form-select" required>
                            @foreach($coffees as $coffee)
                                <option value="{{ $coffee->id }}">{{ $coffee->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supply Date:</label>
                        <input type="date" name="supply_date" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Supplied On:</label>
                        <input type="text" name="supplied_on" class="form-control" placeholder="e.g. 15/07/2025" required>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Save Supply</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
