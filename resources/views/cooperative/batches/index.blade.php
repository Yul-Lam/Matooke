@extends('layouts.cooperative')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-4">📦 Uploaded Coffee Batches</h2>

    @if($batches->isEmpty())
        <div class="alert alert-info text-center">
            No coffee batches uploaded yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped shadow-sm">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Batch Name</th>
                        <th>Quantity (KG)</th>
                        <th>Quality Grade</th>
                        <th>Uploaded On</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $batch)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $batch->batch_name }}</td>
                            <td>{{ $batch->quantity }}</td>
                            <td>{{ $batch->quality_grade }}</td>
                            <td>{{ $batch->created_at->format('d M Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
