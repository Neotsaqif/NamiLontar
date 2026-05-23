@extends('layouts.admin')

@section('title', 'Settings - Under Maintenance')

@section('content')
<header class="page-header">
    <h1>Settings</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
        </div>
    </div>
</header>

<div class="card" style="padding: 4rem 2rem; text-align: center; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; overflow: hidden; position: relative;">
    
    <!-- Background glowing accents -->
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 300px; height: 300px; background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%); z-index: 0; pointer-events: none;"></div>

    <!-- Content -->
    <div style="position: relative; z-index: 1;">
        <!-- Animated Gear Icon -->
        <div style="margin-bottom: 2rem; display: inline-block;">
            <i class="fa-solid fa-gear" style="font-size: 5rem; color: var(--accent-color); animation: spin 8s linear infinite; filter: drop-shadow(0 0 15px rgba(212,175,55,0.4));"></i>
        </div>

        <h2 style="font-size: 2.2rem; color: var(--text-primary); margin-bottom: 1rem; font-family: var(--font-serif);">Under Maintenance</h2>
        
        <p style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.6; max-width: 500px; margin: 0 auto 2.5rem;">
            We are currently upgrading the settings engine to bring you advanced configuration features. This module will be back online shortly.
        </p>

        <a href="{{ url('/admin/dashboard') }}" class="btn btn-primary" style="padding: 0.8rem 2rem; font-size: 1rem; border-radius: 50px;">
            <i class="fa-solid fa-arrow-left"></i> Return to Dashboard
        </a>
    </div>
</div>

<style>
@keyframes spin {
    100% {
        transform: rotate(360deg);
    }
}
</style>
@endsection
