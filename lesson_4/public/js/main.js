const button = document.querySelector('.btn');
const productItems = document.querySelector('.product-items');
let dataBD = [];
const step = 3;
let startRender = 0;

const getJson = async () => {
    let res = await fetch('../Engine/dataBase.php')
    dataBD = await res.json()
}

getJson();

const renderProduct = (product) => {
    return `<figure class="product">
        <div class="product__photo">
            <img class="product__image" src="${product.url_img}" alt="${product.name}">
        </div>
        <figcaption class="product__text product-text">
            <h2 class="product-text__title">${product.name}</h2>
            <p class="product-text__description">${product.description}</p>
            <h3 class="product-text__price">${product.price}</h3>
        </figcaption>
    </figure>`
}

const renderAddProduct = () => {
    startRender += step
    let endRender = startRender + step;
    let productList = dataBD.slice(startRender, endRender);
    let productListRender = productList.map((item) => renderProduct(item));
    for (let product of productListRender) {
        productItems.insertAdjacentHTML('beforeend', product);
    }
}

button.addEventListener('click', (evt) => {
    evt.preventDefault()
    renderAddProduct()
})



