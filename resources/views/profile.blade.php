@extends('layouts.app')

@section('title', 'Profile | Nami Lontar')

@section('content')
<!-- Main Content Layout -->
<div class="dashboard-container">
    <!-- Left Sidebar -->
    <aside class="sidebar">
        <h2 class="sidebar-title">Settings</h2>
        <nav class="sidebar-nav">
            <a href="{{ url('/profile') }}" class="sidebar-item active">
                <i class="fa-solid fa-circle-user"></i>
                Profile
            </a>
            <a href="{{ url('/transactions') }}" class="sidebar-item">
                <i class="fa-solid fa-receipt"></i>
                Transactions
            </a>
            <a href="{{ url('/orders') }}" class="sidebar-item">
                <i class="fa-solid fa-box"></i>
                Orders
            </a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ url('/admin/dashboard') }}" class="sidebar-item" style="color: var(--primary-color); font-weight: 600;">
                <i class="fa-solid fa-gauge-high"></i>
                Admin Dashboard
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}" id="logout-form" style="display: none;">
                @csrf
            </form>
            <a href="#" class="sidebar-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket"></i>
                Sign Out
            </a>
        </nav>
    </aside>

    <!-- Right Content Pane -->
    <div class="content-pane">
        @if(session('success'))
            <div class="alert alert-success" style="margin-bottom: 2rem; padding: 1rem; background: #e6f7e6; color: #2e7d32; border-radius: 8px; border: 1px solid #c8e6c9;">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" style="margin-bottom: 2rem; padding: 1rem; background: #fff3e0; color: #e65100; border-radius: 8px; border: 1px solid #ffe0b2;">
                <i class="fa-solid fa-circle-exclamation"></i> {{ session('warning') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST">
            @csrf
            <!-- Main Profile Area -->
            <section class="profile-summary">
                <div class="profile-info-group">
                    <div class="profile-photo-container">
                        <img src="{{ asset('assets/profile.png') }}" alt="User Profile" class="profile-photo">
                        <button type="button" class="edit-btn" aria-label="Edit Profile"><i class="fa-solid fa-pencil"></i></button>
                    </div>
                    <div class="profile-text">
                        <h1 class="profile-name">{{ $user->name }}</h1>
                        <p class="profile-membership">Member since {{ $user->created_at->format('F Y') }} &bull; Nami Lontar Customer</p>
                    </div>
                </div>
                <button type="submit" class="save-btn">SAVE CHANGES</button>
            </section>

        <!-- Cards Area -->
        <section class="cards-grid">
            <!-- Personal Information Card -->
            <div class="card">
                <h3 class="card-title">Personal Information</h3>
                <div class="form-group">
                    <label>FULL NAME</label>
                    <input type="text" name="name" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label>EMAIL ADDRESS</label>
                    <input type="email" value="{{ $user->email }}" disabled style="background: #f5f5f5; cursor: not-allowed;">
                    <small style="color: #888; font-size: 0.7rem;">Email cannot be changed.</small>
                </div>
                <div class="form-group">
                    <label>PHONE NUMBER</label>
                    <input type="tel" name="phone" value="{{ $user->phone }}" placeholder="+1 (555) 234-8890">
                </div>
            </div>

            <!-- Shipping Preference Card -->
            <div class="card">
                <h3 class="card-title">Shipping Preference</h3>
                <div class="form-group">
                    <label>STREET ADDRESS</label>
                    <input type="text" name="address" value="{{ $user->address }}" placeholder="882 Boulangerie Way">
                </div>
                <div class="form-row">
                    <div class="form-group half">
                        <label>CITY</label>
                        <input type="text" name="city" value="{{ $user->city }}" placeholder="Pastryville">
                    </div>
                    <div class="form-group half">
                        <label>POSTAL CODE</label>
                        <input type="text" name="postal_code" value="{{ $user->postal_code }}" placeholder="90210">
                    </div>
                </div>
                <div class="checkbox-group">
                    <label class="custom-checkbox">
                        <input type="checkbox" checked>
                        <span class="checkmark"><i class="fa-solid fa-check"></i></span>
                        <span class="checkbox-label">Use as default billing address</span>
                    </label>
                </div>
            </div>
        </section>
    </form>

        <!-- Recent Orders & Transactions Section -->
        <section class="transactions-section">
            <div class="section-header">
                <h2 class="section-title">Recent Orders & Transactions</h2>
                <a href="#" class="view-all">VIEW ALL ACTIVITY</a>
            </div>
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ORDER ID</th>
                            <th>DATE</th>
                            <th>ITEMS</th>
                            <th>STATUS</th>
                            <th>TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>#{{ strtoupper(substr($order->id, 0, 8)) }}</td>
                            <td>{{ $order->created_at->format('M d, Y') }}</td>
                            <td>
                                @foreach($order->items as $item)
                                    {{ $item->product ? $item->product->name : 'Unknown Product' }} (x{{ $item->quantity }})@if(!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>
                                @if($order->status === 'completed')
                                    <span class="badge badge-green">DELIVERED</span>
                                @elseif($order->status === 'cancelled')
                                    <span class="badge badge-gray">CANCELLED</span>
                                @else
                                    <span class="badge badge-blue">{{ strtoupper($order->status) }}</span>
                                @endif
                            </td>
                            <td class="total-col">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem;">No orders found yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </div>
</div>
@endsection
