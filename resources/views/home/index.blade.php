@extends('layouts.app')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <div>
            <h1 class="h3 mb-1">Welcome to Health Ads</h1>
            <p class="text-muted mb-0">Browse approved advertisements from verified users.</p>
        </div>
    </div>

    <h2 class="h5 fw-semibold mb-3">Approved Advertisements</h2>
    @forelse($groupedAds as $tier => $ads)
        <div class="mb-4">
            <h3 class="h6 fw-bold text-uppercase mb-3">{{ ucfirst($tier) }} Tier Ads</h3>
            <div class="row">
                @foreach($ads as $ad)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            @if($ad->company_logo)
                                <img src="{{ asset($ad->company_logo) }}" class="card-img-top p-3" alt="Logo" style="height: 170px; object-fit: contain; background: #fbfdff;">
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title mb-2">{{ $ad->medicine_name }}</h5>
                                <p class="card-text mb-2">
                                    <strong>Type:</strong> {{ $ad->medicine_type }}<br>
                                    <strong>Location:</strong> {{ $ad->location }}<br>
                                    <strong>Package:</strong> {{ $ad->purchase->package->name ?? 'N/A' }}
                                    @if($ad->purchase && $ad->purchase->tier != 'normal')
                                        <span class="badge bg-{{ $ad->purchase->tier }}">{{ ucfirst($ad->purchase->tier) }}</span>
                                    @endif
                                </p>
                                <p class="card-text text-muted">{{ Str::limit($ad->description, 100) }}</p>
                                <div class="mt-auto">
                                    <small class="text-muted d-block mb-2">Posted by: {{ $ad->user->name }}</small>
                                    @if($ad->user_id == Auth::id())
                                        <a href="{{ route('advertisements.edit_time', $ad) }}" class="btn btn-sm btn-warning">Update Time</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @empty
        <div class="alert alert-info">No approved advertisements yet.</div>
    @endforelse
</div>
@endsection