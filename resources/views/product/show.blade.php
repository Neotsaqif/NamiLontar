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
        <div class="product-gallery smooth-reveal smooth-reveal-left">
            <div class="main-img-container">
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" id="main-product-img">
            </div>
            <div class="thumbnail-grid" id="thumbnail-grid">
                <div class="thumb-item active" onclick="changeImage(this, '{{ asset($product->image) }}')">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }} Main">
                </div>
                @foreach($pairings as $pair)
                <div class="thumb-item" onclick="changeImage(this, '{{ asset($pair->image) }}')">
                    <img src="{{ asset($pair->image) }}" alt="{{ $pair->name }}">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Info -->
        <div class="product-content-details smooth-reveal smooth-reveal-right">
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

            <div class="detail-price" id="product-price">Rp{{ number_format($product->price, 0, ',', '.') }}</div>

            <p class="product-description" id="product-desc">
                {{ $product->description }}
            </p>

            @if($product->has_size_options && !empty($product->size_options))
            <div class="selection-group">
                <span class="selection-label">Select Size</span>
                <div class="size-options" id="size-options-container">
                    @foreach($product->size_options as $index => $size)
                    <button class="size-btn {{ $index === 0 ? 'active' : '' }}"
                            data-size="{{ $size['label'] }}"
                            data-unit="{{ $size['unit'] ?? '' }}">
                        {{ $size['label'] }}
                        @if(!empty($size['unit']))
                            <small style="display: block; font-size: 0.65em; opacity: 0.75; font-weight: 400; margin-top: 1px;">{{ strtoupper($size['unit']) }}</small>
                        @endif
                    </button>
                    @endforeach
                </div>
                <input type="hidden" id="selected-size" name="selected_size" value="{{ $product->size_options[0]['label'] ?? '' }}">
            </div>
            @endif

            <div class="action-row">
                <div class="qty-selector">
                    <button class="qty-btn" id="qty-minus">-</button>
                    <input type="text" value="1" class="qty-input" id="qty-input">
                    <button class="qty-btn" id="qty-plus">+</button>
                </div>
                <button class="btn btn-large" onclick="cartManager.addItem('{{ $product->slug }}', parseInt(document.getElementById('qty-input').value), event)">
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
            <div class="info-col smooth-reveal smooth-reveal-up">
                <h3>Ingredients</h3>
                <p id="product-ingredients">{{ $product->ingredients }}</p>
            </div>
            <div class="info-col smooth-reveal smooth-reveal-up delay-150">
                <h3>Storage</h3>
                <p id="product-storage">{{ $product->storage }}</p>
            </div>
            <div class="info-col smooth-reveal smooth-reveal-up delay-300">
                <h3>Artisan Note</h3>
                <p id="product-artisan-note">{{ $product->artisan_note }}</p>
            </div>
        </div>
    </div>
</section>

<!-- Perfect Pairings -->
<section class="pairings-section container">
    <h2 class="smooth-reveal smooth-reveal-up">Perfect Pairings</h2>
    <div class="pairings-grid" id="pairings-grid">
        @foreach($pairings as $pair)
        <div class="pairing-card smooth-reveal smooth-reveal-scale delay-{{ (($loop->index % 4) + 1) * 100 }}">
            <a href="{{ url('/product/' . $pair->slug) }}">
                <div class="pairing-img">
                    <img src="{{ asset($pair->image) }}" alt="{{ $pair->name }}">
                </div>
            </a>
            <div class="pairing-info">
                <h4>{{ $pair->name }}</h4>
                <span class="price">Rp{{ number_format($pair->price, 0, ',', '.') }}</span>
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

        // Size Selection Logic (dynamic from DB)
        const sizeBtns = document.querySelectorAll('.size-btn');
        const selectedSizeInput = document.getElementById('selected-size');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                sizeBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                if (selectedSizeInput) {
                    selectedSizeInput.value = btn.getAttribute('data-size') || btn.textContent.trim();
                }
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
