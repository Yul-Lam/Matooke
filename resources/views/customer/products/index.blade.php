@extends('layouts.customer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛍 Available Products</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-info text-center">No products available right now.</div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ $product->description }}</p>
                            <p><strong>UGX {{ number_format($product->price) }}</strong></p>

                            <form action="{{ route('customer.cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-primary w-100">Add to Cart 🛒</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection