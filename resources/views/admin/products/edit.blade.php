@extends('admin.layout')

@section('admin_title', 'Edit Product')
@section('admin_subtitle', 'Update product details, category, stock, and storefront visibility.')

@section('content')
<div class="page-title">Edit Product</div>
<div class="page-subtitle">Make changes to this product and save when you're ready.</div>

<div class="card">
    <form method="POST" action="/admin/products/{{ $product->id }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ old('name', $product->name) }}">
        <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}">
        <input type="number" name="stock" value="{{ old('stock', $product->stock) }}">
        <select name="category">
            <option value="">Select Category</option>
            <option value="men" {{ old('category', $product->category) === 'men' ? 'selected' : '' }}>Men</option>
            <option value="women" {{ old('category', $product->category) === 'women' ? 'selected' : '' }}>Women</option>
        </select>
        <textarea name="description">{{ old('description', $product->description) }}</textarea>
        <input type="file" name="image">

        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
            <button type="submit" class="btn">Update Product</button>
            <a href="/admin/products" class="btn btn-secondary">Back</a>
        </div>
    </form>
</div>
@endsection
