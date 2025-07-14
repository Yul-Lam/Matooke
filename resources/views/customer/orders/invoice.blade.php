<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; color: #333; }
        h1 { text-align: center; color: #5a7247; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        .total { font-weight: bold; font-size: 16px; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #888; }
    </style>
</head>
<body>
    <h1>Golden Bean Coffee - Invoice</h1>
    <p><strong>Invoice ID:</strong> #{{ $order->id }}</p>
    <p><strong>Customer:</strong> {{ $order->user->name }}</p>
    <p><strong>Email:</strong> {{ $order->user->email }}</p>
    <p><strong>Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
    <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (UGX)</th>
                <th>Qty</th>
                <th>Subtotal (UGX)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price * $item->quantity) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="total">Total</td>
                <td class="total">UGX {{ number_format($order->total) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Thank you for shopping with Golden Bean! ☕<br>
        www.goldenbean.ug
    </div>
</body>
</html>
