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
            <h2>A Legacy of Perfection</h2>
            <p>Kami adalah UMKM kuliner rumahan yang lahir kembali di tahun 2024 dengan semangat baru untuk menyajikan aneka camilan lezat yang bikin nagih! Setelah sempat tertunda akibat pandemi Covid-19, kini kami hadir lebih siap untuk memanjakan lidah kamu lewat pilihan kue basah tradisional seperti pastel, kue lontar, dan lumpia, hingga renyahnya keripik singkong varian asin dan balado. Semua menu kami dibuat dengan penuh cinta dari dapur rumah, karena misi utama kami adalah memastikan setiap konsumen bisa mendapatkan kelezatan camilan yang mereka inginkan untuk menemani momen spesial mereka.</p>
            <p>Buat kamu yang lagi punya acara seru seperti arisan atau kumpul keluarga, kami siap banget jadi andalan! Kami menerima pesanan dalam jumlah besar, bahkan sanggup memproduksi hingga 200 sampai 400 pcs camilan segar sekaligus. Karena semua produk kami dibuat dadakan sesuai pesanan (pre-order) demi menjaga kualitas dan rasa, pastikan kamu melakukan pemesanan minimal H-5 sebelum acara ya, khusus untuk orderan di atas 150 pcs. Yuk, bikin acaramu makin ceria dan berkesan dengan sajian lezat dari kami!</p>
            <div class="signature">
                <span class="sig-line"></span>
                <p>Crafted with Passion</p>
            </div>
        </div>
        <div class="legacy-image">
            <div class="image-frame">
                <img src="{{ asset('assets/about_legacy.png') }}" alt="Artisan Baker">
            </div>
        </div>
    </div>
</section>

<!-- Artisanal Section -->
<section class="artisanal">
    <div class="container">
        <div class="section-title-centered">
            <span class="tag">PURELY ARTISANAL</span>
            <h2>Purely Artisanal</h2>
        </div>
        <div class="artisanal-grid">
            <div class="artisanal-card">
                <div class="icon-box">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
                <h3>Organic Ingredients</h3>
                <p>We source only the finest organic flour and local ingredients to ensure the purest taste and
                    highest nutritional value.</p>
            </div>
            <div class="artisanal-card">
                <div class="icon-box">
                    <i class="fa-solid fa-star"></i>
                </div>
                <h3>Traditional Methods</h3>
                <p>Our long fermentation process and hand-shaping techniques create textures and flavors that
                    can't be rushed.</p>
            </div>
            <div class="artisanal-card">
                <div class="icon-box">
                    <i class="fa-solid fa-bread-slice"></i>
                </div>
                <h3>Baked Daily</h3>
                <p>Every morning, our ovens are fired up to bring you fresh, golden pastries that are ready to
                    be enjoyed.</p>
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
