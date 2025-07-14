@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary">📦 Your Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">You have not placed any orders yet.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Status</th>
                    <th>Total (UGX)</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Invoice</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>UGX {{ number_format($order->total) }}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('orders.invoice', $order->id) }}" class="btn btn-sm btn-outline-primary">🧾 Download</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
