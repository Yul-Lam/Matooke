@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">🧾 Checkout</h2>

    <form method="POST" action="{{ route('orders.store') }}">
        @csrf

        <div class="mb-3">
            <label for="delivery_address" class="form-label">📍 Delivery Address</label>
            <textarea name="delivery_address" id="delivery_address" rows="3" class="form-control" required></textarea>
        </div>

        <h5 class="mt-4">🛒 Order Summary</h5>
        <ul class="list-group mb-4">
            @php $cart = session('cart', []); $total = 0; @endphp
            @foreach($cart as $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $item['name'] }} × {{ $item['quantity'] }}
                    <span>UGX {{ number_format($subtotal) }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                Total
                <span>UGX {{ number_format($total) }}</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
    </form>
</div>
@endsection
