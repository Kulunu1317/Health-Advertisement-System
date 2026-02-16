@extends('layouts.app')
@section('content')
<div>
    <h2 class="h4 mb-4"><i class="fas fa-tachometer-alt"></i> Admin Dashboard</h2>

    <!-- Statistics Cards -->
    <div class="row g-3">
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Pending Users</h6>
                            <h2 class="display-6">{{ $pendingUsers->count() }}</h2>
                        </div>
                        <i class="fas fa-users fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Pending Ads</h6>
                            <h2 class="display-6">{{ $pendingAds->count() }}</h2>
                        </div>
                        <i class="fas fa-ad fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Renewal Requests</h6>
                            <h2 class="display-6">{{ $pendingRenewals->count() }}</h2>
                        </div>
                        <i class="fas fa-sync-alt fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary mb-3 shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title">Time Extensions</h6>
                            <h2 class="display-6">{{ $pendingExtensions->count() }}</h2>
                        </div>
                        <i class="fas fa-hourglass-half fa-3x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <i class="fas fa-bolt"></i> Quick Actions
                </div>
                <div class="card-body">
                    <a href="{{ route('admin.packages.create') }}" class="btn btn-lg btn-success me-2">
                        <i class="fas fa-plus-circle"></i> Create New Package
                    </a>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-lg btn-outline-primary">
                        <i class="fas fa-boxes"></i> Manage All Packages
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Existing Packages List -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-box"></i> Existing Packages
                </div>
                <div class="card-body">
                    @php
                        $packages = App\Models\Package::latest()->take(5)->get();
                    @endphp
                    @if($packages->count())
                        <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Ad Limit</th>
                                    <th>Validity (min)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($packages as $package)
                                <tr>
                                    <td>
                                        @if($package->image)
                                            <img src="{{ asset($package->image) }}" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                        @else
                                            <i class="fas fa-box fa-2x text-muted"></i>
                                        @endif
                                    </td>
                                    <td>{{ $package->name }}</td>
                                    <td>${{ $package->price }}</td>
                                    <td>{{ $package->ad_limit }}</td>
                                    <td>{{ $package->validity_minutes }}</td>
                                    <td>
                                        <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this package? It will affect users who bought it.')">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-link">View All Packages <i class="fas fa-arrow-right"></i></a>
                    @else
                        <p class="text-muted">No packages created yet. <a href="{{ route('admin.packages.create') }}">Create one now</a>.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Users and Ads -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <i class="fas fa-user-clock"></i> Pending Users
                </div>
                <div class="card-body">
                    @if($pendingUsers->count())
                        <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr><th>Name</th><th>Email</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUsers as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('admin.users.reject', $user) }}" method="POST" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject and delete?')"><i class="fas fa-times"></i> Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No pending users.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-warning">
                    <i class="fas fa-ad"></i> Pending Advertisements
                </div>
                <div class="card-body">
                    @if($pendingAds->count())
                        <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr><th>Medicine</th><th>User</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($pendingAds as $ad)
                                <tr>
                                    <td>{{ $ad->medicine_name }}</td>
                                    <td>{{ $ad->user->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.advertisements.approve', $ad) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('admin.advertisements.reject', $ad) }}" method="POST" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject and delete?')"><i class="fas fa-times"></i> Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No pending ads.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Renewal and Extension Requests -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-redo-alt"></i> Renewal Requests
                </div>
                <div class="card-body">
                    @if($pendingRenewals->count())
                        <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr><th>User</th><th>Package</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($pendingRenewals as $req)
                                <tr>
                                    <td>{{ $req->user->name }}</td>
                                    <td>{{ $req->purchase->package->name }}</td>
                                    <td>
                                        <form action="{{ route('admin.renewals.approve', $req) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('admin.renewals.reject', $req) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No renewal requests.</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <i class="fas fa-hourglass-start"></i> Time Extension Requests
                </div>
                <div class="card-body">
                    @if($pendingExtensions->count())
                        <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr><th>User</th><th>Ad</th><th>Minutes</th><th>Actions</th></tr>
                            </thead>
                            <tbody>
                                @foreach($pendingExtensions as $req)
                                <tr>
                                    <td>{{ $req->user->name }}</td>
                                    <td>{{ $req->advertisement->medicine_name }}</td>
                                    <td>{{ $req->extension_minutes }}</td>
                                    <td>
                                        <form action="{{ route('admin.extensions.approve', $req) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i> Approve</button>
                                        </form>
                                        <form action="{{ route('admin.extensions.reject', $req) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-times"></i> Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    @else
                        <p>No time extension requests.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection