@extends('admin.layout')

@section('admin_title', 'Orders')
@section('admin_subtitle', 'Track placed orders and update users when progress changes.')

@section('content')
@php
    $pendingCount = $orders->where('status', 'pending')->count();
    $confirmedCount = $orders->where('status', 'confirmed')->count();
    $packedCount = $orders->where('status', 'packed')->count();
    $deliveryCount = $orders->where('status', 'out_for_delivery')->count();
    $totalRevenue = $orders->sum('total_amount');
@endphp

<style>
    .orders-shell {
        display: grid;
        gap: 1.25rem;
    }

    .orders-hero {
        position: relative;
        overflow: hidden;
        padding: 1.8rem;
        border-radius: 28px;
        background:
            radial-gradient(circle at top right, rgba(255, 255, 255, 0.42), transparent 28%),
            linear-gradient(135deg, #2a1737 0%, #6a1b9a 58%, #c76cdb 100%);
        color: white;
        box-shadow: 0 24px 44px rgba(82, 36, 102, 0.18);
    }

    .orders-hero::after {
        content: '';
        position: absolute;
        inset: auto -40px -60px auto;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .orders-hero-content {
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        gap: 1.25rem;
        align-items: flex-end;
    }

    .orders-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.55rem;
        padding: 0.5rem 0.8rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        font-size: 0.88rem;
        margin-bottom: 1rem;
    }

    .orders-hero h1 {
        font-size: 2rem;
        margin-bottom: 0.45rem;
    }

    .orders-hero p {
        max-width: 620px;
        color: rgba(255, 255, 255, 0.84);
        line-height: 1.6;
    }

    .orders-hero-metric {
        min-width: 220px;
        padding: 1rem 1.15rem;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(10px);
    }

    .orders-hero-metric-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.72);
        margin-bottom: 0.4rem;
    }

    .orders-hero-metric-value {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .orders-summary {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 1rem;
    }

    .summary-card {
        padding: 1.2rem 1.25rem;
        border-radius: 22px;
        border: 1px solid #ebdff1;
        background: linear-gradient(180deg, #ffffff 0%, #fcf8fe 100%);
        box-shadow: 0 18px 32px rgba(82, 36, 102, 0.08);
    }

    .summary-label {
        color: #7a7085;
        font-size: 0.88rem;
        margin-bottom: 0.6rem;
    }

    .summary-value {
        font-size: 1.7rem;
        font-weight: 700;
        color: #2e2238;
    }

    .summary-hint {
        margin-top: 0.35rem;
        color: #9c27b0;
        font-size: 0.85rem;
    }

    .orders-board {
        padding: 0;
        overflow: hidden;
    }

    .orders-board-head {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        padding: 1.35rem 1.5rem 1rem;
    }

    .orders-board-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2e2238;
        margin-bottom: 0.2rem;
    }

    .orders-board-copy {
        color: #7a7085;
        font-size: 0.92rem;
    }

    .orders-board-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.65rem 0.9rem;
        border-radius: 999px;
        background: #f8effb;
        color: #7a2aa1;
        font-weight: 600;
        font-size: 0.88rem;
    }

    .orders-table-wrap {
        overflow-x: auto;
        padding: 0 1.1rem 1.1rem;
    }

    .orders-table {
        min-width: 1100px;
    }

    .orders-table th {
        padding: 0.85rem 0.85rem 1rem;
        font-size: 0.8rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .orders-table td {
        padding: 1rem 0.85rem;
        vertical-align: top;
    }

    .orders-table tbody tr {
        transition: background 0.2s ease;
    }

    .orders-table tbody tr:hover {
        background: #fcf8fe;
    }

    .order-id {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        font-weight: 700;
        color: #2e2238;
        margin-bottom: 0.35rem;
    }

    .order-meta {
        color: #7a7085;
        font-size: 0.88rem;
        line-height: 1.5;
    }

    .user-block,
    .shipping-block {
        display: grid;
        gap: 0.35rem;
    }

    .user-name,
    .shipping-main {
        font-weight: 600;
        color: #2e2238;
        line-height: 1.45;
    }

    .user-sub,
    .shipping-sub {
        color: #7a7085;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .items-stack {
        display: grid;
        gap: 0.55rem;
    }

    .item-chip {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 0.8rem;
        padding: 0.75rem 0.9rem;
        border-radius: 16px;
        background: #faf6fc;
        border: 1px solid #eee1f3;
    }

    .item-name {
        color: #2e2238;
        font-weight: 600;
        line-height: 1.4;
    }

    .item-qty {
        white-space: nowrap;
        font-size: 0.82rem;
        font-weight: 600;
        color: #7a2aa1;
        background: #f3e4f8;
        padding: 0.35rem 0.55rem;
        border-radius: 999px;
    }

    .total-amount {
        font-size: 1.05rem;
        font-weight: 700;
        color: #2e2238;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.55rem 0.8rem;
        border-radius: 999px;
        font-size: 0.84rem;
        font-weight: 700;
        text-transform: capitalize;
        white-space: nowrap;
    }

    .status-pending {
        background: #fff3cd;
        color: #8a5b00;
    }

    .status-confirmed {
        background: #e5f4ff;
        color: #0f5b93;
    }

    .status-packed {
        background: #efe7ff;
        color: #6941c6;
    }

    .status-out_for_delivery {
        background: #e8fff2;
        color: #0f8a4b;
    }

    .status-form {
        display: grid;
        gap: 0.65rem;
        min-width: 150px;
    }

    .status-form select {
        margin-bottom: 0;
        background: white;
    }

    .status-form button {
        width: 100%;
    }

    .empty-orders {
        text-align: center;
        padding: 3rem 1rem !important;
        color: #7a7085;
    }

    .empty-orders i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 62px;
        height: 62px;
        border-radius: 18px;
        background: #f8effb;
        color: #9c27b0;
        margin-bottom: 0.9rem;
        font-size: 1.4rem;
    }

    @media (max-width: 1200px) {
        .orders-summary {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 992px) {
        .orders-hero-content,
        .orders-board-head {
            flex-direction: column;
            align-items: flex-start;
        }

        .orders-hero-metric {
            width: 100%;
        }
    }

    @media (max-width: 640px) {
        .orders-summary {
            grid-template-columns: 1fr;
        }

        .orders-hero {
            padding: 1.4rem;
        }

        .orders-hero h1 {
            font-size: 1.65rem;
        }

        .orders-board-head {
            padding: 1.15rem 1.15rem 0.85rem;
        }

        .orders-table-wrap {
            padding: 0 0.85rem 0.85rem;
        }
    }
</style>

<div class="orders-shell">
    <div class="page-title">Order Management</div>
    <div class="page-subtitle">Review customer orders, shipping details, and fulfillment progress from one workspace.</div>

    @if(session('success'))
        <div class="flash-success">{{ session('success') }}</div>
    @endif

    <section class="orders-hero">
        <div class="orders-hero-content">
            <div>
                <div class="orders-kicker">
                    <i class="fas fa-truck-fast"></i>
                    <span>Fulfillment Overview</span>
                </div>
                <h1>Keep every order moving.</h1>
                <p>Monitor customer details, spot fulfillment bottlenecks quickly, and update statuses with less friction for your team.</p>
            </div>

            <div class="orders-hero-metric">
                <div class="orders-hero-metric-label">Total order value</div>
                <div class="orders-hero-metric-value">PHP {{ number_format($totalRevenue, 2) }}</div>
            </div>
        </div>
    </section>

    <section class="orders-summary">
        <div class="summary-card">
            <div class="summary-label">All Orders</div>
            <div class="summary-value">{{ $orders->count() }}</div>
            <div class="summary-hint">Total placed so far</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Pending</div>
            <div class="summary-value">{{ $pendingCount }}</div>
            <div class="summary-hint">Needs confirmation</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Confirmed</div>
            <div class="summary-value">{{ $confirmedCount }}</div>
            <div class="summary-hint">Ready for prep</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Packed</div>
            <div class="summary-value">{{ $packedCount }}</div>
            <div class="summary-hint">Waiting for dispatch</div>
        </div>
        <div class="summary-card">
            <div class="summary-label">Out for Delivery</div>
            <div class="summary-value">{{ $deliveryCount }}</div>
            <div class="summary-hint">Currently on the road</div>
        </div>
    </section>

    <section class="card orders-board">
        <div class="orders-board-head">
            <div>
                <div class="orders-board-title">Live Order Queue</div>
                <div class="orders-board-copy">A cleaner view of customer, shipping, item, and status information for each order.</div>
            </div>
            <div class="orders-board-pill">
                <i class="fas fa-layer-group"></i>
                <span>{{ $orders->count() }} active record{{ $orders->count() === 1 ? '' : 's' }}</span>
            </div>
        </div>

        <div class="orders-table-wrap">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Customer</th>
                        <th>Shipping</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <div class="order-id">
                                    <i class="fas fa-receipt" style="color: #9c27b0;"></i>
                                    <span>#{{ $order->id }}</span>
                                </div>
                                <div class="order-meta">
                                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                                    <div>{{ $order->created_at->format('h:i A') }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="user-block">
                                    <div class="user-name">{{ $order->user->name ?? 'User' }}</div>
                                    <div class="user-sub">{{ $order->user->email ?? 'No email provided' }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="shipping-block">
                                    <div class="shipping-main">{{ $order->user->address ?? 'No shipping address provided' }}</div>
                                    <div class="shipping-sub">Phone: {{ $order->user->phone ?? 'No phone provided' }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="items-stack">
                                    @foreach($order->items as $item)
                                        <div class="item-chip">
                                            <span class="item-name">{{ $item->product_name }}</span>
                                            <span class="item-qty">x{{ $item->quantity }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>
                                <div class="total-amount">PHP {{ number_format($order->total_amount, 2) }}</div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $order->status }}">
                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="status-form">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status">
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="packed" {{ $order->status === 'packed' ? 'selected' : '' }}>Packed</option>
                                        <option value="out_for_delivery" {{ $order->status === 'out_for_delivery' ? 'selected' : '' }}>Out for delivery</option>
                                    </select>
                                    <button type="submit" class="btn">
                                        <i class="fas fa-save"></i>
                                        <span>Save Status</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="empty-orders">
                                <i class="fas fa-box-open"></i>
                                <div style="font-weight: 600; color: #2e2238; margin-bottom: 0.3rem;">No orders have been placed yet.</div>
                                <div>The order queue will appear here once customers begin checking out.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
