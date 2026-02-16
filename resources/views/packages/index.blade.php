@extends('layouts.app')
@section('content')
<div>
    <h2 class="h4 mb-3">Available Packages</h2>
    <div class="row">
        @foreach($packages as $package)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card h-100">
                @if($package->image)
                    <img src="{{ asset($package->image) }}" class="card-img-top" alt="Package" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $package->name }}</h5>
                    <p class="card-text text-muted">{{ $package->description }}</p>
                    <p class="mb-1"><strong>Price:</strong> ${{ $package->price }}</p>
                    <p class="mb-1"><strong>Ad Limit:</strong> {{ $package->ad_limit }}</p>
                    <p class="mb-3"><strong>Validity:</strong> {{ $package->validity_minutes }} minutes</p>

                    <form action="{{ route('packages.buy', $package) }}" method="POST">
                        @csrf
                        @if($package->silver_price)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tier" id="silver{{ $package->id }}" value="silver">
                                <label class="form-check-label" for="silver{{ $package->id }}">
                                    Silver - ${{ $package->silver_price }}
                                </label>
                            </div>
                        @endif
                        @if($package->gold_price)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tier" id="gold{{ $package->id }}" value="gold">
                                <label class="form-check-label" for="gold{{ $package->id }}">
                                    Gold - ${{ $package->gold_price }}
                                </label>
                            </div>
                        @endif
                        @if($package->diamond_price)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tier" id="diamond{{ $package->id }}" value="diamond">
                                <label class="form-check-label" for="diamond{{ $package->id }}">
                                    Diamond - ${{ $package->diamond_price }}
                                </label>
                            </div>
                        @endif
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tier" id="normal{{ $package->id }}" value="normal" checked>
                            <label class="form-check-label" for="normal{{ $package->id }}">
                                Normal - ${{ $package->price }}
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-100">Buy</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection