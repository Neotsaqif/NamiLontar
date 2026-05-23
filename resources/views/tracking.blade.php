@extends('layouts.app')

@section('title', 'Live Tracking | Nami Lontar')

@section('content')
<div class="tracking-page-container container">
    <div class="tracking-header">
        <span class="live-update-tag">LIVE UPDATE</span>
        <h1>Nami Lontar Delivery</h1>
    </div>

    <div class="tracking-grid">
        <!-- Left Column: Map -->
        <div class="tracking-left">
            <div class="map-container">
                <img src="{{ asset('assets/delivery_map_ui.png') }}" alt="Live Delivery Map" class="map-image">
                <div class="map-overlay-text">
                    <h2>LIVE</h2>
                    <h3>MAP TRACKING</h3>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="tracking-card summary-card mt-4">
                <h3 class="card-heading">Order Summary</h3>
                @php $subtotal = 0; @endphp
                @foreach($order->items as $item)
                @php $subtotal += $item->price * $item->quantity; @endphp
                <div class="summary-item">
                    <div class="item-img-placeholder" style="background-image: url('{{ asset($item->product ? $item->product->image : 'assets/product photo/lontar.jpeg') }}')"></div>
                    <div class="item-details">
                        <h4>{{ $item->product ? $item->product->name : 'Unknown Product' }}</h4>
                        <p>Quantity: {{ $item->quantity }}</p>
                    </div>
                    <div class="item-price">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</div>
                </div>
                @endforeach
                
                <div class="summary-divider"></div>
                <div class="summary-row total-row">
                    <span>Total Amount</span>
                    <span>Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Status & Details -->
        <div class="tracking-right">
            
            @if(session('success'))
                <div class="alert alert-success" style="margin-bottom: 1rem; padding: 1rem; background: #e6f7e6; color: #2e7d32; border-radius: 8px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Arrival & Action Card -->
            <div class="tracking-card arrival-card">
                <p class="arrival-label">Estimated Arrival</p>
                <h2 class="arrival-time">{{ $order->estimated_arrival ? $order->estimated_arrival->format('h:i A') : 'TBD' }}</h2>
                <div class="arrival-status">
                    <span class="status-dot {{ $order->status }}"></span> {{ strtoupper($order->status) }}
                </div>
                
                @if($order->status === 'delivery')
                    <form action="{{ route('orders.complete', $order->id) }}" method="POST" style="margin-top: 1.5rem;">
                        @csrf
                        <button type="submit" class="btn-full-dark" style="background: var(--accent-color); font-weight: 700; color: green;">COMPLETE DELIVERY</button>
                    </form>
                @endif
            </div>

            <!-- Driver Info Card -->
            <div class="tracking-card driver-card">
                <div class="driver-info">
                    <img src="{{ asset('assets/chef1.png') }}" alt="Driver" class="driver-photo">
                    <div class="driver-details">
                        <h4>{{ $order->driver ?? 'Assigning Driver...' }}</h4>
                        <p><i class=""></i>"We're on the way!"</p>
                    </div>
                </div>
                <!-- @if($order->driver)
                <div class="driver-actions">
                    <button class="btn-action"><i class="fa-regular fa-message"></i> MESSAGE</button>
                    <button class="btn-action"><i class="fa-solid fa-phone"></i> CALL</button>
                </div>
                @endif -->
            </div>

            <!-- Delivery Progress Timeline -->
            <div class="tracking-card progress-card">
                <h3 class="card-heading-small">DELIVERY PROGRESS</h3>
                <div class="timeline">
                    <div class="timeline-item {{ in_array($order->status, ['pending', 'accepted', 'processing', 'delivery', 'completed']) ? 'completed' : '' }}">
                        <div class="timeline-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="timeline-content">
                            <h4>Order Received</h4>
                            <p>{{ $order->created_at->format('h:i A') }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ in_array($order->status, ['delivery', 'completed']) ? 'completed' : (in_array($order->status, ['accepted', 'processing']) ? 'active' : 'pending') }}">
                        <div class="timeline-icon"><i class="fa-solid fa-utensils"></i></div>
                        <div class="timeline-content">
                            <h4>Preparing Order</h4>
                            <p>{{ $order->status == 'processing' ? 'Your order is being prepared' : ($order->status == 'delivery' || $order->status == 'completed' ? 'Order has been packed' : '') }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status == 'completed' ? 'completed' : ($order->status == 'delivery' ? 'active' : 'pending') }}">
                        <div class="timeline-icon"><i class="fa-solid fa-motorcycle"></i></div>
                        <div class="timeline-content">
                            <h4>Out for Delivery</h4>
                            <p>{{ $order->status == 'delivery' ? 'Your driver is on the way!' : ($order->status == 'completed' ? 'Successfully Delivered' : '') }}</p>
                        </div>
                    </div>
                    <div class="timeline-item {{ $order->status == 'completed' ? 'completed' : 'pending' }}">
                        <div class="timeline-icon"><i class="fa-solid fa-house-chimney"></i></div>
                        <div class="timeline-content">
                            <h4>Delivered</h4>
                            <p>{{ $order->status == 'completed' ? 'Your order is completed at ' : 'Estimated ' }}{{ $order->estimated_arrival ? $order->estimated_arrival->format('h:i A') : 'TBD' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Address and Details Card -->
            <div class="tracking-card details-card">
                <h3 class="card-heading-small">DELIVERY ADDRESS</h3>
                <div class="address-info">
                    <i class="fa-solid fa-location-dot"></i>
                    <div>
                        <p style="font-weight: 700; color: var(--text-primary);">{{ $order->address }}</p>
                        <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                    </div>
                </div>
                
                <h3 class="card-heading-small mt-4">ORDER NUMBER</h3>
                <p class="order-number-text">#ORD-{{ strtoupper(substr($order->id, 0, 8)) }}</p>
            </div>

        </div>
    </div>
</div>
@endsection
