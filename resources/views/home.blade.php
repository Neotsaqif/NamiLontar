@extends('layouts.app')

@section('title', 'Nami Lontar | Artisanal Cakes & Pastries')

@section('content')
<!-- Hero Section -->
<section class="hero">
    <div class="hero-bg">
        <img src="{{ asset('assets/product photo/ChatGPT Image May 6, 2026, 08_00_11 AM.png') }}" alt="Delicious Nami Lontar Spread">
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

<!-- Feature Section -->
<section class="feature container">
    <div class="feature-grid">
        <div class="feature-img">
            <img src="{{ asset('assets/baker_kneading_1777430878902.png') }}" alt="Baker kneading dough">
        </div>
        <div class="feature-content">
            <h2>Slow Fermentation, Real Flavor</h2>
            <p>We believe that time is the most important ingredient in modern baking. Our sour dough is
                fermented for 48 hours, resulting in a deeper, more complex flavor and a crust that's truly out
                of this world.</p>
            <ul class="feature-list">
                <li><i class="fa-solid fa-check"></i> <strong>Organic Flour:</strong> We only use the finest
                    organic stone-ground flour.</li>
                <li><i class="fa-solid fa-check"></i> <strong>Artisanal:</strong> Every loaf is hand-shaped by
                    our master bakers.</li>
                <li><i class="fa-solid fa-check"></i> <strong>No Preservatives:</strong> Just flour, water,
                    salt, and time.</li>
            </ul>
            <a href="#" class="learn-more">Learn About Our Process <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="newsletter">
    <div class="container">
        <h2>Fresh from the Oven</h2>
        <p>Join our newsletter and be the first to know about seasonal specials and weekly baked box offers.</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Your email address" required id="newsletter-email">
            <button type="submit" class="btn btn-dark">SUBSCRIBE</button>
        </form>
    </div>
</section>
@endsection
