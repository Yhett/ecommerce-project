@extends('layout')

@section('content')

<style>
    .checkout-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 28px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 18px 40px rgba(156, 39, 176, 0.08);
    }

    .checkout-hero h1 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .checkout-card {
        background: white;
        border: 1px solid #edd8f4;
        border-radius: 24px;
        box-shadow: 0 12px 28px rgba(156, 39, 176, 0.08);
        padding: 2rem;
        margin-bottom: 2rem;
    }

    .checkout-card h3 {
        color: #6a1b9a;
        font-weight: 700;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f0e3f4;
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .payment-method-card {
        border: 2px solid #edd8f4;
        border-radius: 16px;
        padding: 1.5rem;
        cursor: pointer;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        background: white;
    }

    .payment-method-card:hover {
        border-color: #ba68c8;
        box-shadow: 0 8px 20px rgba(156, 39, 176, 0.15);
    }

    .payment-method-card input[type="radio"] {
        display: none;
    }

    .payment-method-card input[type="radio"]:checked + label {
        color: #6a1b9a;
    }

    .payment-method-card.active {
        border-color: #ba68c8;
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        box-shadow: 0 8px 24px rgba(156, 39, 176, 0.2);
    }

    .payment-method-card.active::after {
        content: "✓";
        position: absolute;
        top: 8px;
        right: 12px;
        width: 24px;
        height: 24px;
        background: #ba68c8;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }

    .payment-method-icon {
        font-size: 2.5rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .payment-method-name {
        font-weight: 700;
        color: #2f2340;
        margin-bottom: 0.25rem;
        font-size: 0.95rem;
    }

    .payment-method-desc {
        font-size: 0.8rem;
        color: #6c757d;
    }

    .payment-details-section {
        display: none;
        padding: 1.5rem;
        background: #f9f7fa;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .payment-details-section.active {
        display: block;
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

    .item-details {
        flex: 1;
    }

    .item-details h5 {
        color: #2f2340;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .item-details p {
        color: #6c757d;
        font-size: 0.9rem;
        margin: 0;
    }

    .item-price {
        color: #9c27b0;
        font-weight: 700;
        font-size: 1.1rem;
        text-align: right;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        color: #6c757d;
    }

    .summary-row.total {
        font-size: 1.3rem;
        font-weight: 700;
        color: #2f2340;
        border-top: 2px solid #f0e3f4;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .btn-pay {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        border: none;
        color: white;
        font-weight: 700;
        font-size: 1.05rem;
        border-radius: 16px;
        padding: 1rem 2rem;
        width: 100%;
        box-shadow: 0 10px 28px rgba(156, 39, 176, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-pay:hover:not(:disabled) {
        background: linear-gradient(135deg, #9c27b0, #8e24aa);
        transform: translateY(-2px);
        box-shadow: 0 14px 36px rgba(156, 39, 176, 0.4);
    }

    .btn-pay:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn-cancel {
        border: 2px solid #6c757d;
        color: #6c757d;
        font-weight: 600;
        border-radius: 12px;
        padding: 0.85rem 1.5rem;
        width: 100%;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background-color: #6c757d;
        color: white;
    }

    .loading {
        display: none;
        text-align: center;
        padding: 2rem;
    }

    .loading-spinner {
        border: 4px solid #f0e3f4;
        border-top: 4px solid #ba68c8;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
        margin: 0 auto 1rem;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .error-message {
        background-color: #fee;
        color: #c33;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: none;
    }

    .success-message {
        background-color: #efe;
        color: #3c3;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        display: none;
    }

    .info-box {
        background: #eff4ff;
        border-left: 4px solid #2196F3;
        padding: 1rem;
        border-radius: 8px;
        margin-top: 1rem;
        font-size: 0.9rem;
        color: #1565c0;
    }

    @media (max-width: 768px) {
        .checkout-card {
            padding: 1.5rem;
        }

        .payment-methods {
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        }

        .order-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .item-price {
            align-self: flex-end;
            margin-top: 0.5rem;
        }
    }
</style>

<div class="checkout-page">
    <div class="container mt-5 mb-5">
        <section class="checkout-hero">
            <h1>Secure Checkout</h1>
            <p>Complete your purchase with our secure payment system.</p>
        </section>

        <div class="row g-4">
            <!-- Order Summary -->
            <div class="col-lg-5">
                <div class="checkout-card">
                    <h3>Order Summary</h3>

                    @foreach($cartItems as $item)
                        @php
                            $unitPrice = $item->product->price ?? 0;
                            $quantity = $item->quantity ?? 1;
                            $subtotal = $unitPrice * $quantity;
                        @endphp
                        <div class="order-item">
                            <div class="item-details">
                                <h5>{{ $item->product->name ?? 'Product' }}</h5>
                                <p>Qty: {{ $quantity }}</p>
                                @if(!empty($item->variation))
                                    <p>{{ $item->variation }}</p>
                                @endif
                            </div>
                            <div class="item-price">
                                PHP {{ number_format($subtotal, 2) }}
                            </div>
                        </div>
                    @endforeach

                    <div class="mt-4">
                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span>PHP {{ number_format($totalAmount, 2) }}</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row">
                            <span>Service Fee</span>
                            <span>PHP 0.00</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total Amount</span>
                            <span>PHP {{ number_format($totalAmount, 2) }}</span>
                        </div>
                    </div>
                </div>

                <div class="checkout-card">
                    <h3>Billing & Shipping Address</h3>
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" value="{{ $user->address ?: 'Not set - Add in Profile' }}" {{ $user->address ? 'disabled' : '' }}>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone</label>
                        <input type="tel" class="form-control" value="{{ $user->phone ?: 'Not set - Add in Profile' }}" {{ $user->phone ? 'disabled' : '' }}>
                    </div>
                    @if(!$user->address || !$user->phone)
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>Add your address and phone in <a href="{{ route('profile.edit') }}">Profile Settings</a> for faster checkout.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Form -->
            <div class="col-lg-7">
                <div class="checkout-card">
                    <h3>Payment Method</h3>

                    <div class="error-message" id="errorMessage"></div>
                    <div class="success-message" id="successMessage"></div>

                    <!-- Payment Method Selection -->
                    <form id="payment-form">
                        @csrf
                        <div class="payment-methods" id="paymentMethods">
                            <!-- Cash on Delivery -->
                            <label class="payment-method-card active" data-method="cod">
                                <input type="radio" name="payment_method" value="cod" checked>
                                <span class="payment-method-icon"><i class="fa-solid fa-money-bill-wave"></i></span>
                                <span class="payment-method-name">Cash on Delivery</span>
                                <span class="payment-method-desc">Pay when received</span>
                            </label>

                            <!-- GCash -->
                            <label class="payment-method-card" data-method="gcash">
                                <input type="radio" name="payment_method" value="gcash">
                                <span class="payment-method-icon"><i class="fa-solid fa-mobile"></i></span>
                                <span class="payment-method-name">GCash</span>
                                <span class="payment-method-desc">Mobile wallet</span>
                            </label>

                            <!-- Maya -->
                            <label class="payment-method-card" data-method="maya">
                                <input type="radio" name="payment_method" value="maya">
                                <span class="payment-method-icon"><i class="fa-solid fa-credit-card"></i></span>
                                <span class="payment-method-name">Maya</span>
                                <span class="payment-method-desc">Pay later</span>
                            </label>
                        </div>

                        <!-- Payment Details - Cash on Delivery -->
                        <div class="payment-details-section active" id="cod-details">
                            <h5 style="color: #6a1b9a; margin-bottom: 1rem;">Cash on Delivery</h5>
                            <p style="color: #6c757d; margin-bottom: 0;">
                                Your order will be delivered to your address. Please have exact cash ready when our delivery driver arrives.
                            </p>
                        </div>

                        <!-- Payment Details - GCash -->
                        <div class="payment-details-section" id="gcash-details">
                            <h5 style="color: #6a1b9a; margin-bottom: 1rem;">GCash Payment</h5>
                            <div class="mb-3">
                                <label class="form-label">GCash Number</label>
                                <input type="tel" id="gcash-number" class="form-control" placeholder="09xxxxxxxxx" pattern="[0-9]{11}">
                                <small class="text-muted">Enter your 11-digit GCash number</small>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" id="gcash-name" class="form-control" placeholder="Name on GCash account" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <!-- Payment Details - Maya -->
                        <div class="payment-details-section" id="maya-details">
                            <h5 style="color: #6a1b9a; margin-bottom: 1rem;">Maya Payment</h5>
                            <div class="mb-3">
                                <label class="form-label">Maya Email/Phone</label>
                                <input type="email" id="maya-email" class="form-control" placeholder="your@email.com or 09xxxxxxxxx" value="{{ $user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" id="maya-name" class="form-control" placeholder="Name on Maya account" value="{{ $user->name }}" disabled>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <button type="submit" class="btn-pay" id="submit-button">
                                    <i class="fa-solid fa-lock"></i> Confirm Order
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="/cart" class="btn btn-cancel">Cancel</a>
                            </div>
                        </div>

                        <div class="loading" id="loading">
                            <div class="loading-spinner"></div>
                            <p>Processing your order...</p>
                        </div>
                    </form>

                    <div class="info-box">
                        <i class="fa-solid fa-shield"></i> All transactions are secure and encrypted.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Payment method selection
    const methodCards = document.querySelectorAll('.payment-method-card');

    methodCards.forEach(card => {
        card.addEventListener('click', function() {
            const input = this.querySelector('input[type="radio"]');
            input.checked = true;

            // Update UI
            methodCards.forEach(c => c.classList.remove('active'));
            this.classList.add('active');

            // Show/hide payment details
            const method = input.value;
            document.querySelectorAll('.payment-details-section').forEach(el => {
                el.classList.remove('active');
            });
            document.getElementById(method + '-details').classList.add('active');
        });
    });

    // Handle form submission
    document.getElementById('payment-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        const submitButton = document.getElementById('submit-button');
        const loading = document.getElementById('loading');
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        submitButton.disabled = true;
        loading.style.display = 'block';

        try {
            const payload = {
                payment_method: paymentMethod,
            };

            // Collect method-specific data
            if (paymentMethod === 'gcash') {
                payload.gcash_number = document.getElementById('gcash-number').value;
                if (!payload.gcash_number) {
                    throw new Error('Please enter your GCash number');
                }
            } else if (paymentMethod === 'maya') {
                payload.maya_email = document.getElementById('maya-email').value;
                if (!payload.maya_email) {
                    throw new Error('Please enter your Maya email or phone number');
                }
            }

            const response = await fetch('/payment/process', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            if (data.success) {
                document.getElementById('successMessage').textContent = 'Order placed successfully! Redirecting...';
                document.getElementById('successMessage').style.display = 'block';
                setTimeout(() => {
                    window.location.href = data.redirect_url;
                }, 2000);
            } else {
                throw new Error(data.message || 'Payment processing failed');
            }
        } catch (err) {
            document.getElementById('errorMessage').textContent = err.message || 'An error occurred. Please try again.';
            document.getElementById('errorMessage').style.display = 'block';
            submitButton.disabled = false;
            loading.style.display = 'none';
        }
    });
</script>

@endsection
