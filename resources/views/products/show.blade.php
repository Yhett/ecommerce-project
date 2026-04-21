@extends('layout')

@section('content')

<style>
    .product-hero {
        background: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
        border: 1px solid #edd8f4;
        border-radius: 28px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 18px 40px rgba(156, 39, 176, 0.08);
    }

    .product-image {
        border-radius: 20px;
        box-shadow: 0 12px 32px rgba(156, 39, 176, 0.15);
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: auto;
        display: block;
    }

    .product-details h2 {
        color: #2f2340;
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 1rem;
    }

    .product-price {
        color: #9c27b0;
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }

    .product-description {
        color: #6c757d;
        font-size: 1.05rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .form-group-product {
        margin-bottom: 1.5rem;
    }

    .form-group-product label {
        color: #2f2340;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control-product {
        border: 1px solid #edd8f4;
        border-radius: 12px;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-control-product:focus {
        border-color: #9c27b0;
        box-shadow: 0 0 0 3px rgba(156, 39, 176, 0.1);
        outline: none;
    }

    .btn-add-to-cart {
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

    .btn-add-to-cart:hover {
        background: linear-gradient(135deg, #9c27b0, #8e24aa);
        transform: translateY(-2px);
        box-shadow: 0 14px 36px rgba(156, 39, 176, 0.4);
    }

    .btn-add-to-cart:active {
        transform: translateY(0);
    }

    .btn-register {
        border: 2px solid #6a1b9a;
        color: #6a1b9a;
        font-weight: 700;
        font-size: 1.05rem;
        border-radius: 16px;
        padding: 1rem 2rem;
        width: 100%;
        transition: all 0.3s ease;
    }

    .btn-register:hover {
        background-color: #6a1b9a;
        color: white;
    }

    @media (max-width: 768px) {
        .product-details h2 {
            font-size: 1.5rem;
        }

        .product-price {
            font-size: 1.4rem;
        }

        .btn-add-to-cart, .btn-register {
            padding: 0.85rem 1.5rem;
            font-size: 1rem;
        }
    }
</style>

<div class="product-page">
    <div class="container mt-5 mb-5">
        <div class="product-hero">
            <a href="/products" class="btn btn-outline-dark mb-3">← Back to Products</a>
        </div>

        <div class="row g-4">
            <!-- IMAGE -->
            <div class="col-lg-5">
                <div class="product-image">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400x400?text=Product' }}"
                         alt="{{ $product->name }}"
                         class="img-fluid">
                </div>
            </div>

            <!-- DETAILS -->
            <div class="col-lg-7">
                <div class="product-details">
                    <h2>{{ $product->name }}</h2>
                    <div class="product-price">PHP {{ number_format($product->price, 2) }}</div>
                    <p class="product-description">{{ $product->description }}</p>

                    @auth
                        <form method="POST" action="/cart/add/{{ $product->id }}">
                            @csrf

                            <div class="form-group-product">
                                <label for="variation">Variation:</label>
                                <select name="variation" id="variation" class="form-control-product">
                                    <option value="Small">Small</option>
                                    <option value="Medium" selected>Medium</option>
                                    <option value="Large">Large</option>
                                </select>
                            </div>

                            <div class="form-group-product">
                                <label for="qty">Quantity:</label>
                                <input type="number" name="qty" id="qty" value="1" min="1" max="100" class="form-control-product">
                            </div>

                            <button type="submit" class="btn-add-to-cart">
                                <i class="fa-solid fa-cart-plus"></i> Add to Cart
                            </button>
                        </form>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-register">
                            <i class="fa-solid fa-user-plus"></i> Create an account to order
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
