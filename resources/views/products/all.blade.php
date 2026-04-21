@extends('layout')

@section('content')

<h1>All Products</h1>

<div class="row">
@foreach($products as $product)
    <div class="col-md-3 mb-4">

        <div class="card p-2">

            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/200' }}"
                 class="card-img-top">

            <div class="card-body text-center">

                <h5>{{ $product->name }}</h5>
                <p>₱{{ $product->price }}</p>

                <a href="/products/{{ $product->id }}" class="btn btn-info btn-sm">
                    View Product
                </a>

            </div>

        </div>

    </div>
@endforeach
</div>

@endsection