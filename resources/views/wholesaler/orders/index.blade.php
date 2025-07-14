@extends('layouts.wholesaler')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 Orders Received</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">No orders received yet.</div>
    @else
        @foreach($orders as $orderId => $items)
            @php $order = $items->first()->order; @endphp

            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <div>
                        <strong>Order #{{ $order->id }}</strong>
                        — <span class="badge bg-secondary text-uppercase">{{ $order->status }}</span><br>
                        <small>Retailer: {{ $order->retailer->name }} | Placed: {{ $order->created_at->format('d M Y H:i') }}</small>
                    </div>
                    <form action="{{ route('wholesaler.orders.updateStatus', $order->id) }}" method="POST" class="d-flex">
                        @csrf
                        <select name="status" class="form-select form-select-sm me-2">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                        <button class="btn btn-sm btn-success">✔ Update</button>
                    </form>
                </div>

                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>UGX {{ number_format($item->price) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
