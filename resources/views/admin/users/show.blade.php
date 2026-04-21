@extends('admin.layout')

@section('admin_title', 'User Details')
@section('admin_subtitle', 'View a closer summary of this registered account.')

@section('content')
<div class="page-title">User Details</div>
<div class="page-subtitle">A quick profile summary for this user account.</div>

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div style="display:grid; gap:1rem;">
        <div>
            <div style="color:#7a7085; font-size:0.92rem;">Full Name</div>
            <div style="font-weight:600; font-size:1.1rem;">{{ $user->name }}</div>
        </div>
        <div>
            <div style="color:#7a7085; font-size:0.92rem;">Email Address</div>
            <div>{{ $user->email }}</div>
        </div>
        <div>
            <div style="color:#7a7085; font-size:0.92rem;">Joined</div>
            <div>{{ $user->created_at->format('F j, Y') }}</div>
        </div>
        <div>
            <div style="color:#7a7085; font-size:0.92rem;">Last Updated</div>
            <div>{{ $user->updated_at->format('F j, Y') }}</div>
        </div>
    </div>
</div>

<div style="margin-top:1rem; display:flex; gap:0.75rem; flex-wrap:wrap;">
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to Users</a>
    <form method="POST" action="{{ route('users.destroy', $user) }}">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete User</button>
    </form>
</div>
@endsection
