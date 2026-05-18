@extends('layouts.app')

@section('title', 'Product Details | Nami Lontar')

@section('content')
<!-- Breadcrumbs -->
<div class="container" style="padding: 2rem 2rem 0;">
    <p style="font-size: 0.85rem; color: #888;">
        <a href="{{ url('/') }}">Home</a> / <a href="{{ url('/#product') }}">Shop</a> / <span id="breadcrumb-current" style="color: var(--dark-color); font-weight: 500;">{{ $product->name }}</span>
    </p>
</div>

<!-- Product Hero -->
<section class="product-hero container">
    <div class="product-hero-grid">
        <!-- Gallery -->
        <div class="product-gallery">
            <div class="main-img-container">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" id="main-product-img">
            </div>
            <div class="thumbnail-grid" id="thumbnail-grid">
                <div class="thumb-item active" onclick="changeImage(this, '{{ asset($product->image) }}')">
                    <img src="{{ asset($product->image) }}" alt="Thumbnail 1">
                </div>
                <div class="thumb-item" onclick="changeImage(this, '{{ asset('assets/product photo/full produk.jpeg') }}')">
                    <img src="{{ asset('assets/product photo/full produk.jpeg') }}" alt="Thumbnail 2">
                </div>
                <div class="thumb-item" onclick="changeImage(this, '{{ asset('assets/product photo/cake.png') }}')">
                    <img src="{{ asset('assets/product photo/cake.png') }}" alt="Thumbnail 3">
                </div>
            </div>
        </div>

        <!-- Info -->
        <div class="product-content-details">
            <span class="product-tag" id="product-category">{{ $product->category }}</span>
            <h1 id="product-name">{{ $product->name }}</h1>
            
            <div class="rating-summary">
                <div class="stars" id="product-stars">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($product->rating))
                            <i class="fa-solid fa-star"></i>
                        @elseif ($i - 0.5 <= $product->rating)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="review-count" id="product-reviews">({{ $product->reviews }} reviews)</span>
            </div>

            <div class="detail-price" id="product-price">${{ number_format($product->price, 2) }}</div>

            <p class="product-description" id="product-desc">
                {{ $product->description }}
            </p>

            <div class="selection-group">
                <span class="selection-label">Select Size</span>
                <div class="size-options">
                    <button class="size-btn active">Standard</button>
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
                <button class="btn btn-large" onclick="cartManager.addItem('{{ $product->slug }}', parseInt(document.getElementById('qty-input').value))">
                    <i class="fa-solid fa-cart-shopping"></i> ADD TO CART
                </button>
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
                <p id="product-ingredients">{{ $product->ingredients }}</p>
            </div>
            <div class="info-col">
                <h3>Storage</h3>
                <p id="product-storage">{{ $product->storage }}</p>
            </div>
            <div class="info-col">
                <h3>Artisan Note</h3>
                <p id="product-artisan-note">{{ $product->artisan_note }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Perfect Pairings -->
<section class="pairings-section container">
    <h2>Perfect Pairings</h2>
    <div class="pairings-grid" id="pairings-grid">
        @foreach($pairings as $pair)
        <div class="pairing-card">
            <a href="{{ url('/product/' . $pair->slug) }}">
                <div class="pairing-img">
                    <img src="{{ asset($pair->image) }}" alt="{{ $pair->name }}">
                </div>
            </a>
            <div class="pairing-info">
                <h4>{{ $pair->name }}</h4>
                <span class="price">${{ number_format($pair->price, 2) }}</span>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Qty Selector Logic
        const qtyInput = document.getElementById('qty-input');
        const qtyPlus = document.getElementById('qty-plus');
        const qtyMinus = document.getElementById('qty-minus');

        qtyPlus.addEventListener('click', () => {
            qtyInput.value = parseInt(qtyInput.value) + 1;
        });

        qtyMinus.addEventListener('click', () => {
            if (parseInt(qtyInput.value) > 1) {
                qtyInput.value = parseInt(qtyInput.value) - 1;
            }
        });

        // Size Selection Logic
        const sizeBtns = document.querySelectorAll('.size-btn');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                sizeBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            });
        });
    });

    function changeImage(element, src) {
        document.getElementById('main-product-img').src = src;
        document.querySelectorAll('.thumb-item').forEach(el => el.classList.remove('active'));
        element.classList.add('active');
    }
</script>
@endpush
