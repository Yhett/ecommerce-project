@extends('layout')

@section('title', 'My Orders - NextMart')

@section('content')
<style>
    .orders-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #e9d5ff 100%);
        border: 1px solid #e1bee7;
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 20px 40px rgba(156, 39, 176, 0.12);
        text-align: center;
    }

    .orders-hero h1 {
        color: #6a1b9a;
        font-weight: 800;
        font-size: clamp(2rem, 5vw, 2.8rem);
        margin-bottom: 0.5rem;
    }

    .orders-hero p {
        color: #7a5e93;
        font-size: 1.2rem;
        max-width: 500px;
        margin: 0 auto;
    }

    .order-card {
        background: white;
        border: 1px solid #f0e3f4;
        border-radius: 20px;
        box-shadow: 0 12px 32px rgba(156, 39, 176, 0.08);
        transition: all 0.3s ease;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .order-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 48px rgba(156, 39, 176, 0.15);
    }

    .order-header {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .order-id {
        font-weight: 700;
        font-size: 1.3rem;
    }

    .order-date {
        font-size: 0.95rem;
        opacity: 0.95;
    }

    .status-badge {
        padding: 0.5rem 1.2rem;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
    }

    .status-pending { background: rgba(255,193,7,0.2); color: #f57c00; }
    .status-confirmed { background: rgba(76,175,80,0.2); color: #388e3c; }
    .status-packed { background: rgba(33,150,243,0.2); color: #1976d2; }
    .status-out_for_delivery { background: rgba(156,39,176,0.2); color: #9c27b0; }

    .order-details {
        padding: 2rem;
    }

    .items-list {
        margin-bottom: 1.5rem;
    }

    .order-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f0e3f4;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .item-info h6 {
        color: #2f2340;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .item-meta {
        font-size: 0.9rem;
        color: #7a7085;
    }

    .order-total-row {
        border-top: 2px solid #f0e3f4;
        padding-top: 1rem;
        margin-top: 1rem;
        font-weight: 700;
        font-size: 1.25rem;
        color: #9c27b0;
        display: flex;
        justify-content: space-between;
    }

    .no-orders {
        text-align: center;
        padding: 4rem 2rem;
        color: #7a7085;
    }

    .no-orders i {
        font-size: 5rem;
        color: #e1bee7;
        margin-bottom: 1rem;
        display: block;
    }

    .pagination-custom {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        margin-top: 3rem;
    }

    .page-link-custom {
        border: 1px solid #e1bee7;
        background: white;
        color: #9c27b0;
        padding: 0.75rem 1rem;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .page-link-custom:hover {
        background: #f3e5f5;
        border-color: #ba68c8;
        transform: translateY(-1px);
    }

    .page-item.active .page-link-custom {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        color: white;
        border-color: #ba68c8;
    }

    @media (max-width: 768px) {
        .order-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .order-details {
            padding: 1.5rem;
        }
    }
</style>

<div class="orders-section">
    <div class="container mt-5 mb-5">
        <!-- Enhanced Header with Filters -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="orders-hero-badge me-3">
                        <i class="fas fa-boxes"></i>
                        <span>My Orders</span>
                    </div>
                    <div>
                        <h1 class="mb-1">{{ $orders->count() }} Order{{ $orders->count() !== 1 ? 's' : '' }}</h1>
                        <small class="text-muted">Manage and track your recent purchases</small>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex gap-2 justify-content-end">
                    <select class="form-select form-select-sm" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="shipped">Shipped</option>
                        <option value="delivered">Delivered</option>
                    </select>
                    <input type="date" class="form-control form-control-sm" id="dateFilter" style="width: 160px;">
                    <button class="btn btn-outline-purple btn-sm" id="clearFilters">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>
            </div>
        </div>

        @if($orders->count() > 0)
            @foreach($orders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order #{{ $order->id }}</div>
                            <div class="order-date">
                                <i class="fas fa-calendar me-1"></i> {{ $order->created_at->format('M d, Y h:i A') }}
                            </div>
                        </div>
                        <span class="status-badge status-{{ $order->status }}">
                            {{ ucwords(str_replace('_', ' ', $order->status)) }}
                        </span>
                    </div>
                    <!-- Order Timeline Progress -->
                    <div class="order-timeline px-4 pb-4">
                        <div class="timeline-steps">
                            <div class="step-item">
                                <div class="step-circle bg-gray-200">
                                    <i class="fas fa-check text-green-600"></i>
                                </div>
                                <div class="step-label">Order Confirmed</div>
                            </div>
                            <div class="step-item">
                                <div class="step-circle {{ $order->status == 'pending' || $order->status == 'confirmed' ? 'bg-yellow-200' : 'bg-gray-200' }}">
                                    <i class="fas fa-shipping-fast text-yellow-600"></i>
                                </div>
                                <div class="step-label">Processing</div>
                            </div>
                            <div class="step-item">
                                <div class="step-circle {{ $order->status == 'shipped' || $order->status == 'out_for_delivery' ? 'bg-blue-200' : 'bg-gray-200' }}">
                                    <i class="fas fa-truck text-blue-600"></i>
                                </div>
                                <div class="step-label">Shipped</div>
                            </div>
                            <div class="step-item">
                                <div class="step-circle {{ $order->status == 'delivered' ? 'bg-green-200' : 'bg-gray-200' }}">
                                    <i class="fas fa-home text-green-600"></i>
                                </div>
                                <div class="step-label">Delivered</div>
                            </div>
                        </div>
                    </div>

                    <div class="order-details">
                        <!-- Enhanced Items Table with Images -->
                        <div class="table-responsive mb-4">
                            <table class="table table-hover">
                                <tbody>
                                    @foreach($order->items as $item)
                                        <tr>
                                            <td width="80">
                                                <img src="{{ $item->product->image ? asset('storage/'.$item->product->image) : 'https://via.placeholder.com/60x60?text=P' }}" 
                                                     alt="{{ $item->product->name ?? 'Product' }}" 
                                                     class="rounded-2" style="width: 60px; height: 60px; object-fit: cover;">
                                            </td>
                                            <td>
                                                <h6 class="mb-1">{{ $item->product->name ?? 'Product' }}</h6>
                                                <small class="text-muted">{{ $item->variation ?? 'Standard' }}</small>
                                            </td>
                                            <td class="text-end">
                                                <div class="qty-badge px-2 py-1 bg-light rounded-pill">
                                                    {{ $item->quantity }}
                                                </div>
                                            </td>
                                            <td class="text-end fw-bold text-purple">
                                                PHP {{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="order-total-row">
                            <span>Total:</span>
                            <span>PHP {{ number_format($order->total_amount, 2) }}</span>
                        </div>
                        
                        <!-- Order Actions -->
                        <div class="row g-2 mt-3 pt-3 border-top">
                            <div class="col-md-3">
                                <button class="btn btn-outline-primary w-100 btn-sm">
                                    <i class="fas fa-sync-alt me-1"></i> Reorder
                                </button>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-info w-100 btn-sm">
                                    <i class="fas fa-map-marker-alt me-1"></i> Track
                                </button>
                            </div>
                            <div class="col-md-3">
                                <a href="#" class="btn btn-outline-secondary w-100 btn-sm">
                                    <i class="fas fa-download me-1"></i> Invoice
                                </a>
                            </div>
                            <div class="col-md-3">
                                <button class="btn btn-outline-warning w-100 btn-sm">
                                    <i class="fas fa-phone me-1"></i> Support
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination-custom">
                {{ $orders->links() }}
            </div>
        @else
            <div class="no-orders">
                <i class="fas fa-shopping-bag"></i>
                <h3>No Orders Yet</h3>
                <p>Your order history will appear here once you make your first purchase.</p>
                <a href="/products" class="btn btn-primary mt-3">Start Shopping</a>
            </div>
        @endif
    </div>
</div>

@endsection

