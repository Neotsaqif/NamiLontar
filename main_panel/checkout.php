<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Nami Lontar</title>
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

    <main class="container">
        <div class="checkout-grid">
            <div class="checkout-forms">
                <h1 style="font-family: 'Playfair Display'; font-size: 3rem; margin-bottom: 3rem;">Checkout</h1>
                
                <section class="checkout-section">
                    <h2><i class="fa-solid fa-truck-fast"></i> Shipping Information</h2>
                    <form class="form-grid">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="John" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Doe" required>
                        </div>
                        <div class="form-group full">
                            <label>Street Address</label>
                            <input type="text" placeholder="123 Artisan Lane" required>
                        </div>
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" placeholder="Bakeryville" required>
                        </div>
                        <div class="form-group">
                            <label>Postal Code</label>
                            <input type="text" placeholder="90210" required>
                        </div>
                    </form>
                </section>

                <section class="checkout-section">
                    <h2><i class="fa-solid fa-credit-card"></i> Payment Method</h2>
                    <div class="payment-methods">
                        <div class="payment-method active">
                            <div class="payment-info">
                                <i class="fa-solid fa-circle-dot" style="color: var(--primary-color);"></i>
                                <span>Credit / Debit Card</span>
                            </div>
                            <img src="https://img.icons8.com/color/48/000000/visa.png" width="30">
                        </div>
                        
                        <div class="form-grid" style="margin-top: 1.5rem;">
                            <div class="form-group full">
                                <label>Card Number</label>
                                <input type="text" placeholder="0000 0000 0000 0000" required>
                            </div>
                            <div class="form-group">
                                <label>Expiry Date</label>
                                <input type="text" placeholder="MM / YY" required>
                            </div>
                            <div class="form-group">
                                <label>CVV</label>
                                <input type="password" placeholder="123" required>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="checkout-summary">
                <div class="summary-card">
                    <h2>Order Summary</h2>
                    
                    <div class="order-items-summary" id="checkout-items-list">
                        <!-- Items injected here -->
                    </div>

                    <div class="promo-code" style="margin-bottom: 2rem;">
                        <input type="text" placeholder="Promo code">
                        <button class="btn-apply">APPLY</button>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span id="check-subtotal">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Shipping</span>
                        <span id="check-shipping">$0.00</span>
                    </div>
                    <div class="summary-row">
                        <span>Taxes</span>
                        <span id="check-tax">$0.00</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="check-total">$0.00</span>
                    </div>

                    <button class="btn-complete" onclick="completePurchase()">
                        Complete Purchase <i class="fa-solid fa-lock"></i>
                    </button>
                    
                    <p style="text-align: center; font-size: 0.75rem; color: #888; margin-top: 1.5rem;">
                        <i class="fa-solid fa-shield-halved"></i> Secure Checkout • Powered by ArtisanPay
                    </p>
                </div>
            </div>
        </div>
    </main>

    <footer class="new-footer" style="background: none; border-top: 1px solid #eee;">
        <div class="container" style="display: flex; justify-content: space-between; padding: 2rem 0; font-size: 0.85rem; color: #888;">
            <div class="footer-logo" style="margin: 0; font-size: 1.2rem;">NAMI LONTAR</div>
            <div style="display: flex; gap: 2rem;">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Shipping Info</a>
            </div>
            <div>&copy; 2024 NAMI LONTAR. Artisanal Craftsmanship.</div>
        </div>
    </footer>

    <script src="cart-manager.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const items = cartManager.getCart();
            const list = document.getElementById('checkout-items-list');
            
            if (items.length === 0) {
                window.location.href = 'cart.html';
                return;
            }

            list.innerHTML = '';
            items.forEach(item => {
                const itemEl = document.createElement('div');
                itemEl.className = 'small-item';
                itemEl.innerHTML = `
                    <div class="small-img">
                        <img src="${item.image}" alt="${item.name}">
                    </div>
                    <div class="small-info">
                        <h4>${item.name}</h4>
                        <p>QTY: ${item.quantity}</p>
                    </div>
                    <div class="small-price">$${(item.price * item.quantity).toFixed(2)}</div>
                `;
                list.appendChild(itemEl);
            });

            const { subtotal, shipping, tax, total } = cartManager.getTotals();
            document.getElementById('check-subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('check-shipping').textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
            document.getElementById('check-tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('check-total').textContent = `$${total.toFixed(2)}`;
        });

        function completePurchase() {
            alert('Thank you for your purchase! Your artisanal treats are being prepared.');
            cartManager.clear();
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>
