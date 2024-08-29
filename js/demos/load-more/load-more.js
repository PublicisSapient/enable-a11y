import { productsData, resetProductsData } from './data.js';

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
                    <div class="${this.tileClass}" role="group" arialabelledby="${product.type}-${product.id}">
                        <a href="/" class="${this.focusClass}">
                        <span class="sr-only">${product.name}</span>
                        </a>
                        <img src="${product.image}" alt="${product.name}" />
                        <p id="${product.type}-${product.id}" class="product-name">${product.name}</p>
                        <p class="product-price">${product.price}</p>
                        <button type="button" class="add-to-cart-btn">Add to Cart</button>
                    </div>
                `;
            case 'view-grid':
                return `
                    <div class="${this.tileClass}">
                        <div class="tile-relative">
                            <img src="${product.image}" alt="${product.name}" />
                            <a href="/" class="${this.focusClass}">
                                Shop ${product.category}
                            </a>
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

        const productTiles = document.querySelectorAll(`.${this.focusClass}`);
        const tileToTarget =
            productTiles[this.itemCountLoadMore - this.itemPerPage];

        tileToTarget.focus();
        tileToTarget.scrollIntoView({
            block: 'center',
            behavior: 'smooth',
        });
    }

    reset() {
        this.productGrid.innerHTML = '';
        this.generateTiles(this.resetProducts);

        this.itemCount = 0;
        this.itemCountLoadMore = 3;

        this.setCount(this.itemCountLoadMore);

        this.loadMoreBtn.classList.remove('hide-btn');
        this.resetBtn.classList.add('hide-btn');

        const productTiles = document.querySelectorAll(`.${this.focusClass}`);
        const tileToTarget = productTiles[0];

        tileToTarget.focus();
        tileToTarget.scrollIntoView({ block: 'center', behavior: 'smooth' });
    }

    setCount(itemCount) {
        const type = this.type === 'product-grid' ? 'Products' : 'Categories';
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
