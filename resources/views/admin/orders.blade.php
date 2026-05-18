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
            @foreach($orders as $order)
            <tr>
                <td>#{{ $order['id'] }}</td>
                <td>{{ $order['date'] }}</td>
                <td>
                    <a href="{{ url('/admin/customers/' . $order['customer_id']) }}" style="color: var(--accent-color); text-decoration: none; font-weight: 500;">
                        {{ $order['customer_name'] }}
                    </a>
                </td>
                <td>{{ $order['items_summary'] }}</td>
                <td><span class="badge {{ $order['status'] }}">{{ $order['status'] }}</span></td>
                <td>${{ number_format($order['total'], 2) }}</td>
                <td>
                    <a href="{{ url('/admin/orders/' . $order['id']) }}" class="btn btn-secondary btn-sm">
                        View Details
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
