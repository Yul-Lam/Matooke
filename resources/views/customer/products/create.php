@extends('layouts.retailer')

@section('content')
<div class="container py-4">
    <h2>Add Product</h2>

    <form method="POST" action="{{ route('retailer.products.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control" step="0.01" required>
        </div>

        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
</div>
@endsection
