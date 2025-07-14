<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; }
    </style>
</head>
<body>
    <h2>🧾 Invoice - Order #{{ $order->id }}</h2>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>UGX {{ number_format($item->price) }}</td>
                <td>UGX {{ number_format($item->quantity * $item->price) }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td><strong>UGX {{ number_format($order->total) }}</strong></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
