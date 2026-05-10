<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Toko Serba Ada')</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <!-- Animated Background Orbs -->
    <div class="bg-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">NAMI LONTAR</div>
            <nav>
                <a href="{{ url('/admin/dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i> Dashboard
                </a>
                <a href="{{ url('/admin/orders') }}" class="{{ Request::is('admin/orders') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i> Orders
                </a>
                <a href="{{ url('/admin/categories') }}" class="{{ Request::is('admin/categories') ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Categories
                </a>
                <a href="{{ url('/admin/customers') }}" class="{{ Request::is('admin/customers') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i> Customers
                </a>
                <a href="{{ url('/admin/discounts') }}" class="{{ Request::is('admin/discounts') ? 'active' : '' }}">
                    <i class="fa-solid fa-tag"></i> Discounts
                </a>
                <a href="{{ url('/admin/settings') }}" class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i> Settings
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>
