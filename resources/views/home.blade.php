<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --purple-gradient: linear-gradient(135deg, #cd9cd6, #985aa2);
            --purple-light: linear-gradient(135deg, #f7e8fb 0%, #ffffff 100%);
            --shadow-purple: rgba(156, 39, 176, 0.16);
        }

        body {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8dff5 100%);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            font-family: system-ui, -apple-system, sans-serif;
        }

        /* Hero with Moving Background */
        .hero {
            background: var(--purple-gradient);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: column;
            position: relative;
            overflow: hidden;
        }

        /* Bubble Animations */
        .bubble {
            position: absolute;
            border-radius: 50%;
            background: radial-gradient(circle at 30% 30%, rgba(186, 104, 200, 0.62), rgba(170, 71, 188, 0.55), transparent);
            pointer-events: none;
            will-change: transform;
            box-shadow: 0 0 20px rgba(186, 104, 200, 0.52);
        }

        .bubble-1 { width: 100px; height: 100px; left: 10%; animation: floatUpRight 25s infinite linear; animation-delay: 0s; }
        .bubble-2 { width: 80px; height: 80px; left: 20%; animation: floatUpLeft 22s infinite linear; animation-delay: 3s; }
        .bubble-3 { width: 60px; height: 60px; right: 15%; animation: floatUpLeft 18s infinite linear; animation-delay: 1s; }
        .bubble-4 { width: 120px; height: 120px; left: 70%; animation: floatUpRight 28s infinite linear; animation-delay: 6s; }
        .bubble-5 { width: 40px; height: 40px; right: 25%; animation: floatUpRight 15s infinite linear; animation-delay: 4s; }
        .bubble-6 { width: 30px; height: 30px; left: 40%; animation: floatUpLeft 10s infinite linear; animation-delay: 8s; }
        .bubble-7 { width: 70px; height: 70px; right: 40%; animation: floatDiagonal 20s infinite linear; animation-delay: 2s; }
        .bubble-8 { width: 50px; height: 50px; left: 80%; animation: floatUpLeft 12s infinite linear; animation-delay: 10s; }

        @keyframes floatUpRight {
            0% { transform: translateY(100vh) translateX(0) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) translateX(100px) scale(1.1); opacity: 0; }
        }

        @keyframes floatUpLeft {
            0% { transform: translateY(100vh) translateX(0) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100px) translateX(-100px) scale(1.1); opacity: 0; }
        }

        @keyframes floatDiagonal {
            0% { transform: translateY(100vh) translateX(0) rotate(0deg) scale(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-150px) translateX(150px) rotate(360deg) scale(1.2); opacity: 0; }
        }

        @media (prefers-reduced-motion: reduce) {
            .bubble { animation: none; opacity: 0.3; }
            .hero .btn-warning { animation: none; }
        }

        @media (max-width: 768px) {
            .bubble-1, .bubble-2, .bubble-4 { width: 60px; height: 60px; }
            .bubble-3, .bubble-5, .bubble-6, .bubble-7, .bubble-8 { width: 30px; height: 30px; }
        }

        .hero h1 {
            font-size: clamp(3.5rem, 8vw, 6rem);
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 8px 32px rgba(0,0,0,0.3);
            position: relative;
            z-index: 10;
        }

        .hero p {
            font-size: clamp(1.3rem, 3vw, 1.8rem);
            margin-bottom: 2.5rem;
            opacity: 0.95;
            max-width: 600px;
            position: relative;
            z-index: 10;
        }

        .hero .btn-warning {
            font-size: 1.2rem;
            font-weight: 700;
            padding: 1.25rem 3rem;
            border-radius: 50px;
            box-shadow: 0 16px 48px rgba(255,193,7,0.4);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            z-index: 10;
        }

        .hero .btn-warning:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 64px rgba(255,193,7,0.6);
        }

        /* Featured Section Enhanced */
        .featured-section {
            padding: 4rem 0 2rem;
            position: relative;
        }

        .featured-heading {
            text-align: center;
            margin-bottom: 3.5rem;
            position: relative;
        }

        .featured-heading::before {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: var(--purple-gradient);
            border-radius: 2px;
            box-shadow: 0 4px 12px var(--shadow-purple);
        }

        .featured-heading h2 {
            color: #6a1b9a;
            font-weight: 800;
            margin-bottom: 1rem;
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            position: relative;
        }

        .featured-heading h2::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--purple-gradient);
            border-radius: 2px;
        }

        .featured-heading p {
            color: #6c757d;
            max-width: 620px;
            margin: 0 auto;
            font-size: 1.2rem;
            font-weight: 300;
        }

        /* Enhanced Carousel */
        .featured-carousel {
            width: 1000px;
            max-width: 95%;
            margin: 0 auto;
            border-radius: 32px;
            overflow: hidden;
            box-shadow: 0 32px 80px var(--shadow-purple);
            background: white;
            border: 1px solid rgba(234, 216, 244, 0.5);
            backdrop-filter: blur(20px);
        }

        .featured-slide {
            min-height: 420px;
            background: var(--purple-light);
            position: relative;
            transition: transform 0.6s ease;
        }

        .featured-slide:hover {
            transform: scale(1.02);
        }

        .featured-slide-image {
            height: 500px;
            width: 400px;
            object-fit: cover;
            border-radius: 24px;
            box-shadow: 0 20px 60px var(--shadow-purple);
            transition: all 0.4s ease;
        }

        .featured-slide:hover .featured-slide-image {
            transform: scale(1.05);
        }

        .featured-slide-image-wrap {
            height: 100%;
            min-height: 420px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .featured-slide-content {
            height: 100%;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
        }

        .featured-slide-content h3 {
            color: #6a1b9a;
            font-weight: 800;
            margin-bottom: 1.5rem;
            font-size: clamp(1.8rem, 4vw, 2.5rem);
        }

        .featured-slide-content p {
            color: #6c757d;
            margin-bottom: 2rem;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        .featured-side-list {
            list-style: none;
            padding: 0;
            margin: 0 0 2rem 0;
            width: 100%;
        }

        .featured-side-list li {
            color: #4b3a57;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .featured-side-list li:hover {
            color: #6a1b9a;
        }

        .featured-side-list i {
            color: #9c27b0;
            font-size: 1.1rem;
            width: 20px;
        }

        /* Carousel Controls Enhanced */
        .featured-carousel .carousel-inner {
            border-radius: 32px;
        }

        .featured-carousel .carousel-indicators [data-bs-target] {
            width: 14px;
            height: 14px;
            margin: 0 8px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.6);
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .featured-carousel .carousel-indicators .active {
            background: white;
            transform: scale(1.2);
            border-color: #6a1b9a;
        }

        .featured-carousel .carousel-control-prev,
        .featured-carousel .carousel-control-next {
            width: 15%;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        .featured-carousel .carousel-control-prev:hover,
        .featured-carousel .carousel-control-next:hover {
            opacity: 1;
        }

        .featured-carousel .carousel-control-prev-icon,
        .featured-carousel .carousel-control-next-icon {
            background: var(--purple-gradient);
            border-radius: 50%;
            width: 60px;
            height: 60px;
            padding: 1rem;
            filter: drop-shadow(0 8px 24px rgba(186, 104, 200, 0.4));
        }

        /* Footer Enhanced */
        footer {
            margin-top: 80px;
            background: var(--purple-gradient);
            color: white;
            padding: 4rem 0 2rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        }

        footer h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            position: relative;
        }

        footer h5::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 40px;
            height: 2px;
            background: rgba(255,255,255,0.5);
        }

        footer a {
            color: rgba(255,255,255,0.8);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        footer a:hover {
            color: white;
            transform: translateX(5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .featured-slide-image {
                height: 280px;
                width: 100%;
            }

            .featured-slide-image-wrap {
                padding: 1rem;
            }

            .featured-slide-content {
                padding: 2rem 1.5rem;
                text-align: center;
                align-items: center;
            }

            footer {
                padding: 3rem 0 1.5rem;
            }
        }

        @media (max-width: 1200px) {
            .featured-carousel {
                width: 95%;
            }
        }
    </style>
</head>
<body>

@include('components.navbar-home')
@include('components.auth-modals')

<div class="hero">
    <!-- Bubbles Background -->
    <div class="bubble bubble-1"></div>
    <div class="bubble bubble-2"></div>
    <div class="bubble bubble-3"></div>
    <div class="bubble bubble-4"></div>
    <div class="bubble bubble-5"></div>
    <div class="bubble bubble-6"></div>
    <div class="bubble bubble-7"></div>
    <div class="bubble bubble-8"></div>
    
    <h1 class="animate__animated animate__fadeInDown">Welcome to NextMart</h1>
    <p class="animate__animated animate__fadeInUp animate__delay-1s">Best Online Shopping Experience</p>
    <a href="/products" class="btn btn-warning animate__animated animate__pulse animate__infinite animate__delay-2s">Shop Now</a>
</div>

<div class="container featured-section my-5" id="products">
    <div class="featured-heading">
        <h2><i class="fa-solid fa-fire"></i> Featured Products</h2>
        <p>Review your selected items, check your totals, and continue to checkout when you're ready.</p>
    </div>

    @php
        $featuredImages = [
            asset('m1.jpg'),
            asset('m2.jpg'),
            asset('m3.jpg'),
            asset('m4.jpg'),
        ];
        $slideTexts = [
            ['title' => 'Fashion Collection', 'subtitle' => 'Premium styles for every occasion'],
            ['title' => 'Trending Today', 'subtitle' => 'Latest trendy fashion'],
            ['title' => 'Match Your Outfits', 'subtitle' => 'Quality for your space'],
            ['title' => 'Todays Collection', 'subtitle' => 'Perfect for your style']
        ];
    @endphp

    <div id="featuredProductsCarousel" class="carousel slide featured-carousel" data-bs-ride="carousel" data-bs-interval="4500" data-bs-wrap="true" data-bs-pause="false">
        <div class="carousel-indicators">
            @foreach($featuredImages as $index => $featuredImage)
                <button type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}" {{ $index === 0 ? 'aria-current=true' : '' }} aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach($featuredImages as $index => $featuredImage)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <div class="featured-slide">
                        <div class="row g-0 h-100">
                            <div class="col-lg-7">
                                <div class="featured-slide-image-wrap">
                                    <img src="{{ $featuredImage }}" alt="Featured product {{ $index + 1 }}" class="featured-slide-image">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="featured-slide-content">
                                    <h3>{{ $slideTexts[$index]['title'] }}</h3>
                                    <p>{{ $slideTexts[$index]['subtitle'] }}</p>
                                    <ul class="featured-side-list">
                                        <li><i class="fa-solid fa-check"></i> Premium Quality</li>
                                        <li><i class="fa-solid fa-check"></i> Fast Delivery</li>
                                        <li><i class="fa-solid fa-check"></i> Secure Payment</li>
                                        <li><i class="fa-solid fa-check"></i> Easy Returns</li>
                                    </ul>
                                    <a href="/products" class="btn btn-warning">Explore Collection</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<footer class="footer">
    <p>&copy; 2026 NextMart - Premium Shopping Experience</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
