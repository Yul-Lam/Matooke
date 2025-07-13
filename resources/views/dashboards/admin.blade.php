@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-primary">Welcome back, {{ auth()->user()->name }}</h2>
    <p class="mb-3 text-muted">Your Admin inventory Dashboard Overview</p>

    <form method="GET" action="{{ route('dashboard') }}" class="mb-4 d-flex" role="search">
        <input type="text" name="search" class="form-control me-2" value="{{ request('search') }}" placeholder="Search farm, grade, or status">
        <button type="submit" class="btn btn-outline-primary">Search</button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">Clear</a>
</a>
    </form>
    <a href="{{ route('analytics') }}" class="btn btn-outline-success mb-3">
    📊 View Coffee Analytics
</a>
    <div class="row text-center mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase">Total Batches</h6>
                    <p class="fs-4 fw-bold text-primary">{{ $harvestBatches->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase">Total Quantity</h6>
                    <p class="fs-4 fw-bold text-success">{{ $harvestBatches->sum('quantity_kg') }} kg</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <h6 class="text-uppercase">Shipped Batches</h6>
                    <p class="fs-4 fw-bold text-warning">{{ $stats['total'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>
    <p class="text-muted">
    Showing {{ $harvestBatches->count() }} result{{ $harvestBatches->count() !== 1 ? 's' : '' }} for "<strong>{{ request('search') }}</strong>"
</p>


    <h4 class="fw-bold mb-3 text-secondary">Batches Shipped to You</h4>
    <table class="table table-hover table-striped table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Batch ID</th>
                <th>Farm</th>
                <th>Grade</th>
                <th>Quantity (kg)</th>
                <th>Harvest Date</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
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
                    <td class="text-center">
                        <a href="{{ route('harvest-batches.show', $batch->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye-fill"></i> View
                        </a>
                        <a href="{{ route('harvest-batches.edit', $batch->id) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                        <form action="{{ route('harvest-batches.destroy', $batch->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this batch?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash-fill"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">No batches available.</td>
                </tr>
            @endforelse
        </tbody>
        @php
    $statusIcon = match(strtolower($batch->status)) {
        'shipped' => '🚚',
        'in_storage' => '📦',
        'pending' => '⏳',
        'rejected' => '❌',
        default => '📁'
    };
@endphp
<span class="badge {{ $badgeClass }}">
    {!! $statusIcon !!} {{ ucfirst($batch->status) }}
</span>
    </table>
</div>



<th>
    Farm
    <i class="bi bi-arrow-up-short"></i>
</th>


@endsection
