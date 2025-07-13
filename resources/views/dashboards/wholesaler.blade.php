@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold">Welcome, {{ auth()->user()->name }}</h2>
    <p class="mb-3 text-muted">Your Wholesaler Dashboard Overview</p>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-bg-light text-center p-3">
                <h5>Total Batches</h5>
                <p class="fs-4">{{ $harvestBatches->count() }}</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-light text-center p-3">
                <h5>Total Quantity</h5>
                <p class="fs-4">{{ $harvestBatches->sum('quantity_kg') }} kg</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-light text-center p-3">
                <h5>Total Shipped Batches</h5>
                <p class="fs-4">{{ $stats['total'] ?? 0 }}</p>
            </div>
        </div>
    </div>

    <h4 class="fw-bold mb-3">Batches Shipped to You</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-primary">
            <tr>
                <th>Batch ID</th>
                <th>Farm</th>
                <th>Grade</th>
                <th>Quantity (kg)</th>
                <th>Harvest Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($harvestBatches as $batch)
                <tr>
                    <td>{{ $batch->id }}</td>
                    <td>{{ $batch->farm->name ?? '—' }}</td>
                    <td>{{ $batch->coffeeGrade->name ?? '—' }}</td>
                    <td>{{ $batch->quantity_kg }}</td>
                    <td>{{ \Carbon\Carbon::parse($batch->harvest_date)->format('d M Y') }}</td>
                    <td>
                        @php
                            $badgeClass = match(strtolower($batch->status)) {
                                'shipped' => 'bg-success',
                                'pending' => 'bg-warning',
                                'rejected' => 'bg-danger',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($batch->status) }}</span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No batches shipped yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
