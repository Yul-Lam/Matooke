@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-success">👤 Profile Overview</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <img src="{{ asset('images/default-avatar.png') }}" alt="Profile" class="rounded-circle border shadow-sm" width="120">
                    <p class="text-muted mt-2">Profile Photo</p>
                </div>
                <div class="col-md-9">
                    <h4 class="fw-bold text-primary">{{ auth()->user()->name }}</h4>
                    <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                    <p><strong>Role:</strong> {{ ucfirst(auth()->user()->role ?? 'N/A') }}</p>
                    <p><strong>Member Since:</strong> {{ auth()->user()->created_at->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-end mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Back to Dashboard</a>
    </div>
</div>
@endsection
