@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-success mb-4">☕ Retailer Dashboard</h2>

    @if (session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6 d-grid gap-3">

            <a href="{{ route('retailer.products') }}" class="btn btn-outline-dark btn-lg w-100">
                🛍 View Coffee Products
            </a>

            <a href="{{ route('retailer.cart') }}" class="btn btn-outline-primary btn-lg w-100">
                🛒 View Cart
            </a>

            <a href="{{ route('orders.index') }}" class="btn btn-outline-success btn-lg w-100">
                📦 My Orders
            </a>

        </div>
    </div>
</div>
@endsection