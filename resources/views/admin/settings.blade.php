@extends('layouts.admin')

@section('title', 'Settings - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Settings</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

<div class="card">
    <div class="settings-section">
        <h2><i class="fa-solid fa-store"></i> General Information</h2>
        <div class="form-group">
            <label>Store Name</label>
            <input type="text" value="Nami Lontar Bakery">
        </div>
        <div class="form-group">
            <label>Contact Email</label>
            <input type="email" value="hello@namilontar.com">
        </div>
        <div class="form-group">
            <label>Store Description</label>
            <textarea rows="4">Artisanal Pastries in Every Golden Bite. We believe that time is the most important ingredient in modern baking.</textarea>
        </div>
    </div>

    <div class="settings-section">
        <h2><i class="fa-solid fa-money-check-dollar"></i> Currency & Payment</h2>
        <div class="form-group">
            <label>Default Currency</label>
            <select>
                <option value="USD" selected>USD ($)</option>
                <option value="EUR">EUR (€)</option>
                <option value="IDR">IDR (Rp)</option>
            </select>
        </div>
    </div>

    <div class="settings-actions">
        <button class="btn btn-secondary" style="margin-right: 1rem;">Cancel</button>
        <button class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Settings</button>
    </div>
</div>
@endsection
