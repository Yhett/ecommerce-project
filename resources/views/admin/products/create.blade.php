@extends('admin.layout')

@section('admin_title', 'Add Product')
@section('admin_subtitle', 'Create a new catalog item for the storefront.')

@section('content')
<div class="page-title">Add Product</div>
<div class="page-subtitle">Fill in the product details below and publish it to your store.</div>

<div class="card">
    <form method="POST" action="/admin/products" enctype="multipart/form-data">
        @csrf

        <input type="text" name="name" placeholder="Product Name" value="{{ old('name') }}">
        <input type="number" step="0.01" name="price" placeholder="Price" value="{{ old('price') }}">
        <input type="number" name="stock" placeholder="Stock" value="{{ old('stock') }}">
        <select name="category">
            <option value="">Select Category</option>
            <option value="men" {{ old('category') === 'men' ? 'selected' : '' }}>Men</option>
            <option value="women" {{ old('category') === 'women' ? 'selected' : '' }}>Women</option>
        </select>
        <textarea name="description" placeholder="Description">{{ old('description') }}</textarea>
        <input type="file" name="image">

        <div style="display:flex; gap:0.75rem; flex-wrap:wrap;">
            <button type="submit" class="btn">Save Product</button>
            <a href="/admin/products" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
