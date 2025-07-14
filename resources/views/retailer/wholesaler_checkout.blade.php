@extends('layouts.retailer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛒 Wholesaler Checkout</h2>

    @php $total = 0; @endphp

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('retailer.wholesaler.checkout.store') }}">
        @csrf

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Product</th>
                        <th>Grade</th>
                        <th>Quantity</th>
                        <th>Price (UGX)</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>{{ $item['grade'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>UGX {{ number_format($item['price']) }}</td>
                            <td>UGX {{ number_format($subtotal) }}</td>
                        </tr>
                    @endforeach
                    <tr class="fw-bold table-info">
                        <td colspan="4">Total</td>
                        <td>UGX {{ number_format($total) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="mb-3">
            <label for="delivery_address" class="form-label">Delivery Address</label>
            <input type="text" name="delivery_address" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">✅ Place Order</button>
    </form>
</div>
@endsection
