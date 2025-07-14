@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold text-primary mb-5">☕ Available Coffee Products</h2>

    @if($products->isEmpty())
        <div class="alert alert-warning text-center">
            No products available at the moment.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-success fw-semibold">{{ $product->name }}</h5>
                            <p class="card-text mb-1"><strong>Grade:</strong> {{ $product->grade }}</p>
                            <p class="card-text mb-1"><strong>Stock:</strong> {{ $product->quantity }} units</p>
                            <p class="card-text mb-3"><strong>Price:</strong> UGX {{ number_format($product->price) }}</p>

                            <form method="POST" action="{{ route('retailer.cart.add') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="btn btn-sm btn-primary mt-2 w-100">➕ Add to Cart</button>
</form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
