@extends('layout')

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(135deg, #ba68c8, #ab47bc); color: white; text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">About NextMart</h1>
                <p class="lead mb-5 animate__animated animate__fadeInUp animate__delay-1s" style="font-size: 1.4rem;">
                    Premium Fashion for Men & Women | Quality • Style • Comfort
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/products" class="btn btn-light btn-lg px-5 py-3 fw-semibold shadow-lg" style="border-radius: 50px;">
                        <i class="fa-solid fa-shop me-2"></i>Shop Collection
                    </a>
                    <a href="#our-story" class="btn btn-outline-light btn-lg px-5 py-3 fw-semibold" style="border-radius: 50px;">
                        <i class="fa-solid fa-heart me-2"></i>Our Story
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Story -->
<section id="our-story" class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Fashion Design Studio" class="img-fluid rounded-4 shadow-lg" style="height: 500px; object-fit: cover;">
            </div>
            <div class="col-lg-6">
                <div class="animate__animated animate__fadeInUp">
                    <span class="badge bg-primary mb-3 px-3 py-2 fs-6 fw-semibold">Since 2020</span>
                    <h2 class="display-5 fw-bold mb-4" style="color: #2f2340;">Premium Fashion for Modern Men & Women</h2>
                    <p class="lead mb-4" style="color: #6c757d; font-size: 1.2rem;">
                        NextMart is your premier destination for men's and women's fashion. We curate only the highest quality clothing that combines timeless style with modern comfort.
                    </p>
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fa-solid fa-shirt fa-2x text-primary"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Premium Fabrics</h5>
                                    <p class="mb-0" style="color: #6c757d;">100% cotton, silk blends, sustainable materials</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-3 me-3">
                                    <i class="fa-solid fa-truck fa-2x text-success"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold mb-1">Fast Delivery</h5>
                                    <p class="mb-0" style="color: #6c757d;">Metro Manila: 24hrs • Provinces: 2-3 days</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="/products" class="btn btn-primary btn-lg px-5 py-3 shadow-lg">
                        <i class="fa-solid fa-shopping-bag me-2"></i>Shop Now
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What We Offer -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-4 fw-bold mb-3" style="color: #2f2340;">Men's & Women's Fashion</h2>
            <p class="lead" style="color: #6c757d; font-size: 1.3rem; max-width: 700px; margin: 0 auto;">
                Complete wardrobe solutions for the modern man and woman
            </p>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                    <div class="mb-4">
                        <i class="fa-solid fa-user-tie fa-4x text-primary mb-3"></i>
                    </div>
                    <h4 class="h3 fw-bold mb-3">Men's Collection</h4>
                    <p class="text-muted mb-4">Formal shirts, casual tees, trousers, jackets, accessories</p>
                    <a href="/products?category=men" class="btn btn-outline-primary">Shop Men's</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                    <div class="mb-4">
                        <i class="fa-solid fa-user-dress fa-4x text-danger mb-3"></i>
                    </div>
                    <h4 class="h3 fw-bold mb-3">Women's Collection</h4>
                    <p class="text-muted mb-4">Dresses, blouses, skirts, pants, elegant accessories</p>
                    <a href="/products?category=women" class="btn btn-outline-danger">Shop Women's</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                    <div class="mb-4">
                        <i class="fa-solid fa-shirt fa-4x text-success mb-3"></i>
                    </div>
                    <h4 class="h3 fw-bold mb-3">Casual Wear</h4>
                    <p class="text-muted mb-4">T-Shirts, hoodies, jeans, sneakers for everyday</p>
                    <a href="/products?category=casual" class="btn btn-outline-success">Daily Essentials</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="text-center p-4 h-100 border rounded-4 shadow-sm hover-lift">
                    <div class="mb-4">
                        <i class="fa-solid fa-star fa-4x text-warning mb-3"></i>
                    </div>
                    <h4 class="h3 fw-bold mb-3">Featured</h4>
                    <p class="text-muted mb-4">Limited edition & best sellers</p>
                    <a href="/products?featured=true" class="btn btn-outline-warning">Best Sellers</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us -->
<section class="py-5" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 order-lg-2">
                <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" 
                     alt="Happy Customers" class="img-fluid rounded-4 shadow-lg" style="height: 450px; object-fit: cover;">
            </div>
            <div class="col-lg-6 order-lg-1 ps-lg-5">
                <span class="badge bg-success bg-opacity-10 text-success px-4 py-2 fs-6 mb-4">Why NextMart?</span>
                <h2 class="display-5 fw-bold mb-4" style="color: #2f2340;">Fashion That Fits Your Lifestyle</h2>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-primary bg-opacity-20 rounded-circle p-3 me-4 mt-1">
                                <i class="fa-solid fa-thumbs-up fa-lg text-primary"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Curated Quality</h5>
                                <p class="mb-0" style="color: #6c757d;">Every piece is carefully selected for superior fit, fabric quality, and timeless design</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-4">
                            <div class="bg-success bg-opacity-20 rounded-circle p-3 me-4 mt-1">
                                <i class="fa-solid fa-shipping-fast fa-lg text-success"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">Lightning Fast Delivery</h5>
                                <p class="mb-0" style="color: #6c757d;">Same-day delivery in Metro Manila, nationwide shipping within 48 hours</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex align-items-start">
                            <div class="bg-warning bg-opacity-20 rounded-circle p-3 me-4 mt-1">
                                <i class="fa-solid fa-headset fa-lg text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold mb-2">24/7 Support</h5>
                                <p class="mb-0" style="color: #6c757d;">Dedicated fashion experts ready to help with sizing, styling, and fit advice</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section class="py-5 bg-primary bg-opacity-10">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3">
                <i class="fa-solid fa-users fa-4x text-primary mb-3"></i>
                <h3 class="display-4 fw-bold" style="color: #6a1b9a;">10K+</h3>
                <p class="h5 fw-semibold text-muted">Satisfied Customers</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-shirt fa-4x text-primary mb-3"></i>
                <h3 class="display-4 fw-bold" style="color: #6a1b9a;">5K+</h3>
                <p class="h5 fw-semibold text-muted">Fashion Items</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-truck fa-4x text-primary mb-3"></i>
                <h3 class="display-4 fw-bold" style="color: #6a1b9a;">99%</h3>
                <p class="h5 fw-semibold text-muted">On-Time Delivery</p>
            </div>
            <div class="col-md-3">
                <i class="fa-solid fa-star fa-4x text-warning mb-3"></i>
                <h3 class="display-4 fw-bold" style="color: #6a1b9a;">4.9⭐</h3>
                <p class="h5 fw-semibold text-muted">Average Rating</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-5" style="background: var(--purple-gradient); color: white; text-align: center;">
    <div class="container">
        <h2 class="display-4 fw-bold mb-4">Ready to Elevate Your Style?</h2>
        <p class="lead mb-5" style="font-size: 1.4rem; opacity: 0.95;">Join thousands of fashion-forward customers</p>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="/products?category=men" class="btn btn-light btn-lg w-100 mb-3 mb-md-0">
                            <i class="fa-solid fa-user-tie me-2"></i>Men's Fashion
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/products?category=women" class="btn btn-outline-light btn-lg w-100 mb-3 mb-md-0">
                            <i class="fa-solid fa-user-dress me-2"></i>Women's Fashion
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a href="/products" class="btn btn-warning btn-lg w-100">
                            <i class="fa-solid fa-fire me-2"></i>All Collections
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

