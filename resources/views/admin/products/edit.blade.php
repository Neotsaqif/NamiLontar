@extends('layouts.admin')

@section('title', 'Edit Product - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Edit Product: {{ $product->name }}</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

<div class="card" style="max-width: 900px; margin: 0 auto 3rem;">
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required autocomplete="off">
                @error('name')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">URL Slug (Unique)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug', $product->slug) }}" required autocomplete="off">
                @error('slug')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" required>
                @error('price')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image (Leave blank to keep current image)</label>
            <div style="display: flex; align-items: center; gap: 20px; border: 1px dashed var(--card-border); padding: 1.5rem; border-radius: 12px; background: rgba(255,255,255,0.01);">
                <div style="width: 80px; height: 80px; border-radius: 10px; border: 1px solid var(--card-border); display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.2); overflow: hidden;">
                    <img id="image-preview" src="{{ asset($product->image) }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="flex: 1;">
                    <input type="file" id="image" name="image" accept="image/*" style="border: none; background: transparent; padding: 0;" onchange="previewFile()">
                    <span style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-top: 5px;">Allowed: JPEG, PNG, JPG, WEBP. Max size: 2MB.</span>
                </div>
            </div>
            @error('image')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required>{{ old('description', $product->description) }}</textarea>
            @error('description')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="ingredients">Ingredients (Optional)</label>
                <textarea id="ingredients" name="ingredients" rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
                @error('ingredients')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="storage">Storage Notes (Optional)</label>
                <textarea id="storage" name="storage" rows="3">{{ old('storage', $product->storage) }}</textarea>
                @error('storage')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="artisan_note">Artisan Note (Optional)</label>
            <textarea id="artisan_note" name="artisan_note" rows="3">{{ old('artisan_note', $product->artisan_note) }}</textarea>
            @error('artisan_note')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--card-border);">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
    </form>
</div>

<script>
    // Automatic Slug Generation (Only if name changes and user wants to edit slug)
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '') 
            .replace(/[\s_]+/g, '-')  
            .replace(/^-+|-+$/g, ''); 
        slugInput.value = slug;
    });

    // Image Preview Helper
    function previewFile() {
        const preview = document.getElementById('image-preview');
        const file = document.getElementById('image').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
