<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6fa;
        }

        .cart-box {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 8px;
        }

        .total-box {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- NAV -->
<nav class="navbar navbar-dark bg-dark px-3">
    <a href="/" class="navbar-brand">QuickShop</a>
</nav>

<div class="container my-5">

    <h2 class="mb-4">🛒 Your Cart</h2>

    <div class="cart-box">

        @php $total = 0; @endphp

        @foreach($cart as $item)
            @php
                $subtotal = $item->product->price * $item->quantity;
                $total += $subtotal;
            @endphp

            <div class="row align-items-center border-bottom py-3">

                <div class="col-md-2">
                    <img src="{{ $item->product->image ?? 'https://via.placeholder.com/80' }}"
                         class="product-img">
                </div>

                <div class="col-md-4">
                    <h5>{{ $item->product->name }}</h5>
                    <p class="text-muted">₱{{ $item->product->price }}</p>
                </div>

                <div class="col-md-2">
                    Qty: <strong>{{ $item->quantity }}</strong>
                </div>

                <div class="col-md-2">
                    ₱{{ $subtotal }}
                </div>

                <div class="col-md-2 text-end">
                    <a href="/remove-from-cart/{{ $item->id }}"
                       class="btn btn-danger btn-sm">
                        Remove
                    </a>
                </div>

            </div>
        @endforeach

        <hr>

        <div class="d-flex justify-content-between align-items-center">
            <div class="total-box">
                Total: ₱{{ $total }}
            </div>

            <a href="/checkout" class="btn btn-success btn-lg">
                Checkout
            </a>
        </div>

    </div>
</div>

</body>
</html>