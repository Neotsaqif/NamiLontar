@extends('layouts.app')

@section('title', 'Your Basket | Nami Lontar')

@section('content')
<main class="basket-container container">
    @if($errors->any())
        <div class="alert alert-danger" style="background-color: #fde8e8; border: 1px solid #f8b4b4; color: #9b1c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem; font-weight: 500; animation: fadeInUp 0.5s ease;">
            <ul style="list-style: none; margin: 0; padding: 0;">
                @foreach($errors->all() as $error)
                    <li><i class="fa-solid fa-circle-exclamation" style="margin-right: 8px;"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="basket-grid">
        <div class="basket-content smooth-reveal smooth-reveal-left">
            <div class="basket-title">
                <h1>Your Basket</h1>
                <p>Review your artisanal selection before checkout.</p>
            </div>

            <div class="basket-items" id="basket-items-list">
                <!-- Items will be injected here -->
            </div>

            <div class="shipping-promo" id="shipping-promo">
                <i class="fa-solid fa-truck"></i>
                <span id="shipping-promo-text">You're Rp0 away from free shipping.</span>
            </div>
        </div>

        <div class="basket-summary smooth-reveal smooth-reveal-right">
            <div class="summary-card">
                <h2>Order Summary</h2>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="summary-subtotal">Rp0</span>
                </div>
                <div class="summary-row">
                    <span>Estimated Shipping</span>
                    <span id="summary-shipping">Rp0</span>
                </div>
                <div class="summary-row">
                    <span>Estimated Tax</span>
                    <span id="summary-tax">Rp0</span>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <span id="summary-total">Rp0</span>
                </div>

                <div class="promo-code">
                    <input type="text" placeholder="Enter code">
                    <button class="btn-apply">APPLY</button>
                </div>

                <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cart_data" id="cart-data-input">
                    <button type="submit" class="btn-checkout" style="width: 100%; border: none; cursor: pointer;">Proceed to Checkout</button>
                </form>
                
                <div style="text-align: center; margin-top: 1.5rem;">
                    <div style="display: flex; justify-content: center; align-items: center; gap: 15px; margin-bottom: 0.5rem;">
                        <img src="{{ asset('assets/gopay.svg') }}" alt="GoPay" style="height: 20px; width: auto;">
                        <img src="{{ asset('assets/ovo.svg') }}" alt="OVO" style="height: 20px; width: auto;">
                        <img src="{{ asset('assets/dana.svg') }}" alt="DANA" style="height: 20px; width: auto;">
                        <img src="{{ asset('assets/qris.svg') }}" alt="QRIS" style="height: 22px; width: auto;">
                    </div>
                    <p style="font-size: 0.7rem; color: #aaa; margin-top: 0.5rem;">SECURE CHECKOUT BY MIDTRANS</p>
                </div>

            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <p style="font-size: 0.9rem; color: #888;">Need help with your order?</p>
                <a href="{{ url('/contact') }}" style="font-weight: 600; color: var(--primary-color);">Chat with a Baker</a>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Handle payment redirect status FIRST (before renderCart)
        const params = new URLSearchParams(window.location.search);
        const paymentStatus = params.get('payment');
        if (paymentStatus) {
            const messages = {
                success: { text: '✅ Payment successful! Your order is confirmed.', color: '#2e7d32' },
                pending: { text: '⏳ Payment pending. We\'ll notify you once confirmed.', color: '#e65100' },
                failed:  { text: '❌ Payment failed. Please try again.', color: '#c62828' },
            };
            const msg = messages[paymentStatus];
            // Clear cart for success/pending outcomes
            if (paymentStatus === 'success' || paymentStatus === 'pending') {
                cartManager.clearCart();
            }
            if (msg) {
                const toast = document.createElement('div');
                toast.style.cssText = `position:fixed;top:1.5rem;right:1.5rem;background:${msg.color};color:#fff;padding:1rem 1.5rem;border-radius:12px;font-weight:600;z-index:9999;box-shadow:0 8px 20px rgba(0,0,0,0.2);opacity:1;transition:opacity .4s`;
                toast.textContent = msg.text;
                document.body.appendChild(toast);
                setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 400); }, 4000);
            }
            // Clean URL
            window.history.replaceState({}, '', '{{ route('cart.index') }}');
        }

        // Render AFTER clearing so cart shows empty
        renderCart();

        // Handle checkout form submission
        const checkoutForm = document.getElementById('checkout-form');
        const cartDataInput = document.getElementById('cart-data-input');

        if (checkoutForm) {
            checkoutForm.addEventListener('submit', (e) => {
                if (!navigator.onLine) {
                    e.preventDefault();
                    alert('No internet connection. Please check your network and try again.');
                    return;
                }
                const cartData = cartManager.getCart();
                if (cartData.length === 0) {
                    e.preventDefault();
                    alert('Your basket is empty!');
                    return;
                }
                cartDataInput.value = JSON.stringify(cartData);
            });
        }
    });
    function renderCart() {
        const items = cartManager.getCart();
        const list = document.getElementById('basket-items-list');
        const promoText = document.getElementById('shipping-promo-text');
        
        if (items.length === 0) {
            list.innerHTML = `<div style="padding: 3rem; text-align: center; color: #888;">Your basket is empty. <a href="{{ url('/#product') }}" style="color: var(--primary-color); font-weight: 600;">Go Shopping</a></div>`;
            updateTotals(0, 0, 0, 0);
            return;
        }

        list.innerHTML = '';
        items.forEach(item => {
            const itemEl = document.createElement('div');
            itemEl.className = 'basket-item';
            itemEl.innerHTML = `
                <div class="item-img">
                    <img src="${item.image}" alt="${item.name}">
                </div>
                <div class="item-info">
                    <h3>${item.name}</h3>
                    <p>Artisanal selection, baked fresh daily.</p>
                </div>
                <div class="item-controls">
                    <div class="qty-selector">
                        <button class="qty-btn" onclick="updateQty('${item.id}', ${item.quantity - 1})">-</button>
                        <input type="text" value="${item.quantity}" class="qty-input" readonly>
                        <button class="qty-btn" onclick="updateQty('${item.id}', ${item.quantity + 1})">+</button>
                    </div>
                    <div class="item-price">Rp${(item.price * item.quantity).toLocaleString('id-ID')}</div>
                    <button class="remove-btn" onclick="cartManager.removeItem('${item.id}')">REMOVE</button>
                </div>
            `;
            list.appendChild(itemEl);
        });

        const { subtotal, shipping, tax, total } = cartManager.getTotals();
        updateTotals(subtotal, shipping, tax, total);

        if (subtotal >= 500000) {
            promoText.textContent = "You qualify for FREE shipping!";
        } else {
            promoText.textContent = `You're Rp${(500000 - subtotal).toLocaleString('id-ID')} away from free shipping.`;
        }
    }

    function updateQty(id, qty) {
        cartManager.updateQuantity(id, qty);
        renderCart();
    }

    const formatRp = (num) => 'Rp' + num.toLocaleString('id-ID');

    function updateTotals(subtotal, shipping, tax, total) {
        document.getElementById('summary-subtotal').textContent = formatRp(subtotal);
        document.getElementById('summary-shipping').textContent = shipping === 0 ? 'FREE' : formatRp(shipping);
        document.getElementById('summary-tax').textContent = formatRp(tax);
        document.getElementById('summary-total').textContent = formatRp(total);
    }
</script>
@endpush
