@extends('layouts.admin')

@section('title', 'Add New Product - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Add New Product</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
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
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    <option value="" disabled selected>Select a Category...</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <span style="color: var(--status-red-text); font-size: 0.8rem; display: block; margin-top: 5px;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="image">Product Image</label>
            <div style="display: flex; align-items: center; gap: 20px; border: 1px dashed var(--card-border); padding: 1.5rem; border-radius: 12px; background: rgba(255,255,255,0.01);">
                <div style="width: 80px; height: 80px; border-radius: 10px; border: 1px solid var(--card-border); display: flex; align-items: center; justify-content: center; background: rgba(0,0,0,0.2); overflow: hidden;">
                    <img id="image-preview" src="{{ asset('assets/Logo.png') }}" style="width: 100%; height: 100%; object-fit: cover; opacity: 0.5;">
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

        {{-- ===== SIZE OPTIONS SECTION ===== --}}
        <div style="border: 1px solid var(--card-border); border-radius: 14px; padding: 1.5rem; margin-top: 0.5rem; background: rgba(255,255,255,0.02);">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <div>
                    <h3 style="margin: 0; font-size: 1rem; font-weight: 600;">Pilihan Ukuran (Size Options)</h3>
                    <p style="margin: 4px 0 0; font-size: 0.8rem; color: var(--text-secondary);">Aktifkan jika produk ini memiliki pilihan ukuran (berat, porsi, dll.)</p>
                </div>
                <label class="toggle-switch" style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                    <input type="checkbox" id="has_size_options" name="has_size_options" value="1"
                        {{ old('has_size_options') ? 'checked' : '' }}
                        onchange="toggleSizeOptions(this)"
                        style="display: none;">
                    <div id="toggle-track" style="width: 48px; height: 26px; border-radius: 999px; background: {{ old('has_size_options') ? 'var(--primary-color, #c8a96e)' : '#555' }}; position: relative; transition: background 0.3s;">
                        <div id="toggle-thumb" style="position: absolute; top: 3px; left: {{ old('has_size_options') ? '24px' : '3px' }}; width: 20px; height: 20px; border-radius: 50%; background: white; transition: left 0.3s;"></div>
                    </div>
                    <span id="toggle-label" style="font-size: 0.85rem; font-weight: 500; color: var(--text-secondary);">{{ old('has_size_options') ? 'Aktif' : 'Nonaktif' }}</span>
                </label>
            </div>

            <div id="size-options-panel" style="display: {{ old('has_size_options') ? 'block' : 'none' }};">
                <div id="size-rows-container">
                    @if(old('size_labels'))
                        @foreach(old('size_labels') as $i => $lbl)
                        <div class="size-row" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 10px; align-items: center; margin-bottom: 10px;">
                            <input type="text" name="size_labels[]" placeholder="Label ukuran (cth: 250gr, Small, 1 Lusin)" value="{{ $lbl }}" style="margin: 0;">
                            <select name="size_units[]" style="margin: 0;">
                                <option value="">-- Tipe Satuan --</option>
                                @foreach(['gram','kg','ml','liter','pcs','lusin','porsi','cm','inch'] as $u)
                                    <option value="{{ $u }}" {{ old("size_units.$i") === $u ? 'selected' : '' }}>{{ strtoupper($u) }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="this.closest('.size-row').remove()" style="background: rgba(220,53,69,0.15); color: #dc3545; border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 8px 12px; cursor: pointer; font-size: 1rem; line-height: 1;">&times;</button>
                        </div>
                        @endforeach
                    @else
                        <div class="size-row" style="display: grid; grid-template-columns: 1fr 1fr auto; gap: 10px; align-items: center; margin-bottom: 10px;">
                            <input type="text" name="size_labels[]" placeholder="Label ukuran (cth: 250gr, Small, 1 Lusin)" style="margin: 0;">
                            <select name="size_units[]" style="margin: 0;">
                                <option value="">-- Tipe Satuan --</option>
                                @foreach(['gram','kg','ml','liter','pcs','lusin','porsi','cm','inch'] as $u)
                                    <option value="{{ $u }}">{{ strtoupper($u) }}</option>
                                @endforeach
                            </select>
                            <button type="button" onclick="this.closest('.size-row').remove()" style="background: rgba(220,53,69,0.15); color: #dc3545; border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 8px 12px; cursor: pointer; font-size: 1rem; line-height: 1;">&times;</button>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addSizeRow()" style="margin-top: 5px; background: rgba(200,169,110,0.1); color: var(--primary-color, #c8a96e); border: 1px dashed var(--primary-color, #c8a96e); border-radius: 8px; padding: 8px 18px; cursor: pointer; font-size: 0.85rem; font-weight: 500;">
                    + Tambah Ukuran
                </button>
                <p style="margin-top: 10px; font-size: 0.75rem; color: var(--text-secondary);">
                    <strong>Label</strong> = teks yang tampil di tombol (misal: <em>250gr, 500gr, Small, Large, 1 Lusin</em>).<br>
                    <strong>Tipe Satuan</strong> = kategori satuan untuk referensi (opsional).
                </p>
            </div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid var(--card-border);">
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Create Product</button>
        </div>
    </form>
</div>

<script>
    // Toggle size options panel
    function toggleSizeOptions(checkbox) {
        const panel = document.getElementById('size-options-panel');
        const track = document.getElementById('toggle-track');
        const thumb = document.getElementById('toggle-thumb');
        const label = document.getElementById('toggle-label');
        if (checkbox.checked) {
            panel.style.display = 'block';
            track.style.background = 'var(--primary-color, #c8a96e)';
            thumb.style.left = '24px';
            label.textContent = 'Aktif';
        } else {
            panel.style.display = 'none';
            track.style.background = '#555';
            thumb.style.left = '3px';
            label.textContent = 'Nonaktif';
        }
    }

    // Template for a new size row
    function addSizeRow() {
        const unitOptions = ['gram','kg','ml','liter','pcs','lusin','porsi','cm','inch']
            .map(u => `<option value="${u}">${u.toUpperCase()}</option>`)
            .join('');

        const row = document.createElement('div');
        row.className = 'size-row';
        row.style.cssText = 'display: grid; grid-template-columns: 1fr 1fr auto; gap: 10px; align-items: center; margin-bottom: 10px;';
        row.innerHTML = `
            <input type="text" name="size_labels[]" placeholder="Label ukuran (cth: 250gr, Small, 1 Lusin)" style="margin: 0;">
            <select name="size_units[]" style="margin: 0;">
                <option value="">-- Tipe Satuan --</option>
                ${unitOptions}
            </select>
            <button type="button" onclick="this.closest('.size-row').remove()" style="background: rgba(220,53,69,0.15); color: #dc3545; border: 1px solid rgba(220,53,69,0.3); border-radius: 8px; padding: 8px 12px; cursor: pointer; font-size: 1rem; line-height: 1;">&times;</button>
        `;
        document.getElementById('size-rows-container').appendChild(row);
    }

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

