@extends('admin.layout')

@section('admin_title', 'Products')
@section('admin_subtitle', 'Manage the catalog, pricing, category tags, and featured items.')

@section('content')
<div class="d-flex" style="justify-content: space-between; align-items: center; margin-bottom: 1rem; gap: 1rem; flex-wrap: wrap;">
    <div>
        <div class="page-title">Product Inventory</div>
        <div class="page-subtitle">View, edit, and organize every product in your store.</div>
    </div>
    <a href="/admin/products/create" class="btn">+ Add Product</a>
</div>

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<div class="card">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->category ? ucfirst($p->category) : 'Uncategorized' }}</td>
                    <td>PHP {{ number_format($p->price, 2) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ $p->featured ? 'Yes' : 'No' }}</td>
                    <td>
                        <div class="table-actions">
                            <a href="/admin/products/{{ $p->id }}/edit" class="btn btn-secondary">Edit</a>
                            <form action="/admin/products/{{ $p->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="padding: 1.5rem 0; color: #7a7085;">No products found yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
