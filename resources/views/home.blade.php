<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #f5f5f5 0%, #e8dff5 100%);
            background-attachment: fixed;
            margin: 0;
            padding: 0;
        }

        .hero {
            background: linear-gradient(135deg, #ba68c8, #ab47bc);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            flex-direction: column;
        }

        .featured-section {
            padding: 2rem 0 1rem;
        }

        .featured-heading {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .featured-heading h2 {
            color: #6a1b9a;
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .featured-heading p {
            color: #6c757d;
            max-width: 620px;
            margin: 0 auto;
        }

        .featured-carousel {
            width: 950px;
            max-width: 100%;
            margin: 0 auto;
            border-radius: 28px;
            overflow: hidden;
            box-shadow: 0 24px 48px rgba(156, 39, 176, 0.16);
            background: white;
        }

        .featured-slide {
            min-height: 360px;
            background: linear-gradient(160deg, rgba(255, 255, 255, 0.96), rgba(243, 229, 245, 0.94));
        }

        .featured-slide-image {
            height: 460px;
            width: 360px;
            object-fit: cover;
        }

        .featured-slide-image-wrap {
            height: 100%;
            min-height: 360px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
        }

        .featured-slide-content {
            height: 100%;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .featured-slide-content h3 {
            color: #6a1b9a;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .featured-slide-content p {
            color: #6c757d;
            margin-bottom: 1.25rem;
        }

        .featured-side-list {
            list-style: none;
            padding: 0;
            margin: 0 0 1.5rem;
            width: 100%;
            max-width: 320px;
        }

        .featured-side-list li {
            color: #4b3a57;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .featured-side-list i {
            color: #9c27b0;
        }

        .featured-carousel .carousel-inner {
            border-radius: 28px;
        }

        .featured-carousel .carousel-indicators [data-bs-target] {
            width: 12px;
            height: 12px;
            margin: 0 6px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .featured-carousel .carousel-control-prev,
        .featured-carousel .carousel-control-next {
            width: 12%;
        }

        .featured-carousel .carousel-control-prev-icon,
        .featured-carousel .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.35);
            border-radius: 50%;
            padding: 1.5rem;
        }

        footer {
            margin-top: 50px;
            background: linear-gradient(135deg, #ba68c8, #ab47bc);
            color: white;
            padding: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .featured-slide,
            .featured-slide-image {
                min-height: auto;
                height: 220px;
            }

            .featured-slide-image-wrap {
                min-height: auto;
                padding: 1rem;
            }

            .featured-slide-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>

@include('components.navbar-home')
@include('components.auth-modals')

<div class="hero">
    <h1>Welcome to NextMart</h1>
    <p>Best Online Shopping Experience</p>
    <a href="/products" class="btn btn-warning">Shop Now</a>
</div>

<div class="container featured-section my-5" id="products">
    <div class="featured-heading">
        <h2><i class="fa-solid fa-fire"></i> Featured Products</h2>
        <p>Explore our featured collection through an image carousel.</p>
    </div>

    @php
        $featuredImages = [
            asset('m1.jpg'),
            asset('m2.jpg'),
            asset('m3.jpg'),
            asset('m4.jpg'),
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
                        <div class="row g-0 align-items-stretch">
                            <div class="col-lg-7">
                                <div class="featured-slide-image-wrap">
                                    <img src="{{ $featuredImage }}" alt="Featured product image {{ $index + 1 }}" class="featured-slide-image">
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="featured-slide-content">
                                    <h3>New Fashion Highlights</h3>
                                    <p>Browse a rotating selection of styles curated for the season, from everyday essentials to statement looks.</p>
                                    <ul class="featured-side-list">
                                        <li><i class="fa-solid fa-check"></i> Dresses and casual styles</li>
                                        <li><i class="fa-solid fa-check"></i> Men's shirts and polos</li>
                                        <li><i class="fa-solid fa-check"></i> Women's tops and blouses</li>
                                        <li><i class="fa-solid fa-check"></i> Denim and jeans collection</li>
                                    </ul>
                                    <a href="/products" class="btn btn-warning">View Products</a>
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
    <p>&copy; 2026 NextMart - All Rights Reserved</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
