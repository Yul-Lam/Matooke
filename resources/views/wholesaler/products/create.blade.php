@extends('layouts.wholesaler')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📤 Upload New Processed Coffee Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('wholesaler.products.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Grade</label>
            <input type="text" name="grade" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (UGX)</label>
            <input type="number" name="price" step="0.01" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">✅ Upload Product</button>
    </form>
</div>
@endsection
