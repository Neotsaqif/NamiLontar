<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Toko Serba Ada')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="brand">Toko Serba Ada</div>
            <nav>
                <a href="{{ url('/admin/dashboard') }}" class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ url('/admin/orders') }}" class="{{ Request::is('admin/orders') ? 'active' : '' }}">Orders</a>
                <a href="{{ url('/admin/categories') }}" class="{{ Request::is('admin/categories') ? 'active' : '' }}">Categories</a>
                <a href="{{ url('/admin/customers') }}" class="{{ Request::is('admin/customers') ? 'active' : '' }}">Customers</a>
                <a href="{{ url('/admin/discounts') }}" class="{{ Request::is('admin/discounts') ? 'active' : '' }}">Discounts</a>
                <a href="{{ url('/admin/settings') }}" class="{{ Request::is('admin/settings') ? 'active' : '' }}">Settings</a>
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
