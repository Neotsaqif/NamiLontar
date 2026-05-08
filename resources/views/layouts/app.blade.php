<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nami Lontar | Artisanal Cakes & Pastries')</title>
    <meta name="description"
        content="Experience the perfect balance of flavors with Nami Lontar. Artisanal cakes and pastries made with passion.">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>

<body>
    <header>
        <nav class="container">
            <div class="logo-container">
                <img src="{{ asset('assets/product photo/ChatGPT Image May 6, 2026, 08_09_35 AM.png') }}" alt="Logo" height="50"
                    width="50">
                <div class="logo">Nami Lontar</div>
            </div>
            <ul class="nav-links">
                <li><a href="{{ url('/') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ url('/#product') }}">Product</a></li>
                <li><a href="{{ url('/about') }}" class="{{ Request::is('about') ? 'active' : '' }}">About Us</a></li>
                <li><a href="{{ url('/contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
            <div class="nav-icons">
                <a href="{{ url('/login') }}" id="user-btn"><i class="fa-regular fa-user"></i></a>
                <a href="{{ url('/cart') }}" id="cart-btn" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="new-footer">
        <div class="container footer-content">
            <div class="footer-brand">
                <h2 class="footer-logo">MBUH BAKERY</h2>
                <p>&copy; 2024 MBUH BAKERY. Crafted with<br>passion. From our hearth to your home,<br>every loaf tells a
                    story.</p>
            </div>

            <div class="footer-links-group">
                <div class="link-column">
                    <h3>COMPANY</h3>
                    <ul>
                        <li><a href="#">Sitemap</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Shipping</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h3>SUPPORT</h3>
                    <ul>
                        <li><a href="{{ url('/contact') }}">Contact</a></li>
                        <li><a href="#">Instagram</a></li>
                        <li><a href="#">Facebook</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-newsletter">
                <div class="social-icons">
                    <a href="#" class="icon-circle"><i class="fa-solid fa-globe"></i></a>
                    <a href="#" class="icon-circle"><i class="fa-solid fa-share-nodes"></i></a>
                </div>
                <h3>NEWSLETTER</h3>
                <form class="newsletter-form-footer">
                    <input type="email" placeholder="Your email">
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/cart-manager.js') }}"></script>
    @stack('scripts')
</body>

</html>
