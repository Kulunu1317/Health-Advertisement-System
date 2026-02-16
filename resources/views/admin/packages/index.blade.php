@extends('layouts.app')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
        <h2 class="h4 mb-0">Manage Packages</h2>
        <a href="{{ route('admin.packages.create') }}" class="btn btn-success">Create New Package</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
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
                                <a href="{{ route('admin.packages.edit', $package) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection