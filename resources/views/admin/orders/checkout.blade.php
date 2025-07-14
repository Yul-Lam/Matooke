@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary">🧾 Checkout</h2>

    {{-- Display any flash messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-3">
            <label for="delivery_address" class="form-label">📍 Delivery Address</label>
            <textarea name="delivery_address" id="delivery_address" rows="3" class="form-control" required>{{ old('delivery_address') }}</textarea>
            @error('delivery_address')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <h5 class="mt-4 fw-bold">🛒 Order Summary</h5>
        <ul class="list-group mb-4 shadow-sm">
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php 
                    $subtotal = $item['price'] * $item['quantity']; 
                    $total += $subtotal;
                @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $item['name'] }} × <strong>{{ $item['quantity'] }}</strong></span>
                    <span class="text-muted">UGX {{ number_format($subtotal) }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold bg-light">
                <span>Total</span>
                <span>UGX {{ number_format($total) }}</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-lg btn-primary w-100">
            ✅ Place Order
        </button>
    </form>
</div>
@endsection
