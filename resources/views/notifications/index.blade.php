@extends('layouts.app')
@section('content')
<div>
    <h2 class="h4 mb-3">Notifications</h2>
    <ul class="list-group list-group-flush rounded overflow-hidden border">
        @forelse(auth()->user()->notifications as $notification)
            <li class="list-group-item py-3 d-flex justify-content-between align-items-start gap-3">
                <span>{{ $notification->data['message'] ?? '' }}</span>
                <small class="text-muted text-nowrap">{{ $notification->created_at->diffForHumans() }}</small>
            </li>
        @empty
            <li class="list-group-item py-3">No notifications.</li>
        @endforelse
    </ul>
</div>
@endsection