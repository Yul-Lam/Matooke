<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; }
        .title { font-size: 20px; font-weight: bold; }
        .section { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="section title">Invoice #{{ $order->id }}</div>
    <div class="section">
        <strong>Retailer:</strong> {{ $order->retailer->name }}<br>
        <strong>Delivery Address:</strong> {{ $order->delivery_address }}<br>
        <strong>Order Date:</strong> {{ $order->created_at->format('d M Y H:i') }}<br>
        <strong>Status:</strong> {{ ucfirst($order->status) }}
    </div>
    <div class="section">
        <table width="100%" border="1" cellspacing="0" cellpadding="5">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Grade</th>
                    <th>Qty</th>
                    <th>Price (UGX)</th>
                    <th>Total (UGX)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->product->grade }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price) }}</td>
                    <td>{{ number_format($item->quantity * $item->price) }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" align="right"><strong>Grand Total:</strong></td>
                    <td><strong>UGX {{ number_format($order->total) }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
