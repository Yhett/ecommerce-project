@extends('layout')

@section('content')
<style>
    .cart-page {
        padding-bottom: 2rem;
    }

    .cart-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 28px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 18px 40px rgba(156, 39, 176, 0.08);
    }

    .cart-hero h1 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 0.45rem;
    }

    .cart-hero p {
        color: #6c757d;
        margin-bottom: 0;
    }

    .cart-card,
    .summary-card {
        background: white;
        border: 1px solid #edd8f4;
        border-radius: 24px;
        box-shadow: 0 12px 28px rgba(156, 39, 176, 0.08);
    }

    .cart-card {
        padding: 1.25rem;
    }

    .cart-item {
        display: grid;
        grid-template-columns: 110px 1fr auto;
        gap: 1rem;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid #f0e3f4;
    }

    .cart-item:last-child {
        border-bottom: none;
    }

    .cart-item-image {
        width: 110px;
        height: 110px;
        border-radius: 18px;
        object-fit: cover;
        box-shadow: 0 8px 18px rgba(156, 39, 176, 0.12);
    }

    .cart-item h5 {
        color: #2f2340;
        font-weight: 700;
        margin-bottom: 0.35rem;
    }

    .cart-meta,
    .cart-variation {
        color: #6c757d;
        margin-bottom: 0.35rem;
    }

    .cart-price {
        color: #9c27b0;
        font-size: 1rem;
        font-weight: 700;
    }

    .cart-actions {
        text-align: right;
        min-width: 140px;
    }

    .cart-subtotal {
        color: #2f2340;
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .summary-card {
        padding: 1.5rem;
        position: sticky;
        top: 100px;
    }

    .summary-card h3 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #6c757d;
        margin-bottom: 0.8rem;
    }

    .summary-total {
        font-size: 1.15rem;
        font-weight: 700;
        color: #2f2340;
        border-top: 1px solid #f0e3f4;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .btn-checkout {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        border: none;
        color: white;
        font-weight: 700;
        border-radius: 16px;
        padding: 0.85rem 1rem;
        width: 100%;
        box-shadow: 0 10px 22px rgba(156, 39, 176, 0.2);
    }

    .btn-remove {
        border-radius: 12px;
        padding: 0.45rem 0.8rem;
    }

    .empty-cart {
        text-align: center;
        padding: 3rem 1.5rem;
    }

    .empty-cart i {
        font-size: 3rem;
        color: #ba68c8;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .cart-item {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .cart-item-image {
            margin: 0 auto;
        }

        .cart-actions {
            text-align: center;
        }

        .summary-card {
            position: static;
        }
    }
</style>

<div class="cart-page">
    <section class="cart-hero">
        <h1>Your Cart</h1>
        <p>Review your selected items, check your totals, and continue to checkout when you're ready.</p>
    </section>

    @php
        $total = 0;
        $cartCount = $cart->sum('quantity');
    @endphp

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-card">
                @if(session('success'))
                    <div class="alert alert-success rounded-4">{{ session('success') }}</div>
                @endif

                @if($cart->isEmpty())
                    <div class="empty-cart">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <h4 class="mb-2">Your cart is empty</h4>
                        <p class="text-muted mb-3">Looks like you have not added anything yet.</p>
                        <a href="/products" class="btn btn-outline-dark">Browse Products</a>
                    </div>
                @else
                    @foreach($cart as $item)
                        @php
                            $unitPrice = $item->product->price ?? 0;
                            $quantity = $item->quantity ?? 1;
                            $subtotal = $unitPrice * $quantity;
                            $total += $subtotal;
                        @endphp

                        <div class="cart-item">
                            <div>
                                <img
                                    src="{{ $item->product && $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/300x300?text=Product' }}"
                                    class="cart-item-image"
                                    alt="{{ $item->product->name ?? 'Product' }}"
                                >
                            </div>

                            <div>
                                <h5>{{ $item->product->name ?? 'Product unavailable' }}</h5>
                                <div class="cart-price">PHP {{ number_format($unitPrice, 2) }}</div>
                                <div class="cart-meta">Quantity: <strong>{{ $quantity }}</strong></div>
                                @if(!empty($item->variation))
                                    <div class="cart-variation">Variation: {{ $item->variation }}</div>
                                @endif
                            </div>

                            <div class="cart-actions">
                                <div class="cart-subtotal">PHP {{ number_format($subtotal, 2) }}</div>
                                <a href="/cart/remove/{{ $item->id }}" class="btn btn-outline-danger btn-sm btn-remove">Remove</a>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="col-lg-4">
            <div class="summary-card">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Items</span>
                    <span>{{ $cartCount }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>Free</span>
                </div>
                <div class="summary-row">
                    <span>Service Fee</span>
                    <span>PHP 0.00</span>
                </div>
                <div class="summary-row summary-total">
                    <span>Total</span>
                    <span>PHP {{ number_format($total, 2) }}</span>
                </div>

                @if(!$cart->isEmpty())
                    <form method="POST" action="/cart/checkout" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-checkout">Proceed to Checkout</button>
                    </form>
                @else
                    <a href="/products" class="btn btn-outline-dark w-100 mt-3">Start Shopping</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
