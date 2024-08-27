const loadMoreBtn = document.getElementById('load-more-btn');
const resetBtn = document.getElementById('reset-btn');
const productGrid = document.getElementById('product-grid');

loadMoreBtn.addEventListener('click', loadMore);
resetBtn.addEventListener('click', reset);

let itemCount = 0;
let itemCountLoadMore = 3;
let itemPerPage = 3;
const itemTotal = 9;

function generateTiles(productData) {
    productData.forEach((data) => {
        const anchor = document.createElement('a');
        anchor.href = '/';
        anchor.className = 'product-grid-tile';

        const image = document.createElement('img');
        image.src = data.image;
        image.alt = data.alt;

        anchor.appendChild(image);
        productGrid.appendChild(anchor);
    });
}

function loadMore() {
    const productData = products.slice(itemCount, itemCount + itemPerPage);
    generateTiles(productData);

    itemCount += 3;
    itemCountLoadMore += 3;

    if (itemCount === itemTotal - itemPerPage) {
        loadMoreBtn.classList.add('hideBtn');
    }

    setCount(itemCountLoadMore);

    const items = document.querySelectorAll('.product-grid-tile');
    items[itemCountLoadMore - itemPerPage].focus();
}

function reset() {
    productGrid.innerHTML = '';
    generateTiles(resetProducts);

    itemCount = 0;
    itemCountLoadMore = 3;

    setCount(itemCountLoadMore);

    loadMoreBtn.classList.remove('hideBtn');

    const items = document.querySelectorAll('.product-grid-tile');
    items[0].focus();
}

function setCount(itemCount) {
    const count = document.getElementById('product-count');
    count.innerText = `Showing ${itemCount} of 9 products`;
}

const resetProducts = [
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=1&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=2&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=3&q=95&w=360&h=360&fit=fill',
    },
];

const products = [
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=4&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=5&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=6&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=7&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=8&q=95&w=360&h=360&fit=fill',
    },
    {
        title: 'Product',
        alt: 'This is a product.',
        image: 'https://via.assets.so/furniture.png?id=9&q=95&w=360&h=360&fit=fill',
    },
];
