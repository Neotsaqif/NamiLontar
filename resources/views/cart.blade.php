@extends('layouts.app')

@section('title', 'Your Basket | Nami Lontar')

@section('content')
<main class="basket-container container">
    <div class="basket-grid">
        <div class="basket-content">
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

        <div class="basket-summary">
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

                <a href="{{ url('/checkout') }}" class="btn-checkout">Proceed to Checkout</a>
                
                <div style="text-align: center; margin-top: 1.5rem;">
                    <img src="https://img.icons8.com/color/48/000000/visa.png" width="30">
                    <img src="https://img.icons8.com/color/48/000000/mastercard.png" width="30">
                    <img src="https://img.icons8.com/color/48/000000/paypal.png" width="30">
                    <p style="font-size: 0.7rem; color: #aaa; margin-top: 0.5rem;">SECURE CHECKOUT BY ARTISANPAY</p>
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
        renderCart();
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
