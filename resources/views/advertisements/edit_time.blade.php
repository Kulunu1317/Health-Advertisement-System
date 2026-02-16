@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
            <div class="card">
                <div class="card-header">Request Time Extension for "{{ $advertisement->medicine_name }}"</div>
                <div class="card-body">
                    <p class="text-muted">Current expiry: {{ $advertisement->expires_at->format('Y-m-d H:i') }}</p>
                    <form method="POST" action="{{ route('advertisements.request_extension', $advertisement) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="extension_minutes" class="form-label">Extension (minutes)</label>
                            <input type="number" class="form-control @error('extension_minutes') is-invalid @enderror" id="extension_minutes" name="extension_minutes" min="1" required>
                            @error('extension_minutes') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="d-flex justify-content-between gap-2">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
    </div>
</div>
@endsection