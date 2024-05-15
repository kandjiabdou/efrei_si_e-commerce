const user = JSON.parse(localStorage.getItem("user"));
console.log(user);
$("#firstname").val(user.firstname);
$("#lastname").val(user.lastname);
$("#email").val(user.email);
$("#mypara").html(user.lastname);
$("#address").val(user.adresse);
$("#city").val(user.ville);
$("#code").val(user.code_postal);
$('#avatar_user').attr('src', "/project_e_commerce/assets/avatar/" + user.image);


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
                                <img src="../assets/product/${product.product_picture}" alt="">
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

$('.toggle-password').click(function() {
    // Basculer l'icône
    $(this).find('i').toggleClass('fa-eye fa-eye-slash');
    // Basculer le type du champ de saisie associé
    let input = $(this).closest('.input-group').find('.password');
    input.attr('type', input.attr('type') === 'password' ? 'text' : 'password');
});