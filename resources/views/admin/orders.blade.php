@extends('layouts.admin')

@section('title', 'Orders - Nami Lontar')

@section('content')
<header class="page-header">
    <h1>Client Orders</h1>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

<div class="table-container">
    <div class="table-header-actions">
        <input type="text" class="search-bar" placeholder="Search orders...">
        <select class="filter-dropdown">
            <option value="all">All Statuses</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="delivered">Delivered</option>
        </select>
    </div>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Date</th>
                <th>Customer Name</th>
                <th>Items Summary</th>
                <th>Status</th>
                <th>Total Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#ORD-1025</td>
                <td>Oct 24, 2026</td>
                <td>Alice Johnson</td>
                <td>3 items (Ceramic Mug, etc.)</td>
                <td><span class="badge processing">Processing</span></td>
                <td>$120.00</td>
                <td><button class="btn btn-secondary">View Details</button></td>
            </tr>
            <tr>
                <td>#ORD-1024</td>
                <td>Oct 23, 2026</td>
                <td>Bob Smith</td>
                <td>1 item (Linen Apron)</td>
                <td><span class="badge delivered">Delivered</span></td>
                <td>$45.50</td>
                <td><button class="btn btn-secondary">View Details</button></td>
            </tr>
            <tr>
                <td>#ORD-1023</td>
                <td>Oct 22, 2026</td>
                <td>Charlie Brown</td>
                <td>2 items (Wooden Spoon...)</td>
                <td><span class="badge pending">Pending</span></td>
                <td>$89.99</td>
                <td><button class="btn btn-secondary">View Details</button></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
