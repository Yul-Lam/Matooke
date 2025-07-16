@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold text-danger mb-4">🔐 Security Settings</h2>

    <form method="POST" action="{{ route('profile.updatePassword') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Current Password</label>
            <input type="password" name="current_password" class="form-control">
        </div>

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-outline-danger">Update Password</button>
    </form>
</div>
@endsection
