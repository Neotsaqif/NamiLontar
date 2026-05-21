
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

    async addItem(productId, quantity = 1, event = null) {
        try {
            // Find the image to animate
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
                if (imgToAnimate) {
                    this.animateFly(imgToAnimate);
                } else {
                    this.showNotification('Product added to cart!');
                }
                await this.init(); // Refresh cart data
            }
        } catch (e) {
            console.error('Error adding item', e);
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
            // Trigger completion only on 'left' transition to avoid duplicate triggers
            if (e.propertyName === 'left') {
                clone.remove();
                cartBtn.classList.add('jelly');
                setTimeout(() => cartBtn.classList.remove('jelly'), 700);
                this.showNotification('Product added to cart!');
            }
        });
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
function addToCart(id, event = null) {
    if (!event && typeof window.event !== 'undefined') {
        event = window.event;
    }
    cartManager.addItem(id, 1, event);
}
