<header>
    <nav class="container">
        <div class="logo-container">
            <img src="../assets/product photo/logo.png" alt="Logo" height="50"
                width="50">
            <div class="logo">Nami Lontar</div>
        </div>
        <ul class="nav-links">
            <li><a href="index.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="index.php#product">Product</a></li>
            <li><a href="about.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'about.php') ? 'active' : ''; ?>">About Us</a></li>
            <li><a href="contact.php" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'contact.php') ? 'active' : ''; ?>">Contact</a></li>
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
