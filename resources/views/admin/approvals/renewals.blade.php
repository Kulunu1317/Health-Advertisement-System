@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="h4 mb-3">Package Renewal Requests</h2>
            <div class="card">
                <div class="card-body">
                    @if($pendingRenewals->count())
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Package</th>
                                        <th>Tier</th>
                                        <th>Current Expiry</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingRenewals as $req)
                                    <tr>
                                        <td>{{ $req->user->name }}</td>
                                        <td>{{ $req->purchase->package->name }}</td>
                                        <td>{{ ucfirst($req->purchase->tier) }}</td>
                                        <td>{{ $req->purchase->end_date->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <form action="{{ route('admin.renewals.approve', $req) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.renewals.reject', $req) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">Reject</button>
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
    </div>
</div>
@endsection