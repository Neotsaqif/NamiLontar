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

<div class="summary-grid">
    <div class="summary-card card">
        <i class="fa-solid fa-sack-dollar summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-chart-line"></i> Total Revenue</span>
        <span class="summary-value">$24,500</span>
        <span class="trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +12% from last month</span>
    </div>
    <div class="summary-card card">
        <i class="fa-solid fa-box-open summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-receipt"></i> Total Orders</span>
        <span class="summary-value">1,245</span>
        <span class="trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +5% from last month</span>
    </div>
    <div class="summary-card card">
        <i class="fa-solid fa-users summary-icon"></i>
        <span class="summary-title"><i class="fa-solid fa-user-group"></i> Active Customers</span>
        <span class="summary-value">842</span>
        <span class="trend-up"><i class="fa-solid fa-arrow-trend-up"></i> +18% from last month</span>
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
