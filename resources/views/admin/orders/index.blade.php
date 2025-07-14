@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">🛠 Admin Dashboard – All Orders</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @forelse($orders as $order)
        <div class="bg-white rounded shadow-md p-5 mb-5">
            <div class="flex justify-between items-center mb-3">
                <div>
                <h4 class="text-lg font-semibold text-gray-700">📦 Order #{{ $order->id }} – UGX {{ number_format($order->total) }}</h4>
                    <p class="text-sm text-gray-600">👤 {{ $order->user->name }} | 📅 {{ $order->created_at->format('d M Y, h:i A') }}</p>
                </div>
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="flex items-center gap-2">
                    @csrf
                    <select name="status" class="border border-gray-300 rounded px-2 py-1 text-sm">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                    <button class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">Update</button>
                </form>
            </div>

            <p class="text-gray-700 mb-2">📍 Address: {{ $order->delivery_address }}</p>

            <ul class="list-disc ml-6 text-sm text-gray-800">
                @foreach($order->items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }} – UGX {{ number_format($item->price * $item->quantity) }}</li>
                @endforeach
            </ul>
        </div>
    @empty
        <p class="text-gray-500">No orders found.</p>
    @endforelse
</div>
@endsection
