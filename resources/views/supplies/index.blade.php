@extends('layouts.app')

@section('title', 'Supplies')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <i class="bi bi-bar-chart"></i> Supplies by Coffee Type
            </div>
            <div class="card-body">
                <canvas id="supplyChart" height="80"></canvas>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <span><i class="bi bi-box-seam me-2"></i>Supply List</span>
                <a href="{{ route('supplies.create') }}" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Add Supply</a>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('supplies.index') }}" class="mb-4 row g-2">
                    <div class="col-auto">
                        <input type="text" name="search" class="form-control" placeholder="Search by supplier or coffee" />
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
                    </div>
                </form>
                @if($supplies->count())
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover align-middle">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier</th>
                                    <th>Coffee</th>
                                    <th>Quantity</th>
                                    <th>Supply Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($supplies as $supply)
                                    <tr>
                                        <td>{{ $supply->id }}</td>
                                        <td>{{ $supply->supplier->name ?? '-' }}</td>
                                        <td>{{ $supply->coffee->type ?? '-' }}{{ isset($supply->coffee->grade) ? ' ('.$supply->coffee->grade.')' : '' }}</td>
                                        <td>{{ $supply->quantity }}</td>
                                        <td>{{ $supply->supply_date }}</td>
                                        <td>
                                            <a href="{{ route('supplies.edit', $supply->id) }}" class="btn btn-sm btn-primary">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('supplies.destroy', $supply->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this supply?')">
                                                    <i class="bi bi-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">No supply records found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const ctx = document.getElementById('supplyChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels ?? []) !!},
            datasets: [{
                label: 'Number of Supplies',
                data: {!! json_encode($chartData ?? []) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@endpush