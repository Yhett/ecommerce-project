@extends('layout')

@section('content')

<style>


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

    /* Product Header Enhancements */
    .product-header {
        background: linear-gradient(135deg, rgba(186, 104, 200, 0.05), rgba(171, 71, 188, 0.03));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(237, 216, 244, 0.5);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 20px 60px rgba(156, 39, 176, 0.1);
    }

    .product-header h1 {
        color: #2f2340;
        font-weight: 800;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .product-price-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 50px;
        font-size: 1.5rem;
        font-weight: 700;
        box-shadow: 0 10px 30px rgba(186, 104, 200, 0.4);
        margin-bottom: 1.5rem;
    }

    .rating-stars {
        color: #ffc107;
        font-size: 1.2rem;
        margin-bottom: 1rem;
    }

    .rating-text {
        color: #6c757d;
        font-size: 0.95rem;
    }

    /* Image Enhancements */
    .product-image-container {
        transition: all 0.4s ease;
    }

    .product-image-container:hover .product-main-image {
        transform: scale(1.05);
    }

    .product-image-container:hover [style*="opacity: 0"] {
        opacity: 1 !important;
    }

    .gallery-thumb {
        transition: all 0.3s ease;
        cursor: pointer;
        border: 3px solid transparent;
        opacity: 0.7;
    }

    .gallery-thumb.active, .gallery-thumb:hover {
        border-color: #ba68c8;
        opacity: 1;
        transform: scale(1.05);
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

    /* Glassmorphism Cards */
    .glass-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(237, 216, 244, 0.4);
        border-radius: 20px;
        box-shadow: 0 25px 70px rgba(156, 39, 176, 0.12);
        transition: all 0.4s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 35px 90px rgba(156, 39, 176, 0.2);
    }

    /* Sticky Sidebar */
    .sticky-cart-sidebar {
        position: sticky;
        top: 100px;
        align-self: flex-start;
    }

    /* Quantity Stepper */
    .quantity-stepper {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: white;
        border: 2px solid #edd8f4;
        border-radius: 12px;
        padding: 0.5rem;
        max-width: 200px;
    }

    .qty-btn {
        width: 40px;
        height: 40px;
        border: none;
        background: linear-gradient(135deg, #f3e5f5, white);
        border-radius: 8px;
        font-size: 1.2rem;
        font-weight: 700;
        color: #9c27b0;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover {
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        color: white;
        transform: scale(1.05);
    }

    .qty-input {
        border: none;
        width: 60px;
        text-align: center;
        font-size: 1.1rem;
        font-weight: 600;
        background: transparent;
    }

    /* Mobile Sticky CTA */
    .mobile-cta-sticky {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 1rem 2rem;
        box-shadow: 0 -10px 40px rgba(0,0,0,0.1);
        z-index: 1000;
        display: none;
    }

    @media (max-width: 991px) {
        .mobile-cta-sticky { display: block; }
        .sticky-cart-sidebar { position: relative; top: auto; }
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
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
          <ol class="breadcrumb bg-transparent p-0">
            <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($product->name, 30) }}</li>
          </ol>
        </nav>

    <div class="row g-4">
            <!-- Enhanced Image with Zoom -->
            <div class="col-lg-5">
                <div class="position-relative overflow-hidden rounded-4 shadow-lg product-image-container" style="height: 500px; cursor: zoom-in;">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/500x500?text='.$product->name }}" 
                         alt="{{ $product->name }}"
                         class="img-fluid h-100 w-100 object-fit-cover product-main-image transition-transform">
                    <!-- Quick view overlay -->
                    <div class="position-absolute top-50 start-50 translate-middle text-white bg-dark bg-opacity-50 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px; opacity: 0; transition: opacity 0.3s;">
                        <i class="fas fa-search-plus fs-5"></i>
                    </div>
                </div>

            </div>

            <!-- DETAILS -->
            <div class="col-lg-7">
                <div class="product-header">
                    <h1>{{ $product->name }}</h1>
                    <div class="product-price-badge">
                        <i class="fas fa-tag"></i>
                        PHP {{ number_format($product->price, 2) }}
                    </div>
                    <div class="rating-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <div class="rating-text">4.7 (1,234 reviews) • In Stock</div>
                </div>

                <!-- Product Tabs -->
                <div class="glass-card p-4 mb-4">
                    <p class="product-description mb-0">{{ $product->description }}</p>
                </div>

                    @auth
                        <div class="glass-card p-4 sticky-cart-sidebar">
                            <form method="POST" action="/cart/add/{{ $product->id }}">
                                @csrf

                                <div class="form-group-product">
                                    <label>Variation:</label>
                                    <select name="variation" class="form-control-product">
                                        <option value="Small">Small</option>
                                        <option value="Medium" selected>Medium</option>
                                        <option value="Large">Large</option>
                                    </select>
                                </div>

                                <div class="form-group-product">
                                    <label>Quantity:</label>
                                    <div class="quantity-stepper">
                                        <button type="button" class="qty-btn" onclick="changeQty(-1)">-</button>
                                        <input type="number" name="qty" id="qty" value="1" min="1" max="100" class="qty-input">
                                        <button type="button" class="qty-btn" onclick="changeQty(1)">+</button>
                                    </div>
                                </div>

                                <button type="submit" class="btn-add-to-cart w-100 py-3 mb-3">
                                    <i class="fa-solid fa-cart-plus me-2"></i>
                                    Add to Cart
                                </button>

                                <div class="text-center">
                                    <small class="text-muted">
                                        <i class="fas fa-shipping-fast me-1 text-success"></i> Free shipping • 
                                        <i class="fas fa-undo me-1 text-info"></i> 30-day returns
                                    </small>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="glass-card p-4 text-center sticky-cart-sidebar">
                            <a href="{{ route('register') }}" class="btn btn-register w-100">
                                <i class="fa-solid fa-user-plus me-2"></i> Create Account to Buy
                            </a>
                        </div>
                    @endauth

                    <!-- Mobile sticky CTA -->
                    <div class="mobile-cta-sticky d-lg-none">
                        <button onclick="addToCartMobile()" class="btn btn-add-to-cart w-100">
                            <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeQty(change) {
    const qty = document.getElementById('qty');
    let newVal = parseInt(qty.value) + change;
    if (newVal < 1) newVal = 1;
    if (newVal > 100) newVal = 100;
    qty.value = newVal;
}

function addToCartMobile() {
    const form = document.querySelector('form[method="POST"]');
    if (form) form.submit();
}

// Gallery thumb click (mock)
document.querySelectorAll('.gallery-thumb').forEach(thumb => {
    thumb.addEventListener('click', function() {
        document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        // Update main image (mock)
        const mainImg = document.querySelector('.product-main-image');
        if (mainImg) mainImg.src = this.src.replace(/\\d+\\d+/, '500x500');
    });
});

// Image zoom (mock)
document.querySelector('.product-image-container')?.addEventListener('click', function() {
    alert('Image zoom modal - coming soon!');
});
</script>

@endsection
