@extends('layouts.admin')

@section('title', 'Database Sync - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Database Synchronization</h1>
    <div class="header-actions">
        <div class="visitor-container">
            <span class="pulse-indicator"></span>
            <span style="font-size: 0.85rem; color: var(--text-secondary);">Live Connection</span>
        </div>
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
        </div>
    </div>
</header>

@if(session('success'))
<div style="background: var(--status-green-bg); border: 1px solid var(--status-green-border); color: var(--status-green-text); padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500; animation: fadeUp 0.4s ease-out;">
    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div style="background: var(--status-red-bg); border: 1px solid var(--status-red-border); color: var(--status-red-text); padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500; animation: fadeUp 0.4s ease-out;">
    <i class="fa-solid fa-circle-xmark"></i>
    {{ session('error') }}
</div>
@endif

{{-- Sync Action Cards --}}
<div class="kpi-grid">
    {{-- MySQL to SQLite --}}
    <div class="kpi-card" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <div class="kpi-card-top">
                <div class="kpi-icon-wrap kpi-icon-gold">
                    <i class="fa-solid fa-cloud-arrow-down"></i>
                </div>
                <span class="kpi-badge kpi-badge-blue">Recommended</span>
            </div>
            <div class="kpi-label">Import to SQLite</div>
            <div class="kpi-value" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--text-primary);">MySQL → SQLite</div>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem; line-height: 1.4;">
                Populate the SQLite database with fresh data from MySQL. Safeguard for local development and testing.
            </p>
        </div>
        <form action="{{ route('admin.databaseSync.process') }}" method="POST">
            @csrf
            <input type="hidden" name="source" value="mysql">
            <input type="hidden" name="target" value="sqlite">
            <button type="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fa-solid fa-sync"></i> RUN IMPORT
            </button>
        </form>
    </div>

    {{-- SQLite to MySQL --}}
    <div class="kpi-card" style="display: flex; flex-direction: column; justify-content: space-between; border-color: rgba(198, 40, 40, 0.1);">
        <div>
            <div class="kpi-card-top">
                <div class="kpi-icon-wrap kpi-icon-amber" style="background: rgba(198, 40, 40, 0.12); color: #e57373;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <span class="kpi-badge kpi-badge-yellow" style="background: var(--status-red-bg); border-color: var(--status-red-border); color: var(--status-red-text);">Destructive</span>
            </div>
            <div class="kpi-label">Overwrite MySQL</div>
            <div class="kpi-value" style="font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--text-primary);">SQLite → MySQL</div>
            <p style="color: var(--text-secondary); font-size: 0.85rem; margin-bottom: 1.5rem; line-height: 1.4;">
                Restore MySQL data from the local SQLite file. This action will permanently replace all current MySQL records.
            </p>
        </div>
        <form action="{{ route('admin.databaseSync.process') }}" method="POST" onsubmit="return confirm('CRITICAL WARNING: This will WIPE your MySQL database and replace it with SQLite data. Are you absolutely certain?')">
            @csrf
            <input type="hidden" name="source" value="sqlite">
            <input type="hidden" name="target" value="mysql">
            <button type="submit" class="btn btn-secondary" style="width: 100%; border-color: var(--status-red-border); color: var(--status-red-text);">
                <i class="fa-solid fa-radiation"></i> OVERWRITE MYSQL
            </button>
        </form>
    </div>

    {{-- Connection Stats --}}
    <div class="kpi-card" style="background: rgba(212, 175, 55, 0.02);">
        <div class="kpi-card-top">
            <div class="kpi-icon-wrap kpi-icon-blue">
                <i class="fa-solid fa-circle-nodes"></i>
            </div>
            <span class="kpi-badge kpi-badge-green">Active</span>
        </div>
        <div class="kpi-label">Health Status</div>
        <div class="kpi-value" style="color: var(--status-green-text);">Optimal</div>
        <div class="kpi-sub">
            <i class="fa-solid fa-check-double"></i> All drivers responding
        </div>
    </div>
</div>

{{-- Integrity Report Table --}}
<div class="orders-card" style="margin-top: 1rem;">
    <div class="orders-card-header">
        <h3><i class="fa-solid fa-list-check" style="color:var(--accent-color);margin-right:.5rem;"></i>Integrity Analysis</h3>
        <p style="font-size: 0.8rem; color: var(--text-secondary);">Cross-database record comparison</p>
    </div>

    <table id="ordersTable">
        <thead>
            <tr>
                <th>Table Identity</th>
                <th style="text-align: center;">MySQL Count</th>
                <th style="text-align: center;">SQLite Count</th>
                <th style="text-align: right;">Integrity Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $item)
            <tr>
                <td style="font-weight: 500; letter-spacing: 0.5px;">{{ strtoupper($item['table']) }}</td>
                <td style="text-align: center; color: var(--text-primary); font-family: var(--font-sans);">{{ number_format($item['mysql'], 0, ',', '.') }}</td>
                <td style="text-align: center; color: var(--text-primary); font-family: var(--font-sans);">
                    {{ $item['sqlite'] === -1 ? 'INITIALIZING' : number_format($item['sqlite'], 0, ',', '.') }}
                </td>
                <td style="text-align: right;">
                    @if($item['status'] === 'Match')
                        <span class="badge delivered" style="font-size: 0.7rem;">Synced</span>
                    @else
                        <span class="badge pending" style="font-size: 0.7rem;">Drift Detected</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<style>
    #ordersTable td {
        padding: 1.5rem 2rem;
    }
    .kpi-card p {
        flex-grow: 1;
    }
</style>
@endpush
