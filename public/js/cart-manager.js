
class CartManager {
    constructor() {
        this.cart = [];
        this.storageKey = 'nami_lontar_cart';
        this.init();
    }

    init() {
        // Load initial cart state from localStorage
        try {
            const savedCart = localStorage.getItem(this.storageKey);
            if (savedCart) {
                this.cart = JSON.parse(savedCart);
            } else {
                this.cart = [];
            }
            this.updateBadge();
            if (typeof renderCart === 'function') {
                renderCart();
            }
        } catch (e) {
            console.error('Error loading cart from localStorage', e);
            this.cart = [];
        }
    }

    save() {
        try {
            localStorage.setItem(this.storageKey, JSON.stringify(this.cart));
            this.updateBadge();
            if (typeof renderCart === 'function') {
                renderCart();
            }
        } catch (e) {
            console.error('Error saving cart to localStorage', e);
        }
    }

    addItem(productId, quantity = 1, event = null) {
        // Get product details from window.NAMI_PRODUCTS
        const productInfo = window.NAMI_PRODUCTS ? window.NAMI_PRODUCTS[productId] : null;
        
        if (!productInfo && !productId) {
            console.error('Product not found in system');
            return;
        }

        const existingItem = this.cart.find(item => item.id === productId);

        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.cart.push({
                id: productId,
                name: productInfo ? productInfo.name : productId,
                price: productInfo ? productInfo.price : 0,
                image: productInfo ? productInfo.image : '',
                quantity: quantity
            });
        }

        this.save();

        // Animation logic
        let imgToAnimate = null;
        if (event) {
            const target = event.currentTarget || event.target;
            if (target) {
                const card = target.closest('.product-card') || target.closest('.feature-grid') || target.closest('.product-hero-grid') || target.closest('.pairing-card');
                if (card) {
                    imgToAnimate = card.querySelector('img');
                }
            }
        }
        if (!imgToAnimate) {
            imgToAnimate = document.querySelector(`img[src*="${productId}"], img[alt*="${productId}"]`);
        }

        if (imgToAnimate) {
            this.animateFly(imgToAnimate);
        } else {
            this.showNotification('Product added to cart!');
        }
    }

    animateFly(imgElement) {
        const cartBtn = document.getElementById('cart-btn');
        if (!cartBtn) {
            this.showNotification('Product added to cart!');
            return;
        }

        const imgRect = imgElement.getBoundingClientRect();
        const cartRect = cartBtn.getBoundingClientRect();

        const clone = imgElement.cloneNode();
        clone.classList.add('cart-fly-item');
        clone.style.left = `${imgRect.left}px`;
        clone.style.top = `${imgRect.top}px`;
        clone.style.width = `${imgRect.width}px`;
        clone.style.height = `${imgRect.height}px`;
        clone.style.transform = 'scale(1)';

        document.body.appendChild(clone);

        // Force reflow
        clone.offsetWidth;

        // Step 1: Cute initial pop
        clone.style.transform = 'scale(1.15)';

        // Step 2: Arched flight to cart
        setTimeout(() => {
            clone.style.left = `${cartRect.left + cartRect.width / 2 - 20}px`;
            clone.style.top = `${cartRect.top + cartRect.height / 2 - 20}px`;
            clone.style.width = '40px';
            clone.style.height = '40px';
            clone.style.opacity = '0.2';
            clone.style.transform = 'scale(0.15) rotate(540deg)';
        }, 120);

        clone.addEventListener('transitionend', (e) => {
            if (e.propertyName === 'left') {
                clone.remove();
                cartBtn.classList.add('jelly');
                setTimeout(() => cartBtn.classList.remove('jelly'), 700);
                this.showNotification('Product added to cart!');
            }
        });
    }

    removeItem(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.save();
    }

    updateQuantity(productId, quantity) {
        if (quantity < 1) return;
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = quantity;
            this.save();
        }
    }

    clearCart() {
        this.cart = [];
        this.save();
    }

    getCart() {
        return this.cart;
    }

    getTotals() {
        const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const shipping = subtotal > 500000 || subtotal === 0 ? 0 : 50000;
        const tax = subtotal * 0.1; // 10% tax
        const total = subtotal + shipping + tax;
        return { subtotal, shipping, tax, total };
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
}

const cartManager = new CartManager();

function addToCart(id, event = null) {
    if (!event && typeof window.event !== 'undefined') {
        event = window.event;
    }
    cartManager.addItem(id, 1, event);
}
