@extends('layouts.cooperative')

@section('content')
<div class="container py-5">
    <h2 class="text-center text-primary fw-bold mb-4">☕ Upload New Coffee Batch</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Oops!</strong> Please fix the following issues:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cooperative.batches.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="batch_name" class="form-label">Batch Name</label>
            <input type="text" name="batch_name" id="batch_name" class="form-control" placeholder="e.g. July Harvest A" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity (in KG)</label>
            <input type="number" name="quantity" id="quantity" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="quality_grade" class="form-label">Quality Grade</label>
            <select name="quality_grade" id="quality_grade" class="form-select" required>
                <option value="">Select Grade</option>
                <option value="Grade A">Grade A</option>
                <option value="Grade B">Grade B</option>
                <option value="Grade C">Grade C</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fas fa-cloud-upload-alt"></i> Upload Batch
        </button>
    </form>
</div>
@endsection
