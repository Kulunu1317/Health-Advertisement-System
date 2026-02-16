@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Create Advertisement for "{{ $purchase->package->name }}"</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('advertisements.store', $purchase) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="medicine_name" class="form-label">Medicine Name</label>
                            <input type="text" class="form-control @error('medicine_name') is-invalid @enderror" id="medicine_name" name="medicine_name" value="{{ old('medicine_name') }}" required>
                            @error('medicine_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="medicine_type" class="form-label">Medicine Type</label>
                            <input type="text" class="form-control @error('medicine_type') is-invalid @enderror" id="medicine_type" name="medicine_type" value="{{ old('medicine_type') }}" required>
                            @error('medicine_type') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="company_logo" class="form-label">Company Logo</label>
                            <input type="file" class="form-control @error('company_logo') is-invalid @enderror" id="company_logo" name="company_logo" accept="image/*">
                            @error('company_logo') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{ old('location') }}" required>
                            @error('location') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('mypackages') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit for Approval</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection