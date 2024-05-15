let productCart = [];
if (localStorage.getItem("productCart") !== null) {
    productCart = JSON.parse(localStorage.getItem("productCart"));
    if(productCart.length > 0) {
        document.getElementById('cart-badge').innerHTML = productCart.length.toString();
    }
}
function addToCart(product) {
    event.preventDefault();
    product = JSON.parse(product);
    if (!product.hasOwnProperty('quantity')) {
        product.quantity = 1;
    }
    let existingProduct = null;
    for (let i = 0; i < productCart.length; i++) {
        if (productCart[i].id_product === product.id_product) {
            existingProduct = productCart[i];
            break;
        }
    }
    console.log(existingProduct)
    if (existingProduct) {
        existingProduct.quantity += 1;
    } else {
        productCart.push(product);
    }
    document.getElementById('cart-badge').innerHTML = productCart.length.toString();
    localStorage.setItem("productCart", JSON.stringify(productCart));
}

function getAllProducts() {
    $.ajax({
        url: "../php/admin_products.php",
        type: "GET",
        data: {
            choisir: "select"
        },
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: (res) => {
            console.log(res)
            for (let i = 0; i < res.products.length; i++) {
                let pr = res.products[i];
                let productBox = `<div class="box">
                    <a href="product.php?id=${pr.id_product}">
                        <div class="img-box">
                        <img src="../assets/product/${pr.product_picture}" alt="">
                        </div>
                        <div class="detail-box">
                        <h6>
                        ${pr.product_name}
                        </h6>
                        <h6>
                        €
                            <span>
                            ${pr.product_price}
                            </span>
                        </h6>
                        </div>
                        <div class="new" id="${"new_" + pr.id_product}">
                        <span >
                            +
                        </span>
                        </div>
                    </a>
                    </div>`;
                document.getElementById('shop_container').insertAdjacentHTML("afterbegin", productBox)

                document.getElementById('new_'+ pr.id_product).addEventListener("click", function(e){
                    e.preventDefault();
                    addToCart(JSON.stringify(pr))
                })
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });
}

getAllProducts();