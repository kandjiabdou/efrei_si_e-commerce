const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get("id"); // Je récupère l'id de l'article à modifier dans l'url


function getAllOrders() {

    $.ajax({
        url: "../../php/admin_orders.php",
        type: "GET",
        data: {
            choisir: "select"
        },
        contentType: "application/json",
        dataType: "json",
        cache: false,
        success: (res) => {
            console.log(res)


            for (let i = 0; i < res.orders.length; i++) {
                order = res.orders[i];
                let tr = `
                <tr>
                    <td>${order.id_order}</td>
                    <td>${order.client}</td>
                    <td>${order.date_order}</td>
                    <td>${order.statut == 0 ? "commande en attente" : "commande validée"}</td>
                    <td>${order.total_products} produits</td>
                    <td>
                    
                    <a href="view.php?id=${order.id_order}">Afficher commande</a>
                    <a href="${order.statut==0 ? 'form.php?id='+order.id_order : '#'}" >${order.statut==0 ? 'valider' : 'validé'}</a>
                    </td>
                </tr>
            `;
                $("#orders_tbody").append(tr)
            }



        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log("what is the problem", thrownError)
        }
    });

}

if (id) {



    if ("view.php".indexOf(window.location.pathname)) {
        $.ajax({
            url: "../../php/admin_orders.php",
            type: "GET",
            dataType: "json",
            data: {
                choisir: "select_id",
                id_order: id
            },
            success: (res) => {
                if(res.success){
                    let containerDetails = document.querySelector('.order_details')

                    let orderClientTag = `<div>Client : ${res.order.client}</div>`;
                    let orderDateTag = `<div>Date : ${res.order.date_order}</div>`;
                    let orderStatusTag = `<div>Statut : ${res.order.statut==1?"Validée":"En attente"}</div>`;

                    containerDetails.innerHTML = orderClientTag + orderDateTag + orderStatusTag;

                    let containerProds = document.querySelector('.order_products')

                    for (let i=0; i<res.order.products.length; i++){
                        let pr = res.order.products[i]
                        console.log(pr)

                        let prDescription = `<div> ${pr.description}</div>`;
                        let prProductName = `<div class="title-prod"> ${pr.product_name}</div>`;
                        let prProductPicture = `<img class="img-fluid-2" src="../../assets/${pr.product_picture}" />`;
                        let prProductPrice = `<div>Prix : ${pr.product_price}</div>`;
                        let prProductQuantity = `<div>Quantité produit en stock : ${pr.product_quantity}</div>`;
                        let prQuantity = `<div>Quantité commandée : ${pr.quantity}</div>`;

                        let prDiv = `<div class="card-prod">
                                                <div class="card-prod-img">${prProductPicture}</div>
                                                <div class="card-prod-details">
                                                    ${prProductName}
                                                    ${prDescription}
                                                    ${prQuantity}
                                                    <div class="span-prod">${prProductPrice} ${prProductQuantity}</div>
                                                </div>
                                            </div>`;
                        containerProds.insertAdjacentHTML("beforeend", prDiv)
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("what is the problem", thrownError)
            }
        });
    } else {
        $.ajax({
            url: "../../php/admin_orders.php",
            type: "GET",
            //dataType: "json",
            data: {
                choisir: "validate",
                id: id
            },
            success: (res) => {
                window.location.replace("../orders/");
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log("what is the problem", thrownError)
            }
        });
    }


} else {}