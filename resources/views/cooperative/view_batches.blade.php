@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-primary fw-bold">📦 Uploaded Coffee Batches</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if($batches->count() > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-hover shadow-sm">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Batch Name</th>
                        <th>Quantity (KG)</th>
                        <th>Quality Grade</th>
                        <th>Uploaded At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($batches as $batch)
                        <tr>
                            <td>{{ $batch->id }}</td>
                            <td>{{ $batch->batch_name }}</td>
                            <td>{{ $batch->quantity }}</td>
                            <td>{{ $batch->quality_grade }}</td>
                            <td>{{ $batch->created_at->format('M d, Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center">
            No coffee batches uploaded yet.
        </div>
    @endif
</div>
@endsection
