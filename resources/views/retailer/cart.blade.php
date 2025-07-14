@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <h2 class="mb-4 text-center text-primary">🛒 Your Cart</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @php
                $cart = session()->get('cart', []);
            @endphp

            @if(is_array($cart) && count($cart) > 0)
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price (UGX)</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php 
                                $subtotal = $item['price'] * $item['quantity']; 
                                $total += $subtotal; 
                            @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>UGX {{ number_format($item['price']) }}</td>
                                <td><td class="text-center">
    <form action="{{ route('retailer.cart.decrease', ['id' => $id]) }}" method="POST" style="display:inline-block">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-secondary">−</button>
    </form>

    <span class="mx-2">{{ $item['quantity'] }}</span>

    <form action="{{ route('retailer.cart.increase', ['id' => $id]) }}" method="POST" style="display:inline-block">
        @csrf
        <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
    </form>
</td></td>
                                <td>UGX {{ number_format($subtotal) }}</td>
                                {{-- <td>
                                    <form action="{{ route('retailer.cart.remove', ['id' => $id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑 Remove</button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                        <tr class="table-info fw-bold">
                            <td colspan="3">Total</td>
                            <td>UGX {{ number_format($total) }}</td>
                            {{-- <td></td> --}}
                        </tr>
                    </tbody>
                </table>

                <div class="d-flex justify-content-between mt-3">
                    <form action="{{ route('retailer.cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning">🗑 Clear Cart</button>
                    </form>

                    <a href="{{ route('orders.create') }}" class="btn btn-success">✅ Proceed to Checkout</a>
                </div>
            @else
                <div class="alert alert-info text-center">Your cart is empty.</div>
            @endif

        </div>
    </div>
</div>
@endsection
