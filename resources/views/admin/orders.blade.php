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
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>
                        @foreach($order->items as $item)
                            {{ $item->product ? $item->product->name : 'Unknown' }} (x{{ $item->quantity }})@if(!$loop->last), @endif
                        @endforeach
                    </td>
                    <td><span class="badge {{ $order->status }}">{{ strtoupper($order->status) }}</span></td>
                    <td>Rp{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                    <td><a href="{{ url('/admin/orders/' . $order->id) }}" class="btn btn-secondary">View Details</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection