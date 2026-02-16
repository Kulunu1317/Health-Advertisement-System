@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
                <h2 class="h4 mb-3">Pending Advertisement Approvals</h2>
            <div class="card">
                <div class="card-body">
                    @if($pendingAds->count())
                            <div class="table-responsive">
                            <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Logo</th>
                                    <th>Medicine</th>
                                    <th>Type</th>
                                    <th>User</th>
                                    <th>Location</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingAds as $ad)
                                <tr>
                                    <td>
                                        @if($ad->company_logo)
                                            <img src="{{ asset($ad->company_logo) }}" style="width: 50px; height: 50px; object-fit: contain;">
                                        @else
                                            <i class="fas fa-image fa-2x"></i>
                                        @endif
                                    </td>
                                    <td>{{ $ad->medicine_name }}</td>
                                    <td>{{ $ad->medicine_type }}</td>
                                    <td>{{ $ad->user->name }}</td>
                                    <td>{{ $ad->location }}</td>
                                    <td>{{ Str::limit($ad->description, 50) }}</td>
                                    <td>
                                        <form action="{{ route('admin.advertisements.approve', $ad) }}" method="POST" style="display:inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('admin.advertisements.reject', $ad) }}" method="POST" style="display:inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject and delete this advertisement?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            </div>
                    @else
                        <p>No pending advertisement approvals.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection