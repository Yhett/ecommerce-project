@extends('admin.layout')

@section('admin_title', 'Dashboard')
@section('admin_subtitle', 'A quick overview of your store performance and management shortcuts.')

@section('content')
<style>
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: white;
        border: 1px solid #ebdff1;
        border-radius: 24px;
        padding: 1.4rem;
        box-shadow: 0 18px 40px rgba(82, 36, 102, 0.08);
    }

    .stat-label {
        color: #7a7085;
        font-size: 0.92rem;
        margin-bottom: 0.6rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #2e2238;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 1rem;
    }

    .quick-actions {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .insight-list {
        display: grid;
        gap: 0.85rem;
        margin-top: 1rem;
    }

    .insight-item {
        padding: 1rem;
        border-radius: 18px;
        background: #faf6fc;
        border: 1px solid #ebdff1;
    }

    .insight-item strong {
        display: block;
        color: #6a1b9a;
        margin-bottom: 0.25rem;
    }

    @media (max-width: 992px) {
        .stats-grid,
        .dashboard-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-label">Total Products</div>
        <div class="stat-value">{{ $totalProducts }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Users</div>
        <div class="stat-value">{{ $totalUsers }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Cart Items</div>
        <div class="stat-value">{{ $totalCartItems }}</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Featured Products</div>
        <div class="stat-value">{{ $featuredProducts }}</div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card">
        <div class="page-title" style="font-size:1.35rem;">Quick Actions</div>
        <div class="page-subtitle">Jump into the most common admin tasks.</div>

        <div class="quick-actions">
            <a href="/admin/products" class="btn">Manage Products</a>
            <a href="/admin/products/create" class="btn">Add Product</a>
            <a href="/admin/users" class="btn btn-secondary">View Users</a>
            <a href="/admin/orders" class="btn btn-secondary">Manage Orders</a>
        </div>
    </div>

    <div class="card">
        <div class="page-title" style="font-size:1.35rem;">Store Insights</div>
        <div class="page-subtitle">A simple summary of current admin data.</div>

        <div class="insight-list">
            <div class="insight-item">
                <strong>{{ $featuredProducts }}</strong>
                Featured items are currently highlighted in the storefront.
            </div>
            <div class="insight-item">
                <strong>{{ $totalUsers }}</strong>
                Registered users can browse, manage profiles, and receive updates.
            </div>
            <div class="insight-item">
                <strong>{{ $totalCartItems }}</strong>
                Items are currently sitting in customer carts.
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 1rem;">
    <div class="page-title" style="font-size:1.35rem;">Recent Admin Notifications</div>
    <div class="page-subtitle">Updates triggered by cart activity and new customer orders.</div>

    @forelse($recentNotifications as $notification)
        <div style="padding: 1rem 0; border-top: 1px solid #ebdff1;">
            <div style="font-weight: 600; color: #6a1b9a;">{{ $notification->title }}</div>
            <div style="color: #7a7085; margin: 0.25rem 0;">{{ $notification->message }}</div>
            <div style="font-size: 0.9rem; color: #9c27b0;">{{ $notification->created_at->diffForHumans() }}</div>
        </div>
    @empty
        <div style="color: #7a7085;">No admin notifications yet.</div>
    @endforelse
</div>
@endsection
