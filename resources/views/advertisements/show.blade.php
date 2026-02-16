@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
            <div class="card">
                <div class="card-header">Advertisement Details</div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4 text-center">
                            @if($advertisement->company_logo)
                                <img src="{{ asset($advertisement->company_logo) }}" class="img-fluid rounded" style="max-height: 200px; object-fit: contain; background: #fbfdff;">
                            @else
                                <i class="fas fa-image fa-5x text-muted"></i>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3 class="h4 mb-3">{{ $advertisement->medicine_name }}</h3>
                            <p><strong>Type:</strong> {{ $advertisement->medicine_type }}</p>
                            <p><strong>Location:</strong> {{ $advertisement->location }}</p>
                            <p><strong>Posted by:</strong> {{ $advertisement->user->name }}</p>
                            <p><strong>Package:</strong> {{ $advertisement->purchase->package->name }} ({{ ucfirst($advertisement->purchase->tier) }})</p>
                            <p><strong>Expires at:</strong> {{ $advertisement->expires_at ? $advertisement->expires_at->format('Y-m-d H:i') : 'N/A' }}</p>
                            <p class="mb-1"><strong>Description:</strong></p>
                            <p class="text-muted mb-0">{{ $advertisement->description }}</p>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Home</a>
                </div>
            </div>
    </div>
</div>
@endsection