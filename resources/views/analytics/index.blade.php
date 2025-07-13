@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-success mb-4">📊 Coffee Batch Analytics</h2>

    <div class="row text-center mb-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h6>Total Batches</h6>
                    <p class="fs-4 text-primary">{{ $totalBatches }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <h6>Total Quantity</h6>
                    <p class="fs-4 text-success">{{ $totalQuantity }} kg</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <h6>Batches by Status</h6>
                    @foreach ($statusCounts as $status)
                        <div>{{ ucfirst($status->status) }}: {{ $status->count }}</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">📆 Monthly Harvests</div>
        <div class="card-body">
            @foreach ($monthlyHarvests as $month)
                <div>{{ $month->month }} — {{ $month->count }} batches</div>
            @endforeach
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">🌱 Farm Performance</div>
        <div class="card-body">
            @foreach ($farmPerformance as $record)
                <div>{{ $record->farm->name ?? '—' }}: {{ $record->total_kg }} kg</div>
            @endforeach
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header fw-bold">🎯 Grade Distribution</div>
        <div class="card-body">
            @foreach ($gradeDistribution as $record)
                <div>{{ $record->coffeeGrade->name ?? '—' }}: {{ $record->count }} batches</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
