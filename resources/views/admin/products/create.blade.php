@extends('layouts.admin')

@section('title', 'Add New Product - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Add New Product</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

<div class="card" style="max-width: 900px; margin: 0 auto 3rem;">
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. Nami Lontar Original" required autocomplete="off">
                @error('name')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">URL Slug (Unique)</label>
                <input type="text" id="slug" name="slug" value="{{ old('slug') }}" placeholder="e.g. lontar-original" required autocomplete="off">
                @error('slug')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="price">Price ($)</label>
                <input type="number" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="15.50" required>
                @error('price')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="" disabled selected>Select a Category...</option>
                    <option value="SIGNATURE PRODUCT" {{ old('category') == 'SIGNATURE PRODUCT' ? 'selected' : '' }}>SIGNATURE PRODUCT</option>
                    <option value="DAILY FRESH" {{ old('category') == 'DAILY FRESH' ? 'selected' : '' }}>DAILY FRESH</option>
                    <option value="SNACK COLLECTION" {{ old('category') == 'SNACK COLLECTION' ? 'selected' : '' }}>SNACK COLLECTION</option>
                    <option value="READY TO COOK" {{ old('category') == 'READY TO COOK' ? 'selected' : '' }}>READY TO COOK</option>
                    <option value="GIFT BOX" {{ old('category') == 'GIFT BOX' ? 'selected' : '' }}>GIFT BOX</option>
                </select>
                @error('category')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <div style="display: flex; align-items: center; gap: 20px; border: 1px dashed var(--card-border); padding: 1.5rem; border-radius: 12px; background: rgba(255,255,255,0.01);">
                <div style="width: 80px; height: 80px; border-radius: 10px; border: 1px solid var(--card-border); display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.2); overflow: hidden;">
                    <img id="image-preview" src="{{ asset('assets/product photo/logo.png') }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.5;">
                </div>
                <div style="flex: 1;">
                    <input type="file" id="image" name="image" accept="image/*" required style="border: none; background: transparent; padding: 0;" onchange="previewFile()">
                    <span style="display: block; font-size: 0.75rem; color: var(--text-secondary); margin-top: 5px;">Allowed: JPEG, PNG, JPG, WEBP. Max size: 2MB.</span>
                </div>
            </div>
            @error('image')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter enticing product description..." required>{{ old('description') }}</textarea>
            @error('description')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
            <div class="form-group">
                <label for="ingredients">Ingredients (Optional)</label>
                <textarea id="ingredients" name="ingredients" rows="3" placeholder="Flour, Sugar, Butter...">{{ old('ingredients') }}</textarea>
                @error('ingredients')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="storage">Storage Notes (Optional)</label>
                <textarea id="storage" name="storage" rows="3" placeholder="Refrigerate for up to 5 days...">{{ old('storage') }}</textarea>
                @error('storage')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="artisan_note">Artisan Note (Optional)</label>
            <textarea id="artisan_note" name="artisan_note" rows="3" placeholder="Baked fresh at 180C for crispiness...">{{ old('artisan_note') }}</textarea>
            @error('artisan_note')
                <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--card-border);">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Product</button>
        </div>
    </form>
</div>

<script>
    // Automatic Slug Generation
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        let slug = this.value
            .toLowerCase()
            .replace(/[^\w\s-]/g, '') // remove special characters
            .replace(/[\s_]+/g, '-')  // replace spaces/underscores with dashes
            .replace(/^-+|-+$/g, ''); // trim leading/trailing dashes
        slugInput.value = slug;
    });

    // Image Preview Helper
    function previewFile() {
        const preview = document.getElementById('image-preview');
        const file = document.getElementById('image').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
            preview.style.opacity = 1;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
