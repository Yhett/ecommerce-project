<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1>Add Product</h1>

<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <input type="text" name="name" placeholder="Product Name"><br><br>
    <textarea name="description" placeholder="Description"></textarea><br><br>
    <input type="number" name="price" placeholder="Price"><br><br>
    <input type="number" name="stock" placeholder="Stock"><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>