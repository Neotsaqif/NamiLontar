@extends('layouts.app')

@section('title', 'Nami Lontar | Artisanal Cakes & Pastries')

@section('content')
<!-- Hero Section -->
@if(session('success'))
<div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 1rem; text-align: center; font-weight: bold;">
    {{ session('success') }}
</div>
@endif
<section class="hero">
    <div class="hero-bg">
        <img src="{{ asset('assets/full product header.png') }}" alt="Delicious Nami Lontar Spread">
    </div>
    <div class="hero-content container">
        <div class="hero-text-box">
            <span class="since">Est. 2024</span>
            <h1>Artisanal Pastries in Every Golden Bite</h1>
            <p>Experience the perfect balance of flavors and textures in our hand-crafted pastries, baked fresh
                every day with the finest organic ingredients.</p>
            <a href="#product" class="btn btn-primary">Shop the Collection</a>
        </div>
    </div>
</section>

<!-- Signature Pastries -->
<section class="pastries container" id="product">
    <div class="section-header">
        <h2>Signature Collection</h2>
        <a href="#" class="view-all">View All Products <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <p class="section-subtitle">Our most loved artisanal treats, prepared with traditional recipes and premium ingredients.</p>

    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card">
            <a href="{{ url('/product/' . $product->slug) }}">
                <div class="product-img">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>{{ $product->name }}</h3>
                    <span class="price">Rp{{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($product->rating))
                            <i class="fa-solid fa-star"></i>
                        @elseif ($i - 0.5 <= $product->rating)
                            <i class="fa-solid fa-star-half-stroke"></i>
                        @else
                            <i class="fa-regular fa-star"></i>
                        @endif
                    @endfor
                    <span class="reviews">({{ $product->reviews }})</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('{{ $product->slug }}', event)">ADD TO CART</button>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Bestseller Section -->
@if($bestseller)
<section class="feature container">
    <div class="feature-grid">
        <div class="feature-img">
            <img src="{{ asset($bestseller->image) }}" alt="{{ $bestseller->name }} Bestseller">
        </div>
        <div class="feature-content">
            <span class="tag" style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 1rem; display: block;">OUR BESTSELLER</span>
            <h2>{{ $bestseller->name }}</h2>
            <p>{{ $bestseller->description }}</p>
            <div class="product-price-large" style="font-size: 2rem; font-weight: bold; color: var(--primary-color); margin-bottom: 1.5rem;">Rp{{ number_format($bestseller->price, 0, ',', '.') }}</div>
            <ul class="feature-list">
                <li><i class="fa-solid fa-check"></i> <strong>Premium Ingredients:</strong> {{ $bestseller->ingredients ?: 'Made with organic dairy and free-range eggs.' }}</li>
                <li><i class="fa-solid fa-check"></i> <strong>Perfect Balance:</strong> {{ $bestseller->artisan_note ?: 'Not too sweet, with a hint of vanilla.' }}</li>
                <li><i class="fa-solid fa-check"></i> <strong>Fresh Daily:</strong> {{ $bestseller->storage ?: 'Baked in small batches to ensure quality.' }}</li>
            </ul>
            <button class="btn btn-primary" onclick="addToCart('{{ $bestseller->slug }}', event)" style="font-size: 1.1rem; padding: 1rem 2.5rem; display: inline-flex; align-items: center; gap: 8px;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>
    </div>
</section>
@else
<section class="feature container">
    <div class="feature-grid">
        <div class="feature-img">
            <img src="{{ asset('product-photos/main/lontar.jpeg') }}" alt="Nami Lontar Original Bestseller">
        </div>
        <div class="feature-content">
            <span class="tag" style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 1rem; display: block;">OUR BESTSELLER</span>
            <h2>Nami Lontar Original</h2>
            <p>Experience our signature creation. The Nami Lontar Original combines a perfectly flaky crust with a rich, creamy custard filling that melts in your mouth. Baked fresh daily using our closely guarded traditional recipe.</p>
            <div class="product-price-large" style="font-size: 2rem; font-weight: bold; color: var(--primary-color); margin-bottom: 1.5rem;">$15.50</div>
            <ul class="feature-list">
                <li><i class="fa-solid fa-check"></i> <strong>Premium Ingredients:</strong> Made with organic dairy and free-range eggs.</li>
                <li><i class="fa-solid fa-check"></i> <strong>Perfect Balance:</strong> Not too sweet, with a hint of vanilla.</li>
                <li><i class="fa-solid fa-check"></i> <strong>Fresh Daily:</strong> Baked in small batches to ensure quality.</li>
            </ul>
            <button class="btn btn-primary" onclick="addToCart('lontar', event)" style="font-size: 1.1rem; padding: 1rem 2.5rem; display: inline-flex; align-items: center; gap: 8px;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>
    </div>
</section>
@endif

<!-- Newsletter Section -->
<section class="newsletter">
    <div class="container newsletter-grid">
        <div class="newsletter-content">
            <h2>Fresh from the Oven</h2>
            <p>Join our newsletter and be the first to know about seasonal specials and weekly baked box offers.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required id="newsletter-email">
                <button type="submit" class="btn btn-dark">SUBSCRIBE</button>
            </form>
        </div>
        <div class="newsletter-logo">
            <img src="{{ asset('assets/Logo.png') }}" alt="Nami Lontar Logo" class="logo-gradient">
        </div>
    </div>
</section>
@endsection
