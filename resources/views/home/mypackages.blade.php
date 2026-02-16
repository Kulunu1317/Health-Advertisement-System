@extends('layouts.app')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="h4 mb-0">My Packages</h2>
        <a href="{{ route('packages.index') }}" class="btn btn-outline-primary">Browse Packages</a>
    </div>
    <div class="row">
        @forelse($purchases as $purchase)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100">
                    @if($purchase->package->image)
                        <img src="{{ asset($purchase->package->image) }}" class="card-img-top" alt="Package" style="height: 150px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $purchase->package->name }}</h5>
                        <p class="card-text">
                            Tier: <strong>{{ ucfirst($purchase->tier) }}</strong><br>
                            Price Paid: ${{ $purchase->price_paid }}<br>
                            Valid until: {{ $purchase->end_date->format('Y-m-d H:i') }}<br>
                            Ads posted: {{ $purchase->advertisements->count() }}/{{ $purchase->package->ad_limit }}
                        </p>
                        @if($purchase->advertisements->count() < $purchase->package->ad_limit)
                            <a href="{{ route('advertisements.create', $purchase) }}" class="btn btn-primary">Create Advertisement</a>
                        @else
                            <button class="btn btn-secondary" disabled>Ad Limit Reached</button>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info mb-0">You haven't purchased any packages yet. <a href="{{ route('packages.index') }}">Buy now</a>.</div>
            </div>
        @endforelse
    </div>
</div>
@endsection