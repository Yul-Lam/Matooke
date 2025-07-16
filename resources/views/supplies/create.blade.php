@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">📝 Add New Supply</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Something went wrong:
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('supplies.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="supplier_id" class="form-label">Supplier</label>
                    <select name="supplier_id" id="supplier_id" class="form-select">
                        <option selected disabled>Choose a supplier</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="coffee_id" class="form-label">Coffee</label>
                    <select name="coffee_id" id="coffee_id" class="form-select">
                        <option selected disabled>Choose a coffee type</option>
                        @foreach($coffees as $coffee)
                            <option value="{{ $coffee->id }}">{{ $coffee->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Enter quantity">
                </div>

                <div class="mb-3">
                    <label for="supplied_on" class="form-label">Date Supplied</label>
                    <input type="date" name="supplied_on" id="supplied_on" class="form-control">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">✅ Save Supply</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
