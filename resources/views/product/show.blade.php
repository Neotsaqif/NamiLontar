@extends('layouts.app')

@section('title', 'Product Details | Nami Lontar')

@section('content')
<!-- Breadcrumbs -->
<div class="container" style="padding: 2rem 2rem 0;">
    <p style="font-size: 0.85rem; color: #888;">
        <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/#product') }}">Shop</a> / <span id="breadcrumb-current" style="color: var(--dark-color); font-weight: 500;">Product</span>
    </p>
</div>

<!-- Product Hero -->
<section class="product-hero container">
    <div class="product-hero-grid">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="main-img-container">
                <img src="" alt="Product Image" id="main-product-img">
            </div>
            <div class="thumbnail-grid" id="thumbnail-grid">
                <!-- Thumbnails will be injected here -->
            </div>
        </div>

        <!-- Info -->
        <div class="product-content-details">
            <span class="product-tag" id="product-category">SEASONAL ROTATION</span>
            <h1 id="product-name">Product Name</h1>
            
            <div class="rating-summary">
                <div class="stars" id="product-stars">
                    <!-- Stars will be injected here -->
                </div>
                <span class="review-count" id="product-reviews">(0 reviews)</span>
            </div>

            <div class="detail-price" id="product-price">$0.00</div>

            <p class="product-description" id="product-desc">
                Product description goes here...
            </p>

            <div class="selection-group">
                <span class="selection-label">Select Size</span>
                <div class="size-options">
                    <button class="size-btn">Standard</button>
                    <button class="size-btn">Large</button>
                    <button class="size-btn">Gift Box</button>
                </div>
            </div>

            <div class="action-row">
                <div class="qty-selector">
                    <button class="qty-btn" id="qty-minus">-</button>
                    <input type="text" value="1" class="qty-input" id="qty-input">
                    <button class="qty-btn" id="qty-plus">+</button>
                </div>
                <button class="btn btn-large"><i class="fa-solid fa-cart-shopping"></i> ADD TO CART</button>
                <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
            </div>

            <div class="trust-badges">
                <div class="badge-item">
                    <i class="fa-solid fa-truck-fast"></i>
                    <div class="badge-text">
                        <h4>Fast Delivery</h4>
                        <p>Same day available</p>
                    </div>
                </div>
                <div class="badge-item">
                    <i class="fa-solid fa-leaf"></i>
                    <div class="badge-text">
                        <h4>Organic</h4>
                        <p>100% natural</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Extra Info -->
<section class="product-extra-info">
    <div class="container">
        <div class="info-grid-container">
            <div class="info-col">
                <h3>Ingredients</h3>
                <p id="product-ingredients">Loading...</p>
            </div>
            <div class="info-col">
                <h3>Storage</h3>
                <p id="product-storage">Loading...</p>
            </div>
            <div class="info-col">
                <h3>Artisan Note</h3>
                <p id="product-artisan-note">Loading...</p>
            </div>
        </div>
    </div>
</section>

<!-- Perfect Pairings -->
<section class="pairings-section container">
    <h2>Perfect Pairings</h2>
    <div class="pairings-grid" id="pairings-grid">
        <!-- Pairing cards will be injected here -->
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/product.js') }}"></script>
@endpush
