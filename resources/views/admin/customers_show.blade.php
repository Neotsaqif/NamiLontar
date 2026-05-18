@extends('layouts.admin')

@section('title', $customer['name'] . ' - Customer Profile')

@section('content')
<header class="page-header">
    <div class="header-title-area">
        <a href="{{ url('/admin/customers') }}" class="btn btn-secondary" style="margin-bottom: 1rem; padding: 0.5rem 1rem; font-size: 0.85rem;">
            <i class="fa-solid fa-arrow-left"></i> Back to Customers
        </a>
        <h1 style="margin-top: 0.5rem;">Customer Profile</h1>
    </div>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Julian Rossi</span>
        </div>
    </div>
</header>

<div class="profile-grid" style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;">
    <!-- Customer Details Card -->
    <div class="card profile-card" style="text-align: center; padding: 2.5rem 2rem;">
        <div class="avatar-glow" style="position: relative; width: 100px; height: 100px; margin: 0 auto 1.5rem; display: flex; align-items: center; justify-content: center; background: radial-gradient(circle, rgba(212,175,55,0.15) 0%, transparent 70%); border-radius: 50%;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, rgba(212,175,55,0.2) 0%, rgba(212,175,55,0.05) 100%); border: 2px solid var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; color: var(--accent-color); font-family: var(--font-serif);">
                {{ strtoupper(substr($customer['name'], 0, 1)) }}
            </div>
        </div>
        
        <h2 style="font-size: 1.8rem; margin-bottom: 0.5rem; color: var(--text-primary);">{{ $customer['name'] }}</h2>
        <span class="badge active" style="margin-bottom: 1.5rem;">{{ $customer['status'] }}</span>
        
        <div class="profile-details-list" style="text-align: left; border-top: 1px solid var(--card-border); padding-top: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
            <div>
                <span style="font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Email Address</span>
                <a href="mailto:{{ $customer['email'] }}" style="color: var(--text-primary); text-decoration: none; font-size: 0.95rem; font-weight: 500; word-break: break-all;">
                    <i class="fa-solid fa-envelope" style="color: var(--accent-color); margin-right: 0.5rem;"></i> {{ $customer['email'] }}
                </a>
            </div>
            
            <div>
                <span style="font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Phone Number</span>
                <span style="color: var(--text-primary); font-size: 0.95rem; font-weight: 500;">
                    <i class="fa-solid fa-phone" style="color: var(--accent-color); margin-right: 0.5rem;"></i> {{ $customer['phone'] }}
                </span>
            </div>
            
            <div>
                <span style="font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Shipping Address</span>
                <span style="color: var(--text-primary); font-size: 0.95rem; line-height: 1.5; font-weight: 500; display: block;">
                    <i class="fa-solid fa-location-dot" style="color: var(--accent-color); margin-right: 0.5rem;"></i> {{ $customer['address'] }}
                </span>
            </div>
            
            <div>
                <span style="font-size: 0.8rem; color: var(--text-secondary); text-transform: uppercase; letter-spacing: 0.5px; display: block; margin-bottom: 0.25rem;">Member Since</span>
                <span style="color: var(--text-primary); font-size: 0.95rem; font-weight: 500;">
                    <i class="fa-solid fa-calendar-days" style="color: var(--accent-color); margin-right: 0.5rem;"></i> {{ $customer['joined_date'] }}
                </span>
            </div>
        </div>
    </div>

    <!-- Order History Card -->
    <div class="card" style="padding: 2rem;">
        <h2 style="font-size: 1.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
            <i class="fa-solid fa-clock-rotate-left" style="color: var(--accent-color);"></i> Order History
        </h2>
        
        <div class="table-container" style="box-shadow: none; border: none; margin-bottom: 0; background: transparent;">
            @if(count($customer['orders']) > 0)
                <table style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="padding: 1rem;">Order ID</th>
                            <th style="padding: 1rem;">Date</th>
                            <th style="padding: 1rem;">Items</th>
                            <th style="padding: 1rem;">Status</th>
                            <th style="padding: 1rem; text-align: right;">Total</th>
                            <th style="padding: 1rem; text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customer['orders'] as $order)
                        <tr>
                            <td style="padding: 1.25rem 1rem; font-weight: 600;">#{{ $order['id'] }}</td>
                            <td style="padding: 1.25rem 1rem; color: var(--text-secondary);">{{ $order['date'] }}</td>
                            <td style="padding: 1.25rem 1rem;">{{ $order['items_summary'] }}</td>
                            <td style="padding: 1.25rem 1rem;">
                                <span class="badge {{ $order['status'] }}">{{ $order['status'] }}</span>
                            </td>
                            <td style="padding: 1.25rem 1rem; text-align: right; font-weight: 600; color: var(--accent-color);">{{ \App\Http\Controllers\AdminController::formatPrice($order['total']) }}</td>
                            <td style="padding: 1.25rem 1rem; text-align: center;">
                                <a href="{{ url('/admin/orders/' . $order['id']) }}" class="btn btn-secondary btn-sm" style="padding: 0.4rem 0.8rem; font-size: 0.8rem; border-radius: 6px;">
                                    View Details
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div style="text-align: center; padding: 3rem 0; color: var(--text-secondary);">
                    <i class="fa-solid fa-box-open" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                    <p>No orders found for this customer.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
