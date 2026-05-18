@extends('layout')

@section('content')
<style>
    .products-page {
        padding-bottom: 3rem;
    }

    html.dark-mode .products-page {
        color: #ebe6f3;
    }

    .products-hero {
        position: relative;
        border-radius: 24px;
        min-height: 520px;
        margin-bottom: 2rem;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(155, 39, 176, 0.1);
        background: #120818;
    }

    .products-hero-video {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .products-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(33, 10, 46, 0.66), rgba(123, 36, 143, 0.27));
    }

    .products-hero-content {
        position: relative;
        z-index: 1;
        min-height: 420px;
        display: flex;
        align-items: center;
        padding: 3rem 2rem;
    }

    .products-hero h1 {
        color: #fff;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }

    .products-hero p {
        color: rgba(255, 255, 255, 0.88);
        max-width: 640px;
        margin-bottom: 0;
    }

    .products-stat {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.4);
        border-radius: 18px;
        padding: 1rem 1.25rem;
        text-align: center;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.16);
        backdrop-filter: blur(6px);
    }

    .products-stat strong {
        display: block;
        color: #9c27b0;
        font-size: 1.5rem;
    }

    .products-filter {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
        margin-bottom: 1.75rem;
    }

    .products-filter a {
        text-decoration: none;
        padding: 0.7rem 1rem;
        border-radius: 999px;
        border: 1px solid #ead7f1;
        background: white;
        color: #6a1b9a;
        font-weight: 600;
        box-shadow: 0 8px 18px rgba(156, 39, 176, 0.06);
        transition: all 0.2s ease;
    }

    .products-filter a:hover,
    .products-filter a.active {
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        color: white;
        border-color: transparent;
    }

    .products-grid-card {
        height: 100%;
        border: 1px solid #ead7f1;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 12px 30px rgba(156, 39, 176, 0.09);
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .products-grid-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(156, 39, 176, 0.14);
    }

    .products-grid-card img {
        height: 220px;
        object-fit: cover;
    }

    .product-price {
        color: #9c27b0;
        font-size: 1.15rem;
        font-weight: 700;
    }

    .product-description {
        color: #6c757d;
        min-height: 48px;
    }

    .products-toolbar {
        display: flex;
        gap: 1rem;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        position: sticky;
        top: 59px;
        z-index: 950;
        padding: 1rem 1.1rem;
        border-radius: 28px;
        background: rgba(212, 182, 236, 0.61);
        border: 1px solid rgba(111, 83, 122, 0.95);
        backdrop-filter: blur(14px);
        box-shadow: 0 16px 38px rgba(156, 39, 176, 0.1);
        margin-bottom: 1.75rem;
    }

    .products-search-form {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid #ead7f1;
        box-shadow: 0 14px 34px rgba(156, 39, 176, 0.08);
        min-width: min(100%, 470px);
    }

    .products-search-field {
        display: flex;
        align-items: center;
        gap: 0.85rem;
        flex: 1 1 auto;
        min-width: 0;
        padding: 0 0.85rem;
    }

    .products-search-icon {
        color: #9c27b0;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .products-search-input {
        width: 100%;
        min-width: 0;
        border: none;
        background: transparent;
        padding: 0.8rem 0;
        color: #4b3a57;
        outline: none;
    }

    .products-search-input::placeholder {
        color: #9a8aa3;
    }

    .products-search-button,
    .products-search-reset {
        border-radius: 999px;
        padding: 0.85rem 1.2rem;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: all 0.2s ease;
    }

    .products-search-button {
        border: none;
        color: white;
        background: linear-gradient(135deg, #ba68c8, #9c27b0);
        box-shadow: 0 10px 22px rgba(156, 39, 176, 0.18);
    }

    .products-search-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 14px 24px rgba(156, 39, 176, 0.22);
    }

    .products-search-reset {
        border: 1px solid #ead7f1;
        color: #6a1b9a;
        background: white;
    }

    .products-search-reset:hover {
        border-color: #d7b9e6;
        background: #faf5fc;
    }

    .products-search-form:focus-within {
        border-color: rgba(156, 39, 176, 0.35);
        box-shadow: 0 18px 36px rgba(156, 39, 176, 0.14);
    }

    html.dark-mode .products-toolbar {
        background: rgba(23, 26, 36, 0.9);
        border-color: rgba(202, 157, 228, 0.18);
        box-shadow: 0 16px 38px rgba(0, 0, 0, 0.32);
    }

    html.dark-mode .products-filter a,
    html.dark-mode .products-search-form {
        background: rgba(16, 20, 29, 0.92);
        border-color: rgba(202, 157, 228, 0.18);
        color: #f0e5fa;
    }

    html.dark-mode .products-search-input {
        color: #f0e5fa;
    }

    html.dark-mode .products-search-input::placeholder {
        color: #8e84a0;
    }

    html.dark-mode .products-search-reset {
        background: rgba(255, 255, 255, 0.04);
        color: #f0e5fa;
    }

    html.dark-mode .products-grid-card {
        background: #171b24;
        border-color: rgba(202, 157, 228, 0.16);
        box-shadow: 0 16px 32px rgba(0, 0, 0, 0.24);
    }

    html.dark-mode .product-description {
        color: #b8abc7;
    }

    @media (max-width: 767px) {
        .products-hero,
        .products-hero-content {
            min-height: 360px;
        }

        .products-hero-content {
            padding: 2rem 1.25rem;
        }

        .products-toolbar {
            top: 76px;
            padding: 0.9rem;
            border-radius: 24px;
        }

        .products-search-form {
            min-width: 100%;
            border-radius: 24px;
            flex-wrap: wrap;
            padding: 0.85rem;
        }

        .products-search-field {
            width: 100%;
            padding: 0 0.35rem;
        }

        .products-search-button,
        .products-search-reset {
            flex: 1 1 calc(50% - 0.375rem);
            text-align: center;
        }
    }
</style>
<div class="products-page">
    <section class="products-hero">
        <video class="products-hero-video" autoplay muted loop playsinline preload="auto" poster="https://via.placeholder.com/1200x500?text=NextMart+Products">
            <source src="{{ asset('sh.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div class="products-hero-overlay"></div>
        <div class="products-hero-content">
            <div class="row align-items-center g-4 w-100">
                <div class="col-lg-8">
                    <span class="badge text-bg-warning mb-3">NextMart Catalog</span>
                    <h1>All Products</h1>
                    <p>Browse everything currently available in the store. You can open any item to see more details and add it to your cart.</p>
                </div>

            </div>
        </div>
    </section>

    <div class="products-toolbar">
        <div class="products-filter">
            <a href="{{ url('/products' . ($search ? '?search=' . urlencode($search) : '')) }}" class="{{ empty($selectedCategory) ? 'active' : '' }}">All</a>
            <a href="{{ url('/products?category=men' . ($search ? '&search=' . urlencode($search) : '')) }}" class="{{ $selectedCategory === 'men' ? 'active' : '' }}">Men</a>
            <a href="{{ url('/products?category=women' . ($search ? '&search=' . urlencode($search) : '')) }}" class="{{ $selectedCategory === 'women' ? 'active' : '' }}">Women</a>
            <a href="{{ url('/products?category=kids' . ($search ? '&search=' . urlencode($search) : '')) }}" class="{{ $selectedCategory === 'kids' ? 'active' : '' }}">Kids</a>
        </div>

        <form method="GET" action="/products" class="products-search-form">
            @if($selectedCategory)
                <input type="hidden" name="category" value="{{ $selectedCategory }}">
            @endif

            <div class="products-search-field">
                <i class="fa-solid fa-magnifying-glass products-search-icon" aria-hidden="true"></i>
                <input
                    type="search"
                    name="search"
                    value="{{ $search }}"
                    class="products-search-input"
                    placeholder="Search products, styles, or category"
                    aria-label="Search products"
                >
            </div>
            <button type="submit" class="products-search-button">Search</button>

            @if($search !== '')
                <a href="{{ $selectedCategory ? url('/products?category=' . urlencode($selectedCategory)) : url('/products') }}" class="products-search-reset">
                    Clear
                </a>
            @endif
        </form>
    </div>

    @if($products->isEmpty())
        <div class="alert alert-light border text-center py-5">
            <h4 class="mb-2">No products found</h4>
            <p class="text-muted mb-0">
                @if($search !== '' && $selectedCategory)
                    No {{ $selectedCategory }} products matched "{{ $search }}".
                @elseif($search !== '')
                    No products matched "{{ $search }}".
                @elseif($selectedCategory)
                    No {{ $selectedCategory }} products are available yet.
                @else
                    Add products from the admin panel and they will appear here.
                @endif
            </p>
        </div>
    @else
        <div class="row g-4">
            @foreach($products as $product)
                <div class="col-sm-6 col-lg-4 col-xl-3">
                    <div class="card products-grid-card">
                        <img
                            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x400?text=Product' }}"
                            class="card-img-top"
                            alt="{{ $product->name }}"
                        >

                        <div class="card-body d-flex flex-column">
                            @if(!empty($product->featured))
                                <span class="badge text-bg-warning align-self-start mb-2">Featured</span>
                            @endif

                            <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                            <p class="product-price mb-2">PHP {{ number_format($product->price, 2) }}</p>
                            <p class="product-description">
                                {{ \Illuminate\Support\Str::limit($product->description ?: 'No description available for this product yet.', 80) }}
                            </p>

                            <div class="mt-auto d-flex gap-2">
                                <a href="/products/{{ $product->id }}" class="btn btn-outline-dark btn-sm flex-fill">View</a>
                                @auth
                                    <form method="POST" action="/cart/add/{{ $product->id }}" class="flex-fill">
                                        @csrf
                                        <button type="submit" class="btn btn-sm w-100 fw-bold" style="background: linear-gradient(135deg, #ba68c8, #ab47bc); color: white; border: none; transition: all 0.3s ease;">
                                            <i class="fa-solid fa-cart-plus"></i> Add
                                        </button>
                                    </form>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
