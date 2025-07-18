@extends('layouts.app')

@section('title', 'Add Supply')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-success text-white d-flex align-items-center">
                <i class="bi bi-plus-circle me-2"></i>
                <h5 class="mb-0">Add New Supply</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('supplies.store') }}" method="POST">
                    @csrf

                    {{-- Supplier Selection --}}
                    <div class="mb-3">
                        <label class="form-label">Supplier:</label>
                        <select name="supplier_id" class="form-select" required>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Coffee Selection --}}
                    <div class="mb-3">
                        <label class="form-label">Coffee:</label>
                        <select name="coffee_id" class="form-select" required>
                            @foreach($coffees as $coffee)
                                <option value="{{ $coffee->id }}">{{ $coffee->type }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Quantity Input --}}
                    <div class="mb-3">
                        <label class="form-label">Quantity:</label>
                        <input type="number" name="quantity" class="form-control" required>
                    </div>

                    {{-- Supply Date Input --}}
                    <div class="mb-3">
                        <label class="form-label">Supply Date:</label>
                        <input type="date" name="supply_date" class="form-control" required>
                    </div>

                    {{-- Submit Button --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Save Supply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
