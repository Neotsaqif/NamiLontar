@extends('layouts.admin')

@section('title', 'Manage Products - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Products Collection</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

@if(session('success'))
<div style="background: var(--status-green-bg); border: 1px solid var(--status-green-border); color: var(--status-green-text); padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; font-weight: 500; backdrop-filter: blur(10px); box-shadow: var(--shadow-subtle);">
    <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<div class="table-container">
    <div class="table-header-actions">
        <form action="{{ route('admin.products.index') }}" method="GET" style="display: flex; gap: 10px; align-items: center;">
            <input type="text" name="search" class="search-bar" placeholder="Search products by name or category..." value="{{ $search }}">
            <button type="submit" class="btn btn-secondary" style="padding: 0.75rem 1.25rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
            @if($search)
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary" style="padding: 0.75rem 1.25rem; opacity: 0.7;"><i class="fa-solid fa-xmark"></i></a>
            @endif
        </form>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fa-solid fa-plus"></i> Add Product
        </a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
            <tr>
                <td style="width: 80px; padding: 1rem 2rem;">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 55px; height: 55px; object-fit: cover; border-radius: 10px; border: 1px solid var(--card-border);">
                </td>
                <td style="font-weight: 600; color: var(--text-primary);">
                    {{ $product->name }}
                    <span style="display: block; font-size: 0.75rem; color: var(--text-secondary); font-weight: normal; margin-top: 2px;">slug: {{ $product->slug }}</span>
                </td>
                <td>
                    <span class="badge processing" style="background: rgba(212, 175, 55, 0.08); border-color: rgba(212, 175, 55, 0.3); color: var(--accent-color); box-shadow: none;">
                        {{ $product->category }}
                    </span>
                </td>
                <td style="font-family: var(--font-sans); font-weight: bold; color: var(--accent-color);">
                    ${{ number_format($product->price, 2) }}
                </td>
                <td>
                    <div style="display: flex; align-items: center; gap: 5px; color: var(--accent-color); font-size: 0.85rem;">
                        <i class="fa-solid fa-star"></i>
                        <span style="color: var(--text-primary); font-weight: 500;">{{ $product->rating }}</span>
                        <span style="color: var(--text-secondary); font-size: 0.75rem;">({{ $product->reviews }})</span>
                    </div>
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-radius: 8px;">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.8rem; border-radius: 8px; color: var(--status-red-text); border-color: rgba(198, 40, 40, 0.2); background: rgba(198, 40, 40, 0.03);">
                                <i class="fa-solid fa-trash-can"></i> Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; color: var(--text-secondary); padding: 4rem 2rem;">
                    <i class="fa-solid fa-cookie" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3; display: block;"></i>
                    No products found matching the query.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
