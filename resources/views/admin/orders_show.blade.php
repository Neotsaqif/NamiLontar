@extends('layouts.admin')

@section('title', 'Order ' . $order['id'] . ' Details')

@section('content')
<header class="page-header">
    <div class="header-title-area">
        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <a href="{{ url('/admin/orders') }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left"></i> Back to Orders
            </a>
            @if(isset($customer))
            <a href="{{ url('/admin/customers/' . $customer['id']) }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-color: rgba(212,175,55,0.3); color: var(--accent-color);">
                <i class="fa-solid fa-user"></i> Customer Profile
            </a>
            @endif
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

@if(session('error'))
<div style="background: rgba(198, 40, 40, 0.15); border: 1px solid rgba(198, 40, 40, 0.5); color: #e57373; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500; backdrop-filter: blur(10px); animation: fadeUp 0.3s ease-out;">
    <i class="fa-solid fa-circle-xmark" style="font-size: 1.2rem;"></i>
    {{ session('error') }}
</div>
@endif

<div class="order-grid" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; align-items: start;">
    <!-- Left Column: Order Breakdown & Status -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Status & Meta Card -->
        <div class="card" style="padding: 2rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem;">
            <div>
                <h2 style="font-size: 1.6rem; color: var(--text-primary); margin-bottom: 0.5rem;">Order #{{ $order['id'] }}</h2>
                <p style="color: var(--text-secondary); font-size: 0.9rem;">
                    Placed on <strong style="color: var(--text-primary);">{{ $order['date'] }}</strong>
                </p>
            </div>
            
            <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
                <span style="font-size: 0.9rem; color: var(--text-secondary); font-weight: 500;">Status:</span>
                <span class="badge {{ $order['status'] }}" style="padding: 0.5rem 1rem; font-size: 0.85rem; border-radius: 8px;">
                    {{ $order['status'] }}
                </span>
                
                <!-- Interactive Status Update Form -->
                <form action="{{ route('admin.orders.updateStatus', $order['id']) }}" method="POST" style="margin: 0; display: inline-flex; align-items: center;">
                    @csrf
                    <select name="status" class="filter-dropdown" style="padding: 0.5rem 2.5rem 0.5rem 1rem; border-radius: 8px; font-size: 0.85rem;" onchange="this.form.submit()">
                        <option value="" disabled selected>Update Status</option>
                        <option value="pending" {{ $order['status'] === 'pending' ? 'disabled' : '' }}>Pending</option>
                        <option value="processing" {{ $order['status'] === 'processing' ? 'disabled' : '' }}>Processing</option>
                        <option value="delivered" {{ $order['status'] === 'delivered' ? 'disabled' : '' }}>Delivered</option>
                    </select>
                </form>
            </div>
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
                            <th style="padding: 1rem 0;">Product Name</th>
                            <th style="padding: 1rem 0; text-align: center;">Price</th>
                            <th style="padding: 1rem 0; text-align: center;">Quantity</th>
                            <th style="padding: 1rem 0; text-align: right;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $subtotal = 0;
                        @endphp
                        @foreach($order['items'] as $item)
                        @php
                            $itemTotal = $item['price'] * $item['quantity'];
                            $subtotal += $itemTotal;
                        @endphp
                        <tr>
                            <td style="padding: 1.25rem 0; font-weight: 500; color: var(--text-primary);">
                                {{ $item['name'] }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: center; color: var(--text-secondary);">
                                {{ \App\Http\Controllers\AdminController::formatPrice($item['price']) }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: center; font-weight: 600; color: var(--text-primary);">
                                {{ $item['quantity'] }}
                            </td>
                            <td style="padding: 1.25rem 0; text-align: right; font-weight: 600; color: var(--text-primary);">
                                {{ \App\Http\Controllers\AdminController::formatPrice($itemTotal) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Financial Summary -->
            <div style="border-top: 1px solid var(--card-border); margin-top: 2rem; padding-top: 1.5rem; display: flex; flex-direction: column; align-items: flex-end; gap: 0.75rem;">
                <div style="display: flex; justify-content: space-between; width: 280px; font-size: 0.95rem;">
                    <span style="color: var(--text-secondary);">Subtotal:</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ \App\Http\Controllers\AdminController::formatPrice($subtotal) }}</span>
                </div>
                <div style="display: flex; justify-content: space-between; width: 280px; font-size: 0.95rem;">
                    <span style="color: var(--text-secondary);">Shipping Cost:</span>
                    <span style="color: var(--text-primary); font-weight: 500;">
                        {{ $order['shipping_method'] === 'Express Shipping' ? \App\Http\Controllers\AdminController::formatPrice(15.00) : 'Free' }}
                    </span>
                </div>
                @php
                    $shippingFee = $order['shipping_method'] === 'Express Shipping' ? 15.00 : 0.00;
                    $grandTotal = $subtotal + $shippingFee;
                @endphp
                <div style="display: flex; justify-content: space-between; width: 280px; border-top: 1px solid var(--card-border); padding-top: 1rem; font-size: 1.4rem;">
                    <span style="font-family: var(--font-serif); color: var(--text-primary); font-weight: 600;">Total:</span>
                    <span style="font-family: var(--font-serif); color: var(--accent-color); font-weight: 700; text-shadow: 0 0 15px rgba(212,175,55,0.2);">
                        {{ \App\Http\Controllers\AdminController::formatPrice($grandTotal) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Customer Info & Shipping/Payment Details -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Customer Profile Card -->
        @if(isset($customer))
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.3rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-circle-user" style="color: var(--accent-color);"></i> Customer Info
            </h2>
            
            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.5rem;">
                <div style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, rgba(212,175,55,0.2) 0%, rgba(212,175,55,0.05) 100%); border: 1px solid var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 1.3rem; font-weight: 700; color: var(--accent-color); font-family: var(--font-serif);">
                    {{ strtoupper(substr($customer['name'], 0, 1)) }}
                </div>
                <div>
                    <h3 style="font-size: 1.1rem; color: var(--text-primary); margin-bottom: 0.25rem;">{{ $customer['name'] }}</h3>
                    <p style="color: var(--text-secondary); font-size: 0.85rem;">Customer ID: #{{ $customer['id'] }}</p>
                </div>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 1rem; font-size: 0.9rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1.5rem; margin-bottom: 1.5rem;">
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Email Address</span>
                    <a href="mailto:{{ $customer['email'] }}" style="color: var(--text-primary); text-decoration: none; font-weight: 500;">
                        {{ $customer['email'] }}
                    </a>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Phone Number</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ $customer['phone'] }}</span>
                </div>
            </div>
            
            <a href="{{ url('/admin/customers/' . $customer['id']) }}" class="btn btn-secondary" style="width: 100%; font-size: 0.85rem;">
                <i class="fa-solid fa-user-gear"></i> View Full Profile
            </a>
        </div>
        @endif

        <!-- Delivery & Payment Information -->
        <div class="card" style="padding: 2rem; display: flex; flex-direction: column; gap: 1.5rem;">
            <div>
                <h2 style="font-size: 1.3rem; margin-bottom: 1rem; border-bottom: 1px solid var(--card-border); padding-bottom: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fa-solid fa-truck" style="color: var(--accent-color);"></i> Delivery Details
                </h2>
                <div style="font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <p style="color: var(--text-secondary);">Method: <strong style="color: var(--text-primary);">{{ $order['shipping_method'] }}</strong></p>
                    <p style="color: var(--text-secondary); line-height: 1.5;">
                        Address: <br>
                        <strong style="color: var(--text-primary);">{{ $customer['address'] ?? 'No address provided' }}</strong>
                    </p>
                </div>
            </div>
            
            <div>
                <h2 style="font-size: 1.3rem; margin-bottom: 1rem; border-bottom: 1px solid var(--card-border); padding-bottom: 0.75rem; display: flex; align-items: center; gap: 0.75rem;">
                    <i class="fa-solid fa-credit-card" style="color: var(--accent-color);"></i> Payment Method
                </h2>
                <div style="font-size: 0.9rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <p style="color: var(--text-secondary);">Provider: <strong style="color: var(--text-primary);">{{ $order['payment_method'] }}</strong></p>
                    <p style="color: var(--text-secondary);">Status: <span class="badge active" style="font-size: 0.7rem; padding: 0.25rem 0.5rem; margin-left: 0.25rem;">Paid</span></p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
