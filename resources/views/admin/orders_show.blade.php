@extends('layouts.admin')

@section('title', 'Order #' . $order->id . ' Details')

@section('content')
<header class="page-header">
    <div class="header-title-area">
        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <a href="{{ url('/admin/orders') }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left"></i> Back to Orders
            </a>
        </div>
        <h1 style="margin-top: 0.5rem;">Order Details</h1>
    </div>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

@if(session('success'))
<div style="background: rgba(46, 125, 50, 0.15); border: 1px solid rgba(46, 125, 50, 0.5); color: #81c784; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500; backdrop-filter: blur(10px); animation: fadeUp 0.3s ease-out;">
    <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
    {{ session('success') }}
</div>
@endif

<div class="order-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
    <!-- Left Column: Order Breakdown & Status -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Status & Meta Card -->
        <div class="card" style="padding: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h2 style="font-size: 1.6rem; color: var(--text-primary); margin-bottom: 0.5rem;">Order #{{ $order->id }}</h2>
                <p style="color: var(--text-secondary); font-size: 0.9rem;">
                    Placed on <strong style="color: var(--text-primary);">{{ $order->created_at->format('M d, Y H:i') }}</strong>
                </p>
            </div>
            
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <span style="font-size: 0.9rem; color: var(--text-secondary); font-weight: 500;">Status:</span>
                <span class="badge {{ $order->status }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 8px;">
                    {{ strtoupper($order->status) }}
                </span>
            </div>
        </div>

        <!-- Management Card -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem;">
                <i class="fa-solid fa-gears" style="color: var(--accent-color);"></i> Manage Order
            </h2>
            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                @csrf
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--text-secondary);">Update Status</label>
                        <select name="status" class="filter-dropdown" style="width: 100%; padding: 0.75rem; border-radius: 8px;">
                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending Approval</option>
                            <option value="accepted" {{ $order->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $order->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="delivery" {{ $order->status === 'delivery' ? 'selected' : '' }}>Out for Delivery</option>
                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--text-secondary);">Assign Driver</label>
                        <input type="text" name="driver" value="{{ $order->driver }}" class="filter-dropdown" style="width: 100%; padding: 0.75rem; border-radius: 8px;" placeholder="Driver Name">
                    </div>
                </div>
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--text-secondary);">Estimated Arrival</label>
                    <input type="datetime-local" name="estimated_arrival" value="{{ $order->estimated_arrival ? $order->estimated_arrival->format('Y-m-d\TH:i') : '' }}" class="filter-dropdown" style="width: 100%; padding: 0.75rem; border-radius: 8px;">
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">UPDATE ORDER TRACKING</button>
            </form>
        </div>

        <!-- Items Table Card -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-cubes" style="color: var(--accent-color);"></i> Order Items
            </h2>
            
            <div class="table-container" style="box-shadow: none; border: none; margin-bottom: 0; background: transparent;">
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem 0; color: var(--text-secondary);">Product Name</th>
                            <th style="padding: 1rem 0; text-align: center; color: var(--text-secondary);">Price</th>
                            <th style="padding: 1rem 0; text-align: center; color: var(--text-secondary);">Quantity</th>
                            <th style="padding: 1rem 0; text-align: right; color: var(--text-secondary);">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td style="padding: 1.25rem 0; font-weight: 500; color: var(--text-primary);">
                                {{ $item->product ? $item->product->name : 'Deleted Product' }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: center; color: var(--text-secondary);">
                                Rp{{ number_format($item->price, 0, ',', '.') }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: center; font-weight: 600; color: var(--text-primary);">
                                {{ $item->quantity }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: right; font-weight: 600; color: var(--text-primary);">
                                Rp{{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Financial Summary -->
            <div style="border-top: 1px solid var(--card-border); margin-top: 2rem; padding-top: 1.5rem; display: flex; flex-direction: column; align-items: flex-end; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; width: 280px; font-size: 1.4rem;">
                    <span style="font-family: var(--font-serif); color: var(--text-primary); font-weight: 600;">Total Paid:</span>
                    <span style="font-family: var(--font-serif); color: var(--accent-color); font-weight: 700;">
                        Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info & Shipping Details -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <!-- Customer Profile Card -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.3rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-circle-user" style="color: var(--accent-color);"></i> Customer Info
            </h2>
            
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; font-weight: 700; color: white;">
                    {{ strtoupper(substr($order->user->name, 0, 1)) }}
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--text-primary); margin-bottom: 0.25rem;">{{ $order->user->name }}</h3>
                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Customer ID: #{{ $order->user_id }}</p>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.9rem;">
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Email</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ $order->user->email }}</span>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Phone</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ $order->user->phone ?? 'N/A' }}</span>
                </div>
            </div>
        </div>

        <!-- Delivery Details -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.3rem; margin-bottom: 1rem; border-bottom: 1px solid var(--card-border); padding-bottom: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-truck" style="color: var(--accent-color);"></i> Delivery Snapshot
            </h2>
            <div style="font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.75rem;">
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Address Snapshot (At Checkout)</span>
                    <p style="color: var(--text-primary); font-weight: 500; line-height: 1.4;">
                        {{ $order->address }}<br>
                        {{ $order->city }}, {{ $order->postal_code }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
