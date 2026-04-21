@extends('layout')

@section('content')

<style>
    .success-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .success-card {
        background: white;
        border: 2px solid #4caf50;
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        max-width: 500px;
        box-shadow: 0 12px 40px rgba(76, 175, 80, 0.15);
    }

    .success-icon {
        font-size: 4rem;
        color: #4caf50;
        margin-bottom: 1.5rem;
        animation: bounce 0.6s ease-in-out;
    }

    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .success-title {
        color: #2f2340;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .success-message {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .order-details {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #edd8f4;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #6c757d;
        font-weight: 500;
    }

    .detail-value {
        color: #2f2340;
        font-weight: 600;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
    }

    .btn-primary, .btn-secondary, .btn-success {
        flex: 1;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        color: white;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(156, 39, 176, 0.3);
    }

    .btn-secondary {
        background: white;
        color: #6a1b9a;
        border: 2px solid #ba68c8;
    }

    .btn-secondary:hover {
        background: #f7e8fb;
    }

    .btn-success {
        background: #4caf50;
        color: white;
        border: none;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(76, 175, 80, 0.3);
    }

    @media (max-width: 768px) {
        .success-card {
            padding: 2rem 1.5rem;
        }

        .success-icon {
            font-size: 3rem;
        }

        .success-title {
            font-size: 1.5rem;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>

<div class="success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fa-solid fa-circle-check"></i>
        </div>
        <h1 class="success-title">Order Confirmed!</h1>
        <p class="success-message">
            Thank you for your purchase. Your order has been confirmed and will be processed soon.
        </p>

        <div class="order-details">
            <div class="detail-row">
                <span class="detail-label">Order Number</span>
                <span class="detail-value">#{{ $order->id }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Payment Method</span>
                <span class="detail-value">{{ strtoupper($order->payment_method) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Order Status</span>
                <span class="detail-value">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Total Amount</span>
                <span class="detail-value">PHP {{ number_format($order->total_amount, 2) }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Items Count</span>
                <span class="detail-value">{{ $order->items->count() }}</span>
            </div>
        </div>

        <div class="btn-group">
            <a href="/products" class="btn-secondary">Continue Shopping</a>
            <a href="{{ route('payment.receipt', $order->id) }}" class="btn-success" target="_blank">
                <i class="fa-solid fa-download"></i> Download e-Receipt
            </a>
        </div>

        <p style="color: #6c757d; margin-top: 2rem; font-size: 0.9rem;">
            Confirmation details sent to {{ $order->user->email }}
        </p>
    </div>
</div>

@endsection
