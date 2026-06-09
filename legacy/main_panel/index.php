<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nami Lontar | Artisanal Cakes & Pastries</title>
    <meta name="description"
        content="Experience the perfect balance of flavors with Nami Lontar. Artisanal cakes and pastries made with passion.">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <header>
        <nav class="container">
            <div class="logo-container">
                <img src="../assets/product photo/ChatGPT Image May 6, 2026, 08_09_35 AM.png" alt="Logo" height="50"
                    width="50">
                <div class="logo">Nami Lontar</div>
            </div>
            <ul class="nav-links">
                <li><a href="index.php" class="active">Home</a></li>
                <li><a href="#product">Product</a></li>
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
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-bg">
                <img src="../assets/full product header.png" alt="Delicious Nami Lontar Spread">
            </div>
            <div class="hero-content container">
                <div class="hero-text-box">
                    <span class="since">Est. 2026</span>
                    <h1>Artisanal Pastries in Every Golden Bite</h1>
                    <p>Experience the perfect balance of flavors and textures in our hand-crafted pastries, baked fresh
                        every day with the finest organic ingredients.</p>
                    <a href="#product" class="btn btn-primary">Shop the Collection</a>
                </div>
            </div>
        </section>

        <!-- Signature Pastries -->
        <section class="pastries container" id="product">
            <div class="section-header">
                <h2>Signature Collection</h2>
                <a href="#" class="view-all">View All Products <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <p class="section-subtitle">Our most loved artisanal treats, prepared with traditional recipes and premium ingredients.</p>

            <div class="product-grid">
                <!-- Product 1: Nami Lontar -->
                <div class="product-card">
                    <a href="product.php?id=lontar">
                        <div class="product-img">
                            <img src="../product-photos/main/lontar.jpeg" alt="Nami Lontar Original">
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>Nami Lontar Original</h3>
                            <span class="price">$15.50</span>
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="reviews">(124)</span>
                        </div>
                        <button class="btn btn-add" onclick="addToCart('lontar')">ADD TO CART</button>
                    </div>
                </div>

                <!-- Product 2: Pastel Renyah -->
                <div class="product-card">
                    <a href="product.php?id=pastel">
                        <div class="product-img">
                            <img src="../assets/product photo/pastel.jpeg" alt="Pastel Renyah">
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>Pastel Renyah</h3>
                            <span class="price">$8.25</span>
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                            <span class="reviews">(86)</span>
                        </div>
                        <button class="btn btn-add" onclick="addToCart('pastel')">ADD TO CART</button>
                    </div>
                </div>

                <!-- Product 3: Kripik Gurih -->
                <div class="product-card">
                    <a href="product.php?id=kripik">
                        <div class="product-img">
                            <img src="../assets/product photo/kripik.jpeg" alt="Kripik Gurih">
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>Kripik Gurih</h3>
                            <span class="price">$4.50</span>
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="reviews">(52)</span>
                        </div>
                        <button class="btn btn-add" onclick="addToCart('kripik')">ADD TO CART</button>
                    </div>
                </div>

                <!-- Product 4: Lumpia Frozen -->
                <div class="product-card">
                    <a href="product.php?id=lumpia">
                        <div class="product-img">
                            <img src="../assets/product photo/Lumpia Frozen.png" alt="Lumpia Frozen">
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>Lumpia Frozen</h3>
                            <span class="price">$12.00</span>
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="reviews">(45)</span>
                        </div>
                        <button class="btn btn-add" onclick="addToCart('lumpia')">ADD TO CART</button>
                    </div>
                </div>

                <!-- Product 5: Paket Lengkap -->
                <div class="product-card">
                    <a href="product.php?id=paket-lengkap">
                        <div class="product-img">
                            <img src="../assets/product photo/full produk.jpeg" alt="Paket Lengkap Nami Lontar">
                        </div>
                    </a>
                    <div class="product-info">
                        <div class="product-header">
                            <h3>Paket Lengkap</h3>
                            <span class="price">$45.00</span>
                        </div>
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span class="reviews">(28)</span>
                        </div>
                        <button class="btn btn-add" onclick="addToCart('paket-lengkap')">ADD TO CART</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature Section -->
        <section class="feature container">
            <div class="feature-grid">
                <div class="feature-img">
                    <img src="../assets/baker_kneading_1777430878902.png" alt="Baker kneading dough">
                </div>
                <div class="feature-content">
                    <h2>Slow Fermentation, Real Flavor</h2>
                    <p>We believe that time is the most important ingredient in modern baking. Our sour dough is
                        fermented for 48 hours, resulting in a deeper, more complex flavor and a crust that's truly out
                        of this world.</p>
                    <ul class="feature-list">
                        <li><i class="fa-solid fa-check"></i> <strong>Organic Flour:</strong> We only use the finest
                            organic stone-ground flour.</li>
                        <li><i class="fa-solid fa-check"></i> <strong>Artisanal:</strong> Every loaf is hand-shaped by
                            our master bakers.</li>
                        <li><i class="fa-solid fa-check"></i> <strong>No Preservatives:</strong> Just flour, water,
                            salt, and time.</li>
                    </ul>
                    <a href="#" class="learn-more">Learn About Our Process <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <div class="container">
                <h2>Fresh from the Oven</h2>
                <p>Join our newsletter and be the first to know about seasonal specials and weekly baked box offers.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Your email address" required id="newsletter-email">
                    <button type="submit" class="btn btn-dark">SUBSCRIBE</button>
                </form>
            </div>
        </section>
    </main>

    <footer class="new-footer">
        <div class="container footer-content">
            <div class="footer-brand">
                <h2 class="footer-logo">MBUH BAKERY</h2>
                <p>&copy; 2026 MBUH BAKERY. Crafted with<br>passion. From our hearth to your home,<br>every loaf tells a
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
                        <li><a href="contact.php">Contact</a></li>
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
    <script src="cart-manager.js"></script>
</body>

</html>
