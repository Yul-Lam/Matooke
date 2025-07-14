@extends('layouts.customer')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4 text-primary">📦 Your Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">You haven’t placed any orders yet.</div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #{{ $order->id }}</strong> —
                        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span><br>
                        <small class="text-muted">Placed: {{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <a href="{{ route('customer.orders.invoice', $order->id) }}" class="btn btn-sm btn-outline-primary">
                        🧾 Invoice
                    </a>
                </div>
                <div class="card-body">
                    <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
                    <p><strong>Total:</strong> UGX {{ number_format($order->total) }}</p>

                    <ul class="list-group mt-3">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->product->name }}
                                <span>Qty: {{ $item->quantity }} × UGX {{ number_format($item->price) }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
