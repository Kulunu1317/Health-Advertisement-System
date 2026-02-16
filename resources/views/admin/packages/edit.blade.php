@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Edit Package</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Package Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $package->name) }}" required>
                            @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description', $package->description) }}</textarea>
                            @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Package Image</label>
                            @if($package->image)
                                <div><img src="{{ asset($package->image) }}" style="max-height: 100px;"></div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                            @error('image') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $package->price) }}" required>
                                @error('price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="ad_limit" class="form-label">Ad Limit</label>
                                <input type="number" class="form-control @error('ad_limit') is-invalid @enderror" id="ad_limit" name="ad_limit" value="{{ old('ad_limit', $package->ad_limit) }}" required>
                                @error('ad_limit') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="validity_minutes" class="form-label">Validity (minutes)</label>
                            <input type="number" class="form-control @error('validity_minutes') is-invalid @enderror" id="validity_minutes" name="validity_minutes" value="{{ old('validity_minutes', $package->validity_minutes) }}" required>
                            @error('validity_minutes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <hr>
                        <h5>Advanced Pricing</h5>
                        <div class="mb-3">
                            <label for="silver_price" class="form-label">Silver Price ($)</label>
                            <input type="number" step="0.01" class="form-control @error('silver_price') is-invalid @enderror" id="silver_price" name="silver_price" value="{{ old('silver_price', $package->silver_price) }}">
                            @error('silver_price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gold_price" class="form-label">Gold Price ($)</label>
                            <input type="number" step="0.01" class="form-control @error('gold_price') is-invalid @enderror" id="gold_price" name="gold_price" value="{{ old('gold_price', $package->gold_price) }}">
                            @error('gold_price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="diamond_price" class="form-label">Diamond Price ($)</label>
                            <input type="number" step="0.01" class="form-control @error('diamond_price') is-invalid @enderror" id="diamond_price" name="diamond_price" value="{{ old('diamond_price', $package->diamond_price) }}">
                            @error('diamond_price') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Package</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection