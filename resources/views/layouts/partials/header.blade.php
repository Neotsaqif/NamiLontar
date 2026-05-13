<header>
    <nav class="container">
        <div class="logo-container">
            <img src="{{ asset('assets/product photo/logo.png') }}" alt="Logo" height="70"
                width="70">
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
