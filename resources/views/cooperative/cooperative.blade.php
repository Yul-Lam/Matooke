@extends('layouts.cooperative')

@section('content')
<h2 class="mb-4 text-center text-success fw-bold">🌿 Cooperative Dashboard</h2>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-primary">📤 Upload Coffee Batch</h5>
                <a href="{{ route('cooperative.batches.create') }}" class="btn btn-outline-primary mt-2">
                    <i class="fas fa-upload"></i> Upload Batch
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h5 class="card-title text-success">📂 View Uploaded Batches</h5>
                <a href="{{ route('cooperative.batches.index') }}" class="btn btn-outline-success mt-2">
                    <i class="fas fa-folder-open"></i> View Batches
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
