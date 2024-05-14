const user = JSON.parse(localStorage.getItem("user"));
console.log(user);
$("#firstname").val(user.firstname);
$("#lastname").val(user.lastname);
$("#email").val(user.email);
$("#mypara").html(user.lastname);
$("form").submit(event => {
    event.preventDefault();
    $.ajax({
        url: "../php/profile.php",
        type: "POST",
        dataType: "json",
        data: {
            choisir: 'update',
            user_id: user.id_user,
            ancienpwd: $("ancienpwd").val(),
            newpwd: $("newpwd").val(),
            confirmpwd: $("confirmpwd").val()
        },
        success: (res) => {
            if (res.success) {

                alert(res.message);
            } else {
                alert(res.error);
            }
        }
    });
});


function getOrderHistory(){
    $.ajax({
        url: "../php/profile.php",
        type: "GET",
        dataType: "json",
        data: {
            choisir: 'order',
            user_id: user.id_user
        },
        success: (res) => {
            console.log(res)
            /**
             * {
             *     "success": true,
             *     "orders": [
             *         {
             *             "id_order": "17",
             *             "date_order": "2023-08-20 19:04:22",
             *             "statut": "0",
             *             "id_user": "4",
             *             "products": [
             *                 {
             *                     "quantity": "2",
             *                     "id_product": "3",
             *                     "id_order": "17",
             *                     "product_name": "dfghj",
             *                     "description": "sdfghjkl",
             *                     "product_quantity": "18",
             *                     "product_picture": "IMG-7819.JPG",
             *                     "product_price": "1",
             *                     "id_category": "1"
             *                 },
             *                 {
             *                     "quantity": "1",
             *                     "id_product": "4",
             *                     "id_order": "17",
             *                     "product_name": "dfghjk",
             *                     "description": "tttttttttttttttttttttttttt",
             *                     "product_quantity": "19",
             *                     "product_picture": "IMG-7816.JPG",
             *                     "product_price": "9",
             *                     "id_category": "2"
             *                 },
             *                 {
             *                     "quantity": "1",
             *                     "id_product": "5",
             *                     "id_order": "17",
             *                     "product_name": "azerty",
             *                     "description": "azerty",
             *                     "product_quantity": "26",
             *                     "product_picture": "IMG-7825.JPG",
             *                     "product_price": "4",
             *                     "id_category": "2"
             *                 }
             *             ]
             *         },
             *         {
             *             "id_order": "18",
             *             "date_order": "2023-08-20 23:05:16",
             *             "statut": "0",
             *             "id_user": "4",
             *             "products": [
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "3",
             *                     "id_order": "18",
             *                     "product_name": "dfghj",
             *                     "description": "sdfghjkl",
             *                     "product_quantity": "18",
             *                     "product_picture": "IMG-7819.JPG",
             *                     "product_price": "1",
             *                     "id_category": "1"
             *                 },
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "4",
             *                     "id_order": "18",
             *                     "product_name": "dfghjk",
             *                     "description": "tttttttttttttttttttttttttt",
             *                     "product_quantity": "19",
             *                     "product_picture": "IMG-7816.JPG",
             *                     "product_price": "9",
             *                     "id_category": "2"
             *                 },
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "5",
             *                     "id_order": "18",
             *                     "product_name": "azerty",
             *                     "description": "azerty",
             *                     "product_quantity": "26",
             *                     "product_picture": "IMG-7825.JPG",
             *                     "product_price": "4",
             *                     "id_category": "2"
             *                 }
             *             ]
             *         },
             *         {
             *             "id_order": "19",
             *             "date_order": "2023-08-20 23:05:18",
             *             "statut": "0",
             *             "id_user": "4",
             *             "products": [
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "3",
             *                     "id_order": "19",
             *                     "product_name": "dfghj",
             *                     "description": "sdfghjkl",
             *                     "product_quantity": "18",
             *                     "product_picture": "IMG-7819.JPG",
             *                     "product_price": "1",
             *                     "id_category": "1"
             *                 },
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "4",
             *                     "id_order": "19",
             *                     "product_name": "dfghjk",
             *                     "description": "tttttttttttttttttttttttttt",
             *                     "product_quantity": "19",
             *                     "product_picture": "IMG-7816.JPG",
             *                     "product_price": "9",
             *                     "id_category": "2"
             *                 },
             *                 {
             *                     "quantity": "0",
             *                     "id_product": "5",
             *                     "id_order": "19",
             *                     "product_name": "azerty",
             *                     "description": "azerty",
             *                     "product_quantity": "26",
             *                     "product_picture": "IMG-7825.JPG",
             *                     "product_price": "4",
             *                     "id_category": "2"
             *                 }
             *             ]
             *         },
             *         {
             *             "id_order": "20",
             *             "date_order": "2023-08-24 18:51:38",
             *             "statut": "0",
             *             "id_user": "4",
             *             "products": [
             *                 {
             *                     "quantity": "1111",
             *                     "id_product": "3",
             *                     "id_order": "20",
             *                     "product_name": "dfghj",
             *                     "description": "sdfghjkl",
             *                     "product_quantity": "18",
             *                     "product_picture": "IMG-7819.JPG",
             *                     "product_price": "1",
             *                     "id_category": "1"
             *                 },
             *                 {
             *                     "quantity": "11111",
             *                     "id_product": "4",
             *                     "id_order": "20",
             *                     "product_name": "dfghjk",
             *                     "description": "tttttttttttttttttttttttttt",
             *                     "product_quantity": "19",
             *                     "product_picture": "IMG-7816.JPG",
             *                     "product_price": "9",
             *                     "id_category": "2"
             *                 },
             *                 {
             *                     "quantity": "111",
             *                     "id_product": "5",
             *                     "id_order": "20",
             *                     "product_name": "azerty",
             *                     "description": "azerty",
             *                     "product_quantity": "26",
             *                     "product_picture": "IMG-7825.JPG",
             *                     "product_price": "4",
             *                     "id_category": "2"
             *                 },
             *                 {
             *                     "quantity": "2",
             *                     "id_product": "6",
             *                     "id_order": "20",
             *                     "product_name": "Femme sdfgh",
             *                     "description": "tenue pour ldfges céremonies",
             *                     "product_quantity": "4",
             *                     "product_picture": "IMG-7817.JPG",
             *                     "product_price": "17",
             *                     "id_category": "1"
             *                 }
             *             ]
             *         }
             *     ]
             * }
             */

            if (res.success) {
                let orders = res.orders;
                let orderHistory = document.getElementById("order-history");
                for (let i = 0; i < orders.length; i++) {
                    let order = orders[i];
                    let orderBox = `<div class="order-box">
                        <h5>Order Date: ${order.date_order}</h5>
                        <h5>Order Total: €${order.total}</h5>
                        <div class="order-products">`;
                    for (let j = 0; j < order.products.length; j++) {
                        let product = order.products[j];
                        orderBox += `<div class="order-product">
                            <div class="order-product-img">
                                <img src="../assets/${product.product_picture}" alt="">
                            </div>
                            <div class="order-product-info">
                                <h6>${product.product_name}</h6>
                                <h6>€${product.product_price}</h6>
                                <h6>Quantity: ${product.quantity}</h6>
                            </div>
                        </div>`;
                    }
                    orderBox += `</div></div>`;
                    orderHistory.innerHTML += orderBox;
                }
            }
        },
        error: (err) => {
            console.log(err);
        }
    });
}
getOrderHistory();

let productCart = [];
if (localStorage.getItem("productCart") !== null) {
    productCart = JSON.parse(localStorage.getItem("productCart"));
    if(productCart.length > 0) {
        document.getElementById('cart-badge').innerHTML = productCart.length.toString();
    }
}
