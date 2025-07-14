@extends('layouts.retailer')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark">📦 My Uploaded Products</h2>
        <a href="{{ route('retailer.products.create') }}" class="btn btn-primary">+ Add Product</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($products->count())
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">UGX {{ number_format($product->price) }}</h6>
                            <p class="card-text">
                                Grade: <strong>{{ $product->grade ?? 'N/A' }}</strong><br>
                                Quantity: {{ $product->quantity }}
                            </p>
                            <p class="card-text text-secondary">{{ $product->description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-warning">You haven't uploaded any products yet.</div>
    @endif
@endsection
