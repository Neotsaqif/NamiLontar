@extends('layouts.admin')

@section('title', 'Dashboard - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Dashboard Overview</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

@push('styles')
<style>
@keyframes pulse {
    0% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(129, 199, 132, 0.7);
    }
    70% {
        transform: scale(1);
        box-shadow: 0 0 0 8px rgba(129, 199, 132, 0);
    }
    100% {
        transform: scale(0.95);
        box-shadow: 0 0 0 0 rgba(129, 199, 132, 0);
    }
}
.pulse-indicator {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: var(--status-green-text);
    box-shadow: 0 0 10px var(--status-green-text);
    animation: pulse 1.8s infinite ease-in-out;
}
.visitor-container {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}
</style>
@endpush

<div class="summary-grid">
    <div class="summary-card card">
        <i class="fa-solid fa-chart-line summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-money-bill-trend-up"></i> Weekly Sales</span>
        <span class="summary-value">Rp{{ number_format($weeklySales, 0, ',', '.') }}</span>
        <span class="trend-up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $salesTrend }}</span>
    </div>
    <div class="summary-card card">
        <i class="fa-solid fa-cart-shopping summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-receipt"></i> Weekly Orders</span>
        <span class="summary-value">{{ $weeklyOrders }}</span>
        <span class="trend-up"><i class="fa-solid fa-arrow-trend-up"></i> {{ $ordersTrend }}</span>
    </div>
    <div class="summary-card card">
        <i class="fa-solid fa-globe summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-users-viewfinder"></i> Visitor Online</span>
        <div class="visitor-container">
            <span class="summary-value">{{ $visitorOnline }}</span>
            <span class="pulse-indicator" title="Live active visitors"></span>
        </div>
        <span class="trend-up" style="color: var(--text-secondary);"><i class="fa-solid fa-clock"></i> Active sessions now</span>
    </div>
</div>

<div class="table-container">
    <div class="table-header-actions">
        <h2 style="font-family: var(--font-sans); font-size: 1.2rem; margin:0; font-weight: 500;">Recent Activity</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#ORD-001</td>
                <td>Oct 24, 2026</td>
                <td>Alice Johnson</td>
                <td><span class="badge processing">Processing</span></td>
                <td>$120.00</td>
            </tr>
            <tr>
                <td>#ORD-002</td>
                <td>Oct 23, 2026</td>
                <td>Bob Smith</td>
                <td><span class="badge delivered">Delivered</span></td>
                <td>$45.50</td>
            </tr>
            <tr>
                <td>#ORD-003</td>
                <td>Oct 22, 2026</td>
                <td>Charlie Brown</td>
                <td><span class="badge pending">Pending</span></td>
                <td>$89.99</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
