@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center text-success fw-bold">☕ Upload Coffee Batch</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-success">
                <div class="card-body">
                    <form method="POST" action="{{ route('cooperative.batches.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="batch_name" class="form-label">Batch Name</label>
                            <input type="text" class="form-control" id="batch_name" name="batch_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity (KG)</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required min="1">
                        </div>

                        <div class="mb-3">
                            <label for="quality_grade" class="form-label">Quality Grade</label>
                            <select class="form-select" id="quality_grade" name="quality_grade" required>
                                <option value="" disabled selected>Select grade</option>
                                <option value="AA">AA</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-upload"></i> Upload Batch
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
