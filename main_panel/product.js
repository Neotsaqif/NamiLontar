const productData = {
    'lontar': {
        name: 'Nami Lontar Original',
        price: '$15.50',
        category: 'SIGNATURE PRODUCT',
        rating: 5,
        reviews: 124,
        description: 'Our signature Nami Lontar (Papuan Milk Pie) is a delicate balance of creamy, rich egg custard and a buttery, flaky crust. Each tart is hand-crafted using a traditional recipe passed down through generations, ensuring an authentic taste of artisanal excellence.',
        image: '../assets/product photo/lontar.jpeg',
        thumbnails: [
            '../assets/product photo/lontar.jpeg',
            '../assets/product photo/full produk.jpeg',
            '../assets/product photo/ChatGPT Image May 6, 2026, 08_00_11 AM.png'
        ],
        ingredients: 'Organic Stone-Ground Flour, Premium Grass-Fed Butter, Organic Free-Range Eggs, Condensed Milk, Sea Salt, Vanilla Bean.',
        storage: 'Store in a cool, dry place. For best taste, consume within 3 days. Can be refrigerated for up to 7 days.',
        artisanNote: 'We use a slow-bake method at low temperatures to ensure the custard reaches a perfect, silky consistency without any bubbles.',
        pairings: [
            { name: 'Pastel Renyah', price: '$8.25', image: '../assets/product photo/pastel.jpeg', id: 'pastel' },
            { name: 'Kripik Gurih', price: '$4.50', image: '../assets/product photo/kripik.jpeg', id: 'kripik' }
        ]
    },
    'pastel': {
        name: 'Pastel Renyah',
        price: '$8.25',
        category: 'DAILY FRESH',
        rating: 4.5,
        reviews: 86,
        description: 'Crispy on the outside, savory on the inside. Our Pastel Renyah is filled with a delicious mix of seasoned vegetables and premium protein, wrapped in a perfectly braided crust that stays crunchy for hours.',
        image: '../assets/product photo/pastel.jpeg',
        thumbnails: [
            '../assets/product photo/pastel.jpeg',
            '../assets/product photo/full produk.jpeg',
            '../assets/product photo/ChatGPT Image May 6, 2026, 08_00_11 AM.png'
        ],
        ingredients: 'Braided Flour Crust, Seasoned Minced Chicken/Beef, Carrots, Rice Vermicelli, Hard-boiled Eggs, Traditional Spices.',
        storage: 'Best consumed fresh. Can be reheated in an air fryer or oven at 180°C for 5 minutes to restore crispiness.',
        artisanNote: 'Each braid is hand-folded by our pastry chefs to ensure the filling is perfectly sealed and the texture is consistent.',
        pairings: [
            { name: 'Nami Lontar', price: '$15.50', image: '../assets/product photo/lontar.jpeg', id: 'lontar' },
            { name: 'Lumpia Frozen', price: '$12.00', image: '../assets/product photo/Lumpia Frozen.png', id: 'lumpia' }
        ]
    },
    'kripik': {
        name: 'Kripik Gurih',
        price: '$4.50',
        category: 'SNACK COLLECTION',
        rating: 5,
        reviews: 52,
        description: 'Our artisanal chips are thin-sliced and seasoned with a secret blend of herbs and spices. Perfect for sharing or enjoying as a light snack throughout the day.',
        image: '../assets/product photo/kripik.jpeg',
        thumbnails: [
            '../assets/product photo/kripik.jpeg',
            '../assets/product photo/full produk.jpeg'
        ],
        ingredients: 'Premium Root Vegetables, Vegetable Oil, Natural Herbs, Sea Salt, Garlic, Traditional Seasoning.',
        storage: 'Store in an airtight container at room temperature. Keep away from direct sunlight.',
        artisanNote: 'We slice our vegetables extra thin to achieve that perfect snap without using any artificial hardening agents.',
        pairings: [
            { name: 'Nami Lontar', price: '$15.50', image: '../assets/product photo/lontar.jpeg', id: 'lontar' },
            { name: 'Pastel Renyah', price: '$8.25', image: '../assets/product photo/pastel.jpeg', id: 'pastel' }
        ]
    },
    'lumpia': {
        name: 'Lumpia Frozen',
        price: '$12.00',
        category: 'READY TO COOK',
        rating: 4.8,
        reviews: 45,
        description: 'Enjoy our famous Lumpia at home! These frozen spring rolls are packed with our signature savory filling and ready to fry whenever you crave a hot, crispy treat.',
        image: '../assets/product photo/Lumpia Frozen.png',
        thumbnails: [
            '../assets/product photo/Lumpia Frozen.png',
            '../assets/product photo/full produk.jpeg'
        ],
        ingredients: 'Spring Roll Wrappers, Bamboo Shoots, Minced Protein, Traditional Seasoning, Palm Oil.',
        storage: 'Keep frozen at -18°C. Do not thaw before frying. Consume within 2 months.',
        artisanNote: 'Our wrappers are made in-house to ensure they are thin enough to be crispy but strong enough to hold the generous filling.',
        pairings: [
            { name: 'Pastel Renyah', price: '$8.25', image: '../assets/product photo/pastel.jpeg', id: 'pastel' },
            { name: 'Paket Lengkap', price: '$45.00', image: '../assets/product photo/full produk.jpeg', id: 'paket-lengkap' }
        ]
    },
    'paket-lengkap': {
        name: 'Paket Lengkap',
        price: '$45.00',
        category: 'GIFT BOX',
        rating: 5,
        reviews: 28,
        description: 'The ultimate Nami Lontar experience. This gift box includes a curated selection of our best-selling Lontar, Pastel, and Kripik. Perfect for family gatherings or corporate gifts.',
        image: '../assets/product photo/full produk.jpeg',
        thumbnails: [
            '../assets/product photo/full produk.jpeg',
            '../assets/product photo/lontar.jpeg',
            '../assets/product photo/pastel.jpeg',
            '../assets/product photo/kripik.jpeg'
        ],
        ingredients: 'Includes all ingredients from Lontar, Pastel, and Kripik collections.',
        storage: 'Refer to individual product storage instructions.',
        artisanNote: 'A comprehensive collection of our finest work, beautifully packaged for your special moments.',
        pairings: [
            { name: 'Lumpia Frozen', price: '$12.00', image: '../assets/product photo/Lumpia Frozen.png', id: 'lumpia' },
            { name: 'Kripik Gurih', price: '$4.50', image: '../assets/product photo/kripik.jpeg', id: 'kripik' }
        ]
    }
};

// Initialize Page
document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    if (productId && productData[productId]) {
        loadProduct(productData[productId]);
    } else {
        // Redirect to home if product not found
        // window.location.href = 'index.php';
        loadProduct(productData['lontar']); // Fallback for demo
    }

    // Qty Selector Logic
    const qtyInput = document.getElementById('qty-input');
    const qtyPlus = document.getElementById('qty-plus');
    const qtyMinus = document.getElementById('qty-minus');

    qtyPlus.addEventListener('click', () => {
        qtyInput.value = parseInt(qtyInput.value) + 1;
    });

    qtyMinus.addEventListener('click', () => {
        if (parseInt(qtyInput.value) > 1) {
            qtyInput.value = parseInt(qtyInput.value) - 1;
        }
    });

    // Size Selection Logic
    const sizeBtns = document.querySelectorAll('.size-btn');
    sizeBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            sizeBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Add to Cart Button Logic
    const addToCartBtn = document.querySelector('.btn-large');
    addToCartBtn.addEventListener('click', () => {
        const qty = parseInt(document.getElementById('qty-input').value);
        cartManager.addItem(productId, qty);
    });
});

function loadProduct(product) {
    document.title = `${product.name} | Nami Lontar`;
    document.getElementById('breadcrumb-current').textContent = product.name;
    document.getElementById('product-category').textContent = product.category;
    document.getElementById('product-name').textContent = product.name;
    document.getElementById('product-price').textContent = product.price;
    document.getElementById('product-desc').textContent = product.description;
    document.getElementById('product-ingredients').textContent = product.ingredients;
    document.getElementById('product-storage').textContent = product.storage;
    document.getElementById('product-artisan-note').textContent = product.artisanNote;
    document.getElementById('product-reviews').textContent = `(${product.reviews} reviews)`;

    const mainImg = document.getElementById('main-product-img');
    mainImg.src = product.image;

    // Load Stars
    const starContainer = document.getElementById('product-stars');
    starContainer.innerHTML = '';
    for (let i = 0; i < 5; i++) {
        const star = document.createElement('i');
        if (i < Math.floor(product.rating)) {
            star.className = 'fa-solid fa-star';
        } else if (i < product.rating) {
            star.className = 'fa-solid fa-star-half-stroke';
        } else {
            star.className = 'fa-regular fa-star';
        }
        starContainer.appendChild(star);
    }

    // Load Thumbnails
    const thumbGrid = document.getElementById('thumbnail-grid');
    thumbGrid.innerHTML = '';
    product.thumbnails.forEach((thumb, index) => {
        const thumbDiv = document.createElement('div');
        thumbDiv.className = `thumb-item ${index === 0 ? 'active' : ''}`;
        thumbDiv.innerHTML = `<img src="${thumb}" alt="Thumbnail ${index + 1}">`;
        thumbDiv.addEventListener('click', () => {
            mainImg.src = thumb;
            document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
            thumbDiv.classList.add('active');
        });
        thumbGrid.appendChild(thumbDiv);
    });

    // Load Pairings
    const pairingsGrid = document.getElementById('pairings-grid');
    pairingsGrid.innerHTML = '';
    product.pairings.forEach(pair => {
        const pairCard = document.createElement('div');
        pairCard.className = 'pairing-card';
        pairCard.innerHTML = `
            <a href="product.php?id=${pair.id}">
                <div class="pairing-img">
                    <img src="${pair.image}" alt="${pair.name}">
                </div>
            </a>
            <div class="pairing-info">
                <h4>${pair.name}</h4>
                <span class="price">${pair.price}</span>
            </div>
        `;
        pairingsGrid.appendChild(pairCard);
    });
}
