@extends('layouts.admin')

@section('title', 'Create Discount - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Create Discount Code</h1>
    <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
</header>

<div class="form-card">
    <h2>Discount Parameters</h2>
    <form action="{{ route('admin.discounts.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label for="code">Promo Code</label>
                <input type="text" id="code" name="code" placeholder="e.g. AUTUMN25" value="{{ old('code') }}" style="text-transform: uppercase;" required>
                @error('code')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="type">Discount Type</label>
                <select id="type" name="type" required>
                    <option value="Percentage" {{ old('type') == 'Percentage' ? 'selected' : '' }}>Percentage Discount (%)</option>
                    <option value="Fixed" {{ old('type') == 'Fixed' ? 'selected' : '' }}>Fixed Amount Discount ($)</option>
                    <option value="Shipping" {{ old('type') == 'Shipping' ? 'selected' : '' }}>Free Shipping</option>
                </select>
                @error('type')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="amount" id="amount-label">Discount Value</label>
                <input type="number" id="amount" name="amount" step="0.01" min="0" placeholder="e.g. 20" value="{{ old('amount', 0) }}" required>
                @error('amount')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="status">Initial Status</label>
                <select id="status" name="status" required>
                    <option value="Active" {{ old('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Expired" {{ old('status') == 'Expired' ? 'selected' : '' }}>Expired</option>
                </select>
                @error('status')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="start_date">Start Date (Optional)</label>
                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}">
                @error('start_date')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="end_date">End Date (Optional)</label>
                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}">
                @error('end_date')
                    <span style="color: var(--status-red-text); font-size: 0.85rem; margin-top: 5px; display: block;">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-actions" style="margin-top: 2rem;">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Code</button>
            <a href="{{ route('admin.discounts.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

<script>
    // Automatic Code Capitalizer and Label Syncer
    const codeInput = document.getElementById('code');
    const typeSelect = document.getElementById('type');
    const amountLabel = document.getElementById('amount-label');
    const amountInput = document.getElementById('amount');

    codeInput.addEventListener('input', function() {
        codeInput.value = codeInput.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
    });

    typeSelect.addEventListener('change', function() {
        if (typeSelect.value === 'Percentage') {
            amountLabel.textContent = 'Discount Value (%)';
            amountInput.placeholder = 'e.g. 20';
            amountInput.disabled = false;
        } else if (typeSelect.value === 'Fixed') {
            amountLabel.textContent = 'Discount Value ($)';
            amountInput.placeholder = 'e.g. 10.00';
            amountInput.disabled = false;
        } else if (typeSelect.value === 'Shipping') {
            amountLabel.textContent = 'Discount Value (Locked)';
            amountInput.placeholder = '0.00';
            amountInput.value = '0';
            amountInput.disabled = true;
        }
    });

    // Run on startup
    typeSelect.dispatchEvent(new Event('change'));
</script>
@endsection
