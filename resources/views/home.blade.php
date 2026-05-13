@extends('layouts.app')

@section('title', 'Nami Lontar | Artisanal Cakes & Pastries')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg">
        <img src="{{ asset('assets/product photo/cake.png') }}" alt="Delicious Nami Lontar Spread">
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
        <!-- Product 1: Nami Lontar -->
        <div class="product-card">
            <a href="{{ url('/product/lontar') }}">
                <div class="product-img">
                    <img src="{{ asset('assets/product photo/lontar.jpeg') }}" alt="Nami Lontar Original">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>Nami Lontar Original</h3>
                    <span class="price">$15.50</span>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span class="reviews">(124)</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('lontar')">ADD TO CART</button>
            </div>
        </div>

        <!-- Product 2: Pastel Renyah -->
        <div class="product-card">
            <a href="{{ url('/product/pastel') }}">
                <div class="product-img">
                    <img src="{{ asset('assets/product photo/pastel.jpeg') }}" alt="Pastel Renyah">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>Pastel Renyah</h3>
                    <span class="price">$8.25</span>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                    <span class="reviews">(86)</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('pastel')">ADD TO CART</button>
            </div>
        </div>

        <!-- Product 3: Kripik Gurih -->
        <div class="product-card">
            <a href="{{ url('/product/kripik') }}">
                <div class="product-img">
                    <img src="{{ asset('assets/product photo/kripik.jpeg') }}" alt="Kripik Gurih">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>Kripik Gurih</h3>
                    <span class="price">$4.50</span>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span class="reviews">(52)</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('kripik')">ADD TO CART</button>
            </div>
        </div>

        <!-- Product 4: Lumpia Frozen -->
        <div class="product-card">
            <a href="{{ url('/product/lumpia') }}">
                <div class="product-img">
                    <img src="{{ asset('assets/product photo/Lumpia Frozen.png') }}" alt="Lumpia Frozen">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>Lumpia Frozen</h3>
                    <span class="price">$12.00</span>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span class="reviews">(45)</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('lumpia')">ADD TO CART</button>
            </div>
        </div>

        <!-- Product 5: Paket Lengkap -->
        <div class="product-card">
            <a href="{{ url('/product/paket-lengkap') }}">
                <div class="product-img">
                    <img src="{{ asset('assets/product photo/full produk.jpeg') }}" alt="Paket Lengkap Nami Lontar">
                </div>
            </a>
            <div class="product-info">
                <div class="product-header">
                    <h3>Paket Lengkap</h3>
                    <span class="price">$45.00</span>
                </div>
                <div class="rating">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <span class="reviews">(28)</span>
                </div>
                <button class="btn btn-add" onclick="addToCart('paket-lengkap')">ADD TO CART</button>
            </div>
        </div>
    </div>
</section>

<!-- Bestseller Section -->
<section class="feature container">
    <div class="feature-grid">
        <div class="feature-img">
            <img src="{{ asset('assets/product photo/lontar.jpeg') }}" alt="Nami Lontar Original Bestseller">
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
            <button class="btn btn-primary" onclick="addToCart('lontar')" style="font-size: 1.1rem; padding: 1rem 2.5rem; display: inline-flex; align-items: center; gap: 8px;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>
    </div>
</section>

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
            <img src="{{ asset('assets/product photo/logo.png') }}" alt="Nami Lontar Logo" class="logo-gradient">
        </div>
    </div>
</section>
@endsection
