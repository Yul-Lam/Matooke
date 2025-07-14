@extends('layouts.customer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🧾 Checkout</h2>

    <form action="{{ route('customer.checkout.store') }}" method="POST" class="card shadow-sm p-4 bg-light">
        @csrf
        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <input type="text" name="delivery_address" class="form-control" required placeholder="123 Coffee Street, Kampala">
        </div>

        <h5 class="mb-3">🛍 Order Summary</h5>
        <ul class="list-group mb-3">
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                <li class="list-group-item d-flex justify-content-between">
                    <div>{{ $item['name'] }} × {{ $item['quantity'] }}</div>
                    <div>UGX {{ number_format($subtotal) }}</div>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>UGX {{ number_format($total) }}</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
    </form>
</div>
@endsection
