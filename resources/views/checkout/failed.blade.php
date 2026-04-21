@extends('layout')

@section('content')
<div class="container py-5">
    <h1>Payment Failed</h1>
    <p class="text-muted">There was an issue processing your payment. Please try again or contact support.</p>
    <a href="/cart" class="btn btn-outline-dark mt-3">Return to Cart</a>
</div>
@endsection
@extends('layout')

@section('content')

<style>
    .failed-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .failed-card {
        background: white;
        border: 2px solid #f44336;
        border-radius: 24px;
        padding: 3rem 2rem;
        text-align: center;
        max-width: 500px;
        box-shadow: 0 12px 40px rgba(244, 67, 54, 0.15);
    }

    .failed-icon {
        font-size: 4rem;
        color: #f44336;
        margin-bottom: 1.5rem;
        animation: shake 0.5s ease-in-out;
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        25% {
            transform: translateX(-10px);
        }
        75% {
            transform: translateX(10px);
        }
    }

    .failed-title {
        color: #2f2340;
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .failed-message {
        color: #6c757d;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .error-details {
        background: #ffebee;
        border: 1px solid #f44336;
        border-radius: 16px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        text-align: left;
    }

    .error-details h4 {
        color: #c62828;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .error-details p {
        color: #b71c1c;
        margin: 0;
        font-size: 0.95rem;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
    }

    .btn-retry, .btn-contact {
        flex: 1;
        padding: 0.85rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .btn-retry {
        background: linear-gradient(135deg, #ba68c8, #ab47bc);
        color: white;
        border: none;
    }

    .btn-retry:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(156, 39, 176, 0.3);
    }

    .btn-contact {
        background: white;
        color: #6a1b9a;
        border: 2px solid #ba68c8;
    }

    .btn-contact:hover {
        background: #f7e8fb;
    }

    .suggestion-box {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 16px;
        padding: 1.5rem;
        margin-top: 2rem;
        text-align: left;
    }

    .suggestion-box h5 {
        color: #6a1b9a;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .suggestion-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .suggestion-list li {
        color: #6c757d;
        padding: 0.5rem 0;
        padding-left: 1.5rem;
        position: relative;
    }

    .suggestion-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #ba68c8;
        font-weight: bold;
    }

    @media (max-width: 768px) {
        .failed-card {
            padding: 2rem 1.5rem;
        }

        .failed-icon {
            font-size: 3rem;
        }

        .failed-title {
            font-size: 1.5rem;
        }

        .btn-group {
            flex-direction: column;
        }
    }
</style>

<div class="failed-container">
    <div class="failed-card">
        <div class="failed-icon">
            <i class="fa-solid fa-circle-xmark"></i>
        </div>
        <h1 class="failed-title">Payment Failed</h1>
        <p class="failed-message">
            Unfortunately, your payment could not be processed. Your cart is still saved and you can try again.
        </p>

        <div class="error-details">
            <h4><i class="fa-solid fa-exclamation-circle"></i> What happened?</h4>
            <p>
                The payment was declined by your bank or payment provider. This could be due to insufficient funds, incorrect card details, or security restrictions.
            </p>
        </div>

        <div class="btn-group">
            <a href="/checkout" class="btn-retry">
                <i class="fa-solid fa-redo"></i> Try Again
            </a>
            <a href="/cart" class="btn-contact">
                <i class="fa-solid fa-arrow-left"></i> Back to Cart
            </a>
        </div>

        <div class="suggestion-box">
            <h5>What you can try:</h5>
            <ul class="suggestion-list">
                <li>Check that your card details are correct</li>
                <li>Ensure your card hasn't expired</li>
                <li>Try a different payment method</li>
                <li>Contact your bank to check for fraud alerts</li>
                <li>Verify you have sufficient funds</li>
            </ul>
        </div>

        <p style="color: #6c757d; margin-top: 2rem; font-size: 0.9rem;">
            Need help? <a href="/support" style="color: #6a1b9a; font-weight: 600;">Contact our support team</a>
        </p>
    </div>
</div>

@endsection
