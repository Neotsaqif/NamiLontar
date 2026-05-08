<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Basket | Nami Lontar</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="logo-container">
                <img src="../assets/product photo/ChatGPT Image May 6, 2026, 08_09_35 AM.png" alt="Logo" height="50" width="50">
                <div class="logo">Nami Lontar</div>
            </div>
            <ul class="nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="index.html#product">Product</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
            <div class="nav-icons">
                <a href="login.html" id="user-btn"><i class="fa-regular fa-user"></i></a>
                <a href="cart.html" id="cart-btn" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </nav>
    </header>

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
                    <span id="shipping-promo-text">You're $0.00 away from free shipping.</span>
                </div>
            </div>

            <div class="basket-summary">
                <div class="summary-card">
                    <h2>Order Summary</h2>
                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="summary-subtotal">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Estimated Shipping</span>
                        <span id="summary-shipping">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Estimated Tax</span>
                        <span id="summary-tax">$0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="summary-total">$0.00</span>
                    </div>

                    <div class="promo-code">
                        <input type="text" placeholder="Enter code">
                        <button class="btn-apply">APPLY</button>
                    </div>

                    <a href="checkout.html" class="btn-checkout">Proceed to Checkout</a>
                    
                    <div style="text-align: center; margin-top: 1.5rem;">
                        <img src="https://img.icons8.com/color/48/000000/visa.png" width="30">
                        <img src="https://img.icons8.com/color/48/000000/mastercard.png" width="30">
                        <img src="https://img.icons8.com/color/48/000000/paypal.png" width="30">
                        <p style="font-size: 0.7rem; color: #aaa; margin-top: 0.5rem;">SECURE CHECKOUT BY ARTISANPAY</p>
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 2rem;">
                    <p style="font-size: 0.9rem; color: #888;">Need help with your order?</p>
                    <a href="contact.html" style="font-weight: 600; color: var(--primary-color);">Chat with a Baker</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="new-footer">
        <div class="container footer-content">
            <div class="footer-brand">
                <h2 class="footer-logo">NAMI LONTAR</h2>
                <p>&copy; 2024 NAMI LONTAR. Crafted with<br>passion. From our hearth to your home,<br>every bite tells a story.</p>
            </div>

            <div class="footer-links-group">
                <div class="link-column">
                    <h3>SHOP</h3>
                    <ul>
                        <li><a href="index.html#product">Best Sellers</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Gift Sets</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h3>SUPPORT</h3>
                    <ul>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-newsletter">
                <div class="social-icons">
                    <a href="#" class="icon-circle"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" class="icon-circle"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <h3>NEWSLETTER</h3>
                <form class="newsletter-form-footer">
                    <input type="email" placeholder="Your email">
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
            </div>
        </div>
    </footer>

    <script src="cart-manager.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            renderCart();
        });

        function renderCart() {
            const items = cartManager.getCart();
            const list = document.getElementById('basket-items-list');
            const promoText = document.getElementById('shipping-promo-text');
            
            if (items.length === 0) {
                list.innerHTML = '<div style="padding: 3rem; text-align: center; color: #888;">Your basket is empty. <a href="index.html#product" style="color: var(--primary-color); font-weight: 600;">Go Shopping</a></div>';
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
                        <div class="item-price">$${(item.price * item.quantity).toFixed(2)}</div>
                        <button class="remove-btn" onclick="cartManager.removeItem('${item.id}')">REMOVE</button>
                    </div>
                `;
                list.appendChild(itemEl);
            });

            const { subtotal, shipping, tax, total } = cartManager.getTotals();
            updateTotals(subtotal, shipping, tax, total);

            if (subtotal >= 50) {
                promoText.textContent = "You qualify for FREE shipping!";
            } else {
                promoText.textContent = `You're $${(50 - subtotal).toFixed(2)} away from free shipping.`;
            }
        }

        function updateQty(id, qty) {
            cartManager.updateQuantity(id, qty);
            renderCart();
        }

        function updateTotals(subtotal, shipping, tax, total) {
            document.getElementById('summary-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('summary-shipping').textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
            document.getElementById('summary-tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('summary-total').textContent = `$${total.toFixed(2)}`;
        }
    </script>
</body>

</html>
