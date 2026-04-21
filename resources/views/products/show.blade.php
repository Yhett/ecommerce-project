@extends('layout')

@section('content')

<div class="container mt-4">

    <div class="row">

        <!-- IMAGE -->
        <div class="col-md-5">
            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/300' }}"
                 class="img-fluid">
        </div>

        <!-- DETAILS -->
        <div class="col-md-7">

            <h2>{{ $product->name }}</h2>
            <h4 class="text-success">PHP {{ number_format($product->price, 2) }}</h4>

            <p>{{ $product->description }}</p>

            @auth
                <form method="POST" action="/cart/add/{{ $product->id }}">
                    @csrf

                    <label>Variation:</label>
                    <select name="variation" class="form-control mb-2">
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                    </select>

                    <label>Quantity:</label>
                    <input type="number" name="qty" value="1" min="1" class="form-control mb-3">

                    <button class="btn btn-primary">
                        Add to Cart
                    </button>
                </form>
            @else
                <a href="{{ route('register') }}" class="btn btn-outline-dark">
                    Create an account to order
                </a>
            @endauth

        </div>

    </div>

</div>

@endsection
