@extends('layouts.app')

@section('title', 'Nami Lontar | Artisanal Cakes & Pastries')

@section('content')
<!-- Hero Section -->
@if(session('success'))
<div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 1rem; text-align: center; font-weight: bold;">
    {{ session('success') }}
</div>
@endif
<section class="home-hero">
    <div class="home-hero-bg">
        <img src="{{ asset('assets/full product header.png') }}" alt="Delicious Nami Lontar Spread">
        <div class="home-hero-overlay"></div>
    </div>
    <div class="home-hero-content container">
        <div class="hero-label-pill">Nami Lontar</div>
        <h1 class="home-hero-title">Welcome</h1>
        <p class="home-hero-subtitle">Dari Rumah, Untuk Hati</p>
        <div class="home-hero-cta">
            <a href="#product" class="hero-btn-primary">Lihat Produk <i class="fa-solid fa-arrow-down"></i></a>
        </div>
        <div class="scroll-indicator">
            <span class="line-v"></span>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════
     BUSINESS OVERVIEW — Quick Stats
════════════════════════════════════════════ -->
<section class="business-overview">
    <div class="container">
        <div class="biz-section-header">
            <div class="biz-section-title-wrap">
                <span class="biz-section-eyebrow"><i class="fa-solid fa-chart-line"></i> Live Analytics</span>
                <h2 class="biz-section-title">Business Overview</h2>
            </div>
            <span class="biz-section-tag">Data hari ini · {{ now()->format('d M Y') }}</span>
        </div>

        <div class="biz-stat-grid">
            <!-- Card 1: Total Pengunjung -->
            <div class="biz-stat-card biz-card-gold">
                <div class="biz-stat-top">
                    <div class="biz-stat-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="biz-stat-badge biz-badge-up">
                        <i class="fa-solid fa-arrow-trend-up"></i> +12%
                    </span>
                </div>
                <div class="biz-stat-label">Total Pengunjung Hari Ini</div>
                <div class="biz-stat-value">1.245</div>
                <div class="biz-stat-sub">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+149 dari kemarin</span>
                </div>
            </div>

            <!-- Card 2: Total Pembelian -->
            <div class="biz-stat-card biz-card-blue">
                <div class="biz-stat-top">
                    <div class="biz-stat-icon biz-icon-blue">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <span class="biz-stat-badge biz-badge-blue">
                        <i class="fa-solid fa-bolt"></i> Hari Ini
                    </span>
                </div>
                <div class="biz-stat-label">Total Pembelian Hari Ini</div>
                <div class="biz-stat-value biz-val-blue">38</div>
                <div class="biz-stat-sub">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+3 pesanan · +8% dari kemarin</span>
                </div>
            </div>

            <!-- Card 3: Produk Terjual -->
            <div class="biz-stat-card biz-card-amber">
                <div class="biz-stat-top">
                    <div class="biz-stat-icon biz-icon-amber">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <span class="biz-stat-badge biz-badge-amber">
                        <i class="fa-solid fa-cubes"></i> Produk
                    </span>
                </div>
                <div class="biz-stat-label">Produk Terjual Hari Ini</div>
                <div class="biz-stat-value biz-val-amber">87</div>
                <div class="biz-stat-sub">
                    <i class="fa-solid fa-arrow-up"></i>
                    <span>+4 unit · +5% dari kemarin</span>
                </div>
            </div>
        </div>

        <!-- ─── Charts Row ─── -->
        <div class="biz-charts-row">
            <!-- Chart 1: Pengunjung Harian -->
            <div class="biz-chart-card">
                <div class="biz-chart-header">
                    <div>
                        <h3 class="biz-chart-title"><i class="fa-solid fa-eye"></i> Grafik Pengunjung Harian</h3>
                        <p class="biz-chart-sub">Tren kunjungan 7 hari terakhir</p>
                    </div>
                    <span class="biz-chart-badge">Minggu Ini</span>
                </div>
                <div class="biz-chart-wrap">
                    <canvas id="visitorChart"></canvas>
                </div>
            </div>

            <!-- Chart 2: Pembelian Harian -->
            <div class="biz-chart-card">
                <div class="biz-chart-header">
                    <div>
                        <h3 class="biz-chart-title"><i class="fa-solid fa-bag-shopping"></i> Grafik Pembelian Harian</h3>
                        <p class="biz-chart-sub">Tren transaksi 7 hari terakhir</p>
                    </div>
                    <span class="biz-chart-badge">Minggu Ini</span>
                </div>
                <div class="biz-chart-wrap">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Signature Pastries -->
<section class="pastries container" id="product">
    <div class="section-header">
        <h2>Pilihan Nami Lontar</h2>
        <a href="#" class="view-all">View All Products <i class="fa-solid fa-arrow-right"></i></a>
    </div>
    <p class="section-subtitle">Dibuat dengan resep keluarga, bahan berkualitas, dan sentuhan kehangatan di setiap sajian.</p>

    <div class="product-grid">
        @foreach($products as $product)
        <div class="product-card smooth-reveal smooth-reveal-scale delay-{{ (($loop->index % 4) + 1) * 100 }}">
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
        <div class="feature-img smooth-reveal smooth-reveal-left">
            <img src="{{ asset($bestseller->image) }}" alt="{{ $bestseller->name }} Bestseller">
        </div>
        <div class="feature-content smooth-reveal smooth-reveal-right">
            <span class="tag smooth-pulsing" style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 1rem; display: block;">OUR BESTSELLER</span>
            <h2>{{ $bestseller->name }}</h2>
            <p>{{ $bestseller->description }}</p>
            <div class="product-price-large" style="font-size: 2rem; font-weight: bold; color: var(--primary-color); margin-bottom: 1.5rem;">Rp{{ number_format($bestseller->price, 0, ',', '.') }}</div>
            <ul class="feature-list">
                <li><i class="fa-solid fa-check"></i> <strong>Kualitas:</strong> {{ $bestseller->ingredients ?: 'Terbuat dari bahan yang selalu baru.' }}</li>
                <li><i class="fa-solid fa-check"></i> <strong>Rasa:</strong> {{ $bestseller->artisan_note ?: 'Tidak terlalu manis dan rasanya seimbang.' }}</li>
                <li><i class="fa-solid fa-check"></i> <strong>Ketepatan waktu masak:</strong> {{ $bestseller->storage ?: 'Terpanggang dengan waktu yang sudah ditentukan.' }}</li>
            </ul>
            <button class="btn btn-primary" onclick="addToCart('{{ $bestseller->slug }}', event)" style="font-size: 1.1rem; padding: 1rem 2.5rem; display: inline-flex; align-items: center; gap: 8px;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>
    </div>
</section>
@else
<section class="feature container">
    <div class="feature-grid">
        <div class="feature-img smooth-reveal smooth-reveal-left">
            <img src="{{ asset('product-photos/main/lontar.jpeg') }}" alt="Nami Lontar Original Bestseller">
        </div>
        <div class="feature-content smooth-reveal smooth-reveal-right">
            <span class="tag smooth-pulsing" style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; font-size: 0.8rem; margin-bottom: 1rem; display: block;">OUR BESTSELLER</span>
            <h2>Nami Lontar Original</h2>
            <p>Experience our signature creation. The Nami Lontar Original combines a perfectly flaky crust with a rich, creamy custard filling that melts in your mouth. Baked fresh daily using our closely guarded traditional recipe.</p>
            <div class="product-price-large" style="font-size: 2rem; font-weight: bold; color: var(--primary-color); margin-bottom: 1.5rem;">$15.50</div>
            <ul class="feature-list">
                <li><i class="fa-solid fa-check"></i> <strong>Kualitas:</strong> Terbuat dari bahan yang selalu baru.</li>
                <li><i class="fa-solid fa-check"></i> <strong>Rasa:</strong> Tidak terlalu manis dan rasanya seimbang.</li>
                <li><i class="fa-solid fa-check"></i> <strong>Ketepatan waktu masak:</strong> Terpanggang dengan waktu yang sudah ditentukan.</li>
            </ul>
            <button class="btn btn-primary" onclick="addToCart('lontar', event)" style="font-size: 1.1rem; padding: 1rem 2.5rem; display: inline-flex; align-items: center; gap: 8px;">Add to Cart <i class="fa-solid fa-cart-shopping"></i></button>
        </div>
    </div>
</section>
@endif

<!-- Newsletter Section -->
<section class="newsletter">
    <div class="container newsletter-grid">
        <div class="newsletter-content smooth-reveal smooth-reveal-left">
            <h2>Fresh from the Oven</h2>
            <p>Join our newsletter and be the first to know about seasonal specials and weekly baked box offers.</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required id="newsletter-email">
                <button type="submit" class="btn btn-dark">SUBSCRIBE</button>
            </form>
        </div>
        <div class="newsletter-logo smooth-reveal smooth-reveal-right smooth-floating">
            <img src="{{ asset('assets/Logo.png') }}" alt="Nami Lontar Logo" class="logo-gradient">
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const labels = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

    // ─── Chart 1: Pengunjung Harian ───
    const visitorCtx = document.getElementById('visitorChart').getContext('2d');
    const visitorGrad = visitorCtx.createLinearGradient(0, 0, 0, 260);
    visitorGrad.addColorStop(0, 'rgba(212, 175, 55, 0.35)');
    visitorGrad.addColorStop(1, 'rgba(212, 175, 55, 0.01)');

    new Chart(visitorCtx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Pengunjung',
                data: [980, 1120, 860, 1340, 1245, 1560, 1180],
                borderColor: '#D4AF37',
                backgroundColor: visitorGrad,
                borderWidth: 2.5,
                pointBackgroundColor: '#D4AF37',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.42,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            scales: {
                x: {
                    grid: { color: 'rgba(139, 94, 60, 0.08)' },
                    ticks: { color: '#8B5E3C', font: { size: 12, family: 'Inter' } }
                },
                y: {
                    min: 0,
                    grid: { color: 'rgba(139, 94, 60, 0.08)' },
                    ticks: { color: '#8B5E3C', font: { size: 12 }, callback: v => v.toLocaleString() }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(43, 35, 28, 0.92)',
                    titleColor: '#F5E6C8',
                    bodyColor: '#D4AF37',
                    borderColor: 'rgba(212, 175, 55, 0.3)',
                    borderWidth: 1,
                    padding: 12,
                    callbacks: { label: ctx => ` ${ctx.raw.toLocaleString()} pengunjung` }
                }
            }
        }
    });

    // ─── Chart 2: Pembelian Harian ───
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesGrad = salesCtx.createLinearGradient(0, 0, 0, 260);
    salesGrad.addColorStop(0, 'rgba(52, 168, 131, 0.35)');
    salesGrad.addColorStop(1, 'rgba(52, 168, 131, 0.01)');

    new Chart(salesCtx, {
        type: 'line',
        data: {
            labels,
            datasets: [{
                label: 'Pesanan',
                data: [28, 34, 22, 41, 38, 52, 44],
                borderColor: '#34A883',
                backgroundColor: salesGrad,
                borderWidth: 2.5,
                pointBackgroundColor: '#34A883',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7,
                tension: 0.42,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            scales: {
                x: {
                    grid: { color: 'rgba(139, 94, 60, 0.08)' },
                    ticks: { color: '#8B5E3C', font: { size: 12, family: 'Inter' } }
                },
                y: {
                    min: 0,
                    grid: { color: 'rgba(139, 94, 60, 0.08)' },
                    ticks: { color: '#8B5E3C', font: { size: 12 }, callback: v => v + ' pesanan' }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(43, 35, 28, 0.92)',
                    titleColor: '#F5E6C8',
                    bodyColor: '#34A883',
                    borderColor: 'rgba(52, 168, 131, 0.3)',
                    borderWidth: 1,
                    padding: 12,
                    callbacks: { label: ctx => ` ${ctx.raw} pesanan` }
                }
            }
        }
    });
});
</script>
@endpush
