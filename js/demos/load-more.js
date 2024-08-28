const resetProductsData = [
    {
        name: 'Modern Tufted Armless Lounge Chair',
        image: 'images/load-more/chair1.png',
        price: '$399.99',
        category: 'Modern Chairs',
    },
    {
        name: 'Minimalist Felt Lounge Chair',
        image: 'images/load-more/chair2.png',
        price: '$199.99',
        category: 'Simple Chairs',
    },
    {
        name: 'Classic Tufted Leather Wingback Chair',
        image: 'images/load-more/chair3.png',
        price: '$799.99',
        category: 'Leather Chairs',
    },
];

const productsData = [
    {
        name: 'Wire Frame Accent Chair',
        image: 'images/load-more/chair4.png',
        price: '$99.99',
        category: 'Metal Chairs',
    },
    {
        name: 'Modern Wooden End Table',
        image: 'images/load-more/chair5.png',
        price: '$149.99',
        category: 'End Tables',
    },
    {
        name: 'Ergonomic Leather Office Chair',
        image: 'images/load-more/chair6.png',
        price: '$299.99',
        category: 'Office Chairs',
    },
    {
        name: 'Modern Wood Slat Back Dining Chair',
        image: 'images/load-more/chair7.png',
        price: '$99.99',
        category: 'Wooden Chairs',
    },
    {
        name: 'Wooden Picnic Table with Benches',
        image: 'images/load-more/chair8.png',
        price: '$999.99',
        category: 'Outdoor Chairs',
    },
    {
        name: 'Classic Windsor Chair',
        image: 'images/load-more/chair9.png',
        price: '$149.99',
        category: 'Kitchen Chairs',
    },
];

class ExampleGrid {
    constructor({
        type,
        products,
        resetProducts,
        loadMoreBtn,
        resetBtn,
        productGrid,
        countText,
        tileClass,
        focusClass,
    }) {
        this.type = type;
        this.products = products;
        this.resetProducts = resetProducts;
        this.loadMoreBtn = document.getElementById(loadMoreBtn);
        this.resetBtn = document.getElementById(resetBtn);
        this.productGrid = document.getElementById(productGrid);
        this.countText = document.getElementById(countText);
        this.tileClass = tileClass;
        this.focusClass = focusClass;
        this.itemCount = 0;
        this.itemCountLoadMore = 3;
        this.itemPerPage = 3;
        this.itemTotal = 9;

        this.configure();
    }

    configure() {
        this.loadMoreBtn.addEventListener('click', this.loadMore.bind(this));
        this.resetBtn.addEventListener('click', this.reset.bind(this));
    }

    createProductHtml(product) {
        switch (this.type) {
            case 'product-grid':
                return `
                    <div class="${this.tileClass}">
                        <a href="/" class="${this.focusClass}">
                        <span class="sr-only">${product.name}</span>
                        </a>
                        <img src="${product.image}" alt="${product.name}" />
                        <p class="product-name">${product.name}</p>
                        <p class="product-price">${product.price}</p>
                        <button type="button" class="add-to-cart-btn" aria-label="Add ${product.name} to cart.">Add to Cart</button>
                    </div>
                `;
            case 'view-grid':
                return `
                    <div class="${this.tileClass}">
                        <div class="tile-relative">
                            <img src="${product.image}" alt="${product.name}" />
                            <button type="button" class="${this.focusClass}">
                                Shop ${product.category}
                            </button>
                        </div>
                    </div>
                `;
            default:
                return new Error(`Type of ${this.type} is not supported`);
        }
    }

    generateTiles(productData) {
        productData.forEach((product) => {
            const productHtml = this.createProductHtml(product);
            this.productGrid.insertAdjacentHTML('beforeend', productHtml);
        });
    }

    loadMore() {
        const productData = this.products.slice(
            this.itemCount,
            this.itemCount + this.itemPerPage,
        );
        this.generateTiles(productData);

        this.itemCount += 3;
        this.itemCountLoadMore += 3;

        if (this.itemCount === this.itemTotal - this.itemPerPage) {
            this.loadMoreBtn.classList.add('hide-btn');
            this.resetBtn.classList.remove('hide-btn');
        }

        this.setCount(this.itemCountLoadMore);

        const items = document.querySelectorAll(`.${this.focusClass}`);
        items[this.itemCountLoadMore - this.itemPerPage].focus();
    }

    reset() {
        this.productGrid.innerHTML = '';
        this.generateTiles(this.resetProducts);

        this.itemCount = 0;
        this.itemCountLoadMore = 3;

        this.setCount(this.itemCountLoadMore);

        this.loadMoreBtn.classList.remove('hide-btn');
        this.resetBtn.classList.add('hide-btn');

        const items = document.querySelectorAll(`.${this.focusClass}`);
        items[0].focus();
    }

    setCount(itemCount) {
        const type = this.type === 'product-grid' ? 'products' : 'categories';
        this.countText.innerText = `Showing ${itemCount} of 9 ${type}`;
    }
}

new ExampleGrid({
    type: 'product-grid',
    products: productsData,
    resetProducts: resetProductsData,
    loadMoreBtn: 'load-more-btn',
    resetBtn: 'product-reset-btn',
    productGrid: 'product-grid',
    countText: 'product-count',
    tileClass: 'product-tile',
    focusClass: 'product-details-link',
});

new ExampleGrid({
    type: 'view-grid',
    products: productsData,
    resetProducts: resetProductsData,
    loadMoreBtn: 'view-more-btn',
    resetBtn: 'view-reset-btn',
    productGrid: 'view-grid',
    countText: 'view-count',
    tileClass: 'view-tile',
    focusClass: 'view-details-link',
});
