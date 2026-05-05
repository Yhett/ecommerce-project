@extends('layout')

@section('content')
<style>
    :root {
        --checkout-ink: #241635;
        --checkout-muted: #6e6380;
        --checkout-surface: #fffdfb;
        --checkout-paper: #ffffff;
        --checkout-line: #eadcf0;
        --checkout-brand: #7b3f98;
        --checkout-brand-strong: #4d2466;
        --checkout-accent: #f6b24f;
        --checkout-success: #2f8f66;
        --checkout-shadow: 0 22px 60px rgba(71, 40, 92, 0.12);
    }

    .checkout-shell {
        margin: 0 -0.75rem;
        padding: 2rem 0 4rem;
        background:
            radial-gradient(circle at top left, rgba(246, 178, 79, 0.18), transparent 28%),
            radial-gradient(circle at top right, rgba(123, 63, 152, 0.18), transparent 32%),
            linear-gradient(180deg, #fffaf4 0%, #fbf7ff 52%, #fffdfb 100%);
    }

    .checkout-wrap {
        max-width: 1240px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .checkout-hero {
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.45);
        border-radius: 32px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        background:
            linear-gradient(140deg, rgba(77, 36, 102, 0.95), rgba(123, 63, 152, 0.88)),
            linear-gradient(90deg, rgba(255, 255, 255, 0.08), transparent);
        box-shadow: var(--checkout-shadow);
        color: #fff;
    }

    .checkout-hero::after {
        content: "";
        position: absolute;
        inset: auto -60px -90px auto;
        width: 260px;
        height: 260px;
        border-radius: 50%;
        background: rgba(246, 178, 79, 0.18);
        filter: blur(4px);
    }

    .checkout-kicker {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.85rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        font-size: 0.85rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .checkout-hero h1 {
        font-size: clamp(2rem, 4vw, 3.25rem);
        line-height: 1.05;
        margin: 1rem 0 0.75rem;
        font-weight: 800;
    }

    .checkout-hero p {
        max-width: 650px;
        margin: 0;
        color: rgba(255, 255, 255, 0.82);
        font-size: 1.04rem;
    }

    .checkout-hero-stats {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        margin-top: 1.75rem;
    }

    .checkout-stat {
        padding: 1rem 1.1rem;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
    }

    .checkout-stat-label {
        display: block;
        color: rgba(255, 255, 255, 0.72);
        font-size: 0.78rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.45rem;
    }

    .checkout-stat-value {
        font-size: 1.2rem;
        font-weight: 800;
    }

    .checkout-panel {
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 28px;
        background: rgba(255, 255, 255, 0.92);
        box-shadow: var(--checkout-shadow);
        overflow: hidden;
    }

    .checkout-panel-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1.35rem 1.5rem;
        border-bottom: 1px solid var(--checkout-line);
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(248, 242, 252, 0.96));
    }

    .checkout-panel-title {
        margin: 0;
        color: var(--checkout-ink);
        font-size: 1.15rem;
        font-weight: 800;
    }

    .checkout-panel-meta {
        color: var(--checkout-muted);
        font-size: 0.92rem;
    }

    .checkout-panel-body {
        padding: 1.5rem;
    }

    .checkout-stack {
        display: grid;
        gap: 1.5rem;
    }

    .checkout-item {
        display: grid;
        grid-template-columns: 88px minmax(0, 1fr) auto;
        gap: 1rem;
        align-items: center;
        padding: 1rem;
        border: 1px solid var(--checkout-line);
        border-radius: 24px;
        background: linear-gradient(180deg, #ffffff, #fff8ff);
    }

    .checkout-item + .checkout-item {
        margin-top: 1rem;
    }

    .checkout-item-image {
        width: 88px;
        height: 88px;
        object-fit: cover;
        border-radius: 20px;
        background: #f6eef9;
        box-shadow: 0 12px 24px rgba(87, 58, 114, 0.12);
    }

    .checkout-item h6 {
        margin-bottom: 0.35rem;
        font-weight: 800;
        color: var(--checkout-ink);
    }

    .checkout-item-copy {
        color: var(--checkout-muted);
        font-size: 0.95rem;
    }

    .checkout-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.35rem;
        padding: 0.35rem 0.7rem;
        border-radius: 999px;
        margin-top: 0.55rem;
        background: #f7eefb;
        color: var(--checkout-brand-strong);
        border: 1px solid #ebd8f5;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .checkout-price {
        text-align: right;
        color: var(--checkout-brand-strong);
        font-weight: 800;
        font-size: 1.2rem;
        white-space: nowrap;
    }

    .checkout-totals {
        display: grid;
        gap: 0.9rem;
        padding: 1.4rem 1.5rem 1.6rem;
        border-top: 1px solid var(--checkout-line);
        background: linear-gradient(180deg, rgba(249, 244, 252, 0.92), rgba(255, 255, 255, 0.96));
    }

    .checkout-total-row {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
        align-items: center;
        color: var(--checkout-muted);
    }

    .checkout-total-row strong {
        color: var(--checkout-ink);
    }

    .checkout-total-row.final {
        padding-top: 0.9rem;
        margin-top: 0.35rem;
        border-top: 1px dashed #dbc3e8;
        font-size: 1.2rem;
    }

    .checkout-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.45rem;
        padding: 0.4rem 0.8rem;
        border-radius: 999px;
        background: #fff4dd;
        color: #8c5810;
        font-weight: 700;
        font-size: 0.8rem;
    }

    .checkout-address-grid {
        display: grid;
        gap: 1rem;
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .checkout-field {
        padding: 1rem 1rem 0.9rem;
        border: 1px solid var(--checkout-line);
        border-radius: 20px;
        background: #fff;
    }

    .checkout-field.full {
        grid-column: 1 / -1;
    }

    .checkout-field label {
        display: block;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: var(--checkout-muted);
        margin-bottom: 0.45rem;
        font-weight: 700;
    }

    .checkout-field-value {
        color: var(--checkout-ink);
        font-weight: 700;
        line-height: 1.5;
    }

    .checkout-note {
        margin-top: 1rem;
        padding: 1rem 1.1rem;
        border-radius: 20px;
        border: 1px solid #f5dcae;
        background: #fff6e6;
        color: #7d5a12;
    }

    .checkout-payment {
        position: sticky;
        top: 2rem;
    }

    .payment-method-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1rem;
    }

    .payment-method-card {
        display: block;
        height: 100%;
        padding: 1.15rem 1rem;
        border-radius: 24px;
        border: 1px solid var(--checkout-line);
        background: linear-gradient(180deg, #fff, #fdf8ff);
        cursor: pointer;
        transition: transform 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .payment-method-card:hover {
        transform: translateY(-3px);
        border-color: #cfaddf;
        box-shadow: 0 16px 28px rgba(85, 50, 108, 0.1);
    }

    .payment-method-card.active {
        border-color: var(--checkout-brand);
        box-shadow: 0 18px 36px rgba(92, 42, 121, 0.16);
        background: linear-gradient(180deg, #ffffff, #f8efff);
    }

    .payment-method-card input {
        position: absolute;
        opacity: 0;
        pointer-events: none;
    }

    .payment-method-icon {
        width: 64px;
        height: 64px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        margin-bottom: 0.85rem;
        background: #f7eefb;
        color: var(--checkout-brand);
    }

    .payment-method-name {
        color: var(--checkout-ink);
        font-size: 1rem;
        font-weight: 800;
    }

    .payment-method-help {
        color: var(--checkout-muted);
        font-size: 0.88rem;
    }

    .payment-details {
        display: none;
        margin-top: 1.25rem;
        padding: 1.25rem;
        border: 1px solid var(--checkout-line);
        border-radius: 24px;
        background: linear-gradient(180deg, #fffdfa, #f8f3fb);
    }

    .payment-details.active {
        display: block;
    }

    .payment-highlight {
        display: flex;
        gap: 1rem;
        align-items: flex-start;
    }

    .payment-highlight-icon {
        width: 62px;
        height: 62px;
        flex-shrink: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 18px;
        background: rgba(47, 143, 102, 0.12);
        color: var(--checkout-success);
        font-size: 1.5rem;
    }

    .payment-highlight h5,
    .payment-section-title {
        margin-bottom: 0.4rem;
        color: var(--checkout-ink);
        font-weight: 800;
    }

    .payment-highlight p,
    .payment-caption {
        margin-bottom: 0;
        color: var(--checkout-muted);
    }

    .payment-input-grid {
        display: grid;
        gap: 1rem;
        grid-template-columns: minmax(0, 1.35fr) minmax(0, 1fr);
    }

    .payment-field label {
        display: block;
        margin-bottom: 0.45rem;
        color: var(--checkout-ink);
        font-weight: 700;
    }

    .payment-field input {
        width: 100%;
        border: 1px solid #dcc7e8;
        border-radius: 18px;
        padding: 0.95rem 1rem;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .payment-field input:focus {
        border-color: var(--checkout-brand);
        box-shadow: 0 0 0 4px rgba(123, 63, 152, 0.1);
    }

    .payment-field-note {
        margin-top: 0.45rem;
        font-size: 0.85rem;
        color: var(--checkout-muted);
    }

    .checkout-error {
        margin-bottom: 1.25rem;
        padding: 1rem 1.1rem;
        border-radius: 20px;
        border: 1px solid #f0bfbc;
        background: #fff2f1;
        color: #9a2f2a;
    }

    .checkout-error ul {
        margin: 0.6rem 0 0;
        padding-left: 1.2rem;
    }

    .checkout-summary-box {
        margin-top: 1.5rem;
        padding-top: 1.2rem;
        border-top: 1px solid var(--checkout-line);
    }

    .checkout-pay-row {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .checkout-pay-label {
        color: var(--checkout-muted);
        font-weight: 700;
    }

    .checkout-pay-total {
        color: var(--checkout-brand-strong);
        font-weight: 900;
        font-size: 2rem;
        line-height: 1;
    }

    .checkout-submit,
    .checkout-secondary-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.65rem;
        width: 100%;
        padding: 1rem 1.25rem;
        border-radius: 999px;
        font-weight: 800;
        text-decoration: none;
        transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
    }

    .checkout-submit {
        border: none;
        color: #fff;
        background: linear-gradient(135deg, var(--checkout-brand-strong), var(--checkout-brand));
        box-shadow: 0 18px 34px rgba(92, 42, 121, 0.2);
    }

    .checkout-submit:hover {
        transform: translateY(-2px);
    }

    .checkout-submit:disabled {
        opacity: 0.72;
        transform: none;
    }

    .checkout-secondary-link {
        margin-top: 0.85rem;
        color: var(--checkout-brand-strong);
        border: 1px solid #ddcae8;
        background: #fff;
    }

    .checkout-security {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 0.8rem;
        margin-top: 1.35rem;
    }

    .checkout-security-item {
        padding: 0.9rem 0.8rem;
        border-radius: 18px;
        text-align: center;
        background: #faf4fd;
        border: 1px solid #eadcf0;
        color: var(--checkout-muted);
        font-size: 0.88rem;
        font-weight: 700;
    }

    .checkout-security-item i {
        display: block;
        margin-bottom: 0.35rem;
        color: var(--checkout-brand);
    }

    .checkout-spinner {
        display: none;
    }

    .checkout-submit.is-loading .checkout-spinner {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .checkout-submit.is-loading .checkout-submit-text {
        display: none;
    }

    @media (max-width: 991px) {
        .checkout-payment {
            position: static;
        }

        .payment-method-grid {
            grid-template-columns: 1fr;
        }

        .checkout-hero-stats {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .checkout-shell {
            margin: 0 -0.4rem;
            padding-top: 1rem;
        }

        .checkout-wrap {
            padding: 0 0.6rem;
        }

        .checkout-hero {
            padding: 1.4rem;
            border-radius: 24px;
        }

        .checkout-panel-head,
        .checkout-panel-body,
        .checkout-totals {
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }

        .checkout-item {
            grid-template-columns: 1fr;
            text-align: left;
        }

        .checkout-item-image {
            width: 100%;
            height: 220px;
        }

        .checkout-price {
            text-align: left;
        }

        .checkout-address-grid,
        .payment-input-grid,
        .checkout-security {
            grid-template-columns: 1fr;
        }
    }
</style>

@php
    $cartCount = $cartItems->sum(fn ($item) => $item->quantity ?? 1);
@endphp

<div class="checkout-shell">
    <div class="checkout-wrap">
        <section class="checkout-hero">
            <span class="checkout-kicker">
                <i class="fas fa-lock"></i>
                Secure Checkout
            </span>
            <h1>Finish your order with confidence.</h1>
            <p>Review your items, confirm your shipping details, and choose the payment method that works best for you.</p>

            <div class="checkout-hero-stats">
                <div class="checkout-stat">
                    <span class="checkout-stat-label">Items</span>
                    <span class="checkout-stat-value">{{ $cartCount }}</span>
                </div>
                <div class="checkout-stat">
                    <span class="checkout-stat-label">Shipping</span>
                    <span class="checkout-stat-value">Free</span>
                </div>
                <div class="checkout-stat">
                    <span class="checkout-stat-label">Total</span>
                    <span class="checkout-stat-value">PHP {{ number_format($totalAmount, 2) }}</span>
                </div>
            </div>
        </section>

        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <div class="checkout-stack">
                    <section class="checkout-panel">
                        <div class="checkout-panel-head">
                            <div>
                                <h2 class="checkout-panel-title">
                                    <i class="fas fa-bag-shopping me-2"></i>
                                    Order Summary
                                </h2>
                                <div class="checkout-panel-meta">A quick look at everything included in this purchase.</div>
                            </div>
                            <span class="checkout-badge">
                                <i class="fas fa-truck"></i>
                                Free delivery
                            </span>
                        </div>

                        <div class="checkout-panel-body">
                            @foreach($cartItems as $item)
                                @php
                                    $unitPrice = $item->product->price ?? 0;
                                    $quantity = $item->quantity ?? 1;
                                    $subtotal = $unitPrice * $quantity;
                                @endphp

                                <article class="checkout-item">
                                    <img
                                        src="{{ $item->product->image ? asset('storage/' . $item->product->image) : 'https://via.placeholder.com/600x600?text=Product' }}"
                                        alt="{{ $item->product->name ?? 'Product' }}"
                                        class="checkout-item-image"
                                    >

                                    <div>
                                        <h6>{{ $item->product->name ?? 'Product' }}</h6>
                                        <div class="checkout-item-copy">
                                            {{ $quantity }} x PHP {{ number_format($unitPrice, 2) }}
                                        </div>

                                        @if($item->variation)
                                            <span class="checkout-chip">
                                                <i class="fas fa-tag"></i>
                                                {{ $item->variation }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="checkout-price">
                                        PHP {{ number_format($subtotal, 2) }}
                                    </div>
                                </article>
                            @endforeach
                        </div>

                        <div class="checkout-totals">
                            <div class="checkout-total-row">
                                <span>Subtotal</span>
                                <strong>PHP {{ number_format($totalAmount, 2) }}</strong>
                            </div>
                            <div class="checkout-total-row">
                                <span>Shipping</span>
                                <strong class="text-success">Free</strong>
                            </div>
                            <div class="checkout-total-row final">
                                <span>Total</span>
                                <strong>PHP {{ number_format($totalAmount, 2) }}</strong>
                            </div>
                        </div>
                    </section>

                    <section class="checkout-panel">
                        <div class="checkout-panel-head">
                            <div>
                                <h2 class="checkout-panel-title">
                                    <i class="fas fa-location-dot me-2"></i>
                                    Shipping Address
                                </h2>
                                <div class="checkout-panel-meta">We’ll use the details saved on your account for this order.</div>
                            </div>
                        </div>

                        <div class="checkout-panel-body">
                            <div class="checkout-address-grid">
                                <div class="checkout-field">
                                    <label>Full Name</label>
                                    <div class="checkout-field-value">{{ $user->name }}</div>
                                </div>

                                <div class="checkout-field">
                                    <label>Email</label>
                                    <div class="checkout-field-value">{{ $user->email }}</div>
                                </div>

                                <div class="checkout-field full">
                                    <label>Address</label>
                                    <div class="checkout-field-value">{{ $user->address ?? 'Please update your profile address.' }}</div>
                                </div>

                                <div class="checkout-field">
                                    <label>Phone</label>
                                    <div class="checkout-field-value">{{ $user->phone ?? 'Please update your profile phone.' }}</div>
                                </div>

                                <div class="checkout-field">
                                    <label>City</label>
                                    <div class="checkout-field-value">{{ $user->city ?? 'Tabaco City' }}</div>
                                </div>
                            </div>

                            @if(!$user->address)
                                <div class="checkout-note">
                                    <i class="fas fa-circle-exclamation me-2"></i>
                                    Update your <a href="{{ route('profile.edit') }}" class="fw-bold">profile address</a> for a smoother delivery handoff.
                                </div>
                            @endif
                        </div>
                    </section>
                </div>
            </div>

            <div class="col-lg-5">
                <section class="checkout-panel checkout-payment">
                    <div class="checkout-panel-head">
                        <div>
                            <h2 class="checkout-panel-title">
                                <i class="fas fa-credit-card me-2"></i>
                                Payment Method
                            </h2>
                            <div class="checkout-panel-meta">Choose how you want to complete this order.</div>
                        </div>
                    </div>

                    <div class="checkout-panel-body">
                        @if ($errors->any())
                            <div class="checkout-error">
                                <strong><i class="fas fa-circle-xmark me-2"></i>Please fix the following:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('payment.process') }}" method="POST" id="paymentForm">
                            @csrf

                            <div class="payment-method-grid">
                                <label class="payment-method-card active" data-method="cod">
                                    <input type="radio" name="payment_method" value="cod" checked required>
                                    <div class="payment-method-icon">
                                        <i class="fas fa-money-bill-wave fa-lg"></i>
                                    </div>
                                    <div class="payment-method-name">Cash on Delivery</div>
                                    <div class="payment-method-help">Pay once the order reaches you.</div>
                                </label>

                                <label class="payment-method-card" data-method="gcash">
                                    <input type="radio" name="payment_method" value="gcash">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-mobile-screen-button fa-lg"></i>
                                    </div>
                                    <div class="payment-method-name">GCash</div>
                                    <div class="payment-method-help">Fast mobile payment transfer.</div>
                                </label>

                                <label class="payment-method-card" data-method="maya">
                                    <input type="radio" name="payment_method" value="maya">
                                    <div class="payment-method-icon">
                                        <i class="fas fa-wallet fa-lg"></i>
                                    </div>
                                    <div class="payment-method-name">Maya</div>
                                    <div class="payment-method-help">Use your Maya account details.</div>
                                </label>
                            </div>

                            <div id="cod-details" class="payment-details active" data-payment-panel>
                                <div class="payment-highlight">
                                    <div class="payment-highlight-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div>
                                        <h5>Cash on Delivery</h5>
                                        <p>Pay PHP {{ number_format($totalAmount, 2) }} when your package arrives at your address.</p>
                                    </div>
                                </div>
                            </div>

                            <div id="gcash-details" class="payment-details" data-payment-panel>
                                <div class="payment-section-title">Enter your GCash details</div>
                                <div class="payment-caption">We’ll use this number to validate your mobile wallet payment.</div>

                                <div class="payment-input-grid mt-3">
                                    <div class="payment-field">
                                        <label for="gcash_number">GCash Number <span class="text-danger">*</span></label>
                                        <input
                                            id="gcash_number"
                                            type="tel"
                                            name="gcash_number"
                                            value="{{ old('gcash_number') }}"
                                            placeholder="09XXXXXXXXX"
                                            pattern="[0-9]{11}"
                                            data-payment-required="gcash"
                                        >
                                        <div class="payment-field-note">Use your 11-digit registered GCash number.</div>
                                    </div>

                                    <div class="payment-field">
                                        <label>Name</label>
                                        <input type="text" value="{{ $user->name }}" readonly>
                                        <div class="payment-field-note">Account holder for this order.</div>
                                    </div>
                                </div>
                            </div>

                            <div id="maya-details" class="payment-details" data-payment-panel>
                                <div class="payment-section-title">Enter your Maya details</div>
                                <div class="payment-caption">Use the email address linked to your Maya account.</div>

                                <div class="payment-input-grid mt-3">
                                    <div class="payment-field">
                                        <label for="maya_email">Maya Email <span class="text-danger">*</span></label>
                                        <input
                                            id="maya_email"
                                            type="email"
                                            name="maya_email"
                                            value="{{ old('maya_email', $user->email) }}"
                                            placeholder="email@domain.com"
                                            data-payment-required="maya"
                                        >
                                        <div class="payment-field-note">Enter the email registered with Maya.</div>
                                    </div>

                                    <div class="payment-field">
                                        <label>Name</label>
                                        <input type="text" value="{{ $user->name }}" readonly>
                                        <div class="payment-field-note">Shown for quick payment review.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-summary-box">
                                <div class="checkout-pay-row">
                                    <span class="checkout-pay-label">Total Payment</span>
                                    <span class="checkout-pay-total">PHP {{ number_format($totalAmount, 2) }}</span>
                                </div>

                                <button type="submit" class="checkout-submit" id="checkoutSubmit">
                                    <span class="checkout-submit-text">
                                        <i class="fas fa-lock"></i>
                                        Confirm Order and Pay
                                    </span>
                                    <span class="checkout-spinner">
                                        <span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span>
                                        Processing...
                                    </span>
                                </button>

                                <a href="/cart" class="checkout-secondary-link">
                                    <i class="fas fa-arrow-left"></i>
                                    Back to Cart
                                </a>
                            </div>
                        </form>

                        <div class="checkout-security">
                            <div class="checkout-security-item">
                                <i class="fas fa-lock"></i>
                                SSL Secure
                            </div>
                            <div class="checkout-security-item">
                                <i class="fas fa-shield-heart"></i>
                                Verified Checkout
                            </div>
                            <div class="checkout-security-item">
                                <i class="fas fa-box"></i>
                                Tracked Delivery
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const paymentCards = document.querySelectorAll('.payment-method-card');
    const paymentPanels = document.querySelectorAll('[data-payment-panel]');
    const conditionalInputs = document.querySelectorAll('[data-payment-required]');
    const form = document.getElementById('paymentForm');
    const submitButton = document.getElementById('checkoutSubmit');

    function updatePaymentMethod(method) {
        paymentCards.forEach((card) => {
            const radio = card.querySelector('input[type="radio"]');
            const isActive = radio && radio.value === method;

            card.classList.toggle('active', isActive);

            if (radio) {
                radio.checked = isActive;
            }
        });

        paymentPanels.forEach((panel) => {
            panel.classList.toggle('active', panel.id === method + '-details');
        });

        conditionalInputs.forEach((input) => {
            const shouldRequire = input.dataset.paymentRequired === method;
            input.required = shouldRequire;

            if (!shouldRequire) {
                input.removeAttribute('aria-invalid');
            }
        });
    }

    paymentCards.forEach((card) => {
        card.addEventListener('click', function () {
            const radio = this.querySelector('input[type="radio"]');

            if (radio) {
                updatePaymentMethod(radio.value);
            }
        });
    });

    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    updatePaymentMethod(checkedRadio ? checkedRadio.value : 'cod');

    if (form && submitButton) {
        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            submitButton.classList.add('is-loading');
        });
    }
})();
</script>

@endsection
