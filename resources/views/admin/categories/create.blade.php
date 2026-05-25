@extends('layouts.admin')

@section('title', 'Add Category - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Add New Category</h1>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
</header>

<div class="form-card">
    <h2>Category Details</h2>
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" id="name" name="name" placeholder="e.g. Signature Pastries" value="{{ old('name') }}" required>
                @error('name')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">URL Slug</label>
                <input type="text" id="slug" name="slug" placeholder="signature-pastries" value="{{ old('slug') }}" required>
                @error('slug')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Provide a brief summary of this category..." rows="5">{{ old('description') }}</textarea>
            @error('description')
                <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-actions" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Automatic Slug Generation
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        const slugValue = nameInput.value
            .toLowerCase()
            .replace(/[^a-z0-9 -]/g, '') // remove invalid chars
            .replace(/\s+/g, '-') // collapse whitespace and replace by -
            .replace(/-+/g, '-'); // collapse dashes

        slugInput.value = slugValue;
    });
</script>
@endsection
