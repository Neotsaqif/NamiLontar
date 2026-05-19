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
            
            <!-- Order Summary moved to bottom left based on mockup -->
            <div class="tracking-card summary-card mt-4">
                <h3 class="card-heading">Order Summary</h3>
                <div class="summary-item">
                    <div class="item-img-placeholder" style="background-image: url('{{ asset('assets/pastry_sourdough_1777430184266.png') }}')"></div>
                    <div class="item-details">
                        <h4>Pastel Renyah (50 pcs)</h4>
                        <p>Quantity: 1</p>
                    </div>
                    <div class="item-price">Rp 200.000</div>
                </div>
                <div class="summary-item">
                    <div class="item-img-placeholder" style="background-image: url('{{ asset('assets/pastry_danish_1777430801114.png') }}')"></div>
                    <div class="item-details">
                        <h4>Kue Lontar (2 box)</h4>
                        <p>Quantity: 2</p>
                    </div>
                    <div class="item-price">Rp 225.000</div>
                </div>
                
                <div class="summary-divider"></div>
                
                <div class="summary-row">
                    <span>Delivery Fee</span>
                    <span>Rp 0</span>
                </div>
                <div class="summary-row total-row">
                    <span>Total</span>
                    <span>Rp 425.000</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Status & Details -->
        <div class="tracking-right">
            
            <!-- Estimated Arrival Card -->
            <div class="tracking-card arrival-card">
                <p class="arrival-label">Estimated Arrival</p>
                <h2 class="arrival-time">12:45 PM</h2>
                <div class="arrival-status">
                    <span class="status-dot"></span> Out for Delivery
                </div>
            </div>

            <!-- Driver Info Card -->
            <div class="tracking-card driver-card">
                <div class="driver-info">
                    <img src="{{ asset('assets/chef1.png') }}" alt="Driver" class="driver-photo">
                    <div class="driver-details">
                        <h4>Budi Santoso</h4>
                        <p><i class="fa-solid fa-star"></i> 4.9 (120+ Deliveries)</p>
                    </div>
                </div>
                <div class="driver-actions">
                    <button class="btn-action"><i class="fa-regular fa-message"></i> MESSAGE</button>
                    <button class="btn-action"><i class="fa-solid fa-phone"></i> CALL</button>
                </div>
            </div>

            <!-- Delivery Progress Timeline -->
            <div class="tracking-card progress-card">
                <h3 class="card-heading-small">DELIVERY PROGRESS</h3>
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="timeline-content">
                            <h4>Order Received</h4>
                            <p>11:30 AM</p>
                        </div>
                    </div>
                    <div class="timeline-item completed">
                        <div class="timeline-icon"><i class="fa-solid fa-check"></i></div>
                        <div class="timeline-content">
                            <h4>Preparing your order</h4>
                            <p>11:45 AM</p>
                        </div>
                    </div>
                    <div class="timeline-item active">
                        <div class="timeline-icon"><i class="fa-solid fa-motorcycle"></i></div>
                        <div class="timeline-content">
                            <h4>Out for Delivery</h4>
                            <p>In Progress</p>
                        </div>
                    </div>
                    <div class="timeline-item pending">
                        <div class="timeline-icon"></div>
                        <div class="timeline-content">
                            <h4>Delivered</h4>
                            <p>Estimated 12:45 PM</p>
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
                        <p>Mutiara Heights Residency</p>
                        <p>Tower A, Unit 12-04</p>
                        <p>Jakarta Selatan, 12780</p>
                    </div>
                </div>
                
                <h3 class="card-heading-small mt-4">ORDER NUMBER</h3>
                <p class="order-number-text">#ORD-{{ $id ?? '92842' }}</p>
                
                <button class="btn-full-dark mt-4">VIEW RECEIPT</button>
            </div>

        </div>
    </div>
</div>
@endsection
