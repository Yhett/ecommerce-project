<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NextMart - Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #acc7ac;
        }

        .navbar {
            background: #081303;
        }

        .navbar-brand {
            font-weight: bold;
            color: #fff !important;
        }
        .navbar .btn {
             border-radius: 8px;
            padding: 5px 12px;
            font-size: 13px;
            transition: 0.3s;
        }

        /* hover effect */
        .navbar .btn:hover {
             transform: translateY(-2px);
        }
        .hero {
            background: linear-gradient(to right, #111111, #2e492b);
            color: white;
            padding: 80px 20px;
            text-align: center;
        }

        .product-card {
            border: none;
            transition: 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .price {
            color: #28a745;
            font-weight: bold;
        }
        .product-icons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 10px;
        }

        .product-icons i {
            font-size: 20px;
            color: #555;
            cursor: pointer;
            transition: 0.3s;
            padding: 10px;
            border-radius: 50%;
            background: #f2f2f2;
        }

        .product-icons i:hover {
            color: #fff;
            background: #e91e63;
            transform: scale(1.1);
        }

        /* FOOTER */
        footer {
             margin-top: 50px;
            background: #0c1a04;
            color: white;
            padding: 20px;
            text-align: center;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark px-4">

    <a class="navbar-brand" href="#">NextMart</a>

    <div class="ms-auto d-flex align-items-center gap-2">

        <a href="/" class="btn btn-light btn-sm">Home</a>

        <a href="/cart" class="btn btn-warning btn-sm">Cart</a>

        <a href="/login" class="btn btn-outline-light btn-sm">Login</a>

    </div>

</nav>

<!-- HERO -->
<div class="hero">
    <h1>Welcome to NextMart</h1>
    <p>Best Online Shopping Experience</p>
    <a href="#products" class="btn btn-warning">Shop Now</a>
</div>

<!-- FEATURED PRODUCTS -->
<div class="container my-5" id="products">

    <h2 class="mb-4"><i class="fa-solid fa-fire"></i> Featured Products</h2>

    <div class="row mb-5">
        @foreach($products->where('featured', true) as $product)
        <div class="col-md-3 mb-4">

            <div class="card product-card p-2">

                <img src="{{ $product->image ?? 'https://via.placeholder.com/200' }}"
                     class="card-img-top">

                <div class="card-body text-center">

                    <span class="badge bg-warning text-dark mb-2">Featured</span>

                    <h5>{{ $product->name }}</h5>
                    <p class="price">₱{{ $product->price }}</p>

                    <a href="/add-to-cart/{{ $product->id }}"
                       class="btn btn-primary btn-sm">
                        Add to Cart
                    </a>

                </div>
            </div>

        </div>
        @endforeach
    </div>

    <!-- ALL PRODUCTS -->
    <h2 class="mb-4"><i class="fa-solid fa-bag-shopping"></i> All Products</h2>

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-3 mb-4">

            <div class="card product-card p-2">

                <img src="{{ $product->image ?? 'https://via.placeholder.com/200' }}"
                     class="card-img-top">

                <div class="card-body text-center">

                    <h5>{{ $product->name }}</h5>
                    <p class="price">₱{{ $product->price }}</p>

                    <a href="/add-to-cart/{{ $product->id }}"
                       class="btn btn-primary btn-sm">
                        Add to Cart
                    </a>

                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

<!-- FOOTER -->
<footer class="footer">
    <p>© 2026 NextMart - All Rights Reserved</p>
</footer>

</body>
</html>