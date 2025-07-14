@extends('layouts.customer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛒 Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info text-center">Your cart is currently empty.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Price (UGX)</th>
                    <th>Quantity</th>
                    <th>Subtotal (UGX)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price']) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($subtotal) }}</td>
                        <td>
                            <form action="{{ route('customer.cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr class="table-info">
                    <td colspan="3" class="text-end fw-bold">Total</td>
                    <td colspan="2" class="fw-bold text-success">UGX {{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <form action="{{ route('customer.cart.clear') }}" method="POST" onsubmit="return confirm('Clear entire cart?')">
                @csrf
                <button class="btn btn-warning">Clear Cart</button>
            </form>

            <a href="{{ route('customer.checkout') }}" class="btn btn-success">🧾 Proceed to Checkout</a>
        </div>
    @endif
</div>
@endsection
