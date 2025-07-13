@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 fw-bold text-success">Batch Details — ID {{ $batch->id }}</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Farm:</strong> {{ $batch->farm->name ?? '—' }}</li>
                <li class="list-group-item"><strong>Grade:</strong> {{ $batch->coffeeGrade->name ?? '—' }}</li>
                <li class="list-group-item"><strong>Quantity:</strong> {{ $batch->quantity_kg }} kg</li>
                <li class="list-group-item"><strong>Harvest Date:</strong> {{ \Carbon\Carbon::parse($batch->harvest_date)->format('d M Y') }}</li>
                <li class="list-group-item"><strong>Status:</strong>
                    @php
                        $badgeClass = match(strtolower($batch->status)) {
                            'shipped' => 'bg-success',
                            'pending' => 'bg-warning',
                            'rejected' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                    @endphp
                    <span class="badge {{ $badgeClass }}">{{ ucfirst($batch->status) }}</span>
                </li>
            </ul>
        </div>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary mt-4">
        ← Back to Dashboard
    </a>
</div>
@endsection
