<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
</head>
<body>

<h1>Product List</h1>

<a href="{{ route('products.create') }}">Add Product</a>

@foreach($products as $product)
    <div style="border:1px solid #000; margin:10px; padding:10px;">
        <h3>{{ $product->name }}</h3>
        <p>{{ $product->description }}</p>
        <p>Price: ₱{{ $product->price }}</p>
        <p>Stock: {{ $product->stock }}</p>
    </div>
@endforeach

</body>
</html>