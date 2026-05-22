<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Nami Lontar | Artisanal Cakes & Pastries')</title>
    <meta name="description"
        content="Experience the perfect balance of flavors with Nami Lontar. Artisanal cakes and pastries made with passion.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @stack('styles')
</head>

<body class="page-transition-enter">
    @include('layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.partials.footer')

    <script>
        window.NAMI_PRODUCTS = {
            @foreach(\App\Models\Product::all() as $product)
                '{{ $product->slug }}': {
                    name: '{{ addslashes($product->name) }}',
                    price: {{ $product->price }},
                    image: '{{ $product->image }}'
                },
            @endforeach
        };
    </script>
    <script src="{{ asset('js/cart-manager.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            @if(session('clear_cart'))
                if (typeof cartManager !== 'undefined') {
                    cartManager.clearCart();
                }
            @endif

            const links = document.querySelectorAll('a[href^="{{ url('/') }}"]:not([href*="#"])');
            
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    // Check if it's opening in a new tab
                    if(e.ctrlKey || e.metaKey || this.target === '_blank') return;
                    
                    e.preventDefault();
                    const targetUrl = this.href;
                    
                    document.body.classList.remove('page-transition-enter');
                    document.body.classList.add('page-transition-exit');
                    
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 300);
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
