@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="h4 mb-3">Pending User Approvals</h2>
            <div class="card">
                <div class="card-body">
                    @if($pendingUsers->count())
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Birthday</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUsers as $user)
                                    <tr>
                                        <td>
                                            @if($user->profile_photo)
                                                <img src="{{ asset($user->profile_photo) }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                            @else
                                                <i class="fas fa-user-circle fa-2x"></i>
                                            @endif
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telephone }}</td>
                                        <td>{{ $user->birthday ? $user->birthday->format('Y-m-d') : '' }}</td>
                                        <td>
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" style="display:inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user) }}" method="POST" style="display:inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject and delete this user?')">Reject</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p>No pending user approvals.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection