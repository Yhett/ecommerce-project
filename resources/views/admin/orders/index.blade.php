@extends('admin.layout')

@section('admin_title', 'Orders')
@section('admin_subtitle', 'Track placed orders and update users when progress changes.')

@section('content')
<div class="page-title">Order Management</div>
<div class="page-subtitle">Review customer orders and send status updates like confirmed, packed, and out for delivery.</div>

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>User</th>
                <th>Items</th>
                <th>Total</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? 'User' }}</td>
                    <td>
                        @foreach($order->items as $item)
                            <div>{{ $item->quantity }} x {{ $item->product_name }}</div>
                        @endforeach
                    </td>
                    <td>PHP {{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ ucwords(str_replace('_', ' ', $order->status)) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.orders.update', $order) }}" style="display:flex; gap:0.5rem; flex-wrap:wrap; align-items:center;">
                            @csrf
                            @method('PATCH')
                            <select name="status" style="margin-bottom:0; min-width:180px;">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="packed" {{ $order->status === 'packed' ? 'selected' : '' }}>Packed</option>
                                <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for delivery</option>
                            </select>
                            <button type="submit" class="btn">Save</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 1.5rem 0; color: #7a7085;">No orders have been placed yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
