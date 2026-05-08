const PRODUCTS = {
    'lontar': { name: 'Nami Lontar Original', price: 15.50, image: '../assets/product photo/lontar.jpeg' },
    'pastel': { name: 'Pastel Renyah', price: 8.25, image: '../assets/product photo/pastel.jpeg' },
    'kripik': { name: 'Kripik Gurih', price: 4.50, image: '../assets/product photo/kripik.jpeg' },
    'lumpia': { name: 'Lumpia Frozen', price: 12.00, image: '../assets/product photo/Lumpia Frozen.png' },
    'paket-lengkap': { name: 'Paket Lengkap', price: 45.00, image: '../assets/product photo/full produk.jpeg' }
};

class CartManager {
    constructor() {
        this.cart = JSON.parse(localStorage.getItem('nami_cart')) || [];
        this.updateBadge();
    }

    addItem(productId, quantity = 1) {
        const product = PRODUCTS[productId];
        if (!product) return;

        const existingItem = this.cart.find(item => item.id === productId);
        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.cart.push({
                id: productId,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: quantity
            });
        }
        this.save();
        this.updateBadge();
        this.showNotification(`${product.name} added to cart!`);
    }

    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.save();
        this.updateBadge();
        // If we are on the cart page, reload the UI
        if (window.location.pathname.includes('cart.html')) {
            window.location.reload();
        }
    }

    updateQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, quantity);
            this.save();
            this.updateBadge();
        }
    }

    getCart() {
        return this.cart;
    }

    getTotals() {
        const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shipping = subtotal > 50 ? 0 : 5.00;
        const tax = subtotal * 0.1; // 10% tax
        const total = subtotal + shipping + tax;
        return { subtotal, shipping, tax, total };
    }

    save() {
        localStorage.setItem('nami_cart', JSON.stringify(this.cart));
    }

    updateBadge() {
        const badges = document.querySelectorAll('.cart-count');
        const count = this.cart.reduce((sum, item) => sum + item.quantity, 0);
        badges.forEach(badge => {
            badge.textContent = count;
        });
    }

    showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => notification.classList.add('show'), 100);
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 500);
        }, 3000);
    }

    clear() {
        this.cart = [];
        this.save();
        this.updateBadge();
    }
}

const cartManager = new CartManager();

// Global add to cart function for simple access
function addToCart(id) {
    cartManager.addItem(id, 1);
}
