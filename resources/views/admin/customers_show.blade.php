@extends('layouts.admin')

@section('title', 'Customer Detail - ' . $user->name)

@section('content')
<header class="page-header">
    <div class="header-title-area">
        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
            <a href="{{ route('admin.customers') }}" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                <i class="fa-solid fa-arrow-left"></i> Back to Customers
            </a>
        </div>
        <h1 style="margin-top: 0.5rem;">Customer Profile</h1>
    </div>
    <div class="header-actions">
        <div class="admin-profile">
            <img src="{{ asset('assets/profile.png') }}" alt="Admin">
            <span>Admin</span>
        </div>
    </div>
</header>

@if(session('success'))
<div style="background: rgba(46, 125, 50, 0.15); border: 1px solid rgba(46, 125, 50, 0.5); color: #81c784; padding: 1rem 1.5rem; border-radius: 10px; margin-bottom: 2rem; display: flex; align-items: center; gap: 0.75rem; font-weight: 500;">
    <i class="fa-solid fa-circle-check"></i>
    {{ session('success') }}
</div>
@endif

<div class="order-grid" style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start;">
    <!-- Left Column: Customer Profile & Role Management -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Profile Card -->
        <div class="card" style="padding: 2rem; text-align: center;">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--accent-color); display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 700; color: white; margin: 0 auto 1.5rem;">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <h2 style="font-size: 1.4rem; color: var(--text-primary); margin-bottom: 0.25rem;">{{ $user->name }}</h2>
            <p style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 1rem;">Joined on {{ $user->created_at->format('M d, Y') }}</p>
            <span class="badge {{ $user->role }}" style="padding: 0.5rem 1.5rem; font-size: 0.8rem;">
                {{ strtoupper($user->role) }}
            </span>
        </div>

        <!-- Account Info Card -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.2rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem;">
                <i class="fa-solid fa-address-card" style="color: var(--accent-color);"></i> Account Details
            </h2>
            <div style="display: flex; flex-direction: column; gap: 1.25rem; font-size: 0.9rem;">
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Email Address</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ $user->email }}</span>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Phone Number</span>
                    <span style="color: var(--text-primary); font-weight: 500;">{{ $user->phone ?? 'Not provided' }}</span>
                </div>
                <div>
                    <span style="color: var(--text-secondary); font-size: 0.75rem; text-transform: uppercase; display: block; margin-bottom: 0.25rem;">Default Address</span>
                    <p style="color: var(--text-primary); font-weight: 500; line-height: 1.4;">
                        {{ $user->address ?? 'No address set' }}<br>
                        {{ $user->city }}{{ $user->city && $user->postal_code ? ', ' : '' }}{{ $user->postal_code }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Role Management Card -->
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.2rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem;">
                <i class="fa-solid fa-user-shield" style="color: var(--accent-color);"></i> Manage Role
            </h2>
            <form action="{{ route('admin.customers.updateRole', $user->id) }}" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.85rem; color: var(--text-secondary);">Account Role</label>
                    <select name="role" class="filter-dropdown" style="width: 100%; padding: 0.75rem; border-radius: 8px;">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>USER (Customer)</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>ADMIN (Staff)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">UPDATE ROLE</button>
            </form>
        </div>
    </div>

    <!-- Right Column: Order History -->
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        <div class="card" style="padding: 2rem;">
            <h2 style="font-size: 1.4rem; margin-bottom: 1.5rem; border-bottom: 1px solid var(--card-border); padding-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                <i class="fa-solid fa-basket-shopping" style="color: var(--accent-color);"></i> Order History
            </h2>
            
            @if($user->orders->isEmpty())
                <div style="text-align: center; padding: 3rem 0; color: var(--text-secondary);">
                    <i class="fa-solid fa-box-open" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.3;"></i>
                    <p>No orders found for this customer.</p>
                </div>
            @else
                <div class="table-container" style="box-shadow: none; border: none; margin-bottom: 0; background: transparent;">
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th style="padding: 1rem 0; color: var(--text-secondary);">Order ID</th>
                                <th style="padding: 1rem 0; text-align: center; color: var(--text-secondary);">Date</th>
                                <th style="padding: 1rem 0; text-align: center; color: var(--text-secondary);">Status</th>
                                <th style="padding: 1rem 0; text-align: right; color: var(--text-secondary);">Total</th>
                                <th style="padding: 1rem 0; text-align: right; color: var(--text-secondary);">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->orders as $order)
                            <tr>
                                <td style="padding: 1.25rem 0; font-weight: 500; color: var(--text-primary);">
                                    #{{ $order->id }}
                                </td>
                                <td style="padding: 1.25rem 0; text-align: center; color: var(--text-secondary);">
                                    {{ $order->created_at->format('M d, Y') }}
                                </td>
                                <td style="padding: 1.25rem 0; text-align: center;">
                                    <span class="badge {{ $order->status }}" style="font-size: 0.75rem;">
                                        {{ strtoupper($order->status) }}
                                    </span>
                                </td>
                                <td style="padding: 1.25rem 0; text-align: right; font-weight: 600; color: var(--text-primary);">
                                    Rp{{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td style="padding: 1.25rem 0; text-align: right;">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-secondary btn-sm" style="padding: 0.4rem 0.8rem; font-size: 0.75rem;">
                                        DETAILS
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
