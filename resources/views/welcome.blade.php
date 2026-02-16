@extends('layouts.app')
@section('content')
<div class="py-4 py-md-5 text-center">
    <h1 class="display-5 fw-bold mb-3">Welcome to HealthAds</h1>
    <p class="lead text-muted mb-4">Your trusted platform for health-related advertisements.</p>
    @guest
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg me-2 mb-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg mb-2">Register</a>
    @else
        <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Home</a>
    @endguest
</div>
@endsection