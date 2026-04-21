@extends('admin.layout')

@section('admin_title', 'Users')
@section('admin_subtitle', 'Browse registered accounts and inspect user details.')

@section('content')
<div class="page-title">Users Management</div>
<div class="page-subtitle">Monitor registered users and open full account details when needed.</div>

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="{{ route('users.show', $user) }}" class="btn btn-secondary">View</a>
                            <form method="POST" action="{{ route('users.destroy', $user) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 1.5rem 0; color: #7a7085;">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
