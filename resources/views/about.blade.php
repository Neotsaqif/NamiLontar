@extends('layouts.app')

@section('title', 'About Us | Nami Lontar')

@section('content')
<!-- About Hero Section -->
<section class="about-hero">
    <div class="hero-bg">
        <img src="{{ asset('assets/product photo/cake.png') }}" alt="Bakery Background">
        <div class="overlay"></div>
    </div>
    <div class="about-hero-content container">
        <div class="hero-label">
            <span class="line"></span>
            <span class="label-text">OUR STORY</span>
            <span class="line"></span>
        </div>
        <h1>Nami Lontar</h1>
        <p>Dari Rumah, Untuk Hati</p>
        <div class="scroll-indicator">
            <span class="line-v"></span>
        </div>
    </div>
</section>

<!-- Legacy Section -->
<section class="legacy container">
    <div class="legacy-grid">
        <div class="legacy-text">
            <span class="section-tag">EST. 2024</span>
            <h2>Siapa sih itu Nami Lontar?</h2>
            <p>Kami adalah UMKM kuliner rumahan yang hadir kembali sejak 2024 untuk menyajikan aneka camilan lezat yang bikin nagih! Mulai dari kue tradisional seperti pastel, lontar, dan lumpia, hingga renyahnya keripik singkong balado dan asin, semua dibuat dengan penuh cinta demi memanjakan lidah kamu.</p>
            <p>Buat acara spesialmu seperti arisan atau kumpul keluarga, kami siap memproduksi 200 hingga 400 pcs camilan segar. Karena sistemnya pre-order demi menjaga kualitas, pastikan kamu memesan minimal H-5 sebelum acara khusus untuk orderan di atas 150 pcs ya. Yuk, bikin acaramu makin ceria bersama kami!</p>
            <div class="signature">
                <span class="sig-line"></span>
                <p>Dari Rumah, Untuk Hati</p>
            </div>
        </div>
        <div class="legacy-image">
            <div class="image-frame">
                <img src="{{ asset('assets/about_legacy.png') }}" alt="Artisan Baker">
            </div>
        </div>
    </div>
</section>

<!-- Artisanal Section / Rating Section -->
<section class="artisanal">
    <div class="container">
        <div class="section-title-centered">
            <span class="tag">Nami Lontar</span>
            <h2>Our best rating</h2>
        </div>
        <div class="artisanal-grid">
            <!-- Card 1 -->
            <div class="artisanal-card review-card">
                <div class="review-top">
                    <img src="{{ asset('assets/chef1.png') }}" alt="User Profile" class="review-avatar">
                    <span class="review-author">Budi Santoso</span>
                </div>
                <div class="review-middle">
                    <div class="star-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="review-bottom">
                    <p>"Kue lontar dan pastelnya beneran juara! Kulit pastelnya renyah banget dan isinya padat. Kue lontarnya lembut dan manisnya pas, nggak bikin eneg. Cocok banget buat kumpul keluarga. Pasti bakal repeat order terus!"</p>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="artisanal-card review-card">
                <div class="review-top">
                    <img src="{{ asset('assets/chef2.png') }}" alt="User Profile" class="review-avatar">
                    <span class="review-author">Siti Rahmawati</span>
                </div>
                <div class="review-middle">
                    <div class="star-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="review-bottom">
                    <p>"Pesen 200 pcs lumpia sama keripik singkong balado buat acara arisan, semua tamu pada nanyain beli di mana! Keripiknya renyah dan bumbunya nendang banget. Pengirimannya juga tepat waktu. Sukses terus Nami Lontar!"</p>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="artisanal-card review-card">
                <div class="review-top">
                    <img src="{{ asset('assets/chef3.png') }}" alt="User Profile" class="review-avatar">
                    <span class="review-author">Hendra Wijaya</span>
                </div>
                <div class="review-middle">
                    <div class="star-rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="review-bottom">
                    <p>"Baru pertama kali coba kue tradisional dari Nami Lontar dan langsung jatuh cinta. Rasanya bener-bener autentik seperti buatan rumah sendiri yang penuh cinta. Packaging-nya juga rapi dan higienis. Sangat direkomendasikan!"</p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Flagship Section -->
<section class="flagship">
    <div class="container flagship-grid">
        <div class="flagship-content">
            <span class="tag">LOCATION</span>
            <h2>Our Flagship Store</h2>
            <p>Visit us in the heart of the city, where the aroma of fresh bread fills the air. Our flagship
                store is designed to be a sanctuary for pastry lovers, offering a cozy atmosphere and our full
                range of artisanal bakes.</p>
            <div class="location-details">
                <div class="detail">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>123 Bakery Lane, Artisan District</p>
                </div>
                <div class="detail">
                    <i class="fa-solid fa-clock"></i>
                    <p>Mon - Sun: 7:00 AM - 8:00 PM</p>
                </div>
            </div>
        </div>
        <div class="flagship-visual">
            <div class="store-illustration">
                <img src="{{ asset('assets/flagship_store.png') }}" alt="Nami Lontar Flagship Store">
            </div>
        </div>
    </div>
</section>
@endsection
