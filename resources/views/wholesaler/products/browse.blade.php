@extends('layouts.wholesaler')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4 text-primary">🧺 All Processed Coffee Products</h2>

    @if($products->isEmpty())
        <div class="alert alert-info text-center">No products available at the moment.</div>
    @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Quantity</th>
                    <th>Price (UGX)</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->grade }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>UGX {{ number_format($product->price) }}</td>
                        <td>{{ $product->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
