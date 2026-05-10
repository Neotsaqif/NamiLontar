<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details | Nami Lontar</title>
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
                <li><a href="index.php">Home</a></li>
                <li><a href="index.php#product">Product</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="nav-icons">
                <a href="login.php" id="user-btn"><i class="fa-regular fa-user"></i></a>
                <a href="cart.php" id="cart-btn" class="cart-icon">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-count">0</span>
                </a>
            </div>
        </nav>
    </header>

    <main>
        <!-- Breadcrumbs -->
        <div class="container" style="padding: 2rem 2rem 0;">
            <p style="font-size: 0.85rem; color: #888;">
                <a href="index.php">Home</a> / <a href="index.php#product">Shop</a> / <span id="breadcrumb-current" style="color: var(--dark-color); font-weight: 500;">Product</span>
            </p>
        </div>

        <!-- Product Hero -->
        <section class="product-hero container">
            <div class="product-hero-grid">
                <!-- Gallery -->
                <div class="product-gallery">
                    <div class="main-img-container">
                        <img src="" alt="Product Image" id="main-product-img">
                    </div>
                    <div class="thumbnail-grid" id="thumbnail-grid">
                        <!-- Thumbnails will be injected here -->
                    </div>
                </div>

                <!-- Info -->
                <div class="product-content-details">
                    <span class="product-tag" id="product-category">SEASONAL ROTATION</span>
                    <h1 id="product-name">Product Name</h1>
                    
                    <div class="rating-summary">
                        <div class="stars" id="product-stars">
                            <!-- Stars will be injected here -->
                        </div>
                        <span class="review-count" id="product-reviews">(0 reviews)</span>
                    </div>

                    <div class="detail-price" id="product-price">$0.00</div>

                    <p class="product-description" id="product-desc">
                        Product description goes here...
                    </p>

                    <div class="selection-group">
                        <span class="selection-label">Select Size</span>
                        <div class="size-options">
                            <button class="size-btn">Standard</button>
                            <button class="size-btn">Large</button>
                            <button class="size-btn">Gift Box</button>
                        </div>
                    </div>

                    <div class="action-row">
                        <div class="qty-selector">
                            <button class="qty-btn" id="qty-minus">-</button>
                            <input type="text" value="1" class="qty-input" id="qty-input">
                            <button class="qty-btn" id="qty-plus">+</button>
                        </div>
                        <button class="btn btn-large"><i class="fa-solid fa-cart-shopping"></i> ADD TO CART</button>
                        <button class="wishlist-btn"><i class="fa-regular fa-heart"></i></button>
                    </div>

                    <div class="trust-badges">
                        <div class="badge-item">
                            <i class="fa-solid fa-truck-fast"></i>
                            <div class="badge-text">
                                <h4>Fast Delivery</h4>
                                <p>Same day available</p>
                            </div>
                        </div>
                        <div class="badge-item">
                            <i class="fa-solid fa-leaf"></i>
                            <div class="badge-text">
                                <h4>Organic</h4>
                                <p>100% natural</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Extra Info -->
        <section class="product-extra-info">
            <div class="container">
                <div class="info-grid-container">
                    <div class="info-col">
                        <h3>Ingredients</h3>
                        <p id="product-ingredients">Loading...</p>
                    </div>
                    <div class="info-col">
                        <h3>Storage</h3>
                        <p id="product-storage">Loading...</p>
                    </div>
                    <div class="info-col">
                        <h3>Artisan Note</h3>
                        <p id="product-artisan-note">Loading...</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Perfect Pairings -->
        <section class="pairings-section container">
            <h2>Perfect Pairings</h2>
            <div class="pairings-grid" id="pairings-grid">
                <!-- Pairing cards will be injected here -->
            </div>
        </section>
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
                        <li><a href="index.php#product">Best Sellers</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Gift Sets</a></li>
                    </ul>
                </div>
                <div class="link-column">
                    <h3>SUPPORT</h3>
                    <ul>
                        <li><a href="contact.php">Contact</a></li>
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
    <script src="product.js"></script>
</body>

</html>
