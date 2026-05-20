
class CartManager {
    constructor() {
        this.cart = [];
        this.init();
    }

    async init() {
        // Fetch initial cart state from server
        try {
            const response = await fetch('/api/cart', {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            if (response.ok) {
                this.cart = await response.json();
                this.updateBadge();
                if (typeof renderCart === 'function') {
                    renderCart();
                }
            } else if (response.status === 401) {
                // Not logged in, cart is empty
                this.cart = [];
                this.updateBadge();
            }
        } catch (e) {
            console.error('Error loading cart', e);
        }
    }

    async addItem(productId, quantity = 1) {
        try {
            const response = await fetch('/api/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ product_id: productId, quantity })
            });

            if (response.status === 401) {
                // Redirect to login
                window.location.href = '/login';
                return;
            }

            if (response.ok) {
                this.showNotification('Product added to cart!');
                await this.init(); // Refresh cart data
            }
        } catch (e) {
            console.error('Error adding item', e);
        }
    }

    async removeItem(productId) {
        try {
            const response = await fetch('/api/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ product_id: productId })
            });

            if (response.ok) {
                await this.init();
            }
        } catch (e) {
            console.error('Error removing item', e);
        }
    }

    async updateQuantity(productId, quantity) {
        if (quantity < 1) return;
        try {
            const response = await fetch('/api/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ product_id: productId, quantity })
            });

            if (response.ok) {
                await this.init();
            }
        } catch (e) {
            console.error('Error updating quantity', e);
        }
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

// Global add to cart function for simple access
function addToCart(id) {
    cartManager.addItem(id, 1);
}
